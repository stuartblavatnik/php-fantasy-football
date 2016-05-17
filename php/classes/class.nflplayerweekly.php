<?
class NFLPlayerWeekly extends RecordSet
{
    var $tableName;
//
    var $id;
    var $NFLTeam;
    var $pos;
    var $fantasyTeam;
    var $fantasyPlayed;
    var $fantasyPositionPlayed;
    var $week;
    var $points;
    var $fantasyPoints;
    var $locked;

    function NFLPlayerWeekly($leagueName, $leagueYear) 
    {
        $this->tableName = CreateTableName(NFL_PLAYER_WEEKLY_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->fantasyTeam = $row->FTeam;
            $this->fantasyPlayed = $row->FPlayed;
            $this->fantasyPositionPlayed = $row->FPOS;
            $this->week = $row->Week;
            $this->points = $row->Points;
            $this->fantasyPoints = $row->FPoints;
            $this->locked = $row->Locked;

            $retval = true;
        }

        return $retval;
    }

    function GetAllRecordsWithCriteria($criteria) 
    {
        $query = "SELECT * FROM $this->tableName WHERE $criteria";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function getID() { return $this->id; }
    function getNFLTeam() { return $this->NFLTeam; }
    function getPosition() { return $this->pos; }
    function getFantasyTeamNumber() { return $this->fantasyTeam; }
    function getFantasyPlayed() { return $this->fantasyPlayed; }
    function getFantasyPositionPlayed() { return $this->fantasyPositionPlayed; }
    function getWeek() { return $this->week; }
    function getPoints() { return $this->points; }
    function getFantasyPoints() { return $this->fantasyPoints; }
    function getLocked() { return $this->locked; }

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

    function getSumForWeek($teamNumber, $week) 
    {
        $retval = 0;
        $query = "SELECT SUM(Points) as mytotal FROM $this->tableName WHERE FTeam='$teamNumber' AND FPlayed='1' AND Week='$week'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
    }

    function GetSumForAllWeeks($id) 
    {
        $retval = 0;
        $query = "SELECT SUM(Points) as mytotal FROM $this->tableName WHERE ID='$id'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
    }

    function GetSumForAllWeeksUpToWeek($id, $week) 
    {
        $retval = 0;
        $query = "SELECT SUM(Points) as mytotal FROM $this->tableName WHERE ID='$id' AND Week < '$week'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
    }

    function GetSumRange($id, $from, $to) 
    {
        $retval = 0;
        $query = "SELECT SUM(Points) as mytotal FROM $this->tableName WHERE ID='$id' AND Week >= $from AND Week <= '$to'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
    }

/*
    define("NFL_PLAYER_WEEKLY_TABLE_NAME", "_nfl_player_weekly");
    define("NFL_PLAYER_WEEKLY_TABLE_DEFINITION",        "ID MEDIUMINT(9) NOT NULL,  
                                                         NFLTeam TINYTEXT NOT NULL,
                                                         Pos TINYTEXT NOT NULL,
                                                         FTeam TINYINT(4) DEFAULT 0,
                                                         FPlayed TINYINT(4) DEFAULT 0,
                                                         FPOS TINYTEXT NOT NULL,
                                                         Week TINYINT(4) DEFAULT 0,
                                                         Points TINYINT(4) DEFAULT 0,
                                                         FPoints TINYINT(4) DEFAULT 0,
                                                         Locked TINYINT(4) DEFAULT 0,
                                                         PRIMARY KEY(ID)");

*/

    /*
        Parameters:     $id                 -- player id
                        $playedPosition     -- where the player was played 
                        $played             -- 1 == fantasy team played it
                        $week               -- week number
                        $points             -- standard points
                        $fpoints            -- points if fantasy team played it
    */

    function Add($id, $playedPosition, $played, $week, $points, $fpoints, $fantasyTeamNumber) 
    {
        $query = "INSERT INTO $this->tableName (ID, FPOS, FPlayed, Week, Points, FPoints, FTeam) VALUES ('$id', '$playedPosition', '$played', '$week', '$points', '$fpoints', '$fantasyTeamNumber')";
        $this->ExecuteQuery($query);
    }

    function Exists($id, $week) 
    {
        $retval = false;
        $query = "SELECT * FROM $this->tableName WHERE ID='$id' AND Week='$week'";
        $result = mysql_query($query);
        $val = mysql_num_rows($result);
        if ($val > 0)
        {
            $retval = true;
        }
        mysql_free_result($result);
        return $retval; 
    }

    function Update($id, $playedPosition, $played, $week, $points, $fpoints, $fantasyTeamNumber) 
    {
        $query = "UPDATE $this->tableName SET Points='$points', FPoints='$fpoints', FTeam='$fantasyTeamNumber' WHERE ID='$id' AND Week='$week'";
        $this->ExecuteQuery($query);
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