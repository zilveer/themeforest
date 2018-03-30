<?php
truethemes_before_footer_top(); //action hook introduced in 4.0 for wp-activate.php, do not remove
add_filter('pre_get_posts','wploop_exclude'); 

// retrieve values from site options panel
$boxedlayout            = get_option('ka_boxedlayout');
$footer_layout          = get_option('ka_footer_layout');
$footer_layout          = apply_filters('footlayout',$footer_layout); //karma filter
$ka_footer_columns      = get_option('ka_footer_columns');
$footer_callout_main    = get_option('ka_footer_callout_main');
$footer_callout_main    = apply_filters('footcall',$footer_callout_main); //karma filter
$footer_callout_content = get_option('ka_footer_callout_content');
$footer_callout_link    = get_option('ka_footer_callout_link');
$ka_scrolltoplink       = get_option('ka_scrolltoplink');
$ka_scrolltoptext       = get_option('ka_scrolltoplinktext');
$ka_copyright           = get_option('ka_footer_copyright');
$footer_shadow_style    = get_option('ka_footer_shadow_style');//@since 4.8
$footer_shadow_style    = apply_filters('footer_shadow_style',$footer_shadow_style); //karma filter

//pre-define options for backward-compatible
if ('' == $ka_copyright): $ka_copyright = 'true'; endif;
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;
?>

<div id="footer-top">&nbsp;</div><!-- END footer-top -->
</div><!-- END main -->

        <footer role="contentinfo" id="footer">
        	<?php if('true' == $footer_callout_main): ?>
            <div id="footer-callout" <?php if(!empty($footer_callout_link)): ?>class="default-callout-link"<?php endif; ?>>
            	<div id="footer-callout-content">
                	<?php if(!empty($footer_callout_link)): ?><a href="<?php echo $footer_callout_link; ?>" class="footer-callout-link"><?php endif; ?>
                    	<?php echo stripslashes($footer_callout_content); ?>
                    <?php if(!empty($footer_callout_link)): ?></a><?php endif; ?>
                </div><!-- END footer-callout-content -->
            </div><!-- END footer-callout -->
            <?php endif; //end $footer_callout_main ?>
            
            <div class="footer-overlay">
				<?php truethemes_begin_footer_hook(); // action hook
                
                 //@since 4.8 - footer shadow
                if ('no-shadow' != $footer_shadow_style) : ?>
                <div class="karma-footer-shadow"></div><!-- END karma-footer-shadow --> 
                <?php endif; //END footer shadow style

                if (($footer_layout == "full_bottom") || ($footer_layout == "full")){ ?>
                
                <div class="footer-content">
                <?php $footer_columns = range(1,$ka_footer_columns);$footer_count = 1;$sidebar = 6;
                foreach ($footer_columns as $footer => $column){
                $class = ($ka_footer_columns == 1) ? '' : '';
                $class = ($ka_footer_columns == 2) ? 'one_half' : $class;
                $class = ($ka_footer_columns == 3) ? 'one_third' : $class;
                $class = ($ka_footer_columns == 4) ? 'one_fourth' : $class;
                $class = ($ka_footer_columns == 5) ? 'one_fifth' : $class;
                $class = ($ka_footer_columns == 6) ? 'one_sixth' : $class; 
                $lastclass = (($footer_count == $ka_footer_columns) && ($ka_footer_columns != 1)) ? '_last': '';
                ?><div class="<?php echo $class.$lastclass; ?> tt-column"><?php dynamic_sidebar($sidebar) ?></div><?php $footer_count++; $sidebar++; } ?>
                </div><!-- END footer-content -->

                <?php } else {echo '<br />';} if (($footer_layout == "full_bottom") || ($footer_layout == "bottom")){ ?>
            </div><!-- END footer-overlay -->  
        
        <div id="footer_bottom">
            <div class="info">
            	<?php if ('true' == $ka_copyright): ?>
                <div id="foot_left">&nbsp;<?php truethemes_begin_footer_left_hook();// action hook ?>
                    <?php 
						if(is_active_sidebar(12)): dynamic_sidebar("Footer Copyright - Left Side");
							elseif(get_theme_mod('footer_copyright_textbox')): echo get_theme_mod('footer_copyright_textbox'); 
						else:
							_e('Add Copyright in Wordpress Dashboard: <a href="'.admin_url( 'customize.php' ).'">Appearance > Customize</a>', 'truethemes_localize');
						endif;
					?>
                    
                </div><!-- END foot_left -->
                <?php endif; //end footer_copyright check ?>
              
                <div id="foot_right">
                    <?php
                    // Check to see if user has footer menu set, if so display it 
                    if(has_nav_menu('Footer Navigation')): ?>
                    <ul>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'Footer Navigation' ,
                        'depth'          => 0 ,
                        'container'      => false)); ?>
                    </ul>
                    <?php elseif(is_active_sidebar(13)): ?>
                    <ul><?php dynamic_sidebar("Footer Menu - Right Side"); ?></ul>
                    <?php endif; truethemes_end_footer_right_hook()// action hook ?>       
                </div><!-- END foot_right -->
            </div><!-- END info -->
        </div><!-- END footer_bottom -->
        <?php } //end footer_bottom check ?>
        </footer><!-- END footer -->
        
	</div><!-- END wrapper -->
</div><!-- END tt-layout -->
<?php wp_footer(); ?>

<?php if ($ka_scrolltoplink == "true"): //since @4.6 ?>
    <a href="#0" class="karma-scroll-top"><i class="fa fa-chevron-up"></i></a>
<?php endif; ?>
</body>
</html>