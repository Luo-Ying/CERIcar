
    <div class="nav" >
      <div class="case-nav w3-container">
          <button type="submit" id="btn-home" class=" w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Home</button>
          <?php 
            if($context->getSessionAttribute('userId')):
              // if($_SESSION['userId']): 
          ?>
          <a href="#" class="w3-bar-item w3-button w3-hover-black w3-border-white w3-bottombar w3-hover-border-gray">Proposez un voyage</a>
          <?php endif; ?>
      </div>
      <div class="case-Connecte">

        <?php if (!$context->getSessionAttribute('userId')): ?>
          <?php echo "pas ok"; ?>
          <button type="submit" id="btn-connecte" class="w3-button w3-hover-black "><a href="#">Connectez vous</a></button>

        <?php else: ?>
          Bienvenu !    
          <button type="submit" id="btn-profile" class="w3-button w3-hover-black "><a href="#"><?php echo $context->getSessionAttribute('userId') ?></a> </button>
          <button type="submit" id="btn-deconnecte" class="w3-button w3-hover-black "><a href="#">Deconnectez vous !</a></button>  
          <!-- <a href=monApplication.php?action=logout>Deconnectez vous !</a> -->
        <?php endif; ?>
      </div>
    </div>


    <?php if($context->getSessionAttribute('user_id')): ?>
      <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
    <?php endif; ?>


<script>

  $('#btn-connecte').click(function(){
      // console.log('ok');
      $.get("monApplicationAjax.php?action=loginIndex",function(res){
          console.log(res);
          $( "#mainContent" ).html(res);
      });
  });

</script>