<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $allowedExt = array('php','html','css');
        $files = $_FILES['files'];
        if ($files['name'][0] != '')
        {
            for($i = 0; $i < count($files['name']); $i++)
            {
                $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
//                if(!in_array($ext,$allowedExt)) { echo "No se ha podido subir el archivo: " . htmlspecialchars( basename( $files['name'][$i])). " la extension no es compatible. <br>"; } else {
                if (move_uploaded_file($files['tmp_name'][$i],"../uploads/".$files['name'][$i])) {
                    echo "El archivo ". htmlspecialchars( basename( $files['name'][$i])). " se ha subido correctamente.<br>";
                  } else {
                    echo "No se ha podido subir el archivo: " . htmlspecialchars( basename( $files['name'][$i])). "<br>";
                  }
  //              }
            }    
        } else
        {
            echo 'Debe subir algún archivo antes de enviar.';
        }
    } else 
    {
        header('Location: ../index.php');
    }
?>