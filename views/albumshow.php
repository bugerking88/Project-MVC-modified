<?php 
header("Content-Type: text/html; charset=utf-8");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>網路相簿</title>
<style type="text/css">
#float_photo{
height: 230px;
width: 200px;
float:left;
margin:50px;
background-color: #28FF28;
}
</style>
</head>
<body bgcolor="#cccccc">
 <center>
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td height="124"><p style="font-size:60px" >[相片總覽]</p>
    <a href="/EasyMVC/Two/member"><p style="font-size:30px;color:#842B00;padding-right: 1em">[回上頁]</p></a> 
    <a href="/EasyMVC/Two/admin"><p style="font-size:30px;color:#842B00">[相簿管理]</p></a></td>
  </tr>
  <tr>
   <td><div>
     <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
       <tr>
         <td><div><p style="font-size:30px">相簿名稱:<?php echo $data['RecAlbum'][0]["album_title"];?></p>
           </div>
           <div><p style="font-size:20px">照片總數：<?php echo $data['total_records'];?></p></div>
           <div>
             <p style="font-size:20px">拍攝時間：<?php echo $data['RecAlbum'][0]["album_date"]."<br>";?>
             拍攝地點：<?php echo $data['RecAlbum'][0]["album_location"];?></p>
             <p style="font-size:20px">相簿描述:<?php echo nl2br($data['RecAlbum'][0]["album_desc"]);?></p>
             </div>
           <?php for($i=0;$i<count($data['RecPhoto']);$i++){?>
           <div id="float_photo">
           <div><a href="?action=hits&id=<?php echo $data['RecPhoto'][$i]["ap_id"];?>"><img src="/EasyMVC/photos/<?php echo $data['RecPhoto'][$i]["ap_picurl"];?>" 
           alt="<?php echo $data['RecPhoto'][$i]["ap_subject"];?>" width="180" height="180" border="0" /></a></a></div>
           <div><a href="?action=hits&id=<?php echo $data['RecPhoto'][$i]["ap_id"];?>">
            <?php echo $data['RecPhoto'][$i]["ap_subject"];?></a><br />
             <span>點閱次數：<?php echo $data['RecPhoto'][$i]["ap_hits"];?></span></div>
           </div>
           <?php }?></td>
         </tr>
     </table>
   </div></td>
  </tr>

</table>
</center>
</body>
</html>
