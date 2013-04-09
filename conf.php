<?php

ORM::configure('mysql:host=localhost;dbname=petre_hanbud');
ORM::configure('username', 'petre_hanbud');
ORM::configure('password', 'pTRNCs9I');

//ORM::configure('username', 'root');
//ORM::configure('password', '');

ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
?>
