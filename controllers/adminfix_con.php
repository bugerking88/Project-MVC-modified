<?php
include("../models/totalModel2.php");
$updatePhoto=new updatePhoto();
$updatePhoto->updatePhotoDetail();
if(isset($_POST["action"])&&($_POST["action"]=="update")){
	//重新導向回到本畫面
header("Location: ?id=".$_POST["album_id"]);
}
?>