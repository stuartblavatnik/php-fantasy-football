<?
Class LineupDefinition extends RecordSet
{
    var $tableName;     //Internal table name (specific to league name and year)
//Attributes    
    var $position;      //Position name (ex. QB, WR, etc)
    var $allowed;       //Comma delimited string of other positions that this position can be used as
    var $queryAllowed;  //Values used in sql queties for allowable positions (seems to be the same as above)
    var $ord;           //Order of positions in display lists
    var $realPosition;  //1 if position represents a real NFL position (ex SW == 0)

    /*
        Constructor

        Parameters:     $leagueName -- Name of league
                        $leagueYear -- Year of league
    */
    function LineupDefinition($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(LINEUP_DEFINITION_TABLE_NAME, $leagueName, $leagueYear);
    }

    /*
        Method:         SelectAllDistinct()

        Parameters:     None

        Description:    Sets the internal recordset to distinct records based on all fields

        Returns:        Nothing

        Note: If any of the fields selected in the distinct function are different, then all the records 
        will be retrieved
    */
    function SelectAllDistinct() 
    {
        $query = "SELECT DISTINCT position, allowed, queryallowed, RealPosition FROM $this->tableName ORDER BY ord";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function SelectAllRealDistinct() 
    {
        $query = "SELECT DISTINCT position, allowed, queryallowed, RealPosition FROM $this->tableName WHERE RealPosition = '1' ORDER BY ord";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function SelectAllOrdered() 
    {
        $query = "SELECT * FROM $this->tableName ORDER BY ord";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function SelectAll() 
    {
        $query = "SELECT * FROM $this->tableName";
        parent::SetQuery($query);
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
            $this->position = $row->position;
            $this->allowed = $row->allowed; 
            $this->queryAllowed = $row->queryallowed;
            $this->ord = $row->ord;
            $this->realPosition = $row->RealPosition;

            $retval = true;
        }
        return $retval;
    }

    function getPosition() { return $this->position; }
    function getAllowed() { return $this->allowed; }
    function getQueryAllowed() { return $this->queryAllowed; }
    function getOrd() { return $this->ord; }
    function getRealPosition() { return $this->realPosition; }

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

    /*
        Method:         GetScoredAs()

        Parameters:     $position -- Position to determine how to score

        Description:    Determines if a position (as defined in the allowed portion of the lineup definition
                        record exists)  If so, return the associated real position

        Returns:        Real position or blank if position not found
    */
    function GetScoredAs($position) 
    {
        $retval = "";
        $query = "SELECT DISTINCT position, allowed, queryallowed, RealPosition FROM $this->tableName WHERE RealPosition = '1'";
        $result = mysql_query($query);
        while ($resultrow = mysql_fetch_object($result)) 
        {
            $pos = strpos($resultrow->allowed, $position);
            if ($pos === false) 
            { // note: three equal signs
                // not found...
                //Keep going
            }
            else
            {
                $retval = $resultrow->position;
                break;
            }
        }

        mysql_free_result($result);
        return $retval;
    }

}
?>