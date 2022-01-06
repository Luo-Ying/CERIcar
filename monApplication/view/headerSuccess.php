
    <!-- view: header -->

    <div class="nav" >
      <div class="case-nav w3-container">
          <button type="submit" id="btn-home" class=" w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Home</button>
          <?php 
            if($context->getSessionAttribute('userId')):
          ?>
          <a id="btn-proposerVoyage" href="#" class="w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Proposez un voyage</a>
          <?php endif; ?>
      </div>
      <div class="case-Connecte">

        <?php if (!$context->getSessionAttribute('userId')): ?>
          <button type="submit" id="btn-connecte" class="w3-button w3-hover-black "><a href="#">Connectez vous</a></button>

          <!-- infos connexion user -->
        <?php else: ?>
          Bienvenu !    
          <button type="submit" id="btn-profile" class="w3-button w3-hover-black "><a href="#"><?php echo $context->getSessionAttribute('userId') ?></a> </button>
          <input id="pageProfil-userName" value="<?php echo $context->getSessionAttribute('userId'); ?>" style="display: none;"/>
          <button type="submit" id="btn-deconnecte" class="w3-button w3-hover-black "><a href="#">Deconnectez vous !</a></button>  
        <?php endif; ?>
      </div>
    </div>


    <?php if($context->getSessionAttribute('user_id')): ?>
      <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
    <?php endif; ?>


<script>

      // nav bouton index
  $('#btn-connecte').click(function(){
      $.get("monApplicationAjax.php?action=loginIndex",function(res){
          console.log(res);
          $( "#mainContent" ).html(res);
      });
  });

  // menu nouton deconnexion
  $('#btn-deconnecte').click(function(){
      $.get("monApplicationAjax.php?action=logout",function(res){
          console.log(res);
          $.get("monApplicationAjax.php?action=header",function(res){
              console.log(res);
              $( "#header" ).html(res);
          })
          $.get("monApplicationAjax.php?action=index",function(res){
              console.log(res);
              $( "#mainContent" ).html(res);
          });
      });

  });

  // bouton user aller profil
  $('#btn-profile').click(function(){
    $.ajax({
      url: "monApplicationAjax.php?action=profil",
      type: "post",
      data: {
          identifiant: $('#pageProfil-userName').val()
      },
      success:function(reponse){
          $("#mainContent").html(reponse);
      }
    });
  })

  // nav bouton pour aller le page a proposer un nouveau voyage
  $('#btn-proposerVoyage').click(function(){
    $.get("monApplicationAjax.php?action=proposerVoyageIndex",function(res){
        console.log(res);
        $( "#mainContent" ).html(res);
    });
  })

</script>