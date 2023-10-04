<?
// Быстрая доставка
class fastDeliveryService extends deliveryService {
    // base_url: string
    // @var sourceKladr string //кладр откуда везем
    // @var targetKladr string //кладр куда везем
    // @var weight float //вес отправления в кг
    // @return json
    // {
    //     'price': float //стоимость
    //     'period': int //количество дней начиная с сегодняшнего, но после 18.00 заявки не принимаются.
    //     'error': string
    // }
    // Вывод данных
    public function get( $arrCargo, $arrDeliveryCompany ){
        // Заполняем параметры для рассчёта
        $this->sApiUrl = arrDeliveryCompany['apiSlow'];
        $this->bWeight = $arrCargo['weight'];
        $this->sSourceKladr = $arrCargo['source'];
        $this->sTargetKladr = $arrCargo['target'];

        // Получаем данные
        $this->load();

        // - Получаем цену
        $this->get_price( $arrCargo['priceName'] );

        // Получаем дату
        $this->get_date_prediod( 'period' );

        return array(
            'price': $this->fPrice,
            'date': $this->dDateDelivery,
            'error': $this->sError,
        );
    }
}