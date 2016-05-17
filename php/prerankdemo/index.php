<?
include_once("../include/database.php");
include_once("../include/footballdb.php");
include_once("../include/misc.php");
include_once("../include/html.php");
include_once("../classes/recordset.php");
include_once("../classes/leagueinfo.php");
include_once("../classes/fantasyteam.php");

session_register("CLeagueInfo");

HTMLStart("Scrambled Eggs Fantasy Football Demo Prerank Team Selection Page", HTML_AUTHOR, HTML_KEYWORDS, "Scrambled Eggs Fantasy Football Demo Prerank Team Selection Page" );

echo("<CENTER>\n");
echo("<FONT FACE='Arial'>\n");
echo("<LINK REL='stylesheet' href='/styles/footballtable.css'>\n");

echo("<FORM NAME='frmPreRank' ACTION='http://www.twoforboth.com/football/draft/prerank.php' METHOD=POST>\n");

$fp = fopen("..\..\football\logs\prerank.txt", "a+");
$lineToWrite = date("D M d H:i",time()) . " $REMOTE_ADDR\r\n";
fwrite($fp, $lineToWrite);
fclose($fp);

$link = OpenDatabase();

$CLeagueInfo = new LeagueInfo("Test", "2003");

$CFantasyTeam = new FantasyTeam("Test", "2003");
$CFantasyTeam->GetAllRecordsOrderByNumber();

echo("<INPUT TYPE='submit' value='Choose Team'>\n");
echo("<SELECT NAME='TEAMFROMDEMO' SIZE=1>\n");

while ($CFantasyTeam->GetNextRecord()) 
{
    $fantasyTeamName = $CFantasyTeam->getName(); 
    echo("<OPTION VALUE='$fantasyTeamName'>$fantasyTeamName</OPTION>\n");        
} 

echo("<INPUT TYPE='HIDDEN' name='demo'>\n");


echo("</SELECT>\n");   


echo("</FORM>\n");

HTMLEnd();
CloseDatabase($link);

?>