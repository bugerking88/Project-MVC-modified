<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>會員登入</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="/EasyMVC/css/bootstrap.min.css" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" type="text/css" href="/EasyMVC/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/EasyMVC/style.css">
    <script src="/EasyMVC/jquery.js"></script>
<style type="text/css">
    body{
       background-color:gray; 
    }
</style>

  </head>
  <body>
      <header class="main-header">
        <div class="container text-center">
             <h2 class="top-title">Web Design & Development</h2>
                    <h3 class="title">Life story</h3>
                    <h4 class="sub-title">We Create amazing designs</h4>
        <a href="/EasyMVC/Two/index"><button type="submit" class="btn btn-submit">Home</button></a>
        </div>
    </header>
    <div align="center">
<form name="form" method="post" action="/EasyMVC/Two/regist_finish">
帳號：<input type="text" name="id" />(必填) <br>
密碼：<input type="password" name="pw" /> (必填)<br>
再一次輸入密碼：<input type="password" name="pw2" /> (必填)<br>
電話：<input type="text" name="telephone" /> <br>
地址：<input type="text" name="address" /> <br>
備註：<textarea name="other" cols="45" rows="5"></textarea> 
<input type="submit" name="button" value="go" class="btn btn-submit"/>
</form>
</div>
</body>
</html>