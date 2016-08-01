<?php
class login extends connect_two{
	function logcheck($user){
        $sql = "SELECT * FROM `Member_Table` where `username` = '{$user['id']}'";
        $row=$this->connect_getdata($sql);
        if($user['id'] && $user['pw'] && $row[0]['username'] == $user['id'] && $row[0]['password'] == $user['pw'])
		{
			$_SESSION['username'] = $user['id'];
			return true;
		}
		return false;	
	}
function regist_finish($id,$pw,$telephone,$address,$other){
     $sql = "INSERT INTO `Member_Table` (`username`, `password`, `telephone`, `address`, `other`) 
        values ('".$id."','".$pw."', '".$telephone."','".$address."', '".$other."')";
        $this->connect_mysql($sql);
        $checkError=$this->selectResult();//判斷有沒有INSERT成功
        return $checkError;
}
function updateClass($id){
        $sql = "SELECT * FROM `Member_Table` where `username`='$id'";
        $row = $this->connect_getdata($sql);
        return $row;  
}
function update_finish($id,$pw,$telephone,$address,$other){
    $sql = "UPDATE `Member_Table` SET `password`='$pw', `telephone`='$telephone', `address`='$address', `other`='$other' where `username`='$id'";  
    $this->connect_mysql($sql);
    $checkError=$this->selectResult();//判斷有沒有INSERT成功
    return $checkError;
}
function checksession($id){
        $sql = "SELECT * FROM `Member_Table` where `username` = '$id'";
        $result=$this->connect_getdata($sql);    
         return $result;
        }
function show(){
$sql ="SELECT `album`.`album_id` , `album`.`album_date` , `album`.`album_location` 
, `album`.`album_title` 
, `album`.`album_desc` 
, `albumphoto`.`ap_picurl`
, count( `albumphoto`.`ap_id` ) AS `albumNum` FROM `album` 
LEFT JOIN `albumphoto` 
ON `album`.`album_id` = `albumphoto`.`album_id` 
GROUP BY `album`.`album_id` 
ORDER BY `album_date` DESC";
$query_RecAlbum = $this->connect_getdata($sql);
return $query_RecAlbum;
}
function showlimit(){
$sql ="SELECT `album`.`album_id` , `album`.`album_date` , `album`.`album_location` 
, `album`.`album_title` 
, `album`.`album_desc` 
, `albumphoto`.`ap_picurl`
, count( `albumphoto`.`ap_id` ) AS `albumNum` FROM `album` 
LEFT JOIN `albumphoto` 
ON `album`.`album_id` = `albumphoto`.`album_id` 
GROUP BY `album`.`album_id` 
ORDER BY `album_date` DESC LIMIT 0,6";
        $RecAlbum = $this->connect_getdata($sql);
        return $RecAlbum;
        }
function hotPhotoShow(){
   $sql="SELECT * FROM `albumphoto` WHERE `ap_hits`>=5 ORDER BY `ap_hits` DESC LIMIT 0,6 ";
     $RecPhoto=$this->connect_getdata($sql);
     return $RecPhoto; 
}
function member_show(){
$sql ="SELECT `album`.`album_id` , `album`.`album_date` , `album`.`album_location` 
, `album`.`album_title` 
, `album`.`album_desc` 
, `albumphoto`.`ap_picurl`
, count( `albumphoto`.`ap_id` ) AS `albumNum` FROM `album` 
LEFT JOIN `albumphoto` 
ON `album`.`album_id` = `albumphoto`.`album_id` 
GROUP BY `album`.`album_id` 
ORDER BY `album_date` DESC";
        $query_RecAlbum = $this->connect_getdata($sql);
        return $query_RecAlbum;
}
function counthit($id){
$sql = "UPDATE `albumphoto` SET `ap_hits`=`ap_hits`+1 WHERE `ap_id`= '".$id."'";
$this->connect_mysql($sql);    
 }
function showAlbum($id){
$sql="SELECT * FROM `album` WHERE `album_id`='".$id."'";
$RecAlbum = $this->connect_getdata($sql);
$sql="SELECT * FROM albumphoto WHERE album_id='".$id."'";
$RecPhoto = $this->connect_getdata($sql);
return Array('RecAlbum'=>$RecAlbum,'RecPhoto'=>$RecPhoto);
}
function photoShow($id){
$sql="SELECT `album`.`album_title`,`albumphoto`.* FROM `album`,`albumphoto` WHERE (`album`.`album_id`=`albumphoto`.`album_id`) AND `ap_id`='".$id."'";
$RecPhoto = $this->connect_getdata($sql);
$sql="SELECT * FROM `member_msg`";
$RecMsg = $this->connect_getdata($sql);
return Array('RecPhoto'=>$RecPhoto,'RecMsg'=>$RecMsg);
}
function insertMsg($album_id,$msg,$username){
$sql="INSERT INTO `member_msg`(`album_id`,`msg`,`username`) VALUES ('".$album_id."','".$msg."','".$username."')";
$this->connect_mysql($sql);

}
function delphoto($id){
$sql="SELECT * FROM `albumphoto` WHERE `album_id`='".$id."'";
$delphoto=$this->connect_getdata($sql);
return $delphoto;  
}
function delalbumFunc($id){
$sql="DELETE FROM `album` WHERE `album_id`='".$id."'";
$this->connect_mysql($sql);
}
function delalbumphotoFunc($id){
$sql="DELETE FROM `albumphoto` WHERE `album_id`='".$id."'";
$this->connect_mysql($sql);   
}
function addAlbum(){
			$query_insert = "INSERT INTO `album` (`album_title` ,`album_date` ,`album_location` ,`album_desc`) VALUES (";
			$query_insert .= "'".$_POST["album_title"]."',";
			$query_insert .= "'".$_POST["album_date"]."',";
			$query_insert .= "'".$_POST["album_location"]."',";	
			$query_insert .= "'".$_POST["album_desc"]."')";
			$this->connect_mysql($query_insert);
			$album_pid = mysql_insert_id(); 
			for ($i=0; $i<count($_FILES["ap_picurl"]["name"]); $i++) {
			  if ($_FILES["ap_picurl"]["tmp_name"][$i] != "") {
				  $query_insert = "INSERT INTO `albumphoto` (album_id, ap_date, ap_picurl, ap_subject) VALUES (";
				  $query_insert .= $album_pid.",";
				  $query_insert .= "NOW(),";	  
				  $query_insert .= "'". $_FILES["ap_picurl"]["name"][$i]."',";
				  $query_insert .= "'".$_POST["ap_subject"][$i]."')";		  
				  $this->connect_mysql($query_insert);
				  if(!move_uploaded_file($_FILES["ap_picurl"]["tmp_name"][$i] , "photos/" . $_FILES["ap_picurl"]["name"][$i])) die("檔案上傳失敗！");;		  
			  }
			}return $album_pid;
	}
function fixshow($id){
$sql="SELECT * FROM `album` WHERE `album_id`='".$id."'";
$RecAlbum=$this->connect_getdata($sql);
return $RecAlbum; 
}
function showPhoto($id){
$sql="SELECT * FROM `albumphoto` WHERE `album_id`=".$id." ORDER BY `ap_date` DESC";
$RecPhoto=$this->connect_getdata($sql);
return $RecPhoto; 
}
function updatePhotoDetail(){
if(isset($_POST["action"])&&($_POST["action"]=="update")){	
	//更新相簿資訊
	$query_update = "UPDATE `album` SET ";
	$query_update .= "`album_title`='".$_POST["album_title"]."',";
	$query_update .= "`album_date`='".$_POST["album_date"]."',";
	$query_update .= "`album_location`='".$_POST["album_location"]."',";	
	$query_update .= "`album_desc`='".$_POST["album_desc"]."' ";	
	$query_update .= "WHERE `album_id`=".$_POST["album_id"];
	$this->connect_mysql($query_update);
	//更新照片資訊
	for ($i=0; $i<count($_POST["ap_id"]); $i++) {
		$query_update = "UPDATE `albumphoto` SET `ap_subject`='".$_POST["update_subject"][$i]."' WHERE `ap_id`=".$_POST["ap_id"][$i];	
		$this->connect_mysql($query_update);
	}
	//執行檔案刪除
	for ($i=0; $i<count($_POST["delcheck"]); $i++) {
		$delid = $_POST["delcheck"][$i];
		$query_del = "DELETE FROM `albumphoto` WHERE `ap_id`=".$_POST["ap_id"][$delid];	
		$this->connect_mysql($query_del);
		unlink("photos/".$_POST["delfile"][$delid]);
	}
	//執行照片新增及檔案上傳
	for ($i=0; $i<count($_FILES["ap_picurl"]); $i++) {
	  if ($_FILES["ap_picurl"]["tmp_name"][$i] != "") {
		  $query_insert = "INSERT INTO albumphoto (album_id, ap_date, ap_picurl, ap_subject) VALUES (";
		  $query_insert .= $_POST["album_id"].",";
		  $query_insert .= "NOW(),";	  
		  $query_insert .= "'". $_FILES["ap_picurl"]["name"][$i]."',";
		  $query_insert .= "'".$_POST["ap_subject"][$i]."')";		  
		  $this->connect_mysql($query_insert);
		  
		 if(!move_uploaded_file($_FILES["ap_picurl"]["tmp_name"][$i] , "photos/" . $_FILES["ap_picurl"]["name"][$i])) 
		 die("檔案上傳失敗！");		  
	  }
	}		
  }
 } 
}
?>