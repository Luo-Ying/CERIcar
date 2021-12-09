
<?php 
    // var_dump($context->heure)
?>

<div class="voyageCard-mainContainer"> 
    <div class="voyageCard-main">
        <div class="voyageCard-trajet">
            <div class="voyageCardTrajetHeureDepart&Arrivee">
                <p><?php echo $context->pageVoyageHeureDepart; ?></p>
                <br>
                <p><?php echo $context->pageVoyageHeureArrivee; ?></p>
            </div>
            <div class="barHeuresTrajet"></div>
            <div class="voyageCardTrajetVilleDepart&Arrivee">
                <p><?php echo $context->pageVoyageVilleDepart; ?></p>
                <br>
                <p><?php echo $context->pageVoyageVilleArrivee; ?></p>
            </div>
        </div>
        <div class="voyageCard-conducteur">
            <div class="voyageCard-conducteur-photo"></div>
            <div class="voyageCard-conducteur-nom">
                <?php echo $context->pageVoyageConducteur; ?>
            </div>
        </div>
    </div>
    <div class="voyageCard-contrainte">
        <?php echo '" '.$context->pageVoyageContraintes.' "'; ?>
    </div>
    <div class="voyageCard-tarif">
        <?php echo $context->pageVoyageTarif; ?>
    </div>
</div>

<div id="section-nbVoyageur" class="" title="Nombre de places que vous souhaitez réserver">
    <div>
        <svg viewBox="0 0 19 15" xmlns="http://www.w3.org/2000/svg" class="kirk-icon sc-3dofso-0 fsiSTb" width="15" height="18" aria-hidden="true">
            <g fill="none"><path d="M9.583 9.167a3.75 3.75 0 0 0 3.75-3.75v-.834a3.75 3.75 0 0 0-7.5 0v.834a3.75 3.75 0 0 0 3.75 3.75zm0 .833A4.584 4.584 0 0 1 5 5.417v-.834a4.584 4.584 0 0 1 9.167 0v.834A4.584 4.584 0 0 1 9.583 10zM18.333 17.007v1.743c0 .23-.186.417-.416.417H1.25a.417.417 0 0 1-.417-.417v-1.743a3.742 3.742 0 0 1 2.752-3.616c2.033-.554 4.08-.891 5.998-.891 1.92 0 3.966.337 5.998.891a3.742 3.742 0 0 1 2.752 3.616zm-.833 0a2.908 2.908 0 0 0-2.138-2.812c-1.967-.537-3.944-.862-5.779-.862-1.834 0-3.811.325-5.779.862a2.908 2.908 0 0 0-2.137 2.812v1.326H17.5v-1.326z" fill="#708C91"></path></g>
        </svg>
    </div>
    <div class="section-nbVoyageur">
        <div class="plus">
            <!-- <img src="./images/moins.png" class="imgNbVoyageur">
            <img src="./images/moinsGray.png" class="imgNbVoyageur"> -->
        </div>
        <div class="moins">
            <!-- <img src="./images/plus.png" class="imgNbVoyageur">
            <img src="./images/plusGray.png" class="imgNbVoyageur"> -->
        </div>
        <div class="moins"></div>
    </div>
    <button id="btn-reserverVoyage" type="button" class="reserverVoyage">Réserver</button>
</div>


