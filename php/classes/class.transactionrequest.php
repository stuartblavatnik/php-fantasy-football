<?
Class TransactionRequest extends RecordSet
{

/*

A transaction request represents a request to do a transaction in the future.

An example would be one team requesting to trade players from another team.
Another example would be one team requesting to drop a player from the roster
and adding a free agent.

Types
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
*/

    var $tableName;
//attributes
    var $id;                    //Identifier for object
    var $type;                  //Transaction request type (see above for possible values)
    var $fromPlayerID;          //From NFL Player 
    var $toPlayerID;            //To NFL Player
    var $amount;                //Cost of transaction
    var $fantasyFromNumber;     //From fantasy franchise
    var $fantasyToNumber;       //To fantasy franchise
    var $week;                  //Week of object
    var $accepted;              //1 if the transaction request has been accepted else 0 
    var $viewed;                //1 if the toFranchise has seen the trade
    var $priority;              //The lower the value the higher the priority of the transaction
    var $contingentOn;          //ID representing another TransactionRequest that must occur (i.e. accepted == 1) for this one to occur
    var $BaseID;                //Used for multi-player / $$$ transactions (same id for multiple linked transactions)

    //Constructor
    function TransactionRequest($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(FANTASY_TRANSACTION_REQUEST_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->fromPlayerID = $row->FromPlayerID;
            $this->toPlayerID = $row->ToPlayerID;
            $this->amount = $row->Amount;
            $this->fantasyFromNumber = $row->FantasyFromNumber;
            $this->fantasyToNumber = $row->FantasyToNumber;
            $this->week = $row->Week;
            $this->accepted = $row->Accepted;
            $this->viewed = $row->Viewed;
            $this->priority = $row->Priority;
            $this->contingentOn = $row->ContingentOn;
            $this->BaseID = $row->BaseID;


            $retval = true;
        }
        return $retval;
    }

    function GetByID($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id'";
        $this->ExecuteQuery($query);
    }

    function GetByBaseID($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE BaseID='$id'";
        $this->ExecuteQuery($query);
    }

    function GetByFromPlayerPriorityOrder($playerID, $direction)    //direction is ASC or DESC
    {
        $query = "SELECT * FROM $this->tableName WHERE FantasyFromNumber='$playerID' ORDER BY Priority $direction";
        $this->ExecuteQuery($query);
    }

    function getID() { return $this->id; }
    function getType() { return $this->type; }
    function getFromPlayerID() { return $this->fromPlayerID; }
    function getToPlayerID() { return $this->toPlayerID; }
    function getAmount() { return $this->amount; }
    function getFantasyFromNumber() { return $this->fantasyFromNumber; }
    function getFantasyToNumber() { return $this->fantasyToNumber; }
    function getWeek() { return $this->week; }
    function getAccepted() { return $this->accepted; }
    function getViewed() { return $this->viewed; }
    function getPriority() { return $this->priority; }
    function getContingentOnID() { return $this->contingentOn; }
    function getBaseID() { return $this->BaseID; }

    function markAsAccepted() 
    {
        $query = "UPDATE $this->tableName SET Accepted='1' WHERE ID='$this->id'";
        $this->ExecuteQuery($query);
    }

    function RemoveAllBase($baseID) 
    {
        $query = "DELETE FROM $this->tableName WHERE BaseID='$baseID'";
        $this->ExecuteQuery($query);
    }

    function RemoveAll()
    {
        $query = "DELETE FROM $this->tableName";
        $this->ExecuteQuery($query);
    }

    function CreateBaseTradeTransaction($transactionType, 
                                        $yourPlayerID,
                                        $tradePartnerID,
                                        $yourFantasyTeamID,
                                        $tradePartnerFantasyTeamID,
                                        $week) 
    {
        $query = "INSERT $this->tableName (Type, FromPlayerID, ToPlayerID, FantasyFromNumber, FantasyToNumber, Week) VALUES ('$transactionType', '$yourPlayerID', '$tradePartnerID', '$yourFantasyTeamID', '$tradePartnerFantasyTeamID', '$week' )";
        $this->ExecuteQuery($query);
        //get the last updated id -- This will be used for all subsequent trades for this main trade
        $this->BaseID = parent::GetLastIDSaved();
        $query = "UPDATE $this->tableName SET BaseID='$this->BaseID' WHERE ID='$this->BaseID'";
        $this->ExecuteQuery($query);
    }

    function CreateTradeTransaction($transactionType, 
                                    $yourPlayerID,
                                    $tradePartnerID,
                                    $yourFantasyTeamID,
                                    $tradePartnerFantasyTeamID,
                                    $moneyAmt,
                                    $week,
                                    $baseID)
    {
        $query = "INSERT $this->tableName (Type, FromPlayerID, ToPlayerID, FantasyFromNumber, FantasyToNumber, Week, Amount, BaseID) VALUES ('$transactionType', '$yourPlayerID', '$tradePartnerID', '$yourFantasyTeamID', '$tradePartnerFantasyTeamID', '$week', '$moneyAmt', '$baseID' )";
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