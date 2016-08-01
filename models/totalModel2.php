<?php
include_once("mysql_connect.php");

class regist extends connect_one{
    
    function regist_db($id,$pw,$telephone,$address,$other){
        $sql = "insert into Member_Table (username, password, telephone, address, other) 
        values ('".$id."','".$pw."', '".$telephone."','".$address."', '".$other."')";
        $this->connect_mysql($sql);
      
    }
}
class updateMember extends connect_one{
       function update($id,$pw,$telephone,$address,$other){
         $sql = "update Member_Table set password='$pw', telephone='$telephone', address='$address', other='$other' where username='$id'";  
       $this->connect_mysql($sql);
           
       }
    }
class counthit extends connect_one{
       function counthit_rate($id){
          $sql = "UPDATE `albumphoto` SET `ap_hits`=`ap_hits`+1 WHERE `ap_id`= '".$id."'";
          $this->connect_mysql($sql);
       }
}
class insertMsg extends connect_one{
    function insertMsgFunc($album_id,$msg,$username){
      $sql="INSERT INTO `member_msg`(`album_id`,`msg`,`username`) VALUES ('".$album_id."','".$msg."','".$username."')";
      $this->connect_mysql($sql);
    }
}
class deleteAlbum extends connect_one{
    function delalbumFunc($id){
    $sql="DELETE FROM `album` WHERE `album_id`='".$id."'";
    $this->connect_mysql($sql);
    }
    function delalbumphotoFunc($id){
    $sql="DELETE FROM `albumphoto` WHERE `album_id`='".$id."'";
    $this->connect_mysql($sql);   
    }
    
}
class addAlbum extends connect_one{
	function add(){
		if(isset($_POST["action"])&&($_POST["action"]=="add")){
			$query_insert = "INSERT INTO `album` (`album_title` ,`album_date` ,`album_location` ,`album_desc`) VALUES (";
			$query_insert .= "'".$_POST["album_title"]."',";
			$query_insert .= "'".$_POST["album_date"]."',";
			$query_insert .= "'".$_POST["album_location"]."',";	
			$query_insert .= "'".$_POST["album_desc"]."')";
			$this->connect_mysql($query_insert);
			$album_pid = mysql_insert_id(); 
            
			for ($i=0; $i<count($_FILES["ap_picurl"]["name"]); $i++) {
			  if ($_FILES["ap_picurl"]["tmp_name"][$i] != "") {
				  $query_insert = "INSERT INTO albumphoto (album_id, ap_date, ap_picurl, ap_subject) VALUES (";
				  $query_insert .= $album_pid.",";
				  $query_insert .= "NOW(),";	  
				  $query_insert .= "'". $_FILES["ap_picurl"]["name"][$i]."',";
				  $query_insert .= "'".$_POST["ap_subject"][$i]."')";		  
				  $this->connect_mysql($query_insert);
				  if(!move_uploaded_file($_FILES["ap_picurl"]["tmp_name"][$i] , "../photos/" . $_FILES["ap_picurl"]["name"][$i])) die("檔案上傳失敗！");;		  
			  }
			}return $album_pid;
		}
	}
	
	
}
class updatePhoto extends connect_one{
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
		unlink("../photos/".$_POST["delfile"][$delid]);
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
		  
		  if(!move_uploaded_file($_FILES["ap_picurl"]["tmp_name"][$i] , "../photos/" . $_FILES["ap_picurl"]["name"][$i])) die("檔案上傳失敗！");;		  
	  }
	}		
  }
 }    
}

?>