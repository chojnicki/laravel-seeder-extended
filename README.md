# Laravel Seeder Extended

Extend default Seeder with extra funcionality.

NOTE: This library mixes my [laravel-seeder-debugger](https://github.com/chojnicki/laravel-seeder-debugger) with extra methods. 
If you do not wanna use any methods listed below and just need debugger, you can just use 
[chojnicki/laravel-seeder-debugger](https://github.com/chojnicki/laravel-seeder-debugger) instead.


## Requirements

- Laravel / Lumen 5.5 or higher (written on 5.8, not tested on lower than 5.5 but should work on 5.*)


## Instalation with Composer

```
composer require chojnicki/laravel-seeder-extended
```


## Usage

In DatabaseSeeder.php simply replace:
```
use Illuminate\Database\Seeder;
```
with:
```
use Chojnicki\LaravelSeederExtended\Seeder;
```


## Available methods

### insertMultiple($collection, $chunkSize = 1000, $sorted = true)

If you use Factory to create for example 10,000 posts then saving them will cause 10,000 queries to database (what will be slow).
You can insert multiple items to database with single query passing collection of models to insertMultiple(). 

Be default 1000 models will be inserted in single query. 
For models with long data you can decrease this, and for very small models increase. Try to find sweet spot that will be fastest for you ;)

Records will be inserted sorted from the oldest to newest. You can disable this at third parameter and use custom sorting instead.

```
$this->insertMultiple($posts);
```



### setRandomDate($model, $max = 15552000)

Short way to generate random date (for created_at and updated_at at once) on model. 
De default range is 6 months and you can change this in second parameter (in seconds).
Method will return Carbon date if you need to use it somewhere else.

```
$this->setRandomDate($post);
```


### Any ideas for more? Feedback and pull requests are welcome :)


## Debug
After finished seeding console will debug info like this:
```
Database seeding completed successfully.
Seeding execution time: 8.6s.
Database queries executed: 329.
Current RAM usage is 18.7MB with peak during execution 59.1MB.
```
Thanks to this info you can try to write more efficient seeders :)

[More info -> chojnicki/laravel-seeder-debugger](https://github.com/chojnicki/laravel-seeder-debugger)

## Note
This debugger simply extends original Seeder library (it's not a fork) so all functionality is preserved and there should not be conflicts with already written seeders.
