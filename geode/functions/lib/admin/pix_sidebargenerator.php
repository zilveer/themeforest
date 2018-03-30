<?php
function sidebar_generator(){

    global $options;

    if (isset($_GET['page']) && $_GET['page']=='sidebar_generator') {
    
?>

        <section id="pix_content_loaded">
            <h3><?php _e('Sidebars','geode'); ?>: <small><?php _e('Dynamic sidebars','geode'); ?></small></h3>

                <div class="pix_columns cf">

                    <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->

                    <div class="pix_column alignleft">

                        <form method="post" class="dynamic_form cf" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>">

                            <label for="pix_sidebar_generator">Add a sidebar:</label>
                            <input name="pix_sidebar_generator_" id="pix_sidebar_generator" type="text" value="">
                            <br>

                            <input type="hidden" name="action" value="data_save">
                            <input type="hidden" name="sidebar_action" value="add_a_sidebar">
                            <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>" />
                            
                            <button type="submit" class="pix_button alignright"><?php _e('Create a sidebar','geode'); ?></button>

                    </form><!-- .dynamic_form -->

                    </div><!-- .pix_column.first -->
                    <div class="pix_column alignright">

                        <form method="post" class="dynamic_form" action="<?php echo admin_url("admin.php?page=admin_interface"); ?>" data-title="<?php _e('Remove sidebar', 'geode'); ?>" data-alert="<?php _e('Are you sure you want to delete this sidebar? You aren\'t able to restore it after that.', 'geode'); ?>">

                            <?php
                                $sidebar_generator_pix = new sidebar_generator_pix(); 
                                $sidebars = $sidebar_generator_pix->get_sidebars();

                                if($sidebars != "") {
                            ?>

                                <label><?php _e('Your sidebars','geode'); ?>:</label>

                                    <input type="hidden" class="pix_sidebar_input" name="pix_sidebar_generator_1" value="" />

                                <?php
                                    $i = 1;    
                                    foreach ($sidebars as $sidebar) {
                                ?>

                                    <div class="pix_sidebar_row <?php echo $i % 2 === 0 ? 'odd' : 'even'; ?>">
                                        <span><?php echo $i.'. '; ?> <em><?php echo $sidebar; ?></em><span>
                                        <input type="hidden" class="pix_sidebar_input" name="<?php echo 'pix_sidebar_generator_1'.$i ?>" value="<?php echo $sidebar; ?>" />
                                        <a href="#" class="pix_button alignright" data-remove="<?php echo $i; ?>"><i class="scicon-iconic-cancel"></i></a>
                                    </div>

                                <?php 
                                        $i++;  
                                    }
                                } else {
                                    echo '<label>'.__('You still have no sidebars','geode').'</label>';
                                }
    

                            ?>

                            <input type="hidden" name="action" value="data_save">
                            <input type="hidden" name="sidebar_action" value="remove_a_sidebar">
                            <input type="hidden" name="sidebar_removed" value="1">
                            <input type="hidden" name="geode_security" value="<?php echo wp_create_nonce('geode_data'); ?>">
                            <input type="submit" class="hidden" value="">
                        </form><!-- .dynamic_form -->

                    </div><!-- .pix_column.second -->
                </div><!-- .pix_columns -->


        </section><!-- #pix_content_loaded -->
</div>


<?php }
} ?>