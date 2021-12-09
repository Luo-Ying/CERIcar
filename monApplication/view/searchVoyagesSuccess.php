
<div class="w3-card">
    <div style="padding-left: 450px;">
    <br>
        <p> 
            <?php echo sizeof($context->voyages) ?>
            <?php if(sizeof($context->voyages) > 1){echo "voyages";}else{echo "voyage";}?> disponibles
        </p>
    </div>
    <!-- <p>123456</p> -->
    <?php 
        $i = 0; 
        // $item = 0;
    ?>
    <?php foreach( $context->voyages as $voyage ): ?>
        <br>
        <!-- <a class="itemVoyage" href="#"> -->
            <div class="voyageCard-mainContainer itemVoyage" style="cursor:pointer"> 
                <div class="voyageCard-main">
                    <div class="voyageCard-trajet">
                        <div id="voyageHorraires" class="voyageCardTrajetHeureDepart&Arrivee">
                            <input id="pageVoyage-idVoyage" value="<?php echo $voyage->id; ?>" style="display: none;"/>
                            <p><?php echo $voyage->heureDepart."h"; ?></p>
                            <input id="pageVoyage-heureDepart" value="<?php echo $voyage->heureDepart."h"; ?>" style="display: none;"/>
                            <br>
                            <p><?php echo round($voyage->heureDepart+($voyage->trajet->distance/60))."h".$voyage->trajet->distance%60; ?></p>
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
                            <?php echo $voyage->conducteur->nom." ".$voyage->conducteur->prenom ?>
                            <input id="pageVoyage-conducteur" value="<?php echo $voyage->conducteur->nom." ".$voyage->conducteur->prenom ?>" style="display: none;"/>
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
                </div>
            </div>
        <!-- </a> -->
        <br><br><br>
        <?php $i=$i+1; ?>
    <?php endforeach; ?>
</div>

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
        $.ajax({
        url: "monApplicationAjax.php?action=pageReservationVoyage",
        type: "post",
        data:{
            // message: message,
            // criticality: criticality,
            // title: title,
            "idVoyage": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-idVoyage').val(),
            "heureDepart": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-heureDepart').val(),
            "heureArrivee": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-heureArrivee').val(),
            "villeDepart": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-villeDepart').val(),
            "villeArrivee": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-villeArrivee').val(),
            "conducteur": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-conducteur').val(),
            "contraintes": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-contraintes').val(),
            "tarif": $(this).closest('.voyageCard-mainContainer').find('#pageVoyage-tarif').val(),
        },
        success:function(reponse){
            // console.log($('#pageVoyage-contraintes').val());
            $("#mainContent").html(reponse);
        },
            error: console.error
        });
    });
</script>



