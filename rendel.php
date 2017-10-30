<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
/*table {
    font-family: arial, sans-serif;
    border: 1px solid black;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    padding: 10px;
}
*/
/*tr:nth-child(even) {
    background-color: #dddddd;
}*/
        body {
            background-image: url("bgimg.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: cover; 
        }
        span{
            text-shadow: 1px 1px #000000;
        }
</style>
</head>
<body>
<?php
session_start();
$meret = $_POST['meret'];
$qtyOut = '';
$darab ='';
$fileneve = '';
$db = $_POST['db'];
$neve = $_POST['neve'];
$ufneve = $_POST['ufneve'];
$uftelefon = $_POST['uftelefon'];
$ufemail = $_POST['ufemail'];
$ufmegjegy = $_POST['ufmegjegy'];
$uzenet ='';
$headers ='';

foreach($meret as $value) {

   $qtyOut = $qtyOut . $value . "<br>";

}

foreach($db as $value) {
    $darab = $darab . $value . "<br>";
}

foreach($neve as $value) {
    $fileneve = $fileneve . $value . "<br>";
}
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$uzenet .= sprintf("<b>Uraim, megrendelés érkezett!</b><br><br><b>Megrendelő adatai</b><br>" . $ufneve . "<br>" . $uftelefon . "<br>" . $ufemail . "<br>" . $ufmegjegy . "<br><br>");
$uzenet .= sprintf("<table class='w3-table w3-stripped w3-bordered'><th>Fájlok nevei</th><th>Mennyiség</th><th>Méretek</th>");
$uzenet .= sprintf("<tr><td>%s </td> <td>%s </td> <td>%s </td></tr></table>", $fileneve, $darab, $qtyOut);

mail('foto@bestduo.hu', 'Megrendelés érkezett', $uzenet, $headers);

?>
<script>
$(document).ready(function(){
    document.getElementById('id01').style.display='block';
});
</script>
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4">
      <header class="w3-container w3-orange"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Megrendelését rögzítettük</h2>
      </header>
      <div class="w3-container">
        <p>Köszönjük a megrendelését!</p>
        <p>A képek feldolgozását hamarosan megkezdjük és elkészültükről a megadott elérhetőségeken értesíteni fogjuk.</p>
        <p>Ha a megrendelésen kíván változtatni, vagy újabb képet hozzáadni, akkor csak térjen vissza a főoldalra.</p>
      </div>
      <footer class="w3-container w3-orange">
        <p><a href="http://it-store.hu/bestduo"><i class="fa fa-arrow-left"></i> Vissza a főoldalra</a></p>
      </footer>
    </div>
  </div>
</body>
</html>