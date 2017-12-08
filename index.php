<?php
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'funktsioon.php';
$rows_raw = $conn->query("SELECT * FROM register");
foreach ($rows_raw as $row) {
    $name=getname($row['isikukood']);
    $rows[] = [
        'idReg'=>$row['idReg'],
        'nameReg'=>$name['person_first_name'],
        'surnameReg'=>$name['person_last_name'],
        'company'=>$row['company'],
        'aadress'=>$row['aadress'],
        'kapital'=>$row['kapital'],
        'internetAadress'=>$row['internetAadress'],
        'staatus'=>$row['staatus'],
        'isikukood'=>$row['isikukood'],
    ];
}
$kap_s = (string)$row['kapital'];
foreach ($rows_raw as $row) {
    $name=getname($row['isikukood']);
    $encoded = array($row['idReg'], $name['person_first_name'], $name['person_last_name'], $row['company'], $row['aadress'], $row['internetAadress'], $kap_s);
    echo json_encode($encoded);
}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
</head>
<body>

<!-- Nav Bar-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            </ul>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Eesnimi</th>
                <th>Perenimi</th>
                <th>Isikukood</th>
                <th>Äri</th>
                <th>Aadress</th>
                <th>Kapital</th>
                <th>Veebileht</th>
                <th>Staatus</th>
            </tr>
            <?php
            foreach( $rows as $data )
            {
                echo "<tr>
                          <td>".$data['idReg']."</td>
                          <td>".$data['nameReg']."</td>
                          <td>".$data['surnameReg']."</td>
                          <td>".$data['isikukood']."</td>
                          <td>".$data['company']."</td>
                          <td>".$data['internetAadress']."</td>
                          <td>".$data['kapital']."</td>
                          <td>".$data['aadress']."</td>
                          <td>".$data['staatus']."</td>
                       </tr>";
            }
            ?>

        </table>
    </div>
</nav>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
