<?php 
header("Content-Type: text/html; charset=utf-8");
session_start();
require("../controllers/adminfix_con.php");
require("../controllers/fixShow_con.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>網路相簿</title>
<style type="text/css"></style>
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
</head>
<body bgcolor="#cccccc">
<table align="center">
  <tr>
    <td height="40">
      <p style="font-size:30px" >[網路相簿管理界面-修改相簿資訊]</p>
      <div><a href="/EasyMVC/Two/admin" style="font-size:24px;color:#842B00;padding-right: 1em">[管理首頁]</a>
      <a href="/EasyMVC/Two/member" style="font-size:24px;color:#842B00">[登出管理系統]</a></div></td>
  </tr>
  <tr>
    <td><div>
        <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td>
              <div>相片總數: <?php echo $total_records;?></div>
              <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <div>
                  <p>相簿內容</p>
                  <p>相簿名稱：
                    <input name="album_title" type="text" id="album_title" value="<?php echo $RecAlbum[0]["album_title"];?>" />
                    <input name="album_id" type="hidden" id="album_id" value="<?php echo $RecAlbum[0]["album_id"];?>" />                  
                  </p>
                  <p>拍攝時間：
                    <input name="album_date" type="text" id="album_date" value="<?php echo $RecAlbum[0]["album_date"];?>" /><br />
                    拍攝地點：
                    <input name="album_location" type="text" id="album_location" value="<?php echo $RecAlbum[0]["album_location"];?>" />
                  </p>
                  <p>相簿說明：
                    <textarea name="album_desc" id="album_desc" cols="45" rows="5"><?php echo $RecAlbum[0]["album_desc"];?></textarea>
                  </p>
                  <hr />
                </div>
                <?php
			   $checkid=0;
			   for($i=0;$i<count($RecPhoto);$i++){
			   ?>
                <div>
                  <div><img src="../photos/<?php echo $RecPhoto[$i]["ap_picurl"];?>" alt="<?php echo $RecPhoto[$i]["ap_subject"];?>" width="150" height="150" border="0" /></div>
                  <div>
                    <p>
                      <input name="ap_id[]" type="hidden" id="ap_id[]" value="<?php echo $RecPhoto[$i]["ap_id"];?>" />
                      <input name="delfile[]" type="hidden" id="delfile[]" value="<?php echo $RecPhoto[$i]["ap_picurl"];?>">
                      <input name="update_subject[]" type="text" id="update_subject[]" value="<?php echo $RecPhoto[$i]["ap_subject"];?>" size="15" />
                      <br />
                      <input name="delcheck[]" type="checkbox" id="delcheck[]" value="<?php echo $checkid;$checkid++?>" />
                      刪除?</p>
                  </div>
                </div>
                <?php }?>
                <div>
                  <hr />
                  <p>新增照片</p>
                  <div></div>
                  <p> 照片1
                    <input type="file" name="ap_picurl[]" id="ap_picurl[]" /><br />
                    說明1：
                    <input type="text" name="ap_subject[]" id="ap_subject[]" />
                  </p>
                  <p>照片2
                    <input type="file" name="ap_picurl[]" id="ap_picurl[]" /><br />
                    說明2：
                    <input type="text" name="ap_subject[]" id="ap_subject[]" />
                  </p>
                  <p>照片3
                    <input type="file" name="ap_picurl[]" id="ap_picurl[]" /><br />
                    說明3：
                    <input type="text" name="ap_subject[]" id="ap_subject[]" />
                  </p>
                  <p>照片4
                    <input type="file" name="ap_picurl[]" id="ap_picurl[]" /><br />
                    說明4：
                    <input type="text" name="ap_subject[]" id="ap_subject[]" />
                  </p>
                  <p>照片5
                    <input type="file" name="ap_picurl[]" id="ap_picurl[]" /><br />
                    說明5：
                    <input type="text" name="ap_subject[]" id="ap_subject[]" />
                  </p>
                  <p>
                    <input name="action" type="hidden" id="action" value="update">
                    <input type="submit" name="button" id="button" value="確定修改" />
                    <input type="button" name="button2" id="button2" value="回上一頁" onClick="window.history.back();" />
                  </p>
                </div>
              </form></td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
</body>
</html>
