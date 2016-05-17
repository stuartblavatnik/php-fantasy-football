<?
    $url = "http://www.twoforboth.com/php/test/myfile.txt";

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
        echo("Could not open file");
    }
?>