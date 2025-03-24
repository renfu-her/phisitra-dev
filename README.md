# phisitra-dev

## 安裝
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

## 遷移網站
```
php artisan vendor:publish --force --tag=livewire:assets
php artisan filament:assets
php artisan filament:cache-components
```