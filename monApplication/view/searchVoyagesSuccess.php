
<div class="w3-card">
    <div style="padding-left: 450px;">
    <br>
        <p> 
            <?php
                $voyageNonDisponible = 0;
                foreach($context->voyages as $voyage){
                    if($voyage->nbPlaceRestant == 0){
                        $voyageNonDisponible += 1;
                    }
                }
                $nbVoyageDisponible = sizeof($context->voyages) - $voyageNonDisponible;
            ?>
            <?php echo $nbVoyageDisponible ?>
            <?php if($nbVoyageDisponible > 1){echo "voyages";}else{echo "voyage";}?> disponibles
        </p>
    </div>
    <input id="pageVoyage-isConnected" value="<?php 
        if($context->getSessionAttribute('userId') != NUll){
            echo "yes";
        }else{
            echo "no";
        }
    ?>" style="display: none;"/>
    <?php foreach( $context->voyages as $voyage ): ?>
        <?php if($voyage->nbPlaceRestant > 0): ?>
        <br>
        <div class="itemVoyage" style="cursor: pointer;">
            <div class="voyageCard-mainContainer" style="cursor:pointer"> 
                <div class="voyageCard-main">
                    <div class="voyageCard-trajet">
                        <div id="voyageHorraires" class="voyageCardTrajetHeureDepart&Arrivee">
                            <input id="pageVoyage-idVoyage" value="<?php echo $voyage->id; ?>" style="display: none;"/>
                            <p><?php echo $voyage->heureDepart."h"; ?></p>
                            <input id="pageVoyage-heureDepart" value="<?php echo $voyage->heureDepart."h"; ?>" style="display: none;"/>
                            <br>
                            <p><?php echo (round($voyage->heureDepart+($voyage->trajet->distance/60))%24)."h".$voyage->trajet->distance%60; ?></p>
                            <input id="pageVoyage-heureArrivee" value="<?php echo round($voyage->heureDepart+($voyage->trajet->distance/60))."h".$voyage->trajet->distance%60; ?>" style="display: none;"/>
                        </div>
                        <div class="barHeuresTrajet"></div>
                        <div class="voyageCardTrajetVilleDepart&Arrivee">
                            <p><?php echo $context->trajet->depart ?></p>
                            <input id="pageVoyage-villeDepart" value="<?php echo $context->trajet->depart ?>" style="display: none;"/>
                            <br>
                            <p><?php echo $context->trajet->arrivee ?></p>
                            <input id="pageVoyage-villeArrivee" value="<?php echo $context->trajet->arrivee ?>" style="display: none;"/>
                        </div>
                    </div>
                    <div class="voyageCard-conducteur">
                        <div class="voyageCard-conducteur-photo"></div>
                        <div class="voyageCard-conducteur-nom">
                            <p id="link-profil-conducteur" style="cursor: pointer; border-bottom: 1px solid #000000;"><?php echo $voyage->conducteur->nom." ".$voyage->conducteur->prenom ?></p>
                            <input id="pageVoyage-conducteur" value="<?php echo $voyage->conducteur->nom." ".$voyage->conducteur->prenom ?>" style="display: none;"/>
                            <input id="pageVoyage-conducteur-identifiant" value="<?php echo $voyage->conducteur->identifiant ?>" style="display: none;"/>
                        </div>
                    </div>
                </div>
                <div class="voyageCard-contrainte">
                    <?php echo '" '.$voyage->contraintes.' "' ?>
                    <input id="pageVoyage-contraintes" value="<?php echo $voyage->contraintes ?>" style="display: none;"/>
                </div>
                <div class="voyageCard-tarif">
                    <?php echo $voyage->tarif."€" ?>
                    <input id="pageVoyage-tarif" value="<?php echo $voyage->tarif."€" ?>" style="display: none;"/>
                    <input id="pageVoyage-nbPlaceRestant" value="<?php echo $voyage->nbPlaceRestant; ?>" style="display: none;"/>
                </div>
            </div>
            <div class="voyageCard-nbPlaceRestant">
                <span>nombre places restatnt: </span> <?php echo $voyage->nbPlaceRestant; ?>
            </div>
        </div>
        <br><br><br>
        <?php $i=$i+1; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <p style="margin-left: 35%;">Il n'y a pas de voyage directe? / Le(s) voyage(s) ne vous convenez pas?</p>
    <button id="btn-searchCorrespondance" type="button" class="login__submit" style="width: 30%; margin-top:0%; margin-left:35%">Chercher voyage correspondance</button>
</div>
<br>

<script>
    $('#btn-home').click(function(){
        // console.log('ok');
        $.get("monApplicationAjax.php?action=index",function(res){
            console.log(res);
            $( "#mainContent" ).html(res);
        });
    });

    $('.itemVoyage').click(function(){
        // console.log($(this).closest('.voyageCard-mainContainer').find('#pageVoyage-contraintes'));
        if($('#pageVoyage-isConnected').val() == "yes"){
            console.log($(this).closest('.itemVoyage').find('#pageVoyage-nbPlaceRestant').val());
            $.ajax({
            url: "monApplicationAjax.php?action=pageReservationVoyage",
            type: "post",
            data:{
                "idVoyage": $(this).closest('.itemVoyage').find('#pageVoyage-idVoyage').val(),
                "heureDepart": $(this).closest('.itemVoyage').find('#pageVoyage-heureDepart').val(),
                "heureArrivee": $(this).closest('.itemVoyage').find('#pageVoyage-heureArrivee').val(),
                "villeDepart": $(this).closest('.itemVoyage').find('#pageVoyage-villeDepart').val(),
                "villeArrivee": $(this).closest('.itemVoyage').find('#pageVoyage-villeArrivee').val(),
                "conducteur": $(this).closest('.itemVoyage').find('#pageVoyage-conducteur').val(),
                "conducteurIdentifiant": $(this).closest('.itemVoyage').find('#pageVoyage-conducteur-identifiant').val(),
                "contraintes": $(this).closest('.itemVoyage').find('#pageVoyage-contraintes').val(),
                "tarif": $(this).closest('.itemVoyage').find('#pageVoyage-tarif').val(),
                "nbPlaceRestant": $(this).closest('.itemVoyage').find('#pageVoyage-nbPlaceRestant').val(),
            },
            success:function(reponse){
                // console.log($('#pageVoyage-contraintes').val());
                $("#mainContent").html(reponse);
            },
                error: console.error
            });
        }
        else{
            $.ajax({
            url: "monApplicationAjax.php?action=banner",
            type: "post",
            data: {
                "message":"Connectez-vous pour réalité cette action !", 
                "criticality":"warning",
                "title":"error"
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
    });


    $('#link-profil-conducteur').click(function(){
        if($('#pageVoyage-isConnected').val() == "yes"){
            $.ajax({
            url: "monApplicationAjax.php?action=profil",
            type: "post",
            data: {
                identifiant: $('#pageVoyage-conducteur-identifiant').val()
            },
            success:function(reponse){
                $("#mainContent").html(reponse);
            }
            });
        }
        else{
            $.ajax({
            url: "monApplicationAjax.php?action=banner",
            type: "post",
            data: {
                "message":"Connectez-vous pour réalité cette action !", 
                "criticality":"warning",
                "title":"error"
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



