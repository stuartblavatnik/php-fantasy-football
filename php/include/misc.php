<?
//Rollovers
define("GRAPHICS_LOCALE", "/football/graphics/");
define("LINEUP_ORIG", GRAPHICS_LOCALE . "eggoriglineup.jpg");
define("LINEUP_ROLL", GRAPHICS_LOCALE . "eggcrackedlineup.jpg");
define("SUBMIT_LINEUP_TEXT", "Submit Lineup");
define("TRANSACTION_ORIG", GRAPHICS_LOCALE . "eggorigtransactions.jpg");
define("TRANSACTION_ROLL", GRAPHICS_LOCALE . "eggcrackedtransactions.jpg");
define("TRANSACTION_TEXT", "Transactions");
define("USERPREFS_ORIG", GRAPHICS_LOCALE . "eggoriguserprefs.jpg");
define("USERPREFS_ROLL", GRAPHICS_LOCALE . "eggcrackeduserprefs.jpg");
define("USERPREFS_TEXT", "User Prefs");
define("TOTALS_ORIG", GRAPHICS_LOCALE . "eggorigtotals.jpg");
define("TOTALS_ROLL", GRAPHICS_LOCALE . "eggcrackedtotals.jpg");
define("TOTALS_TEXT", "Totals");
define("WEEKLY_RESULTS_ORIG", GRAPHICS_LOCALE . "eggorigweeklyresults.jpg");
define("WEEKLY_RESULTS_ROLL", GRAPHICS_LOCALE . "eggcrackedweeklyresults.jpg");
define("WEEKLY_RESULTS_TEXT", "Weekly Results");
define("ROSTERS_ORIG", GRAPHICS_LOCALE . "eggorigrosters.jpg");
define("ROSTERS_ROLL", GRAPHICS_LOCALE . "eggcrackedrosters.jpg");
define("ROSTERS_TEXT", "Rosters");
define("FANTASYSCHEDULE_ORIG", GRAPHICS_LOCALE . "eggorigfantasyschedule.jpg");
define("FANTASYSCHEDULE_ROLL", GRAPHICS_LOCALE . "eggcrackedfantasyschedule.jpg");
define("FANTASYSCHEDULE_TEXT", "Fantasy Schedule");
define("AVAILABLEPLAYERS_ORIG", GRAPHICS_LOCALE . "eggorigavailableplayers.jpg");
define("AVAILABLEPLAYERS_ROLL", GRAPHICS_LOCALE . "eggcrackedavailableplayers.jpg");
define("AVAILABLEPLAYERS_TEXT", "Available Players");
define("NEXTYEAR_ORIG", GRAPHICS_LOCALE . "eggorignextyear.jpg");
define("NEXTYEAR_ROLL", GRAPHICS_LOCALE . "eggcrackednextyear.jpg");
define("NEXTYEAR_TEXT", "Next Year");
define("DRAFTINFO_ORIG", GRAPHICS_LOCALE . "eggorigdraftinfo.jpg");
define("DRAFTINFO_ROLL", GRAPHICS_LOCALE . "eggcrackeddraftinfo.jpg");
define("DRAFTINFO_TEXT", "Draft Info");
define("NFLSCHEDULE_ORIG", GRAPHICS_LOCALE . "eggorignflschedule.jpg");
define("NFLSCHEDULE_ROLL", GRAPHICS_LOCALE . "eggcrackednflschedule.jpg");
define("NFLSCHEDULE_TEXT", "NFL Schedule");

define("REALTIMESCORING_ORIG", GRAPHICS_LOCALE . "eggorigrealtimescoring.jpg");
define("REALTIMESCORING_ROLL", GRAPHICS_LOCALE . "eggcrackedrealtimescoring.jpg");
define("REALTIMESCORING_TEXT", "Real Time Scoring");

define("GREEN_EGG", GRAPHICS_LOCALE . "greenegg.jpg");

define("MESSAGES_ORIG", GRAPHICS_LOCALE . "eggorigmessages.jpg");
define("MESSAGES_ROLL", GRAPHICS_LOCALE . "eggcrackedmessages.jpg");
define("MESSAGES_TEXT", "Messages");



//Transaction ID's
define("TRANSACTION_DROPADD", 1);
define("TRANSACTION_DROP", 2);
define("TRANSACTION_IR", 3);
define("TRANSACTION_TRADE", 4);
define("TRANSACTION_PAY", 5);
define("TRANSACTION_RECEIVE", 6);
define("TRANSACTION_PAY_TO_LEAGUE", 7);
define("TRANSACTION_OWE_TO_LEAGUE", 8);
define("TRANSACTION_LOSE", 9);
define("TRANSACTION_WIN", 10);
define("TRANSACTION_TIE", 11);
define("TRANSACTION_SCORE_THRESHOLD", 12);
define("TRANSACTION_SIDE_POOL", 13);
define("TRANSACTION_PAY_FUTURE_CONSIDERATIONS", 14);
define("TRANSACTION_RECEIVE_FUTURE_CONSIDERATIONS", 15);
define("TRANSACTION_RECEIVE_FROM_LEAGUE", 16);

//Transaction Types
define("TRANSACTION_TYPE_STANDARD", 0);
define("TRANSACTION_TYPE_THRESHOLD", 1);

//Transaction Reject Reasons
define("PLAYER_NOT_ON_FROM_ROSTER", 1);
define("PLAYER_ALREADY_DRAFTED", 2);
define("CONTINGENT_TRANSACTION_NOT_ACCEPTED", 3);
define("PLAYER_NOT_ON_TO_ROSTER", 4);

//MONEY TYPES
define("TRANSACTION_MONEY_GIVE", "Give");
define("TRANSACTION_MONEY_RECEIVE", "Receive");

//Pay For Trade Types
define("TRANSACTION_PAY_FOR_TRADE", "Pay for both sides of trade");
define("TRANSACTION_COUNTERPARTY_PAY_FOR_TRADE", "Trade paid by other team");

define("LOSE", -2);
define("TIE", -1);
define("NOT_PLAYED", 0);
define("WIN", 1);

define("WORD_LOSE", "Lose");
define("WORD_TIE", "Tie");
define("WORD_NOT_PLAYED", "");
define("WORD_WIN", "Win");

define("NO_POSITION_WEEKS", "No position weeks");
define("POSITION_WEEKS", "Position weeks");


//QuickStats Player File
define("INITIAL_OFFENSIVE_PLAYER_URL", "http://www.quickstats.com/nfl/offid.htm");
define("INITIAL_OFFENSIVE_PLAYER_NAME_START", 0);
define("INITIAL_OFFENSIVE_PLAYER_NAME_LENGTH", 25);
define("INITIAL_OFFENSIVE_PLAYER_ID_START", 26);
define("INITIAL_OFFENSIVE_PLAYER_ID_LENGTH", 4);
define("INITIAL_OFFENSIVE_TEAM_NAME_START", 31);
define("INITIAL_OFFENSIVE_TEAM_NAME_LENGTH", 3);
define("INITIAL_OFFENSIVE_TEAM_ID_POSITION_START", 35);
define("INITIAL_OFFENSIVE_TEAM_ID_POSITION_LENGTH", 4);
define("INITIAL_OFFENSIVE_PLAYER_POSITION_START", 39);
define("INITIAL_OFFENSIVE_PLAYER_POSITION_LENGTH", 3);

define("ABSOLUTE_PATH", "d:/web/twoforboth.com/html");          //NOTE: NEXPOINT SPECIFIC

define("MESSAGE_NICE_TRY", "Nice try");
define("MESSAGE_INVALID_LOGIN", "Invalid login");

define("MAIN_MENU_BUTTON_DESCRIPTION", "Main Menu");
define("TRANSACTION_MENU_BUTTON_DESCRIPTION", "Transactions Menu");
define("USER_PREFERENCES_BUTTON_DESCRIPTION", "User Preferences Menu");
define("DRAFT_MENU_BUTTON_DESCRIPTION", "Draft Menu");

//Email address to use when sending email notifications 
$fromName = array ("footballadmin@twoforboth.com");

/*
    Function:       UnviewedMessages()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $fantasy_team_number    -- Team number

    Description:    Determines if the user has any unread messages

    Returns:        True if 1 or more messages have not been viewed.
*/

function UnviewedMessages($leagueName, $leagueYear, $fantasy_team_number)
{
    $retval = false;

    $tableName = CreateTableName(MESSAGE_TABLE_NAME, $leagueName, $leagueYear);

    $query = "SELECT * FROM $tableName WHERE ReadIt='0' AND FantasyTeamNumber='$fantasy_team_number'";
    $result = mysql_query ($query) or die("query failed $query");
    if (mysql_num_rows($result) > 0)
    {
        $retval = true;
    }    

    return $retval;
}

/*
	Function:		UnviewedTrades()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $fantasy_team_number    -- Team number

	Description:	Determines if the user has any trade offers for them that have not been viewed yet

	Returns:		True if there are unviewed trades
*/

function UnviewedTrades($leagueName, $leagueYear, $fantasyTeamNumber)
{
    $retval = false;

    $tableName = CreateTableName(FANTASY_TRANSACTION_REQUEST_TABLE_NAME, $leagueName, $leagueYear);

    $query = "SELECT * FROM $tableName WHERE Type='" . TRANSACTION_TRADE . "' AND Viewed='0' AND FantasyToNumber='$fantasyTeamnumber'";
    $result = mysql_query ($query) or die("query failed $query");
    if (mysql_num_rows($result) > 0)
    {
        $retval = true;
    }    

    return $retval;
}

/*
	Function:		UnactedTrades()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $fantasy_team_number    -- Team number

	Description:	Determines if there are trades that have not been acted upon

	Returns:		True if there is an unacted upon trade
*/

function UnactedTrades($leagueName, $leagueYear, $fantasy_team_number)
{
    $retval = false;
    $tableName = CreateTableName(FANTASY_TRANSACTION_REQUEST_TABLE_NAME, $leagueName, $leagueYear);

    $query = "SELECT * FROM $tableName WHERE Type='" . TRANSACTION_TRADE . "' AND FantasyToNumber='$fantasy_team_number'";
    $result = mysql_query ($query) or die("query failed $query");
    if (mysql_num_rows($result) > 0)
    {
       $retval = true;
    }    

    return $retval;
}

/*
    Function:       TransactionTypeToWord()

    Parameters:     $type -- Transaction type constant

    Description:    Maps an integer value to a string

    Returns:        String
*/

function TransactionTypeToWord($type)
{
    switch ($type)
    {
        case TRANSACTION_DROPADD:
            $retval = "Drop / Add";
        break;

        case TRANSACTION_DROP:
            $retval = "Drop";
        break;

        case TRANSACTION_IR:
            $retval = "IR";
        break;        

        case TRANSACTION_TRADE:
            $retval = "Trade";
        break;

        case TRANSACTION_PAY:
            $retval = "Pay";
        break;

        case TRANSACTION_RECEIVE:   
            $retval = "Receive";
        break;

        case TRANSACTION_PAY_FUTURE_CONSIDERATIONS:
            $retval = "Pay";
        break;

        case TRANSACTION_RECEIVE_FUTURE_CONSIDERATIONS:
            $retval = "Receive";
        break;

        case TRANSACTION_PAY_TO_LEAGUE:
            $retval = "Paid";
        break;

        case TRANSACTION_RECEIVE_FROM_LEAGUE:
            $retval = "Receive";
        break;

        default:
            $retval = "Unknown";
        break;
    }
    return $retval;
}

/*
    Function:       fixName()

    Parameters:     $orig -- Original name

    Returns:        Modified name

    Description:    Replaces ' characters with spaces
*/

function fixName($orig)
{
    $retval = ereg_replace("'", " ", $orig);

    return $retval;
}

/*
    Function:       niceTry()

    Parameters:     $message -- String to display

    Description:    Displays a message on an otherwise empty web page with a 
                    link back to the to the main portion of the fantasy football
                    application.

    Returns:        Nothing
*/

function niceTry($message)
{
    echo(BODY_START);
    echo(HEAD_START);
    echo(HEAD_END);
    echo("<CENTER>");
    echo("<FONT FACE='Arial'>");
    echo("$message");
    echo("<BR><A HREF='http://www.twoforboth.com/football'>Back to Main Football Page</A>");
    echo(BODY_END);
}

/*
    Function:       buildRosterList()

    Parameters:     CFantasyTeam       -- Fantasy Team Object
                    selectable         -- true for boxes
                    arrayname          -- name for the associated array
                    width              -- width of table
                    CLineupDefinition  -- Lineup definition object
                    CNFLPlayer         -- NFL Player Object 
                    CNFLTeam           -- NFL Team Object
                    CLeagueInfo        -- League Info Objecct
                    CheckLocked        -- If true, check for weekly_line_up
                
    Description:    Creates a selectable roster list

    Returns:        True if an IR player was found

    Additions:      Since the selectable version is used for transactions,
                    I want to add code to check the weekly_lineup_table 
                    for each particular player (ID) for week and fantasy 
                    team name.  If there is a record, then the fantasy team
                    has selected to play that player, disable the check box 
                    in that event.

                    This also means that I should pass in a FantasyTeam object
                    instead of the fantasy_team_name (the object will have both
                    name and number)

*/

function buildRosterList($CFantasyTeam,
                         $selectable, 
                         $array_name, 
                         $width, 
                         $CLineupDefinition, 
                         $CNFLPlayer,
                         $CNFLTeam,
                         $CLeagueInfo,
                         $CheckLocked)
{
    $retval = false;

    $weeklyLineupTableName = CreateTableName(WEEKLY_LINEUP_TABLE_NAME, $CLeagueInfo->getName(), $CLeagueInfo->getYear());
    $fantasy_team_name = $CFantasyTeam->getName();
    $fantasy_team_number = $CFantasyTeam->getNumber();
    $current_week = $CLeagueInfo->getCurrentWeek();

    $CLineupDefinition->SelectAllRealDistinct();
    while ($CLineupDefinition->GetNextRecord()) 
    {
        $positions[] = $CLineupDefinition->getPosition();
        $possiblepositions[] = $CLineupDefinition->getAllowed();
        $querypositions[] = $CLineupDefinition->getQueryAllowed();
    }


    echo("<TABLE BORDER=1 WIDTH=$width>");
    if ($selectable == true)
    {
        echo("<TR><TH COLSPAN=6>$fantasy_team_name Roster</TH></TR>");
        echo("<TR>");
        echo("<TH WIDTH='5%'>&nbsp</TH>");
    }
    else
    {
        echo("<TR><TH COLSPAN=5>$fantasy_team_name Roster</TH></TR>");
        echo("<TR>");
    }
    echo("<TH WIDTH='45%'>Name</TH>");
    echo("<TH WIDTH='4%'>Pos</TH>");
    echo("<TH WIDTH='35%'>Team</TH>");
    echo("<TH WIDTH='4%'>Bye</TH>");
    echo("<TH WIDTH='4%'>Points</TH>");
       
    for ($i = 0; $i < count($positions); $i++)
    {
        $arr = split(",", $querypositions[$i]);
        if (count($arr) > 1)
        {
            $CNFLPlayer->GetPlayersFantasyTeamPositionsOrderByName($CFantasyTeam->getName(), $arr);
        }
        else
        {
            $CNFLPlayer->GetPlayersFantasyTeamPositionOrderByName($CFantasyTeam->getName(), $positions[$i]);
        }
    
        while ($CNFLPlayer->GetNextRecord()) 
        {
            $id = $CNFLPlayer->getID();
            $name = $CNFLPlayer->getFullName();
            $position = $CNFLPlayer->getPosition();
            $team = $CNFLPlayer->getNFLTeam();
            $bye = $CNFLPlayer->getBye();            
            $points = $CNFLPlayer->getPoints();

            echo("<TR>");
            if ($selectable == true)
            {
                if ($CheckLocked) 
                {
                    //Determine if the player is in the current weekly lineup -- if so, disable the checkbox
                    $query = "SELECT * FROM $weeklyLineupTableName WHERE FTeamNum='$fantasy_team_number' AND Week='$current_week' AND ID='$id'";
                    $result = mysql_query($query);
                    if (mysql_num_rows($result) == 1)
                    {
                        $disabled = "DISABLED";
                    }
                    else
                    {
                        $disabled = "";
                    }
                }
                //Note what is going on in this line...need to put a [] after the name of the array so I had
                //to hard code the [] in the 'HTML'
                echo("<TD><INPUT TYPE=CHECKBOX NAME='$array_name");?>[]<?echo("' VALUE='$id' $disabled></TD>");
            }
    
            echo("<TD>$name</TD>");    
            echo("<TD ALIGN='CENTER'>$position</TD>");    

            $teamname = $CNFLTeam->getFullNameFromShortName($team);  //getLongNFLName($nflplayerrow->NFLTeam);

            echo("<TD>$teamname</TD>");    
            echo("<TD ALIGN='RIGHT'>$bye</TD>");    
            echo("<TD ALIGN='RIGHT'>$points</TD>");    
            echo("</TR>");
        }

    }
    echo("</TABLE>");    

    return $retval;
}

/*
    Function:       GetFileNameNoExtension()

    Parameters:     $fileName       -- Full file name

    Description:    Retrieves the filename without any extensions

    Returns:        String
*/

function GetFileNameNoExtension($fileName)
{
    return strtok($fileName, ".");
}

/*
    Function:       GetPieceFromTimeStamp()

    Parameters:     $timeStamp  -- Time stamp (i.e. # seconds since Jan 1, 1970
                    $piece      -- String -- can be hours, minutes, seconds, month, year, day

    Description:    Get's a particular part of a time stamp

    Returns:        The piece
*/

function GetPieceFromTimeStamp($timeStamp, $piece)
{
    $datearr = getdate($timeStamp);
    $retval = $datearr[$piece];
    return $retval;
}

/*
    Function:       GetDateFromYYYYMMDDHHMMSSTimeStamp()

    Parameters:     $timestamp -- Date in YYYYMMDDHHMMSS format

    Description:    Creates a date from string
    
    Returns:        # of seconds since 1/1/1970 GMT

    NOTES:          Be careful when sending dates back to Java -- the date object wants # milliseconds
        
              1
    01234567890123
    YYYYMMDDHHMMSS

*/

function GetDateFromYYYYMMDDHHMMSSTimeStamp($timeStamp)
{
    $years = substr($timeStamp, 0, 4);
    $months = substr($timeStamp, 4, 2);
    $days = substr($timeStamp, 6, 2);
    $hours = substr($timeStamp, 8, 2);
    $minutes = substr($timeStamp, 10, 2);
    $seconds = substr($timeStamp, 12, 2);

    $retval = mktime($hours, $minutes, $seconds, $months, $days, $years);

    return $retval;
}

/*
    Function:       pad()

    Parameters:     $orig   -- Unpadded string
                    $num    -- Number of spaces total string should be after padding

    Description:    Pads spaces (HTML &nbsp spaces) to $orig so that length of total string is $num

    Returns:        Padded string
*/

function pad($orig, $num) 
{
    $retval = $orig;

    if (strlen($orig) < $num) 
    {
        $spaces = $num - strlen($orig);
        for ($i = 0; $i < $spaces; $i++) 
        {
            $retval = $retval . "&nbsp";
        }
    }

    return $retval;
    
}

/*
    Function:       getTransactionsDueBy()

    Parameters:     $earliestGame   -- Timestamp of earliest NFL game for the week

    Description:    Uses the following rules to determine when transactions are due by.

                    if earliest game is Sunday at then choose the Friday before at 3:00
                    if earliest game is Saturday at then choose the Friday before at 3:00
                    if earliest game is the Thanksgiving Thursday game then make it the Wedsday before at 2:00
                    else choose the date of the earliest game at 3:00

    Returns:        Date
*/

function getTransactionsDueBy($earliestGame)
{
    $timeArray = @getDate($earliestGame);

    $year = $timeArray[year];
    $month = $timeArray[mon];
    $day = $timeArray[mday];

    //Saturday or Sunday, return Friday at 3:00
    if ($timeArray[wday] == 6)  //Saturday
    {
        $offsetDays = -1;
        $hour = 15;
    }
    else if ($timeArray[wday] == 0) //Sunday
    {
        $offsetDays = -2;
        $hour = 15;
    } 
    //Special case for Thanksgiving (Game on Thursday, but earlier in the day
    //Make it the Wednesday before at 2:00
    else if ($timeArray[wday] == 4 && $timeArray[hours] < 1600) 
    {
        $offsetDays = -1;
        $hour = 14;
    }
    //else make it that same day at 3:00
    else
    {
        $offsetDays = 0;
        $hour = 15;
    }
    
    $newDate = mktime($hour, 0, 0, $month, ($day + $offsetDays), $year);


    return $newDate;
}

/*
    Function:       getScoringHelpLink()

    Parameters:     $positionPlayed   -- NFL Player position

    Description:    Based on a the positiont that an NFL Player played, this function
                    returns a link to the URL of how that player is to be scored for.

    Returns:        URL

    Notes:          This should be made more configurable for specific leagues
*/

function getScoringHelpLink($positionPlayed)
{
    $base = "http://www.twoforboth.com/football/rules/egg/";
    switch ($positionPlayed)
    {
        case "QB":
            $rest = "#QuarterbackScoring";
            break;
        case "RB":
            $rest = "#RunningBackScoring";
            break;
        case "WR":
            $rest = "#WideReceiverScoring";
            break;
        case "SW":
            $rest = "#SwingManScoring";
            break;
        case "PK":
            $rest = "#KickerScoring";
            break;
        case "DE":
            $rest = "#DefenseScoring";
            break;
        case "SP":
            $rest = "#SpecialTeamScoring";
            break;
    }    
    return $base . $rest;
}

/*
    Function:       updateFantasyTeamTotals()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $week                   -- Week to update totals for

    Description:    Updates the total points for each fantasy team.

    Returns:        Nothing
*/

function updateFantasyTeamTotals($leagueName, $leagueYear, $week)
{
    $CFantasyTeamWeekly = new FantasyTeamWeekly($leagueName, $leagueYear);
    $CNFLPlayerWeekly = new NFLPlayerWeekly($leagueName, $leagueYear);
    $CLocalFantasyTeam = new FantasyTeam($leagueName, $leagueYear);

    //Get all of the fantasy team weekly records for the week
    $CFantasyTeamWeekly->GetAllWeek($week);
    //Loop through all of the fantasy teams
    while ($CFantasyTeamWeekly->GetNextRecord()) 
    {
        //Get the total for the fantasy players for the particular team for the week
        $total = $CNFLPlayerWeekly->getSumForWeek($CFantasyTeamWeekly->getNumber(), $week);
        //Update the fantasy team weekly record with the sum for the week
        $CFantasyTeamWeekly->setPoints($total);
    }

    //Retrieve all of the fantasy team records
    $CLocalFantasyTeam->GetAllRecords();
    //Loop through all of the fantasy team records
    while ($CLocalFantasyTeam->GetNextRecord()) 
    {
        //Get the sum of all of the fantasyTeamWeekly records for the fantasy team
        $points = $CFantasyTeamWeekly->GetPointsFantasyTeam($CLocalFantasyTeam->getNumber());
        //Update the fantasy team table with this new sum
        $CLocalFantasyTeam->setPoints($points); 
    }

    $CLocalFantasyTeam->Destroy();
    $CNFLPlayerWeekly->Destroy();
    $CFantasyTeamWeekly->Destroy();
}   

/*
    Function:       processFantasyMatchups()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $week                   -- Week to process

    Description:    Updates results for head to head matchups for fantasy teams
                    assigning fees from the database as needed.

    Returns:        Nothing
*/

function processFantasyMatchups($leagueName, $leagueYear, $week) 
{
    //Object creation

    //Team in question
    $CLocalFromFantasyTeam = new FantasyTeam($leagueName, $leagueYear);
    //Team's opponent
    $CLocalToFantasyTeam = new FantasyTeam($leagueName, $leagueYear);
    //Team in question
    $CFromFantasyTeamWeekly = new FantasyTeamWeekly($leagueName, $leagueYear);
    //Team's opponent
    $CToFantasyTeamWeekly = new FantasyTeamWeekly($leagueName, $leagueYear);
    //Transaction rule object -- fee's etc.
    $CTransactionRule = new TransactionRule($leagueName, $leagueYear);

    //Determine if this league has a scoring threshold rule
    $CTransactionRule->GetByIDType(TRANSACTION_SCORE_THRESHOLD, TRANSACTION_TYPE_THRESHOLD);
    if ($CTransactionRule->getCount() > 0) 
    {
        $CTransactionRule->GetNextRecord();
        $threshold = $CTransactionRule->getThreshold();
        $penalty = $CTransactionRule->getAmount();
    }

    //Get the fees associated with wins, losses and ties
    $CTransactionRule->GetByID(TRANSACTION_WIN);
    $CTransactionRule->GetNextRecord();
    $winAmount = $CTransactionRule->getAmount();        //CHECK THIS VALUE 12/31/02

    $CTransactionRule->GetByID(TRANSACTION_LOSE);
    $CTransactionRule->GetNextRecord();
    $loseAmount = $CTransactionRule->getAmount();

    $CTransactionRule->GetByID(TRANSACTION_TIE);
    $CTransactionRule->GetNextRecord();
    $tieAmount = $CTransactionRule->getAmount();

    $CLocalFromFantasyTeam->GetAllRecords();
    while ($CLocalFromFantasyTeam->GetNextRecord()) 
    {
        $owe = 0;
        $wins = 0;
        $losses = 0;
        $ties = 0;

        $CFromFantasyTeamWeekly->GetTeamWeek($CLocalFromFantasyTeam->getNumber(), $week);
        $CFromFantasyTeamWeekly->GetNextRecord();
        $CToFantasyTeamWeekly->GetTeamWeek($CFromFantasyTeamWeekly->getOpponent(), $week); 
        $CToFantasyTeamWeekly->GetNextRecord();
        $CFromFantasyTeamWeekly->setPointsAgainst($CToFantasyTeamWeekly->getPoints(), $week); 


        $wins = $CFromFantasyTeamWeekly->GetResultType(WIN, $week);        //Get all wins for From Team
        $losses = $CFromFantasyTeamWeekly->GetResultType(LOSE, $week);     //Get all losses for From Team
        $ties = $CFromFantasyTeamWeekly->GetResultType(TIE, $week);        //Get all ties for From Team
        $pointsAgainst = $CFromFantasyTeamWeekly->GetTotalPointsAgainst(); //Get all points against 

        if ($CFromFantasyTeamWeekly->getPoints() > $CToFantasyTeamWeekly->getPoints())           //Win
        {
            $CFromFantasyTeamWeekly->setResult(WIN);
            $wins++;
            $owe += $winAmount;
        }
        else if ($CFromFantasyTeamWeekly->getPoints() < $CToFantasyTeamWeekly->getPoints())      //Lose 
        {
            $CFromFantasyTeamWeekly->setResult(LOSE);
            $losses++;
            $owe += $loseAmount;
        }
        else    //Tie
        {
            $CFromFantasyTeamWeekly->setResult(TIE);
            $ties++;
            $owe += $tieAmount;					//fixed 5/12/03 -- was $loseAmount
        }

        //Update wins, losses and ties
        $CLocalFromFantasyTeam->setLosses($losses);
        $CLocalFromFantasyTeam->setTies($ties);
        $CLocalFromFantasyTeam->setWins($wins);

        //Calculate winning percentage based on new record
        $pct = ($wins + $ties / 2)/ ($wins + $losses + $ties);
        $CLocalFromFantasyTeam->setPCT($pct);
        $CLocalFromFantasyTeam->setOpponentScore($pointsAgainst);

        //Determine penalty if needed
        $out = "Before compare owe = $owe Comparing " . $CFromFantasyTeamWeekly->getPoints() . " with $threshold\r\n";
        LogError("Stu.txt", $out);
        if ($CFromFantasyTeamWeekly->getPoints() < $threshold) 
        {
            $owe += $penalty;
        }
        $out = "After compare owe = $owe\r\n";
        LogError("Stu.txt", $out);

        //Update how much the team owes for the result
        $CFromFantasyTeamWeekly->setMoneyOwed($owe);
    }

    //Clean up objects
    $CTransactionRule->Destroy();
    $CToFantasyTeamWeekly->Destroy();
    $CFromFantasyTeamWeekly->Destroy();
    $CLocalToFantasyTeam->Destroy();
    $CLocalFromFantasyTeam->Destroy();
}


/*
    Function:       processSidePool()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $week                   -- Week to process

    Description:    Processes the side pool using the following rules

                    Step 1 Get Number of Teams for the week that were in the side pool
                    Step 2 Get the side pool rule for the number of teams from the database
                    Step 3 Loop through prizes determining how many teams qualified for prize
                    Step 4 Modify 

    Returns:        Nothing
*/

function processSidePool($leagueName, $leagueYear, $week) 
{
    //Get Cost of Pool Entry Fee
    $CTransactionRule = new TransactionRule($leagueName, $leagueYear);
    $CTransactionRule->GetByID(TRANSACTION_SIDE_POOL);
    $CTransactionRule->GetNextRecord();
    $poolCost = $CTransactionRule->getAmount();

    $CFantasyTeamWeekly = new FantasyTeamWeekly($leagueName, $leagueYear);
    //Step 1
    $CFantasyTeamWeekly->GetTeamsInSidePool($week);

    //Put scores of teams in array sorted by score
    while ($CFantasyTeamWeekly->GetNextRecord()) 
    {
        $scores[] = $CFantasyTeamWeekly->getPoints();
        $numberOfTeams++;
    }    

    $totalPool = $poolCost * $numberOfTeams;
    //Step 2 - 3 Handled by object
    $CSidePoolRules = new SidePoolRules($leagueName, $leagueYear);
    $CSidePoolRules->getByTeamCount($numberOfTeams);
    $CSidePoolRules->GetNextRecord();

    $payouts = $CSidePoolRules->CalculatePrizes($scores, $totalPool);
    $positions = $CSidePoolRules->CalculatePositions($scores);

    //Next go through each FantasyWeekly Team updating 
    //WeeklyPotPosition TINYINT(4) DEFAULT 0, 
    //PotMoneyOwed FLOAT(10, 2) DEFAULT 0.00,  = $payouts[$i] - $poolCost
    $i = 0;
    $CFantasyTeamWeekly->GetTeamsInSidePool($week);
    while ($CFantasyTeamWeekly->GetNextRecord()) 
    {
        $payout = ($payouts[$i] - $poolCost) * -1;
        $CFantasyTeamWeekly->UpdatePotPositionMoneyOwed($CFantasyTeamWeekly->getNumber(),
                                                        $week,
                                                        $payout,
                                                        $positions[$i]);
        $i++;
    }    
    $CSidePoolRules->Destroy();
    $CFantasyTeamWeekly->Destroy();
    $CTransactionRule->Destroy();
}

/*
    Function:       nextWeekIsPosition()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $week                   -- Week to process

    Description:    Determines if the next week in the fantasy schedule is a position
                    week.  This is checked by seeing if any of the records contain -1
                    in the opponent field.

    Returns:        True if next week is position week, else false
*/

function nextWeekIsPosition($leagueName, $leagueYear, $week) 
{

    $retval = false;
    
    $CFantasyTeamWeekly = new FantasyTeamWeekly($leagueName, $leagueYear);

    $weekToSearch = $week + 1;

    $CFantasyTeamWeekly->GetAllWeek($weekToSearch);
    $CFantasyTeamWeekly->GetNextRecord();
    if ($CFantasyTeamWeekly->getOpponent() == -1)
    {
        $retval = true;
    }

    $CFantasyTeamWeekly->Destroy();

    return $retval;
}

/*
    Function:       processPositionWeek()

    Parameters:     $leagueName             -- Name of league
                    $leagueYear             -- Year of league
                    $week                   -- Week to process

    Description:    Fills the fantasy lineup for a position week.  This is done
                    by retrieving the total scores for each fantasy team and pitting
                    each team against each other in score order.

    Returns:        Nothing
*/

function processPositionWeek($leagueName, $leagueYear, $week)
{
    $CFantasyTeamWeekly = new FantasyTeamWeekly($leagueName, $leagueYear);

    $CLocalFantasyTeam = new FantasyTeam($leagueName, $leagueYear);
    $CLocalFantasyTeam->GetAllRecordsOrderBy("Points DESC, Number ASC");

    $i = 0;
    while ($CLocalFantasyTeam->GetNextRecord()) 
    {
        if (($i % 2) == 0) 
        {
            $from[] = $CLocalFantasyTeam->getNumber();
        }
        else
        {
            $to[] = $CLocalFantasyTeam->getNumber();
        }
        $i++;
    }

    for ($i = 0; $i < count($from) ; $i++) 
    {
        $CFantasyTeamWeekly->setOpponentWeek($from[$i], $week, $to[$i]);
        $CFantasyTeamWeekly->setOpponentWeek($to[$i], $week, $from[$i]);
    }
    $CFantasyTeamWeekly->Destroy();
}

/*
    Function:       havePlayersInEarlyGame()

    Parameters:     $earliestGame       -- Date of earliest game as a Unix Timestamp
                    $fantasyTeamName    -- Fantasy team name
                    $leagueName         -- name of league
                    $leagueYear         -- year of league

    Description:    Determines if a fantasy team has 1 or more players playing in a game before
                    Sunday. 

    Returns:        True if fantasy team has nfl players on either team in the early game(s)

    Note:           This function did not work properly...Needs further debugging
*/

function havePlayersInEarlyGame($earliestGame, $fantasyTeamName, $leagueName, $leagueYear) 
{
    $retval = false;
    $found = false;

    $CNFLPlayer = new NFLPlayer($leagueName, $leagueYear);
    $CNFLTeam = new NFLTeam($leagueYear);

    //Step 1 -- convert time of earliest game to YYYYMMDD000000
    $dayOfGame = substr(makeTimeStamp($earliestGame), 0, 8) . "000000";
    //Find all games for that day
    $CNFLSchedule = new NFLSchedule($leagueName, $leagueYear);
    $CNFLSchedule->GetAllGamesForDate($dayOfGame);
    while ($CNFLSchedule->GetNextRecord()) 
    {
        //Get nfl teams for the week
        $visitorName = $CNFLTeam->getShortNameFromID($CNFLSchedule->getVisitorNumber());
        $homeName = $CNFLTeam->getShortNameFromID($CNFLSchedule->getHomeNumber());
        $CNFLPlayer->GetPlayersOnFantasyTeam($fantasyTeamName);
        while ($CNFLPlayer->GetNextRecord()) 
        {
            if ($CNFLPlayer->getNFLTeam() == $visitorName || $CNFLPlayer->getNFLTeam() == $homeName) 
            {
                $found = true;
                break;
            }
        }
        if ($found == true) 
        {
            $retval = true;
            break;
        }
    }

    $CNFLTeam->Destroy();
    $CNFLSchedule->Destroy();
    $CNFLPlayer->Destroy();    

    return $retval;
}

/*
    Function:       sendStatsEmails()

    Parameters:     $leagueName         -- name of league
                    $leagueYear         -- year of league
                    $week               -- league week
                    $statDescription    -- Type of stats that have been processed

    Description:    Sends an email message to all those fantasy teams that requested
                    email notifications when stats have been updated.

    Returns:        Nothing
*/

function sendStatsEmails($leagueName, $leagueYear, $week, $statDescription)
{
    $CLocalFantasyTeam = new FantasyTeam($leagueName, $leagueYear);
    $CLocalFantasyTeam->GetAllRecords();

    $subject = "Scrambled Eggs Stats";
    $message = "$statDescription stats have been processed for week $week";

    while ($CLocalFantasyTeam->GetNextRecord()) 
    {
        if ($CLocalFantasyTeam->getStatNotification() == 1) 
        {
            SendEmail($CLocalFantasyTeam->getEmail(), $subject, $message);
        }
    }

    $CLocalFantasyTeam->Destroy();
}

/*
    Function:       SendEmail()

    Parameters:     $to         -- Email To field
                    $subject    -- Email Subject field
                    $message    -- Email Text field

    Description:    Sends an email message.

    Returns:        Nothing
*/

function SendEmail($to, $subject, $message) 
{
    global $fromName;

    //Use random address if multiple from list provided
    if (count($fromName) > 1) 
    {
        mt_srand((double)microtime() * 1000000);        //Seed random number
        $i = mt_rand(0, count($fromName) - 1);
    }
    else
    {
        $i = 0;
    }

    $from = $fromName[$i];
    $replyTo = "$fromName";
    $fullFrom = "From: $from\r\n";
    $fullReplyTo = "Reply-to: $replyTo\r\n";

    $otherArgs = $fullFrom . $fullReplyTo;

    mail($to, $subject, $message, $otherArgs);

}

/*
    Function:       LogError()

    Parameters:     $fileName   -- Error file
                    $errorText  -- Text to write out

    Description:    Writes $errorText to file $fileName

    Returns:        Nothing
*/

function LogError($fileName, $errorText) 
{
    $fp = fopen($fileName, "a+");
    $lineToWrite = "$errorText\r\n";
    fwrite($fp, $lineToWrite);
    fclose($fp);
}


/*
    Function:       buildSearchList()

    Parameters:     $search     -- Equal to search
                    $position   -- Position(s) to search
                    $nflteam    -- NFL Team(s) to search
                    $start      -- Starting week
                    $end        -- Ending week

    Description:    Creates the available player list
                    Handles both all weeks and subset weeks

    Returns:        Nothing
*/

function buildSearchList($search, $position, $nflteam, $start, $end)
{
    global $CNFLPlayer;
    global $CNFLTeam;
    global $CLineupDefinition;
    global $CLeagueInfo;
    global $CFantasyTeam;

    echo("\t<TABLE>\n");
    echo("\t\t<TR>\n");
    echo("\t\t\t<TH>Available Players</TH>\n");
    echo("\t\t\t<TH COLSPAN=2>Search Criteria</TH>\n");
    echo("\t\t</TR>\n");
    echo("\t\t<TR>\n");
    echo("\t\t\t<TD>\n");
    $name = pad("Name", 16);
    echo("\t\t\t\t<DIV style='font-family=monospace'>$name Ps Tm  Pts Bye</DIV>\n");
    echo("\t\t\t\t<SELECT NAME='searchplayerid' SIZE=20>\n");

    if ($search)
    {
        if ($start == 1 && $end == $CLeagueInfo->getCurrentWeek())
        {
            $CNFLPlayer->GetUndraftedOrderByPoints($position, $nflteam);

            while ($CNFLPlayer->GetNextRecord())
            {
                $id = $CNFLPlayer->getID();
                $name = $CNFLPlayer->getFullName();
                $position = $CNFLPlayer->getPosition();
                $nflTeam = $CNFLPlayer->getNFLTeam();
                $points = $CNFLPlayer->getPoints();
                $bye = $CNFLPlayer->getBye();

                $name = pad(substr($name, 0, 14), 15);
                $nflTeam = pad($nflTeam, 3);
                $points = pad($points, 3);
                $bye = pad($bye, 2);

                echo("\t\t\t\t\t<OPTION VALUE='$id'>$name $position $nflTeam $points $bye</OPTION>\n");
            }
        }
        else
        {
            $CNFLPlayerWeekly = new NFLPlayerWeekly($CLeagueInfo->getName(), 
                                                    $CLeagueInfo->getYear());

//CREATE THE TEMP TABLE HERE
            $CPlayerSearch = new PlayerSearch($CLeagueInfo->getName(), 
                                              $CLeagueInfo->getYear(), 
                                              $CFantasyTeam->getNumber(), 
                                              $start, 
                                              $end);
    
            $CNFLPlayer->GetUndrafted($position, $nflteam);
            while ($CNFLPlayer->GetNextRecord())
            {
                $points = $CNFLPlayerWeekly->GetSumRange($CNFLPlayer->getID(), $start, $end);                    
                $CPlayerSearch->AddPlayer($CNFLPlayer->getID(),
                                          $CNFLPlayer->getFullName(),
                                          $CNFLPlayer->getNFLTeam(),
                                          $CNFLPlayer->getPosition(),
                                          $CNFLPlayer->getBye(), 
                                          $points);
            }            
            $CNFLPlayerWeekly->Destroy();

            $CPlayerSearch->SortByPoints();
            while ($CPlayerSearch->GetNextRecord())
            {
                $id = $CPlayerSearch->getID();
                $name = $CPlayerSearch->getName();
                $position = $CPlayerSearch->getPosition();
                $nflTeam = $CPlayerSearch->getNFLTeam();
                $points = $CPlayerSearch->getPoints();
                $bye = $CPlayerSearch->getBye();

                $name = pad(substr($name, 0, 14), 15);
                $nflTeam = pad($nflTeam, 3);
                $points = pad($points, 3);
                $bye = pad($bye, 2);

                echo("\t\t\t\t\t<OPTION VALUE='$id'>$name $position $nflTeam $points $bye</OPTION>\n");
            }
            
            $CPlayerSearch->Destroy();
        }
    }        
    else
    {
        echo "\t\t\t\t\t<OPTION VALUE='-1'>" . str_repeat("&nbsp", 31) . "</OPTION>\n";
    }

    echo("\t\t\t\t</SELECT>\n");

    echo("\t\t\t</TD>\n");
    echo("\t\t\t<TD ALIGN='CENTER'>\n");
    echo("\t\t\t\t<DIV style='font-family=monospace'>Pos</DIV>\n");
    echo("\t\t\t\t<SELECT MULTIPLE NAME='position[]' SIZE=20>\n");

    $CLineupDefinition->SelectAllRealDistinct();
    $position_array = array();
    while ($CLineupDefinition->GetNextRecord()) 
    {
        $arr = split(",", $CLineupDefinition->getAllowed());
        for ($i = 0; $i < count($arr); $i++) 
        {
            if (in_array($arr[$i], $position_array) == false) 
            {
                $position_array[] = $arr[$i];
            }
        }
    } 

    for ($i = 0; $i < count($position_array) ; $i++) 
    {
        echo("<OPTION VALUE='$position_array[$i]'>$position_array[$i]</OPTION>\n");        
    }

    echo("</TD>\n");
    echo("<TD ALIGN='CENTER'>\n");

    echo("</SELECT>\n");
    echo("<DIV style='font-family=monospace'>NFL Team</DIV>\n");
    echo("<SELECT MULTIPLE NAME='nflteam[]' SIZE=20>\n");

    $CNFLTeam->GetAll();
    while($CNFLTeam->GetNextRecord())
    {
        $shortName = $CNFLTeam->getShortName();
        $fullName = $CNFLTeam->GetFullName();
        echo("<OPTION VALUE='$shortName'>$fullName</OPTION>\n");
    }

    echo("</SELECT>\n");
    echo("</TD>\n");
    echo("</TR>\n");

    echo("<TR>\n");
    echo("<TD ALIGN='CENTER'>");
    echo("<INPUT TYPE='SUBMIT' NAME='search' VALUE='Search'>\n");
    echo("</TD>\n");
    echo("<TD COLSPAN=2>\n");
    echo("Start <INPUT TYPE='TEXT' NAME='start' VALUE='$start' SIZE='2'> End <INPUT TYPE='TEXT' NAME='end' VALUE='$end' SIZE='2'>\n");
    echo("</TD>\n");

    echo("</TR>\n");

    echo("<TR>\n");
    echo("</TR>\n");
    echo("</TABLE>\n");
}


    function GetTomorrow($in_date)
    {
        $out_date = mktime(0, 0, 0, date("m", $in_date), date("d", $in_date) + 1, date("Y", $in_date));
        return $out_date;
    }


?>