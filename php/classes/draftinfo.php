<?
Class DraftInfo
{
    var $tableName;

    var $round;                 //Round number
    var $number;                //Pick number
    var $fantasyTeamName;       //Name of team who draft's next
    var $locked;                //1 if league locked
    var $newDriverNeeded;       //1 if the driver of the league logged out

    function DraftInfo($leagueName, $yearName)
    {
        $this->tableName = CreateTableName(DRAFT_INFO_TABLE_NAME, $leagueName, $yearName);
    }

    function GetAll()
    {
        $query = "SELECT * FROM $this->tableName";
        $result = mysql_query($query);
        $draftInfoObject = mysql_fetch_object($result);
        $retval = $draftInfoObject->Round . "," . 
                  $draftInfoObject->Number . "," . 
                  $draftInfoObject->FantasyTeamName . "," .
                  $draftInfoObject->Locked . "," .
                  $draftInfoObject->NewDriverNeeded;
                  
        mysql_free_result($result);
        return $retval;
    }

    function UpdateAll($Round, $Number, $FantasyTeamName, $Locked)
    {
        $query = "UPDATE $this->tableName SET Round='$Round', Number='$Number', FantasyTeamName='$FantasyTeamName', Locked='$Locked'";
        $result = mysql_query($query);
    }

    function UpdatePickInformation($Round, $Number, $FantasyTeamName) 
    {
        $query = "UPDATE $this->tableName SET Round='$Round', Number='$Number', FantasyTeamName='$FantasyTeamName'";
        $result = mysql_query($query);
    }

    function Lock()
    {
        $query = "UPDATE $this->tableName SET Locked='1'";
        $result = mysql_query($query);
    }

    function Unlock()
    {
        $query = "UPDATE $this->tableName SET Locked='0'";
        $result = mysql_query($query);
    }
    function getLock() 
    {
        $query = "SELECT Locked FROM $this->tableName";
        $result = mysql_query($query);
        $draftInfoObject = mysql_fetch_object($result);
        $retval = $draftInfoObject->Locked;
        mysql_free_result($result);
        return $retval;
    }

    function UpdateFantasyTeamName($oldname, $newname)
    {
        $query = "UPDATE $this->tableName SET FantasyTeamName='$newname' WHERE FantasyTeamName='$oldname'";
        $result = mysql_query($query);
    }

    function ResetAll($fantasyTeamName) 
    {
        $query = "UPDATE $this->tableName SET Round='1', Number='1', FantasyTeamName='$fantasyTeamName', Locked='0'";
        mysql_query($query);
    }

    function SetNewDriverNeeded($newDriverNeeded) 
    {
        $query = "UPDATE $this->tableName SET NewDriverNeeded='$newDriverNeeded'";
        mysql_query($query);        
    }
}
?>