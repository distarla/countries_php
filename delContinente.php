<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection/connection.php');

if (isset($_GET['idContinente']) && !empty($_GET['idContinente'])) {
    $idContinente = $_GET['idContinente'];
    $qContinente = "delete from continentes where id = ?";
    $psContinente = $conn->prepare($qContinente);
    if ($psContinente === FALSE) {
        die("Erro no SQL: " . $qContinente . " Error: " . $conn->error);
    }
    $psContinente->bind_param('i',$idContinente);
    $psContinente->execute();
    $psContinente->close();
}

header("Location: index.php");
?>