<?
class MasterNFLPlayer extends RecordSet
{

    var $tableName;
    var $teamTableName;
//
    var $id;
    var $name;
    var $NFLTeam;
    var $position;
    var $bye;

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function MasterNFLPlayer($leagueYear) 
    {
        $this->tableName = CreateGlobalTableName(MASTER_NFL_PLAYER_TABLE_NAME, $leagueYear);
        $this->teamTableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
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
            $this->name = $row->Name;
            $this->NFLTeam = $row->NFLTeam;
            $this->position = $row->Position;
            $this->bye = $row->Bye;
            $retval = true;
        }
        return $retval;
    }

    function getID() { return $this->id; }
    function getName() { return $this->name; }
    function getNFLTeam() { return $this->NFLTeam; }
    function getPosition() { return $this->position; }
    function getBye() { return $this->bye; }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function getByeFromTeam($NFLTeam) 
    {
        $query       = "SELECT * FROM $this->teamTableName WHERE ShortName='$NFLTeam'";
        $result      = mysql_query ($query);
        $row         = mysql_fetch_object($result);
        $bye         = $row->Bye;
        
        return $bye;
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function Add($id, $name, $NFLTeam, $position) 
    {
        $bye = $this->getByeFromTeam($NFLTeam);

        $query       = "INSERT INTO $this->tableName (ID, Name, NFLTeam, Position, Bye) VALUES ('$id', '$name', '$NFLTeam', '$position', '$bye')";
        $result      = mysql_query ($query);
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function Update($id, $name, $NFLTeam, $position) 
    {
        $bye = $this->getByeFromTeam($NFLTeam);    

        $query       = "UPDATE $this->tableName SET Name='$name',NFLTeam='$NFLTeam',Position='$position' WHERE ID='$id'";
        $result      = mysql_query ($query);
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function Exists($id) 
    {
        $retval = false;

        $query       = "SELECT ID FROM $this->tableName WHERE ID='$id'";                
        $result      = mysql_query ($query);
        if (mysql_num_rows($result) > 0) 
        {
            $retval = true;
        }
        return $retval;
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function GetByID($id) 
    {
        $query = "SELECT * FROM $this->tableName WHERE ID='$id'";     
        $this->ExecuteQuery($query);
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function GetAll() 
    {
        $query = "SELECT * FROM $this->tableName";
        $this->ExecuteQuery($query);
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function getFullName() 
    {
        $retval = $this->name;
        if ((strcmp($this->position, "DE") == 0) || (strcmp($this->position, "SP") == 0))
        {
            $query = "SELECT FullName FROM $this->teamTableName WHERE ShortName = '$this->NFLTeam'";
            $nameresult = mysql_query ($query);
            $nameobj = mysql_fetch_object($nameresult);
            mysql_free_result($nameresult);
            $retval = $nameobj->FullName . " " . $this->name;
        }
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