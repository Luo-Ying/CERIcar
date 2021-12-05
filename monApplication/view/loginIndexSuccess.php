<?php



?>

  <div class="demo">
    <div class="login">
      <div class="login__check"><i class="fas fa-user fa-10x"></i></div>
            <div class="login__form">
                <div class="login__row">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="case-identifiant" type="text" class="login__input name" placeholder="Username"/>
                </div>
                <div class="login__row">
                    <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                    </svg>
                    <input id="case-pass" type="password" class="login__input pass" placeholder="Password"/>
                </div>
                <button id="btn-connecter" type="button" class="login__submit">Connecter</button>
                <p class="login__signup">Vous n'avez pas un compte ? &nbsp;<a>Inscrirz-vous</a></p>
            </div>
        </div>
    </div>
</div>


<!-- check login -->
<?php



?>


<script>

    /**
     * 
     * @param {string} message 
     * @param {"success"|"warning"|"danger"} [criticality]
     * @param {string} title
     */
    function displayBanner(message, criticality, title){
        if(criticality === undefined){
            criticality = "success";
        }
        if(title === undefined){
        criticality = "success";
        }

        $.ajax({
        url: "monApplicationAjax.php?action=banner",
        type: "post",
        data: {"identifiant":$('#case-identifiant').val(), "pass":$('#case-pass').val()},
        data:{
            message: message,
            criticality: criticality,
            title: title,
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

    $("#btn-connecter").click(function(){
        // event.prenventDefault();
        if($('#case-identifiant').val() && $('#case-pass').val()){
            $.ajax({
                url: "monApplicationAjax.php?action=checkLogin",
                type: "post",
                data: {
                    "login":$('#case-identifiant').val(), 
                    "pass":$('#case-pass').val()
                },
                success: function(data) {
                    if(data.indexOf("is_login:true") >= 0){
                        // console.log("ok");
                        $.get("monApplicationAjax.php?action=header&login="+$('#case-identifiant').val(),function(data){
                            console.log();
                            $( "#header" ).html(data);
                        })
                        $.get("monApplicationAjax.php?action=index",function(data){
                            $( "#mainContent" ).html(data);
                        })
                        displayBanner("Connexion effectuée avec succès");
                        console.log("succes");
                    }
                    else if(data.indexOf("is_login:false") >= 0){
                        console.log("pas ok");
                        displayBanner("Votre compte ou mot de pass n\'est pas bon !", "danger", "error");
                        console.log("incorrecte");
                    }
                },
                error: function(xhr) {
                    alert('error');
                    alert(xhr);
                }
            });
        }
        else{
            displayBanner("Le champ de Username ou Password est onligatoire !", "warning", "error")
            console.log("manquante des truc");
        }
    });

</script>