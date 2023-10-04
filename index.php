<?
// ПОДКЛЮЧАЕМ ФАЙЛЫ
include_once 'core/fast_delivery_service.php'; # Быстрая доставка
include_once 'core/slow_delivery_service.php'; # Медленная доставка, имеет базовую стоимость 150р
include_once 'core/respince_filter.php'; # Обработка данных
include_once 'core/delivery_service.php'; # Сервис доставки
include_once 'core/delivery_manager.php'; # Вывод данных по даставкам

// ПАРАМЕТРЫ
// - Транспортные компании и их параметры
$arrDeliveryCompanies = [];
$arrDeliveryCompanies[] = array(
    'id' => 1,
    'name' => 'Транспортная компания 1',
    // 'api' => 'https://delivery1.com/api/',
    'apiFast' => 'https://delivery1.com/api/fast/',
    'apiSlow' => 'https://delivery1.com/api/slow/',
    'respinceType' => 'json';
    'priceName' => 'price';
    'dateName' => 'date';
);
$arrDeliveryCompanies[] = array(
    'id' => 2,
    'name' => 'Транспортная компания 2',
    // 'api' => 'https://delivery2.com/api/',
    'apiFast' => 'https://delivery2.com/api/fast/',
    'apiSlow' => 'https://delivery2.com/api/slow/',
    'respinceType' => 'json';
    'priceName' => 'price';
    'dateName' => 'date_delivery';
);
$arrDeliveryCompanies[] = array(
    'id' => 3,
    'name' => 'Транспортная компания 3',
    // 'api' => 'https://delivery3.com/api/',
    'apiFast' => 'https://delivery3.com/api/fast/',
    'apiSlow' => 'https://delivery3.com/api/slow/',
    'respinceType' => 'json';
    'priceName' => 'sum';
    'dateName' => 'date';
);
// - Параметры грузов
$arrCargos[]
$arrCargos[] = array(
    'name' => 'Груз 1',
    'weight' => 15,
    'source' => 'a',
    'target' => 'b',
    'delivery_company_id' => 1,
);
$arrCargos[] = array(
    'name' => 'Груз 2',
    'weight' => 15,
    'source' => 'a',
    'target' => 'с',
    'delivery_company_id' => 2,
);
$iCoeff = 150; # коэффициент для медленной доставки

// РАБОТА
$oDeliveryManager = new deliveryManager();
$arrResultCargosCargos = $oDeliveryManager->calculateDeliveryCost();
foreach ( $arrResultCargosCargos as $arrResultCargo ) {?>
    <div>
        <!-- Груз -->
        <div><strong><?=$arrResultCargo['name']?></strong></div>

        <!-- Службы доставки -->
        <div>
            <!-- Выбранная служба доставки -->
            <?foreach ($arrResultCargo['deliveries_select'] as $arrResultCargoDelivery) {?>
                <div>
                    <div><strong><?=$arrResultCargoDelivery['type_name']?></strong></div>
                    <div><?=$arrResultCargoDelivery['price']?></div>
                    <div><?=$arrResultCargoDelivery['date']?></div>
                    <?if($arrResultCargoDelivery['error']){?>
                        <div><?=$arrResultCargoDelivery['error']?></div>
                    <?}?>
                </div>
            <?}?>
            
            <!-- Прочие службы доставки -->
            <?foreach ($arrResultCargo['deliveries_other'] as $arrResultCargoDelivery) {?>
                <div>
                    <div><strong><?=$arrResultCargoDelivery['type_name']?></strong></div>
                    <div><?=$arrResultCargoDelivery['price']?></div>
                    <div><?=$arrResultCargoDelivery['date']?></div>
                    <?if($arrResultCargoDelivery['error']){?>
                        <div><?=$arrResultCargoDelivery['error']?></div>
                    <?}?>
                </div>
            <?}?>
        </div>
    </div>
<?}