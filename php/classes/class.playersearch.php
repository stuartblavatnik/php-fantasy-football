<?
class PlayerSearch extends RecordSet
{
    var $tableName;
    var $startWeek;
    var $endWeek;
//
    var $id;
    var $name;
    var $NFLTeam;
    var $postion;
    var $points;
    var $bye;

    /*
        
    */

    function PlayerSearch($leagueName, $leagueYear, $teamNumber, $startWeek, $endWeek) 
    {
        $this->startWeek = $startWeek;
        $this->endWeek = $endWeek;
        $this->tableName = CreateTableName(SEARCH_PLAYER_POINTS_NAME, $leagueName, $leagueYear);
        $this->tableName .= "_" . $startWeek . "_". $endWeek . "_" . time();
        CreateTemporaryTable($this->tableName, SEARCH_PLAYER_POINTS_DEFINITION);
    }

/*
    define("SEARCH_PLAYER_POINTS_DEFINITION",           "ID MEDIUMINT(9) NOT NULL
                                                         Name TINYTEXT NOT NULL,
                                                         NFLTeam TINYTEXT NOT NULL,
                                                         Position TINYTEXT NOT NULL,
                                                         Points SMALLINT(6) DEFAULT 0,
                                                         Bye TINYINT(4) DEFAULT 0,
                                                         PRIMARY KEY(ID)");
*/

    function AddPlayer($id,
                       $name,
                       $nflteam,
                       $position,
                       $bye, 
                       $points)
    {
        $query = "INSERT INTO $this->tableName (ID, Name, NFLTeam, Position, Points, Bye) 
                  VALUES ('$id', '$name', '$nflteam', '$position', '$points', '$bye');";
        $this->ExecuteQuery($query);
    }

    function SortByPoints()
    {
        $query = "SELECT * FROM $this->tableName ORDER BY Points DESC";
        $this->ExecuteQuery($query);
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
            $this->name = $row->Name; 
            $this->NFLTeam = $row->NFLTeam;
            $this->Bye = $row->Bye;
            $this->position = $row->Position;
            $this->points = $row->Points;    

            $retval = true;
        }
        return $retval;
    }

    function getPoints() { return $this->points; }
    function getID() { return $this->id; }
    function getName() { return $this->name; }
    function getPosition() { return $this->position; }
    function getNFLTeam() { return $this->NFLTeam; }
    function getBye() { return $this->Bye; }

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