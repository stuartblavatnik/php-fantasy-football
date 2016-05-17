<?
Class whois 
{  
    function lookup($lookup)
    {  
        $whois = "whois.geektools.com";  
        $fp = @fsockopen($whois, 43, &$errno, &$errstr, 30);  
        if (!$fp)
        {  
            $data = 0;  
        } 
        else 
        {  
            $lookup .= "\n";  
            @fputs($fp, $lookup);  
            $data = fread( $fp, 16384 );  
            @fclose($fp);  
        }  
        return $data;  
    }  
} 

?>