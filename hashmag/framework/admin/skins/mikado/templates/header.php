<div class="mkdf-page-header page-header clearfix">

    <div class="mkdf-theme-name pull-left" >
        <img src="<?php echo esc_url(hashmag_mikado_get_skin_uri() . '/assets/img/logo.png'); ?>"
             alt="mkd_logo" class="mkdf-header-logo pull-left"/>
        <h1 class="pull-left">
            <?php echo esc_html($themeName); ?>
            <small><?php echo esc_html($themeVersion); ?></small>
        </h1>
    </div>
    <div class="mkdf-top-section-holder">
        <div class="mkdf-top-section-holder-inner">
            <div class="mkdf-notification-holder">
                <div class="mkdf-input-change"><i class="fa fa-exclamation-circle"></i>You should save your changes</div>
                <div class="mkdf-changes-saved"><i class="fa fa-check-circle"></i>All your changes are successfully saved</div>
            </div>
            <div class="mkdf-top-buttons-holder">
                <?php if($showSaveButton) { ?>
                    <input type="button" id="mkd_top_save_button" class="btn btn-info btn-sm" value="<?php esc_html_e('Save Changes', 'hashmag'); ?>"/>
                <?php } ?>
            </div>
        </div>
    </div>

</div> <!-- close div.mkdf-page-header -->