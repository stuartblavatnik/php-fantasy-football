<?
define("HTML_START", "<HTML>\n");
define("BODY_START", "<BODY BGColor='#ffffcc'>\n");
define("BODY_END", "</BODY>\n");
define("HEAD_START", "<HEAD>\n");
define("HEAD_END", "</HEAD>\n");
define("HTML_END", "</HTML>\n");

//html search engine constants
define("HTML_KEYWORDS", "Two For Both Inc.,Scrambled Eggs Fantasy Football,Stuart Blavatnik");
define("HTML_AUTHOR", "Stuart Blavatnik");


/*
    Function:       buildRolloverAction()

    Parameters:     netscape -- True if using netscape
                    action   -- Action to take when item is clicked on
                    imgname  -- Name of Image portion of anchor
                    origimg  -- Name of original graphic
                    rollimg  -- Name of image when mouse rolls over image
                    subtext  -- Text to put in submit button if netscape

    Description:    Builds an anchor control with a rollover image associated with it.
                    If running netscape, this will build a standard submit button

    Returns:        Nothing
*/

function buildRolloverAction($netscape, $action, $imgname, $origimg, $rollimg, $subtext)
{
    if ($netscape == false)
    {
        echo("<a href=\"javascript:$action;\"><img NAME=\"$imgname\" src=\"$origimg\" onMouseOut=\"document.$imgname.src='$origimg';\" onMouseOver=\"document.$imgname.src='$rollimg';\" BORDER='0'></a>");
    }
    else
    {
       echo("<INPUT TYPE=SUBMIT VALUE='$subtext'>");
    }
}

/*
    Function:       HTMLStart()

    Parameters:     $title          -- Tile of page
                    $author         -- Author of page
                    $keywords       -- Keywords for search engines
                    $description    -- Description of page for search engines

    Description:    Creates the standard HTML starting tags for Two For Both's web pages

    Returns:        Nothing
*/

function HTMLStart($title, $author, $keywords, $description)
{
    echo(HTML_START);
    echo(HEAD_START);
    echo("<TITLE> $title </title>\n"); //Scrambled Eggs Fantasy Football Administration Page </TITLE>
    echo("<META NAME=\"Author\" CONTENT=\"$author\">\n");
    echo("<META NAME=\"Keywords\" CONTENT=\"$keywords\">\n");  
    echo("<META NAME=\"Description\" CONTENT=\"$description\">\n");   //Fantasy Football Administration Page
    echo("<LINK REL=\"stylesheet\" href=\"/styles/tfb.css\">\n");
    echo(HEAD_END);
    echo(BODY_START);
}

/*
    Function:    HTMLEnd()

    Parameters:  none

    Description: Creates the standard HTML ending tags for Two For Both's web pages

    Returns:     Nothing
*/


function HTMLEnd()
{
    echo(BODY_END);
    echo(HTML_END);
}

/*
    Function:       BuildSelect()

    Parameters:     selectName        -- Name of list
                    selectValues      -- Array of values

    Description:    Creates a select list and the possible values from an array

    Returns:        Nothing
*/

function BuildSelect($selectName, $selectValues)
{
    echo("<SELECT NAME=\"" . $selectName . "\">");
    foreach ($selectValues as $element)
    {
        echo("<OPTION>$element</OPTION>");
    }
    echo("</SELECT>");
}

/*
    Function:       BuildDirectorySelect()

    Parameters:     selectName      -- Name of list
                    directoryName   -- Name of directory to build the list from

    Description:    Creates a select list from a directory with 
                    a) value -- full pathed filename
                    b) Text  -- file name without path or extension

    Returns:        Nothing
*/
function BuildDirectorySelect($selectName, $directoryName)
{
    echo("<SELECT NAME=\"" . $selectName . "\">");

    $dh = dir($directoryName);
    while ($entry = $dh->read())
    {
        if (strlen($entry) > 2)
        {
            $fileNoExtension = GetFileNameNoExtension($entry);
            echo("<OPTION VALUE='$directoryName/$entry'>" . strtoupper(GetFileNameNoExtension($entry)) . "</OPTION>");
        }
    }
    $dh->close();    

    echo("</SELECT>");
}

function BuildEmptyOption($numberSpaces)
{
    for ($i = 0; $i < $numberSpaces; $i++)
    {
        $app = $app . "&nbsp";
    }

    echo("<OPTION>$app\n");
}

/*
    Function:       fileHTMLStart()

    Parameters:     $title          -- Tile of page
                    $author         -- Author of page
                    $keywords       -- Keywords for search engines
                    $description    -- Description of page for search engines

    Description:    Creates the standard HTML starting tags for Two For Both's web pages

    Returns:        String
*/

function fileHTMLStart($title, $author, $keywords, $description)
{
    $retval = HTML_START;
    $retval .= HEAD_START;
    $retval .= "<TITLE> $title </title>\n";
    $retval .= "<META NAME=\"Author\" CONTENT=\"$author\">\n";
    $retval .= "<META NAME=\"Keywords\" CONTENT=\"$keywords\">\n";  
    $retval .= "<META NAME=\"Description\" CONTENT=\"$description\">\n";   
    $retval .= "<LINK REL=\"stylesheet\" href=\"/styles/tfb.css\">\n";
    $retval .= HEAD_END;
    $retval .= BODY_START;

    return $retval;
}

/*
    Function:    fileHTMLEnd()

    Parameters:  none

    Description: Creates the standard HTML ending tags for Two For Both's web pages

    Returns:     Nothing
*/


function fileHTMLEnd()
{
    $retval = BODY_END;
    $retval .= HTML_END;

    return $retval;
}

/*
    Function:       fileBuildSelect()

    Parameters:     selectName        -- Name of list
                    selectValues      -- Array of values

    Description:    Creates a select list and the possible values from an array

    Returns:        Nothing
*/

function fileBuildSelect($selectName, $selectValues)
{
    $retval = "<SELECT NAME=\"" . $selectName . "\">";
    foreach ($selectValues as $element)
    {
        $retval .= "<OPTION>$element</OPTION>";
    }
    $retval .= "</SELECT>";

    return $retval;
}

?>