<?
class LeagueInfo
{
    //Properties
    var $name;                      //name of league
    var $year;                      //year of league
    var $maintenance;               //Set to 1 to bring the site down
    var $currentWeek;               //Current week of league
    var $gamesStarted;              //Set to 1 once the earliest game has started  (REMOVE)
    var $earlyStatsImported;        //Set to 1 on Monday after the stats are imported (REMOVE)
    var $lineupsLocked;             //Set to 1 on Sunday at 1:00 PM (REMOVE)
    var $transactionsLocked;        //Set to 1 on the day of the earliest game of the week at 3PM (REMOVE)
    var $statDescription;           //Text version of what Quickstats returns from their web page
    var $draftComplete;             //1 when completed
    var $draftStarts;               //Timestamp when the draft starts
    var $rosterSize;                //roster size for each franchise

    //Constructor
    function LeagueInfo($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(LEAGUE_INFO_TABLE_NAME, $leagueName, $leagueYear);
        $query = "Select * From $this->tableName";
        $leagueInfoResult = mysql_query ($query);
        $leagueInfoObject = mysql_fetch_object($leagueInfoResult);
        $this->name = $leagueInfoObject->Name;
        $this->year = $leagueInfoObject->Year;
        $this->currentWeek = $leagueInfoObject->CurrentWeek;
        $this->gamesStarted = $leagueInfoObject->GamesStarted;
        $this->earlyStatsImported = $leagueInfoObject->EarlyStatsImported;
        $this->lineupsLocked = $leagueInfoObject->LineupsLocked;
        $this->maintenance = $leagueInfoObject->Maintenance;
        $this->transactionsLocked = $leagueInfoObject->TransactionsLocked;
        $this->statDescription = $leagueInfoObject->StatDescription;
        $this->draftComplete = $leagueInfoObject->DraftComplete;
        $this->draftStarts = $leagueInfoObject->DraftStarts;
        $this->rosterSize = $leagueInfoObject->RosterSize;

        mysql_free_result($leagueInfoResult);
    }

    function getName() { return $this->name; }
    function getYear() { return $this->year; }
    function getMaintenance() { return $this->maintenance; }
    function getCurrentWeek() { return $this->currentWeek; }
    function getGamesStarted() { return $this->getGamesStarted; }
    function getEarlyStatsImported() { return $this->earlyStatsImported; }
    function getLineupsLocked() { return $this->lineupsLocked; }
    function getTransactionsLocked() { return $this->transactionsLocked; }
    function getStatDescription() { return $this->statDescription; }
    function getDraftComplete() { return $this->draftComplete; }
    function getDraftStarts() { return $this->draftStarts; }
    function getRosterSize() { return $this->rosterSize; }

    function setStatDescription($description) 
    {
        $query = "UPDATE $this->tableName SET StatDescription='$description'";
        $result = mysql_query($query);
    }

    function SetDraftComplete($value)
    {
        $query = "UPDATE $this->tableName Set DraftComplete='$value'";
        $result = mysql_query($query);
    }

    function setDraftStarts($value) 
    {
        $query = "UPDATE $this->tableName Set DraftStarts='$value'";
        $result = mysql_query($query);
    }

    function setRosterSize($value) 
    {
        $query = "UPDATE $this->tableName Set RosterSize='$value'";
        $result = mysql_query($query);
    }

    function ClearStatDescription() 
    {
        $query = "UPDATE $this->tableName SET StatDescription=''";
        $result = mysql_query($query);
    }

    function IncrementWeek() 
    {
        $week = $this->currentWeek + 1;
        $query = "UPDATE $this->tableName SET CurrentWeek='$week'";
        $result = mysql_query($query);
        $this->currentWeek = $week;
    }

    function lockAllRosters() 
    {
        $query = "UPDATE $this->tableName SET LineupsLocked='1'";
        $result = mysql_query($query);
    }

    function unlockAllRosters($leagueName, $leagueYear) 
    {
        $query = "UPDATE $this->tableName SET LineupsLocked='0'";
        $result = mysql_query($query);
    }

}

?>