## What is Remember-list?
* List of items that must be remembered for Todo
* Add/Delete an item to the list
* Push Notification, when someone create an Item

![](https://raw.githubusercontent.com/majdothman/remember-list/master/public/assets/img/remember-list.gif)

## System
* Apache/Nginx  server
* Php

## How to install
* Clone this Repository: https://github.com/majdothman/remember-list.git
* If you use: ddev & docker:
    * $ ddev ssh
* $ composer install
* Set Database
    *  in ./.env -> customize this line: # DATABASE_URL=mysql://db:db@db:3306/db
* $ php bin/console make:migration
* $ php bin/console doctrine:migrations:migrate

