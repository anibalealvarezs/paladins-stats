# Paladins Statistics

### Instructions for installation:

#### 0. Pre-installation check:

If [Project Builder](https://github.com/anibalealvarezs/projectbuilder-package) ***WASN'T*** installed previously, go to that repository and follow the installation process before continuing

#### 1. Require the package
```shell
composer require anibalealvarezs/paladins-stats --no-cache
```

#### 2. Add the following vars to your .env file
```dotenv
PALADINS_DEVID=XXXX
PALADINS_AUTHKEY=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

#### 3. Add the following vars to your ```/config/app.php``` file
```php
/*
|--------------------------------------------------------------------------
| Paladins Credentials
|--------------------------------------------------------------------------
|
| Paladins Credentials for communicating with Paladins API
|
*/

'paladins_devid' => env('PALADINS_DEVID'),

'paladins_authkey' => env('PALADINS_AUTHKEY'),
```

#### 4. Clear config cache
```shell
php artisan config:clear
```

#### 5. Migrate the DB
```shell
php artisan migrate
php artisan db:seed --class=\\Anibalealvarezs\\Paladins\\Database\\Seeders\\PsMainSeeder
```

#### 6. OPTIONALLY, seed the DB step by step
These are the default seeders in case you want to run them manually
```shell
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsModuleSeeder"
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsConfigSeeder"
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsPermissionsSeeder"
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsNavigationSeeder"
```

### 7. Publish Vue components and libraries
Publish all necessary files
```shell
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-views" --force
```
or publish them one by one
```shell
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-components" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-js" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-css" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-blade" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-core" --force
```

### 8. Add resources to /webpack.mix.js
```javascript

```

### 9. Install new resources as dependencies
```javascript

```

### 10. Recompile app.js
For production:
```shell
npm run prod
```
For developing:
```shell
npm run watch
```

### Useful Commands:

```shell
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan view:cache

php artisan clear-compiled
composer dump-autoload
php artisan optimize
```
