    
    <!-- warning notification -->
    <!-- <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="new-message-box">
                <div class="new-message-box-alert">
                    <div class="info-tab tip-icon-alert" title="error"><i></i></div>
                    <div class="tip-box-alert">
                        <p> 
                            Il n'y a pas de trajet !
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- erreur -->
    <!-- <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="new-message-box">
                <div class="new-message-box-danger">
                    <div class="info-tab tip-icon-danger" title="error"><i></i></div>
                    <div class="tip-box-danger">
                        <p> 
                            Echec paiment
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    
    <!-- success -->

    <?php echo $context->depart." ".$context->arrivee; ?>

    <?php if($context->hasVoyages): ?>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="new-message-box">
                    <div class="new-message-box-success">
                        <div class="info-tab tip-icon-success" title="success"><i></i></div>
                        <div class="tip-box-success">
                            <p> Recherche terminée / Poste d'annonce reussit... </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="new-message-box">
                    <div class="new-message-box-alert">
                        <div class="info-tab tip-icon-alert" title="warning"><i></i></div>
                        <div class="tip-box-alert">
                            <p> 
                                Il n'y a pas de trajet !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php echo $context->depart." ".$context->arrivee; ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="new-message-box">
                <div class="new-message-box-<?php echo $context->criticality; ?>">
                    <div class="info-tab tip-icon-<?php echo $context->criticality; ?>" title="<?php echo $context->title; ?>"><i></i></div>
                    <div class="tip-box-<?php echo $context->criticality; ?>">
                        <p> <?php echo $context->message; ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- test -->
    <!-- <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="new-message-box">
                <div class="new-message-box-success">
                    <div class="info-tab tip-icon-success" title="success"><i></i></div>
                    <div class="tip-box-success">
                        <p> Recherche terminée / Poste d'annonce reussit... </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- warning -->
    <!-- <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="new-message-box">
                <div class="new-message-box-warning">
                    <div class="info-tab tip-icon-warning" title="error"><i></i></div>
                    <div class="tip-box-warning">
                        <p> xxxx est obligatoire ! </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- notification -->
    <!-- <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="new-message-box">
                <div class="new-message-box-info">
                    <div class="info-tab tip-icon-info" title="error"><i></i></div>
                    <div class="tip-box-info">
                        <p>Vous avez une nouvelle message !     
                        <a class="btn btn-sm" href="555"> allez voir </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

   <!-- -->
   
