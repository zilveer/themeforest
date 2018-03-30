<?php
/* 
* rt-theme portfolio taxomony categories
*/
global $rt_sidebar_location, $rt_title, $rt_display_descriptions, $rt_display_titles;


$term = get_queried_object();
$rt_taxonomy  = $term->taxonomy;
$term_id =  $term->term_id;
$rt_title = $term->name;
$rt_display_descriptions = true;
$rt_display_titles = true;
$portfolio_item_width = get_option(RT_THEMESLUG."_portfolio_layout");
$portfolio_list_orderby =  get_option(RT_THEMESLUG.'_portf_list_orderby');
$portfolio_list_order =  get_option(RT_THEMESLUG.'_portf_list_order');
$portfolio_item_per_page =  get_option(RT_THEMESLUG.'_portf_pager');

get_header();	
?>

<section class="content_block_background">
	<section id="category-<?php echo $term_id; ?>" class="content_block clearfix">
		<section class="content <?php echo $rt_sidebar_location[0];?>">
		<div class="row">

			<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_portfolio_taxonomies', array( "called_for" => "inside_content" ) ) ); ?>

			<?php if($term->description):?>
			<!-- Category Description -->
				<div class="row margin-b30 clearfix"> 
					<?php echo apply_filters('the_content',($term->description));?> 
				</div> 
			<?php endif;?>		


			<?php if ( have_posts() ) :  

			$create_shortcode = sprintf( 
				'[portfolio_box id="%s" item_width="%s" pagination="%s" portf_list_orderby="%s" portf_list_order="%s" item_per_page="%s" categories="%s" display_titles = "%s" display_descriptions = "%s"]', 
				$term->slug, $portfolio_item_width, "on", $portfolio_list_orderby, $portfolio_list_order, $portfolio_item_per_page, $term_id, $rt_display_titles, $rt_display_descriptions
			);

			echo do_shortcode( $create_shortcode );

			else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
		</section><!-- / end section .content -->  
		<?php get_sidebar(); ?>

	</section><!-- / end section .content_block -->  
</section>
<?php get_footer(); ?>