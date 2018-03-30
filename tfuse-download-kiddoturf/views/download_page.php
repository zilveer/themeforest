<div class="wrap">
    <?php screen_icon('tools'); ?>
    <h2><?php print( sprintf( __('%s Theme Download & Installation', 'tfuse'), $this->theme_name) ); ?></h2>

    <?php
        $submit = __('Download & Install Now', 'tfuse');
        $form_action = 'admin.php?page=themefuse_download_theme';
    ?>
    
    <br/>
    <?php print( sprintf( __('Please press the "'.$submit.'" button below in order to start downloading the theme from our server. <br/><br/>We will take care and install the theme for you when the download will be finished so sit back and relax, this may take a couple of minutes.', 'tfuse') ) ); ?>

    <form method="post" action="<?php echo $form_action ?>" name="download" class="upgrade">
        <?php wp_nonce_field('themefuse-bulk-download') ?>
        
        <?php require('ftp_hidden_credentials.php'); ?>

        <?php submit_button($submit, 'button', 'tf-download', false); ?>
    </form>
</div>
