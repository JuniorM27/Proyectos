<!DOCTYPE html>
<html>
 
<head>
  <title>Data</title>
</head>
 
<body>
<table id="csv-data"></table>
  <?php
    $url = 'https://catalogodatos.gub.uy/dataset/e516cc91-29b6-4ba2-a12e-8d866ad84d55/resource/f29e50ea-6072-40fd-b483-9f49a5b958c4/download/6709_cantidad_de_suicidios_consumados-_total_pais.csv';
    file_put_contents("../data.csv", file_get_contents($url));
    echo '<script src="../scripts/csvtable.js"></script>';
  ?>
</body>
 
</html>