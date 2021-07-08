### Link365 Global Solutions- Technical Exam

Exam is created using Laravel and VueJS.
Things that are provided or used in the repository.
  - Migration
  - Seeder
  - Env
  - Cache

#Setup  
```
clone repository
composer install
npm install
set .env specially ur db
```

#Start
```
php artisan serve
npm run watch
```

#Migration
```
php artisan migrate
php artisan db:seed
```

### Creating Datasource
```
create Class in app/WeatherData
extends Weather class
```

### .Env Keys
```
OPEN_WEATHER_API_KEY=38e6c762ddf2910f247b471d971959ea
OPEN_WEATHER_API_URL=api.openweathermap.org/data/2.5/weather

WEATHER_BIT_API_KEY=0c1a92ef51274748ad92dca7cc4c2b0f
WEATHER_BIT_API_URL=https://api.weatherbit.io/v2.0/current
```
### Sample Display
![image](https://user-images.githubusercontent.com/87002075/124963395-556bcb80-e052-11eb-9bbf-41d612c3cf7b.png)
