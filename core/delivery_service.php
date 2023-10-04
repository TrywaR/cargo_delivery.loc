<?
class deliveryService extends responceFilter {
    public string $sApiUrl = ''; # URL для запроса данных от транспортной компании (замените на реальный URL)
    public bool $bWeight = 0; # Вес
    public string $sSourceKladr = ''; # Склад отправки
    public string $sTargetKladr = ''; # Склад доставки

    public string $sError = ''; # Ошибка если есть
    public float $fPrice = ''; # Стоимость
    public string $dDateDelivery = ''; # Дата доставки

    public string $oResponceData = ''; # Данные из API
    
    // Получить данные из API
    public function connect() {
        // Данные, которые вы хотите отправить в запросе (параметры API)
        $data = array(
            'sourceKladr' => $this->sSourceKladr,
            'targetKladr' => $this->sTargetKladr,
            'weight' => $this->bWeight,
        );
        
        // Инициализируем cURL-сеанс
        $ch = curl_init();
        
        // Устанавливаем опции cURL
        curl_setopt($ch, CURLOPT_URL, $this->sApiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Выполняем запрос и получаем ответ
        $response = curl_exec($ch);
        
        // Проверяем на наличие ошибок
        if (curl_errno($ch)) $this->sError = 'Ошибка cURL: ' . curl_error($ch);    
        else $this->oResponceData = $response;
        
        // Закрываем cURL-сеанс
        curl_close($ch);
    }

    // Обрабатываем данные
    public function load() {
        // Получаем данные
        $this->connect();
        // Обрабатываем данные
        // - Тип данных
        match ( $arrDeliveryCompany['respinceType'] ) {
            'json' => $this->convert_json(),
            // 'xml' => $this->convert_xml(),
        };
    }
}