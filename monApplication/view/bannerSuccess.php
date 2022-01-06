
<!-- notification -->

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

   <!-- -->
   
