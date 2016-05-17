<?
class WeeklyLineup extends RecordSet
{
/*
    define("WEEKLY_LINEUP_TABLE_DEFINTION",             "ID MEDIUMINT(9) DEFAULT 0,
                                                         NFLTeam TINYTEXT NOT NULL,
                                                         Pos TINYTEXT NOT NULL,
                                                         FTeamNum TINYINT(4) DEFAULT 0,
                                                         FPos TINYTEXT NOT NULL,
                                                         Week TINYINT(4) DEFAULT 0,
                                                         Locked TINYINT(4) DEFAULT 0,
                                                         KEY(ID),
                                                         KEY(Week)");

*/

    var $tableName;                                 //Database Table Name
//
    var $id;                                        //NFL PlayerID
    var $NFLTeam;                                   //NFL Team Name
    var $pos;                                       //NFL Position
    var $fantasyTeamNumber;                         //Fantasy team number played for
    var $playedPosition;                            //Fantasy position played for
    var $week;                                      //Week the line up was for 
    var $locked;                                    //If this lineup item is locked (not needed anymore)

    function WeeklyLineup($leagueName, $leagueYear) 
    {
        $this->tableName = CreateTableName(WEEKLY_LINEUP_TABLE_NAME, $leagueName, $leagueYear);
    }

    /*
        Method:         ExecuteQuery()

        Parameters:     $query      -- SQL Query

        Description:    Runs a generic query using the base class method

        Returns:        Nothing
    */

    function ExecuteQuery($query) 
    {
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         DoQuery()

        Parameters:     None

        Description:    Runs a generic query from the base class after having it's query set

        Returns:        Nothing
    */

    function DoQuery()
    {
        parent::DoQuery();
    }

    /*
        Method:         GetNextRecord() 

        Parameters:     None

        Description:    Attempts to retrieve the next record in the record set 
                        and updates the classes variables from that record.

        Returns:        True if there was a next record else false.
    */

    function GetNextRecord()
    {
        $retval = false;

        if ($row = parent::GetNextRecord())
        {
            $this->id = $row->ID;
            $this->NFLTeam = $row->NFLTeam;
            $this->pos = $row->Pos;
            $this->fantasyTeamNumber = $row->FTeamNum;
            $this->playedPosition = $row->FPos;
            $this->week = $row->Week;
            $this->locked = $row->Locked;

            $retval = true;
        }

        return $retval;
    }

    function getID() { return $this->id; }
    function getNFLTeam() { return $this->NFLTeam; }
    function getPosition() { return $this->pos; }
    function getFantasyTeamNumber() { return $this->fantasyTeamNumber; }
    function getPlayedPosition() { return $this->playedPosition; }
    function getWeek() { return $this->week; }
    function getLocked() { return $this->locked; }

    /*
        Determines if the team had a lineup submitted for the week
    */

    function Exists($fantasyTeamNumber, $week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE FTeamNum='$fantasyTeamNumber' AND Week='$week'";
        $result = mysql_query($query);
        $retval = (mysql_num_rows($result) > 0);
        mysql_free_result($result);
        return $retval;
    }

    /*
        Determines if a team played a particular player for a particular week
    */

    function ExistsForNFLPlayer($fantasyTeamNumber, $week, $id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE FTeamNum='$fantasyTeamNumber' AND Week='$week' AND ID='$id'";
        $result = mysql_query($query);
        $retval = (mysql_num_rows($result) > 0);
        mysql_free_result($result);
        return $retval;
    }

    function ExistsForNFLPlayerWeek($week, $id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Week='$week' AND ID='$id'";
        $result = mysql_query($query);
        $retval = (mysql_num_rows($result) > 0);
        mysql_free_result($result);
        return $retval;
    }

    function GetNFLPlayerWeek($week, $id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Week='$week' AND ID='$id'";
        $this->ExecuteQuery($query);
    }

    function GetAllRecordsWithCriteria($criteria) 
    {
        $query = "SELECT * FROM $this->tableName WHERE $criteria";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllForFantasyTeamWeek($fantasyTeamNumber, $week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE FTeamNum='$fantasyTeamNumber' AND Week='$week'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllForFantasyTeamWeekPositionPlayed($fantasyTeamNumber, $week, $fplayed) 
    {
        $query = "SELECT * FROM $this->tableName WHERE FTeamNum='$fantasyTeamNumber' AND Week='$week' AND FPos='$fplayed'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         getCount()

        Parameters:     None

        Description:    Returns the number of records found in the last query

        Returns:        Number
    */
    function getCount() 
    {
        return parent::Count();
    }

    function DeleteForFantasyTeamWeek($fantasyTeamNumber, $week) 
    {
        $query = "DELETE FROM $this->tableName WHERE Week = '$week' AND FTeamNum = '$fantasyTeamNumber'";
        $result = mysql_query($query);
        //mysql_free_result($result);
    }

    function AddRow($nflPlayerID, $nflPlayerTeam, $nflPlayerPosition, $fantasyTeamNumber, $fantasyPosition, $week) 
    {
        $query = "INSERT INTO $this->tableName (ID, NFLTeam, Pos, FTeamNum, FPos, Week) VALUES ('$nflPlayerID', '$nflPlayerTeam', '$nflPlayerPosition', '$fantasyTeamNumber', '$fantasyPosition', '$week')";
        $result = mysql_query($query);
        //mysql_free_result($result);

    }

    /*
        Method:         Destroy()

        Parameters:     None

        Description:    Frees the internal memory associated with the 
                        recordset associated with this object.

        Returns:        Nothing
    */
    function Destroy()
    {
        parent::Destroy();
    }

}
?>