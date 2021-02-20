<?php

require_once('config.php');

$dbh = new PDO("mysql:host=$host;dbname=$bd;charset=UTF8", "$login", "$password");

function query(string $sql, array $param = [])
{
    global $dbh;
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute($param);
    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }

    return $sth;
}
