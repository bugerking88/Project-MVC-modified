<?php
include("../models/totalModel.php");
$id=$_GET["id"];
//顯示相簿資訊
$fixShow=new fixShow();
$RecAlbum=$fixShow->show($id);

//顯示照片
$RecPhoto=$fixShow->showPhoto($id);

//計算照片總筆數
$total_records = count($RecPhoto);

//取得相簿資訊
// $row_RecAlbum=mysql_fetch_assoc($RecAlbum);

?>