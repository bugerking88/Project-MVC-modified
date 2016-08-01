<?php session_start(); ?>
<?php 
header("Content-Type: text/html; charset=utf-8");
// include("../controllers/delAlbum_con.php");
?>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>網路相簿</title>
 <style type="text/css">
  #float_photo{
height: 240px;
width: 200px;
float:left;
margin:50px;
background-color: #FF5151;
}
 </style>
 <script language="javascript">
  function deletesure() {
   if (confirm('\n您確定要刪除整個相簿嗎?\n刪除後無法恢復!\n')) return true;
   return false;
  }
 </script>
</head>

<body bgcolor="#9D9D9D">
 <center>
  <table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
    <td height="124" valign="top">
     <div class="titleDiv"><p style="font-size:5em;align:center;color:#D9B300">[網路相簿管理界面]</p><br />
     </div>
     <div><a href="/EasyMVC/Two/member" style="font-size:2em;align:center;color:#FFFFFF;padding-right: 1em">[登出管理系統]</a></div>
    </td>
   </tr>
   <tr>
    <td>
     <div>
      <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
       <tr>
        <td>
         <div><p style="font-size:30px;padding-right: 2em">相簿總數:
          <?php echo $total_records;?></p>
          <a href="/EasyMVC/Two/adminadd" style="font-size:30px;color:#842B00">新增相簿</a></div>
         <div></div>
         <?php for($i=0;$i<count($data[0]);$i++){ ?>
         <div id="float_photo">
          <div>
           <a href="/EasyMVC/Two/adminfix?id=<?php echo $data[0][$i]["album_id"];?>">
            <?php if($data[0][$i]["albumNum"]==0){?>
            <img src="../img/nopic.png" alt="暫無圖片" width="180" height="180" border="0" />
            <?php }else{?><img src="../photos/<?php echo $data[0][$i]["ap_picurl"];?>" alt="<?php echo $data[0][$i]["album_title"];?>" width="180" height="180" border="0" />
            <?php }?>
           </a>
          </div>
          <div>
           <a href="adminfix.php?id=<?php echo $data[0][$i]["album_id"];?>">
            <?php echo $data[0][$i]["album_title"];?>
           </a><br />
           <span>共 <?php echo $data[0][$i]["albumNum"];?> 張</span><br>
           <a href="?action=delete&id=<?php echo $data[0][$i]["album_id"];?>" onClick="javascript:return deletesure();">(刪除相簿)</a><br>
          </div>
         </div>
         <?php }?>

        </td>
       </tr>
      </table>
     </div>
    </td>
   </tr>
  </table>
           <div><p style="font-size:1.5em">
          <?php if ($data[1]['num_pages'] > 1) { // 若不是第一頁則顯示 ?>
          <a href="?page=1">|&lt;</a> <a href="?page=<?php echo $data[1]['num_pages']-1;?>">&lt;&lt;</a>
          <?php }else{?> |&lt; &lt;&lt;
          <?php }?>
          <?php
  	  for($i=1;$i<=$data[1]['total_pages'];$i++){
  	  	  if($i==$data[1]['num_pages']){
  	  	  	  echo $i." ";
  	  	  }else{
  	  	      echo "<a href=\"?page=$i\">$i</a> ";
  	  	  }
  	  }
  	  ?>
           <?php if ($data[1]['num_pages'] < $data[1]['total_pages']) { // 若不是最後一頁則顯示 ?>
           <a href="?page=<?php echo $data[1]['num_pages']+1;?>">&gt;&gt;</a> <a href="?page=<?php echo $data[1]['total_pages'];?>">&gt;|</a>
           <?php }else{?> &gt;&gt; &gt;|
           <?php }?>
         </p></div>
 </center>
</body>

</html>
