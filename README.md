# Hotlibrary

![Hotlibrary Logo](img/hotlibrary-logo.png)

Hotlibrary is a library management system. The users can be consultation all the library collection and make book loan request.

## How to install

To install the Hotlibrary in your local computer you need:

* Composer
* Bower
* Web Server
* PHP > 5
* PostgreSQL

Clone this project in you machine with git:
```
  git clone https://github.com/cronodev/hotlibrary.git
```

After that run __Composer__ and __bower__ inside the project folder to download the project
dependencies:

```
bower install
```

```
composer install
```

To finish the installation get the database script and run in PostgreSQL.

```
hotlibrary/db/database.sql
```
The last step is configurate the database in the project. The path is:
```
hotlibrary/application/config/database.php
```
Set the __username__, __password__ and __database__. Default values:
* username: postgres
* database: HOTLIBRARY
* password: _yourPassword_
