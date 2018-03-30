<?php
get_header();

//grab custom page settings
global $ttso;
$ka_404title              = stripslashes($ttso->ka_404title);
$ka_404message            = stripslashes($ttso->ka_404message);
$ka_page_title_bar_select = $ttso->ka_page_title_bar_select;//@since 4.6
$show_page_title_bar      = $ttso->ka_tools_panel;//@since 4.6
$header_shadow_style      = $ttso->ka_header_shadow_style;//@since 4.8


//define new options for backward compatible
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;
?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main">
    <?php
    //header shadow style
    if (('no-shadow' != $header_shadow_style) && ('Full Width' != $ka_page_title_bar_select)) : ?>
    <div class="karma-header-shadow"></div><!-- END karma-header-shadow --> 
    <?php endif; //END header shadow style ?>

    <?php
    // full-width page title bar
    // @since 4.6
    if( ('Full Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) ):
    get_template_part('theme-template-part-tools-fullwidth','childtheme');
    endif;
    ?>

	<div class="main-area">
		<?php
        //page-title-bar (breadcrumbs, etc)
        if( ('Fixed Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) ):
        get_template_part('theme-template-part-tools','childtheme');
        endif; ?>
        	
            <main role="main" id="content" class="content_full_width">
            	<div class="four_error">
                	<div class="four_message">
                    	<h1 class="four_o_four"><?php echo $ka_404title;?></h1>
							<?php echo $ka_404message;?>
                    </div><!-- END four_message -->
                </div><!-- END four_error -->
            </main><!-- END main #content -->
        </div><!-- END main-area -->
        
<?php get_footer(); ?>