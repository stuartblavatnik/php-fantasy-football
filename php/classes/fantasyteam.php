<?
Class FantasyTeam extends RecordSet
{
    /* Class representation of a fantasy team */
    var $tableName;
//Record variables
    var $name;
    var $number;
    var $owner;
    var $email;
    var $wins;
    var $losses;
    var $ties;
    var $owes;
    var $points;
    var $pct;
    var $oppScore;
    var $division;
    var $blind;                     //1 if blind team
    var $password;                  //team password
    var $publicEmail;               //1 = email displayed for others to see on screens that show rosters
    var $statNotification;          //1 = email sent when stats are updated
    var $transactionNotification;   //1 = email sent when drops and adds are processed
    var $tradeOfferNotification;    //1 = email sent when a trade has been proposed to this team
    var $activated;                 //default 0
    var $timeLoggedIn;              //For draft application
    var $draftDriver;               //For draft application

    function FantasyTeam($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(FANTASY_TEAM_TABLE_NAME, $leagueName, $leagueYear);
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
        Function:       GetFantasyTeamRecord()

        Parameters:     $name -- Name of team to get

        Description:    Gets the record for team

        Returns:        True if ok
    */
    function GetFantasyTeamRecord($name) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Name='$name'";
        $this->ExecuteQuery($query);
        return $this->GetNextRecord();
    }

    function GetByNumber($number) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Number='$number'";
        $this->ExecuteQuery($query);
    }

    function GetByName($name) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Name='$name'";
        $this->ExecuteQuery($query);
    }

    function GetByEmail($email) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Email='$email'";
        $this->ExecuteQuery($query);
    }

    function UpdateName($oldName, $newName) 
    {
        $query = "UPDATE $this->tableName SET Name='$newName' WHERE Name='$oldName'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRecords() 
    {
        $query = "SELECT * FROM $this->tableName";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRecordsOrderByNumber() 
    {
        $query = "SELECT * FROM $this->tableName ORDER BY number";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRecordsOrderByPointsDescending() 
    {
        $query = "SELECT * FROM $this->tableName ORDER BY Points DESC";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRecordsOrderByPointsAscending() 
    {
        $query = "SELECT * FROM $this->tableName ORDER BY Points ASC";
        parent::SetQuery($query);
        parent::DoQuery();
    }


    function GetAllRecordsWithCriteria($criteria) 
    {
        $query = "SELECT * FROM $this->tableName WHERE $criteria";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRecordsOrderBy($orderBy) 
    {
        $query = "SELECT * FROM $this->tableName ORDER BY $orderBy";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRecordsWithCriteriaOrderBy($criteria, $orderBy) 
    {
        $query = "SELECT * FROM $this->tableName WHERE $criteria ORDER BY $orderBy";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllUnactivatedTeams() 
    {
        $query = "SELECT * FROM $this->tableName WHERE Activated='0' ORDER BY Number";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    

    function HasRecords() 
    {
        return parent::HasRecords();
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
            $this->name = $row->Name; 
            $this->number = $row->Number;
            $this->owner = $row->Owner;
            $this->email = $row->Email;
            $this->wins = $row->Wins;
            $this->losses = $row->Losses;
            $this->ties = $row->Ties;
            $this->owes = $row->Owes;
            $this->points = $row->Points;
            $this->pct = $row->PCT;
            $this->oppScore = $row->OppScore;
            $this->division = $row->Division;
            $this->blind = $row->Blind;
            $this->password = $row->Password;
            $this->publicEmail = $row->PublicEmail;
            $this->statNotification = $row->StatNotification;
            $this->transactionNotification = $row->TransactionNotification;
            $this->tradeOfferNotification = $row->TradeOfferNotification;
            $this->activated = $row->Activated;
            $this->timeLoggedIn = $row->TimeLoggedIn;              
            $this->draftDriver = $row->DraftDriver;               

            $retval = true;
        }
        return $retval;
    }

    function getName() { return $this->name; }
    function getNumber() { return $this->number; }
    function getOwner() { return $this->owner; }
    function getEmail() { return $this->email; }
    function getWins() { return $this->wins; }
    function getLosses() { return $this->losses; }
    function getTies() { return $this->ties; }
    function getPoints() { return $this->points; }
    function getPCT() { return $this->pct; }
    function getOpponentScore() { return $this->oppScore; }
    function getDivision() { return $this->division; }
    function getBlind() { return $this->blind; }
    function getPassword() { return $this->password; }
    function getPublicEmail() { return $this->publicEmail; }            
    function getStatNotification() { return $this->statNotification; }            
    function getTransactionNotification() { return $this->transactionNotification; }            
    function getTradeOfferNotification() { return $this->tradeOfferNotification; }            
    function getActivated() { return $this->activated; }
    function getTimeLoggedIn() { return $this->timeLoggedIn; }
    function getDraftDriver() { return $this->draftDriver; }

    function setName($name) { $this->name = $name; }
    function setNumber($number) { $this->number = $number; }

    function setPassword($password) 
    {
        $query = "UPDATE $this->tableName SET Password = '$password' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function setPoints($points) 
    {
        $query = "UPDATE $this->tableName SET Points = '$points' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function setWins($wins) 
    {
        $query = "UPDATE $this->tableName SET Wins = '$wins' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function setLosses($losses) 
    {
        $query = "UPDATE $this->tableName SET Losses = '$losses' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function setTies($ties) 
    {
        $query = "UPDATE $this->tableName SET Ties = '$ties' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function setOpponentScore($opponentScore) 
    {
        $query = "UPDATE $this->tableName SET OppScore = '$opponentScore' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function setPCT($pct) 
    {
        $query = "UPDATE $this->tableName SET PCT = '$pct' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function setActivated($activated) 
    {
        $query = "UPDATE $this->tableName SET Activated = '$activated' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function UpdateEmailInformation($teamNumber, $emailAddress, $public, $stat, $transaction, $trade) 
    {
        $query = "UPDATE $this->tableName SET Email = '$emailAddress', PublicEmail='$public', StatNotification='$stat', TransactionNotification='$transaction', TradeOfferNotification='$trade' WHERE Number = '$teamNumber'";
        mysql_query($query);
    }

//New functions 7/6/03

    function UpdateTimeLoggedIn() 
    {
        $timeStamp = makeTimeStamp(time());     //Get current server time
        $query = "UPDATE $this->tableName SET TimeLoggedIn = '$timeStamp' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    function LogTeamOut() 
    {
        $query = "UPDATE $this->tableName SET TimeLoggedIn = '0' WHERE Number = '$this->number'";
        mysql_query($query);

    }

    function setDraftDriver($driver) 
    {
        $query = "UPDATE $this->tableName SET DraftDriver = '$driver' WHERE Number = '$this->number'";
        mysql_query($query);
    }

    /*
        Function:       getEarliestLoggedInTeam()

        Parameters:     None

        Description:    Gets the team that logged in the earliest and returns that name

        Returns:        Name of fantasy team that logged in earliest
    */

    function getEarliestLoggedInTeam() 
    {
        $retval = "";
        $query = "SELECT * FROM $this->tableName WHERE timeLoggedIn > 0 ORDER BY timeLoggedIn DESC";
        $result = mysql_query($query);
        if ($row = mysql_fetch_object($result))        
        {
            $retval = $row->Name;
        }

        mysql_free_result($result);
        return $retval;
    }

    function getCount() 
    {
        return parent::Count();
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