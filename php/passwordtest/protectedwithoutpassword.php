<?
    $url = "http://www.twoforboth.com/football/admin/myfile.txt";
//    $fp = fopen($url, 'r') or die ("Cannot open $url via Get method");
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
        echo("Could not open file");
    }
?>