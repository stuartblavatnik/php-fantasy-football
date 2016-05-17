<?
Class TransactionRule extends RecordSet
{

/*
;ID's
;DROPADD = 1
;DROP = 2
;IR = 3
;TRADE = 4
;PAY = 5
;RECEIVE = 6
;PAY TO LEAGUE = 7
;OWE_TO_LEAGUE = 8
;LOSE = 9
;WIN = 10
;TIE = 11
;THRESHOLD = 12
;
;TYPE's
;0 = Straight calculation AMOUNT
;1 = AMOUNT if threshold is not met
;
;AMOUNT = cost
;
;RECURRING 0 = non recurring, 1 = recurring
;THRESHOLD Value to check to see if amount must be paid
*/

    var $tableName;
//attributes
    var $id;        
    var $type;
    var $amount;
    var $recurring;
    var $threshold;

    //Constructor
    function TransactionRule($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(TRANSACTION_RULE_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->type = $row->Type; 
            $this->amount = $row->Amount;
            $this->recurring = $row->Recurring;
            $this->threshold = $row->Threshold;

            $retval = true;
        }
        return $retval;
    }

    function GetByID($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id'";
        $this->ExecuteQuery($query);
    }

    function GetByIDType($id, $type) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id' AND Type='$type'";
        $this->ExecuteQuery($query);
    }

    function getID() { return $this->id; }
    function getType() { return $this->type; }
    function getAmount() { return $this->amount; }
    function getRecurring() { return $this->recurring; }
    function getThreshold() { return $this->threshold; }

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
        Method:         getCount()

        Parameters:     None

        Description:    Returns the number of records found in the last query

        Returns:        Number
    */
    function getCount() 
    {
        return parent::Count();
    }
}
?>