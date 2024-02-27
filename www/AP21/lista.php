<?php
require_once "autoloader.php";
$cartera= new Cartera('data.csv');
$id = isset($_GET['id']) ? $_GET['id'] : null;
$client = $cartera->getClient($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <table class="redTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Company</th>
                <th>Investment</th>
                <th>Date</th>
                <th>Active</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="8">

                </td>
            </tr>
        </tfoot>
        <tbody>
			<?=$cartera->drawlist()?>
        </tbody>
    </table>


</body>
</html>
