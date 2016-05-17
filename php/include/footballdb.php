<?

/*
    Module:         footballdb.php

    Description:    Functions pertaining to Scrambled Eggs Fantasy Football mySQL Databases

    Notes:          
*/

/*
    General mySQL notes:

    1) WHEN CREATING AN AUTO_INCREMENT FIELD, YOU MUST MAKE IT THE PRIMARY KEY

    2) HOW TO MAKE A PRIMARY UNIQUE KEY (i.e. no duplicates allowed)
       THE KEY MUST BE NOT NULL as well

       ID MEDIUMINT(9) NOT NULL
       PRIMARY KEY(ID)

    3) Be careful when using TINYINT -- values can only be between 1-127
*/

define("MODULE_NAME", "footballdb.php");            //Name of this module for error reporting

//Draft Information
define("DRAFT_HEARTBEAT_THRESHOLD", 30);            //Number of seconds before a team is considered logged out 
                                                    //from the draft application

define("FB_PREFIX", "fb_");                         //All football related tables begin with this prefix

//League Specific Tables

define("LEAGUE_INFO_TABLE_NAME", "_league_info");
define("LEAGUE_INFO_TABLE_DEFINITION",              "Name TINYTEXT NOT NULL,
                                                     Year MEDIUMINT(9) DEFAULT 0,
                                                     CurrentWeek TINYINT(4) DEFAULT 1, 
                                                     EarlyStatsImported TINYINT(4) DEFAULT 0, 
                                                     DraftComplete TINYINT(4) DEFAULT 0, 
                                                     GamesStarted TINYINT(4) DEFAULT 0, 
                                                     LineupsLocked TINYINT(4) DEFAULT 0, 
                                                     Maintenance TINYINT(4) DEFAULT 0, 
                                                     TransactionsLocked TINYINT(4) DEFAULT 0,
                                                     StatDescription TINYTEXT NOT NULL,
                                                     DraftStarts TIMESTAMP(14),
                                                     RosterSize TINYINT(4) DEFAULT 0");

define("FANTASY_TEAM_WEEKLY_TABLE_NAME", "_fantasyteam_weekly");
define("FANTASY_TEAM_WEEKLY_TABLE_DEFINITION",      "Number TINYINT(4) DEFAULT 0, 
                                                     Opponent TINYINT(4) DEFAULT 0, 
                                                     Points SMALLINT(6) DEFAULT 0, 
                                                     PointsAgainst SMALLINT(6) DEFAULT 0, 
                                                     Result TINYINT(4) DEFAULT 0, 
                                                     Week TINYINT(4) DEFAULT 0, 
                                                     OverallPosition TINYINT(4) DEFAULT 0, 
                                                     WeeklyPotPosition TINYINT(4) DEFAULT 0, 
                                                     MoneyOwed FLOAT(10, 2) DEFAULT 0.00, 
                                                     PotMoneyOwed FLOAT(10, 2) DEFAULT 0.00, 
                                                     InPot TINYINT(4) DEFAULT 0, 
                                                     Blind TINYINT(4) DEFAULT 0,
                                                     KEY(Number),
                                                     KEY(Week)");

define("NFL_PLAYER_WEEKLY_TABLE_NAME", "_nfl_player_weekly");
define("NFL_PLAYER_WEEKLY_TABLE_DEFINITION",        "ID MEDIUMINT(9) NOT NULL,  
                                                     NFLTeam TINYTEXT NOT NULL,
                                                     Pos TINYTEXT NOT NULL,
                                                     FTeam TINYINT(4) DEFAULT 0,
                                                     FPlayed TINYINT(4) DEFAULT 0,
                                                     FPOS TINYTEXT NOT NULL,
                                                     Week TINYINT(4) DEFAULT 0,
                                                     Points SMALLINT(6) DEFAULT 0,
                                                     FPoints SMALLINT(6) DEFAULT 0,
                                                     Locked TINYINT(4) DEFAULT 0,
                                                     KEY(ID)");


define("NFL_PLAYER_TABLE_NAME", "_nfl_player");
define("NFL_PLAYER_TABLE_DEFINITION",               "ID MEDIUMINT(9) NOT NULL,
                                                     FTeam TINYTEXT NOT NULL,
                                                     Drafted TINYINT(4) DEFAULT 0,
                                                     Round TINYINT(4) DEFAULT 0,
                                                     Points SMALLINT(6) DEFAULT 0,
                                                     PRIMARY KEY(ID)");


define("FANTASY_TRANSACTION_REQUEST_TABLE_NAME", "_fantasy_transaction_request");
define("FANTASY_TRANSACTION_REQUEST_TABLE_DEFINITION",  "ID MEDIUMINT NOT NULL AUTO_INCREMENT,
                                                         Type TINYINT(4) DEFAULT 0,
                                                         FromPlayerID MEDIUMINT(9) DEFAULT 0,
                                                         ToPlayerID MEDIUMINT(9) DEFAULT 0,
                                                         Amount FLOAT(10,2) DEFAULT 0.00,
                                                         FantasyFromNumber TINYINT(4) DEFAULT 0,
                                                         FantasyToNumber TINYINT(4) DEFAULT 0,
                                                         Week TINYINT(4) DEFAULT 0,
                                                         Accepted TINYINT(4) DEFAULT 0,
                                                         Viewed TINYINT(4) DEFAULT 0,
                                                         Priority BIGINT(20) DEFAULT 0,
                                                         ContingentOn MEDIUMINT(9) DEFAULT -1,
                                                         BaseID MEDIUMINT(9) DEFAULT 0,
                                                         PRIMARY KEY(ID)");

define("FANTASY_TRANSACTION_TABLE_NAME", "_fantasy_transaction");
define("FANTASY_TRANSACTION_TABLE_DEFINITION",      "ID MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
                                                     Type TINYINT(4) DEFAULT 0,
                                                     FromPlayerID MEDIUMINT(9) DEFAULT 0,
                                                     ToPlayerID MEDIUMINT(9) DEFAULT 0,
                                                     Amount FLOAT(10,2) DEFAULT 0.00,
                                                     FantasyFromNumber TINYINT(4) DEFAULT 0,
                                                     FantasyToNumber TINYINT(4) DEFAULT 0,
                                                     Week TINYINT(4) DEFAULT 0,
                                                     TradeDate TIMESTAMP(14),
                                                     BaseID MEDIUMINT(9) DEFAULT 0,
                                                     KEY(ID),
                                                     KEY(Type)");

define("FANTASY_TEAM_TABLE_NAME", "_fantasy_team");
define("FANTASY_TEAM_TABLE_DEFINITION",             "Number TINYINT(4) DEFAULT 0,
                                                     Name TINYTEXT NOT NULL,
                                                     Owner TINYTEXT NOT NULL,
                                                     Email TINYTEXT NOT NULL,
                                                     Wins TINYINT(4) DEFAULT 0,
                                                     Losses TINYINT(4) DEFAULT 0,
                                                     Ties TINYINT(4) DEFAULT 0,
                                                     Owes FLOAT(10,2) DEFAULT 0.00,
                                                     Points MEDIUMINT(9) DEFAULT 0,
                                                     PCT FLOAT(10,2) DEFAULT 0.00,
                                                     OppScore MEDIUMINT(9) DEFAULT 0,
                                                     Division TINYINT(4) DEFAULT 0,
                                                     Blind TINYINT(4) DEFAULT 0,
                                                     Password TINYTEXT NOT NULL,
                                                     PublicEmail TINYINT(4) DEFAULT 0,
                                                     StatNotification TINYINT(4) DEFAULT 0,
                                                     TransactionNotification TINYINT(4) DEFAULT 0,
                                                     TradeOfferNotification TINYINT(4) DEFAULT 0,
                                                     Activated TINYINT(4) DEFAULT 0,
                                                     TimeLoggedIn TIMESTAMP(14),
                                                     DraftDriver TINYINT(4) DEFAULT 0,
                                                     KEY(Number)");

define("WEEKLY_LINEUP_TABLE_NAME", "_weekly_lineup");
define("WEEKLY_LINEUP_TABLE_DEFINTION",             "ID MEDIUMINT(9) DEFAULT 0,
                                                     NFLTeam TINYTEXT NOT NULL,
                                                     Pos TINYTEXT NOT NULL,
                                                     FTeamNum TINYINT(4) DEFAULT 0,
                                                     FPos TINYTEXT NOT NULL,
                                                     Week TINYINT(4) DEFAULT 0,
                                                     Locked TINYINT(4) DEFAULT 0,
                                                     KEY(ID),
                                                     KEY(Week)");

define("STAT_TABLE_NAME", "_stat");
define("STAT_TABLE_DEFINITION",                      "ID MEDIUMINT(9) NOT NULL,
                                                      Week TINYINT(4) DEFAULT 0,
                                                      Type TINYINT(4) DEFAULT 0,
                                                      Points MEDIUMINT(9) DEFAULT 0,
                                                      Length MEDIUMINT(9) DEFAULT 0,
                                                      KEY(ID),
                                                      KEY(Week),
                                                      KEY(Type)");

define("SCORE_RULE_TABLE_NAME", "_score_rule");
define("SCORE_RULE_TABLE_DEFINITION",               "ID MEDIUMINT(9) DEFAULT 0,
                                                     Type TINYINT(4) DEFAULT 0,
                                                     Worth MEDIUMINT(9) DEFAULT 0,
                                                     MinVal MEDIUMINT(9) DEFAULT 0,
                                                     MaxVal MEDIUMINT(9) DEFAULT 0,
                                                     Rate MEDIUMINT(9) DEFAULT 0,
                                                     Pos TINYTEXT NOT NULL,
                                                     Description TINYTEXT NOT NULL");

define("TRANSACTION_RULE_TABLE_NAME", "_transaction_rule");
define("TRANSACTION_RULE_TABLE_DEFINITION",         "ID MEDIUMINT(9) DEFAULT 0,
                                                     Type TINYINT(4) DEFAULT 0,
                                                     Amount FLOAT(10,2) DEFAULT 0.00,
                                                     Recurring TINYINT(4) DEFAULT 0,
                                                     Threshold TINYINT(4) DEFAULT 0");

define("LINEUP_DEFINITION_TABLE_NAME", "_lineup_definition");
define("LINEUP_DEFINITION_TABLE_DEFINTION",         "position TINYTEXT NOT NULL,
                                                     allowed TINYTEXT NOT NULL,
                                                     queryallowed TINYTEXT,
                                                     ord TINYINT(4) DEFAULT 0,
                                                     RealPosition TINYINT(4) DEFAULT 1");

define("DRAFT_TABLE_NAME", "_draft");
define("DRAFT_TABLE_DEFINITION",                    "Round TINYINT(4) DEFAULT 0,
                                                     PickNumber MEDIUMINT(9) NOT NULL,
                                                     FantasyTeamNumber TINYINT(4) DEFAULT 0,
                                                     NFLPlayerID MEDIUMINT(9) DEFAULT 0,
                                                     PRIMARY KEY(PickNumber),
                                                     KEY(Round)");

define("DRAFT_INFO_TABLE_NAME", "_draft_info");
define("DRAFT_INFO_TABLE_DEFINITION",               "Round TINYINT(4) DEFAULT 0,
                                                     Number MEDIUMINT(9) DEFAULT 0,
                                                     FantasyTeamName TINYTEXT NOT NULL,
                                                     Locked TINYINT(4) DEFAULT 0,
                                                     NewDriverNeeded TINYINT(4) DEFAULT 0");

define("HEARTBEAT_TABLE_NAME", "_heartbeat");
define("HEARTBEAT_TABLE_DEFINITION",                "FantasyTeamName TINYTEXT NOT NULL,
                                                     Beat TIMESTAMP(14),
                                                     KEY(Beat)");

define("DRAFT_MESSAGE_TABLE_NAME", "_draft_message");
define("DRAFT_MESSAGE_TABLE_DEFINITION",            "Message TINYTEXT NOT NULL,
                                                     Stamp TIMESTAMP(14),
                                                     KEY(Stamp)");

define("MESSAGE_TABLE_NAME", "_messages");
define("MESSAGE_TABLE_DEFINITION",                  "ID MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
                                                     TextMessage TINYTEXT NOT NULL,
                                                     FantasyTeamNumber TINYINT(4) NOT NULL,
                                                     ReadIt TINYINT(4) DEFAULT 0,
                                                     DateTime TIMESTAMP,
                                                     PRIMARY KEY(ID)");

define("SIDE_POOL_RULES_TABLE_NAME", "_side_pool_rules");
define("SIDE_POOL_RULES_TABLE_DEFINITION",          "TeamCount TINYINT(4) DEFAULT 0,
                                                     BreakDowns TINYTEXT NOT NULL
                                                    ");

define("POOL_SPLIT_TABLE_NAME", "_final_pool_rules");
define("POOL_SPLIT_TABLE_DEFINITION",          "TeamCount TINYINT(4) DEFAULT 0,
                                                BreakDowns TINYTEXT NOT NULL
                                               ");

//Temporary tables
define("SEARCH_PLAYER_POINTS_NAME", "_search_player_points");
define("SEARCH_PLAYER_POINTS_DEFINITION",           "ID MEDIUMINT(9) NOT NULL,
                                                     Name TINYTEXT NOT NULL,
                                                     NFLTeam TINYTEXT NOT NULL,
                                                     Position TINYTEXT NOT NULL,
                                                     Points SMALLINT(6) DEFAULT 0,
                                                     Bye TINYINT(4) DEFAULT 0,
                                                     PRIMARY KEY(ID)");


//Global tables

define("NFL_SCHEDULE_TABLE_NAME", "_nfl_schedule");
define("NFL_SCHEDULE_TABLE_DEFINITION",              "Week TINYINT(4) NOT NULL,
                                                      VisitorNumber MEDIUMINT(9) DEFAULT 0,
                                                      HomeNumber MEDIUMINT(9) DEFAULT 0,
                                                      GameDate TIMESTAMP,
                                                      KEY(Week)");

define("NFL_TEAM_TABLE_NAME", "_nfl_team");
define("NFL_TEAM_TABLE_DEFINITION",                 "ID MEDIUMINT(9) NOT NULL,
                                                     FullName TINYTEXT NOT NULL,
                                                     ShortName TINYTEXT NOT NULL,
                                                     Bye TINYINT(4) DEFAULT 0,
                                                     PRIMARY KEY(ID)");

define("DEFAULT_NUMBER_POSITIONS_TABLE_NAME", "FB_Number_Positions_Default");

/*
    Represents the generic stats read in from the quickstats files
*/    

define("NFL_PLAYER_GLOBAL_WEEKLY_STAT_TABLE_NAME", "_nfl_player_weekly");
define("NFL_PLAYER_GLOBAL_WEEKLY_STAT_TABLE_DEFINITION",    "ID MEDIUMINT(9) NOT NULL,
                                                             Week TINYINT(4) DEFAULT 0,
                                                             Type TINYINT(4) DEFAULT 0,
                                                             Length MEDIUMINT(9) DEFAULT 0,
                                                             KEY(ID),
                                                             KEY(Week),
                                                             KEY(Type)");
/*
    Keeps track of what stats were loaded into the system
*/
define("NFL_STAT_DESCRIPTION_TABLE_NAME", "_stat_description");
define("NFL_STAT_DESCRIPTION_TABLE_DEFINITION",      "Week TINYINT(4) DEFAULT 1,
                                                      Description TINYTEXT NOT NULL");

define("MASTER_NFL_PLAYER_TABLE_NAME", "_nfl_player");
define("MASTER_NFL_PLAYER_TABLE_DEFINITION",        "ID MEDIUMINT(9) NOT NULL,
                                                     Name TINYTEXT NOT NULL,   
                                                     NFLTeam TINYTEXT NOT NULL,
                                                     Position TINYTEXT NOT NULL,
                                                     Bye TINYINT(4) DEFAULT 0,   
                                                     PRIMARY KEY(ID)");

/*
    The prerank table is used for autodrafting.  It is created when the team is
    activated from the admin menu.
*/
define("PRERANK_TABLE_DEFINITION",                  "ID MEDIUMINT(9) NOT NULL,
                                                    Excluded TINYINT(4) DEFAULT 0,
                                                    Ranked TINYINT(4) DEFAULT 0,
                                                    Rank MEDIUMINT(9) NOT NULL,
                                                    Points SMALLINT(6) DEFAULT 0");

/*
    The position distribution table is used for autodrafting.  It is created when the team is
    activated from the admin menu.
*/
define("POSITION_DISTRIBUTION_TABLE_DEFINITION",     "Position TINYTEXT NOT NULL,
                                                      Amount TINYINT(4) DEFAULT 0,
                                                      Remaining TINYINT(4) DEFAULT 0");


/*
    Function:       CreateLeagueTables()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league

    Description:    Creates the league specific tables

    Returns:        list of tables names that were not created
*/

function CreateLeagueTables($leagueName, $leagueYear)
{
    $tableNameValues = array(       
                                    LEAGUE_INFO_TABLE_NAME,
                                    FANTASY_TEAM_WEEKLY_TABLE_NAME,
                                    NFL_PLAYER_WEEKLY_TABLE_NAME,
                                    NFL_PLAYER_TABLE_NAME,
                                    FANTASY_TRANSACTION_REQUEST_TABLE_NAME,
                                    FANTASY_TRANSACTION_TABLE_NAME,
                                    FANTASY_TEAM_TABLE_NAME,
                                    WEEKLY_LINEUP_TABLE_NAME,
                                    STAT_TABLE_NAME,
                                    SCORE_RULE_TABLE_NAME, 
                                    TRANSACTION_RULE_TABLE_NAME,
                                    LINEUP_DEFINITION_TABLE_NAME,
                                    DRAFT_TABLE_NAME,
                                    DRAFT_INFO_TABLE_NAME,
                                    HEARTBEAT_TABLE_NAME,
                                    DRAFT_MESSAGE_TABLE_NAME,
                                    MESSAGE_TABLE_NAME,
                                    SIDE_POOL_RULES_TABLE_NAME,
                                    POOL_SPLIT_TABLE_NAME
                            );
    $tableDefintionValues = array(  
                                    LEAGUE_INFO_TABLE_DEFINITION,
                                    FANTASY_TEAM_WEEKLY_TABLE_DEFINITION,
                                    NFL_PLAYER_WEEKLY_TABLE_DEFINITION,
                                    NFL_PLAYER_TABLE_DEFINITION,
                                    FANTASY_TRANSACTION_REQUEST_TABLE_DEFINITION,
                                    FANTASY_TRANSACTION_TABLE_DEFINITION,
                                    FANTASY_TEAM_TABLE_DEFINITION,
                                    WEEKLY_LINEUP_TABLE_DEFINTION,
                                    STAT_TABLE_DEFINITION,
                                    SCORE_RULE_TABLE_DEFINITION,
                                    TRANSACTION_RULE_TABLE_DEFINITION,
                                    LINEUP_DEFINITION_TABLE_DEFINTION,
                                    DRAFT_TABLE_DEFINITION,
                                    DRAFT_INFO_TABLE_DEFINITION,
                                    HEARTBEAT_TABLE_DEFINITION,
                                    DRAFT_MESSAGE_TABLE_DEFINITION,
                                    MESSAGE_TABLE_DEFINITION,
                                    SIDE_POOL_RULES_TABLE_DEFINITION,
                                    POOL_SPLIT_TABLE_DEFINITION
                                );

    for ($i = 0; $i < count($tableNameValues); $i++)
    {
        if (!CreateTable(CreateTableName($tableNameValues[$i], $leagueName, $leagueYear), $tableDefintionValues[$i]))
        {
            $errors[] = $tableNameValues[$i];
        }
    }
    return $errors;    
}

/*
    Function:       CreateGlobalTable()

    Parameters:     $tableName          -- Base name for table
                    $tableDescription   -- Field list definition for table
                    $leagueYear         -- Year of league

    Description:    Generates a global table.  Global tables are in the form
                    fb_$leagueYear_$baseName

    Returns:        True if table created, else False
*/

function CreateGlobalTable($tableName, $tableDescription, $leagueYear)
{
    $retval = true;

    if (!CreateTable(CreateGlobalTableName($tableName, $leagueYear), $tableDescription))
    {
        $retval = false;
    }

    return $retval;
}

/*
    Function:       CreateGlobalTableName()
    
    Parameters:     $baseName   -- Table Base name
                    $leagueYear -- Year of league

    Description:    Generates a table name in the form
                    fb_$leagueYear_$baseName

    Returns:        String
*/

function CreateGlobalTableName($baseName, $leagueYear)
{
    $retval = FB_PREFIX . $leagueYear . $baseName;
    return $retval;
}

/*
    Function:       CreateTableName()

    Parameters:     $baseName   -- Base name
                    $leagueName -- Name of league
                    $leagueYear -- Year of league

    Description:    Generates the name of the league info table in the form
                    fb_$leagueName_$leagueYear_$baseName

    Returns:        String
*/

function CreateTableName($baseName, $leagueName, $leagueYear)
{
    $retval = FB_PREFIX . $leagueName . "_" . $leagueYear . $baseName;
    return $retval;
}


/*
    Function:       FillScoringRulesTable()

    Parameters:     $leagueName         -- name of league
                    $leagueYear         -- year of league
                    $scoringRulesFile   -- Filename containing the rules

    Description:    Parses a file containing the rules for the league and 
                    creates database records

    Returns:        True if ok, else false
*/

function FillScoringRulesTable($leagueName, $leagueYear, $scoringRulesFile)
{
    $retval = true;
    $functionName = "FillScoringRulesTable";

    $tableName = CreateTableName(SCORE_RULE_TABLE_NAME, $leagueName, $leagueYear);

//;Position ID Type Worth Min Max Rate Description
    $f_contents = file($scoringRulesFile);
    for ($i = 0; $i != count($f_contents); $i++)
    {
        $firstChar = substr($f_contents[$i], 0, 1);
        if ($firstChar != ";" && $firstChar != " ")
        {
            list($position, $id, $type, $worth, $min, $max, $rate, $description) = explode(",", $f_contents[$i]);
            if (strlen($position) > 0)
            {
                $description = fixName($description);
            	$query = "INSERT INTO $tableName (ID, Type, Worth, MinVal, MaxVal, Rate, Pos, Description) VALUES ('$id', '$type', '$worth', '$min', '$max', '$rate', '$position', '$description')";
            	$result = mysql_query ($query) or die(MODULE_NAME . " $functionName failed $query");
            }
        }
    }
    return $retval;
}

/*
    Function:       FillTransactionRulesTable()

    Parameters:     $leagueName         -- name of league
                    $leagueYear         -- year of league
                    $transactionRulesFile   -- Filename containing the rules

    Description:    Parses a file containing the rules for the league and 
                    creates database records

    Returns:        True if ok, else false
*/

function FillTransactionRulesTable($leagueName, $leagueYear, $transactionRulesFile)
{

    $retval = true;
    $functionName = "fillTransactionRulesTable";

    $tableName = CreateTableName(TRANSACTION_RULE_TABLE_NAME, $leagueName, $leagueYear);

//;Position ID Type Worth Min Max Rate Description
//ID [#] TYPE [#] AMOUNT [#.##] RECURRING [0-1] THRESHOLD [#]
    $f_contents = file($transactionRulesFile);
    for ($i = 0; $i != count($f_contents); $i++)
    {
        $firstChar = substr($f_contents[$i], 0, 1);
        if ($firstChar != ";" && $firstChar != " ")
        {
            list($id, $type, $amount, $recurring, $threshold) = explode(",", $f_contents[$i]);
            $query = "INSERT INTO $tableName (ID, Type, Amount, Recurring, Threshold) VALUES ('$id', '$type', '$amount', '$recurring', '$threshold')";
            $result = mysql_query ($query) or die(MODULE_NAME . " $functionName failed $query");
        }
    }
    return $retval;
}

/*
    Function:       FillLineupRulesTable()

    Parameters:     $leagueName         -- name of league
                    $leagueYear         -- year of league
                    $lineRulesFile   -- Filename containing the rules

    Description:    Parses a file containing the rules for the league and 
                    creates database records

    Returns:        True if ok, else false
*/

function FillLineupRulesTable($leagueName, $leagueYear, $lineupRulesFile)
{

    $retval = true;
    $functionName = "fillLineupRulesTable";

    $tableName = CreateTableName(LINEUP_DEFINITION_TABLE_NAME, $leagueName, $leagueYear);

//Position|Order|Allowed|Query Allowed
    $f_contents = file($lineupRulesFile);
    for ($i = 0; $i != count($f_contents); $i++)
    {
        $firstChar = substr($f_contents[$i], 0, 1);
        if ($firstChar != ";" && $firstChar != " ")
        {
            list($position, $order, $allowed, $queryAllowed, $real) = explode("|", $f_contents[$i]);
            $query = "INSERT INTO $tableName (position, allowed, queryallowed, ord, RealPosition) VALUES ('$position', '$allowed', '$queryAllowed', '$order', '$real')";
            $result = mysql_query ($query) or die(MODULE_NAME . " $functionName failed $query");
        }
    }
    return $retval;
}


/*
    Function:       UpdateFantasyScheduleWeekly()

    Parameters:     $leagueName     -- Name of league
                    $leagueYear     -- Year of league
                    $numberofTeams  -- Number of teams in league
                    $divisions      -- Number of divisions in league
                    $schedule       -- Constant (POSITION_WEEKS or NO_POSITION_WEEKS)

    Description:    Deletes and rereads in a schedule file in the form sch_T#_D?_P% to fill the 
                    fantasyteam_weekly table which represents the fantasy schedule.

                    # = number of teams
                    ? = number of divisions
                    % = Y / N for position weeks

    Returns:        Nothing
*/

function UpdateFantasyScheduleWeekly($leagueName, $leagueYear, $numberofTeams, $divisions, $schedule)
{
    $tableName = CreateTableName(FANTASY_TEAM_WEEKLY_TABLE_NAME, $leagueName, $leagueYear);
    $query = "DELETE FROM $tableName";
    mysql_query($query);    
    FillFantasyScheduleTable($leagueName, $leagueYear, $numberofTeams, $divisions, $schedule);
}

/*
    Function:       FillFantasyScheduleTable()

    Parameters:     $leagueName     -- Name of league
                    $leagueYear     -- Year of league
                    $numberofTeams  -- Number of teams in league
                    $divisions      -- Number of divisions in league
                    $schedule       -- Constant (POSITION_WEEKS or NO_POSITION_WEEKS)

    Description:    Reads in a schedule file in the form sch_T#_D?_P% to fill the 
                    fantasyteam_weekly table which represents the fantasy schedule.

                    # = number of teams
                    ? = number of divisions
                    % = Y / N for position weeks

    Returns:        True if success
*/

function FillFantasyScheduleTable($leagueName, $leagueYear, $numberofTeams, $divisions, $schedule)
{
    $retval = true;

    $tableName = CreateTableName(FANTASY_TEAM_WEEKLY_TABLE_NAME, $leagueName, $leagueYear);

    //Build file name to retrieve based on $numberofTeams, $divisions and $schedule
    $position_weeks = ($schedule == POSITION_WEEKS ? "Y" : "N");
    $filename = "schedules/sch_T" . $numberofTeams . "_D" . $divisions . "_P" . $position_weeks . ".txt";
    if (!file_exists($filename))
    {
        echo("filename $filename does not exist\n");
        return false;
    }

    else
    {
        $arrText = file("$filename");      //Read file into array
        $week = 1;
        for ($i = 0; $i < count($arrText); $i++)  //Loop through each element in the array
        {
            //Should break up 3 5 1 6 2 4 10 9 8 7 13 14 11 12 into separate values
            $arrWeekly = explode(',', $arrText[$i]);
            if ($arrWeekly[0] != '-1')
            {
                for ($j = 0; $j < count($arrWeekly); $j+=2)
                {
                   $FantasyTeam     = $arrWeekly[$j];
                   $op = $j + 1;
                   $FantasyOpponent = $arrWeekly[$op];
                   $query = "INSERT INTO $tableName (Number, Opponent, Week) VALUES ('$FantasyTeam', '$FantasyOpponent', '$week')";
                   mysql_query($query);
                   $query = "INSERT INTO $tableName (Opponent, Number, Week) VALUES ('$FantasyTeam', '$FantasyOpponent', '$week')";
                   mysql_query($query);
                }
            }
            else // position week
            {
                for ($j = 0; $j < $numberofTeams; $j++)
                {
                   $teamnumber = $j + 1; 
                   $query = "INSERT INTO  $tableName (Number, Opponent, Week) VALUES ('$teamnumber', '-1', '$week')";
                   mysql_query($query);
                }
            }
            $week++;
        }               
    }
    return $retval;
}

/*
    Function:       FillFantasyFranchiseTable()

    Parameters:     $leagueName     -- Name of league
                    $leagueYear     -- Year of league
                    $numberofTeams  -- Number of teams in league
                    $divisions      -- Number of divisions in league

    Description:    Creates fantasy franchise records based on the number of teams in the league

    Returns:        True if ok
*/

function FillFanastyFranchiseTable($leagueName, $leagueYear, $numberofTeams, $divisions)
{
    $retval = true;

    $tableName = CreateTableName(FANTASY_TEAM_TABLE_NAME, $leagueName, $leagueYear);

    $division = 1;
    for ($i = 0; $i < $numberofTeams; $i++)
    {
        if ($divisions == 2 && $i >= ($numberofTeams / 2))
        {
           $division = 2;
        } 
        $teamNumber = $i + 1;
        $teamName = "Team$teamNumber";
        $owner = "Owner$teamNumber";
        $email = "Owner$teamNumber@devnull.com";
        $password = $teamName;
        $query = "INSERT INTO  $tableName (Number, Name, Owner, Email, Division, Password) VALUES ('$teamNumber', '$teamName', '$owner', '$email', '$division', '$password')";
        mysql_query($query);
    }

    return $retval;
}

/*
    Function:       FillDraftTable()

    Parameters:     $leagueName     -- Name of league
                    $leagueYear     -- Year of league
                    $numberofTeams  -- Number of teams in league
                    $rosterSize     -- Number of players on each team

    Description:    Creates fantasy franchise records based on the number of teams in the league

    Returns:        True if ok


*/

function FillDraftTable($leagueName, $leagueYear, $numberofTeams, $rosterSize)
{
    $retval = true;

    $tableName = CreateTableName(DRAFT_TABLE_NAME, $leagueName, $leagueYear);
    $number = 1;
    for ($round = 1; $round < ($rosterSize + 1); $round++)
    {
        for($teamNumber = 1; $teamNumber < ($numberofTeams + 1); $teamNumber++)
        {
            $query = "INSERT INTO  $tableName (Round, PickNumber, FantasyTeamNumber) VALUES ('$round', '$number', '$teamNumber')";
            mysql_query($query);
            $number++;
        }
    }

    return $retval;
}


/*
    Function:       FillNFLScheduleTable()

    Parameters:     $leagueYear     -- year of league
                    $week           -- schedule week
                    $visitorNumber  -- Visiting team number
                    $homeNumber     -- Home team number
                    $formattedDate  -- Date and time of game in YYYYMMDDHHMMSS format

    Description:    Fills one row of the NFL Schedule table

    Returns:        Nothing
*/

function FillNFLScheduleTable($leagueYear, $week, $visitorNumber, $homeNumber, $formattedDate)
{
    $tableName = CreateGlobalTableName(NFL_SCHEDULE_TABLE_NAME, $leagueYear);
    $query = "INSERT INTO $tableName (Week, VisitorNumber, HomeNumber, GameDate) VALUES ('$week', '$visitorNumber',  '$homeNumber', '$formattedDate')";
    mysql_query($query);
}

/*
    Function:       FillNFLTeamTable()

    Parameters:     $leagueYear     -- year of league
                    $week           -- schedule week
                    $visitorName    -- Name of visiting team 
                    $visitorNumber  -- Visiting team number (0 if the home team has a bye that week)
                    $homeName       -- Name of home team
                    $homeNumber     -- Home team number

    Description:    Fills one row of the NFL Team table 
                    note -- if $visitorNumber == 0 then the homeTeam's bye week == $week

    Returns:        Nothing
*/

function FillNFLTeamTable($leagueYear, $week, $visitorNumber, $visitorName, $homeNumber, $homeName)
{
    $tableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
    if ($visitorNumber == 0)
    {
        $query = "INSERT INTO $tableName (ID, FullName, Bye) VALUES ('$homeNumber', '$homeName', '$week')";
    }
    mysql_query($query);
    if (mysql_affected_rows() == -1 && $visitorNumber == 0)
    {
        $query = "UPDATE $tableName SET Bye='$week' WHERE ID=$homeNumber";        
        mysql_query($query);
    }
}

/*
    Eventually replace FillNFLPlayersTable with this

    For some strange reason this one does not work
*/
/*
function FillNFLPlayersTable($leagueName, $leagueYear) 
{
    $CNFLPlayer = new NFLPlayer($leagueName, $leagueYear);
    $fp = @fopen(INITIAL_OFFENSIVE_PLAYER_URL, 'r') or die("Can not open " . INITIAL_OFFENSIVE_PLAYER_URL);
    $indata = false;
    while($line = @fgets($fp, 100))
    {
        $line = strip_tags($line);              //Remove any HTML tags
        if (strstr($line, "Name"))              //Find the beginning of the data
        {
            $indata = true;
        }
        else if ($indata)
        {
            if (substr($line, 0, 1) == " ")
            {
                break;
            }
            $name        = fixName(trim(substr($line,   INITIAL_OFFENSIVE_PLAYER_NAME_START,
                                                        INITIAL_OFFENSIVE_PLAYER_NAME_LENGTH)));
            $id          = trim(substr($line,           INITIAL_OFFENSIVE_PLAYER_ID_START, 
                                                        INITIAL_OFFENSIVE_PLAYER_ID_LENGTH));
            $team        = trim(substr($line,           INITIAL_OFFENSIVE_TEAM_NAME_START, 
                                                        INITIAL_OFFENSIVE_TEAM_NAME_LENGTH));
            $pos         = trim(substr($line,           INITIAL_OFFENSIVE_PLAYER_POSITION_START, 
                                                        INITIAL_OFFENSIVE_PLAYER_POSITION_LENGTH));
            $teamID      = trim(substr($line,           INITIAL_OFFENSIVE_TEAM_ID_POSITION_START, 
                                                        INITIAL_OFFENSIVE_TEAM_ID_POSITION_LENGTH));

            if (strlen(trim($name)) > 1)
            {
               //No punters
                if ($pos != "P")
                {
                    if ($CNFLPlayer->Exists($id) == false)
                    {
                        $CNFLPlayer->Add($name, $id, $team, $pos, $teamID); 
                    }
                    else
                    {
                        $CNFLPlayer->Update($name, $id, $team, $pos, $teamID); 
                    }                    
                }            
            }
        }
    }
    fclose($fp);
}
*/

/*
    Function:       FillNFLPlayersTables()

    Parameters:     $leagueName     -- Name of league
                    $leagueYear     -- Year of league

    Description:    Reads in the players from the Quickstats player file creating and populating
                    NFL Player records.

    Returns:        Nothing
*/

function FillNFLPlayersTables($leagueName, $leagueYear)
{
    $playerTableName = CreateTableName(NFL_PLAYER_TABLE_NAME, $leagueName, $leagueYear);
    $teamTableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
    
    $masterPlayerTable = CreateGlobalTableName(MASTER_NFL_PLAYER_TABLE_NAME, $leagueYear);


    $fp = @fopen(INITIAL_OFFENSIVE_PLAYER_URL, 'r') or die("Can not open " . INITIAL_OFFENSIVE_PLAYER_URL);
    $indata = false;
    while($line = @fgets($fp, 100))
    {
        $line = strip_tags($line);              //Remove any HTML tags
        if (strstr($line, "Name"))
        {
            $indata = true;
        }
        else if ($indata)
        {
            if (substr($line, 0, 1) == " ")
            {
                break;
            }
            $name        = fixName(trim(substr($line,   INITIAL_OFFENSIVE_PLAYER_NAME_START,
                                                        INITIAL_OFFENSIVE_PLAYER_NAME_LENGTH)));
            $id          = trim(substr($line,           INITIAL_OFFENSIVE_PLAYER_ID_START, 
                                                        INITIAL_OFFENSIVE_PLAYER_ID_LENGTH));
            $team        = trim(substr($line,           INITIAL_OFFENSIVE_TEAM_NAME_START, 
                                                        INITIAL_OFFENSIVE_TEAM_NAME_LENGTH));
            $pos         = trim(substr($line,           INITIAL_OFFENSIVE_PLAYER_POSITION_START, 
                                                        INITIAL_OFFENSIVE_PLAYER_POSITION_LENGTH));
            $teamID      = trim(substr($line,           INITIAL_OFFENSIVE_TEAM_ID_POSITION_START, 
                                                        INITIAL_OFFENSIVE_TEAM_ID_POSITION_LENGTH));

            if (strlen(trim($name)) > 1)
            {

               //No punters
                if ($pos != "P")
                {
                    $query       = "SELECT * FROM $teamTableName WHERE ID='$teamID'";
                    $result      = mysql_query ($query) or die("2query failed $query");
                    $row         = mysql_fetch_object($result);
                    $bye = $row->Bye;
                    if (strlen($row->ShortName) < 1)
                    {
                        $query       = "UPDATE $teamTableName SET ShortName = '$team' WHERE ID='$teamID'";
                        $result      = mysql_query($query) or die("3 query failed $query");
                    }
                    $query = "INSERT INTO $playerTableName (ID) VALUES ('$id')";
                    $result = mysql_query ($query);
                    if (mysql_errno()) 
                    {
                        echo("Updating $name with $team $bye $pos <BR>");
                        $query = "UPDATE $masterPlayerTable SET NFLTeam = '$team', Bye = '$bye', Position = '$pos' WHERE ID='$id'";
                        $result = mysql_query ($query);                        
                    } 
                    else    //Added the else 8/17/03
                    {
                        $query = "INSERT INTO $masterPlayerTable (ID, Name, NFLTeam, Position, Bye) VALUES ('$id', '$name', '$team', '$pos', '$bye')";
                        $result = mysql_query ($query);
                    }
                }            
            }
        }
    }
    fclose($fp);
}

/*
    Function:       CreateNFLDefensesandSpecialTeams()

    Parameters:     $leagueName     -- Name of league
                    $leagueYear     -- Year of league

    Description:    Creates Defenses and Special Teams as players
                    Use the information from the NFL_TEAM_TABLE_NAME
                    defense      = the same number as id
                    special team = id + 100

    Returns:        True if ok

    Note:           These rules are quickstats specific

*/

function CreateNFLDefensesandSpecialTeams($leagueName, $leagueYear)
{
    $retval = true;
    $playerTableName = CreateTableName(NFL_PLAYER_TABLE_NAME, $leagueName, $leagueYear);
    $teamTableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
    $masterPlayerTable = CreateGlobalTableName(MASTER_NFL_PLAYER_TABLE_NAME, $leagueYear);

    $query = "SELECT * FROM $teamTableName";
    $teamTableResult = mysql_query($query);
    while ($teamRow = mysql_fetch_object($teamTableResult))
    {
         //Defense
        $id = $teamRow->ID;
        $name = $teamRow->LongName . " Defense";
        $team = $teamRow->ShortName;
        $pos = "DE";
        $bye = $teamRow->Bye;
        $query = "INSERT INTO $playerTableName (ID) VALUES ('$id')";
        $result = mysql_query ($query) or die("query failed $query");

        $query = "INSERT INTO $masterPlayerTable (ID, NAME, NFLTeam, Position, Bye) VALUES ('$id', '$name', '$team', '$pos', '$bye')";
        $result = mysql_query ($query); 
        //echo(mysql_error() . "<BR>");


        //Special Teams
        $id = $teamRow->ID + 100;
        $name = $teamRow->LongName . " Specials";
        $pos = "SP";
        $query = "INSERT INTO $playerTableName (ID) VALUES ('$id')";
        $result = mysql_query ($query) or die("query failed $query");
        $query = "INSERT INTO $masterPlayerTable (ID, NAME, NFLTeam, Position, Bye) VALUES ('$id', '$name', '$team', '$pos', '$bye')";
        $result = mysql_query ($query);
        //echo(mysql_error() . "<BR>");

    }
    //mysql_free_result($result);
    mysql_free_result($teamTableResult);
    return $retval;
}

/*
    Function:       CreateMasterNFLPlayerTable()

    Parameters:     $leagueYear     -- Year of league

    Description:    Creates the master nfl player table

    Returns:        Nothing
*/

function CreateMasterNFLPlayerTable($leagueYear)
{
    CreateGlobalTable(MASTER_NFL_PLAYER_TABLE_NAME, 
                      MASTER_NFL_PLAYER_TABLE_DEFINITION, 
                      $leagueYear);
}

/*
    Function:       CreateGenericStatTables()

    Parameters:     $leagueYear     -- Year of league

    Description:    Creates the global nfl player stat and description tables.

    Returns:        Nothing
*/

function CreateGenericStatTables($leagueYear)
{
    CreateGlobalTable(NFL_PLAYER_GLOBAL_WEEKLY_STAT_TABLE_NAME, 
                      NFL_PLAYER_GLOBAL_WEEKLY_STAT_TABLE_DEFINITION, 
                      $leagueYear);

    CreateGlobalTable(NFL_STAT_DESCRIPTION_TABLE_NAME,
                      NFL_STAT_DESCRIPTION_TABLE_DEFINITION,
                      $leagueYear);  
    
}

/*
    Function:       FillNFLStatDescription()

    Parameters:     $leagueYear     -- Year of league

    Description:    Empties the description field of the nfl stat description table.

    Returns:        Nothing
*/

function FillNFLStatDescription($leagueYear) 
{
    $tableName = CreateGlobalTableName(NFL_STAT_DESCRIPTION_TABLE_NAME, $leagueYear);
    $query = "INSERT INTO $tableName (Description) VALUES ('')";
    $result = mysql_query ($query) or die("query failed $query");
}


/*
    Function:       CreateAndFillNFLScheduleTable()

    Parameters:     $leagueYear     -- Year of league

    Description:    Reads in the QuickStats schedule file and fills / updates the 
                    NFLTeam table with the bye week for the team as well as the full
                    name.  Function also fills the schedule table from this file.

    Returns:        Nothing

    File Format:    
   
          1         2         3         4         5         6         7
01234567890123456789012345678901234567890123456789012345678901234567890
  1  San Francisco   9027 New York Giants 9015   05-Sep-2002 8:30
 10
*/

function CreateAndFillNFLScheduleTable($leagueYear)
{
    $teamTableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
    $query = "SELECT * From $teamTableName";
    if (!mysql_query($query))
    {
        //Retrieve the last two characters from the year
        $year = substr($leagueYear, 2);
        //Create the url             
        $url = "http://www.quickstats.com/nfl/sched$year.htm";
        //Open the url
        $fp = @fopen($url, 'r') or die("Can not open $url");

        //Create the table here!!!!!
        CreateGlobalTable(NFL_SCHEDULE_TABLE_NAME, NFL_SCHEDULE_TABLE_DEFINITION, $leagueYear);
        CreateGlobalTable(NFL_TEAM_TABLE_NAME, NFL_TEAM_TABLE_DEFINITION, $leagueYear);
        
        $insched = false;
        while($line = @fgets($fp, 4096))
        {
            $line = strip_tags($line);              //Remove any HTML tags
            if ($insched)
            {
                $week = trim(substr($line, 1, 2));
                $visitorName = trim(substr($line, 5, 16));
                $visitorNumber = trim(substr($line, 21, 4));
                $homeName = trim(substr($line, 26, 16));
                $homeNumber = trim(substr($line, 42, 4));
                $gameDate = trim(substr($line, 49, 11));
                $gameTime = trim(substr($line, 61, 5));
                
                if (!is_numeric($week))
                {
                    break;
                }
                else
                {
                    //Create a date time field
                    $fullDate = $gameDate . " " . $gameTime;
                    $timeStamp = strtotime($fullDate);
                    
                    //The hours may be not in millitary time
                    $hours = GetPieceFromTimeStamp($timeStamp, "hours");
                    if ($hours < 12 && $hours != 0)
                    {
                        //Convert to millitary
                        $timeStamp = strtotime("+12 hours", $timeStamp);
                    }
                    //Should be in YYYYMMDDHHMMSS
                    $formattedDate = date("YmdHis", $timeStamp);
                    //Fill the tables here!!!!!
                    FillNFLTeamTable($leagueYear, $week, $visitorNumber, $visitorName, $homeNumber, $homeName);
                    FillNFLScheduleTable($leagueYear, $week, $visitorNumber, $homeNumber, $formattedDate);
                }
            }
            else if (strstr($line, "Week"))
            {
                $insched = true;
            }
        }
        fclose($fp);
    }
}

/*
    Function:       CreateLeagueInfoRecord()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $draftStart -- Time of draft
                    $rosterSize -- Size of rosters

    Description:    Creates and initializes the league info record with the name and year
                    of the league.

    Returns:        Nothing
*/
        
function CreateLeagueInfoRecord($leagueName, $leagueYear, $draftStart, $rosterSize)
{
    $tableName = CreateTableName(LEAGUE_INFO_TABLE_NAME, $leagueName, $leagueYear);
    $query = "INSERT INTO $tableName (Name, Year) VALUES ('$leagueName', '$leagueYear')";
    $result = mysql_query ($query) or die("query failed $query");

    $CLeagueInfo = new LeagueInfo($leagueName, $leagueYear);
    $CLeagueInfo->setDraftStarts($draftStart);
    $CLeagueInfo->setRosterSize($rosterSize);
}

/*
    Function:       doLogin()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $loginname  -- Name of user
                    $password   -- User password

    Description:    Attempts to log the user in for a particular league.

    Returns:        True if password supplied for user is a match, else false
*/

function doLogin($leagueName, $leagueYear, $loginname, $password)
{
    $retval = false;

    $tableName = CreateTableName(FANTASY_TEAM_TABLE_NAME, $leagueName, $leagueYear);

    $query = "Select * FROM $tableName WHERE Name='$loginname'";
    $result = mysql_query ($query);
    if ($result)
    {
        $fantasyTeam = mysql_fetch_object($result);
        if ($fantasyTeam->Activated == 1) 
        {
            if ($password == $fantasyTeam->Password)
            {
                $retval = true;
            }
        }
        mysql_free_result($result);
    }	
    return $retval;
}

/*
    Function:       doLogout()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $teamname  -- Name of user

    Description:    Logs the user out of the draft program by setting the heartbeat
                    timestamp to 0.

    Returns:        Nothing
*/

function doLogout($leagueName, $leagueYear, $teamName) 
{
    $tableName = CreateTableName(HEARTBEAT_TABLE_NAME, $leagueName, $leagueYear);

    $query = "UPDATE $tableName SET Beat='0' WHERE FantasyTeamName='$teamName'";
    mysql_query ($query);
}

/*
    Function:       getNFLTeams()

    Parameters:     $leagueYear -- Year of league

    Description:    Retrieves the NFL Team Full Names from the database as a comma 
                    delimeted string.

    Returns:        Delimeted string
*/

function getNFLTeams($leagueYear)
{
    $retval = "";

    $teamTableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
    $query = "SELECT * From $teamTableName ORDER BY FullName";

    $result = mysql_query($query);
    $num_rows = mysql_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
    {
        $fantasyTeamObject = mysql_fetch_object($result);
        $teamName = $fantasyTeamObject->FullName;
        if ($retval == "")
        {
            $retval = $teamName;
        }
        else
        {
            $retval = $retval . "," . $teamName;
        }
    }
    return $retval;
}

/*
    Function:       GetDraftRecords()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league

    Description:    Retrieves all of the filled draft records (those records where the 
                    drafted NFL player ID is not 0) returning the fields in the following
                    format:

                    Number NFL_Player_Name NFL_Player_NFL_Team NFL_Player_Fantasy_TEAM|...

    Returns:        Delimeted string
*/

function GetDraftRecords($leagueName, $leagueYear)
{
    $tableName = CreateTableName(DRAFT_TABLE_NAME, $leagueName, $leagueYear);
    $query = "SELECT * FROM $tableName WHERE NFLPlayerID != '0' ORDER BY PickNumber";

    $result = mysql_query($query);
    $num_rows = mysql_num_rows($result);
    for ($i = 0; $i < $num_rows; $i++)
    {
        $draftObject = mysql_fetch_object($result);
        $output = trim($draftObject->Number . " " . 
                       $draftObject->NFLPlayerName . " " . 
                       $draftObject->NFLPlayerTeam . " " .
                       $draftObject->FantasyTeamName);
        if ($retval == "")
        {
            $retval = $output;
        }
        else
        {
            $retval = $retval . "|" . $output;
        }
    }
    return $retval;
}

/*
    Function:       FillDraftInfoTable()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league

    Description:    Populates the draft info record with the round, pick and fantasy team name

    Returns:        Nothing
*/

function FillDraftInfoTable($leagueName, $leagueYear)
{
    //Create the draft record object for this particular league
    $CDraft = new Draft($leagueName, $leagueYear);
    //Point to the current draft position (i.e. who's turn)
    $CDraft->GetCurrentPosition();
    
    //Update the draft info table record
    $tableName = CreateTableName(DRAFT_INFO_TABLE_NAME, $leagueName, $leagueYear);
    $query = "INSERT INTO $tableName (Round, Number, FantasyTeamName) VALUES ('$CDraft->Round', '$CDraft->Number', '$CDraft->FantasyTeamName')";
    $result = mysql_query($query);
}

/*
    Function:       makeTimeStamp()

    Parameters:     $timestamp  -- Current date / time as number of milli seconds since Jan 1, 1970

    Description:    Converts a timestamp into the format YYYYMMDDHHMMSS

    Returns:        Timestamp in the form YYYYMMDDHHMMSS

    Note:           Move this to misc.php
*/

function makeTimeStamp($timestamp) 
{
    $day = date("d", $timestamp);
    $month = date("m", $timestamp);
    $year = date("Y", $timestamp);
    $hour = date("H", $timestamp);
    $minute = date("i", $timestamp);
    $second = date("s", $timestamp);

    //Should be in YYYYMMDDHHMMSS
    $retval = $year . $month . $day . $hour . $minute . $second;

    return $retval;
}

/*
    Function:       ImAlive()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $teamName   -- Name of fantasy team

    Description:    Updates the heartbeat table with the current time
                    indicating that the fantasy team is still logged 
                    into the system.

    Retuns:         Nothing
*/

function ImAlive($leagueName, $leagueYear, $teamName) 
{
    $tableName = CreateTableName(HEARTBEAT_TABLE_NAME, $leagueName, $leagueYear);
    $timeStamp = makeTimeStamp(time());
    $query = "SELECT * FROM $tableName WHERE FantasyTeamName = '$teamName'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1) 
    {
        $query = "UPDATE $tableName SET Beat='$timeStamp' WHERE FantasyTeamName = '$teamName'";
    }
    else
    {
        $query = "INSERT INTO $tableName (FantasyTeamName, Beat) VALUES ('$teamName', '$timeStamp')";
    }
    $result = mysql_query($query);
}

/*
    Function:       GetAliveTeams()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league

    Description:    Determines the teams that are logged into the draft 
                    application using the heartbeat table.

    Retuns:         Comma delimeted list of team names
*/

function GetAliveTeams($leagueName, $leagueYear) 
{
    //default to empty list
    $retval = "";
    //Build the table name
    $tableName = CreateTableName(HEARTBEAT_TABLE_NAME, $leagueName, $leagueYear);
    //The threshold for teams logging out of the system is 30 seconds
    $timeStamp = makeTimeStamp(time() - DRAFT_HEARTBEAT_THRESHOLD);
    //Build the query
    $query = "SELECT * FROM $tableName WHERE Beat >= '$timeStamp' ORDER BY Beat";
    //Get the result
    $result = mysql_query($query);
    $i = 0;
    //Build the comma delimeted list
    while ($row = mysql_fetch_object($result)) 
    {
        if ($i == 0) 
        {
            $retval = $retval . $row->FantasyTeamName;
        }
        else
        {
            $retval = $retval . "," . $row->FantasyTeamName;
        }
        $i++;
    }    
    return $retval;
}

function IsLoggedIn($leagueName, $leagueYear, $teamName) 
{
    $retval = false;

    $tableName = CreateTableName(HEARTBEAT_TABLE_NAME, $leagueName, $leagueYear);
    //The threshold for teams logging out of the system is 30 seconds
    $timeStamp = makeTimeStamp(time() - DRAFT_HEARTBEAT_THRESHOLD);
    //Build the query
    $query = "SELECT * FROM $tableName WHERE FantasyTeamName='$teamName' AND Beat >= '$timeStamp'";
    //Get the result
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1) 
    {
        $retval = true;
    }

    return $retval;
}

/*
    Function:       CreateDraftMessage()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $text       -- Text of message to create

    Description:    Populates and saves a new draft text message into the database.
                    Assigns current server time to timestamp field.

    Retuns:         Nothing
*/

function CreateDraftMessage($leagueName, $leagueYear, $text) 
{
    $tableName = CreateTableName(DRAFT_MESSAGE_TABLE_NAME, $leagueName, $leagueYear);
    $timeStamp = makeTimeStamp(time());
    $query = "INSERT INTO $tableName (Message, Stamp) VALUES ('$text', '$timeStamp')";
    $result = mysql_query($query);
}


/*
    Function:       GetLatestMessages()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $lastTime   -- Timestamp 
    
    Description:    Returns all messages from $lastTime on in the form
                    new latest message time,msg1,msg2,msg3,...

                    If lastTime == 0 then return current time 

    Retuns:         Either a delimeted list of messages or the current time
*/

function GetLatestMessages($leagueName, $leagueYear, $lastTime)
{

    if ($lastTime == '0') 
    {
        $retval = makeTimeStamp(time());
    }
    else
    {
        $tableName = CreateTableName(DRAFT_MESSAGE_TABLE_NAME, $leagueName, $leagueYear);
        $query = "SELECT * FROM $tableName WHERE Stamp > '$lastTime' ORDER BY Stamp";
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) 
        {
            $retval = $lastTime;
        }
        else
        {
            $i = 0;
            while ($row = mysql_fetch_object($result)) 
            {
                if ($i == 0) 
                {
                    $retval = $retval . $row->Message;
                }
                else
                {
                    $retval = $retval . "`" . $row->Message;
                }
                $newTime = $row->Stamp;
                $i++;
            }    
            //Put the time of the newest timestamp in front of return
            $retval = $newTime . "`" . $retval;
        }
    }
    return $retval;
}

/*
    Function:       DeleteOldMessages()

    Parameters:     $leagueName -- Name of league
                    $leagueYear -- Year of league
                    $time       -- Timestamp 

    Description:    Deletes all messages older than the timestamp

    Returns:        Nothing
*/

function DeleteOldMessages($leagueName, $leagueYear, $time) 
{
    $deleteTime = makeTimeStamp(time() - $time);
    $tableName = CreateTableName(DRAFT_MESSAGE_TABLE_NAME, $leagueName, $leagueYear);
    $query = "DELETE FROM $tableName Where Stamp <= '$deleteTime'";
    $result = mysql_query($query);
}


/*
   Function:    footballTableExists()

   Parameters:  $link       -- Link to database
                $leagueName -- Name of league
                $leagueYear -- Year of league

   Description: Searches the database for a table name

   Returns:     True if the football table exists
*/

function footballTableExists($link, $leagueName, $leagueYear)
{
    $tableName = CreateTableName(LEAGUE_INFO_TABLE_NAME, $leagueName, $leagueYear);
    return tableExists($link, $tableName);
}
?>