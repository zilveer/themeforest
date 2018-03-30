<?php
/**
 * User: cb-theme
 * Date: 11.10.13
 * Time: 13:25
 * cb-theme Admin Demo Content
 */


function show_cb_demo_page()
{
    ?>


    <?php

    global $demos;

    if (isset($_GET['tab'])) if ($_GET['tab'] == 'cb-demo-page') {
        $data = $_POST;
        $demol = '';
        $demol_att = '';
        if (isset($data['demol'])) $demol = esc_attr($data['demol']);
        if (isset($data['demo_atts'])) $demol_att = esc_attr($data['demo_atts']);


        if ($demol != '') {
            $nonce = $_REQUEST['security'];
            if (!wp_verify_nonce($nonce, 'cb-modello')) {
                // This nonce is not valid.
                die('Security check');
            } else {
                // The nonce was valid.
                // Do stuff here.
               if (isset($data['demo_settings']) && $data['demo_settings'] == 'yes') {

                    if (isset($demos[$demol])) {
                        require(get_template_directory() . $demos[$demol]['install']);
                    } else {
                        require(get_template_directory() . '/inc/cb-install.php');
                    }
                }


                if ($demol_att == 'yes') $auto_import_att = '1'; else $auto_import_att = '0';

                require(get_template_directory() . '/inc/cb-autoimporter/autoimporter.php');

                if (isset($demos[$demol])) {
                    $args = array('file' => get_template_directory() . '/docs/import/' . $demos[$demol]['xml'], 'map_user_id' => 1);

                } else {
                    $args = array('file' => get_template_directory() . '/docs/import/demo_content.xml', 'map_user_id' => 1);
                }

                if (isset($data['demo_pages']) && $data['demo_pages'] == 'yes') {
                    ob_start();
                    auto_import($args, $auto_import_att);
                    $con = ob_get_contents();
                    ob_end_clean();
                }
                $v3 = '1';
                /*
                update_option( 'show_on_front ', 'page' );
                if($demol=='onepage'){ update_option( 'page_on_front ', '163' ); }
                else { update_option( 'page_on_front ', '5188' ); }
        */
                $demo_widget = esc_attr($data['demo_widget']);

                if ($demo_widget != '') {

                    if ($demo_widget != '') {

                        ob_start();
                        /*$importer = new Widget_Data_Importer;
                        $importer->ajax_import_widget_data();
                        */
                        if (function_exists('wie_import_data')) {
                            if (isset($demos[$demol])) {
                                $file = get_template_directory() . '/docs/import/'.$demos[$demol]['widgets'];
                            } else {
                                $file = get_template_directory() . '/docs/import/widgets.wie';
                            }


                            if ( ! file_exists( $file ) ) {
                                echo 'Import file could not be found. Please try again.';

                            }else{

                                // Get file contents and decode
                                $data = file_get_contents( $file );
                                $data = json_decode( $data );
                                $wie_import_results = wie_import_data( $data );
                            }
                        } else {
                            echo "Widget Importer & Exporter not installed. Widgets were not imported.";
                        }

                        $con = ob_get_contents();
                        ob_end_clean();
                        $v3 = '1';
                    }
                }
            }
            //security end

            if ($con != '') {
                echo '<div class="updated">
        <p>' . $con . '</p></div>';

            }
        }
    }


    ?>
    <h3>Demo Content</h3>
    <div class="tab_desc">Choose your options and click load</div>
    <!-- DEMO SECTION START-->
    <form method="POST" action="<?php echo admin_url("admin.php?page=" . $_GET["page"] . "&tab=cb-demo-page"); ?>">

        <div class="pd5" style="border-top:0px;"> In order to install Modello demo content select Demo settings and click
            "Load Demo".<br/><br/>

            If this is not new wordpress installation BACKUP your database before performing demo installation. You can
            use WP-DB-BACKUP plugin.<br/><br/><b>After clicking "Load Demo" wait untill confirmation box appears. IT MAY
                TAKE FEW MINUTES.</b>

        </div>
        <div class="pd5" style="border-bottom:0px;"><h3>Select demo settings</h3></div>
        <div class="pd5" style="border-bottom:0px;border-top:0px;">

            <div id="sel-demo">
                <?php
                foreach ($demos as $key => $demo) {
                    ?>
                    <div class="demo" data-demo="<?php echo $key; ?>">
                        <img src="<?php echo $demo['image']; ?>" class="demo-prev"/>
                        <a class="demo-link" href="<?php echo $demo['link']; ?>"
                           target="_blank"><?php echo $demo['title']; ?><br/>-- CLICK HERE TO SEE IN ACTION --</a>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
        <input type="hidden" name="demol" id="demol" value="">

        <div class="pd5" style="border-bottom:0px;"><label
                for="demo_pages"><?php _e('Load demo pages/posts', 'cb-modello'); ?></label>
            <select name="demo_pages" id="demo_pages">
                <option value="yes"><?php _e('yes', 'cb-modello'); ?></option>
                <option value="no"><?php _e('no', 'cb-modello'); ?></option>
            </select>
            <br/>
        </div>
        <div class="pd5" style="border-bottom:0px;"><label
                for="demo_widget"><?php _e('Load demo widgets', 'cb-modello'); ?></label>
            <select name="demo_widget" id="demo_widget">
                <option value=""><?php _e('no', 'cb-modello'); ?></option>
                <option value="normal"><?php _e('yes', 'cb-modello'); ?></option>
            </select>
            <br/>
        </div>
        <div class="pd5" style="border-bottom:0px;"><?php echo generate_hint('Will slow down installation'); ?>

            <label for="demo_atts"><?php _e('Load placeholder images', 'cb-modello'); ?></label>
            <select name="demo_atts" id="demo_atts">
                <option value=""><?php _e('no', 'cb-modello'); ?></option>
                <option value="yes"><?php _e('yes', 'cb-modello'); ?></option>
            </select>
            <br/>
        </div>

        <div class="pd5"
             style="border-bottom:0px;"><?php echo generate_hint('Will overwrite theme settings. Logo, styles,etc.'); ?>

            <label for="demo_settings"><?php _e('Load demo settings', 'cb-modello'); ?></label>
            <select name="demo_settings" id="demo_settings">
                <option value=""><?php _e('no', 'cb-modello'); ?></option>
                <option value="yes"><?php _e('yes', 'cb-modello'); ?></option>
            </select>
            <br/>
        </div>

        <input type="hidden" name="tab" class="cb-tab" value="cb-demo-page"/>
        <input type="hidden" name="action" value="save_cb_demo"/>
        <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>"/>

        <div class="cb-submit-button"><input type="submit" value="<?php _e('Load Demo', 'cb-modello'); ?>"
                                             class="cb-save"></div>

    </form>
    <!-- ## DEMO SECTION END ##-->

<?php
}