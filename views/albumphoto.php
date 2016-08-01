<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta http-equiv="refresh" content="5" />-->
<title>網路相簿</title>
<style type="text/css"></style>
<!--<script src="../jquery-1.9.1.min.js"></script>-->

</head>
<body bgcolor="#cccccc">
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="124" valign="top" ><div><p style="font-size:40px" >相片瀏覽</p></div>
<div><a href="/EasyMVC/Two/member" style="padding-right: 20px;font-size:25px">|相簿首頁|</a>
      <a href="admin.php" style="font-size:25px">|管理系統|</a></div></td>
  </tr>
  <tr>
    <td><div>
        <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0" method="post" action="">
          <tr>
            <td><div><p style="font-size:21px">相簿名稱:<?php echo $data['RecPhoto'][0]["album_title"];?></p></div>
              <div><img src="../photos/<?php echo $data['RecPhoto'][0]["ap_picurl"];?>" /></div>
              <div>
                <p style="font-size:18px">相片描述:<?php echo $data['RecPhoto'][0]["ap_subject"];?></p>
                <p style="font-size:18px">拍攝時間:<?php echo $data['RecPhoto'][0]["ap_date"];?></p>
                <p style="font-size:18px;color:#AE0000">訪客留言:</p>
               <div id="show_msg"> 
               <?php
              for($i=0;$i<count($data['RecMsg']);$i++){
                if($_GET["id"]==$data['RecMsg'][$i]["album_id"]){
                  echo "訪客:".$data['RecMsg'][$i]["username"]."\t";
                  echo "說:".$data['RecMsg'][$i]["msg"]."<br>";
                }
              }
                ?>
                </div>
                <form action="/EasyMVC/Two/memberMsg_con" method="post" enctype="multipart/form-data">
                  <textarea cols="40" rows="3" name="user_msg"></textarea>
                 <input name="id" type="hidden" id="action" value="<?php echo $_GET['id'];?>">
                <input name="action" type="hidden" id="action" value="add">    
                <input type="submit" name="button" id="button" value="留言">
                  </form>
              <script type="text/javascript">
              $(document).ready(function () {
              $("#button").click(function(){
                show($("#user_msg").val());
                });
              });
              </script>
              </div>
            </td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
</body>
</html>
