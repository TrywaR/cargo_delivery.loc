<?
class deliveryManager {
    public function calculateDeliveryCost($arrCargos, $arrDeliveryCompanyCompanies) {
        $arrResults = [];

        // Перебираем доставки
        foreach ( $arrCargos as $arrCargo ) {
            $arrResultParam['data'] = $arrCargo; # Данные о грузе
            $arrResultParam['deliveries_select'] = []; # Выбраная служба доставки
            $arrResultParam['deliveries_other'] = []; # Остальные

            // Перебираем компании
            foreach ( $arrDeliveryCompanyCompanies as $arrDeliveryCompany ) {
                $arrResultDelivery = [];

                $arrResultDelivery['name'] = $arrDeliveryCompany['name'];

                // Быстрая доставка
                if ( isset($arrDeliveryCompany['apiFast']) ) {
                    $oFastDeliveryService = new fast_delivery_service();
                    $arrResultDeliveryType = $oFastDeliveryService->get( $arrCargo, $arrDeliveryCompany );
                    $arrResultDeliveryType['type_name'] = 'Быстрая доставка';
                    $arrResultDelivery[] = $arrResultDeliveryType;
                }
                
                // Медленная доставка
                if ( isset($arrDeliveryCompany['apiSlow']) ) {
                    $oSlowDeliveryService = new slow_delivery_service();
                    $arrResultDeliveryType = $oSlowDeliveryService->get( $arrCargo, $arrDeliveryCompany );
                    $arrResultDeliveryType['type_name'] = 'Медленная доставка';
                    $arrResultDelivery[] = $arrResultDeliveryType;
                }

                if ( isset($arrCargo['delivery_company_id']) && $arrCargo['delivery_company_id'] == $arrDeliveryCompany['id'] ) 
                    $arrResultParam['deliveries_select'] = $arrResultDelivery;
                else 
                    $arrResultParam['deliveries_other'][] = $arrResultDelivery;
            }            
        }

        return $arrResults;
    }
}