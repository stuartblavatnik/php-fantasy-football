<?
class WeeklyStat extends RecordSet
{
    var $tableName;         //Table name to differentiate leagues
//
    var $id;                //Player ID
    var $week;              //Week stat is for
    var $type;              //Type of statistic
    var $points;            //How much it's worth
    var $length;            //How many or how long

    function WeeklyStat($leagueName, $leagueYear) 
    {
        $this->tableName = CreateTableName(STAT_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->points = $row->Points;
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

    function getID() { return $this->id; }
    function getWeek() { return $this->week; }
    function getType() { return $this->type; }
    function getLength() { return $this->length; }
    function getPoints() { return $this->points; }

    function Add($id, $week, $type, $points, $length) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id' AND Week='$week' AND Type='$type'";
        parent::SetQuery($query);
        parent::DoQuery();
        if (parent::HasRecords()) 
        {
            $query  = "UPDATE $this->tableName SET Points='$points', Length='$length' WHERE ID='$id' AND Week='$week' AND Type='$type'";
            parent::SetQuery($query);
            parent::DoQuery();
        }
        else
        {
            $query = "INSERT INTO $this->tableName (ID, Week, Type, Points, Length) VALUES ('$id', '$week', '$type', '$points', '$length')";
            parent::SetQuery($query);
            parent::DoQuery();
        }
        //echo("$query<BR>");
    }

    function GetSumForPlayerWeek($id, $week)
    {
        $retval = 0;
        $query = "SELECT SUM(Points) as mysum FROM $this->tableName  WHERE ID='$id' AND Week='$week'";

        $result = @mysql_query($query);
        $row = @mysql_fetch_object($result);
        $retval = $row->mysum;
        mysql_free_result($result);

        if ($retval == "") 
        {
            $retval = 0;
        }

        return $retval;
    }

    function GetStatsForPlayerWeek($id, $week) 
    {
        $query = "SELECT * FROM $this->tableName  WHERE ID='$id' AND Week='$week'";
        $this->ExecuteQuery($query);
    }

    function ExistsForPlayerWeek($id, $week) 
    {
        $query = "SELECT * FROM $this->tableName  WHERE ID='$id' AND Week='$week'";
        $result = mysql_query($query);
        $retval = (mysql_num_rows($result) > 0);
        mysql_free_result($result);
        return $retval;
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