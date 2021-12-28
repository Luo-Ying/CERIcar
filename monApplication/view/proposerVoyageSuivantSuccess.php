<input id="proposeVoyage-idVoyageur" value="<?php echo $context->getSessionAttribute('userIdChiffre'); ?>" style="display: none;"/>
<input id="proposeVoyage-idTrajet" value="<?php echo $context->trajetProposer->id; ?>" style="display: none;"/>
<input id="proposeVoyage-nbPlace" value="<?php echo $context->nbPlace; ?>" style="display: none;"/>

<div class="cardProposerVoyage">

    <div style="display: flex; flex-direction:column;"  class="propose_champ">
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
                <div><input id="case-heureDepartPropose" type="text" class="propose__input name" /> h</div>
                <br>
                <div><input id="case-tarifPropose" type="text" class="propose__input name"/> €</div>
                <br>
                <!-- <textarea></textarea> -->
            </div>
        </div>
        <div style="display: flex; flex-direction:row;">
            <!-- <label>contrainte </label> -->
            <textarea id="case-contraintes" placeholder="contrainte"></textarea>
        </div>
        <br><br>
        <button id="btn-proposeVoyage" type="button" class="reserverVoyage" style="margin-bottom: 80px;">Proposer</button>
    </div>
</div>

<script>

    $('#btn-proposeVoyage').click(function(){
        if($('#case-tarifPropose').val() && $('#case-heureDepartPropose').val()){
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
        }
        else{
            $.ajax({
                url: "monApplicationAjax.php?action=banner",
                type: "post",
                data:{
                    message: "Tarif et heure depart sont obligatoire !",
                    criticality: "warning",
                    title: "error",
                },
                success:function(reponse){
                    $("#banner-notification").html(reponse);

                        setTimeout(function(){ 
                            $("#banner-notification").show();
                        }, 500);

                        setTimeout(function(){ 
                            $("#banner-notification").css('display', 'none');
                        }, 2500);

                    },
                    error: console.error
            });
        }
    })

</script>