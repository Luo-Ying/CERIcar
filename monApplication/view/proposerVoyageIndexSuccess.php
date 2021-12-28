<style>
    /* .cardProposerVoyage{
        box-shadow: 0 1rem 2rem hsl(0 0% 0% / 20%);
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
        margin-top:5%;
    } */
</style>

<div class="cardProposerVoyage">

    <div style="display: flex; flex-direction:column;">
    <br>
        <div style="display: flex; flex-direction:row">
            <div style="display: flex; flex-direction:column;">
                <label>From : </label>
                <br>
                <label>To : </label>
                <!-- <input id="case-departPropose" type="text" class="login__input name" /> -->
            </div>
            <div style="display: flex; flex-direction:column;">
                <!-- <label>To :</label> -->
                <input id="case-departPropose" type="text" class="login__input name" style="color: black;"/>
                <br>
                <input id="case-arriveePropose" type="text" class="login__input name" style="color: black;"/>
            </div>
        </div>
        <br>
        <div style="display: flex; flex-direction:row">
            <div>
                <svg viewBox="0 0 19 15" xmlns="http://www.w3.org/2000/svg" class="kirk-icon sc-3dofso-0 fsiSTb" width="15" height="18" aria-hidden="true">
                    <g fill="none"><path d="M9.583 9.167a3.75 3.75 0 0 0 3.75-3.75v-.834a3.75 3.75 0 0 0-7.5 0v.834a3.75 3.75 0 0 0 3.75 3.75zm0 .833A4.584 4.584 0 0 1 5 5.417v-.834a4.584 4.584 0 0 1 9.167 0v.834A4.584 4.584 0 0 1 9.583 10zM18.333 17.007v1.743c0 .23-.186.417-.416.417H1.25a.417.417 0 0 1-.417-.417v-1.743a3.742 3.742 0 0 1 2.752-3.616c2.033-.554 4.08-.891 5.998-.891 1.92 0 3.966.337 5.998.891a3.742 3.742 0 0 1 2.752 3.616zm-.833 0a2.908 2.908 0 0 0-2.138-2.812c-1.967-.537-3.944-.862-5.779-.862-1.834 0-3.811.325-5.779.862a2.908 2.908 0 0 0-2.137 2.812v1.326H17.5v-1.326z" fill="#708C91"></path></g>
                </svg>
            </div>
            <div class="calculnbVoyageur" style="display: flex; flex-direction:row">
                <div class="mois">
                    <img src="./images/moinsGray.png" class="imgNbVoyageurMoins" >
                </div>
                <div id="chiffreNbPlaceRestant">0</div>
                <input id="nbMaxPlaceRestant" value="8" style="display: none;"/>
                <div class="plus">
                    <img src="./images/plus.png" class="imgNbVoyageurPlus" >
                </div>
                <!-- <div class="moins"></div> -->
            </div>
        </div>
        <br><br>
        <button id="btn-proposeSuivant" type="button" class="reserverVoyage">Suivant →</button>

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

    $('#btn-proposeSuivant').click(function(){
        if($('#case-departPropose').val() && $('#case-arriveePropose').val() && $('#chiffreNbPlaceRestant').html()>0){
            $.ajax({
                url: "monApplicationAjax.php?action=proposerVoyageSuivant",
                type: "post",
                data: {
                    depart: $('#case-departPropose').val(),
                    arrivee: $('#case-arriveePropose').val(),
                    nbPlace: $('#chiffreNbPlaceRestant').html(),
                },
                success:function(res){
                    $( "#mainContent" ).html(res);
                }
            });
        }
        else{
            $.ajax({
                url: "monApplicationAjax.php?action=banner",
                type: "post",
                data:{
                    message: "Ville depart, ville arrivee et nombre de place sont obligatoire !",
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