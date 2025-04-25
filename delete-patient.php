<?php
include_once("database.php");

$id = $_GET['id'];

$stmt = $mysqli->prepare("DELETE FROM tbl_patient WHERE patient_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit;
