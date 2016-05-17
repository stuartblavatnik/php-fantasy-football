<?
//    $fp = fsockopen("www.quickstats.com/nflstats/01wk00go.nfl", 80);
//    fclose($fp);

    $fr = fopen("http://www.quickstats.com/nflstats/01wk00go.nfl", "r");

    if($fr)
    {
        $fw = fopen("myFile.txt", "w");
        while (!feof($fr))
        {
            fputs($fw, fgets($fr, 10000));
        }
    }        
    fclose($fw);
    fclose($fr);

?>