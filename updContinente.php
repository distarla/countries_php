<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection/connection.php');

if (isset($_GET['idContinente']) && !empty($_GET['idContinente'])) {
    $idContinente = $_GET['idContinente'];
    $qContinente = "select id, continente from continentes where id = ?";
    $psContinente = $conn->prepare($qContinente);
    if ($psContinente === FALSE) {
        die("Erro no SQL: " . $qContinente . " Error: " . $conn->error);
    }
    $psContinente->bind_param('i',$idContinente);
    $psContinente->execute();
    $psContinente->bind_result($id,$nomeContinente);
    $psContinente->fetch();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Continente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3>Editar Continente</h3>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="continente" class="form-label">Continente</label>
                <input type="text" class="form-control" id="continente" name="editContinente" value="<?= $nomeContinente; ?>">
                <input type="hidden" name="idContinente" value="<?= $id; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar continente</button>
        </form>
    </div>
</body>

</html>