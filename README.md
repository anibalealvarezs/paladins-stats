# Paladins Statistics

### Instructions for installation:

#### 0. Pre-installation check:

If [Project Builder](https://github.com/anibalealvarezs/projectbuilder-package) ***WASN'T*** installed previously, go to that repository and follow the installation process before continuing

#### 1. Require the package
```
composer require anibalealvarezs/paladins-stats --no-cache
```

#### 2. Add the following vars to your .env file
```dotenv
PALADINS_DEVID=XXXX
PALADINS_AUTHKEY=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

#### 2. Clear config cache
```
php artisan config:clear
```

#### 3. Migrate the DB
```
php artisan migrate
php artisan db:seed --class=\\Anibalealvarezs\\Paladins\\Database\\Seeders\\PsMainSeeder
```

#### 4. OPTIONALLY, seed the DB step by step
These are the default seeders in case you want to run them manually
```
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsModuleSeeder"
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsConfigSeeder"
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsPermissionsSeeder"
php artisan db:seed --class="Anibalealvarezs\Paladins\Database\Seeders\PsNavigationSeeder"
```

### 5. Publish Vue components and libraries
Publish all necessary files
```
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-views" --force
```
or publish them one by one
```
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-components" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-js" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-css" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-blade" --force
php artisan vendor:publish --provider="Anibalealvarezs\Paladins\Providers\PsViewServiceProvider" --tag="paladins-core" --force
```

### 6. Add resources to /webpack.mix.js
```

```

### 7. Install new resources as dependencies
```

```

### 8. Recompile app.js
For production:
```
npm run prod
```
For developing:
```
npm run watch
```

### Useful Commands:

```
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan view:cache

php artisan clear-compiled
composer dump-autoload
php artisan optimize
```
