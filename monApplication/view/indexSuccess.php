
    <div class="w3-display-topleft w3-padding-large w3-xlarge">
    </div>
    <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top">CERI CAR</h1>
        <hr class="w3-border-grey" style="margin:auto;width:40%">
        <p class="w3-large w3-center">Didi, good travel!</p>
        <input type="text" id="case-depart" name="depart" placeholder="Départ"><br>
        <input type="text" id="case-destination" name="arrivee" placeholder="Destination"><br>
        <button type="submit" id="btn-Rechercher-voyages"><i class='fa fa-search' id='i-advanced-search-i'></i> Rechercher</button>
    </div>

<script>
    // <-- methode GET -->
    $('#btn-Rechercher-voyages').click(function () {
        if(($('#case-depart').val() != "") && ($('#case-destination').val() != "")){
            // $.get("monApplicationAjax.php?action=searchVoyages&depart="+$('#case-depart').val()+"&arrivee="+$('#case-destination').val(), function(dataVoyage){
            //     console.log(dataVoyage);
            //     $( "#mainContent" ).html(dataVoyage);
            // });
            $.ajax({
            url: "monApplicationAjax.php?action=searchVoyages",
            type: "post",
            data: {
                "depart": $('#case-depart').val(),
                "arrivee": $('#case-destination').val()
            },
            success:function(reponse){
                
                $("#mainContent").html(reponse);

                },
                error: console.error
            });
        }
        else{
            $.ajax({
            url: "monApplicationAjax.php?action=banner",
            type: "post",
            data: {
                "message":"Le champ de départ ou Destination est onligatoire !", 
                "criticality":"warning",
                "title":"error"
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

    $('#btn-home').click(function(){
        // console.log('ok');
        $.get("monApplicationAjax.php?action=index",function(res){
            console.log(res);
            $( "#mainContent" ).html(res);
        });
    })

    // <-- methode POST -->
    // $("#btn-Rechercher-voyages").click(function(){
    //     $.ajax({
    //         url: "monApplicationAjax.php?action=searchVoyages",
    //         type: "post",
    //         data: {"depart":$('#case-depart').val(), "arrivee":$('#case-destination').val()},
    //         success: function(reponse) {
    //             console.log(reponse);
    //             $( "#mainContent" ).html(reponse);
    //         },
    //         error: function(xhr) {
    //             console.log(xhr);
    //         }
    //     });
    // });
    
</script>