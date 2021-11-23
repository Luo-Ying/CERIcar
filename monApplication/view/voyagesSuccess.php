<?php
    // $i = 0;
    // foreach ($context->voyages as $voyage) {
    //     $i++;
    //     echo "<br><br><br><br><br><br>";
    //     echo "voyage ", $i, " :<br>";
    //     echo "id: ", $voyage->id, "<br>";
    //     echo "id contucteur: ", $voyage->conducteur->id, "<br>";
    //     // echo "<br>ok<br>";
    //     echo "id trajet: ", $voyage->trajet->id, "<br>";
    //     echo "tarif: ", $voyage->tarif, "<br>";
    //     echo "nbplace: ", $voyage->nbPlace, "<br>";
    //     echo "heuredepart: ", $voyage->heureDepart, "<br>";
    //     echo "contraintes: ", $voyage->contraintes, "<br>";
    // }
?>

<div class="w3-card">
    <div style="padding-left: 450px;">
    <br>
        <p> <?php echo sizeof($context->voyages) ?> trajets disponibles</p>
    </div>
    <!-- <p>123456</p> -->
    <?php $i = 0; ?>
    <?php foreach( $context->voyages as $voyage ): ?>
        <br>
        <a href="">
            <div class="voyageCard-mainContainer"> 
                <div class="voyageCard-main">
                    <div class="voyageCard-trajet">
                        <div class="voyageCardTrajetHeureDepart&Arrivee">
                            <p><?php echo $voyage->heureDepart; ?></p>
                            <br>
                            <p><?php echo $voyage->heureDepart; ?></p>
                        </div>
                        <div class="barHeuresTrajet"></div>
                        <div class="voyageCardTrajetVilleDepart&Arrivee">
                            <p><?php echo $context->trajet->depart ?></p>
                            <br>
                            <p><?php echo $context->trajet->arrivee ?></p>
                        </div>
                    </div>
                    <div class="voyageCard-conducteur">
                        <div class="voyageCard-conducteur-photo"></div>
                        <div class="voyageCard-conducteur-nom">
                            <?php echo $voyage->conducteur->nom." ".$voyage->conducteur->prenom ?>
                        </div>
                    </div>
                </div>
                <div class="voyageCard-contrainte">
                    <?php echo '" '.$voyage->contraintes.' "' ?>
                </div>
                <div class="voyageCard-tarif">
                    <?php echo $voyage->tarif."€" ?>
                </div>
            </div>
        </a>
        <br><br><br>
    <?php endforeach; ?>
</div>




