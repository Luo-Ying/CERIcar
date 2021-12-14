
<div>

    <div style="display: flex; flex-direction:row; position: relative; padding-left: 2%;">
        <?php if($context->user->identifiant != $context->getSessionAttribute('userId')): ?>
            <div><img src="./images/conducteurTest.jpg"></div>
            <div style="margin-left: 2%;"><?php echo $context->user->nom." ".$context->user->prenom; ?></div>
        <?php endif; ?>
    </div>

    <div>
        <p style="margin-left: 2%;">voyages reserve:</p>
        <div class="split"></div>
        <?php foreach($context->reservationsOfUser as $reservation): ?>
            <?php $voyage = $reservation->voyage ?>
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
                            <input id="pageVoyage-villeDepart" value="<?php echo $context->trajet->depart ?>" style="display: none;"/>
                            <br>
                            <p><?php echo $voyage->trajet->arrivee ?></p>
                            <input id="pageVoyage-villeArrivee" value="<?php echo $context->trajet->arrivee ?>" style="display: none;"/>
                        </div>
                    </div>
                    <div class="voyageCard-conducteur">
                        <div class="voyageCard-conducteur-photo"></div>
                        <div class="voyageCard-conducteur-nom">
                            <a href="#" id="link-profil-conducteur"><?php echo $voyage->conducteur->nom." ".$voyage->conducteur->prenom ?></a>
                            <input id="profil-conducteur" value="<?php echo $voyage->conducteur->identifiant ?>" style="display: none;"/>
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
            </div>
            <br><br><br>
        <?php endforeach; ?>
    </div>
    <div>
        <p style="margin-left: 2%;">voyage proposer:</p>
        <div class="split"></div>
        <?php foreach($context->propositionVoyageOfUser as $voyage): ?>
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
                            <input id="pageVoyage-heureArrivee" value="<?php echo (round($voyage->heureDepart+($voyage->trajet->distance/60))%24)."h".$voyage->trajet->distance%60; ?>" style="display: none;"/>
                        </div>
                        <div class="barHeuresTrajet"></div>
                        <div class="voyageCardTrajetVilleDepart&Arrivee">
                            <p><?php echo $voyage->trajet->depart ?></p>
                            <input id="pageVoyage-villeDepart" value="<?php echo $context->trajet->depart ?>" style="display: none;"/>
                            <br>
                            <p><?php echo $voyage->trajet->arrivee ?></p>
                            <input id="pageVoyage-villeArrivee" value="<?php echo $context->trajet->arrivee ?>" style="display: none;"/>
                        </div>
                    </div>
                    <div class="voyageCard-conducteur">
                        <div class="voyageCard-conducteur-photo"></div>
                        <div class="voyageCard-conducteur-nom">
                            <a href="#" id="link-profil-conducteur"><?php echo $voyage->conducteur->nom." ".$voyage->conducteur->prenom ?></a>
                            <input id="profil-conducteur" value="<?php echo $voyage->conducteur->identifiant ?>" style="display: none;"/>
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
            </div>
            <br><br><br>
        <?php endforeach; ?>
    </div>
</div>

<script>

    $('#link-profil-conducteur').click(function(){
        $.ajax({
        url: "monApplicationAjax.php?action=profil",
        type: "post",
        data: {
            identifiant: $('#profil-conducteur').val()
        },
        success:function(reponse){
            $("#mainContent").html(reponse);
        }
        });
    })

</script>