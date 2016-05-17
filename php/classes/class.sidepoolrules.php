<?
class SidePoolRules extends RecordSet
{
    var $tableName;
//
    var $teamCount;         //How many teams in the pool (determines breakdowns
    var $breakDowns;        //Comma Delimeted String of percentages for winners

    function SidePoolRules($leagueName, $leagueYear) 
    {
        $this->tableName = CreateTableName(SIDE_POOL_RULES_TABLE_NAME, $leagueName, $leagueYear);
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
            $this->teamCount = $row->TeamCount;
            $this->breakDowns = $row->BreakDowns;

            $retval = true;
        }

        return $retval;
    }

    function getTeamCount() { return $this->teamCount; }
    function getBreakDowns() { return $this->breakDowns; }

    /*
         NOTE -- Retrieveing the highest one here (i.e. pot payouts handle 5 at most)
     */

    function getByTeamCount($teamCount) 
    {
        $query = "SELECT * FROM $this->tableName WHERE TeamCount<='$teamCount' ORDER BY TeamCount Desc";
        $this->ExecuteQuery($query);
    }

    /*
        Parameters: scores -- Array of sorted scores
                    prize  -- Prize to be shared

        Returns:    array of pool money
    */

    function CalculatePrizes($scores, $prize) 
    {
        $breakDowns = explode(",", $this->breakDowns);      //Get the percentages as an array
        
        $payoutIndex = 0;
        while ($payoutIndex < count($scores)) 
        {
            $currentScore = $scores[$payoutIndex];
            $sameScore = 1;
            for ($i = $payoutIndex + 1; $i < count($scores) ; $i++) 
            {
                if ($currentScore != $scores[$i]) 
                {
                    break;
                }
                else
                {
                    $sameScore++;
                }
            }
            if ($sameScore == 1)        //Single team got the payout
            {
                $pool[] = $prize * $breakDowns[$payoutIndex] / 100;
            }
            else                        //Multiple teams sharing the payout
            {
                $totalPayout = 0;
                for ($i = $payoutIndex; $i < $payoutIndex + $sameScore; $i++) 
                {
                    $totalPayout += $breakDowns[$i];
                }

                for ($i = $payoutIndex; $i < $payoutIndex + $sameScore; $i++) 
                {
                    $val = $prize * $totalPayout / 100 / $sameScore;
                    $pool[] = $val;
                    $poolcount = count($pool) -1;
                }
            }
            $payoutIndex += $sameScore;
        }
        return $pool;
    }

    function CalculatePositions($scores) 
    {
        $currentPosition = 1;
        $positionIndex = 0;
        while ($positionIndex < count($scores)) 
        {
            $currentScore = $scores[$positionIndex];
            $sameScore = 1;
            for ($i = $positionIndex + 1; $i < count($scores) ; $i++) 
            {
                if ($currentScore != $scores[$i]) 
                {
                    break;
                }
                else
                {
                    $sameScore++;
                }
            }

            if ($sameScore == 1)        //Single team got the payout
            {
                $positions[] = $currentPosition;
            }
            else                        //Multiple teams sharing the payout
            {
                $totalPayout = 0;
                for ($i = $positionIndex; $i < $positionIndex + $sameScore; $i++) 
                {
                    $positions[] = $currentPosition;
                }
            }
            $currentPosition += $sameScore;
            $positionIndex += $sameScore;
        }
        return $positions;
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