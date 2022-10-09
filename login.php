<?php
session_start();
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
        <form action="userLogin.php" method="POST">
            <div class="mb-3">
                <label for="userId" class="form-label">Username</label>
                <input type="text" class="form-control" id="userId" name="userId">
                <label for="passwordKey" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordKey" name="passwordKey">
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>
        </form>
        <?php
            if (isset($_GET['errMsg'])) {
                echo "<p>".$_GET['errMsg']."</p>";
            }
        ?>
    </div>
</body>

</html>