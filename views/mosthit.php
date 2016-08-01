<!DOCTYPE html>
<?php
$RecPhoto=$data;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="/EasyMVC/css/bootstrap.min.css" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" type="text/css" href="/EasyMVC/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/EasyMVC/style.css">
  </head>
  <body>
      <center>
    <section class="section-padding" id="portfolio">
         <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="section-title">
                        <h2 class="head-title">熱門相片</h2>
                        <hr class="botm-line">
                        <p class="sec-para">most 6 hot!!</p><br>
                        <a href="/EasyMVC/Two/member"style="font-size:1em;align:center;color:#000000">回上頁</a>
                    </div>
                </div>
         <!--顯示照片-->
                <div class="col-md-9 col-sm-12">
               <?php for($i=0;$i<count($RecPhoto);$i++){ ?>     
                    <div class="col-md-4 col-sm-6 padding-right-zero">
                        <div class="portfolio-box design">
                            <a href="../view/albumphoto.php?id=<?php echo $RecPhoto[$i]["ap_id"];?>">
                            <img src="/EasyMVC/photos/<?php echo $RecPhoto[$i]['ap_picurl'];?>" alt="" class="img-responsive">
                            <p>點閱次數:<?php echo $RecPhoto[$i][ap_hits];?></p>
                        </div>
                    </div>
                    <?php }?>
                </div>

            </div>
        </div>
    </section>
     
    <section class="section-padding parallax bg-image-2 section" id="cta-2">
        <div class="container">
            <div class="row">
     
        </div>
    </section>

 </center>
  </body>
</html>