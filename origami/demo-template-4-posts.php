<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
 /**
Template Name: Demo 4 Posts
*/
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?> <?php wp_title('&raquo;', true, 'right'); ?> </title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href="<?php bloginfo('template_url');?>/css/common.min.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_url');?>/js/nivoslider/nivo-slider.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if IE]>
    <link href="<?php bloginfo('template_url');?>/css/ie.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/html5.js"></script>
<![endif]-->

<link type="text/css" href="<?php bloginfo('template_url'); ?>/js/prettyphoto/css/prettyPhoto.css" rel="stylesheet" media="screen" />

<?php wp_head(); ?>

<?php echo themeteam_bg_options(get_option("themeteam_origami_custom_bg")); ?>

<?php if(get_option("themeteam_origami_enable_cufon") == 'yes') { ?>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/js/cufon_yui.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/<?php echo get_option("themeteam_origami_cufon_font"); ?>"></script>
<script type="text/javascript">
	Cufon.replace('h1,h2,h3,h4,h5,h6');
	Cufon.replace('#navigation a',{hover: true});
</script>

<?php } ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php themeteam_globals(); ?>


<!-- Toolbar only -->
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/toolbar/toolbar.js"></script>
<link href="<?php bloginfo('template_url');?>/js/toolbar/colorpicker.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php bloginfo('template_url');?>/js/toolbar/toolbar.css" rel="stylesheet" type="text/css" media="screen" />
<!-- toolbar end -->

</head>
<body <?php body_class(); ?>>
<div id="wrapper">
  <header id="header" class="clearfix">
    <div class="container_12">
      <div class="grid_3">
        <div id="logo">
        	<a href="<?php echo get_option('home'); ?>/" class="nocufon">
        		<?php if ( get_option('themeteam_logo_upload') ) {?>
      			<img src="<?php echo get_option('themeteam_logo_upload'); ?>" alt="<?php bloginfo('name'); ?>" />
	      		<?php } else { ?>
	      			<?php bloginfo('name'); ?>
	      		<?php }?>
        	</a>
        </div>
      </div>
      <nav class="prefix_3" id="navigation">
        <?php wp_nav_menu(array('menu' => 'Main Nav', 'theme_location' => 'main','walker' => new themeteamcustom_walker())); ?>
      </nav>
      <script type="text/javascript">
      jQuery.noConflict();
      jQuery(document).ready(function() {
             jQuery("#navigation div > ul > li > ul").parent().addClass("parent").end().prev("a").append("<strong></strong>");
             jQuery("#breadcrumbs li,#navigation div > ul > li").last().addClass("last");
             jQuery("#sidebar div.widget:has(div.thumbnail)").addClass("nopadding");
             jQuery(".flickr_badge_image").find("a").append("<span><em> </em></span>");
			 jQuery(".imgframe").each(function(){ var $_height = jQuery(this).find("img").height() - 20; jQuery(this).find(".empty").height($_height).end().find("span.frame").css("display","block"); })
	  });      
      </script>
    </div>
  </header>
  <div id="main-container">
  <?php
	// Split the featured pages from the options, and put in an array
	$featuredpages = get_option('themeteam_origami_featured_slider_ids');
	$featuredpages_array=split(",",$featuredpages); 
	$featuredpages_array = array_diff($featuredpages_array, array(""));
	
	$slider_type = get_option('themeteam_origami_featured_slider_type'); 
	?>
<div id="origami-slider" class="clearfix">
		<div class="container_12">
		<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/slider_v2.js"></script>
		<div id="normal-width-slider">
        	<ul>
            	<?php foreach ( $featuredpages_array as $featureditem ) { ; ?>
					<?php query_posts('page_id=' . $featureditem); ?>
				    <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; 
				    	$themeteam_custom_link = get_post_meta($post->ID, "themeteam_custom_link", true); 
				    	$themeteam_slider_text = get_post_meta($post->ID, "themeteam_slider_text", true); 
				    	$themeteam_header_text = get_post_meta($post->ID, "themeteam_header_text", true); 
				    	$themeteam_image_upload = get_post_meta($post->ID, "themeteam_image_upload", true); 
				    	$themeteam_video_embed = get_post_meta($post->ID, "themeteam_video_embed", true); 
				    	$themeteam_video_height = get_post_meta($post->ID, "themeteam_video_height", true); 
				    	$themeteam_video_width = get_post_meta($post->ID, "themeteam_video_width", true); 
				    	$video_width = $themeteam_video_width + 2;
				    	$video_height = $themeteam_video_height + 2;
				    ?>
		            	<li>
		              		<div class="grid_4 left">
		                		<h1>
		                			<?php if ( $themeteam_custom_link ) {?>
			      						<a href="<?php echo $themeteam_custom_link; ?>"><?php echo get_the_title(); ?></a>
			      					<?php } else { ?>
			      						<a href="<?php echo get_page_link($post->ID); ?>"><?php echo get_the_title(); ?></a>
			      					<?php }?>
		                		</h1>
		                		<p>
		                			<?php echo $themeteam_slider_text; ?> 
		                		</p>
		                		<p>
		                			<?php if ( $themeteam_custom_link ) {?>
			      						<a href="<?php echo $themeteam_custom_link; ?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>View More</span></span></a>
			      					<?php } else { ?>
			      						<a href="<?php echo get_page_link($post->ID); ?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>View More</span></span></a>
			      					<?php }?>
		                		</p>
		              		</div>
		              		<div class="grid_8">
		                		<div class="shadow">
		                			<?php if($themeteam_image_upload || $themeteam_image_upload = '') { ?>
		                        		<?php if ( $themeteam_custom_link ) {?>
			      							<a href="<?php echo $themeteam_custom_link; ?>"><?php echo themeteam_resize($themeteam_image_upload,'Slider Image','','620','400'); ?></a>
			      						<?php } else { ?>
			      							<a href="<?php echo get_page_link($post->ID); ?>"><?php echo themeteam_resize($themeteam_image_upload,'Slider Image','','620','400'); ?></a>
			      						<?php }?>
									<?php } else if ($themeteam_video_embed) { ?>
										<?php echo $themeteam_video_embed; ?>
									<?php } ?>
		                		</div>
		              		</div>
		            	</li>
            		<?php endwhile; endif; ?>
				<?php } ?>
            </ul>
		</div>
    </div>		
</div>
    <!--div#origami-messages start -->
    <?php include ( TEMPLATEPATH . '/featured_message.php' ); ?>
    <!--div#origami-messages end -->

    <div id="container" class="clearfix">
	<div class="container_12">
		<div class="clear"><!--clear fix--></div>
<?php		
		$my_query = new WP_Query(array('post__in'=>get_option('sticky_posts'), 'posts_per_page' => 4, 'caller_get_posts' => 1));
        if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>     
            <div class="grid_3 sticky">
              <?php if (has_post_thumbnail()): ?>
              <div class="imgframe clearfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb200'); ?><span class="frame"><span><span><span><span><span class="empty"><em> </em></span></span></span></span></span></span></a></div>
              <?php endif ?>
              <div class="clearfix">
                <h2><a href="<?php the_permalink();?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
                <?php the_excerpt();?>
                <p><a href="<?php the_permalink();?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>READ MORE</span></span></a></p>
              </div>
            </div>
         <?php endwhile; endif;?>
	<div class="clear"><!--clear fix--></div>
	</div>
</div>

    <!--div#sticky-posts end -->
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
<?php get_footer(); ?>