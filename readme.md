## PHP Dinero REST wrapper
This is a PHP wrapper for Dinero. Forked from [lasserafn/laravel-dinero](https://github.com/LasseRafn/laravel-dinero).
 
<p align="center"> 
<a href="https://travis-ci.org/LasseRafn/php-dinero"><img src="https://img.shields.io/travis/LasseRafn/php-dinero.svg?style=flat-square" alt="Build Status"></a>
<a href="https://coveralls.io/github/LasseRafn/php-dinero"><img src="https://img.shields.io/coveralls/LasseRafn/php-dinero.svg?style=flat-square" alt="Coverage"></a>
<a href="https://styleci.io/repos/78973710"><img src="https://styleci.io/repos/78973710/shield?branch=master" alt="StyleCI Status"></a>
<a href="https://packagist.org/packages/LasseRafn/php-dinero"><img src="https://img.shields.io/packagist/dt/LasseRafn/php-dinero.svg?style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/LasseRafn/php-dinero"><img src="https://img.shields.io/packagist/v/LasseRafn/php-dinero.svg?style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/LasseRafn/php-dinero"><img src="https://img.shields.io/packagist/l/LasseRafn/php-dinero.svg?style=flat-square" alt="License"></a>
</p>

# Installation

1. Require using composer
````
composer require lasserafn/php-dinero
````

`// todo: add code samples (builders especially!)`

## Requirements
* PHP +5.6

# Getting started
```` php
 $dinero = new \LasseRafn\Dinero\Dinero( $clientId, $clientSecret );
 $dinero->auth( $apiKey, $orgId ); // this WILL send a request to the auth API.
 
 $contacts = $dinero->contacts()->perPage(10)->page(2)->get();
 
 // Do something with the contacts.
````

```` php
 $invoices = $dinero->invoices()->all();
````

```` php
 $products = $dinero->products()->deletedOnly()->all();
````

You can also use an old auth token, if you dont want to auth everytime you setup a new instance of Dinero.

```` php
 $dinero = new \LasseRafn\Dinero\Dinero( $clientId, $clientSecret );
 $dinero->setAuth($token, $orgId); // this will NOT send a request to the auth API.
 
 $products = $dinero->products()->deletedOnly()->all();
````