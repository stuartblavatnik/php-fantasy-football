<?
class NFLPlayerGlobalWeeklyStat extends RecordSet
{
    var $tableName;     //Table name -- specific to year
    var $id;            //Player id
    var $week;          //Stat week
    var $type;          //Stat type
    var $length;        //Length or number

    function NFLPlayerGlobalWeeklyStat($leagueYear) 
    {
        $this->tableName = CreateGlobalTableName(NFL_PLAYER_GLOBAL_WEEKLY_STAT_TABLE_NAME, $leagueYear);
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
            $this->week = $row->Week;
            $this->type = $row->Type;
            $this->length = $row->Length;
            $retval = true;
        }
        return $retval;
    }

    function GetAllForWeek($week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Week='$week'";
        $this->ExecuteQuery($query); 
    }

    function GetAllForPlayerWeek($id, $week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id' AND Week='$week'";
        $this->ExecuteQuery($query); 
    }

    function getID() { return $this->id; }
    function getWeek() { return $this->week; }
    function getType() { return $this->type; }
    function getLength() { return $this->length; }

    function Add($id, $week, $type, $length) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id' AND Week='$week' AND Type='$type'";
        parent::SetQuery($query);
        parent::DoQuery();
        if (parent::HasRecords()) 
        {
            $query  = "UPDATE $this->tableName SET Length='$length' WHERE ID='$id' AND Week='$week' AND Type='$type'";
            parent::SetQuery($query);
            parent::DoQuery();
        }
        else
        {
            $query = "INSERT INTO $this->tableName (ID, Week, Type, Length) VALUES ('$id', '$week', '$type', '$length')";
            parent::SetQuery($query);
            parent::DoQuery();
        }
        //echo("$query<BR>");
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