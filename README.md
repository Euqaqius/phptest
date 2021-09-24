# phptest
1. Установка зависимостей<br/>
composer install
2. Создание БД<br/>
php bin/console doctrine:database:create <br/>
3. Миграция<br/>
php bin/console doctrine:migration:migrate<br/>
4. Заполнение БД<br/>
php bin/console fill-database<br/>
