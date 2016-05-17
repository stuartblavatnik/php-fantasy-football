<?
require_once("../include/html.php");
define("BEGINPHP", "<?");
define("ENDPHP1", "?");
define("ENDPHP2", ">");
define("ENDPHP", ENDPHP1 . ENDPHP2);

    HTMLStart("Viewcode", HTML_AUTHOR, HTML_KEYWORDS, "Generic code to view source code of php files");

    DisplayFile($radio);

    HTMLEnd();

/*
    Function:   DisplayFile()

    Parameters: $fileName

    Desciprion: Displays the file line by line
*/

function DisplayFile($fileName)
{
    $inPHP = false;

    $fp = @fopen($fileName, "r") or die("can not open $fileName");
    
    echo ("<PRE>");
    while ($line = @fgets ($fp, 1024))
    {
        $line = htmlspecialchars($line);    //Converts html patterns to string representable versions
        echo("$line<BR>");
    }
    echo ("</PRE>");
    @fclose($fp) or die("can not close $fileName");
}

?>