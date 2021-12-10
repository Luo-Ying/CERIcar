
<input id="pageReservationVoyage-idVoyage" value="<?php echo $context->pageVoyageIdVoyage; ?>" style="display: none;"/>
<input id="pageReservationVoyage-idVoyageur" value="<?php 
if($context->getSessionAttribute('userIdChiffre') != NULL){
    echo $context->getSessionAttribute('userIdChiffre'); 
}
?>" style="display: none;"/>


<div style="padding-top: 5%;">
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
                <a href="#" id="link-profil-conducteur"><?php echo $context->pageVoyageConducteur; ?></a>
                <input id="profil-conducteur" value="<?php echo $context->pageVoyageConducteurIdentifiant ?>" style="display: none;"/>
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
    <div class="calculnbVoyageur" style="display: flex; flex-direction:row">
        <div class="mois">
            <img src="./images/moinsGray.png" class="imgNbVoyageurMoins" >
        </div>
        <div id="chiffreNbPlaceRestant" style="font-size: 35px;margin-left: 30%;width:4px;">0</div>
        <input id="nbMaxPlaceRestant" value="<?php echo $context->pageVoyagenbPlaceRestant; ?>" style="display: none;"/>
        <div class="plus">
            <img src="./images/plus.png" class="imgNbVoyageurPlus" >
        </div>
        <!-- <div class="moins"></div> -->
    </div>
    <button id="btn-reserverVoyage" type="button" class="reserverVoyage">Réserver</button>
</div>
</div>

<script>

    $('.imgNbVoyageurMoins').click(function(){
        // var imgMois = "<img src='./images/moins.png' class='imgNbVoyageurMoins' >";
        // var imgMoisGray = "<img src='./images/moinsGray.png' class='imgNbVoyageurMoins' >";
        // var src = $('.imgNbVoyageurMoins')[0].src;
        var t = $("#chiffreNbPlaceRestant");
        console.log(t.html());
        var value = parseInt(t.html());
        if(value > 0){
            t.html(parseInt(t.html()) - 1);
            // $('.mois').innerHTML = imgMois;
            if((value-1) == 0){
                $('.imgNbVoyageurMoins').attr("src", "./images/moinsGray.png");
            }
            else{
                $('.imgNbVoyageurMoins').attr("src", "./images/moins.png");
            }
            $('.imgNbVoyageurPlus').attr("src", "./images/plus.png");
        }
        else{
            // $('.mois').innerHTML = imgMoisGray;
            $('.imgNbVoyageurMoins').attr("src", "./images/moinsGray.png");
        }
    })

    $('.imgNbVoyageurPlus').click(function(){
        // var imgPlus = "<img src='./images/plus.png' class='imgNbVoyageurMoins' >";
        // var imgPlusGray = "<img src='./images/plusGray.png' class='imgNbVoyageurMoins' >";
        var t = $("#chiffreNbPlaceRestant");
        // console.log(t.val());
        // console.log(t.html());
        var value = parseInt(t.html());
        var max = $('#nbMaxPlaceRestant').val();
        console.log(max);
        if(value < max){
            // console.log("pass");
            t.html(parseInt(t.html()) + 1);
            // $('.plus').innerHTML = imgPlus;
            if((value+1) == max){
                $('.imgNbVoyageurPlus').attr("src", "./images/plusGray.png");
            }
            else{
                $('.imgNbVoyageurPlus').attr("src", "./images/plus.png");
                $('.imgNbVoyageurMoins').attr("src", "./images/moins.png");
            }
        }
        else{
            // $('.plus').innerHTML = imgPlusGray;
            $('.imgNbVoyageurPlus').attr("src", "./images/plusGray.png");
        }
    })

    $('#btn-reserverVoyage').click(function(){
        if(parseInt($('#chiffreNbPlaceRestant').html()) > 0){
            for(var i=0; i<parseInt($('#chiffreNbPlaceRestant').html()); i++){
                $.ajax({
                    url: "monApplicationAjax.php?action=reserveVoyage",
                    type: "post",
                    data: {
                        voyage : $('#pageReservationVoyage-idVoyage').val(), 
                        voyageur : $('#pageReservationVoyage-idVoyageur').val(), 
                    },
                    success: function(data) {
                        console.log("reussit reservation!");
                    },
                    error: function(xhr) {
                        alert('error');
                        alert(xhr);
                    }
                });
            }
            $.ajax({
            url: "monApplicationAjax.php?action=banner",
            type: "post",
            data: {
                "message":" Reservation reussit !"
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

