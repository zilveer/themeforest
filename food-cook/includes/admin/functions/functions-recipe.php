<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*-----------------------------------------------------------------------------------*/
// Rating
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_rate_this', 'woo_fnc_rate_this');
add_action('wp_ajax_nopriv_rate_this', 'woo_fnc_rate_this');

function woo_fnc_rate_this(){

        if(isset($_POST['selected_rating'])){

                $ip = $_SERVER['REMOTE_ADDR'];
                $post_id = intval($_POST['post_id']);
                $selected_rating = floatval($_POST['selected_rating']);

                $meta_IP = get_post_meta($post_id, "voted_IP");
                $voted_IP = $meta_IP;

                if(!is_array($voted_IP))
                        $voted_IP = array();

                if(!in_array($ip, $voted_IP)){

                    $rating_count = get_post_meta($post_id, "rating_counter", true);
                    if(empty($rating_count)) { $rating_count = 0; }

                    $rating_array_holder = get_post_meta($post_id, "rating_array");

                    if(!empty($rating_array_holder) && is_array($rating_array_holder[0]))
                    {
                            $rating_array = $rating_array_holder[0];
                            $rating_array[] = $selected_rating;
                    }
                    else
                    {
                            $rating_array = array($selected_rating);
                    }

                    if(update_post_meta($post_id,"rating_array", $rating_array ) )
                    {
                            $voted_IP[] = $ip;
                            $rating_count++;
                            update_post_meta($post_id,'voted_IP', $voted_IP);
                            update_post_meta($post_id,'rating_counter', $rating_count);

                            _e('Thank you for rating!', 'dahztheme');
                    }
                    else
                    {
                            _e('Failed', 'dahztheme');
                    }
                 }
                 else
                 {
                        _e('Already Voted!', 'dahztheme');
                 }
        }
        else
        {
                _e('No Rating Found!', 'dahztheme');
        }
        die;
}

/*-----------------------------------------------------------------------------------*/
// Already Voted Or Not
/*-----------------------------------------------------------------------------------*/
function woo_fnc_already_voted($post_id){

    $ip = $_SERVER['REMOTE_ADDR'];
    $meta_IP = get_post_meta(intval($post_id), "voted_IP");

    if(!empty($meta_IP) && is_array($meta_IP[0]))
    {
            $voted_IP = $meta_IP[0];
            return in_array($ip, $voted_IP);
    }

    return false;
}

/*-----------------------------------------------------------------------------------*/
// Get Vote Count
/*-----------------------------------------------------------------------------------*/
function woo_fnc_get_vote_count($post_id){

    $meta_IP = get_post_meta( intval( $post_id ), "voted_IP" );

    if( !empty( $meta_IP ) && is_array( $meta_IP[0] ) ) :
        $voted_IP = $meta_IP[0];
        return count( $voted_IP );
    endif;

    return 0;
}
/*-----------------------------------------------------------------------------------*/
// Get Average Rating
/*-----------------------------------------------------------------------------------*/
function woo_fnc_get_avg_rating($post_id){

    $rating_array_holder = get_post_meta(intval($post_id), "rating_array");
    if(!empty($rating_array_holder) && is_array($rating_array_holder[0]))
    {
            $rating_array = $rating_array_holder[0];
            $rating_length = count($rating_array);
            $rate_total = array_sum($rating_array);
            return round($rate_total/$rating_length,1);
    }

    return 0;
}
/*-----------------------------------------------------------------------------------*/
// Get People Rating Value
/*-----------------------------------------------------------------------------------*/
function woo_fnc_get_cont_rating($post_id){

	$rating_count = get_post_meta($post_id, "rating_counter", true);
	if ( !empty($rating_count) ) {
		$rating_count_total = $rating_count;
		return $rating_count_total;
	}

	return 0;

}

/*-----------------------------------------------------------------------------------*/
// Rating Call Function
/*-----------------------------------------------------------------------------------*/
function woo_fnc_the_recipe_rating($post_id){

    $rate_avg = woo_fnc_get_avg_rating($post_id);
    $rt = 10.0;
    $rv = 5.0;
    echo '<fieldset class="df-rating-avg">';
    while($rt >= 1){
        $rv = $rv - 0.5;
        if ($rv < woo_fnc_get_avg_rating($post_id) ) {
            $checked = 'checked';
        }
        else {
            $checked = ' ';
        }
        if ($rt % 2 == 0) {
            echo '<input type="radio" '.$checked.' readonly/><label class="full '.$rt.'"></label>';
        }else{
            echo '<input type="radio" '.$checked.' readonly/><label class="half '.$rt.'"></label>';
        }
            $rt--;
    }
    echo '</fieldset>';
}
/*-----------------------------------------------------------------------------------*/
/* Rating Single Recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_rating' ) ) :
function df_rating() {
	global $post;
?>
	<div class="rate-box">
		<div class="rate-title"><p><?php _e('Rate this recipe', 'woothemes'); ?></p></div>

			<?php 
			// get_the_image( array(
			// 	'order'   		=> array( 'featured', 'default' ),
			// 	'featured'  	=> true,
			// 	'default' 		=> esc_url( get_template_directory_uri() . '/includes/assets/images/image.jpg' ),
			// 	'size'			=> 'recent-thumb',
			// 	'link_to_post'  => false,
			// 	'before'        => '<div class="rate-img">',
			// 	'after'         => '</div>'
			// ) ); 
			if ( has_post_thumbnail() ) {
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'recent-thumb' );
				echo '<div class="rate-img">';
				echo '<img src="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '">';
				echo '</div>';
			} else {
				$attachment_url = get_template_directory_uri() . '/includes/assets/images/image.jpg';
				echo '<div class="rate-img">';
				echo '<img src="' . $attachment_url . '" title="' . the_title_attribute( 'echo=0' ) . '">';
				echo '</div>';
			}
			?>

			<ul class="rate-left">

				<?php if( !woo_fnc_already_voted( $post->ID ) ) : ?>

					<li>
						<form action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" method="post" id="rate-product">
                            <fieldset class="df-rating-star">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="0.5 stars"></label>
                                        <input type="hidden" name="selected_rating" id="selected_rating" value="" />
                                        <input type="hidden" name="post_id" value="<?php echo $post->ID ?>" />
                                        <input type="hidden" name="action" value="rate_this" />
                            </fieldset>
                        </form>
                    </li>

				<?php else : ?>

					<li><p><?php esc_html_e('You have already Rated.', 'woothemes'); ?></p></li>

				<?php endif; ?>

				<p id="output"></p>

				<li>
					<p class="status">
						<span><?php echo woo_fnc_get_cont_rating($post->ID); ?> <?php _e( 'People', 'woothemes'); ?> </span>
						<?php _e('Rated This Recipe', 'woothemes'); ?>
					</p>
				</li>
			</ul>

			<ul class="rate-right">
				<li>
					<p><?php _e('Average Rating', 'woothemes'); ?></p>
				</li>
				<li>
					<p class="ex-rates">
						<?php woo_fnc_the_recipe_rating(get_the_id()); ?>

					</p>
				</li>
				<li>
					(<?php echo woo_fnc_get_avg_rating(get_the_id()); ?> / 5)
						<meta content="<?php echo woo_fnc_get_avg_rating(get_the_id()); ?>" />
			    		<meta content="5" />
						<meta content="<?php echo woo_fnc_get_vote_count(get_the_id()); ?>" />
				</li>
			</ul>
	</div><!-- end of rate-box div -->
	<div class="clear"></div>
<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Rating Info Single Recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_rating_info' ) ) :
function df_rating_info() {

	global $woo_options;

	if ( $woo_options['woo_rating_recipe'] == 'true') {

		global $current_user;
		wp_get_current_user();

		$vote_count = woo_fnc_get_cont_rating(get_the_id()); 
	?>
		<div class="rating-single review-score">

			<p><?php _e('Recipe Rating', 'woothemes'); ?></p>

			<ul class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				<li ><?php  woo_fnc_the_recipe_rating(get_the_id()); ?>	</li>
				<li><span class="average">(<?php echo  woo_fnc_get_avg_rating(get_the_id()); ?> <?php _e('/', 'woothemes'); ?></span><span class="best"><?php echo '5'; ?></span>)</li>
				<meta itemprop="ratingValue" class="average" content="<?php echo  woo_fnc_get_avg_rating(get_the_id()); ?>" />
				<li itemprop="reviewCount" class="count">
				<?php 
					echo  $vote_count;
					$text_rating = $vote_count == 1 ? ' rating' : ' ratings';
				 	_e($text_rating , 'woothemes'); 
				 ?>
				 </li>
<!-- 		       	<meta itemprop="bestRating" class="best" content="5" />
		 		<meta itemprop="worstRating" content="1" /> -->
				<meta content="<?php echo  woo_fnc_get_vote_count(get_the_id()); ?>" />
			</ul>
			<div class="fix"></div>
		</div>

	<?php } ?>

	<p>
		<?php echo get_the_term_list( get_the_id(), 'calories', __('<em class="fa fa-bookmark"></em> ', 'woothemes'), ', ', ''); ?>
	</p>
<?php
}
endif;
/*-----------------------------------------------------------------------------------*/
/*	Convert number of Minutes to Hours 												 */
/*-----------------------------------------------------------------------------------*/
function woo_fnc_convert_to_hours($time){
	$time = intval($time);
	return $time;
}

/*-----------------------------------------------------------------------------------*/
/* Related Single Recipe 															 */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_related_recipe' ) ) :
function df_related_recipe() {
	global $post, $woo_options;

	wp_reset_query();

	if ( isset( $woo_options[ 'woo_rel_recipe' ] ) && $woo_options[ 'woo_rel_recipe' ] == 'true' ) :

		$num_rel 	= $woo_options[ 'woo_recipe_number_related' ];
		$term_list 	= wp_get_post_terms( $post->ID, 'recipe_type', array( 'fields' => 'slugs' ) );
		$args 		= array(
					    'posts_per_page' 	=> $num_rel,
					    'post_type' 		=> 'recipe',
					    'post_status' 		=> 'publish',
					    'post__not_in' 		=> array( $post->ID ),
					    'tax_query'			=> array(
					    							array(
					    								'taxonomy' 	=> 'recipe_type',
											            'field' 	=> 'slug',
											            'terms' 	=> $term_list
					    							)
					  ) );

		$my_query = new wp_query( $args );

		if( $my_query->have_posts() ) :
			echo '<h2 class="rel-title">' . __('Related Recipes' , 'woothemes' ) . '</h2>';

			echo '<div class="related-recipe">';
				while( $my_query->have_posts() ) : $my_query->the_post();
					dahz_get_template( 'content', 'content-recipe' );
				endwhile;
		 	echo '</div>';
		endif;

		wp_reset_query();
	endif;
}
endif;
/*-----------------------------------------------------------------------------------*/
/* Cook name single recicpe 														 */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_cook_info_recipe' ) ) :
function df_cook_info_recipe() {

	global $woo_options;

	if ( $woo_options['woo_about_single'] == 'true') {

		global $post;
		$author_id = $post->post_author;

		$twitter_author_link  = get_the_author_meta( 'twitter' );
		$facebook_author_link = get_the_author_meta( 'facebook' );
		$google_author_link   = get_the_author_meta( 'google' );
		$pin_author_link 	  = get_the_author_meta( 'pin' );
		$linkdn_author_link   = get_the_author_meta( 'linkdn' );
		$website 			  = get_the_author_meta( 'url');
		?>

		<div class="cookname content-full">

			<h3> <?php _e('About Chef', 'woothemes');?></h3>

			<div id="author-profile" >
				<div class="auth-img">
					<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
						<?php echo get_avatar( $author_id, '80' ); ?>
					</a>
				</div>

				<div class="auth-des" itemprop="author" itemscope itemtype="http://schema.org/Person">

					<h4 itemprop="name">
						<?php echo get_the_author_meta( 'display_name', $author_id ); /* the_author_posts_link();*/ ?>
					</h4>

					<p itemprop="description" >
						<?php echo woo_fnc_word_trim(get_the_author_meta( 'description' ),30,' ...'); ?>
					</p>

					<a itemprop="url" class="url" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
						<?php _e('Read more about this chef..', 'woothemes');?>
					</a>

					<div class="auth">
						<?php
							if(!empty($website)){
								printf('<a class="fa fa-globe" href="%s" target="_blank"></a>', $website);
							}

							if(!empty($twitter_author_link)){
								printf('<a class="fa fa-twitter" href="%s" target="_blank"></a>', $twitter_author_link);
							}

							if(!empty($facebook_author_link)){
								printf('<a class="fa fa-facebook" href="%s" target="_blank"></a>', $facebook_author_link);
							}

							if(!empty($linkdn_author_link)){
								printf('<a class="fa fa-linkedin" rel="me" href="%s" target="_blank"></a>', $linkdn_author_link);
							}

							if(!empty($pin_author_link)){
								printf('<a class="fa fa-pinterest" rel="me" href="%s" target="_blank"></a>', $pin_author_link);
							}

							if(!empty($google_author_link)){
								printf('<a class="fa fa-google-plus" rel="me" href="%s" target="_blank"></a>', $google_author_link);
							}
						?>
					</div><!-- .auth -->
				</div> <!-- .auth-des -->
			</div> <!-- .author-profile -->
		</div><!-- .cookname -->
	<?php
	}
}
endif;
/*-----------------------------------------------------------------------------------*/
/* Share below content single recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_below_content_social_recipe' ) ) :
function df_below_content_social_recipe() {

	global $woo_options;

	if ( $woo_options['woo_social_single'] == 'true') {
		$df_options = get_theme_mod( 'df_options' );
	 	$site = get_permalink();
		$temp = 'mailto:?subject=I wanted you to see this recipe&amp;body=Check out this recipe ' .$site;
		$twit = $df_options['connect_twitter'];
		$face = $df_options['connect_facebook'];
		$goo = $df_options['connect_googleplus'];
		$pin = $df_options['connect_pinterest'];
		$lkdn = $df_options['connect_linkedin'];
		$flik = $df_options['connect_flickr'];
		$ytube = $df_options['connect_youtube'];

		?>
		<div class="recipe-share content-full">
			<h3><?php _e('Be Social','woothemes'); ?></h3>
			<div class="share-top">
				<ul>
					<?php
						if (!empty($twit)) {
							printf("<li><a class='twit' title='Twitter' href='%s' target='_blank'><i class='fa fa-twitter'></i></a></li>", $twit);
						}
						if (!empty($face)) {
							printf("<li><a class='face' title='Facebook' href='%s'  target='_blank'><i class='fa fa-facebook'></i></a></li>", $face);
						}
						if (!empty($goo)) {
							printf("<li><a class='goo' title='Google plus' href='%s' target='_blank'><i class='fa fa-google-plus'></i></a></li>", $goo);
						}
						if (!empty($pin)) {
							printf("<li><a class='pin' title='Pinterest' href='%s' target='_blank'><i class='fa fa-pinterest'></i></a></li>", $pin);
						}
						if (!empty($lkdn)) {
							printf("<li><a class='lkdn' title='linkedin' href='%s' target='_blank'><i class='fa fa-linkedin'></i> </a></li>", $lkdn);
						}
						if (!empty($flik)) {
							printf("<li><a class='flik' title='filckr' href='%s' target='_blank'><i class='fa fa-flickr'></i> </a></li>", $flik);
						}
						if (!empty($ytube)) {
							printf("<li><a class='ytube' title='youtube' href='%s' target='_blank'><i class='fa fa-youtube'></i> </a></li>", $ytube);
						}

						 $burn = get_option('woo_connect_newsletter_id');
						 $chimp = get_option('woo_connect_mailchimp_list_url');

						if (isset($burn) && !empty($burn) ){
							printf("<a class='rss' href='http://feedburner.google.com/%s' target='_blank'></a>", $burn);
						}
						elseif (isset($chimp) && !empty($chimp)) {
							printf("<a class='rss' href='http://mailchimp.com/%s' target='_blank'></a>", $chimp);
						}
					?>
				</ul>
			</div>
		</div>
	<?php }
}
endif;
/*-----------------------------------------------------------------------------------*/
/* Extra Single Recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_extra_share_recipe' ) ) :
function df_extra_share_recipe() {
	global $woo_options;
	?>
	<div class="content-full info-extra">
		<?php
		if ( $woo_options['woo_share_single'] == 'true'   ) {

			$pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full'); ?>

			<ul class="share-top">
				<li>
					<a href="http://www.facebook.com/sharer/sharer.php?u=<?php esc_url(the_permalink()); ?>" target="_blank"><i class="fa-facebook fa"></i></a>
				</li>
				<li>
					<a href="http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));?>&amp;url=<?php the_permalink(get_the_id()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				</li>
				<li>
					<a href="https://plus.google.com/share?url=<?php the_permalink(get_the_id()); ?>" target="_blank"><i class="fa-google-plus fa"></i></a>
				</li>
				<li>
					<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink(get_the_id())); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title(); ?>" target="_blank"><i class="fa fa-pinterest "></i></a>
				</li>
				<li>
					<a href="mailto:?subject=<?php the_permalink(get_the_id()); ?>" target="_top"><i class="fa-envelope-o  fa"></i></a>
				</li>
			</ul>

		<?php } ?>

		<ul class="extra">
			<?php

			$site = get_permalink();

			$temp = 'mailto:?subject=I wanted you to see this recipe&amp;body=Check out this recipe ' .$site;

			echo "<li><a href='$temp' title='Share by Email'><em class='fa fa-envelope'></em> Email</a></li>";

			?>

			<li>
				<a id="bookmarkme"  href="#" rel="sidebar" title="bookmark this page"><em class="fa fa-heart"></em><?php _e(' Save','woothemes');?> </a>
			</li>

			<li>
			<?php
				if(function_exists('pf_show_link')){
				echo pf_show_link();}
				else {
				echo "<a href='javascript:window.print()' title='Print'><em class='fa fa-print'></em>  ".__('Print','woothemes')." </a>";
				}
			?>
			</li>
		</ul>
	</div>
<?php
}
endif;
/*-----------------------------------------------------------------------------------*/
/* Nutritional Info Single Recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_nutrition_recipe' ) ) :
function df_nutrition_recipe() {
	$nut_names = get_post_meta(get_the_id(), 'RECIPE_META_nut_name');
	$nut_number = 0;

	if(is_array($nut_names)){
		$nut_number = count($nut_names[0]);
	}

	if($nut_number >= 1){

		$nut_vals = get_post_meta(get_the_id(), 'RECIPE_META_nut_mass');

		$i = 0;

		?>
		<div class="content-right-first print-only">
			<div class="nutritional">
				<h3><?php _e('Nutrition Info', 'woothemes'); ?></h3>
				<ul>
					<?php
						while($i < $nut_number){
							?>
								<li class="nutrition">
									<p>
										<span class="big-nut"> <?php echo $nut_vals[0][$i] ?> </span>
										<?php echo $nut_names[0][$i] ?>
									</p>
								</li>
							<?php
							$i++;
						}
					?>
				</ul>
			</div>
		</div>
		<?php
	}
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Post Meta Single Recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_postmeta_recipe' ) ) :
function df_postmeta_recipe() {
	global $post;
	$cuisine = get_the_terms( get_the_id(), 'cuisine' );
	$output_cat_recipe = '';

	if ( $cuisine && ! is_wp_error( $cuisine ) )  {
		$output_cat_recipe = get_the_term_list( get_the_id(), 'cuisine', __('<span class="small">In </span>', 'woothemes'), ', ', '').' | ';
	}
?>

	<div class="post-meta ">
		<span class="small date updated"><?php _e( 'Published on ', 'woothemes' ); ?></span>
		<?php echo do_shortcode( '[post_date after=" |"]' ); ?>
		<?php echo $output_cat_recipe; ?>
		<span class="small"><?php _e( 'By', 'woothemes' );  ?></span>
		<?php echo do_shortcode( '[post_author_posts_link after=" | "] [post_comments] [post_edit]' ); ?>
	</div>

<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Taxonomies Info Single Recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_taxonomies_info' ) ) :
function df_taxonomies_info() {
?>
	<ul class="recipe-info-single-big content-full print-only" >
	 <?php

		$yield = get_post_meta(get_the_id(), 'RECIPE_META_yield', true);
		$prep_time =  woo_fnc_convert_to_hours(get_post_meta(get_the_id(), 'RECIPE_META_prep_time', true));
		$cook_time =  woo_fnc_convert_to_hours(get_post_meta(get_the_id(), 'RECIPE_META_cook_time', true));
		$skill_level = get_the_terms( get_the_id(), 'skill_level' );

		if(!empty($prep_time) ){
			?>
			<li class="prep-time" >
				<em class="fa fa-refresh"></em>
				<ul>
					<li><i> <?php _e('Prep Time', 'woothemes'); ?> </i></li>
		            <?php   $pt = 'PT'.$prep_time.'M'; ?>
					<li class="value-title">
						<time datetime="<?php echo $pt; ?>" itemprop="prepTime" class="value-title"><?php echo $prep_time; ?></time>
						<?php _e('Minutes', 'woothemes'); ?>
					</li>
				</ul>
			</li>
			<?php
		}

		if(!empty($cook_time)){
			?>
			<li class="cook-time"  >
				<em class=" fa fa-clock-o"></em>
				<ul>
					<li><i><?php _e('Cook Time', 'woothemes'); ?></i></li>
					<?php $ct = 'PT'.$cook_time.'M'; ?>
					<li>
						<time datetime="<?php echo $ct; ?>"  itemprop="cookTime" class="value-title">
						<?php echo $cook_time; ?></time>  <?php _e('Minutes', 'woothemes'); ?>
					</li>
				</ul>
			</li>
			<?php
		}

		if(!empty($yield)){
			?>
			<li class="yield" >
				<em class="fa fa-cutlery"></em>
				<ul>
					<li> <i><?php _e('Yield', 'woothemes'); ?> </i>  </li>
					<li itemprop="recipeYield" class="yield"><?php echo $yield; ?></li>
				</ul>
			</li>
			<?php
		}

		if ( $skill_level && ! is_wp_error( $skill_level ) )  {

			echo "<li><ul class='skill_level'><em class='fa fa-bullseye'></em><li>";
			echo get_the_term_list( get_the_id(), 'skill_level', __(' <li><i>  Difficulty Level  </i></li> ', 'woothemes'), ', ', '');
			echo "</li></ul></li>";
		}
	?>
	</ul>
<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Tabs Single Recipe */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'df_recipe_tabs' ) ) :
function df_recipe_tabs() {
	global $woo_options;
?>
	<div id="recipe-tabs" class="recipe-tabMenu content-full">

		<ul class="recipe-menu-tab content-full">

			<li><a href="#recipe-tabs-1" class="menuLink active" ><?php _e('Recipe', 'woothemes'); ?></a></li>
			<li class="recipe_how_to"><a href="#recipe-tabs-2" class="menuLink"><?php _e('How To', 'woothemes'); ?></a></li>
			<li><a href="#recipe-tabs-3" class="menuLink"><?php _e('Review','woothemes'); ?></a></li>

			<span class="content-right-first text-size">
				<?php _e('Text size','woothemes'); ?>
				<button class="increase"><em class="fa fa-plus"></em></button>
				<button class="decrease"><em class="fa fa-minus"></em></button>
			</span>

		</ul>

		<div id="recipe-tabs-1">

			<div class="content-left-first boxinc ingredient print-only" >
				<?php echo do_shortcode( '[ingredients]' ) ?>
			</div>

			<?php df_nutrition_recipe(); ?>

			<div class="content-full boxinc instructions print-only">

				<?php echo do_shortcode( '[method]' ) ?>

				<ul class="info-bot print-only">
				 <?php
					$servings = get_post_meta(get_the_id(), 'RECIPE_META_servings', true);
					$ready_in =  woo_fnc_convert_to_hours(get_post_meta(get_the_id(), 'RECIPE_META_ready_in', true));
					if(!empty($servings)){
						?>
						<li class="servings">
							 <?php _e('Servings :','woothemes'); ?>
							 <span><?php echo $servings; ?> </span>
						</li>
						<?php
					}

					if(!empty($ready_in)){
						?>
						<li class="ready_in">
							  <?php _e('Ready in :','woothemes'); ?>
							 <span> <?php echo $ready_in; ?> <?php _e('Minutes', 'woothemes'); ?> </span>
						</li>
					<?php
					}
					?>

					<li>
						<?php echo get_the_term_list( get_the_id(), 'course', __('Course :    ', 'woothemes'), ', ', ''); ?>
					</li>

					<li>
						<?php echo get_the_term_list( get_the_id(), 'recipe_type', __(' Recipe Type : ', 'woothemes'), ', ', ''); ?>
					</li>

					<li>
						<?php echo get_the_term_list( get_the_id(), 'ingredient', __(' Ingredient : ', 'woothemes'), ', ', ''); ?>
					</li>
				</ul>
			</div><!-- instructions -->
		</div><!-- #recipe-tabs-1 -->

		<div id="recipe-tabs-2" class="content-full" >
		<?php
			$embed_code = get_post_meta(get_the_id(), 'RECIPE_META_video_embed_method', true);

			if ($embed_code != '') {
				echo "<div class='single-img-box'>";
				echo $embed_code;
				echo "</div>";
			}

			$recipe_images_method = get_post_meta(get_the_id(), 'RECIPE_META_images_method');
			$images_count_method = count($recipe_images_method);

			if($images_count_method > 0){
				echo "<div class='single-img-box'>";

				echo "<div class='method-slider'>";

				foreach($recipe_images_method as $image_method)	{
					echo wp_get_attachment_image($image_method, 'thumbnail-blog', false, array( 'class' => 'photo' ,    ));
				}

				echo "</div></div>";
			}
		?>
		</div><!-- #recipe-tabs-2 -->

		<div id="recipe-tabs-3" class="content-full">
			<!-- Default Comments -->
			<div class="comments print-only">

				<?php

					if ( $woo_options['woo_rating_recipe'] == 'true') {
						df_rating();
				 	}

					$comm = '';

					if( isset($woo_options[ 'woo_comments' ]) ) { $comm = $woo_options[ 'woo_comments' ]; }

					if ( ( $comm == 'post' || $comm == 'both' ) && is_single() ) { comments_template(); }
				?>

			</div><!-- end of comments div -->
		</div><!-- #recipe-tabs-3 -->
	</div> <!-- recipe-tabs -->
<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Insert Attachment Method for Recipe Submit Template
/*-----------------------------------------------------------------------------------*/

function woo_fnc_insert_attachment($file_handler,$post_id,$setthumb = false ) {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);

	return $attach_id;
}


function rw_upload_form( $id = 'gallery', $gallery_name = 'gallery_image', $multiple = true )
{
    if ( empty( $id ) )
        return;
    ?>
    <input type="hidden" id="<?php echo $id; ?>-gallery-name" value="<?php echo $gallery_name; ?>" />
    <div class="rw-plupload-ui hide-if-no-js <?php if ( $multiple ): ?>rw-plupload-multiple<?php endif; ?>"
         id="<?php echo $id; ?>">
        <span class="ajaxnonceplu" id="<?php echo wp_create_nonce( $id . 'gestplupload' ); ?>"></span>

        <div id="<?php echo $id; ?>-rw-drag-drop" class="rw-drag-drop drag-drop">
            <div class="drag-drop-inside">
                <p class="drag-drop-info"><?php _e( 'Drop files here', 'rw' ); ?></p>

                <p><?php _e( 'or', 'rw' ); ?></p>
                <input id="<?php echo $id; ?>-plupload-browse-button" type="button"
                       value="<?php _e( 'Upload Files', 'rw' ); ?>" class="button" />
            </div>
        </div>
        <div class="filelist"></div>
    </div>

    <?php
}

add_action( 'wp_enqueue_scripts', 'hf_load_custom_script' );
function hf_load_custom_script() {
    if ( is_page_template('template-recipe-submit.php') )
    {
        // For PL Upload
        // wp_enqueue_script('plupload-all');
        // wp_enqueue_script( 'rw-uploader', get_template_directory_uri() . 'includes/js/pl.uploader.js', array( 'jquery' ), '1.0.0', true );
        // wp_enqueue_style( 'rw-uploader-style', get_template_directory_uri() . '/css/pl-upload.css' );

        // Localize variables for rw-uploader
        $plupload_init = array(
            'runtimes'            => 'html5,silverlight,flash,html4',
            'browse_button'       => 'plupload-browse-button',
            'container'           => 'gallery',
            'drop_element'        => 'rw-drag-drop',
            'file_data_name'      => 'async-upload',
            'multiple_queues'     => true,
            'max_file_size'       => wp_max_upload_size() . 'b',
            'url'                 => admin_url( 'admin-ajax.php' ),
            'flash_swf_url'       =>get_template_directory_uri() .'includes/js/plupload.flash.swf' ,
            'silverlight_xap_url' => get_template_directory_uri() . 'includes/js/plupload.silverlight.xap',
            'filters'             => array(
                array(
                    'title'      => __( 'Allowed Files', 'rw' ),
                    'extensions' => '*'
                )
            ),
            'multipart'           => true,
            'urlstream_upload'    => true,
            'multi_selection'     => false,
            'multipart_params'    => array(
                '_ajax_nonce' => '',
                'action'      => 'photo_gallery_upload',
                'imgid'       => 0,
            )
        );
        $plupload_init = apply_filters( 'rw_uploader_init', $plupload_init );
        wp_localize_script( 'rw-uploader', 'rwUploaderInit', $plupload_init );
    }
}
add_action( 'wp_ajax_photo_gallery_upload', "rw_ajax_photo_gallery_upload" );

/**
 * Ajax function to upload images.
 *
 * @since 1.0
 */
function rw_ajax_photo_gallery_upload()
{

    // check ajax noonce
    $uploader_id = $_POST["imgid"];
    check_ajax_referer( $uploader_id . 'gestplupload' );

    // handle file upload
    $file = $_FILES[$uploader_id . 'async-upload'];
    $status = wp_handle_upload( $file, array( 'test_form' => true,
                                            'action'      => 'photo_gallery_upload' ) );

    $image_id = wp_insert_attachment(
        array(
             'guid'           => $status['url'],
             'post_mime_type' => $status['type'],
             'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file['name'] ) ),
             'post_content'   => '',
             'post_status'    => 'inherit'
        ),
        $status['file']
    );

    if ( $image_id )
    {
        wp_update_attachment_metadata( $image_id, wp_generate_attachment_metadata( $image_id, $status['file'] ) );

        $gallery_thumbnail_size = apply_filters( 'rw_uploader_thumbnail_size', 'thumbnail' );
        $thumbnail = wp_get_attachment_image( $image_id, $gallery_thumbnail_size );

        $response =
            '<div class="rw-plupload-thumbnail">' .
                '<input type="hidden" name="' . $_POST['galleryName'] . '[]" value="' . $image_id . '" />' .
                $thumbnail .
                '<p><a class="remove-gallery-image button" href="#">' . __( 'Remove', 'rw' ) . '</a></p>' .
                '</div>';

        echo $response;
    }

    exit;
}

/*-----------------------------------------------------------------------------------*/
/* feed for recipe */
/*-----------------------------------------------------------------------------------*/

function woo_fnc_feed_request($qv) {
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types();
	return $qv;
}
add_filter('request', 'woo_fnc_feed_request');


/*-----------------------------------------------------------------------------------*/
/* meta image for recipe snippet */
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('df_meta_image') ) {

	function df_meta_image() {
		if ( has_post_thumbnail() ) {
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			echo '<meta content="'.$large_image_url[0].'" itemprop="image">';
		} else {
			$attachment_url = get_template_directory_uri() . '/includes/assets/images/image.jpg';
			echo '<meta content="'.$attachment_url.'" itemprop="image">';
		}
	}
	
}