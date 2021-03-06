<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 14:53
 */

spl_autoload_register(function ($class_name) {
    $class_name = __DIR__ . '/../'
        . str_replace('\\', '/', $class_name);
    require_once $class_name . '.php';
});

use Service\ServicePdo;

$pdo = new ServicePdo();
$query = "
    CREATE TABLE `user`(
        `id` INT NOT NULL AUTO_INCREMENT COMMENT 'id',
        `login` VARCHAR(255) NOT NULL COMMENT 'login',
        `password` VARCHAR(255) NOT NULL COMMENT 'password',
        `PHPSESSID` VARCHAR(255) NOT NULL COMMENT 'PHPSESSID',
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;
";
$pdo->exec($query);
$query = "
    CREATE TABLE `purse`(
        `id` INT NOT NULL AUTO_INCREMENT COMMENT 'id',
        `money` INT NOT NULL COMMENT 'средства на счете',
        `transactionCode` INT NOT NULL COMMENT 'код для подтверждения транзакции',
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;
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
  `User__id` INT NOT NULL COMMENT 'user id',
  `Purse__id` INT NOT NULL COMMENT 'purse id',
  PRIMARY KEY (`id`),
  INDEX (User__id, Purse__id),
  FOREIGN KEY (User__id)
  REFERENCES user(id)
    ON UPDATE CASCADE,
  FOREIGN KEY (Purse__id)
  REFERENCES purse(id)
    ON UPDATE CASCADE
) ENGINE = InnoDB;
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
