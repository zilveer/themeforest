       <footer class="row">
        	<section class="twelve columns">
				<?php if( is_archive() || is_home() || !empty( $is_blog_page ) ) { ?>
                <div class="<?php echo $offset_columns; ?>">
                    <div class="hozbreak clearfix">&nbsp;</div>
                </div>
                <?php } elseif( is_single() ) { 
                
                    include(NV_FILES .'/inc/classes/single-class.php');
                    
                } // end if single ?>
            </section>
        </footer>