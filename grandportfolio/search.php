<?php
/**
 * The main template file for display blog page.
 *
 * @package WordPress
*/

get_header(); 

//Include custom header feature
get_template_part("/templates/template-header");
?>

<?php
$page_sidebar = 'Search Sidebar';
?>

<!-- Begin content -->
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

    			<div class="sidebar_content">
    			
    			<div class="search_form_wrapper">
	    			<?php esc_html_e( "If you didn't find what you were looking for, try a new search.", 'grandportfolio-translation' ); ?><br/><br/>
	    			
	    			<form class="searchform" method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<input style="width:100%" type="text" class="field searchform-s" name="s" value="<?php the_search_query(); ?>" placeholder="<?php esc_html_e('Type to search and hit enter...', 'grandportfolio-translation' ); ?>">
					</form>
    			</div>
					
<?php
if (have_posts()) : while (have_posts()) : the_post();
?>

<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
	    <div class="post_content_wrapper">
	    
			<div class="one">
				<?php
					$post_type = get_post_type();
					$post_type_class = '';
					$post_type_title = '';
					
					switch($post_type)
					{
					    case 'galleries':
					    	$post_type_class = '<i class="fa fa-picture-o"></i>';
					    	$post_type_title = esc_html__('Gallery', 'grandportfolio-translation' );
					    break;
					    
					    case 'page':
					    default:
					    	$post_type_class = '<i class="fa fa-file-text-o"></i>';
					    	$post_type_title = esc_html__('Page', 'grandportfolio-translation' );
					    break;
					    
					    case 'projects':
					    	$post_type_class = '<i class="fa fa-folder-open-o"></i>';
					    	$post_type_title = esc_html__('Projects', 'grandportfolio-translation' );
					    break;
					    
					    case 'services':
					    	$post_type_class = '<i class="fa fa-star"></i>';
					    	$post_type_title = esc_html__('Service', 'grandportfolio-translation' );
					    break;
					    
					    case 'clients':
					    	$post_type_class = '<i class="fa fa-user"></i>';
					    	$post_type_title = esc_html__('Client', 'grandportfolio-translation' );
					    break;
					}
					
					$post_thumb = array();
					if(has_post_thumbnail($post->ID, 'thumbnail'))
					{
					    $image_id = get_post_thumbnail_id($post->ID);
					    $post_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
					    
					    if(isset($post_thumb[0]) && !empty($post_thumb[0]))
					    {
					        $post_type_class = '<div class="search_thumb"><img src="'.esc_url($post_thumb[0]).'" alt=""/></div>';
					    }
					}
				?>
				
				<?php
					if(!isset($post_thumb[0]))
					{
				?>
				<div class="post_type_icon">
				<?php
					}
				?>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($post_type_title); ?>" class="tooltip"><?php echo stripslashes($post_type_class); ?></a>
				<?php
					if(!isset($post_thumb[0]))
					{
				?>
				</div>
				<?php
					}
				?>
			    <div class="post_header search">
			    	<h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
			    	<div class="post_detail">
					    <?php echo get_the_time(THEMEDATEFORMAT); ?>
					    <?php
					    	//Get Post's Categories
					    	$post_categories = wp_get_post_categories($post->ID);
					    	if(!empty($post_categories))
					    	{
					    ?>
					    	<?php echo esc_html_e('In', 'grandportfolio-translation' ); ?>
					    <?php
					        	foreach($post_categories as $c)
					        	{
					        		$cat = get_category( $c );
					    ?>
					        	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
					    <?php
					        	}
					        }
					    ?>
					</div>
				    
				    <?php
				    	echo grandportfolio_substr(strip_tags(strip_shortcodes(get_the_content())), 200);
				    ?>
			    </div>
			</div>
	    </div>
	    
	</div>

</div>
<br class="clear"/>
<!-- End each blog post -->

<?php endwhile; endif; ?>

    	<?php
		    if($wp_query->max_num_pages > 1)
		    {
		    	if (function_exists("grandportfolio_pagination")) 
		    	{
		?>
				<br class="clear"/><br/>
		<?php
		    	    grandportfolio_pagination($wp_query->max_num_pages);
		    	}
		    	else
		    	{
		    	?>
		    	    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
		    	<?php
		    	}
		    ?>
		    <div class="pagination_detail">
		     	<?php
		     		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		     	?>
		     	<?php esc_html_e('Page', 'grandportfolio-translation' ); ?> <?php echo esc_html($paged); ?> <?php esc_html_e('of', 'grandportfolio-translation' ); ?> <?php echo esc_html($wp_query->max_num_pages); ?>
		     </div>
		     <?php
		     }
		?>
    	</div>
    	
    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar($page_sidebar); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    	</div>
    	
    </div>
    <!-- End main content -->
    </div>
	
</div>
</div>

<br class="clear"/><br/><br/>
<?php get_footer(); ?>