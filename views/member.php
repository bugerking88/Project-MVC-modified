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
background-color: #ADADAD;
}
</style>
</head>
<body bgcolor="#9D9D9D">
<center>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
     <td height="3" valign="top">
     <p style="font-size:5em;align:center;color:#D9B300">[生活、旅行的記錄]</p>
        <div>
          <a href="/EasyMVC/Two/admin" style="font-size:2em;align:center;color:#FFFFFF;padding-right: 1em">相簿管理</a>
          <a href="/EasyMVC/Two/update" style="font-size:2em;align:center;color:#FFFFFF;padding-right: 1em">會員資料修改</a>
          <a href="/EasyMVC/Two/hotPhotoShow" style="font-size:2em;align:center;color:#FFFFFF;padding-right: 1em">熱門相片</a>
          <a href="/EasyMVC/Two/logout" style="font-size:2em;align:center;color:#FFFFFF;padding-right: 1em">登出</a>
        </div>
     </td>
    </tr>
    <tr>
     <td>
      <div>
       <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
        <tr>
         <td>
           <div>
            <p style="font-size:2em">網路相簿總覽</p>
           </div>
             <div>
              <p style="font-size:2em">相簿總數:
             <?php echo $data[1]['total_records'];?>
              </p>
             </div>
<?php	for($i=0;$i<count($data[0]);$i++){ ?>
             <div id="float_photo">
             <a href="/EasyMVC/Two/albumshow?id=<?php echo $data[0][$i]["album_id"];?>">
             <?php if($data[0][$i]["albumNum"]==0){?><img src="../img/nopic.png" alt="暫無圖片" width="180" height="180" border="0" />
             <?php }else{?><img src="../photos/<?php echo $data[0][$i]["ap_picurl"];?>" alt="<?php echo $data[$i]["album_title"];?>" width="180" height="180" border="0" />
             <?php }?>
             </a>
                <p>
            <a href="/EasyMVC/Two/albumshow?id=<?php echo $data[0][$i]["album_id"];?>">
<?php echo $data[0][$i]["album_title"];?>
            </a><br />
            <span>共 <?php echo $data[0][$i]["albumNum"];?> 張</span><br>
            <br>
           </p>
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
            <div>
              <p style="font-size:1.5em">
              <?php if ($data[1]['num_pages']> 1) { // 若不是第一頁則顯示 ?>
              <a href="?page=1">|&lt;</a> 
              <a href="?page=<?php echo $data[1]['num_pages']-1;?>">&lt;&lt;</a>
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
              </p>
              </div>
        </center>
    </body>

    </html>