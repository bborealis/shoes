# Registrar with MySQL

##### App that lists shoe stores and the brands of shoes they carry (8/28/15)

#### Brian Borealis

## Description

This application allows users to input shoe stores and brands of shoes and assign shoes to stores.

## Setup
* Clone the project using the link provided on Github.
* Run composer install in Terminal from the project root folder.
* Start the PHP server from Terminal in the /web folder.
* Open a web browser and navigate to ```localhost:8000```.
* Unzip .sql files and export to database.


## Technologies Used

PHP, PHPUnit, Silex, Twig, and MySQL

## MySQL commands
CREATE DATABASE shoestore;
USE shoestore;
CREATE TABLE stores (name VARCHAR (255), id serial PRIMARY KEY);
CREATE TABLE brands (name VARCHAR (255), id serial PRIMARY KEY);
CREATE TABLE stores_brands (store_id INT, brand_id INT, id serial PRIMARY KEY);

### Legal

Copyright (c) 2015 Brian Borealis

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
