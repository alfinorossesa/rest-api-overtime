### Note :
Laravel 8

## Application Install Instructions

1. copy _.env.example_ into _.env_ 
2. Setup _database_ in _.env_ 
3. Run `php artisan config:cache`
4. Run `php artisan key:generate`
5. Run `php artisan migrate`
6. `php artisan serve`

## Routes

```
PATCH   /api/settings
@body: key, value

POST   /api/employees
@body: name, status_id, salary

GET   /api/employees
@params: order_type[asc, desc], order_by[name, salary], per_page, page

POST   /api/overtimes
@body: employee_id, date[YYYYmmdd], time_started[Hi], time_ended[Hi]

GET   /api/overtimes
@params: date_started[YYYY-mm-dd], date_ended[YYYY-mm-dd]

GET  /api/overtime-pays/calculate
@params: month[YYYY-mm]
```
