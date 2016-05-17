<?
class NFLSchedule extends RecordSet
{

    var $tableName;

    var $week;
    var $visitorNumber;
    var $homeNumber;
    var $gameDate;

    //Don't need the name, but I want to keep the interface consistent
    function NFLSchedule($leagueName, $leagueYear) 
    {
        $this->tableName = CreateGlobalTableName(NFL_SCHEDULE_TABLE_NAME, $leagueYear);
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
            $this->week = $row->Week;
            $this->visitorNumber = $row->VisitorNumber;
            $this->homeNumber = $row->HomeNumber;
            $this->gameDate = $row->GameDate;

            $retval = true;
        }

        return $retval;
    }

    function getWeek() { return $this->week; }
    function getVisitorNumber() { return $this->visitorNumber; }
    function getHomeNumber() { return $this->homeNumber; }
    function getGameDate() { return $this->gameDate; }


    /*
        Function:    getTodaysEarliestGame()

        Parameters:  $week -- Season week

        Description: Returns earliest game for the week for today

        Returns:     Date as a Unix TimeStamp
    */


    function GetTodaysEarliestGame()
    {
        $today = time();
        $tomorrow = GetTomorrow($today);
        //Turn the current time to YYYYMMDDHHMMSS format
        //$timeStamp = makeTimeStamp(time());  
        //$tomorrow = makeTimeStamp(time() + 24 * 60 * 60);

        $timeStamp = makeTimeStamp($today);
        $tomorrow = makeTimeStamp($tomorrow);

        $query = "SELECT * FROM $this->tableName WHERE GameDate >= '$timeStamp' AND GameDate < '$tomorrow' AND VisitorNumber != '0' ORDER BY GameDate";
        parent::SetQuery($query);
        parent::DoQuery();
    }



    function GetAllGamesForDate($date) 
    {
        //Turn the current time to YYYYMMDDHHMMSS format
        $timeStamp = makeTimeStamp($date);  
        $tomorrow = makeTimeStamp(time() + 24 * 60 * 60);
        $query = "SELECT * FROM $this->tableName WHERE GameDate >= '$timeStamp' AND GameDate < '$tomorrow' ORDER BY GameDate";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetAllGamesForWeek($week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Week='$week' ORDER BY GameDate";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    function GetWeeksEarliestGame($week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Week='$week' AND VisitorNumber != '0' ORDER BY GameDate";
        parent::SetQuery($query);
        parent::DoQuery();
        $this->GetNextRecord();
        $date = GetDateFromYYYYMMDDHHMMSSTimeStamp($this->gameDate);
        return $date;    
    }

    function getFormattedGameDate($format) 
    {
        $date = GetDateFromYYYYMMDDHHMMSSTimeStamp($this->gameDate);
        $formattedDate = date($format, $date);
        return $formattedDate;
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