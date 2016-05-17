<?

    if (strlen($year) == 4) 
    {
        $year = substr($year, 2, 2);
    }
    if (strlen($week) == 1) 
    {
        $week = "0" . $week;
    }

    $filename = $year . "wk" . $week . "go.nfl";
    $url = "http://stuartb:eggbert@www.quickstats.com/nflstats/$filename";

    //Note placing the @ in front of the function call will supress warnings generated if the file can not be accessed
    if ($fp = @fopen($url, 'r')) 
    {
        while ($line = fgets($fp, 1024)) 
        {
            $contents .= $line;
        }

        echo $contents;

        fclose($fp);
    }
    else
    {
        echo("Could not open file $url");
    }

?>