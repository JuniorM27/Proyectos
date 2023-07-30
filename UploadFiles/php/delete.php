<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $files = scandir('../uploads/');
    $replacement = array(" ", ".");
    for($i = 2; $i < count($files); $i++)
    {
        if(isset($_POST[str_replace($replacement, "_", $files[$i])]))
        {
            $saveName = $files[$i];
            if(unlink('../uploads/'.$files[$i]))
            {
                echo $saveName.' se ha eliminado.';
            } else
            {
                echo $saveName.' no se ha podido eliminar.';
            }
        }
    }
} else{
    header('Location: ../index.php');
}

?>