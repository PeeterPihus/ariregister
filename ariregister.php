<?php
ob_start();
session_start();
require_once 'dbconnect.php';
require_once 'funktsioon.php';
//if (!isset($_SESSION['userName'])) {
//    header("Location: index.php");
//    exit;
//}
//$res = $conn->query("set names utf8");
//$res = $conn->query("SELECT * FROM users WHERE idUser=" . $_SESSION['userName']);
//$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
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
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello,<?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
</head>
<body>

<!-- Nav Bar-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Äriregister</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="ariregister.php">Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"-->
<!--                       aria-expanded="false">-->
<!--                        <span-->
<!--                            class="glyphicon glyphicon-user"></span>&nbsp;Logged-->
<!--                        in: --><?php //echo $userRow['name']; ?><!-- --><?php //echo $userRow['surname']; ?>
<!--                        &nbsp;<span class="caret"></span></a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
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
