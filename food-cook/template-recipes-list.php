<?php 
/*
* Template Name: Recipes List Template 
*/ 
get_header();
global $woo_options;

?>
       
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    	
    	<div id="main-sidebar-container">    
            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main" class="col-left">                     

             	<?php 
	             	if ( $woo_options['woo_slider_recipe'] == 'true') { 
	             		 dahz_get_template( 'sliders', 'slider' );  
	             	} 
	             	wp_reset_query(); 
             	?>
			    <div class="orderby">
	            	<form class="recipe-ordering" method="post" id="order">
						<button type="submit" name="asc"  title="Ascending"><i class="fa fa-angle-double-up"></i></button>
						<button type="submit" name="desc" value="desc" title="Descending"><i class="fa fa-angle-double-down" ></i></button>

						<select name="select">
							<option value="Select Option"><?php _e( 'Sort by', 'woothemes' );  ?></option>
							<option value="date"><?php _e( 'Date', 'woothemes' );  ?></option>
							<option value="name"><?php _e( 'Name', 'woothemes' );  ?></option>
							<option value="comment_count"><?php _e( 'Popular', 'woothemes' );  ?></option>
						</select>
					
					</form>
				</div>

				<div class="recipe-title">
					<h1 class="title"><?php the_title(); ?> </h1> 
            	</div>
            	
				<?php dahz_get_template('loop', 'loop-recipelist'); ?>
		 
				<div class="fix"></div>		       
	    
            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

		<?php dahz_get_sidebar( 'secondary' ); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>

<?php get_footer(); ?>