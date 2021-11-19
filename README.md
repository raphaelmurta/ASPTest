# ASPTest - Alter Solutions

> Project requested for PHP job vacancy at Alter Solutions.


## 💻 Requirements

Before you start, make sure you have met the following requirements:

* Operational system. `< Windows / Linux / MacOS >`
* You need docker installed on your computer.


* <b>Important</b>
```
 ---> Rename the file .env.example to .env located at the root of the project <--
```
## 🚀 Starting the project ASPTest

To install project, follow these steps:


Step 1 - Clone the repository with following command:
```
git clone https://github.com/raphaelmurta/ASPTest.git
```
Step 2 - Enter in folder project `cd ASPTest`

Step 3 - Run command `docker-compose up -d`

Step 4 - Access PhpMyAdmin url and import in database <b>asptest</b> the file <b>users.sql</b> located at the root of the project

`http://localhost:8080/` - `If phpmyadmin requests username and password -> user: root | password: root`

Step 5 - Run command to install composer `docker exec php-app composer install`

Step 6 (Optional) - Show commands `docker exec php-app ./ASP-TEST` or `docker exec php-app ASP-TEST`


## ☕ Commands 

```
Create user: "docker exec php-app ./ASP-TEST USER:CREATE first_name last_name email age" 
Create password user: "docker exec php-app ./ASP-TEST USER:CREATE-PWD user_id pwd confirm_pwd"
```

## Tests

```
docker exec php-app composer test tests/CreateUserTest.php
docker exec php-app composer test tests/CreateUserPWDTest.php
```

## Info

```
All configuration and database access data are in the file .env.example located in the folder public_html
```

