<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>File Uploader</title>
</head>
<body>
    <div>
    <form action="php/uploader.php" method="post" enctype="multipart/form-data" class="UploaderForm" >
        <img src="./img/up_arrow.gif" class="fileImg">
        <br>
        <br>
        <div class="filesDiv">
            <input type="file" name="files[]" id="files" multiple>
            <input type="submit" value="Enviar archivos📤">
            <p id="allfiles">Sin archivos seleccionados.</p>    
        </div>
    </form>
    <br>
    <button onclick="AlternarUploader()">Ver Archivos.</button>
    <form action="php/delete.php" method="post" >
    <div class="UploaderReader" style="display: none;" id="UploaderReader">
        <?php
        $dom = new DOMDocument('1.0', 'UTF-8');
        $files = scandir("./uploads/");

        refreshDir();
        function refreshDir()
        {
            reset($GLOBALS['files']);
            $GLOBALS['files'] = scandir("./uploads/");
            $element = $GLOBALS['dom'] -> createElement('a','Uploaded Files: ');
            $element -> setAttribute('href', './uploads/');
            $GLOBALS['dom'] -> appendChild($element);
            $GLOBALS['dom'] -> appendChild($GLOBALS['dom'] -> createElement('br'));
            for($i = 2; $i < count($GLOBALS['files']); $i++)
            {
                $element = $GLOBALS['dom'] -> createElement('a',$GLOBALS['files'][$i]);
                $element -> setAttribute('href', './uploads/'.$GLOBALS['files'][$i]);
                $GLOBALS['dom'] -> appendChild($element);
                $element2 = $GLOBALS['dom'] -> createElement('input','');
                $element2 -> setAttribute('type', 'submit');
                $element2 -> setAttribute('name', $GLOBALS['files'][$i]);
                $element2 -> setAttribute('value', 'Eliminar');
                $GLOBALS['dom'] -> appendChild($element2);
                $GLOBALS['dom'] -> appendChild($GLOBALS['dom'] -> createElement('br'));
            }
            echo $GLOBALS['dom'] -> saveXML();    
        }
        ?>
    </div>
    </form>
</div>

</body>
<script>
    var files = document.getElementById('files');
    var filestextshow = document.getElementById('allfiles');
    setInterval(filesShow, 500);

    function filesShow()
    {
        if(files.files.length == 0)
        {
            filestextshow.innerHTML = 'Sin archivos seleccionados.';
        } else
        {
            let text = '';
            for(let i = 0; i < files.files.length; i++)
            {
                text = text + files.files[i]['name'] + "<br> ";
            }
            filestextshow.innerHTML = text;
        }
    }

    function AlternarUploader()
    {
        let reader = document.getElementById('UploaderReader');
        if(reader.style.display == 'none')
        {
            reader.style.display = 'block';
        }else
        {
            reader.style.display = 'none';
        }
    }

    </script>
</html>