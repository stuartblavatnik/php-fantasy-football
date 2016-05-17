<?
/*
    Class:          NFLTeam

    Description:    Object representation of an NFL Team

    Extends:        RecordSet -- Allows for a database set of these objects

    Note:           This is a global table meaning there is one instance of this database table for
                    all leagues based on the year
*/
Class NFLTeam extends RecordSet
{
    var $tableName;         //Name of database table as specific to the year of the league
    var $ID;                //Team ID
    var $shortName;         //Abbrieviated name
    var $fullName;          //Full name

    /*
        Constructor

        Parameters:     $leagueYear -- Year of league

        Description:    Creates the database table name for this object
    */

    function NFLTeam($leagueYear)
    {
        $this->tableName = CreateGlobalTableName(NFL_TEAM_TABLE_NAME, $leagueYear);
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
            $this->shortName = $row->ShortName;
            $this->fullName = $row->FullName;
            $retval = true;
        }

        return $retval;
    }

    function GetAll()
    {
        parent::SetQuery("Select * FROM $this->tableName");
        parent::DoQuery();
    }

    function BuildHTMLOption()
    {
        return "<OPTION VALUE='$this->shortName'>$this->fullName\n";
    }

    function getID() { return $this->ID; }
    function getShortName() { return $this->shortName; }
    function getFullName() { return $this->fullName; }

    function getFullNameFromShortName($shortName)
    {
        $query = "SELECT FullName FROM $this->tableName WHERE ShortName = '$shortName'";    
        $nameresult = mysql_query ($query) or die("NAME query failed $query");
        if (mysql_num_rows($nameresult) > 0)
        {
            $nameobj = mysql_fetch_object($nameresult);
            $fullName = $nameobj->FullName;
        }
        mysql_free_result($nameresult);
        return $fullName;
    }

    function getShortNameFromFullName($fullName)
    {
        $query = "SELECT ShortName FROM $this->tableName WHERE FullName = '$fullName'";    
        $nameresult = mysql_query ($query) or die("NAME query failed");
        if (mysql_num_rows($nameresult) > 0)
        {
            $nameobj = mysql_fetch_object($nameresult);
            $shortName = $nameobj->ShortName;
        }
        mysql_free_result($nameresult);
        return $shortName;
    }

    function getFullNameFromID($id) 
    {
        $query = "SELECT FullName FROM $this->tableName WHERE ID = '$id'";    
        $nameresult = mysql_query ($query) or die("NAME query failed $query");
        if (mysql_num_rows($nameresult) > 0)
        {
            $nameobj = mysql_fetch_object($nameresult);
            $fullName = $nameobj->FullName;
        }
        mysql_free_result($nameresult);
        return $fullName;
    }

    function getShortNameFromID($id)
    {
        $query = "SELECT ShortName FROM $this->tableName WHERE ID = '$id'";    
        $nameresult = mysql_query ($query) or die("NAME query failed");
        if (mysql_num_rows($nameresult) > 0)
        {
            $nameobj = mysql_fetch_object($nameresult);
            $shortName = $nameobj->ShortName;
        }
        mysql_free_result($nameresult);
        return $shortName;
    }

    function getIDFromShortName($shortName) 
    {
        $query = "SELECT ID FROM $this->tableName WHERE ShortName = '$shortName'";    
        $idresult = mysql_query ($query) or die("ID from shortName query failed");
        if (mysql_num_rows($idresult) > 0)
        {
            $idobj = mysql_fetch_object($idresult);
            $id = $idobj->ID;
        }
        mysql_free_result($idresult);
        return $id;
    }

    function getIDFromFullName($fullName) 
    {
        $query = "SELECT ID FROM $this->tableName WHERE FullName = '$fullName'";    
        $idresult = mysql_query ($query) or die("ID from fullName query failed");
        if (mysql_num_rows($idresult) > 0)
        {
            $idobj = mysql_fetch_object($idresult);
            $id = $idobj->ID;
        }
        mysql_free_result($idresult);
        return $id;
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