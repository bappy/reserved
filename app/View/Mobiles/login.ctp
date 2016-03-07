<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>RESERVED</title>

<!-- CSS -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/fonts/customfont.css" rel="stylesheet">
<link href="assets/css/common.css" rel="stylesheet">
</head>
<body>
<div id="wrap">
  <div class="container bghome">
    <div class="row">
      <div class="col-md-12">
        <div class="topbar">
          <div class="left"><span><a href="index.html"><img src="assets/imgs/icon-setting.png"  alt=""/></a></span></div>
          <h2>RESERVED</h2>
          <div class="right"><span><a href="#" class="src icon-src1"></a></span></div>
        </div>
        <div class="mapcon"> <img src="assets/imgs/map.jpg" width="100%" alt=""/>
          <div class="src-con">
            <input type="text" placeholder="TYPE ANYTHING">
            <a href="#" class="src-close"><img src="assets/imgs/icon-plusgray.png" width="18" height="17"  alt=""/></a></div>
          <!-- Standard button -->
          <div class="listcon">
            <div class="listbtn">
              <button type="button" class="btnnew btn-primary">LOUNGE</button>
              <button type="button" class="btnnew btn-default">CLUB</button>
              <button type="button" class="btnnew btn-default">RESTAURANT</button>
            </div>
            <div class="listinner" id="divexample2">
              <div id="wrapperexample2">
                <div class="hspilter"><img src="assets/imgs/pull.png"  alt=""/></div>
                <ul>
                  <li>
                    <div class="row">
                        <?php
                        foreach($Club['Club'] as $clubs)
                            {
                        ?>
                      <div class="col-xs-9"><a href="#"><?php echo $clubs['Club']['club_name']; ?></a></div>
                      <div class="col-xs-3 text-right">1.2m</div>
                            <?php }?>
                    </div>
                  </li>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/jquery.easing.1.3.js"></script> 
<script src="assets/js/jquery.nicescroll.min.js"></script> 
<script src="assets/js/jquery.nicescroll.plus.js"></script> 
<script src="assets/js/functions.js"></script> 
<script>
$(document).ready(function() {
$("#divexample2").niceScroll("#wrapperexample2",{cursorcolor:"#0F0",boxzoom:true});
});  
</script>
<style type="text/css">
#divexample2 {height:500px;}
</style>
</body>
</html>
