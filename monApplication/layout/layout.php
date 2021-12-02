<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    
  <?php include($nameApp."/view/headerSuccess.php"); ?>

  <!-- <body> -->
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
      

  <!-- </body> -->

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