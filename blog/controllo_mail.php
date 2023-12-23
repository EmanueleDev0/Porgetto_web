<?php

$connessione = require __DIR__ . "/connessione_db.php";

$sql = "SELECT * FROM lettori WHERE Email = :email 
        UNION 
        SELECT * FROM giornalisti WHERE Email = :email";


$stmt = $connessione->prepare($sql);
$stmt->bindParam(':email', $_GET["email"], PDO::PARAM_STR);
$stmt->execute();

// Fetch dei risultati
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se l'email è disponibile
$is_available = empty($result);

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);