<?php
/**
 * @package WordPress
 * @subpackage CreativeZodiac_theme
 */
 ?> 
 <?php 
   global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    } 
 ?>
            <div id="footer">
                <p class="left">
                    <?php  echo $cz_footer_left; ?>
                </p>
                <p class="right">
                    <?php  echo $cz_footer_right; ?>
				        </p>
                <div class="clear_both"></div>                
            </div><!-- END "footer" -->
		</div><!-- END "wrapper" -->
	</div><!-- END "bgimg" -->
	<?php wp_footer(); ?>
</body>
</html>