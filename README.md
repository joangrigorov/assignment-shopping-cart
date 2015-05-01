Saxophone shop
=======================

Introduction
------------
This an example of a very simple shopping cart.
Demonstrates Domain-Driven Design implementation with Doctrine 2 and Zend Framework 2.

Installation
------------

Get composer
----------------------------
In order to get the dependencies you need to get composer first:

    curl -s https://getcomposer.org/installer | php --

After that you need to install the dependencies:

    php composer.phar install

Import the database
----------------------------
Although Doctrine 2 can build up the entire database scheme with nothing else but entities,
I suggest you to import the SQL dump from database/dump.sql

Database configuration
----------------------------
Using config/autoload/doctrine.local.php.dist as a template, create a file named doctrine.local.php in the same directory.
You should enter your database options there such as user, host, password, etc.

Folder permissions
----------------------------
You need to set write permissions on data/ folder and its subfolders