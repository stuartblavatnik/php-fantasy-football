<?
Class Message extends RecordSet
{
/*
"ID MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
TextMessage TINYTEXT NOT NULL,
FantasyTeamNumber TINYINT(4) NOT NULL,
ReadIt TINYINT(4) DEFAULT 0,
*/

    var $tableName;
//attributes
    var $id;                    //Identifier for object
    var $textMessage;           //Message Text
    var $fantasyTeamNumber;     //From fantasy franchise
    var $readIt;                //1 if read, else 0
    var $dateTime;              //Date and time message was created 

    //Constructor
    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function Message($leagueName, $leagueYear)
    {
        $this->tableName = CreateTableName(MESSAGE_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->textMessage = $row->TextMessage;
            $this->fantasyTeamNumber = $row->FantasyTeamNumber;
            $this->readIt = $row->readIt;
            $this->dateTime = $row->DateTime;

            $retval = true;
        }
        return $retval;
    }

    function getID() { return $this->id; }
    function getTextMessage() { return $this->textMessage; }
    function getFantasyTeamNumber() { return $this->fantasyTeamNumber; }
    function getReadIt() { return $this->readIt; }
    function getDateTime() { return $this->dateTime; }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function CreateNew($fantasyTeamNumber, $textMessage) 
    {
        $currenttime = makeTimeStamp(time());
        $query = "INSERT INTO $this->tableName (TextMessage, FantasyTeamNumber, DateTime) VALUES ('$textMessage', '$fantasyTeamNumber', '$currenttime')";
        $this->ExecuteQuery($query);
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function GetAllForFantasyTeam($fantasyTeamID) 
    {
        $query = "SELECT * FROM $this->tableName WHERE FantasyTeamNumber = '$fantasyTeamID'";        
        $this->ExecuteQuery($query);
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function HasRecords()
    {
        return parent::HasRecords();
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function MarkMessageRead($messageID) 
    {
        $query = "UPDATE $this->tableName SET ReadIt='1' WHERE ID='$messageID'";
        mysql_query($query);
    }

    /*
        Method:         

        Parameters:     

        Description:    

        Returns:
    */
    function DeleteMessage($messageID) 
    {
        $query = "DELETE FROM $this->tableName WHERE ID = '$messageID'";
        mysql_query($query);
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