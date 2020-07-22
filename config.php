<?php 
$conn= new mysqli("localhost:3308","root","","phpcrud");
if($conn->connect_error){
    die("Cloud not connect to the database".$conn->connect_error);
}
// if (!$mysqli->query("SET name=fdfdf")) {
//     print_r($mysqli->error_list);
// }
// $mysqli->close();
?>