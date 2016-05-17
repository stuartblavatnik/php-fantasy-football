<?
define("WEEK_START", "Week ");
define("SEPARATOR", " - ");

define("BASE_UPDATE_URL", "@www.quickstats.com/nflstats/stats.htm");
define("QUICKSTATS_USERNAME", "stuartb");
define("QUICKSTATS_PASSWORD", "eggbert");

/*
    Class that gets the current stat update information from Quickstats website.
    Reads a page and parse it into components.
*/

class QuickStatsUpdateInformation
{
    var $week;
    var $description;
    
/*
    Week 1 - Really Early Bird 
*/

    function QuickStatsUpdateInformation() 
    {
        $url = "http://" . QUICKSTATS_USERNAME . ":" . QUICKSTATS_PASSWORD . BASE_UPDATE_URL;
        $fp = @fopen($url, 'r');
        $i = 0;
        while ($line = @fgetss($fp, 1024))  //fgetss strips html out
        {
            $startpos = strpos($line, WEEK_START);
            if ($startpos === false) { // note: three equal signs
                // not found...
            }
            else
            {
                $endpos = strpos($line, SEPARATOR);         //Find the ' - '
                $this->week = trim(substr($line, $startpos + strlen(WEEK_START), 2));
                $this->description = trim(substr($line, $endpos + strlen(SEPARATOR)));
                break; 
            }
        }
    }

    function getWeek() { return $this->week; }
    function getDescription() { return $this->description; }

}
?>