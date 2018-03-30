<?php 
/* Template Name: Contacts */
if ( !post_password_required() ) {
get_header(); the_post();
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
?>
<div class="content_wrapper">
	<div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <div class="row">
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contacts_content">
                        <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
                            <div class="page_title_block">
                                <h1 class="title"><?php the_title(); ?></h1>
                            </div>
                        <?php } ?>                    
                            <div class="contentarea">
                                <?php
                                the_content(__('Read more!', 'theme_localization'));
                                wp_link_pages(array('before' => '<div class="page-link">' . __('Pages', 'theme_localization') . ': ', 'after' => '</div>'));
                                if (gt3_get_theme_option('page_comments') == "enabled") {?>
                                <hr class="comment_hr"/>
                                <div class="row">
                                    <div class="span12">
                                        <?php comments_template(); ?>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
						</div><!-- .contacts_content -->
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
        </div>        
    </div>
</div>
<?php if (isset($gt3_theme_pagebuilder['contacts']['mapurl']) && $gt3_theme_pagebuilder['contacts']['mapurl'] !== "") { ?>
	<div class="contacts_map">
        <div class="map_block">
            <?php echo $gt3_theme_pagebuilder['contacts']['mapurl']; ?>
        </div><!-- .map_block -->
	</div>
    <script>
		jQuery(document).ready(function(){
			jQuery('.map_block').find('iframe').css('height', parseInt('<?php echo $gt3_theme_pagebuilder['contacts']['map_height']; ?>') + 'px');
		});
	</script>
<?php } 

	get_footer();
} else {
	get_header('fullscreen');
?>
    <div class="pp_block">
        <h1 class="pp_title"><?php  _e('THIS CONTENT IS', 'theme_localization') ?> <span><?php  _e('PASSWORD PROTECTED', 'theme_localization') ?></span></h1>
        <div class="pp_wrapper">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="global_center_trigger"></div>	
    <script>
		jQuery(document).ready(function(){
			jQuery('.post-password-form').find('label').find('input').attr('placeholder', 'Enter The Password...');
		});
	</script>
<?php 
	get_footer('fullscreen');
} ?>