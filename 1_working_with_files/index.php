<?php
    if (isset($_POST['submit'])) {
        if (isset($_FILES['file']) && (new SplFileInfo($_FILES['file']["name"]))->getExtension() === 'csv'){
            require_once ('parseFile.php');
            $parseFile = new ParseFileToTable($_FILES['file']);
            $respons = $parseFile->createTable();
        }else{
            $respons = 'добавлен не корректный файл';
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>1 Work whith files</title>
</head>
<body>
<div class="container">
    <h3>Добавте файл csv формате (название|артикул|номер категории|стоимость)</h3>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlFile1">добавить файл</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="отправить">
        </div>
    </form>
    <br>
    <? if(isset($respons)) echo $respons ?>
</div>
</body>
</html>