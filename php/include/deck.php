<?
include_once("database.php");

define("RANDOM_SEED", 1000000);
define("DECK_SIZE", 51);

$link = OpenDatabase();
ShuffleDeck(0);                         //MAKE THE 0 the parameter for the game number
CloseDatabase($link);

function ShuffleDeck($game_number) 
{
    srand((double)microtime() * RANDOM_SEED);
    $deck = range(0, DECK_SIZE);               //Initialize the deck

    $numberofCards = count($deck);

    for ($currentElement = 0; $currentElement < $numberofCards; $currentElement++)
    {
        //Store the value of the current element
        $thisElementValue = $deck[$currentElement];
        //Pick a random index from the array
        $randomIndex = rand(0, $numberofCards - 1);         
        //Swap the element at randomIndex with the current element
        $deck[$currentElement] = $deck[$randomIndex];
        $deck[$randomIndex] = $thisElementValue;
    }    


    for ($i = 0; $i < $numberofCards; $i++) 
    {
        if ($i == 0) 
        {
            $cardString = $deck[$i];
        }
        else
        {
            $cardString .= "," . $deck[$i];
        }
    }

    $sql = "UPDATE TCP_GAME SET CARDS='$cardString' WHERE GAME_NUMBER = '$game_number'";
    $result = mysql_query($sql);
}

?>