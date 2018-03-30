<div id="sidebar">
	<div id="sidebar-top-div"></div>
	<div id="sidebar-content">
    <div id="sidebar-top">
	<?php if (class_exists('woocommerce')) {  ?>
		<?php 
		$shop_page = get_post( woocommerce_get_page_id('shop') );
		$shop_page_title = apply_filters('the_title', (get_option('woocommerce_shop_page_title')) ? get_option('woocommerce_shop_page_title') : $shop_page->post_title);

		if(is_shop()) { ?>  
   			<h1 class="title-page"><?php echo $shop_page_title; ?></h1>  
		<?php } else { 
	
			if(is_tax()) {
				global $wp_query; 
				$term = get_term_by( 'slug', get_query_var($wp_query->query_vars['taxonomy']), $wp_query->query_vars['taxonomy']); ?>
				<h1 class="title-page"><?php echo wptexturize($term->name); ?></h1>
				<?php woocommerce_taxonomy_archive_description(); ?>   
			<?php } ?>
		<?php } ?>
	<?php } ?> 
    </div> <!--  end #sidebar-top  -->

<!--    Start Dynamic Sidebar    -->
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
<?php endif; ?>

    <div class="clear"></div>
    <div id="sidebar-bottom">
    </div> <!--  end #sidebar-bottom  -->
	</div> <!--  end #sidebar-content  -->
<div id="sidebar-bottom-div"></div> 
</div> <!--  end #sidebar  --> 