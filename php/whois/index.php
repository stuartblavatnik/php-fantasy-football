<?
    include_once("../classes/class.whois.php");

    $myWhois = new whois();
    echo($myWhois->lookup("67.34.197.237"));
    echo("<BR>");
    echo($myWhois->lookup("65.164.53.25"));
?>