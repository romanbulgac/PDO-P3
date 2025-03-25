<?php
require_once "connections/connection.php";
$sql1 = "DROP PROCEDURE IF EXISTS addMatematiceni";
$sql2 = "CREATE PROCEDURE IF NOT EXISTS addMatematiceni(IN name VARCHAR(255), IN surname VARCHAR(255), IN age INT, IN country VARCHAR(255))
        BEGIN
            INSERT INTO matematiceni (name, surname, age, country) VALUES (name, surname, age, country);
        END";

$stmt1 = $con->prepare($sql1);
$stmt2 = $con->prepare($sql2);
$stmt1->execute();
$stmt2->execute();

$stmt = $con->prepare("CALL addMatematiceni(
    :name, :surname, :age, :country
)");
$name = "Leonhard";
$surname = "Euler";
$age = 76;
$country = "Switzerland";

$stmt->execute([
    'name' => $name,
    'surname' => $surname,
    'age' => $age,
    'country' => $country
]);