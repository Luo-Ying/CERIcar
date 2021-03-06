
<!-- view: page of correspondings -->

<div class="w3-card">
    <!-- check if the user connected -->
    <input id="pageVoyage-isConnected" value="<?php 
        if($context->getSessionAttribute('userId') != NUll){
            echo "yes";
        }else{
            echo "no";
        }
    ?>" style="display: none;"/>
    <?php foreach($context->tabCorrespondance as $correspondance): ?>
        <?php foreach(explode(',',$correspondance['idvoyage']) as $id ): ?>
                <?php 
                    $idVoyage = (int)$id; 
                    $voyage = voyageTable::getVoyagesById($idVoyage);
                    $nbPlaceRestant = voyageTable::getNbPlaceRestantByIdVoyage($idVoyage);
                ?>
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
                            <p><?php echo $voyage->trajet->depart ?></p>
                            <input id="pageVoyage-villeDepart" value="<?php echo $voyage->trajet->depart ?>" style="display: none;"/>
                            <br>
                            <p><?php echo $voyage->trajet->arrivee ?></p>
                            <input id="pageVoyage-villeArrivee" value="<?php echo $voyage->trajet->arrivee ?>" style="display: none;"/>
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
                    <?php echo $voyage->tarif."???" ?>
                    <input id="pageVoyage-tarif" value="<?php echo $voyage->tarif."???" ?>" style="display: none;"/>
                    <input id="pageVoyage-nbPlaceRestant" value="<?php echo $nbPlaceRestant; ?>" style="display: none;"/>
                </div>
            </div>
            <div class="voyageCard-nbPlaceRestant">
                <span>nombre places restatnt: </span> <?php echo $nbPlaceRestant; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <br><br>
        <p style="margin-left: 60%;">Heure trajet totale: <?php echo $correspondance["heuretrajettotal"] ?>h</p>
        <p style="margin-left: 60%;">Tarif trajet totale: <?php echo $correspondance["tariftotal"] ?>???</p>
        <br>
        <div style="position:relative;
  font-size:16px;
  color:#999;
  overflow:hidden;
  text-align:center;">*********************************</div>
        <br><br><br><br>
    <?php endforeach; ?>
</div>



<script>


/*
 * send the information of trip to controller of reservation of trip
 */
$('.itemVoyage').click(function(){
        if($('#pageVoyage-isConnected').val() == "yes"){
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
                "message":"Connectez-vous pour r??alit?? cette action !", 
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

</script>