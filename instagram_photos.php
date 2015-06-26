<?php

include "config.php";


//recoger parámetro por la url
$tag="cat";
if(isset($_GET['tag'])){
	$tag=$_GET['tag'];
}else{
	
}

//hace la llamada a la api
$uri="https://api.instagram.com/v1/tags/".$tag."/media/recent?count=33&client_id=".INSTAGRAM_KEY;
$data=file_get_contents($uri);
$object = json_decode( $data ); // stdClass object

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>


  <style>img{ height: 300px; float: left; }</style>
</head>
<body>
  <div id="images">
  <?php //bucle con los datos

  foreach($object->data as $item):
  ?>
  <img src='<?= $item->images->standard_resolution->url?>'/>
  <?php
  endforeach;
  ?>
  
  </div>
</body>
</html>


<?php
/*
alternativa si no funciona file_get_contents

$ch = curl_init(); // open curl session
// set curl options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$data = curl_exec($ch); // execute curl session
curl_close($ch); // close curl session

*/
?>
