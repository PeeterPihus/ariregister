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
$encoded = array(
    'idReg'=>$row['idReg'],
    'nameReg'=>$name['person_first_name'],
    'surnameReg'=>$name['person_last_name'],
    'company'=>$row['company'],
    'aadress'=>$row['aadress'],
    'kapital'=>$row['kapital'],
    'internetAadress'=>$row['internetAadress'],
    'staatus'=>$row['staatus'],
    'isikukood'=>$row['isikukood'],
);
json_encode($encoded);
?>
