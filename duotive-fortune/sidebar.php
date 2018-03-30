<?php /* SIDEBAR */ ?>
<?php $dt_ContactMap = get_option('dt_ContactMap','no'); ?>
<?php $dt_SidebarClass = ''; if ( $dt_ContactMap == 'yes' && is_page_template('page-contact.php') ) $dt_SidebarClass = ' class="sidebar-contact"'; ?>
<section id="sidebar" <?php echo $dt_SidebarClass; ?>>
	<?php if (!is_page_template('page-contact.php') || $dt_ContactMap == 'no' && is_page_template('page-contact.php')): ?>
		<div class="sidebar-header"></div>
    <?php endif; ?>
	<?php if ( is_active_sidebar( 'general-up-widget-area' ) ) : ?>
        <ul>
            <?php dynamic_sidebar( 'general-up-widget-area' ); ?>
        </ul>
    <?php endif; ?>
    
	<?php 
		$sidebar =  get_post_meta($post->ID, "sidebars", true);
		$sidebar = str_replace(' ','-',strtolower($sidebar));
		if ($sidebar != '' )
		{
			if ( is_active_sidebar($sidebar) )
			{
				echo '<ul>';
					dynamic_sidebar($sidebar);
				echo '</ul>';
			}
		}
	?>
	<?php if(is_front_page()): ?>
        <?php if ( is_active_sidebar( 'front-page-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'front-page-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>    
    <?php if(is_single()): ?>
        <?php if ( is_active_sidebar( 'single-post-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'single-post-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?> 
    <?php if(is_singular( 'project' )): ?>
        <?php if ( is_active_sidebar( 'single-project-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'single-project-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>       
    <?php if(is_page()): ?>
        <?php if ( is_active_sidebar( 'single-page-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'single-page-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>     
    <?php if(is_category()): ?>
        <?php if ( is_active_sidebar( 'category-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'category-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>     
    <?php if(is_archive()): ?>
        <?php if ( is_active_sidebar( 'archive-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'archive-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?> 
    <?php if(is_search()): ?>
        <?php if ( is_active_sidebar( 'search-widget-area' ) ) : ?>
            <ul>
                <?php dynamic_sidebar( 'search-widget-area' ); ?>
            </ul>
        <?php endif; ?>    
    <?php endif; ?>            
	<?php if ( is_active_sidebar( 'general-down-widget-area' ) ) : ?>
        <ul>
            <?php dynamic_sidebar( 'general-down-widget-area' ); ?>
        </ul>
    <?php endif; ?>    
</section>