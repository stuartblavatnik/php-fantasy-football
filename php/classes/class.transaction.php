<?
Class Transaction extends RecordSet
{
/*
    Module:             class.transaction.php

    Class:              Transaction

    Inherits From:      RecordSet -- This class maps to a database object

    Description:        Represents any fantasy team transaction.  The current list of 
                        transaction types are:

                        TRANSACTION_DROPADD                             -- Drop and add a player
                        TRANSACTION_DROP                                -- Drop a player
                        TRANSACTION_IR                                  -- Place player on injured reserve (ni)
                        TRANSACTION_TRADE                               -- Trade a player
                        TRANSACTION_PAY                                 -- Pay to a fantasy team
                        TRANSACTION_RECEIVE                             -- Receive from a fantasy team
                        TRANSACTION_PAY_TO_LEAGUE                       -- Pay to the league
                        TRANSACTION_OWE_TO_LEAGUE                       -- Owe to league (ni)
                        TRANSACTION_LOSE                                -- Lose a head to head matchup (ni)
                        TRANSACTION_WIN                                 -- Win a head to head matchup (ni)
                        TRANSACTION_TIE                                 -- Tie a head to head matchup (ni)
                        TRANSACTION_SCORE_THRESHOLD                     -- Weekly score threshold
                        TRANSACTION_SIDE_POOL                           -- Side pool (ni)
                        TRANSACTION_PAY_FUTURE_CONSIDERATIONS           -- Descriptive only transaction
                        TRANSACTION_RECEIVE_FUTURE_CONSIDERATIONS       -- Descriptive only transaction
                        

    Database Mapping:   Base name --  FANTASY_TRANSACTION_TABLE_NAME
                        Fields    --  ID MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
                                      Type TINYINT(4) DEFAULT 0,
                                      FromPlayerID MEDIUMINT(9) DEFAULT 0,
                                      ToPlayerID MEDIUMINT(9) DEFAULT 0,
                                      Amount FLOAT(10,2) DEFAULT 0.00,
                                      FantasyFromNumber TINYINT(4) DEFAULT 0,
                                      FantasyToNumber TINYINT(4) DEFAULT 0,
                                      Week TINYINT(4) DEFAULT 0,
                                      TradeDate TIMESTAMP(14),
                                      BaseID MEDIUMINT(9) DEFAULT 0,
*/

    var $tableName;
//attributes
    var $id;                    //Identifier for object
    var $type;                  //Transaction type (see above for possible values)
    var $fromPlayerID;          //From NFL Player 
    var $toPlayerID;            //To NFL Player
    var $amount;                //Cost of transaction
    var $fantasyFromNumber;     //From fantasy franchise
    var $fantasyToNumber;       //To fantasy franchise
    var $week;                  //Week of object
    var $date;                  //Date and time of the transaction    
    var $baseID;                //Used if multiple transactions are part of one large transaction

    //Constructor
    function Transaction($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(FANTASY_TRANSACTION_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->date = $row->TradeDate;
            $this->baseID = $row->BaseID;

            $retval = true;
        }
        return $retval;
    }

    function getID() { return $this->id; }
    function getType() { return $this->type; }
    function getFromPlayerID() { return $this->fromPlayerID; }
    function getToPlayerID() { return $this->toPlayerID; }
    function getAmount() { return $this->amount; }
    function getFantasyFromNumber() { return $this->fantasyFromNumber; }
    function getFantasyToNumber() { return $this->fantasyToNumber; }
    function getWeek() { return $this->week; }
    function getDate() { return $this->date; }
    function getBaseID() { return $this->baseID; }

    function GetByID($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id'";
        $this->ExecuteQuery($query);
    }

    function GetByBaseID($baseID) 
    {
        $query = "SELECT * FROM $this->tableName WHERE BaseID='$baseID'";
        $this->ExecuteQuery($query);
    }

    function CreateNew($type, $fromPlayerID, $toPlayerID, $amount, $fantasyFromNumber, $fantasyToNumber, $week, $tradeDate, $baseID) 
    {
        $query = "INSERT INTO $this->tableName (Type, FromPlayerID, ToPlayerID, Amount, FantasyFromNumber, FantasyToNumber, Week, TradeDate, BaseID) VALUES ('$type', '$fromPlayerID', '$toPlayerID', '$amount', '$fantasyFromNumber', '$fantasyToNumber', '$week', '$tradeDate', BaseID)";
        $this->ExecuteQuery($query);
    }

    function HasRecords() 
    {
        return parent::HasRecords();
    }

    function GetAllOrdered() 
    {
    	$query = "SELECT * FROM $this->tableName ORDER BY TradeDate";
        $this->ExecuteQuery($query);
    }

    function GetAllReverseOrdered() 
    {
    	$query = "SELECT * FROM $this->tableName ORDER BY TradeDate DESC";
        $this->ExecuteQuery($query);
    }

    function GetForTeamOrdered($teamNumber) 
    {
        //Filter out 2 sided trade
    	$query = "SELECT * FROM $this->tableName WHERE  FantasyFromNumber = '$teamNumber' ORDER BY TradeDate";

        $this->ExecuteQuery($query);
    }

    function GetForTeamReverseOrdered($teamNumber) 
    {
        //Filter out 2 sided trade
    	$query = "SELECT * FROM $this->tableName WHERE  FantasyFromNumber = '$teamNumber' ORDER BY TradeDate DESC";

        $this->ExecuteQuery($query);
    }

    function GetForTeamWeekOrdered($teamNumber, $week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE  FantasyFromNumber = '$teamNumber' AND week='$week' ORDER BY TradeDate";
        $this->ExecuteQuery($query);
    }


    /*
        Method:         GetTypeSumForTeam()

        Parameters:     $teamNumber     -- Team
                        $type           -- Type of transaction
    
        Description:    Returns the sum of all of the transactions of a given type for a particular team

        Returns:        Sum
    */

    function GetTypeSumForTeam($teamNumber, $type) 
    {
        $retval = 0;
        $query = "SELECT SUM(Amount) as mytotal FROM $this->tableName WHERE FantasyFromNumber='$teamNumber' AND Type = '$type'";

        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
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