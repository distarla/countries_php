<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection/connection.php');

//Lista de continentes
$qContinentes = "SELECT id,continente FROM continentes ORDER BY continente";
$rsContinentes = $conn->query($qContinentes);
if ($rsContinentes === FALSE) {
    die("Erro no SQL: " . $qContinentes . " Error: " . $conn->error);
}
$rsContinentes->data_seek(0);
$row_rsContinentes = $rsContinentes->fetch_assoc();
$totalRows_rsContinentes =  $rsContinentes->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="#">
            <div class="mb-3">
                <label for="continente" class="form-label">Continente</label>
                <input type="text" class="form-control" id="continente" name="addContinente">
            </div>
            <button type="submit" class="btn btn-primary">Registar continente</button>
        </form>
        <hr>
        <h3>Lista de Continentes</h3>
        <div class="tabela">
            <?php do { ?>
                <p><?= $row_rsContinentes['continente'] ?></p>
            <?php } while ($row_rsContinentes = $rsContinentes->fetch_assoc()); ?>
        </div>
    </div>
</body>
<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', e => {
        
        e.preventDefault();

        var data = new FormData();
        data.append("addContinente", form.addContinente.value);

        //console.log(form.addContinente.value);
        const inserir = async () => {
            const response = await fetch('http://localhost:4500/sessao9/insert.php', { method: "POST", body: data });
            //const data = await response.json;
            return response.text();
        }

        inserir()
            .then(dataResponse => { 
                console.log('Concluido', JSON.parse(dataResponse));
                const newRecord = JSON.parse(dataResponse);
                const tabela = document.querySelector('.tabela');
                const elemento = document.createElement('p');
                elemento.innerText = newRecord.continente;
                tabela.insertAdjacentElement('afterbegin',elemento)
            })
            .catch(err => {
                console.log('erro', err.message);
            });

    })
</script>
</html>