<?
Class WFGeneral{
    /**
     * return array contains info about gallery
     * @param string $galId - Gallery ID
     * @return array
     */
   static function GetGallery($galId){
        CModule::IncludeModule("fileman");
        CMedialib::Init();
        $gallery = CMedialibItem::GetList(array('arCollections' => array($galId)));
        return $gallery;
    }
}
?>