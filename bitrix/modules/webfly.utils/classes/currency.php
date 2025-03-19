<?
CModule::IncludeModule('currency');
class CWebflyCurrnecy{
  /**
   * Преобразование доллар в рубль
   * @return float новое значение
   */
  function wfUsd2Rub($val){
    $curConv = new CCurrencyRates;
    $newval = $curConv->ConvertCurrency($val, "USD", "RUB");
    return round($newval);
  }
  /**
   * Преобразование евро в рубль
   * @return float новое значение
   */
  function wfEur2Rub($val){
    $curConv = new CCurrencyRates;
    $newval = $curConv->ConvertCurrency($val, "EUR", "RUB");
    return round($newval);
  }
  /**
   * Преобразование валюты в рубли
   * @param float $val цена в валюте
   * @param string $cFrom валюта
   * @return type float цена в рублях
   */
  function wfCurrency2Rub($val,$cFrom){
    if($cFrom == "USD") return wfUsd2Rub($val);
    if($cFrom == "EUR") return wfEur2Rub($val);
  }
}
?>