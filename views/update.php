<?php session_start(); 
$row = $data[0];
?>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
#sitebody{
width:800px;
margin:0 auto;
height:800px;
/*font-size:13px;*/
background-image:url(../img/logo2.jpg);
　background-repeat:no-repeat;
　color:white;
　font-size: 70px;
}
#header{
background-color:#9D9D9D;
height:200px;
text-align:center;
line-height:200px;
font-size: 70px;
}
        </style>
</head>
<body>
        <div id="sitebody"><center>
              
        <div id="header">
        會員資料修改
        </div>
<?php

if($_SESSION['username'] != null)
{
        echo "<form name=\"form\" method=\"post\" action=\"/EasyMVC/Two/update_finish\">";
        echo "帳號：<input type=\"text\" name=\"id\" value=\"".$row['username']."\" />(此項目無法修改) <br>";
        echo "密碼：<input type=\"password\" name=\"pw\" value=\"".$row['password']."\" /> <br>";
        echo "再一次輸入密碼：<input type=\"password\" name=\"pw2\" value=\"".$row['password']."\" /> <br>";
        echo "電話：<input type=\"text\" name=\"telephone\" value=\"".$row['telephone']."\"> <br>";
        echo "地址：<input type=\"text\" name=\"address\" value=\"".$row['address']."\"/> <br>";
        echo "備註：<textarea name=\"other\" cols=\"45\" rows=\"5\">".$row['other']."</textarea> <br>";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
}
else
{
        echo '刪改失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
}
?>

</div>
</body>
</html>