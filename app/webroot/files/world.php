<?php
$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction

$searchTerm = $_GET['searchTerm'];
if(!$sidx) $sidx =1;
/*if ($searchTerm=="") {
	$searchTerm="%";
} else {
	$searchTerm = $searchTerm . "%";
}
*/


$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "Doncyberiomysql";
$database = "sport_center";

// connect to the database
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error());

mysql_select_db($database) or die("Error conecting to db.");
$result = mysql_query("SELECT COUNT(*) AS count FROM Ciudades WHERE Ciudad like '$searchTerm%'");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
if($total_pages!=0)
{
    $SQL = "SELECT * FROM Ciudades WHERE Ciudad LIKE '$searchTerm%'  ORDER BY $sidx $sord LIMIT $start , $limit";
}else{ 
    $SQL = "SELECT * FROM Ciudades WHERE Ciudad LIKE '$searchTerm%'  ORDER BY $sidx $sord";
}

$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

class response
{
    
}

$response = new response();

$response->page = $page;
$response->total = $total_pages;
$response->records = $count;

$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
/*
    $response->rows[$i]['id']=$row[id];
    $response->rows[$i]['cell']=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);
*/
    $response->rows[$i]['idCiudades']=$row['idCiudades'];
    $response->rows[$i]['Ciudad']=$row['Ciudad'];
    $response->rows[$i]['Paises_Codigo']=$row['Paises_Codigo'];
    //$response->rows[$i]=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]);
    $i++;
}        
echo json_encode($response);
