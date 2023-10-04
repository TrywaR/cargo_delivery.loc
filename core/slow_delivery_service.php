<?
// Медленная доставка, имеет базовую стоимость 150р
class slowDeliveryService extends deliveryService {
    // base_url: string
    // @var sourceKladr string //кладр откуда везем
    // @var targetKladr string //кладр куда везем
    // @var weight float //вес отправления в кг
    // @return json
    // {
    //     'coefficient': float //коэффициент (конечная цена есть произведение базовой стоимости и коэффициента)
    //     'date': string //дата доставки в формате 2017-10-20
    //     'error': string
    // }
    // Вывод данных
    public function get( $arrCargo, $arrDeliveryCompany ){
        global $iCoeff;
        
        // Заполняем параметры для рассчёта
        $oDeliveryService = new deliveryService();
        $oDeliveryService->sApiUrl = arrDeliveryCompany['apiSlow'];
        $oDeliveryService->bWeight = $arrCargo['weight'];
        $oDeliveryService->sSourceKladr = $arrCargo['source'];
        $oDeliveryService->sTargetKladr = $arrCargo['target'];

        // Получаем данные
        $oDeliveryService->load();

        // - Получаем цену
        $this->get_price_coeff( $arrCargo['priceName'] );

        // Получаем дату
        $this->get_date( $arrCargo['dateName'] );

        // - Форматируем дату
        $this->convert_date();

        return array(
            'price': $this->fPrice,
            'date': $this->dDateDelivery,
            'error': $this->sError,
        );
    }
}