<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Document</title>
</head>
<body>
    <?php
    $dir = $_SERVER['DOCUMENT_ROOT'];
    $dirContent = scandir($dir);
    $dom = new DOMDocument('1.0', 'utf-8');

    refreshDir();
    function refreshDir()
    {
        empty($GLOBALS['dom']);
        
        for($i =0; $i < count($GLOBALS['dirContent']); $i++)
        {
            $element = $GLOBALS['dom'] -> createElement('p',$GLOBALS['dirContent'][$i]);
            $Attribute = $element -> setAttribute('onclick','refreshDir("/'. $GLOBALS['dirContent'][$i] .'")');
            $GLOBALS['dom'] -> appendChild($element);
        }
        echo $GLOBALS['dom'] -> saveXML();
    }
    ?>
</body>
<script>
    function refreshDir(x)
    {

    }
</script>
</html>