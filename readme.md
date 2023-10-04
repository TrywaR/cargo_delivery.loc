# Расчёт стоимости доставки грузов для транспортных компаний

## index.php

В этом файле подключаются все файлы для работы, из папки core
Хранятся массивы с товарами и транаспартными компаниями и их параметрами
и запускается расчёт стоимости, с выводом данных

## Работа
`deliveryManager` - Обработчик грузов и сервисов доставок, определяет какие данные откуда загрузить, выводит список грузов и саписок со сроками и стомостью доставки по каждому грузу
`fastDeliveryService` - Получает при помощи `deliveryService` данные по быстрой доставки, обрабатывает данные используя `responceFilter` и возвращяет стоимость и время доставки
`slowDeliveryService` - Получает при помощи `deliveryService` данные по медленной доставки, обрабатывает данные используя `responceFilter` и возвращяет стоимость и время доставки
`deliveryService` - класс в котором хранятся параметры для расчёта доставки и функционал загрузки этих данных по API
`responceFilter` - класс в котором проходит обработка и форматирование всех данных

