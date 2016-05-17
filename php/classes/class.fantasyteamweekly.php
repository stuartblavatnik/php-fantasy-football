<?
/*
    Module:             class.fantasyteamweekly.php

    Class:              FantasyTeamWeekly

    Inherits From:      RecordSet -- This class maps to a database object

    Description:        Represents the fantasy team's weekly information for a particular week.
                        The database records associated with this class are all created when the
                        league is first created (1 for each team multiplied by the number of weeks)
                        This assumes that the league goes the full number of weeks in the season and
                        all teams play each week.  To handle playoffs, some of these would have to be
                        created as the regular season ends.

    Database Mapping:   Base name --  FANTASY_TEAM_WEEKLY_TABLE_NAME
                        Fields    --  Number TINYINT(4) DEFAULT 0, 
                                      Opponent TINYINT(4) DEFAULT 0, 
                                      Points SMALLINT(6) DEFAULT 0, 
                                      PointsAgainst SMALLINT(6) DEFAULT 0, 
                                      Result TINYINT(4) DEFAULT 0, 
                                      Week TINYINT(4) DEFAULT 0, 
                                      OverallPosition TINYINT(4) DEFAULT 0, 
                                      WeeklyPotPosition TINYINT(4) DEFAULT 0, 
                                      MoneyOwed FLOAT(10, 2) DEFAULT 0.00, 
                                      PotMoneyOwed FLOAT(10, 2) DEFAULT 0.00, 
                                      InPot TINYINT(4) DEFAULT 0, 
                                      Blind TINYINT(4) DEFAULT 0,

*/

class FantasyTeamWeekly extends RecordSet
{
    var $tableName;                     //Database table name
//
    var $number;                        //Team number
    var $opponent;                      //Opponent team number
    var $points;                        //Points scored by team
    var $pointsAgainst;                 //Points scored by opponent
    var $result;                        //Win, lose, tie
    var $week;                          //Week number
    var $overallPosition;               //Position for week
    var $weeklyPotPosition;             //Position for side pool
    var $moneyOwed;                     //League money owed based on $result
    var $potMoneyOwed;                  //Side pool money owed based on $weeklyPotPosition
    var $inPot;                         //Flag indicated if the team was in the side pool for the week
    var $blind;                         //Flag indicating if this team is the blind team (not a real team)

    /*
        Method:         Constructor()

        Parameters:     $leagueName -- Name of league
                        $leagueYear -- Year of league

        Description:    Method called when object is created           
                        Assigns the database table based on 
                        name and year of league

        Returns:        Nothing
    */
    function FantasyTeamWeekly($leagueName, $leagueYear) 
    {
        $this->tableName = CreateTableName(FANTASY_TEAM_WEEKLY_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->number = $row->Number;
            $this->opponent = $row->Opponent;
            $this->points = $row->Points;
            $this->pointsAgainst = $row->PointsAgainst;
            $this->result = $row->Result;
            $this->week = $row->Week;
            $this->overallPosition = $row->OverallPosition;
            $this->weeklyPotPosition = $row->WeeklyPotPosition;
            $this->moneyOwed = $row->MoneyOwed;
            $this->potMoneyOwed = $row->PotMoneyOwed;
            $this->inPot = $row->InPot;
            $this->blind = $row->Blind;

            $retval = true;
        }

        return $retval;
    }
    
    //Getters -- Called after GetNextRecord()
    function getNumber() { return $this->number; }
    function getOpponent() { return $this->opponent; }
    function getPoints() { return $this->points; }
    function getPointsAgainst() { return $this->pointsAgainst; }
    function getResult() { return $this->result; }
    function getWeek() { return $this->week; }
    function getOverallPosition() { return $this->overallPosition; }
    function getWeeklyPotPosition() { return $this->weeklyPotPosition; }
    function getMoneyOwed() { return $this->moneyOwed; }
    function getPotMoneyOwed() { return $this->potMoneyOwed; }
    function getInPot() { return $this->inPot; }
    function getBlind() { return $this->blind; }

    /*
        Method:         setOpponentWeek()

        Parameters:     $teamNumber -- Fantasy team number
                        $week       -- League week
                        $opponent   -- Fantasy team opponent team number

        Description:    Updates the fantasy schedule record for a particular team / week setting the opponent

        Returns:        Nothing
    */

    function setOpponentWeek($teamNumber, $week, $opponent) 
    {
        $query = "UPDATE $this->tableName SET Opponent='$opponent' WHERE number='$teamNumber' AND week='$week'";
        $this->ExecuteQuery($query);
    }

    /*
        Method:         setInPot()

        Parameters:     $inSidePool -- 0 or 1 (1 == in side pot)

        Description:    Updates the inSidePool field in the database for a particular fantasy team / week

        Returns:        Nothing
    */
    function setInPot($inSidePool) 
    {
        $query = "UPDATE $this->tableName SET inPot='$inSidePool' WHERE number='$this->number' AND week='$this->week'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         setPoints()

        Parameters:     $points -- points for the week

        Description:    Updates the points for the week for a fantasy team 

        Returns:        Nothing
    */

    function setPoints($points) 
    {
        $query = "UPDATE $this->tableName SET Points='$points' WHERE number='$this->number' AND week='$this->week'";
        mysql_query($query);
    }

    /*
        Method:         setPointsAgainst

        Parameters:     $points -- points against for the week

        Description:    Updates the points against for the week for a fantasy team 

        Returns:        Nothing
    */

    function setPointsAgainst($points) 
    {
        $query = "UPDATE $this->tableName SET PointsAgainst='$points' WHERE number='$this->number' AND week='$this->week'";
        mysql_query($query);
    }

    /*
        Method:         setResult()

        Parameters:     $result -- Win, Lose, Tie

        Description:    Updates the result for the week for a fantasy team 

        Returns:        Nothing
    */

    function setResult($result) 
    {
        $query = "UPDATE $this->tableName SET Result='$result' WHERE number='$this->number' AND week='$this->week'";
        mysql_query($query);
    }

    /*
        Method:         setMoneyOwed()

        Parameters:     $owed   -- amount owed

        Description:    Updates the money owed for the week for a fantasy team 

        Returns:        Nothing
    */

    function setMoneyOwed($owed) 
    {
        $query = "UPDATE $this->tableName SET MoneyOwed='$owed' WHERE number='$this->number' AND week='$this->week'";
        mysql_query($query);
    }

    /*
        Method:         UpdatePotPositionMoneyOwed()

        Parameters:     $fantasyTeamNumber  -- team number
                        $week               -- week 
                        $payout             -- money result
                        $position           -- side pool position

        Description:    Updates the side pool information for the week for a fantasy team 

        Returns:        Nothing
    */

    function UpdatePotPositionMoneyOwed($fantasyTeamNumber,
                                        $week,
                                        $payout,
                                        $position)
    {
        $query = "UPDATE $this->tableName SET PotMoneyOwed='$payout', WeeklyPotPosition='$position' WHERE number='$fantasyTeamNumber' AND week='$this->week'";
        mysql_query($query);
    }

    /*
        Method:         GetAllRecordsWithCriteria()

        Parameters:     $criteria       -- SQL criteria (i.e. all information to the right of a WHERE clause)

        Description:    Builds and executes an SQL statement

        Returns:        Nothing
    */

    function GetAllRecordsWithCriteria($criteria) 
    {
        $query = "SELECT * FROM $this->tableName WHERE $criteria";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         GetAllRecordsWithCriteriaOrderBy()

        Parameters:     $criteria       -- SQL criteria (i.e. all information to the right of a WHERE clause and 
                                           before an ORDER BY clause)
                        $orderBy        -- SQL order by criteria (i.e. all information to the right of an ORDER BY 
                                           clause)

        Description:    Builds and executes an SQL statement

        Returns:        Nothing
    */

    function GetAllRecordsWithCriteriaOrderBy($criteria, $orderBy) 
    {
        $query = "SELECT * FROM $this->tableName WHERE $criteria ORDER BY $orderBy";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         GetTeamWeek()

        Parameters:     $teamNumber     -- fantasy team number
                        $week           -- league week

        Description:    Retrieves a particular fantasy team weekly record for a team / week

        Returns:        Nothing
    */

    function GetTeamWeek($teamNumber, $week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE number='$teamNumber' AND week='$week'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         GetAllWeek()

        Parameters:     $week -- Week for retrieval

        Description:    Retrieves all of the records for the all of the fantasy teams for the week

        Returns:        Nothing
    */
    function GetAllWeek($week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Week='$week'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         GetAllFantasyTeam()

        Parameters:     $fantasyTeamNumber  -- Team number

        Description:    Retrieves all fantasy team weekly records for a particular team

        Returns:        Nothing
    */

    function GetAllFantasyTeam($fantasyTeamNumber) 
    {
        $query = "SELECT * FROM $this->tableName WHERE number='$fantasyTeamNumber'";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         GetAllFantasyTeamOrderByWeek()

        Parameters:     $fantasyTeamNumber  -- Team number

        Description:    Retrieves all fantasy team weekly records for a particular team ordered by week

        Returns:        Nothing
    */

    function GetAllFantasyTeamOrderByWeek($fantasyTeamNumber) 
    {
        $query = "SELECT * FROM $this->tableName WHERE number='$fantasyTeamNumber' ORDER BY Week";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         GetFantasyTeamOrderByWeekThroughWeek

        Parameters:     $fantasyTeamNumber  -- Team number
                        $week               -- Greatest week

        Description:    Retrieves all fantasy team weekly records for a particular team through the week 
                        specified ordered by week

        Returns:        Nothing
    */

    function GetFantasyTeamOrderByWeekThroughWeek($fantasyTeamNumber, $week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE number='$fantasyTeamNumber' AND Week < '$week' ORDER BY Week";
        parent::SetQuery($query);
        parent::DoQuery();
    }

    /*
        Method:         GetPointsFantasyTeam()

        Parameters:     $fantasyTeamNumber  -- Team number

        Description:    Gets the sum of all of the fantasyTeamWeekly records for a particular team

        Returns:        Sum
    */
    function GetPointsFantasyTeam($fantasyTeamNumber) 
    {
        $retval = 0;
        $query = "SELECT SUM(Points) as mytotal FROM $this->tableName WHERE number='$fantasyTeamNumber'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
    }

    /*
        Method:         GetTotalPointsAgainst()

        Parameters:     None

        Description:    Retrieves the sum of the points allowed for a particular fantasy team

        Returns:        Sum of points against
    */
    function GetTotalPointsAgainst()
    {
        $retval = 0;
        $query = "SELECT SUM(PointsAgainst) as mytotal FROM $this->tableName WHERE number='$this->number'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
    } 

    /*
        Method:         GetResultType()

        Parameters:     $resultType     -- win, loss, tie
                        $week           -- week threshold

        Description:    Retrieves the number of result types up till a particular week

        Returns:        Number of result types
    */

    function GetResultType($resultType, $week) 
    {
        $retval = 0;
        $query = "SELECT * FROM $this->tableName WHERE Result='$resultType' AND WEEK <='$week' AND number='$this->number'";
        $result = mysql_query($query);
        $retval = mysql_num_rows($result);
        mysql_free_result($result);
        return $retval;
    }

    /*
        Method:         GetTeamsInSidePool()

        Parameters:     $week   -- Week to get side pool teams for

        Description:    Retrieves the teams in the side pool sorted on the highest points descending

        Returns:        Nothing
    */

    function GetTeamsInSidePool($week) 
    {
        $query = "SELECT * FROM $this->tableName WHERE InPot='1' AND week='$week' ORDER BY Points DESC";
        parent::SetQuery($query);
        parent::DoQuery();
    }


    /*
        Method:         GetTotalSidePoolMoneyOwed()

        Parameters:     $teamNumber     -- Team

        Description:    Returns the sum of the side pool monies for a particular team

        Returns:        Sum
    */

    function GetTotalSidePoolMoneyOwed($teamNumber) 
    {
        $retval = 0;
        $query = "SELECT SUM(PotMoneyOwed) as mytotal FROM $this->tableName WHERE Number='$teamNumber'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
    }

    /*
        Method:         GetTotalMoneyOwed()

        Parameters:     $teamNumber     -- Team

        Description:    Returns the sum of the weekly results money for a particular team

        Returns:        Sum
    */

    function GetTotalMoneyOwed($teamNumber) 
    {
        $retval = 0;
        $query = "SELECT SUM(MoneyOwed) as mytotal FROM $this->tableName WHERE Number='$teamNumber'";
        $result = mysql_query($query);
        $resultrow = mysql_fetch_object($result);
        $retval = $resultrow->mytotal;
        mysql_free_result($result);
        return $retval;
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