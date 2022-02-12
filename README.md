git clone project
cp .env.example .env
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
npm install
npm run dev
php artisan ser
php artisan test (consola aparte)
