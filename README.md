git clone https://github.com/kadavalahiren/category-repo
cd category-repo
cp .env.example .env
composer install
php artisan migrate     # or import database manually
php artisan serve
