
<head>

  <title>Ton appli !</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="./css/fontawesome-free-5.15.4-web/css/all.css">
  <link rel="stylesheet" href="https://7npmedia.w3cschool.cn/w3.css">
  <link rel="stylesheet" href="./css/local-css/local.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script text="text/javascript" src="./js/monFonctionAjax.js"></script>
 

</head>

<body>
  <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">

    <div class="nav" >
      <div class="case-nav w3-container">
          <a href="#" class=" w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Home</a>
          <a href="#" class="w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Cherchez un voyage</a>
          <a href="#" class="w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Proposez un voyage</a>
      </div>
      <div class="case-Connecte">
          <a href=monApplication.php?action=logout>Deconnectez vous !</a>
      </div>
    </div>


    <?php if($context->getSessionAttribute('user_id')): ?>
      <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
    <?php endif; ?>