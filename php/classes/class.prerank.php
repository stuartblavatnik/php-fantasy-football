<?
Class PreRank extends RecordSet
{
    var $tableName;
//
    var $ID;                    //ID in NFLPlayer
    var $Excluded;              //1 if excluded
    var $Ranked;                //1 if ranked
    var $Rank;                  //Player ranking
    var $Points;                //Points scored last year

    function PreRank($leagueName, $leagueYear, $fantasyTeamNumber, $link)
    {
        $baseTableName = "_" . $fantasyTeamNumber . "_PRERANK";
        $this->tableName = CreateTableName($baseTableName, $leagueName, $leagueYear);

        if (!tableExists($link, $this->tableName)) 
        {
            CreateTable($this->tableName, PRERANK_TABLE_DEFINITION);
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
            $this->ID = $row->ID;
            $this->Excluded = $row->Excluded;
            $this->Ranked = $row->Ranked;
            $this->Rank = $row->Rank;
            $this->Points = $row->Points;
            $retval = true;
        }
        return $retval;
    }
    
    //Getters -- Called after GetNextRecord()
    function getID() { return $this->ID; }
    function getExcluded() { return $this->Excluded; }
    function getRanked() { return $this->Ranked; }
    function getRank() { return $this->Rank; }
    function getPoints() { return $this->Points; }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function Add($id, $rank, $points) 
    {
        $query = "INSERT INTO $this->tableName (ID, Excluded, Ranked, Rank, Points) VALUES ('$id', '0', '1', '$rank', '$points')";
        mysql_query($query);
    }

    function AddExcluded($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 0) 
        {
            $query = "INSERT INTO $this->tableName (ID, Excluded, Ranked, Rank, Points) VALUES ('$id', '1', '0', '0', '0')";
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

    /*
        Method:         GetAllRankedOrderByRank()

        Parameters:     
                        

        Description:    

        Returns:        Nothing
    */

    function GetAllRankedOrderByRank() 
    {
        $query = "SELECT * FROM $this->tableName WHERE Ranked='1' ORDER BY Rank";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRankedOrderByRankDescending() 
    {
        $query = "SELECT * FROM $this->tableName WHERE Ranked='1' ORDER BY Rank DESC";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRanked() 
    {
        $query = "SELECT * FROM $this->tableName WHERE Ranked='1'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllRankedOrderByRankStartingWith($myIndex) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Ranked='1' AND Rank >= '$myIndex' ORDER BY Rank";
        //echo("query = $query<BR>");
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllExcluded() 
    {
        $query = "SELECT * FROM $this->tableName WHERE Excluded='1'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetByID($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllExcludedOrderByPoints() 
    {
        $query = "SELECT * FROM $this->tableName WHERE Excluded='1' ORDER BY Points DESC";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function SetExcluded($id) 
    {
        $query = "UPDATE $this->tableName SET Excluded='1', Ranked='0', Rank='0' WHERE ID='$id'";
        mysql_query($query);
    }

    function ExcludeByPoints($excludePoints) 
    {
        $query = "UPDATE $this->tableName SET Excluded='1', Ranked='0', Rank='0' WHERE Points < $excludePoints";
        mysql_query($query);
    }

    function RankPlayer($id, $rank) 
    {
        $query = "UPDATE $this->tableName SET Excluded='0', Ranked='1', Rank='$rank' WHERE ID='$id'";
        mysql_query($query);
    }

    function ClearRanks() 
    {
        $query = "UPDATE $this->tableName SET Ranked='0', Rank='0'";
        mysql_query($query);
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