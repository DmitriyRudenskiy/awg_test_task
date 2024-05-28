# Для запуска на боевом сервере необходимо прописать в CRON
* * * * * cd директория где находится проект && php artisan schedule:run >> /dev/null 2>&1

# Собираем контейнеры
docker-compose up -d --build app

# Прописываем настройки
DB_HOST=mysql
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

# Запускаем миграции
php artisan migrate
php artisan migrate:fresh --seed

# Запуск команды в ручную 
php artisan currency:synchronize

# Заходим в контейнер
docker exec -it awg_test_task-php-1 sh

# Настройка
Примечание. Имя хоста вашей базы данных MySQL должно быть mysql, а не localhost.

# Структура приложения
├── dockerfiles  # Директория для хранения докер-файлов необходимых сервисов
│   ├── app
│   │   ├── Dockerfile
│   │   └── ...
│   └── nginx
│       ├── Dockerfile
│       └── ...
├── src  # Исходники приложения
│   ├── app
│   ├── bootstrap
│   ├── config
│   ├── artisan
│   └── ...
├── docker-compose.yml  # Compose-конфиг для запуска
├── Makefile
├── CHANGELOG.md
└── README.md
