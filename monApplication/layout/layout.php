<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

  <title>Ton appli !</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://7npmedia.w3cschool.cn/w3.css">
  <link rel="stylesheet" href="./css/fontawesome-free-5.15.4-web/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/local-css/local.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script text="text/javascript" src="./js/local.js"></script>
 

</head>


<body>

  <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">

  <div id="header">
    <?php include($nameApp."/view/headerSuccess.php"); ?>
  </div>
  
   <div id="banner-notification">
     <?php include($nameApp."/view/bannerSuccess.php"); ?>
   </div>


  <div id="page-mainContent">
    <?php if($context->error): ?> 
      <div id="flash_error" class="error">
        <!-- <img url='../../images/imgIndex.jpg'> -->
        <?php echo " $context->error !!!!!" ?>
      </div>
    <?php endif; ?>
    <div id="mainContent">	
      <?php 
      include($template_view); 
      // echo "ok";
      // echo $context->depart;
      ?>
    </div>
  </div>
      

   </body>

  <?php include($nameApp."/view/footerSuccess.php"); ?>

</html>

<script>
  // $(function(){
  //   $('#banner-notification').css('diaplay', 'block');
  //   setTimeout(function(){
  //     $("#banner-notification").css('display', 'none');
  //   }, 2500);
  // })
</script>