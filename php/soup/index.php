<?
include_once("../include/database.php");

    if (!($link = OpenDatabase()))
    {
        echo("Could not open database");
    }
    else
    {
        $stmnt = "SELECT * FROM Soup";
        $result = mysql_query($stmnt);

        if (mysql_num_rows($result) > 0)
        {
            echo("<TABLE BORDER=1>");
            echo("<TR><TH>Name</TH><TH>Description</TH><TH>Price</TH></TR>");
            while($row = mysql_fetch_object($result))
            {
                echo ("<TR><TD>" . $row->Name . 
                      "</TD><TD>" . $row->Description . 
                      "</TD><TD>" . $row->Price . "</TD></TR>");

            }
            echo("</TABLE>");
        }
    }
?>
