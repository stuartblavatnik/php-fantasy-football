<?
Class PositionDistribution extends RecordSet
{
    var $tableName;
//
    var $position;      //String 
    var $amount;        //Number representing the number of a particular position to draft
    var $remaining;     //Number representing the number of a particular position that was drafted

    function PositionDistribution($leagueName, $leagueYear, $fantasyTeamNumber, $link)
    {
        $baseTableName = "_" . $fantasyTeamNumber . "_POSITION_DISTRIBUTION";
        $this->tableName = CreateTableName($baseTableName, $leagueName, $leagueYear);

        if (!tableExists($link, $this->tableName)) 
        {
            CreateTable($this->tableName, POSITION_DISTRIBUTION_TABLE_DEFINITION);
        }
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
            $this->position = $row->Position;
            $this->amount = $row->Amount;
            $this->remaining = $row->Remaining;
            $retval = true;
        }
        return $retval;
    }
    
    //Getters -- Called after GetNextRecord()
    function getPosition() { return $this->position; }
    function getAmount() { return $this->amount; }
    function getRemaining() { return $this->remaining; }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function Add($position, $amount) 
    {
        $query = "INSERT INTO $this->tableName (Position, Amount, Remaining) VALUES ('$position', '$amount', '$amount')";
        mysql_query($query);
    }

    function Update($position, $amount) 
    {
        $query = "UPDATE $this->tableName SET Amount='$amount', Remaining='$amount' WHERE Position='$position'";
        mysql_query($query);
    }

    function DecrementPosition($position)
    {
        $query = "SELECT * FROM $this->tableName WHERE Position = '$position'";
        $result = mysql_query($query);
        $row = mysql_fetch_object($result);

        $newValue = $row->Remaining - 1;        

        $query = "UPDATE $this->tableName SET Remaining = '$newValue' WHERE Position='$position'";
        mysql_query($query);
        
        mysql_free_result($result);
    }

    function ResetAllToUserDefaults()
    {
        $query = "SELECT * FROM $this->tableName";
        $result = mysql_query($query);
        while ($row = mysql_fetch_object($result)) 
        {
            $origValue = $row->Amount;
            $position = $row->Position;
            $query = "UPDATE $this->tableName SET Remaining = '$origValue' WHERE Position='$position'";
            mysql_query($query);
        }

        mysql_free_result($result);
    }

    function GetAll() 
    {
        $query = "SELECT * FROM $this->tableName";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetByPosition($position) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Position = '$position'";
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

    /*
        Method:         Destroy()

        Parameters:     None

        Description:    Frees the internal memory associated with this recordset

        Returns:        Nothing
    */
    function Destroy()
    {
        parent::Destroy();
    }

}
?>