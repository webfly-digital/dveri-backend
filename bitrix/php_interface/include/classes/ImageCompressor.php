<?php

class ImageCompressor
{
    const MAX_FILE_SIZE = 150000;
    const MIN_QUALITY = 50;

    /**
     * Универсальный метод получения сжатого изображения по ID или пути.
     *
     * @param int|string $file — ID файла в Битрикс или относительный путь от /upload
     * @return string — путь к сжатому изображению или оригиналу, либо пустая строка
     */
    public static function getCompressedSrcUniversal($file)
    {
        // Если передан ID
        if (is_numeric($file)) {
            return self::getCompressedSrc((int)$file);
        }

        // Если передан путь
        if (is_string($file) && $file !== '') {
            $relativePath = str_replace($_SERVER["DOCUMENT_ROOT"], '', $file);
            $pathParts = explode('/', ltrim($relativePath, '/'));

            $subdir = implode('/', array_slice($pathParts, 1, -1));
            $fileName = end($pathParts);

            $fileRecord = \CFile::GetList([], [
                'SUBDIR' => $subdir,
                'FILE_NAME' => $fileName
            ])->Fetch();

            if ($fileRecord && isset($fileRecord['ID'])) {
                return self::getCompressedSrc((int)$fileRecord['ID']);
            }

            // Fallback — вернём путь, даже если не нашли ID
            return $relativePath;
        }

        // Если ничего не подошло — вернём пусто
        return '';
    }

    /**
     * Возвращает путь к сжатому/оптимизированному изображению.
     * Сжимает, если исходник больше 150 KB, при этом сохраняет исходные ширину и высоту.
     *
     * @param int $fileId       - ID файла в Битрикс
     * @param int $startQuality - С какого значения качества начинаем (80, 85, 90...)
     *
     * @return string - Путь к (уже сжатому) файлу
     */
    public static function getCompressedSrc($fileId, $startQuality = 85)
    {
        if (!$fileId) {
            return '';
        }

        $arFile = \CFile::GetFileArray($fileId);
        if (!$arFile) {
            return '';
        }

        if ($arFile['FILE_SIZE'] <= self::MAX_FILE_SIZE) {
            return $arFile['SRC'];
        }

        $quality = $startQuality;
        $width = $arFile['WIDTH'];
        $height = $arFile['HEIGHT'];

        $resized = \CFile::ResizeImageGet(
            $fileId,
            ['width' => $width, 'height' => $height],
            BX_RESIZE_IMAGE_EXACT,
            true,
            false,
            false,
            $quality
        );

        while ($resized['size'] > self::MAX_FILE_SIZE && $quality >= self::MIN_QUALITY) {
            $quality -= 5;
            $resized = \CFile::ResizeImageGet(
                $fileId,
                ['width' => $width, 'height' => $height],
                BX_RESIZE_IMAGE_EXACT,
                true,
                false,
                false,
                $quality
            );
        }

        return $resized['src'];
    }
}