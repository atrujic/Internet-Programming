In this project I made a dynamic website using HTML, CSS, PHP and MYSQL. I implemented registration and login system, session storage, and ability to fetch all registered users and display them in table.

## Tools used

HTML, CSS, Bootstrap, PHP, MYSQL, XAMPP and Visual Studio Code as an IDE

## Purpose of the project

Purpose for developing this project is getting familiar with making dynamic websites using PHP and MYSQL.

## How to run

1. Clone repository to your local machine
2. Copy user-registration folder from source folder into C:\xampp\htdocs\ folder
3. Open XAMPP and start apache and MySQL server
4. In phpMyAdmin, create database called "user_registration" and table called "users" with 5 columns: <br>
   id - integer, length 11, primary key, auto icrement <br>
   name - varchar, length 100 <br> 
   email - varchar, length 100, unique <br>
   token - varchar, length 200 <br>
   password - varchar, length 255 <br>
5. In constants.php file which is located in config folder, change DB_PORT value from 3307 to 3306
6. Open browser and navigate to: localhost/user-registration/signup.php

## Note

I had to change MySQL port to 3307 instead of default 3306, as the default port was already in use for something else on my machine.
Solution: https://www.quora.com/How-do-I-change-the-port-of-a-MySQL-server-in-XAMPP
