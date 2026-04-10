<?php
include_once './includes/db.php';

header('Content-Type: application/json');

$section1Data = '';
$section2Data = '';

$users = $db->get_var("select count(*) from usuarios");
$articles = $db->get_var("select count(*) from articulos");
$pendingPonencias = $db->get_var("select count(*) from ponencias where ponencia_estado=1");
$approvedPonencias = $db->get_var("select count(*) from ponencias where ponencia_estado=3");

$section1Data .= "<h1>CFIE - Panel de Control de Ponencias</h1>";
$section1Data .= "<p>Total Usuarios: $users</p>";
$section1Data .= "<p>Total Artículos: $articles</p>";

$section2Data .= "<ul><li>Ponencias Pendientes: $pendingPonencias</li>";
$section2Data .= "<li>Ponencias Aprobadas: $approvedPonencias</li></ul>";

echo json_encode(["section1" => $section1Data, "section2" => $section2Data]);
?>
