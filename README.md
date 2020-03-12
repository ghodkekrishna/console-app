console-app
=============

This is command line tool helps to export CSV file with month-wise salary and bonus dates

Prerequisites
-------------
This is standalone application. You need composer installed on your system to install this application.

Installation
------------

1. Clone using ```git clone https://github.com/krushnaghodke/console-app``` 
2. Install project dependencies using composer. Go in project directory and run ```Composer install```
3. After installing all dependencies run command ```php bin/console export:salary-dates```
4. You will get success message in console "File created successfully!".
5. Now check CSV file in ```public/files``` folder of code.

PHPUnit 
------------
For unit testing i used PHPUnit so run following command to execute the test cases.

```php
 ./vendor/bin/phpunit
```