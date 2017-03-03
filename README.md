# Shoe Store

#### Epicodus PHP Week 4 project, 3/2/2017

#### By Sarah Leahy

## Description

Shoe store application that allows a user to search brands by shoe store.

## Setup/Installation Requirements
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Macs.
* See https://getcomposer.org for details on installing _composer_.
* Clone repository
* Open MAMP- see https://www.mamp.info/en/downloads/ for details on installing _MAMP_
* Open localhost:8888/phpmyadmin in browser
* Go to import tab
* Install shoe_store.zip.sql to access database structure
* From project root, run > composer install --prefer-source --no-interaction
* Go to MAMP settings set MAMP>Preferences>Web Server>Document Root to shoe_store/web
* Restart MAMP server
* open localhost:8888 in browser

## Known Bugs
* No known bugs

## Specifications

| Behavior - Our Program should Handle?| Input         | Output |      
|---| --- | --- |        
|  Accept one shoe store | Macys | Macys |
|  Save shoe store to database via save button. | Macys  |  in db- 1.Macys|
|  Accept multiple stores and save them to db and output list. | Macys, Nordstrom |  in db- 1.Macys, 2.Nordstrom|
|  Accept brand name in relation to store. | brand = Adidas, store = Macys| in db-brand = Adidas, store = Macys|
|  Accept multiple brands per store | brand = Adidas , store = Nordstrom| Brand= Nike,  store = Macys, Nordstom |
|  Get complete brand list | get all brands   |Adias, Nike, ugg|
|  Get complete store list | get all stores     |Macys, Nordstrom |
|  Get all brands by store|  get all brands for Macys | Adidas, Nike|
|  Get all stores by brand|  get all stores that sell Nike| Macys, Nordstrom|
|  Update store name | Nordstrom   |JC Pennys |
|  Delete store. | Nordstrom |  Deleted|
|  Delete all stores and brands. | delete all |  "no stores or brands"|


## Support and contact details
no support

## Technologies Used
* PHP
* Composer
* Silex
* Twig
* HTML
* CSS
* Bootstrap
* Git
* MySQL

## Copyright (c)
* 2017 Sarah Leahy

## License
* MIT
