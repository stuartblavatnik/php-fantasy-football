<?php
    $link = mysql_connect("localhost", "twoforbo", "xxx") or die ("Could not connect");
    print ("Connected successfully");
    mysql_select_db ("dbtwoforbo") or die ("Could not select database");
    
    $query = "SELECT * FROM soup";
    $result = mysql_query ($query) or die ("Query failed");

	// printing HTML result

    print "<table>\n";
    while($line = mysql_fetch_array($result))
    {
       print "\t<tr>\n";
       while(list($col_name, $col_value) = each($line))
       {
          print "\t\t<td>$col_value</td>\n";
       }
       print "\t</tr>\n";
    }
    print "</table>\n";
    
    mysql_close($link);
?>
     
 
