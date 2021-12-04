
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


    <?php

      // $_SESSION['is_login']

    ?>


<body>
  <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">

    <div class="nav" >
      <div class="case-nav w3-container">
          <button type="submit" id="btn-home" class=" w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Home</button>
          <a href="#" class="w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Cherchez un voyage</a>
          <a href="#" class="w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Proposez un voyage</a>
      </div>
      <div class="case-Connecte">
        <?php if(!isset($_SESSION['is_login'])): ?>
          <button type="submit" id="btn-connecte" class="w3-button w3-hover-black ">Connectez vous</button>
        <?php endif; ?>
        <?php if(isset($_SESSION['is_login'])): ?>
          <a href=monApplication.php?action=logout>Deconnectez vous !</a>
        <?php endif; ?>
      </div>
    </div>


    <?php if($context->getSessionAttribute('user_id')): ?>
      <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
    <?php endif; ?>


<script>

  $('#btn-connecte').click(function(){
      // console.log('ok');
      $.get("monApplicationAjax.php?action=login",function(res){
          console.log(res);
          $( "#mainContent" ).html(res);
      });
  });

</script>