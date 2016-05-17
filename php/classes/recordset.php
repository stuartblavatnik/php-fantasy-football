<?
/*
    Class:          RecordSet

    Descipription:  Base class to handle the retrieval and traversal of recordsets
*/
Class RecordSet
{
//Attributes
    var $query_;                    //Holder of the last SQL query
    var $result_;                   //Holder of the last result set

    /*
        Access Method:  SetQuery()

        Attribute:      $query_
    */

    function SetQuery($query)
    {
        $this->query_ = $query;
    }

    /*
        Method:         DoQuery()

        Parameters:     None

        Description:    Executes the query $query_

        Returns:        Nothing
    */

    function DoQuery()
    {
        $this->result_ = mysql_query ($this->query_) or die("RecordSet DoQuery " . mysql_error() . " query_ failed $this->query_");    
    }    

    /*
        Method:         GetNextRecord()

        Parameters:     None
    
        Description:    Attempts to retrieve the next record from the recordset $result_

        Returns:        0 if nothing or the record 
    */

    function GetNextRecord()
    {
        $row = mysql_fetch_object($this->result_);

        return $row;
    }

    /*
        Method:         HasRecords()

        Parameters:     None

        Description:    Returns true if the last result set contains at least one row

        Returns:        True if records exist else false
    */

    function HasRecords() 
    {
        return (mysql_num_rows($this->result_) != 0);
    }


    /*
        Method:         Count()

        Parameters:     None

        Description:    Returns the number of records found in the last query

        Returns:        Number
    */

    function Count() 
    {
        return (mysql_num_rows($this->result_));
    }

    /*
        Method:         Destroy()

        Parameters:     None

        Description:    Frees the internal memory associated with this recordset

        Returns:        Nothing
    */

    function Destroy() 
    {
        @mysql_free_result($this->result_);
    }

    /*
        Method:         GetLastIDSaved()

        Parameters:     None

        Description:    Retrieves the last ID saved to the system (for AUTO_GENERATED ID's)

        Returns:        ID 
    */

    function GetLastIDSaved() 
    {
        return mysql_insert_ID();
    }

}
?>