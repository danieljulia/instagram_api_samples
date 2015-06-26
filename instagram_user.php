<?php

include "config.php";

// primero es necesario saber el id del usuario y realizar una llamada a la api para ello
// o ir a esta web a consultarlo http://jelled.com/instagram/lookup-user-id
$user="danieljulia";

if(isset($_GET['user'])){
	$user=$_GET['user'];
}else{
	
}
$requser="https://api.instagram.com/v1/users/search?q=".$user."&client_id=".INSTAGRAM_KEY;
$res=file_get_contents($requser);



$user_data=json_decode($res);
$user_id=$user_data->data[0]->id;

//y ahora la llamada para obtener las fotos
$uri="https://api.instagram.com/v1/users/".$user_id."/media/recent?client_id=".INSTAGRAM_KEY;



$res=file_get_contents($uri);
$data=json_decode($res);




?>

<!doctype html>
<html>
<head>
<style type="text/css">
body{
	background:#ccc;
}
#magazine{ 
	width:60%;
	margin: 0 auto;
}

#magazine img{ 
	width:100%;
	height: auto;
}

#magazine .turn-page{
	background-color:#fff;
	background-size:100% 100%;
}
</style>
</head>
<body>

<div id="magazine">
<h1>Las fotos de @<?php print $user?></h1>
	<?php
	foreach($data->data as $item):
	?>
	<a href="<?php echo  $item->link?>"><img src='<?php echo $item->images->standard_resolution->url?>'></a>
	<?php
	endforeach;
	?>


</div>

</body>
</html>
