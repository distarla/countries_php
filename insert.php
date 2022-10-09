<?php
    header( "Content-type: application/json" );

    require_once('connection/connection.php');

    //Insert de um continente
    $novo = $_POST['addContinente'];
    $qNovoContinente = "insert into continentes(continente) values('$novo')";
    if ($conn->query($qNovoContinente) === FALSE) {
        die("Erro no SQL: " . $qNovoContinente . " Error: " . $conn->error);
    } else {
        $lastId = $conn->insert_id;
        $numberRows = $conn->affected_rows;
    }

    $resposta = array('continente'=>$_POST['addContinente']);
    $resposta += array('id'=> $lastId);
    //$resposta += array('idcont'=>99);
    //$resposta += array('numlinhas'=>8);

    //echo $_POST['addContinente'];
    //echo ""
    //$resposta=array('chave'=>99999);
    echo json_encode($resposta);
?>