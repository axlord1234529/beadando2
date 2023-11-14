<?php
include_once "D:\\xampp\htdocs\beadando2\includes\database.inc.php";

$eredmeny = "";
header('Content-Type: application/json'); 
try {
    $db = Database::getConnection();
    
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $result = $db->query("SELECT * FROM hely");
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            $eredmeny = json_encode($rows);
            break;

        case "POST":
            // Assuming you have the necessary data in the request body
            $data = json_decode(file_get_contents("php://input"), true);
            $sql = "INSERT INTO hely (telepules, utca) VALUES (:telepules, :utca)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':telepules', $data['telepules']);
            $stmt->bindParam(':utca', $data['utca']);
            $stmt->execute();
            $eredmeny = "Record inserted successfully!";
            break;

        case "PUT":
            $data = json_decode(file_get_contents("php://input"), true);
            $sql = "UPDATE hely SET telepules = :telepules, utca = :utca WHERE az = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':telepules', $data['telepules']);
            $stmt->bindParam(':utca', $data['utca']);
            $stmt->bindParam(':id', $data['id']);
            $stmt->execute();
            $eredmeny = "Record updated successfully!";
            break;

        case "DELETE":
            $data = json_decode(file_get_contents("php://input"), true);
            $sql = "DELETE FROM hely WHERE az = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->execute();
            $eredmeny = "Record deleted successfully!";
            break;
    }
} catch (PDOException $e) {
    $eredmeny = $e->getMessage();
}

echo $eredmeny;
?>