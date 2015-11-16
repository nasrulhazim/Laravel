# Laravel
Laravel functions and helpers

# usage view generate console

create console skeleton using php artisan

```php
php artisan make:console GenerateView --command=make:view
```

```
copy this code into it
```


add into Console/kernel for registering
```
 \App\Console\Commands\GenerateView::class,
```

```
usage : php artisan make:view example.blade.php --path=folder --content=optional
```
