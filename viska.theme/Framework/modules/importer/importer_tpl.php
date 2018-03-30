<form id="awe_form" method="POST" action="">
<div id="md-framewp" class="md-framewp">
<div id="md-framewp-header">
    <div class="md-alert-boxs">
        <?php echo $this->messages;?>
    </div>
    <div class="md-alert-boxs md-alert-change" style="display: none"></div>
</div><!-- /#md-framewp-header -->
<div id="md-framewp-body" class="md-tabs">
    <div id="md-tabs-framewp" class="md-tabs-framewp">
        <ul class="clearfix">
            <li><a href="#md-import">Import Data</a></li>
        </ul>
    </div>
    <!-- /.md-tabs-framewp -->
    <div class="md-content-framewp">

        <div id="md-import" class="md-tabcontent clearfix">
            <div class="md-content-main">
                <div class="md-main-home">
                    <?php
                    $this->generate_header(__('Import Demo Data',self::LANG),'','');
                    ?>
                    <div class="importer-notice">
                        <p>
                            If you are new to wordpress or have problems creating posts or pages that look like the Theme Demo, importing demo data (post, pages, images, theme settings, ...) is the easiest way defined help you to understand how those tasks are done. It will
                            allow you to quickly edit everything instead of creating content from scratch. When you import the data following things will happen:
                        </p>

                        <ul style="padding-left: 20px;list-style-position: inside;list-style-type: square;}">
                            <li>No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified .</li>
                            <li>No WordPress settings will be modified .</li>
                            <li>About 10 posts, a few pages, 10+ images, some widgets and two menus will get imported .</li>
                            <li>Images will be downloaded from our server, these images are copyrighted and are for demo use only .</li>
                            <li>please click import only once and wait, it can take a couple of minutes</li>
                        </ul>
                    </div>
                    <div class="notice-content">
                        <?php if(isset($this->default_configs['contact_form_name']) && ! function_exists('wpcf7')):?>
                            <p class="alert-box alert-warning">Please active Contact Form 7 Plugins before importing!</p>
                        <?php endif;?>
                    </div>
                    <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('awe-import-data'); ?>" />

                    <?php
                        wp_referer_field( );
                        echo $this->generate_button(array("type"=>"button","name"=>"import-demo","class"=>"md-button import-data","label"=>"Import Demo Data"));
                    ?>
                    <!-- /.md-tabcontent-row -->
                </div>
                <!-- /.md-main-home -->
            </div>
            <!-- /.md-content-main -->
        </div>
        <!-- /.md-settings -->

    </div>
    <!-- /.md-content-framewp -->
</div>

</div><!-- /.md-framewp -->
</form>
<div id="save-alert"><i class="dashicons dashicons-update"></i></div>


