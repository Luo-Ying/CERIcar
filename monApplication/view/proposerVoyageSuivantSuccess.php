<input id="proposeVoyage-idVoyageur" value="<?php echo $context->getSessionAttribute('userIdChiffre'); ?>" style="display: none;"/>
<input id="proposeVoyage-idTrajet" value="<?php echo $context->trajetProposer->id; ?>" style="display: none;"/>
<input id="proposeVoyage-nbPlace" value="<?php echo $context->nbPlace; ?>" style="display: none;"/>

<div class="cardProposerVoyage"
style="  box-shadow: 0 1rem 2rem hsl(0 0% 0% / 20%);
  background: hsl(0 0% 100%);
  color: hsl(200 50% 20%);
  line-height: 1.5;
  font-size: 1.5rem;
  font-weight: 300;
  width: 70vmin;
  height: 65vmin;
  padding: 3ch;
  border-radius: 2ch;
  border: 1px solid hsl(0 0% 83%);
  margin-left:34%;
  margin-top:5%;">

    <div style="display: flex; flex-direction:column;">
        <br>
        <div style="display: flex; flex-direction:row">
            <div style="display: flex; flex-direction:column;">
                <label>Heure départ : </label>
                <br>
                <label>Tarif : </label>
                <br>
                <!-- <label>contrainte : </label> -->
                <!-- <input id="case-departPropose" type="text" class="login__input name" /> -->
            </div>
            <div style="display: flex; flex-direction:column;">
                <!-- <label>To :</label> -->
                <div><input id="case-heureDepartPropose" type="text" class="login__input name" style="color: black; width:10rem;"/> h</div>
                <br>
                <div><input id="case-tarifPropose" type="text" class="login__input name" style="color: black; width:10rem;"/> €</div>
                <br>
                <!-- <textarea></textarea> -->
            </div>
        </div>
        <div style="display: flex; flex-direction:row;">
            <!-- <label>contrainte </label> -->
            <textarea id="case-contraintes" placeholder="contrainte" style="width: 370px; height: 100px;"></textarea>
        </div>
        <br><br>
        <button id="btn-proposeVoyage" type="button" class="reserverVoyage" style="margin-bottom: 80px;">Proposer</button>
    </div>
</div>

<script>

    $('#btn-proposeVoyage').click(function(){
        $.ajax({
            url: "monApplicationAjax.php?action=proposerVoyage",
            type: "post",
            data: {
                conducteur: $('#proposeVoyage-idVoyageur').val(), 
                trajet: $('#proposeVoyage-idTrajet').val(), 
                tarif: $('#case-tarifPropose').val(), 
                nbPlace: $('#proposeVoyage-nbPlace').val(), 
                heuredepart: $('#case-heureDepartPropose').val(), 
                contraintes: $('#case-contraintes').val(), 
            },
            success:function(res){
                $.ajax({
                url: "monApplicationAjax.php?action=banner",
                type: "post",
                data:{
                    message: "Proposition à accepté! ",
                },
                success:function(reponse){
                    $.get("monApplicationAjax.php?action=index",function(res){
                        console.log(res);
                        $( "#mainContent" ).html(res);
                    });
                    $("#banner-notification").html(reponse);

                        setTimeout(function(){ 
                            $("#banner-notification").show();
                        }, 500);

                        setTimeout(function(){ 
                            $("#banner-notification").css('display', 'none');
                        }, 2500);

                    },
                });
            }
            
        });
    })

</script>