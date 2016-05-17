<?
/*
    Module:         database.php

    Description:    Generic Database Functions
*/

define("HOSTNAME", "128.121.4.19");
define("USERNAME", "woforbothcom");
define("PASSWORD", "MJE531");
define("DBNAME", "two");

define("SQL_CREATE_TABLE", "CREATE TABLE");
define("SQL_CREATE_TEMPORARY_TABLE", "CREATE TEMPORARY TABLE");
define("ORDER_ASCENDING", "ASC");
define("ORDER_DESCENDING", "DESC");

/*
    Name:           OpenDatabase()

    Parameters:     none

    Description:    Connects and selects the mySQL Database (assumption is that there is only 1 available)

    Returns:        Database link
*/

function OpenDatabase()
{
    $dblink = @mysql_connect(HOSTNAME, USERNAME, PASSWORD);  

    if ($dblink)
    {
        @mysql_select_db(DBNAME);
    }
    return $dblink;
}

/*
    Function:       CloseDatabase()

    Parameters:     $link -- Handle 

    Description:    Closes the database and frees up the connection link resource

    Returns:        Nothing
*/

function CloseDatabase($link)
{
    mysql_close($link);
}

/*
    Name:           CreateTable()

    Parameters:     $tableName          -- Name of table
                    $tableDefinition    -- Definition of table

    Description:    Issues a mySQL command to create the table

    Returns:        Result of the mySQL command

    Note:           Value returned is always 1 even if table already exists
*/

function CreateTable($tableName, $tableDefinition)
{
    $stmt = SQL_CREATE_TABLE . " IF NOT EXISTS $tableName ($tableDefinition);";
    return mysql_query($stmt);
}


/*
    Name:           CreateTemporaryTable()

    Parameters:     $tableName          -- Name of table
                    $tableDefinition    -- Definition of table

    Description:    Issues a mySQL command to create the temprary table

    Returns:        Result of the mySQL command
*/

function CreateTemporaryTable($tableName, $tableDefinition)
{
    $stmt = SQL_CREATE_TEMPORARY_TABLE . " $tableName ($tableDefinition);";
    return mysql_query($stmt);
}

/*
   Function:    tableExists()

   Parameters:  $link      -- Database link
                $tableName -- Name of table to find

   Description: Searches the database for a table name

   Returns:     True if the table exists
*/
function tableExists($link, $tableName)
{
    $retval = false;
    $result = mysql_list_tables(DBNAME, $link);
    if ($result) 
    {
        $max = mysql_num_rows($result);
        for ($i = 0; $i < $max ; $i++) 
        {
            if (strcmp(mysql_tablename($result, $i), $tableName) == 0) 
            {
                $retval = true;
                $break;
            }
        }
    }
    return $retval;
}



?>