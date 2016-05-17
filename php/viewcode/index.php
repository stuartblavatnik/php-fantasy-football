<?
    define("WORKFORM", "viewcode.php");
    define("DIRECTORY", "../../poker/");

    require("../include/html.php");

    HTMLStart("Viewcode", HTML_AUTHOR, HTML_KEYWORDS, "Generic code to view source code of php files");

    echo("<FORM ACTION=" . WORKFORM . " METHOD=POST>");

    $dh = opendir(DIRECTORY);
    while ($file = readdir($dh))
    {
       $pinfo = pathinfo($file);
       if ($pinfo[extension] == 'php')
       {
          MakeButtonChoice(DIRECTORY, $file);
       }
    }
    closedir($dh);

    echo("<INPUT TYPE='submit' value='submit' />");
    echo("</FORM>");

    HTMLEnd();


function MakeButtonChoice($directory, $fileName)
{
   echo("<INPUT TYPE='radio' name='radio' id='radio' value=$directory$fileName />");
   echo("<span>$fileName</span><br>");
}

?>