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
                
               <form id="login" method="post" action="/EasyMVC/Two/logincheck">
                 <font color="black" style="font-family: italic ,Times New Roman, Georgia, Serif ,font-size:80px">Account</font><br>
                 <input type="text" size="50px"  placeholder="enter your account here" name="id"><br>
                 <font color="black" style="font-family: italic ,Times New Roman, Georgia, Serif,font-size:80px">Password</font><br>
                 <input type="password" size="50px" placeholder="password here" name="pw"><br>
                 
                 <input type="image" src="/EasyMVC/img/login.jpg" alt="Submit"height="40" width="100" name="button">
                <p></p>
               <a href="/EasyMVC/Two/regist"><img src="/EasyMVC/img/register.jpg" height="45" width="100"></a>


                 </form>
                
            </div>
        
  </body>
</html>


