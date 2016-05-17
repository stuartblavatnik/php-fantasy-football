<?
/*
    This code was used to demonstrate communication with an applet
*/

include_once("../include/database.php");

OpenDatabase();

$qry = "Select * FROM fb_Egg_2002_fantasy_team Where Name='$name'";
$result = mysql_query($qry);
$row = mysql_fetch_object($result);

if ($row->Password == $password)
{
    print "Y";
}
else
{
    print "N";
}

mysql_free_result($result);
?>