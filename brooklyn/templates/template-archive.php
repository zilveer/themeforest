<?php
/**
 * Archive Template
 * by www.unitedthemes.com
 */

get_header(); 

$pageslogan   = get_post_meta( get_the_ID() , 'ut_section_slogan' , true ); 
$header_style = get_post_meta( get_the_ID() , 'ut_section_header_style' , true );
$header_style = ( !empty($header_style) && $header_style != 'global' ) ? $header_style : ot_get_option('ut_global_headline_style');

?>

<div class="grid-container">
<div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100">
 
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
		<div class="grid-70 prefix-15 mobile-grid-100 tablet-grid-100">
            <header class="page-header <?php echo $header_style;?>">
                <h1 class="page-title"><span><?php the_title(); ?></span></h1> 
                <?php if( !empty($pageslogan) ) : ?>
                    <p class="lead"><?php echo $pageslogan; ?></p>
                <?php endif; ?>
                    
                <div class="entry-meta">
                    <?php edit_post_link( esc_html__( 'Edit Page', 'unitedthemes' ), '<span class="edit-link">', '</span>' ); ?>
                </div>                                  
            </header>
    	</div><!-- .page-header -->
       
                        
        <div class="entry-content clearfix">
        	<div class="grid-100 mobile-grid-100 tablet-grid-100">		    		
            	<h3 class="ut-archive-template-title"><?php esc_html_e('Filter by Tags', 'unitedthemes') ?></h3> 
                	<div class="ut-archive-tags clearfix">
                    	<?php wp_tag_cloud('orderby=count&number=50'); ?> 
                    </div><!-- .archive-tags -->
			</div><!-- .grid-100 -->
                                                                                         
            <div class="grid-33 mobile-grid-100 tablet-grid-50">
            	<h3 class="ut-archive-template-title"><?php esc_html_e('Archive by Day', 'unitedthemes') ?></h3>
                	<ul class="ut-daily-archive-list">
                    	<?php wp_get_archives('type=daily'); ?>  
                    </ul><!-- .daily-archive-list -->
                    
                 <h3 class="ut-archive-template-title"><?php esc_html_e('Archive By Month', 'unitedthemes') ?></h3>
                 	<ul class="ut-monthly-archive-list">
                    	<?php wp_get_archives('type=monthly'); ?>  
                     </ul><!-- .monthly-archive-list -->
                                             
                 <h3 class="ut-archive-template-title"><?php esc_html_e('Archive by Year', 'unitedthemes') ?></h3>
                 	<ul class="ut-yearly-archive-list">
                    	<?php wp_get_archives('type=yearly'); ?>  
                    </ul><!-- .yearly-archive-list -->                            
			</div><!-- .grid-33 -->
                    
            <div class="grid-33 mobile-grid-100 tablet-grid-50">        
        		<h3 class="ut-archive-template-title"><?php esc_html_e('Contributors', 'unitedthemes') ?></h3>
                	<ul class="ut-contributors-archive-list">
                    	<?php wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC&number=3'); ?>  
                    </ul><!-- .contributors-archive-list -->    
                    
                <h3 class="ut-archive-template-title"><?php esc_html_e('Categories', 'unitedthemes') ?></h3>
                	<ul class="ut-categories-archive-list">
                    	<?php wp_list_categories('orderby=name&title_li='); ?>   
                    </ul><!-- .categories-archive-list --> 
            </div><!-- .grid-33 -->
                     
            <div class="grid-33 mobile-grid-100 tablet-grid-100">
	            <h3 class="ut-archive-template-title"><?php esc_html_e('Latest Posts', 'unitedthemes') ?></h3>
    	            <ul class="ut-latest-posts-list">
        	            <?php wp_get_archives('type=postbypost&limit=50'); ?>  
                    </ul><!-- .latest-posts-list --> 
            </div><!-- .grid-33 -->
                    
			</div><!-- .entry-content -->
            	
			</div><!-- #post-<?php the_ID(); ?> -->		
	
    </div><!-- close #primary -->
</div><!-- close .grid-container -->

<?php get_footer(); ?>
