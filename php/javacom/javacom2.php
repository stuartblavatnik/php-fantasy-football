<?
include_once("../include/database.php");

OpenDatabase();

$qry = "INSERT Into Soup (Name, Description, Price) VALUES('$var1', '$var2', '2.45')";
mysql_query($qry);

    $file = fopen("./stuart.txt", "w");
    fwrite($file, "AAAAAAAAAAA");
    fwrite($file, $value);

    fclose($file);



?>