<?php

include 'cineworld.php';

if (isset($_GET["CINEMA"])) {
	header( 'Location: cinema.php?CINEMA=' . $_GET["CINEMA"]) ;
}

?>

<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<title>Cineworld App</title>
<link title="style" type="text/css" rel="stylesheet" href="iphone.css"/>
</head>
<body>
<img align="left" src="png/header.png" alt="Cineworld Listings">
<br>
<p>
<?php
	print list_cinemas();
?>

</body>
</html>