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
 

<style>

/**
 * css for the screen of mobile
 */

@media only screen and (max-width:600px) {
  body {
    font-size: 10px;
  }
  .w3-jumbo{
    font-size:34px!important
  }
  .w3-large{
    font-size:12px!important
  }
  #case-depart, #case-destination, #btn-Rechercher-voyages{
    width: 200px;
    height: 30px;
  }
  .demo {
    position: absolute;
    top: 60%;
    left: 45%;
    margin-left: -100px;
    top:370px;
    width: 250px;
    height: 350px;
    overflow: hidden;
  }
  .fa-user{
    position: absolute;
    top: 2rem;
    left: 5.8rem;
  }
  .login__form{
    position: absolute;
    top: 35%;
    left: 0;
    width:250px;
    height: 60px;
    text-align: center;
  }
  .row{
    width:250px;
    height: 60px;
    margin-left: -50px;
    padding-top: 2%;
  }
  .login__row {
    height: 5rem;
    padding-top: 1rem;
    border-bottom: 1px solid rgba(130, 137, 201, 0.2);
  }
  .login__icon {
    margin-bottom: -0.4rem;
    margin-right: 0.5rem;
  }

  .login__input {
    display: inline-block;
    width: 100px;
    padding-left: 10px;
    font-size: 12px;
  }
  .login__submit {
    position: relative;
    width: 80px;
    height: 30px;
    margin-top: 20px;
    font-size: 10px;
  }
  .login__row {
    height: 4rem;
  }
  .login__signup{
    font-size: 0.8rem;
  }
  .propose__input {
    width: 5rem;
    font-size: 0.5rem;
  }
  .propose_champ{
    font-size: 16px;
    margin-top: -45px;
  }
  #case-contraintes{
    height: 85px;
  }
  .demo-register{
    position: absolute;
    left: 20%;
  }
  .register__submit {
    position: relative;
    width: 48%;
    height: 3rem;
    margin: 2rem 0px -0.5rem;
    font-size: 1.5rem;
  }
  .cardProposerVoyage {
    font-size: 1rem;
    font-weight: 100;
    width: 265px;
    height: 265px;
    border-radius: 2ch;
    border: 1px solid hsl(0 0% 83%);
    margin-left:66px;
    margin-top:8px;
  }
  .kirk-icon{
    margin-left: 0px;
    margin-top: 0px;
  }
  .imgNbVoyageurMoins{
    height: 25px;
    margin-left: 45px;
    margin-top: 10px;
  }

  .imgNbVoyageurPlus{
    height: 25px;
    margin-left: 25px;
    margin-top: 10px;
  }
  .reserverVoyage {
    margin-left: 22%;
    width: 100px;
    height: 3rem;
    color: rgba(255, 255, 255, 0.8);
    background: #17968f;
    font-size: 13px;
  }
  #chiffreNbPlaceRestant{
    font-size: 30px;
    margin-left: 20%;
    width: 4px;
  }
  .voyageCard-mainContainer{
    width: 365px;
    height: 200px;
    margin: auto;
    padding-top: 25px;
  }
  .voyageCard-conducteur{
    margin-top: -10px;
  }

  .voyageCard-conducteur-photo{
    width: 55px;
  }
  .voyageCard-tarif {
    padding-left: 0px;
  }
  .voyageCard-contrainte {
    padding-left: 10px;
  }
  #section-nbVoyageur {
    left: 50px;
    width: 300px;
    height: 3rem;
  }

}

  </style>

</head>


<body>

  <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">


  <!-- part of header -->
  <div id="header">
    <?php include($nameApp."/view/headerSuccess.php"); ?>
  </div>
  

  <!-- part of banner -->
   <div id="banner-notification">
     <?php include($nameApp."/view/bannerSuccess.php"); ?>
   </div>


   <!-- part of main page -->
  <div id="page-mainContent">
    <?php if($context->error): ?> 
      <div id="flash_error" class="error">
        <?php echo " $context->error !!!!!" ?>
      </div>
    <?php endif; ?>
    <div id="mainContent">	
      <?php 
      include($template_view); 
      ?>
    </div>
  </div>
      

   </body>

  <?php include($nameApp."/view/footerSuccess.php"); ?>

</html>
