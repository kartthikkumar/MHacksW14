<!DOCTYPE HTML>
<head>

	<title>
	Processing Information
	</title>

</head>


<body>
<?php 
$link = mysql_connect('localhost', 'root', '');
if (!$link){
	die("dead ". mysql_error());
}

$db_selected = mysql_select_db('mhackdatabase', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}
$username = $_GET["username"];
$password = $_GET["password"];
$success = mysql_query('INSERT INTO `tableee` (`id`, `username`) VALUES (9001, "strrrrring")');
if(!$success){
	die('dieee ' . mysql_error());
}
?>
	<h1> Hello Everyone </h1>
</body>

</html>