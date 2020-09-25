<?php
include 'html_dom.php';
$or = $_POST['origin'];
$des = $_POST['destination'];
$html = file_get_html('https://www.distance.to/'.$or.'/'.$des);
$distanceInKM = $html->find('span[class=value km]')[1];
echo $distanceInKM;
?>
