<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */

get_header(); ?>
    <?php include ( TEMPLATEPATH . '/featured_slider.php' ); ?>
    <!--div#origami-messages start -->
    <?php include ( TEMPLATEPATH . '/featured_message.php' ); ?>
    <!--div#origami-messages end -->

    <?php include ( TEMPLATEPATH . '/featured_posts.php' ); ?>	

    <!--div#sticky-posts end -->
    <?php if(get_option("themeteam_origami_tabbed_area") == 'yes') {?>
    <div id="topstories" class="clearfix">
      <div class="container_12 clearfix">
        <div class="grid_12">
          <div class="tabs clearfix">
          <ul id="tabsNav">
          <?php
          	$cat_list = array();
          	$count = 1; 
          	$args = array('type'=> 'post', 'order' => 'ASC', 'hide_empty' => 1 );
          	$categories = get_categories( $args );
          	foreach($categories as $category) {
          		echo '<li><a href="#tabs-content-'.strtolower($category->term_id).'" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a></li>';
          		array_push($cat_list,"$category->term_id");
          	}
          ?>
          </ul>
          </div>
          <?php
          while (list($key,$value) = each($cat_list)) {
          ?>
          	<div class="tabs-content" id="tabs-content-<?php echo strtolower($value);?>">
            	<div>
              		<div>
                		<ul class="clearfix">
                		<?php
                			$myposts = get_posts('numberposts=4&category='.$value.'');
 							foreach($myposts as $post) :
   								setup_postdata($post);
   						?>

							<li>
	                      		<?php if (has_post_thumbnail()): ?>
	                      		<div class="thumbnail left"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb200'); ?><span><em> </em></span></a></div>
	                      		<?php endif ?>
	                        	<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	                        	<small><?php the_time('M j, Y');?></small>
	                    	</li>
	                    <?php endforeach;?>
                		</ul>
              		</div>
            	</div>
            	<!--<div class="prevBtn">&laquo; Previous</div>
            	<div class="nextBtn">Next &raquo;</div>-->
          	</div>
          
          <?php } ?>

        </div>
      </div>
    </div>
    <script>
    jQuery(document).ready(function() {
	    jQuery('.tabs-content:gt(0)').hide();
		jQuery('#tabsNav li:first').addClass('active');
		jQuery('#tabsNav li').bind('click', function() {
			jQuery('li.active').removeClass('active');
			jQuery(this).addClass('active');
			var target = jQuery('a', this).attr('href');
			jQuery('.tabs-content').hide();
			jQuery(target).show();
			return false;
		});
	});
    </script>
    <!-- div#topstories end -->
    <?php } ?>
    <!-- div#last-tweet end -->
<?php get_footer(); ?>
