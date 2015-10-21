RESO Compliance Testing Tool
============================


Introduction
------------

Installation
------------

Database
--------
open config/autoload/global.php and config/autoload/local.php and configure
your Database credentials.

if local.php is missing duplicate local.php.dist and modify the file

    // /config/autoload/local.php
    return array(
        'db' => array(
            'username' => 'DB_User_Name',
            'password' => 'DB_Password',
        ),
    );

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go!
