<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection/connection.php');

$showContinente = false;

if (isset($_GET['continente']) && !empty($_GET['continente'])) {
    $showContinente = true;
    $idContinente = $_GET['continente'];
    $strSQL = "paises.continente=$idContinente";
}

if (isset($_GET['lingua']) && !empty($_GET['lingua'])) {
    $idLingua = $_GET['lingua'];
    $strSQL = "paises.lingua=$idLingua";
}

if (isset($_GET['nomecontinente']) && !empty($_GET['nomecontinente'])) {
    $nomeContinente = $_GET['nomecontinente'];
} else {
    $nomeContinente = "Indefinido";
}

if (isset($_GET['nomelingua']) && !empty($_GET['nomelingua'])) {
    $nomeLingua = $_GET['nomelingua'];
} else {
    $nomeLingua = "Indefinida";
}


//Lista de paises
$qPaises = 
"SELECT paises.*,
continentes.continente as nomeContinente,
linguas.lingua as nomeLingua
FROM paises,continentes,linguas
WHERE paises.continente=continentes.id AND paises.lingua=linguas.id AND $strSQL
ORDER BY pais";
$rsPaises = $conn->query($qPaises);
if ($rsPaises === FALSE) {
    die("Erro no SQL: " . $qPaises . " Error: " . $conn->error);
}
$rsPaises->data_seek(0);
//$row_rsPaises = $rsPaises->fetch_assoc();
$totalRows_rsPaises =  $rsPaises->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php if ($showContinente) { ?>
            <h1>Países do continente: <?= $nomeContinente; ?></h1>
        <?php } else { ?>
            <h1>Países com a língua: <?= $nomeLingua; ?></h1>
        <?php } ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">País</th>
                    <?php if (!$showContinente) { ?>
                        <th scope="col">Continente</th>
                    <?php } else  {?>
                        <th scope="col">Língua</th>
                    <?php } ?>
                    <th scope="col">População</th>
                    <th scope="col">Bandeira</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row_rsPaises = $rsPaises->fetch_assoc()){ ?>
                    <tr>
                        <th scope="row"><?= $row_rsPaises['id']; ?></th>
                        <td><?= $row_rsPaises['pais']; ?></td>
                        <?php if (!$showContinente) { ?>
                            <td><?= $row_rsPaises['nomeContinente']; ?></td>
                        <?php } else { ?>  
                            <td><?= $row_rsPaises['nomeLingua']; ?></td>
                        <?php } ?>
                        <td><?= $row_rsPaises['populacao']; ?></td>
                        <td><img src="images/<?= $row_rsPaises['bandeira']; ?>" style="max-width:75px;"></td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>
<?php
$rsPaises->free();
$conn->close();
?>