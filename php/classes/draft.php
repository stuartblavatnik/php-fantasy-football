<?
class Draft extends RecordSet
{
    /*
    //Attributes
    //Table name holders
        var $draftTableName;
        var $nflPlayerTableName;
    //Current position information
        var $round;
        var $fantasyTeamNumber;
        var $fantasyTeamName;
    //Current filled draft record information
        var $number;
        var $fantasyTeamName;
        var $NFLPlayerName;
        var $NFLPlayerTeam;
        var $NFLPlayerPos;
    //Result of last record set retrieval
        var $result_;                
    */

    //Attributes
    //Table name holders
        var $DraftTableName;
        var $NFLPlayerTableName;
        var $FantasyTeamTableName;
    //League Info
        var $leagueName;
        var $leagueYear;
    //Current position information -- From the record itself
        var $Round;
        var $FantasyTeamNumber;
        var $Number;
        var $NFLPlayerID;
    //Current filled draft record information from outer records
        var $FantasyTeamName;       //From fantasy team table
        var $NFLPlayerName;         //From NFL player table
        var $NFLPlayerTeam;         //From NFL player table
        var $NFLPlayerPos;          //From NFL player table
        var $Bye;                   //From NFL player table
    //Result of last record set retrieval
        var $Result_;                

        var $CNFLPlayer;            //NFL Player Object

    /*
        Constructor:    Draft()

        Parameters:     $leagueName -- Name of league
                        $leagueYear -- Year of league

        Description:    Creates the table names needed for draft 
                        functions based on name and year

        Returns:        Nothing
    */

    function Draft($leagueName, $leagueYear)
    {
        $this->DraftTableName = CreateTableName(DRAFT_TABLE_NAME, $leagueName, $leagueYear);
        //$this->NFLPlayerTableName = CreateTableName(NFL_PLAYER_TABLE_NAME, $leagueName, $leagueYear);
        $this->CNFLPlayer = new NFLPlayer($leagueName, $leagueYear);
        
        $this->FantasyTeamTableName = CreateTableName(FANTASY_TEAM_TABLE_NAME, $leagueName, $leagueYear);
        $this->leagueName = $leagueName;
        $this->leagueYear = $leagueYear;
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
        Function:       IsInitialized()

        Parameters:     None

        Description:    Determines if the draft records exist

        Returns:        True if the records exist else false
    */

    function IsInitialized()
    {
        $method = "IsInitialized()";
        $retval = true;
        $query = "Select * FROM $this->DraftTableName";
        $result = mysql_query ($query) or die("$method query failed $query");

        //determine if the draft was set up
        if (mysql_num_rows($result) == 0)
        {
            $retval = false;
        }

        mysql_free_result($result);

        return $retval;
    }


    /*
        define("DRAFT_TABLE_DEFINITION",                    "Round TINYINT(4),
                                                             PickNumber TINYINT(4),
                                                             FantasyTeamNumber TINYINT(4),
                                                             NFLPlayerID MEDIUMINT(9)");

    */

    function DoDraft($playerID)
    {
        $this->GetCurrentPosition();

        $method = "DoDraft()";
        $retval = true;

        //Initially determine if the player is already drafted
        //Get the player record
        $this->CNFLPlayer->GetByID($playerID);
        $this->CNFLPlayer->GetNextRecord();
        if ($this->CNFLPlayer->getDrafted() == 1) 
        {
            $retval = false;
        }
        else
        {
            $this->CNFLPlayer->Draft($this->FantasyTeamName);
            //Update the draft record
            $query = "UPDATE $this->DraftTableName SET NFLPlayerID='$playerID' WHERE PickNumber = '$this->Number'";
            mysql_query ($query);
        }


        return $retval;
    }

    function DoDelete($draftrecord)
    {
        $method = "DoDelete()";
        //Get the draft position to eventually remove
        $query = "SELECT * FROM $this->DraftTableName WHERE PickNumber = '$draftrecord'";
        $result = mysql_query ($query) or die("$method query failed $query");            
        //Get the record and place contents into $draftinfo
        $draftinfo = mysql_fetch_object($result);
        //Get the associated player and mark it as undrafted -- reset other associated fields
    //    $query = "UPDATE $this->NFLPlayerTableName SET FTeam='', Drafted='0', Round='0' WHERE ID = '$draftinfo->NFLPlayerID'";

    //    $result = mysql_query ($query) or die("$method query failed $query");            
        $this->CNFLPlayer->GetByID($draftinfo->NFLPlayerID);
        $this->CNFLPlayer->GetNextRecord();
        $this->CNFLPlayer->Undraft();
        mysql_free_result($result);
        

        //Delete the draft record

        $query = "UPDATE $this->DraftTableName Set NFLPlayerID='0' WHERE PickNumber = '$draftrecord'";
        mysql_query ($query);            

    }

    function IsFinished()
    {
        $method = "IsFinished()";
        $retval = true;
        $query = "Select * FROM $this->DraftTableName WHERE NFLPlayerID = '0' ORDER BY PickNumber";
        $result = mysql_query ($query) or die("$method query failed $query");
        if (mysql_num_rows($result) > 0)
        {
            $retval = false;
        }
        mysql_free_result($result);
        return $retval;
    }

    function GetCurrentPosition()
    {
        $method = "GetCurrentPosition()";
        $query = "Select * FROM $this->DraftTableName WHERE NFLPlayerID = '0' ORDER BY PickNumber";

        $result = mysql_query ($query) or die("$method query failed $query");
        $draftrow = mysql_fetch_object($result);
        $this->Round = $draftrow->Round;
        $this->Number = $draftrow->PickNumber;
        $this->FantasyTeamNumber = $draftrow->FantasyTeamNumber;

    //Now get the fantasy team information
        $query = "SELECT Name FROM $this->FantasyTeamTableName WHERE Number='$this->FantasyTeamNumber'";
        $fantasyTeamNameObject = mysql_query ($query) or die("$method query failed $query");        
        $fantasyTeamNameRow = mysql_fetch_object($fantasyTeamNameObject);

        $this->FantasyTeamName = $fantasyTeamNameRow->Name;

        mysql_free_result($fantasyTeamNameObject);
    }

    function GetFilledDraftRecords()
    {
        $method = "GetFilledDraftRecords()";
        $query = "Select * FROM $this->DraftTableName WHERE NFLPlayerID != '0' ORDER BY PickNumber";
        $this->Result_ = mysql_query ($query) or die("$method query failed $query");
    }


    function GetNumberOfFilledDraftRecords()
    {
        return mysql_num_rows($this->Result_);
    }

    function GetNextFilledDraftRecord()
    {
        $method = "GetNextFilledDraftRecord()";
        $retval = false;
        if ($row = mysql_fetch_object($this->Result_))
        {
            $this->Round = $row->Round;
            $this->FantasyTeamNumber = $row->FantasyTeamNumber;
            $this->Number = $row->PickNumber;
            $this->NFLPlayerID = $row->NFLPlayerID;
    //Now get the fantasy team information
            $query = "SELECT Name FROM $this->FantasyTeamTableName WHERE Number='$this->FantasyTeamNumber'";
            $fantasyTeamNameObject = mysql_query ($query) or die("$method query failed $query");        
            $fantasyTeamNameRow = mysql_fetch_object($fantasyTeamNameObject);
            $this->FantasyTeamName = $fantasyTeamNameRow->Name;
    //Now get the nfl player information 
            $this->CNFLPlayer->GetByID($this->NFLPlayerID);
            $this->CNFLPlayer->GetNextRecord();
            $this->NFLPlayerName = $this->CNFLPlayer->getName();
            $this->NFLPlayerTeam = $this->CNFLPlayer->getNFLTeam();
            $this->NFLPlayerPos = $this->CNFLPlayer->getPosition();  
            $this->Bye = $this->CNFLPlayer->getBye();

            mysql_free_result($fantasyTeamNameObject);

            $retval = true;
        }
        return $retval;
    }

    /*
        Method:         DoQuery()

        Parameters:     None

        Description:    Runs a generic query from the base class after having it's query set

        Returns:        Nothing
    */

    function DoQuery($query)
    {
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
            $this->Round = $row->Round;
            $this->FantasyTeamNumber = $row->FantasyTeamNumber;
            $this->Number = $row->PickNumber;
            $this->NFLPlayerID = $row->NFLPlayerID;
    //Added 9/3/02
            $query = "SELECT Name FROM $this->FantasyTeamTableName WHERE Number='$this->FantasyTeamNumber'";
            $fantasyTeamNameObject = mysql_query ($query) or die("$method query failed $query");        
            $fantasyTeamNameRow = mysql_fetch_object($fantasyTeamNameObject);
            $this->FantasyTeamName = $fantasyTeamNameRow->Name;
    //End Added 9/3/02
            $retval = true;
        }
        return $retval;
    }


    function WriteDraftToFile()
    {
        $CFantasyTeam = new FantasyTeam($this->leagueName, $this->leagueYear);
        $CNFLPlayer = new NFLPlayer($this->leagueName, $this->leagueYear);

        $method = "WriteDraftToFile()";
        //Use League Name and League Year to create name of draft file
        $file = fopen(ABSOLUTE_PATH . "/football/draft/Draft$this->leagueName$this->leagueYear.txt", "w");

        $query = "Select * FROM $this->DraftTableName WHERE NFLPlayerID != '0' ORDER BY PickNumber";
        $this->DoQuery($query);
        while($this->GetNextRecord())
        {
            if ($this->Round != $currentRound)
            {
                if ($this->Round != 1)
                {
                    fwrite($file, "\n");
                }
                fwrite($file, "Round $this->Round\n");
                fwrite($file, "-----------------------------------------------------------------------------\n");
            }
            $currentRound = $this->Round;


    //Now get the fantasy team information
            $query = "SELECT Name FROM $this->FantasyTeamTableName WHERE Number='$this->FantasyTeamNumber'";
            $CFantasyTeam->ExecuteQuery($query);
            $CFantasyTeam->GetNextRecord();
            $FantasyTeamName = $CFantasyTeam->name;        
    //Now get the nfl player information 
            if ($CNFLPlayer->GetByID($this->NFLPlayerID)) 
            {
                $CNFLPlayer->GetNextRecord();

                $NFLPlayerName = $CNFLPlayer->name;
                $NFLPlayerTeam = $CNFLPlayer->NFLTeam;
                $NFLPlayerPos = $CNFLPlayer->pos;
                $NFLPlayerBye = $CNFLPlayer->Bye;

                $outstring = sprintf("%-25s%20s%4s%3s%3s%4s\n", substr($FantasyTeamName, 0, 24), 
                                                                substr($NFLPlayerName, 0, 19),
                                                                substr($NFLPlayerTeam, 0, 3),
                                                                $NFLPlayerPos, 
                                                                $NFLPlayerBye,
                                                                $this->Number);
                fwrite($file, $outstring);
            }

        }

        fclose($file);
    }

    function BuildHTMLOption()
    {
        $retval = "\t<OPTION VALUE='$this->Number'>$this->Number $this->FantasyTeamName $this->NFLPlayerName $this->NFLPlayerTeam $this->NFLPlayerPos $this->Bye\n";
        return $retval;
    }


    /* -- No need anymore only using numbers now
    function UpdateName($oldname, $newname) 
    {
        $query = "UPDATE $this->DraftTableName SET FantasyTeamName='$newname' WHERE FantasyTeamName='$oldname'";
        parent::SetQuery($query);
        parent::DoQuery();
    }
    */


    /*
        Resets all of the draft records to undrafted
    */

    function ResetAll() 
    {
        $query = "UPDATE $this->DraftTableName Set NFLPlayerID='0'";
        mysql_query ($query);            
    }


    function getAllByRound($round) 
    {
        $query = "Select * From $this->DraftTableName WHERE Round='$round'";
        $this->ExecuteQuery($query);
    }

    function getRound() { return $this->Round;}
    function getFantasyTeamNumber() { return $this->FantasyTeamNumber;}
    function getNumber() { return $this->Number;}
    function getNFLPlayerID() { return $this->NFLPlayerID;}
    function getFantasyTeamName() { return $this->FantasyTeamName;}
    function getNFLPlayerName() { return $this->NFLPlayerName;}
    function getNFLPlayerTeam() { return $this->NFLPlayerTeam;}
    function getNFLPlayerPos() { return $this->NFLPlayerPos;}
    function getBye() { return $this->Bye;}

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
        $this->CNFLPlayer->Destroy();       //Added Feb 10, 2003
    }
}

?>