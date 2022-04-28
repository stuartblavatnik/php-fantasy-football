<?
session_register("leagueName");         //Remember to use the string and NOT the VARIABLE REPRESENTATION (i.e. no $ in front!)
session_register("leagueYear");
session_register("fantasyTeamName");
session_register("netscape");
session_register("fromLogin");

//Clear the session
/*
    Main menu screen.  The central screen, it initially checks user name and password and displays the
    the menu choices (either as Javascript rollovers or submit buttons dependent on browser type.
*/

session_unregister("scheduleWeek");

include_once("../php/include/html.php");
include_once("../php/include/misc.php");
include_once("../php/include/database.php");
include_once("../php/include/footballdb.php");
include_once("../php/classes/leagueinfo.php");
include_once("../php/classes/recordset.php");
include_once("../php/classes/fantasyteam.php");
include_once("../php/classes/class.nflschedule.php");
include_once("../php/classes/class.weeklylineup.php");
include_once("../php/classes/nflplayer.php");
include_once("../php/classes/nflteam.php");


    if (!isset($leagueName))
    {
        niceTry(MESSAGE_NICE_TRY);
    }
    else
    {
        $link = OpenDatabase();

        if ($link == false) 
        {
            echo("Sorry, database not available, please try again later");
        }
        else if (substr($fantasyTeamName, 0, strlen("admin")) == "admin" && $password == "XXX") 
        {
            //Create a LeagueInfo object
            $CLeagueInfo = new LeagueInfo($leagueName, $leagueYear);
            session_register("CLeagueInfo");

            $CFantasyTeam = new FantasyTeam($leagueName, $leagueYear);            
            $nameToken = strtok($fantasyTeamName, ",");
            $numberToken = strtok(',');
            $CFantasyTeam->GetByNumber($numberToken);
            $CFantasyTeam->GetNextRecord();
            session_register("CFantasyTeam");
            $admin = true;
            session_register("admin");

            buildScreen($netscape, $leagueName, $leagueYear, $CFantasyTeam, $CLeagueInfo);
            CloseDatabase($link);
        }
        //If login ok, write cookies
        //First delete former cookies
        else if (doLogin($leagueName, $leagueYear, $fantasyTeamName, $password))
        {
            if (isset($fromLogin)) 
            {
                $fp = fopen("logs\loginok.txt", "a+");
                $lineToWrite = date("D M d H:i",time()) . " $REMOTE_ADDR leagueName = ($leagueName) leagueYear = ($leagueYear) fantasyTeamName = ($fantasyTeamName)\r\n";
                fwrite($fp, $lineToWrite);
                fclose($fp);
                session_unregister("fromLogin");
                unset($fromLogin);
            }

            session_register("password");

            //Erase the cookies
            setcookie("lN");
            setcookie("lY");
            setcookie("tN");
            //Create new ones (in case the name has changed)
            //$expiry = mktime(12, 50, 30, 6, 20, 2010);
            $expiry = time() + 365 * 86400;     //Make it expire 1 year from today
            setcookie("lN", $leagueName, $expiry);
            setcookie("lY", $leagueYear, $expiry);
            setcookie("tN", $fantasyTeamName, $expiry);

            //Create a LeagueInfo object
            $CLeagueInfo = new LeagueInfo($leagueName, $leagueYear);
            session_register("CLeagueInfo");
            
            $CFantasyTeam = new FantasyTeam($leagueName, $leagueYear);
            $CFantasyTeam->GetFantasyTeamRecord($fantasyTeamName);
            session_register("CFantasyTeam");

            buildScreen($netscape, $leagueName, $leagueYear, $CFantasyTeam, $CLeagueInfo);
            CloseDatabase($link);
        }
        else
        {
            if (isset($fromLogin)) 
            {
                $fp = fopen("logs\loginerror.txt", "a+");
                $lineToWrite = date("D M d H:i",time()) . " leagueName = ($leagueName) leagueYear = ($leagueYear) fantasyTeamName = ($fantasyTeamName) password = ($password)\r\n";
                fwrite($fp, $lineToWrite);
                fclose($fp);
                session_unregister("fromLogin");
                unset($fromLogin);
            }

            session_unset(); 
            session_destroy();
            //Erase the cookies
            setcookie("lN");
            setcookie("lY");
            setcookie("tN");

            niceTry(MESSAGE_INVALID_LOGIN);
        }
    }


/*
    Function:       buildScreen()

    Parameters:     $netscape           -- True if user is running under Netscape 4.7
                    $leagueName         -- league name
                    $leagueYear         -- league year
                    $CFantasyTeam       -- Fantasy Team Object
                    $CLeagueInfo        -- leagueInfo object

    Description:    Draws the screen -- get reminders for user and display them
*/

function buildScreen($netscape, $leagueName, $leagueYear, $CFantasyTeam, $CLeagueInfo)
{
    HTMLStart("Scrambled Eggs Fantasy Football $leagueName $leagueYear Season Main Menu", HTML_AUTHOR, HTML_KEYWORDS, "Scrambled Eggs Fantasy Football $leagueName $leagueYear Season Main Menu" );

    $dateArray = getDate(mktime());                     
    $currenthours = $dateArray["hours"];                
    $currentDate = mktime($currenthours);               //Create new date object

    createHeader($leagueYear);                          //Create the title heading for the page

    if (strlen($CFantasyTeam->getName())) 
    {
        echo("Welcome " . $CFantasyTeam->getName() . "<BR>");
    }
    else
    {
        echo("Welcome Administrator<BR>");
    }

    echo("Week " . $CLeagueInfo->getCurrentWeek() . "<BR>");
    echo("Current date / time = " . date("D M j Y H:i:s", time()) . "<BR>");

    $CNFLSchedule = new NFLSchedule($CLeagueInfo->getName(), $CLeagueInfo->getYear());
    $earliestGame = $CNFLSchedule->GetWeeksEarliestGame($CLeagueInfo->getCurrentWeek());

    if ($CLeagueInfo->getDraftComplete() == 0) 
    {
        $currentTimeStamp = makeTimeStamp(time());  
        if ($currentTimeStamp < $CLeagueInfo->getDraftStarts()) 
        {
            echo("Draft begins at " .
                 date("D M j Y H:i:s",
                      GetDateFromYYYYMMDDHHMMSSTimeStamp($CLeagueInfo->getDraftStarts())) . 
                "<BR>");
        }
        else
        {
            echo("Draft taking place now<BR>");
        }
    }
    else
    {
        $CNFLSchedule->GetTodaysEarliestGame();
        if ($CNFLSchedule->GetNextRecord())
        {
            echo("Next game today is at " . $CNFLSchedule->getFormattedGameDate("H:i") . "<BR>");
        }
        else
        {
            echo("No NFL games today<BR>");
        }

        if (strlen($CLeagueInfo->getStatDescription())) 
        {
            echo ("<B>" . $CLeagueInfo->getStatDescription() . " stats in system</B><BR>");
        }


        $CWeeklyLineup = new WeeklyLineup($CLeagueInfo->getName(), $CLeagueInfo->getYear());
        if (!$CWeeklyLineup->Exists($CFantasyTeam->getNumber(), $CLeagueInfo->getCurrentWeek())) 
        {
            echo("No lineup submitted yet<BR>");
        }

        $transactionsDue = getTransactionsDueBy($earliestGame);
        if ($CLeagueInfo->getCurrentWeek() != 1) 
        {
            if (time() < $transactionsDue) 
            {
                $output = date("D M j Y H:i:s", $transactionsDue);
                echo("Transactions due by $output<BR>");
            }
            else
            {
                echo("Transactions closed for this week<BR>");
            }
        }

        $CWeeklyLineup->Destroy();
    }

    if (time() < $earliestGame) 
    {
        echo("Next NFL game: " . date("D M j Y H:i:s", $earliestGame) . "<BR>");

        $dateArray = getdate($earliestGame);
        if ($dateArray[wday] != 0)      //i.e. Sunday
        {
            if (havePlayersInEarlyGame($earliestGame, $CFantasyTeam->getName(), $CLeagueInfo->getName(), $CLeagueInfo->getYear())) 
            {
                echo("You have 1 or more players playing in the early game<BR>");
            }
        }
    }

    if ($CLeagueInfo->maintenance == 1)
    {
        echo("<H1>Sorry, the site is down for maintenance.  If you want to do any league transactions, please email to link below.</H1>");
    }
    else
    {
        //Put this back later 8/10/02
        drawNewAlerts($leagueName, $leagueYear, $CFantasyTeam);
        drawMenuChoices($netscape, $CLeagueInfo->lineupsLocked, $CLeagueInfo->getCurrentWeek() );
        //put this back later 8/10/02
        drawLeagueInfoAlerts($CLeagueInfo);
    }


    echo("</CENTER>");

    echo("<P>Comments may be made to:<HR><ADDRESS><A HREF='mailto:stuartb@twoforboth.com'</A>stuartb@twoforboth.com</ADDRESS>");

    $CNFLSchedule->Destroy();

    HTMLEnd();
}

function createHeader($leagueYear)
{
    echo("<CENTER>");
    echo("<H1>Scrambled Eggs Football $leagueYear Season</H1>");
    echo("<IMG SRC = '/football/graphics/greenegg.jpg'>");
    echo("<H3>Pages provided by <A HREF='http://www.twoforboth.com'>Two For Both</A></H3>");
}

function drawNewAlerts($leagueName, $leagueYear, $CFantasyTeam)
{
    //Check for unread messages and checked trades
    if (UnviewedMessages($leagueName, $leagueYear, $CFantasyTeam->getNumber()) == true)
    {
        echo("<A HREF='transactions/messages.php'>You have new messages.</A><BR>");
    }
    if (UnviewedTrades($leagueName, $leagueYear, $CFantasyTeam->getNumber()) == true)
    {
        echo("<A HREF='transactions/trades.php'>You have new trade offers.</A><BR>");
    }
    elseif (UnactedTrades($leagueName, $leagueYear, $CFantasyTeam->getNumber()) == true)
    {
        echo("<A HREF='transactions/trades.php'>You have trade offers that are pending.</A><BR>");
    }
}

function drawLeagueInfoAlerts($CLeagueInfo)
{
    if ($CLeagueInfo->earlyStatsImported == 1)
    {
        echo("Early stats up<BR>");
    }
}

/*
    Function:       BuildMainMenuChoice()

    Parameters:     $netscape   -- True if using netscape
                    $formName   -- Name of HTML form
                    $formAction -- Action to take if form submit button is clicked
                    $imgname    -- Name of Image portion of anchor
                    $origimg    -- Name of original graphic
                    $rollimg    -- Name of image when mouse rolls over image
                    $subtext    -- Text to put in submit button if netscape

    Description:    Builds the Form within a table data 

    Returns:        Nothing
    
*/

function BuildMainMenuChoice($netscape, $formName, $formAction, $imgName, $origImg, $rollImg, $subText)
{
    echo("\t\t<TD>\n");
    echo("\t\t\t<FORM NAME='$formName' ACTION='$formAction' METHOD=LINK>\n");
    $documentSubmitString = "document." . $formName . ".submit()";
    BuildRolloverAction($netscape, $documentSubmitString, $imgName, $origImg, $rollImg, $subText);
    echo("\t\t\t</FORM>\n");
    echo("\t\t</TD>\n");
}

function drawMenuChoices($netscape, $lockall)
{
    //Build the Eggs / Choices
    echo("<TABLE>\n");
    echo("\t<TR>\n");
    BuildMainMenuChoice($netscape, "frmLineup", "lineup/", "ILineup", LINEUP_ORIG, LINEUP_ROLL, SUBMIT_LINEUP_TEXT);
    //Transactions Choice
    BuildMainMenuChoice($netscape, "frmTransactions", "transactions/", "ITransaction", TRANSACTION_ORIG, TRANSACTION_ROLL, TRANSACTION_TEXT);
    //Weekly Totals Choice
    BuildMainMenuChoice($netscape, "frmWeeklyResults", "weeklyresults/weeklyresults.php", "IWeeklyResults", WEEKLY_RESULTS_ORIG, WEEKLY_RESULTS_ROLL, WEEKLY_RESULTS_TEXT);
    //Real Time Scoring
    BuildMainMenuChoice($netscape, "frmRealTimeScoring", "realtimescoring/realtimescoring.php", "IRealTimeScoring", REALTIMESCORING_ORIG, REALTIMESCORING_ROLL, REALTIMESCORING_TEXT);
    //Totals Choice
    BuildMainMenuChoice($netscape, "frmTotals", "totals/totals.php", "ITotals", TOTALS_ORIG, TOTALS_ROLL, TOTALS_TEXT);
    //Rosters Choice
    BuildMainMenuChoice($netscape, "frmRosters", "rosters/rosters.php", "IRosters", ROSTERS_ORIG, ROSTERS_ROLL, ROSTERS_TEXT);
    //Available Players Choice
    BuildMainMenuChoice($netscape, "frmAvailablePlayers", "available2/", "IAvailablePlayers", AVAILABLEPLAYERS_ORIG, AVAILABLEPLAYERS_ROLL, AVAILABLEPLAYERS_TEXT);
    echo("\t</TR>\n");
    echo("</TABLE>\n");

    echo("<TABLE>\n");
    echo("\t<TR>\n");
    //Fantasy Schedule
    BuildMainMenuChoice($netscape, "frmFantasySchedule", "fantasyschedule/", "IFantasySchedule", FANTASYSCHEDULE_ORIG, FANTASYSCHEDULE_ROLL, FANTASYSCHEDULE_TEXT);
    //NFL Schedule -- POINT THIS TO MY NEW SCREEN 8/10/02
    BuildMainMenuChoice($netscape, "frmNFLSchedule", "nflschedules/nflschedules.php", "INFLSchedule", NFLSCHEDULE_ORIG, NFLSCHEDULE_ROLL, NFLSCHEDULE_TEXT);
    //Draft Info Choice
    BuildMainMenuChoice($netscape, "frmMessages", "transactions/messages.php", "IMessages", MESSAGES_ORIG, MESSAGES_ROLL, MESSAGES_TEXT);
    //Draft Info Choice
    BuildMainMenuChoice($netscape, "frmDraftInfo", "draft/draftinfo.php", "IDraftInfo", DRAFTINFO_ORIG, DRAFTINFO_ROLL, DRAFTINFO_TEXT);
    //User Prefs Choice
    BuildMainMenuChoice($netscape, "frmUserPrefs", "userprefs/", "IUserPrefs", USERPREFS_ORIG, USERPREFS_ROLL, USERPREFS_TEXT);
    //Next Year Choice
    BuildMainMenuChoice($netscape, "frmNextYear", "nextyear/nextyear.php", "INextYear", NEXTYEAR_ORIG, NEXTYEAR_ROLL, NEXTYEAR_TEXT);
    echo("</TR>");
    echo("</TABLE>");
}


?>
