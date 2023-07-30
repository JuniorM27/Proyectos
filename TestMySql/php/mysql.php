<style>
    body
    {
        text-align: center;
        justify-content: center;
        align-items: center;
        vertical-align: middle;
        font-size: auto;
        height: 100vh;
        user-select: none;
        display: flex;
        flex-wrap: wrap;
        margin-left: 5vh;
        margin-right: 5vh;
        margin-bottom: 5vh;
    }
    div
    {
        border: 1px solid gray;
        background-color: lightgray;
    }
    p
    {
        padding-left: 5px;
        padding-right: 5px;
    }
    .head
    {
        background-color: khaki;
    }
</style>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $hostname = ini_get("mysqli.default_host");
    $username = $_POST['user'];
    $password = $_POST['pass'];    
    $database = $_POST['database'];
    $query = $_POST['query'];
    $conn = mysqli_connect($hostname,$username,$password,$database);
    $result = mysqli_query($conn,$query);

    if(is_bool($result))
    {
        if($result == true)
        {
            echo 'Query executed successfully.';
        } else
        {
            echo 'Query returned an error: <br>';
            echo mysqli_error($conn);
        }
    } else
    {
        $columns = mysqli_fetch_fields($result);
        $resultArray = mysqli_fetch_all($result);
        $resultArray_length = count($resultArray);
        $columns_length = count($columns);
        console_log($resultArray);
        console_log($columns_length. " columnLength");
        console_log($resultArray_length. " resultsLength");
        for($i = 0; $i < $columns_length; $i++)
        {
            echo "<div>";
            if(is_object($columns[$i]))
            {
                $Vars = get_object_vars($columns[$i]);
                echo "<p class='head'> ".$Vars['name']. " </p><br>";
            }
            for($j = 0; $j < $resultArray_length; $j++)
            {
                if(is_array($resultArray[$j]))
                {
                    if($i < $columns_length)
                    echo "<hr><p>". $resultArray[$j][$i]." </p><br>";
                } else
                {
                    echo "<hr><p>". $resultArray[$j]." </p><br>";
                }
            }
            echo "</div>";    
        }
    }
    
    mysqli_close($conn);

}


function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

?>