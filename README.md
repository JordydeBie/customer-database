# Customer database
Customer Database is a CRUD app with an intuitive UI that allows users to create, read, update and delete customer records. Its intended use is small businesses like restaurants, shops and so forth. Users can store information such as full name, email and telephone number. They can also add comments or remarks.

## Getting started

### Prerequisites
This app presumes that you have a local host set up like MAMP or XAMPP. 

### Installation
- copy all of the files of this repository to your htdocs folder except for this file (readme.md).
- click “Open Webstart page” on the MAMP window
- click on the hyperlink “phpMyAdmin” in the MySQL section
- click on the “SQL” button, use the following statement and press “GO”:  ```CREATE DATABASE customer_database;```
- click on the “SQL” button again, use the following statement and press “GO”: 
```CREATE TABLE customer (
customer_id INTEGER NOT NULL
    AUTO_INCREMENT KEY,
first_name VARCHAR(128),
last_name_prefix VARCHAR(128),
last_name VARCHAR(128),
email VARCHAR(128),
telephone VARCHAR(15),
remarks VARCHAR(255)
) ENGINE=InnoDB CHARSET=utf8;
```
-  navigate to you localhost folder with your webbrowser to use your app

## Built with
- PHP
- MySQL
- HTML
- CSS (Bootstrap)

## Author
Jordy de Bie

## License
This app is completely open-source, there is no license. You can tweak this app as you please and use it as much as you want. 
