

<title>Ton appli !</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="./css/fontawesome-free-5.15.4-web/css/all.css">
<link rel="stylesheet" href="./css/local-css/local.css">

<body>
  <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  
    <div>
        <a href=monApplication.php?action=logout>Deconnectez vous !</a>
    </div>

    <?php if($context->getSessionAttribute('user_id')): ?>
      <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
    <?php endif; ?>