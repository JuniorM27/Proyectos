<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>QUERY</title>
</head>
<body>
    <form action="./php/mysql.php" method="post">
        <div class="user_pass">
            <label >USER:</label>
            <input type="text" value="user" name="user" id="user">
            <label >PASSWORD:</label>
            <input type="password" value="" name="pass" id="pass">
        </div>
        <div>
            <label>DATABASE</label>
        </div>
    <div class="DatabaseInput">
        <SELEct name='database'>
            <?php 
                $hostname = ini_get("mysqli.default_host");
                $username = "user";
                $password = "27052004";    
                $conn = mysqli_connect($hostname,$username,$password);
                $result = mysqli_query($conn,'SHOW DATABASES');
                if(!is_bool($result))
                {
                    $resultArray = mysqli_fetch_all($result);
                    for($i=0; $i < count($resultArray); $i++)
                    {
                        echo '<option value="'. $resultArray[$i][0] .'">'. $resultArray[$i][0] .'</option>';
                    }
                }
            ?>
        </SELEct>
    </div>
        <div>
            <label>MYSQL QUERY</label>
        </div>
        <div class="QueryInput">
            <textarea name="query" id="query" ></textarea>
        </div>
        <div>
            <input type="submit" id="submit" value="Send query" >
        </div>

    </form>
</body>
<script>
    document.body.addEventListener('keydown', function(e) {
	if(!(e.keyCode == 13 && (e.metaKey || e.ctrlKey))) return;
        document.getElementById('submit').click();
});
</script>
</html>