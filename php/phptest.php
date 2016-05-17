<HTML>
<HEAD>
<TITLE>PHP SQL CODE TESTER</TITLE>
</HEAD>
<BODY>
<!--query.php-->
<?php
    $host = "localhost";
    $user = "twoforbo";
    $password = "eggbert";
?>

<FORM ACTION="mysql_test.php METHOD=POST>
Please select the database for the query:<BR><BR>
<SELECT NAME=database SIZE=1>

<?php
    mysql_connect($host, $user, $password);
    $db_table = mysql_list_dbs();
    for ($i = 0; $i < mysql_num_rows($db_table); $i++)
    {
        echo("<OPTION>" . mysql_tablename($db_table, $i));
    }
?>
</SELECT><BR><BR>
Please input the SQL query to be executed:<BR><BR>
<TEXTAREA NAME="query" COLS=50 ROWS=10></TEXTAREA>
<BR><BR>
<INPUT TYPE=SUBMIT VALUE="Execute query!">
</FORM>
</BODY>
</HTML>