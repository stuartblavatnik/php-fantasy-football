<?
class NFLStatDescription extends RecordSet
{
    /*
        Class representation of when the global stats were last imported
    */

    var $tableName;
//
    var $week;                  //Import week
    var $description;           //Quickstats description (Really Early, Early, Final)

    function NFLStatDescription($leagueYear) 
    {
        $this->tableName = CreateGlobalTableName(NFL_STAT_DESCRIPTION_TABLE_NAME, $leagueYear);
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
            $this->week = $row->Week;
            $this->description = $row->Description;
            $retval = true;
        }
        return $retval;
    }

    function getWeek() { return $this->week; }
    function getDescription() { return $this->description; }

    function setDescription($newDescription) 
    {
        $query = "UPDATE $this->tableName SET Description='$newDescription'";
        $this->ExecuteQuery($query);
    }

    function setWeek($week) 
    {
        $query = "UPDATE $this->tableName SET Week='$week'";
        $this->ExecuteQuery($query);
    }

    function GetAll() 
    {
        $query = "SELECT * FROM $this->tableName";
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