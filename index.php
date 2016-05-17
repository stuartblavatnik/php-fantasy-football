<?
session_start();      
include_once '../php/include/html.php';
include_once '../php/include/misc.php';


    if (substr($HTTP_USER_AGENT, 0, 11) == "Mozilla/4.7")
    {
        $netscape = true;
    }
    else
    {
        $netscape = false;
    }

    session_register("netscape");
    session_register("fromLogin");
    

    HTMLStart("Scrambled Eggs Fantasy Football", HTML_AUTHOR, HTML_KEYWORDS, "Scrambled Eggs Fantasy Football Main Page" );
    echo("<CENTER>\n");
    echo("<TABLE>\n");
    echo("\t<TR>\n");
    echo("\t\t<TD ALIGN=\"RIGHT\"><IMG SRC = \"graphics/fnyj.gif\" ALT=\"J-E-T-S\"></TD>\n");
    echo("\t\t<TD ALIGN=\"CENTER\"><H1>Scrambled Eggs Football</H1></TD>\n");
    echo("\t\t<TD ALIGN=\"LEFT\"><IMG SRC = \"graphics/fnyg.gif\" ALT=\"G-MEN\"></TD>\n");
    echo("\t</TR>\n");

    echo("\t<TR>\n");
	echo("\t\t<TD></TD><TD ALIGN=\"CENTER\"><H1>No league this year (2009),<BR>email me for details.</H1></TD><TD></TD>\n");
    echo("\t</TR>\n");



    echo("\t<TR>\n");
    echo("\t\t<TD ALIGN=\"CENTER\" VALIGN=\"TOP\">\n");
    BuildArchiveTable();
    BuildRulesTable();
    echo("<A HREF=\"extras/goal.shtml\">What everyone should strive for<BR>");
    echo("<A HREF=\"extras/pie.txt\">Amazing Song<BR>");
    echo("<A HREF='http://www.personal.psu.edu/faculty/a/d/ads102/warp.html' target = '_blank'>Fun With Bill</A><BR>");
    echo("<A HREF=\"http://www.twoforboth.com/personal/bpc/bpc4/380R14.JPG\">Proof<BR>");
    echo("\t</TD>\n");
    echo("\t<TD><IMG SRC=\"graphics/bacon__egg.jpg\" ALT=\"EGG\"></TD>\n");
    echo("\t<TD ALIGN=\"CENTER\" VALIGN=\"TOP\">\n");
    echo("<B>Log In</B>");
    BuildLoginForm($lN, $lY, $tN);
    echo("<H3>");
    echo("\t<A HREF='forgotpassword\'>Forgot Password</A>\n");
    echo("</H3>");
    echo("</TD>\n");
    echo("</TR>\n");



    echo("<TR>\n");
    echo("\t<TD></TD>\n");
    echo("\t<TD ALIGN=\"CENTER\"><IMG SRC=\"graphics/fsdc.gif\" ALT=\"Chargers!\"></TD>\n");
    echo("</TR>\n");
    echo("</TABLE>\n");


    echo("<BR>\n");

	BuildPayPalLink();
?>


<?
    HTMLEnd();

function BuildArchiveTable()
{
    echo("<FORM METHOD=POST ACTION=\"processindexgo.php\">\n");
    echo("<B>Archived league information</B>\n");
    echo("<SELECT NAME='sa'>\n");
    $f_contents = file("archived\archived.txt");
    
    for ($i = 0; $i != count($f_contents); $i++)
    {
        list($location, $description) = explode(",", $f_contents[$i]);
        if ($i == 0)
        {
            echo("\t\t<OPTION VALUE=\"$location\" SELECTED>$description\n"); 
        }
        else
        {
            echo("\t\t<OPTION VALUE=\"$location\">$description\n"); 
        }
    }
    echo("</SELECT>\n");
    echo("<BR>\n");
    echo("<INPUT TYPE='SUBMIT' VALUE=\"View\">\n");
    echo("</FORM>\n");
}

function BuildRulesTable()
{
    echo("<FORM METHOD=POST ACTION=\"processindexgo.php\">\n");
    echo("<B>Rules</B>\n");
    echo("<SELECT NAME='sa'>\n");
    $f_contents = file("rules\\rules.txt");
    
    for ($i = 0; $i != count($f_contents); $i++)
    {
        list($location, $description) = explode(",", $f_contents[$i]);
        if ($i == 0)
        {
            echo("\t\t<OPTION VALUE=\"$location\" SELECTED>$description\n"); 
        }
        else
        {
            echo("\t\t<OPTION VALUE=\"$location\">$description\n"); 
        }
    }
    echo("</SELECT>\n");
    echo("<BR>\n");
    echo("<INPUT TYPE='SUBMIT' VALUE=\"View\">\n");
    echo("</FORM>\n");
}


//value='".$cont."'
function BuildLoginForm($name, $year, $team)
{
    echo("<FORM METHOD=POST ACTION=\"leagueMain.php\">\n");
    echo("<TABLE>\n");
    echo("\t<TR>\n");

    echo("\t\t<TD>League Name</TD>\n");
    echo("\t\t<TD><INPUT TYPE='text' NAME='leagueName' VALUE='$name'></TD>\n");
    echo("\t</TR>\n");

    echo("\t<TR>\n");
    echo("\t\t<TD>Year</TD>\n");
    echo("\t\t<TD><INPUT TYPE='text' NAME='leagueYear' VALUE='$year'></TD>\n");
    echo("\t</TR>\n");

    echo("\t<TR>\n");
    echo("\t\t<TD>Team Name</TD>\n");
    echo("\t\t<TD><INPUT TYPE='text' NAME='fantasyTeamName' VALUE='$team'></TD>\n");
    echo("\t</TR>\n");

    echo("\t<TR>\n");
    echo("\t\t<TD>Password</TD>\n");
    echo("\t\t<TD><INPUT TYPE='password' NAME='password'></TD>\n");
    echo("\t</TR>\n");

    echo("\t\t<TD><INPUT TYPE=HIDDEN NAME='fromLogin' VALUE='1'></TD>\n");


    echo("</TABLE>\n");
    echo("<INPUT TYPE='SUBMIT' VALUE='Log In'>\n");
    echo("</FORM>\n");
}

function BuildPayPalLink()
{
    echo("<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>\n");
    echo("<input type='hidden' name='cmd' value='_xclick'>\n");
    echo("<input type='hidden' name='business' value='stuartb@twoforboth.com'>\n");
    echo("<input type='hidden' name='item_name' value='Scrambled Eggs Football Season'>\n");
    echo("<input type='hidden' name='item_number' value='1'>\n");
    echo("<input type='hidden' name='amount' value='30.00'>\n");
    echo("<input type='hidden' name='no_note' value='1'>\n");
    echo("<input type='hidden' name='currency_code' value='USD'>\n");
    echo("<input type='image' src='https://www.paypal.com/images/x-click-but6.gif' border='0' name='submit' alt='Make payments with PayPal - it is fast, free and secure!'>\n");
    echo("</form>\n");
}

?>

