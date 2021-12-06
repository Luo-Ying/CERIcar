<div class="demo-register">
    <div class="login">
      <div class="login__check">

      </div>
            <div class="login__form">
                <div class="login_row">
                    <div class="custom-file">
                        <input id="case-newUserAvatar" type="file" class=" name" id="image" value="Choisir l'image">
                        <!-- <label class="custom-file-label" id="imageLabel" for="image"></label> -->
                    </div>
                </div>
                <br>
                <div class="login__row">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="case-newUserName" type="text" class="login__input name" placeholder="Username"/>
                </div>
                <div id="warning-userNameExist" style="color: red; display:none; ">Le Username existe déja</div>
                <div class="login__row">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="case-newNom" type="text" class="login__input name" placeholder="Votre nom de la famille"/>
                </div>
                <div class="login__row">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="case-newPrenom" type="text" class="login__input name" placeholder="Votre prenom"/>
                </div>
                <div class="login__row">
                    <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                    </svg>
                    <input id="case-newPassword" type="password" class="login__input pass" placeholder="Password"/>
                </div>
                <div class="login__row">
                    <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                    </svg>
                    <input id="case-confirmNewPassword" type="password" class="login__input pass" placeholder="retaper le Password"/>
                </div>
                <div id="warning-confirmNewPassword" style="color: red; display:none;">Les mots de passes ne sont pas identique ! </div>
                <button id="btn-inscrire" type="button" class="register__submit">Inscrire</button>
                <p class="login__signup">Déja un compte ? &nbsp;<a id="link-connecter">Cliquez ici</a> pour connectez</p>
            </div>
        </div>
    </div>
</div>


<script>

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

    function addNewUser(identifiant, nom, prenom, pass, avatar){
        $.ajax({
            url: "monApplicationAjax.php?action=addNewUser",
            type: "post",
            data: {
              identifiant: identifiant,
              nom: nom,
              prenom: prenom,
              pass: pass,
              avatar: avatar,
            },
            success: function(data) {
              console.log("reussit add!");
              displayBanner("Inscription reussit!");
              $.get("monApplicationAjax.php?action=loginIndex",function(res){
                  console.log(res);
                  $( "#mainContent" ).html(res);
              });
            },
            error: function(xhr) {
                alert('error');
                alert(xhr);
            }
        });
    }

    $("#btn-inscrire").click(function(res){
        if($('#case-newPassword').val() == $('#case-confirmNewPassword').val()){
            console.log("ok");
            $("#warning-confirmNewPassword").css('display', 'none');
            $.ajax({
                url: "monApplicationAjax.php?action=checkUserName",
                type: "post",
                data: {
                    "identifiant": $('#case-newUserName').val(), 
                },
                success: function(data) {
                    if(data.indexOf("userName:ok") >= 0){
                        $("#warning-userNameExist").css('display', 'none');
                        addNewUser(
                          $('#case-newUserName').val(), 
                          $('#case-newNom').val(), 
                          $('#case-newPrenom').val(), 
                          $('#case-newPassword').val(),
                          $('#case-newUserAvatar').val()  
                        )
                    }
                    else if(data.indexOf("userName:exist") >= 0){
                        $("#warning-userNameExist").show();
                    }
                },
                error: function(xhr) {
                    alert('error');
                    alert(xhr);
                }
            });
        }
        else{
            console.log("pas ok");
            $("#warning-confirmNewPassword").show();
        }
    });


    $("#link-connecter").click(function(){
        $.get("monApplicationAjax.php?action=loginIndex",function(res){
            console.log(res);
            $( "#mainContent" ).html(res);
        });
    });

</script>