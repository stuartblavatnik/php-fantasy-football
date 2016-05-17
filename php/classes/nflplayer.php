<?
Class NFLPlayer extends RecordSet
{
    var $tableName;
    var $teamTableName;
    var $masterTableName;
//
    var $ID;
    var $name;
    var $pos;
    var $NFLTeam;
    var $Bye;
    var $fantasyTeam;
    var $drafted;
    var $round;
    var $points;
    var $fullName;          //Composite of Full Team Name and name when the player is a defense or special team    
//Queries
    var $positionQuery;
    var $NFLTeamQuery;
    var $ExcludeByeWeeksQuery;

    var $allFieldsFromBothTables;
    /*
        Constructor
    */

    function NFLPlayer($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(NFL_PLAYER_TABLE_NAME, $leagueName, $leagueYear);
        $this->teamTableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
        $this->masterTableName = CreateGlobalTableName(MASTER_NFL_PLAYER_TABLE_NAME, $leagueYear);
        $this->allFieldsFromBothTables = " $this->masterTableName.ID, $this->masterTableName.Name, $this->masterTableName.NFLTeam, $this->masterTableName.Position, $this->masterTableName.Bye, $this->tableName.FTeam, $this->tableName.Drafted, $this->tableName.Round, $this->tableName.Points ";
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
            $this->ID = $row->ID;
            $this->name = $row->Name; 
            //Temp kludge until I remove retrieving static stuff from NFLPlayer to Master
            if (strlen($row->Pos) > 0) 
            {
                $this->pos = $row->Pos;
            }
            else
            {   
                $this->pos = $row->Position;
            }

            $this->NFLTeam = $row->NFLTeam;
            $this->Bye = $row->Bye;
            $this->fantasyTeam = $row->FTeam;
            $this->drafted = $row->Drafted; 
            $this->round = $row->Round;
            $this->points = $row->Points;    

            $retval = true;
        }
        return $retval;
    }

    function getBye($teamID) 
    {
        $query = "SELECT $this->teamTableName.Bye FROM $this->teamTableName WHERE ID='$teamID'";
        parent::SetQuery($query);
        parent::DoQuery();
        $row = parent::GetNextRecord();
        $bye = $row->Bye;
        return $bye;
    }

    function BuildUndraftedQuery($position, $nflteam, $excludeByeWeeks)
    {
        if (count($position) > 0)
        {
            $this->BuildPositionQuery($position);
            $queries[] = $this->positionQuery;
        }

        if (count($nflteam) > 0)
        {
            $this->BuildNFLTeamQuery($nflteam);
            $queries[] = $this->NFLTeamQuery;
        }

        if (count($excludeByeWeeks) > 0)
        {
            $this->BuildExcludeByeWeeksQuery($excludeByeWeeks); 
            $queries[] = $this->ExcludeByeWeeksQuery;
        }

        $query = "SELECT $this->allFieldsFromBothTables FROM $this->tableName, $this->masterTableName WHERE ";
        for ($i = 0; $i < count($queries); $i++) 
        {
            if ($i == 0) 
            {
                $query = $query . "(" . $queries[$i] . ") ";
            }
            else
            {
                $query = $query . " AND (" . $queries[$i] . ") ";
            }
        }
        $query = $query . " AND $this->tableName.ID = $this->masterTableName.ID AND $this->tableName.Drafted = '0'";
        parent::SetQuery($query);
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

    function getFullName() 
    {
        $retval = $this->name;
        if ((strcmp($this->pos, "DE") == 0) || (strcmp($this->pos, "SP") == 0))
        {
            $query = "SELECT FullName FROM $this->teamTableName WHERE ShortName = '$this->NFLTeam'";
            $nameresult = mysql_query ($query) or die("NAME query failed $query");
            $nameobj = mysql_fetch_object($nameresult);
            mysql_free_result($nameresult);
            $retval = $nameobj->FullName . $this->name;
        }
        return $retval;
    }

    function getPoints() { return $this->points; }
    function getRound() { return $this->round; }
    function getDrafted() { return $this->drafted; }
    function getFantasyTeam() { return $this->fantasyTeam; }
    function getID() { return $this->ID; }
    function getName() { return $this->name; }
    function getPosition() { return $this->pos; }
    function getNFLTeam() { return $this->NFLTeam; }
    function getBye() { return $this->Bye; }

    
    function Exists($id) 
    {
        $retval = false;

        $query = "SELECT ID FROM $this->tableName WHERE ID='$id'";
        parent::SetQuery($query);
        parent::DoQuery();


        if ($row = parent::GetNextRecord())
        {
            $retval = true;
        }
        return $retval;
    }

    /*
        Eventually replace Add with this once I remove the redundant fields
    */
    function Add($id) 
    {
        $query = "INSERT INTO $this->tableName (ID) VALUES ('$id')";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function BuildHTMLOption()
    {
        if ($this->pos != "DE" && $this->pos != "SP")
        {
            $retval = "<OPTION VALUE='$this->ID'>$this->name $this->pos $this->NFLTeam $this->Bye\n";
        }
        else
        {
            $retval = "<OPTION VALUE='$this->ID'>$this->NFLTeam $this->name $this->Bye\n";
        }

        return $retval;
    }

    function UpdateFantasyTeamName($id, $oldname, $newname) 
    {
        //9/1/02 -- Modified this query to only effect this id
        //7/31/03 check this ($id not used from admin menu)
        $query = "UPDATE $this->tableName SET FTeam='$newname' WHERE FTeam='$oldname' AND ID = '$id'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetByID($id) 
    {
        $retval = false;

        if ($this->Exists($id)) 
        {
            $query = "SELECT $this->allFieldsFromBothTables FROM $this->tableName, $this->masterTableName WHERE $this->masterTableName.ID = '$id' AND $this->masterTableName.ID = $this->tableName.ID";
            parent::SetQuery($query);
            parent::DoQuery();
            $retval = true;
        }

        return $retval;
    }


    //SHOULD NOT REALLY USE THIS ANYMORE -- USE FUNCTIONS TO DO SPECIFIC QUERIES
    function SelectAllWithCriteria($criteria) 
    {
        $query = "SELECT * FROM $this->tableName WHERE " . $criteria;
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function Undraft() 
    {
        $query = "UPDATE $this->tableName SET FTeam='',Drafted='0',round='0' WHERE ID='$this->ID'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function Draft($fantasyTeamName) 
    {
        $query = "UPDATE $this->tableName SET FTeam='$fantasyTeamName',Drafted='1' WHERE ID='$this->ID'";
        parent::SetQuery($query);
        parent::DoQuery();
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

    function setPoints($id, $points) 
    {
        $query = "UPDATE $this->tableName SET Points='$points' WHERE ID='$id'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    //positionArray -- array of strings

    function BuildPositionQuery($positionArray) 
    {
        $this->positionQuery = "";
        for ($i = 0; $i < count($positionArray); $i++)  
        {
            if ($i == 0)
            {
                $this->positionQuery = "$this->masterTableName.Position = '$positionArray[$i]' ";
            }
            else
            {
                $this->positionQuery = $this->positionQuery . " OR $this->masterTableName.Position = '$positionArray[$i]' ";
            }
        }
    }

    function BuildNFLTeamQuery($NFLTeamArray) 
    {
        $this->NFLTeamQuery = "";
        for ($i = 0; $i < count($NFLTeamArray); $i++)  
        {
            if ($i == 0)
            {
                $this->NFLTeamQuery = "$this->masterTableName.NFLTeam = '$NFLTeamArray[$i]' ";
            }
            else
            {
                $this->NFLTeamQuery = $this->NFLTeamQuery . " OR $this->masterTableName.NFLTeam = '$NFLTeamArray[$i]' ";
            }
        }
    }

    function BuildExcludeByeWeeksQuery($excludeByeWeeksArray) 
    {
        $this->ExcludeByeWeeksQuery = "";
        for ($i = 0; $i < count($excludeByeWeeksArray); $i++)  
        {
            if ($i == 0)
            {
                $this->ExcludeByeWeeksQuery = 
                    "$this->masterTableName.Bye != '$excludeByeWeeksArray[$i]' ";
            }
            else
            {
                $this->ExcludeByeWeeksQuery = 
                        $this->ExcludeByeWeeksQuery . 
                            " OR $this->masterTableName.Bye = '$excludeByeWeeksArray[$i]' ";
            }
        }
    }

    /*
        Function:       IsDrafted()

        Parameters:     $id -- ID of player

        Description:    Determines if a player is drafted by ID

        Returns:        True if player is Drafted

        Note:           The call to GetNextRecord is called so the fields should be filled
    */

    function IsDrafted($id) 
    {
        $retval = true;

        if ($this->Exists($id)) 
        {

            $query = "SELECT $this->allFieldsFromBothTables FROM $this->masterTableName, $this->tableName WHERE $this->masterTableName.ID = '$id' AND $this->masterTableName.ID = $this->tableName.ID";

            parent::SetQuery($query);
            parent::DoQuery();
            if ($this->GetNextRecord()) 
            {
                $retval = $this->drafted;
            }
        }
        return $retval;
    }

    function GetUndrafted($positionArray, $NFLTeamArray)
    {
        $this->BuildPositionQuery($positionArray); 
        $this->BuildNFLTeamQuery($NFLTeamArray);

        $beginquery = "SELECT $this->masterTableName.ID, $this->masterTableName.Name, $this->masterTableName.NFLTeam, $this->masterTableName.Position, $this->masterTableName.Bye, $this->tableName.Points FROM $this->masterTableName, $this->tableName WHERE ";
        if (strlen($this->positionQuery) > 0 && strlen($this->NFLTeamQuery) > 0)
        {
            $midquery = "($this->positionQuery) AND ($this->NFLTeamQuery) AND ";
        }
        else if (strlen($this->positionQuery) > 0)
        {
            $midquery = "($this->positionQuery) AND ";
        }
        else if (strlen($this->NFLTeamQuery) > 0)
        {
            $midquery = "($this->NFLTeamQuery) AND ";
        }
        else
        {
            $midquery = " ";
        }

        $endquery = "$this->tableName.Drafted = '0' AND $this->tableName.ID = $this->masterTableName.ID";

        $query = $beginquery . $midquery . $endquery;
        $this->ExecuteQuery($query);         
    }



    function GetUndraftedOrderByPoints($positionArray, $NFLTeamArray)
    {
        $this->BuildPositionQuery($positionArray); 
        $this->BuildNFLTeamQuery($NFLTeamArray);

        $beginquery = "SELECT $this->masterTableName.ID, $this->masterTableName.Name, $this->masterTableName.NFLTeam, $this->masterTableName.Position, $this->masterTableName.Bye, $this->tableName.Points FROM $this->masterTableName, $this->tableName WHERE ";
        if (strlen($this->positionQuery) > 0 && strlen($this->NFLTeamQuery) > 0)
        {
            $midquery = "($this->positionQuery) AND ($this->NFLTeamQuery) AND ";
        }
        else if (strlen($this->positionQuery) > 0)
        {
            $midquery = "($this->positionQuery) AND ";
        }
        else if (strlen($this->NFLTeamQuery) > 0)
        {
            $midquery = "($this->NFLTeamQuery) AND ";
        }
        else
        {
            $midquery = " ";
        }

        $endquery = "$this->tableName.Drafted = '0' AND $this->tableName.ID = $this->masterTableName.ID ORDER BY $this->tableName.Points DESC";

        $query = $beginquery . $midquery . $endquery;

//        echo("GetUndraftedOrderByPoints $query<BR>");
        $this->ExecuteQuery($query);         
    }

/*
    Parameters: $fantasyTeamName
                $arr
*/

    function GetPlayersFantasyTeamPositionsOrderByName($fantasyTeamName, $positions)
    {
        $query = "SELECT $this->allFieldsFromBothTables FROM $this->tableName, $this->masterTableName  WHERE $this->tableName.FTeam = '$fantasyTeamName' AND (";
        for ($j = 0; $j < count($positions); $j++)
        {
            $query = $query . "$this->masterTableName.Position = '$positions[$j]'";
            if ($j != count($positions) - 1)
            {
                $query = $query . " OR ";
            }
        }            
        $query = $query . ") AND $this->tableName.ID = $this->masterTableName.ID ORDER BY $this->masterTableName.Name";
        $this->ExecuteQuery($query);         
    }

    function GetPlayersFantasyTeamPositionOrderByName($fantasyTeamName, $position) 
    {
        $query = "SELECT $this->allFieldsFromBothTables FROM $this->tableName, $this->masterTableName  WHERE $this->tableName.FTeam = '$fantasyTeamName' AND $this->masterTableName.Position = '$position' AND $this->tableName.ID = $this->masterTableName.ID ORDER BY $this->masterTableName.Name";
        $this->ExecuteQuery($query);  
    }

    function GetPlayersOnFantasyTeam($fantasyTeamName) 
    {
        $query = "SELECT $this->allFieldsFromBothTables FROM $this->tableName, $this->masterTableName  WHERE $this->tableName.FTeam = '$fantasyTeamName' AND $this->tableName.ID = $this->masterTableName.ID";
        $this->ExecuteQuery($query);  
    }


    /*
        Function:       GetByPoints()
    
        Parameters:     None

        Description:    Retrieves all players ordered by points (whether drafted or not)

        Returns:        Nothing
    */

    function GetByPoints()
    {
        $beginquery = "SELECT $this->masterTableName.ID, $this->masterTableName.Name, $this->masterTableName.NFLTeam, $this->masterTableName.Position, $this->masterTableName.Bye, $this->tableName.Points FROM $this->masterTableName, $this->tableName WHERE ";
        $endquery = "$this->tableName.ID = $this->masterTableName.ID ORDER BY $this->tableName.Points DESC";
        $query = $beginquery . $endquery;
        $this->ExecuteQuery($query);         
    }


    /*
        Function:       GetAll()
    
        Parameters:     None

        Description:    Retrieves all players (whether drafted or not)

        Returns:        Nothing
    */

    function GetAll()
    {
        $query = "SELECT $this->masterTableName.ID, $this->masterTableName.Name, $this->masterTableName.NFLTeam, $this->masterTableName.Position, $this->masterTableName.Bye, $this->tableName.Points FROM $this->masterTableName, $this->tableName WHERE $this->tableName.ID = $this->masterTableName.ID";
        $this->ExecuteQuery($query);         
    }

    function GetCount() 
    {
        $query = "SELECT $this->masterTableName.ID FROM $this->masterTableName";
        $this->ExecuteQuery($query);
        return parent::Count();        
    }


    function UndraftAll() 
    {
        $query = "UPDATE $this->tableName SET FTeam='',Drafted='0',round='0'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

}
?>