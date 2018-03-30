<?php get_header(); ?>
    <div class="inner">
                <div class="category-title">
                        <div class="mom_breadcrumb"><?php woocommerce_breadcrumb(); ?></div>
                </div>
	<div class="main_container fullwidth">
        <div class="base-box page-wrap">
           <h1 class="page-title"><?php the_title(); ?></h1>
			<?php woocommerce_content(); ?>
        </div> <!-- base box -->
            <div class="clear"></div>
</div> <!--main container-->            
</div> <!--main inner-->
            
<?php get_footer(); ?>