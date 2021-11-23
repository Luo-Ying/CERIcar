

<title>Ton appli !</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="./css/fontawesome-free-5.15.4-web/css/all.css">


<style>
    body,h1 {font-family: "Raleway", sans-serif}
    body, html {height: 100%}
    #page,#page_maincontent{
      height: 100%;
    }

    .bgimg {
      background-image: url(images/imgIndex.jpg);
      min-height: 100%;
      background-position: center;
      background-size: cover;
    }


    #case_depart, #case_destination, #btn_Rechercher, #case_date{
      /* width: 300px; */
      height: 50px;
    }

    #case_depart, #case_destination, #btn_Rechercher{
      width: 300px;
    }

    .voyageCard-mainContainer{
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 40%;
      height: 250px;
      /* left: 50px; */
      border-radius: 20px;
      margin: auto;
      padding-top: 25px;
      background-color: white;
      /* font-color:black; */
      color: black;
      display: flex;
      flex-direction: row;
    }

    .voyageCard-mainContainer:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .voyageCard-main{
      padding: 2px 16px;
      display: flex;
      flex-direction: column;
    }

    .voyageCard-trajet{
      padding-left: 35px;
      display: flex;
      flex-direction: row;
    }

    .barHeuresTrajet{
      background-image: url(images/barHeuresTrajet.png);
      height: 120px;
      width: 35px;
    }

    .voyageCard-conducteur{
      margin-top: 10px;
      display: flex;
      flex-direction: row;
    }

    .voyageCard-conducteur-photo{
      background-image: url(images/conducteurTest.jpg);
      margin-left: 20px;
      margin-top: 10px;
      width: 50px;
      height: 50px;
    }

    .voyageCard-conducteur-nom{
      margin-top: 20px;
      margin-left: 15px;
    }

    .voyageCard-contrainte{
      padding-left: 60px;
      padding-top: 50px;
    }

    .voyageCard-tarif{
      padding-left: 120px;
      font-size: x-large;
    }

  </style>

<body>
  <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  
    <div>
        <a href=monApplication.php?action=logout>Deconnectez vous !</a>
    </div>

    <?php if($context->getSessionAttribute('user_id')): ?>
      <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
    <?php endif; ?>