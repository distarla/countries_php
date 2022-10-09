<?php
    session_start();

    require_once('connection/connection.php');

    if (isset($_POST['userId']) && !empty($_POST['userId']) && isset($_POST['passwordKey']) && !empty($_POST['passwordKey'])) {
        $utilizador = $_POST['userId'];
        $palavraChave = $_POST['passwordKey'];
        $qUtilizador = "select utilizador,palavrachave from utilizadores where utilizador=? and palavrachave=md5(?)";
        $psUtilizador = $conn->prepare($qUtilizador);
        if ($psUtilizador === FALSE) {
            die("Erro no SQL: " . $qUtilizador . " Error: " . $conn->error);
        }
        $psUtilizador->bind_param('ss',$utilizador,$palavraChave);
        $psUtilizador->execute();
        //$psUtilizador->bind_result($user,$palavra);
        if ($psUtilizador->fetch() == 1) {
            //encontrou username e password
            $_SESSION['utilizador'] = $utilizador;
            header("Location: index.php");
        } else {
            unset($_SESSION['utilizador']);
            header("Location: login.php?errMsg=Utilizador ou Password errados!");
        }
    }
?>