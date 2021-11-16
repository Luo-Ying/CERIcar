<?php
    // echo "ok";
    // echo sizeof($context->voyages),"<br>";
    // echo $context->voyages;
    $i = 0;
    foreach ($context->voyages as $voyage) {
        $i++;
        echo "<br><br><br><br><br><br>";
        echo "voyage ", $i, " :<br>";
        echo "id: ", $voyage->id, "<br>";
        echo "id contucteur: ", $voyage->conducteur->id, "<br>";
        // echo "<br>ok<br>";
        echo "id trajet: ", $voyage->trajet->id, "<br>";
        echo "tarif: ", $voyage->tarif, "<br>";
        echo "nbplace: ", $voyage->nbPlace, "<br>";
        echo "heuredepart: ", $voyage->heureDepart, "<br>";
        echo "contraintes: ", $voyage->contraintes, "<br>";
    }
?>