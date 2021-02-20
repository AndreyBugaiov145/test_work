<?php

require_once('DbConaction.php');
require_once('user.php');

query("CREATE  TABLE users(id INT AUTO_INCREMENT NOT NULL,email VARCHAR(255),status INT,PRIMARY KEY (id))");

$user = new User;

