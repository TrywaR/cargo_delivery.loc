<?
class responceFilter {
    // public float $fPrice = ''; # Стоимость
    // public string $dDateDelivery = ''; # Дата доставки

    // public string $oResponceData = ''; # Данные из API

    // Получаем стоимость
    public function get_price ( $sPriceName = '' ) {
        $this->fPrice = $this->oResponceData[ $sPriceName ];
    }

    // Получаем стоимость c коэффициентом
    public function get_price_coeff ( $sPriceName = '' ) {
        $this->get_price( $sPriceName );
        $this->fPrice = $this->fPrice + $iCoeff;
    }

    // Получаем дату
    public function get_date ( $sDateName = '' ) {
        $this->dDateDelivery = $this->oResponceData[ $sDateName ];
    }

    // Получаем дату с периодом
    public function get_date_prediod ( $sDateName = '' ) {
        $this->get_date( $sDateName );
        $currentHour = date('H:i');
        $tomorrow = date('Y-m-d'); // Текущая дата без изменений
        if ($currentHour > '18:00') $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $this->dDateDelivery = date('Y-m-d', strtotime($this->dDateDelivery) + strtotime($tomorrow));
    }

    // Конвертируем данные в json
    public function convert_json ( $sData = '' ) {
        if ( ! $sData ) $sData = $this->oResponceData;
        $this->oResponceData = json_decode($sData, true); // Пример для JSON
    }

    // Конвертируем данные в xml
    // public function convert_xml ( $sData = '' ) {
        
    // }

    // Конвертируем дату в нужный формат
    public function convert_date ( $sDate = '' ) {
        if ( ! $sDate ) $sDate = $this->dDateDelivery; 

        $dProizvolnayaData = $sDate; // Замените на вашу произвольную дату
        $sFormat = 'Y-m-d'; // Желаемый формат даты
        $this->dDateDelivery = date($sFormat, strtotime($dProizvolnayaData));

        return $this->dDateDelivery;
    }
}