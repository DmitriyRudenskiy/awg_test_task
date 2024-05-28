# платформа
docker, Laravel 8, mySQL, фронт пусть будет любой (либо если фронта нет, то нужно описание методов API для него)

# критерий сдачи:
архив с кодом, сервис на Laravel в docker-compose, в readme минимальная инструкция по запуску, после старта запускает миграции и на указанном в композе порту доступна фронт-часть приложения с селектом кода валюты и выбором даты (или аналогом через REST API)
функциональные требования:
страница с выбором кода базовой валюты и даты (по умолчанию RUR, сегодня) ниже таблица с курсом RUR\USD\EUR\JPY\CNY , отношение к базовому за выбранную дату и разница с предыдущим днём

# нфт:
данные обновляются с cbr.ru ночью в 00:00 и кэшируются на целый день

# На что смотрим:
умение работать с внешним API и разными форматами данных, писать чистый/аккуратный код, умение работать с кэшем, знание Docker

# Документация к API:
https://www.cbr.ru/development/sxml/