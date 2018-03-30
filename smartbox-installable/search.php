<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */

 	get_header();
 	
 	
 	?>
 	<div class="fullwidth-container" style="
	    	
	    	<?php 
		    	global $smartbox_custom, $smartbox_styleColor;	    		
	    		$type = des_get_value(DESIGNARE_SHORTNAME."_header_type");
	    		if (empty($type)) $type = des_get_value(DESIGNARE_SHORTNAME."_header_type option:selected");
				$color = des_get_value(DESIGNARE_SHORTNAME."_header_color"); 
				$image = des_get_value(DESIGNARE_SHORTNAME."_header_image"); 
				$pattern = DESIGNARE_PATTERNS_URL.des_get_value(DESIGNARE_SHORTNAME."_header_pattern"); 
				$height = des_get_value(DESIGNARE_SHORTNAME."_header_height"); 
				$margintop = des_get_value(DESIGNARE_SHORTNAME."_header_text_margin_top");	
				$banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider");
				if (empty($banner)) $banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider option:selected");
		 		if ($height != "") echo "height: ". $height . ";";
				if($type == "none") echo "background: none;"; 
				if($type == "color") echo "background: #" . $color . ";";
				if($type == "image") echo "background: url(" . $image . ") no-repeat; background-size: 100% auto;";  
	 			if($type == "pattern") echo "background: url('" . $pattern . "') 0 0 repeat;";
	 			if($type == "border") echo "background: white;";
	    	?>">
			
			<?php
		    	if ($type === "banner"){
			    	?>
			    	<div class="revBanner"> <?php putRevSlider(substr($banner, 10)); ?> </div>
			    	<?php
		    	} else {
	    	?>
				<div class="container">
					
					<div class="pageTitle sixteen columns" <?php if ($margintop != "") echo " style='margin-bottom: ".$margintop.";margin-top: ".$margintop.";'"; ?>>
		    			<h3 class="page_title" style="<?php 
			    			$tcolor = des_get_value(DESIGNARE_SHORTNAME.'_header_text_color');
							$tsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_header_text_size'));			
							echo "color: #$tcolor; font-size: $tsize;";		    	?>"></h3>
		    			<?php
				    	if (get_option(DESIGNARE_SHORTNAME."_search_secondary_title") != ""){	?>
					    <h3 class="secondaryTitle" style="<?php
				    		$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";
			    		?>" ><?php echo get_option(DESIGNARE_SHORTNAME."_search_secondary_title"); ?></h3>
			    		<?php
			    		}	
		    		?>
		    					    	
			    	</div>
				
				</div>
			</div>
		<?php } ?>
		
	<div id="white_content">
	
		<div id="wrapper">
		
			<div class="container">
				<?php
					if ($type == "border"){
						?>
						<div class="borderline"></div>
						<?php
					}
				?>

			
			<?php
				$sidebar = get_option(DESIGNARE_SHORTNAME."_search_archive_sidebar");
				$postconfig = " sixteen columns";
		    	$postlistingstyle = "";
		    	
		    	if ($sidebar == "left" || $sidebar == "right") {
		    		$postconfig = " twelve columns";
		    		$postlistingstyle = 'style="border-right: 1px solid #ededed;"';
		    	}
		    	if ($sidebar == "left") {
			    	//get_sidebar();	
			    	$postlistingstyle = 'style="border-left: 1px solid #ededed;"';
			    	
		    	}
				if ($sidebar == "left"){
					?>
						<div class="four columns">
							<?php get_sidebar(); ?>
						</div>
			    	<?php
				}

	global $smartbox_reading_option; $smartbox_reading_option = get_option('smartbox_blog_reading_type');
	global $smartbox_more;
		$smartbox_more = 0;

	$orderby="";
	$category="";
	$nposts = "";

	$pag = 1;
	
	if (isset($_GET['paged'])) $pag = $_GET['paged'];
	else {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$pagina = explode('/page/', $pageURL);
		if(isset($pagina[1])) $pagina = explode ('/', $pagina[1]);
		if ($pagina[0]) $pag = $pagina[0];	
	}
	if (!is_numeric($pag)) $pag = 1;
?>


	<?php 
	
		$se = get_option(DESIGNARE_SHORTNAME."_search_everything");

		if ($se == "on"){
			$args = array(
				'showposts' => get_option('posts_per_page'),
				'post_status' => 'publish',
				'paged' => $pag,
				's' => esc_html($_GET['s'])
			);
				
			//global $post, $wp_query;
		    
		    $the_query = new WP_Query( $args );
		    
		    $args2 = array(
				'showposts' => -1,
				'post_status' => 'publish',
				'paged' => $pag,
				's' => esc_html($_GET['s'])
			);
			
			$counter = new WP_Query($args2);
			
		} else {
			$args = array(
				'showposts' => get_option('posts_per_page'),
				'post_status' => 'publish',
				'paged' => $pag,
				'post_type' => 'post',
				's' => esc_html($_GET['s'])
			);
				
			//global $post, $wp_query;
		    
		    $the_query = new WP_Query( $args );
		    
		    $args2 = array(
				'showposts' => -1,
				'post_status' => 'publish',
				'paged' => $pag,
				'post_type' => 'post',
				's' => esc_html($_GET['s'])
			);
			
			$counter = new WP_Query($args2);
		}
	
	    
	    
	    ?>
	    	
	    <div id="primary" class="blogarchive <?php echo $postconfig;  ?>">
			<div id="content">
			
			
	    	
	   	<?php
		
		if ($the_query->have_posts()){
		
		?> 
		
		<div class="post-listing" <?php echo $postlistingstyle; ?>>
			<div class="pageTitle">
			    
				<h2 class="hsearchtitle"><?php echo $counter->post_count . " " . __(get_option(DESIGNARE_SHORTNAME.'_search_results_text'), "smartbox") . " " . $_GET['s'];  ?></h2>
			</div>
					    	
	    	<?php 
	    	
	    		$columns = "eleven columns";
		    	if ($postconfig === " sixteen columns") $columns = "fifteen columns";
		    
			    while ( $the_query->have_posts() ) : 
						
			    	$the_query->the_post();	 ?>
			    	
			    		<?php
				    		global $smartbox_more;
				    		$smartbox_more = 0;
			    		?>
				    	
				    	<article id="post-<?php the_ID(); ?>" class="post">
					    	
					    	<?php
					    	
					    	$posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
					    	if ($sidebar != "none"){
						    	$columns = "";
						    	if ($posttype == "text" || $posttype == "audio") $columns = "eleven columns";
						    	else $columns = "six columns";	
					    	} else {
						    	if ($posttype == "text" || $posttype == "audio") $columns = "sixteen columns";
						    	else $columns = "eleven columns";
					    	}
					    	
					    	$postid = get_the_ID(); ?>
					    	
					    	<h2 class="h-title-search"><a style="color: <?php echo $smartbox_styleColor; ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					    	
					    	
					    	
							<div class="search entry_excerpt">
								<?php
									$content = get_the_content($postid);
									$pos=strpos($content, '<!--more-->');
									if ($pos){
										$text = explode('<!--more-->', $content);
										$text = $text[0];
										echo $text." ".$more_tag;
									} else {			
								        $text = apply_filters('the_content', $content);
								        $text = str_replace(']]>', '&nbsp;]]&gt;&nbsp;', $text);
								        $excerpt_length = apply_filters('excerpt_length', 55);
								        $more_tag = '<a href="'.get_permalink($postid).'">'.__(get_option(DESIGNARE_SHORTNAME."_read_more"), "smartbox").'</a>';
								        $excerpt_more = apply_filters('excerpt_more', ' ' . $more_tag);
								        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
										echo apply_filters('wp_trim_excerpt', $text);
									}
								?>
							</div>
							
							<div class="search-div"><?php get_template_part( 'meta' ); ?><div class="search readmore" style="right: 25px;top: -35px;"><a href="<?php the_permalink() ?>"><?php _e("Read More &rArr;", "smartbox"); ?></a></div></div>
							
							<br/>
				    									    
					    </article> <!-- end of post -->
				    
				    <div class="search post-separator eleven columns"></div>
				    	
			    	<?php endwhile; ?>
			    		
	    	</div> <!-- end of post-listing -->
					
			<div class="navigation">
				<?php
					global $smartbox_reading_option;
					if ($smartbox_reading_option != "paged" && $smartbox_reading_option != "dropdown"){ ?>
						<div class="next-posts"><?php next_posts_link('&laquo; ' . __(get_option(DESIGNARE_SHORTNAME."_previous_text"), "smartbox"), $the_query->max_num_pages);  ?></div>
						<div class="prev-posts"><?php  previous_posts_link(__(get_option(DESIGNARE_SHORTNAME."_next_text"), "smartbox") . ' &raquo;', $the_query->max_num_pages); ?></div>
					<?php
					} else {
						wp_pagenavi();
					}
				?>
				
			</div>

									
		<?php  }  else { ?>
	
		<div class="post-listing eleven columns">
			<div class="pageTitle">
				<h2 class="hsearchtitle"><?php echo __(get_option(DESIGNARE_SHORTNAME.'_no_results_text'), "smartbox");  ?></h2>
				<p class="titleSep"></p>
			</div>
		</div>
		
		
	<?php } ?>
	
		<?php if ($sidebar != "left") {
				?>
					</div>
				<?php
			} ?>
	    
			

			</div><!-- #primary -->

<?php if ($sidebar == "right") {
	?>
		<div class="four columns sright" style="margin-left:2.5%;">	
	<?php
	get_sidebar(); 
	?>
		</div>
	<?php
} if ($sidebar == "left") {
	?>
		</div>
	<?php
} ?>

</div>

	<div class="clear"></div>
	
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('h3.page_title').html($('.pageTitle > h2').html());
	});
</script>


<?php get_footer(); ?>