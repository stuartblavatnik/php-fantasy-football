<?
class ScoreRule extends RecordSet
{
    var $tableName;
//
    var $id;
    var $type;
    var $worth;
    var $minVal;
    var $maxVal;
    var $pos;
    var $description;

    function ScoreRule($leagueName, $leagueYear) 
    {
        $this->tableName = CreateTableName(SCORE_RULE_TABLE_NAME, $leagueName, $leagueYear);
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

    function GetAll() 
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
            $this->id = $row->ID;
            $this->type = $row->Type;
            $this->worth = $row->Worth;
            $this->minVal = $row->MinVal;
            $this->maxVal = $row->MaxVal;
            $this->rate = $row->Rate;
            $this->pos = $row->Pos;
            $this->description = $row->Description;
            $retval = true;
        }
        return $retval;
    }

    function getID() { return $this->id; }
    function getType() { return $this->type; }
    function getWorth() { return $this->worth; }
    function getMinVal() { return $this->minVal; }
    function getMaxVal() { return $this->maxVal; }
    function getRate() { return $this->rate; }
    function getPosition() { return $this->pos; }
    function getDescription() { return $this->description; }

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

    function GetByID($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id'";
        $this->ExecuteQuery($query);
    }

}
?>