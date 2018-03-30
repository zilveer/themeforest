<?php
/**
 * @package WordPress
 * @subpackage Themeva
*/

/*
Template Name: Sitemap
*/ 

	get_header();
	
	global $NV_layout;

	if( $NV_hidecontent != "yes" )
	{  
		$columns = '';
		
		if( $NV_layout == "layout_one" ) 		$columns = 'twelve';
		elseif( $NV_layout == "layout_two" )	$columns = 'eight last';
		elseif( $NV_layout == "layout_three" )	$columns = 'six last';
		elseif( $NV_layout == "layout_four" )	$columns = 'eight';
		elseif( $NV_layout == "layout_five" )   $columns = 'six';
		elseif( $NV_layout == "layout_six" )  	$columns = 'six';
		else $columns = 'eight';	
		
		echo "\n\t". '<div id="content" class="columns '. $columns .' '. $NV_layout .'">'; ?>
        
		<article>
            <h3><?php echo __('Pages', 'themeva' ); ?></h3>
            <ul><?php wp_list_pages("title_li=" ); ?></ul>
            
            <h3><?php echo __('Feeds', 'themeva' ); ?></h3>
            <ul>
                <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>
                <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>
            </ul>
            
            <h3><?php echo __('Categories', 'themeva' ); ?></h3>
            <ul><?php wp_list_categories('orderby=name&title_li='); ?></ul>
            
            <h3><?php echo __('Blog Posts', 'themeva' ); ?></h3>
            <ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8');
                    while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
                         (<?php comments_number('0', '1', '%'); ?>)
                        </li>
                    <?php endwhile; ?>
            </ul>
            
            <h3><?php echo __('Archives', 'themeva' ); ?></h3>
            <ul>
                <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
            </ul>	
         
		</article>

		<?php 

		echo "\n\t\t". '<div class="clear"></div>';
		echo "\n\t". '</div><!-- #content -->';
				
		get_sidebar();
 
 	} // Hide Content *END*  

	get_footer();