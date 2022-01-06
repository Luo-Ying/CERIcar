<!-- view: page of register -->

<div class="demo-register">
    <div class="login">
      <div class="login__check">

      </div>
            <div class="login__form">
                <div class="login_row">
                    <div class="custom-file">
                        <input id="case-newUserAvatar" type="file" class=" name" id="image" value="Choisir l'image">
                    </div>
                </div>
                <br>
                <div class="login__row">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="case-newUserName" type="text" class="login__input name" placeholder="Username" oninput="return userNameValidation(this.value)"/>
                </div>
                <div id="warning-userNameExist" style="color: red; display:none; ">Le Username existe déja</div>
                
                <div class="login__row">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="case-newNom" type="text" class="login__input name" placeholder="Votre nom de la famille" oninput="return userNameValidation(this.value)"/>
                </div>
                <div class="login__row">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="case-newPrenom" type="text" class="login__input name" placeholder="Votre prenom" oninput="return userNameValidation(this.value)"/>
                </div>
                <div class="login__row">
                    <svg id="Layer_1" data-name="Layer 1" viewBox="0 0 122.88 122.89" class="login__icon date svg-icon" viewBox="0 0 20 20">
                        <path d="M81.61,4.73C81.61,2.12,84.19,0,87.38,0s5.77,2.12,5.77,4.73V25.45c0,2.61-2.58,4.73-5.77,4.73s-5.77-2.12-5.77-4.73V4.73ZM66.11,105.66c-.8,0-.8-10.1,
                        0-10.1H81.9c.8,0,.8,10.1,0,10.1ZM15.85,68.94c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1Zm25.13,
                        0c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1Zm25.14-10.1H107c.8,0,.8,10.1,0,10.1H91.25c-.8,0-.8-10.1,0-10.1ZM15.85,87.3c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,
                        10.1,0,10.1ZM41,87.3c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H81.9c.8,0,.8,10.1,0,10.1Zm25.14,0c-.8,0-.8-10.1,0-10.1H107c.8,
                        0,.8,10.1,0,10.1Zm-75.4,18.36c-.8,0-.8-10.1,0-10.1H31.64c.8,0,.8,10.1,0,10.1Zm25.13,0c-.8,0-.8-10.1,0-10.1H56.77c.8,0,.8,10.1,0,10.1ZM29.61,4.73C29.61,2.12,32.19,
                        0,35.38,0s5.77,2.12,5.77,4.73V25.45c0,2.61-2.58,4.73-5.77,4.73s-5.77-2.12-5.77-4.73V4.73ZM6.4,43.47H116.47v-22a3,3,0,0,0-.86-2.07,2.92,2.92,0,0,0-2.07-.86H103a3.2,
                        3.2,0,0,1,0-6.4h10.55a9.36,9.36,0,0,1,9.33,9.33v92.09a9.36,9.36,0,0,1-9.33,9.33H9.33A9.36,9.36,0,0,1,0,113.55V21.47a9.36,9.36,0,0,1,9.33-9.33H20.6a3.2,3.2,0,1,1,0,
                        6.4H9.33a3,3,0,0,0-2.07.86,2.92,2.92,0,0,0-.86,2.07v22Zm110.08,6.41H6.4v63.67a3,3,0,0,0,.86,2.07,2.92,2.92,0,0,0,2.07.86H113.55a3,3,0,0,0,2.07-.86,2.92,2.92,0,0,0,
                        .86-2.07V49.88ZM50.43,18.54a3.2,3.2,0,0,1,0-6.4H71.92a3.2,3.2,0,1,1,0,6.4Z"/>
                    </svg>
                    <input id="case-dateNaissance" type="date" class="login__input pass"/>
                </div>
                <div class="login__row">
                    <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                    </svg>
                    <input id="case-newPassword" type="password" class="login__input pass" placeholder="Password" oninput="return passwordValidation(this.value)"/>
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
        if(!$('#case-newUserName').val() || !$('#case-newNom').val() || !$('#case-newPrenom').val() || !$('#case-newPassword').val()){
            error: console.error;
        }
        else if($('#case-newPassword').val() == $('#case-confirmNewPassword').val()){
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