<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 14:53
 */

include_once 'Service/ServicePdo.php';

$pdo = new \Service\ServicePdo();
$query = "
    CREATE TABLE `user`(
        `id` INT NOT NULL AUTO_INCREMENT COMMENT 'id',
        `login` VARCHAR(255) NOT NULL COMMENT 'login',
        `password` VARCHAR(255) NOT NULL COMMENT 'password',
        `PHPSESSID` VARCHAR(255) NOT NULL COMMENT 'PHPSESSID',
        PRIMARY KEY (`id`)
    );
";
$pdo->exec($query);
$query = "
    CREATE TABLE `purse`(
        `id` INT NOT NULL AUTO_INCREMENT COMMENT 'id',
        `money` INT NOT NULL COMMENT 'средства на счете',
        `transactionCode` INT NOT NULL COMMENT 'код для подтверждения транзакции',
        PRIMARY KEY (`id`)
    );
";
try {
    $pdo = new ServicePdo();
} catch(PDOException $e) {
    echo $e->getMessage();
}
$pdo->exec($query);

$query = "
    CREATE TABLE `user_purse__link`(
        `id` INT NOT NULL AUTO_INCREMENT COMMENT 'id',
        `User__id` VARCHAR(255) NOT NULL COMMENT 'user id',
        `Purse__id` VARCHAR(255) NOT NULL COMMENT 'purse id',
        PRIMARY KEY (`id`)
    );
";
$pdo->exec($query);

$user = [
    'user' => [
        'id' => '100',
        'login' => 'admin',
        'password' => 'admin',
        'PHPSESSID' => '',
    ],
    'purse' => [
        'id' => '100',
        'money' => '10000',
        'transactionCode' => 0,
    ],
    'user_purse__link' => [
        'User__id' => 100,
        'Purse__id' => 100,
    ],

];
$query = '';
foreach ($user as $tableName => $table) {
    $query .= 'INSERT INTO `'. $tableName .'` (';
    foreach ($table as &$val) {
        $val = '"' . $val . '"';
    }
    $query .= implode(', ', array_keys($table));
    $query .= ') ';
    $query .= 'VALUES (';
    $query .= implode(', ', $table);
    $query .= ');' . PHP_EOL;
}
$pdo->exec($query);
