<?php 


/**
* Social networks
****************************************************/
function van_social_networks() {
	?>
	<ul class="social-icons clearfix">
		<?php if( van_get_option('feed-url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('feed-url') ); ?>"  title="Rss" ><span class="icon icon-rss"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('facebook_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('facebook_url') ); ?>" title="Facebook" ><span class="icon icon-facebook"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('twitter_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('twitter_url') ); ?>" title="Twitter" ><span class="icon icon-twitter"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('youtube_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('youtube_url') ); ?>" title="Youtube" ><span class="icon icon-youtube"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('g_plus_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('g_plus_url') ); ?>" title="Google +" ><span class="icon icon-gplus"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('dribbble_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('dribbble_url') ); ?>" title="Dribbble" ><span class="icon icon-dribbble"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('stumbleupon_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('stumbleupon_url') ); ?>" title="Stumbleupon" ><span class="icon icon-stumbleupon"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('tumblr_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('tumblr_url') ); ?>" title="Tumblr" ><span class="icon icon-tumblr"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('pinterest_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('pinterest_url') ); ?>" title="Pinterest" ><span class="icon icon-pinterest"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('flickr_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('flickr_url') ); ?>" title="Flickr" ><span class="icon icon-flickr"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('vimeo_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('vimeo_url') ); ?>" title="Vimeo" ><span class="icon icon-vimeo"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('instagram_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('instagram_url') ); ?>" title="Instagram" ><span class="icon icon-instagramm"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('linkedin_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('linkedin_url') ); ?>" title="Linkedin" ><span class="icon icon-linkedin"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('behance_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('behance_url') ); ?>" title="Behance" ><span class="icon icon-behance"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('skype_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('skype_url') ); ?>" title="Skype" ><span class="icon icon-skype"></span></a></li>
		<?php endif; ?>
		<?php if( van_get_option('github_url') ): ?>	
			<li><a href="<?php echo esc_url( van_get_option('github_url') ); ?>" title="Github" ><span class="icon icon-github"></span></a></li>
		<?php endif; ?>
	</ul>
	<?php 
}
/**
*   Login Form
*******************************************************/
function van_login_form( $redirect="" ) {

	$user = wp_get_current_user();
	$redirect =  $redirect !== "" ? $redirect : $_SERVER['REQUEST_URI'] ;
	
	 ?>
	 <?php if ( $user->ID != 0 ): ?>

		<div id="user-logged">
			<div class="author-avatar"><?php echo get_avatar( $user->ID, $size = '62' ); ?></div>
			<div class="login-helpers">
				<p><a href="<?php echo esc_url( home_url() ); ?>/wp-admin/"><?php _e( 'Dashboard' , 'van' ); ?> </a></p>
				<p><a href="<?php echo esc_url( home_url() ); ?>/wp-admin/post-new.php"><?php _e( 'Add new post' , 'van' ); ?> </a></p>
				<p><a href="<?php echo esc_url( home_url() ); ?>/wp-admin/profile.php"><?php _e( 'Your Profile' , 'van' ); ?> </a></p>
				<p><a href="<?php echo esc_url( wp_logout_url( $redirect  ) ); ?>"><?php _e( 'Logout' , 'van' ); ?> </a></p>
			</div>
		</div>

	 <?php else: ?>

		<div id="loginform-container">
			<p class="error-message"></p>
			<?php
				 $args = array('redirect' =>  $redirect, 'label_username' => __( 'Username', 'van' ),'label_password' => __( 'Password', 'van' ),'label_remember' => __( 'Remember Me', 'van' ),'label_log_in' => __( 'Log In', 'van' ) );
				 wp_login_form( $args );
			?>
			<div class="clear"></div>
			<div class="login-helpers">
				<?php if ( get_option('users_can_register') ) : ?>
					<p><a href="<?php echo esc_url( home_url() ); ?>/wp-register.php"><?php _e( 'Register' , 'van' ) ?></a><p>
				<?php endif; ?>
				<p><a href="<?php echo esc_url( home_url() ); ?>/wp-login.php?action=lostpassword"><?php _e( 'Lost your password ?' , 'van' ) ?></a></p>
			</div>
		</div>

	 <?php 

	endif;
}
/**
* Breadcrumb
**********************************************************/
function van_breadcrumb() { 

	if ( !van_get_option("breadcrumb") || is_home() ) {
		return;
	}
	?>
		<div id="breadcrumb" class="clearfix">
			<ul>
				<li class="home"><a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Home' , 'van' ); ?></a><i class="divider">/</i></li>
				
				<?php if ( is_single() ): ?>
					<li><?php the_category(' / ','&title_li='); ?><i class="divider">/</i></li>
					<li><span class="active"><?php the_title(); ?></span></li>

				<?php elseif ( is_page() ): ?>
					<li><span class="active"><?php the_title(); ?></span></li>

				<?php elseif ( is_category() ): ?>
					<li><span class="active"><?php echo single_cat_title( '', false ); ?></span></li>	

				<?php elseif ( is_search() ): ?>
					<li><span class="active"><?php printf( __( 'Search Results for: %s', 'van' ),  get_search_query() ); ?></span></li>
				
				<?php elseif ( is_tag() ): ?>
					<li><span class="active"><?php printf( __( 'Tag Archives: %s', 'van' ), single_tag_title( '', false ) ); ?></span></li>
				
				<?php elseif ( is_author() ): ?>
					<li><span class="active"><?php printf( __( 'Author Archives: %s', 'van' ),  get_the_author() ); ?></span></li>
				
				<?php elseif ( is_404() ): ?>
					<li><span class="active"><?php _e( 'Not Found', 'van' ); ?></span></li>

				<?php endif; ?>
			</ul>
		</div>
	<?php
	
}

/**
*  Author Social
******************************************************/
function van_author_social( $user_id  = false ){

	$social = "";

	if ( get_the_author_meta( 'facebook', $user_id ) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('facebook' , $user_id) ) . '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Facebook', 'van' ) . '"><span class="icon-facebook"></span></a></li>';
	}
	if ( get_the_author_meta( 'twitter', $user_id ) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('twitter' , $user_id) ) . '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Twitter', 'van' ) . '"><span class="icon-twitter"></span></a></li>';
	}
	if ( get_the_author_meta( 'goplus', $user_id ) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('goplus' , $user_id) ) . '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Google+', 'van' ) . '"><span class="icon-gplus"></span></a></li>';
	}
	if ( get_the_author_meta( 'youtube' , $user_id) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('youtube' , $user_id) ) . '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on YouTube', 'van' ) . '"><span class="icon-youtube"></span></a></li>';
	}
	if ( get_the_author_meta( 'vimeo' , $user_id) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('vimeo' , $user_id) ) . '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Vimeo', 'van' ) . '"><span class="icon-vimeo"></span></a></li>';
	}
	if ( get_the_author_meta( 'linkedin', $user_id ) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta( 'linkedin' ) , $user_id ). '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Linkedin', 'van' ) . '"><span class="icon-linkedin"></span></a></li>';
	}
	if ( get_the_author_meta( 'flickr' , $user_id) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('flickr' , $user_id) ). '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Flickr', 'van' ) . '"><span class="icon-flickr"></span></a></li>';
	}	
	if ( get_the_author_meta( 'instagram', $user_id ) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('instagram' , $user_id) ). '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Instagram', 'van' ) . '"><span class="icon-instagramm"></span></a></li>';
	}
	if ( get_the_author_meta( 'pinterest', $user_id ) ){
		$social .= '<li><a class="tooltip" href="' . esc_url( get_the_author_meta('pinterest' , $user_id) ) . '" title="' . esc_attr( get_the_author_meta('display_name' , $user_id) ) . ' ' . esc_attr__( 'on Pinterest', 'van' ) . '"><span class="icon-pinterest"></span></a></li>';
	}

	if ( $social !== "" ) {
		echo '<div class="author-social clearfix"><ul class="social-icons">' . $social . '</ul></div>';
	}
}

/**
* Archives Rss
********************************************************/
function van_archives_rss(){
	if ( van_get_option("archives_rss") ) :
		if( is_category() ){
			$feed_link = get_category_feed_link( get_query_var('cat') );
		}elseif( is_author() ){
			$feed_link = get_author_feed_link( get_the_author_meta('ID') );
		}elseif ( is_tag() ) {
			$feed_link = get_term_feed_link( get_query_var('tag_id'), 'post_tag', "rss2" ); 
		}
		?>
		<div class="archives-rss">
			<a href="<?php echo esc_url( $feed_link ); ?>" class="tooltip" title="<?php _e( 'Feed Subscription', 'van' ); ?>" ></a>
		</div>
		<?php
	endif;
}

/**
*	Post Media
*********************************************************/
function van_entry_media() {


	global $post;

	$format = get_post_format( $post->ID );

	switch ( $format ) {

		case 'audio':
				van_format_audio();
			break;
		case 'gallery':
				van_format_gallery();
			break;
		case 'image':
				van_format_image();
			break;
		case 'video':
				van_format_video();
			break;			
		case 'quote':
				van_format_quote();
			break;
		case 'status':
				van_format_status();
			break;
		default:
				van_format_standard();
			break;
	}

}
/**
* Posts Query
**************************************************************/

function van_posts_query( $posts_number = 3 , $thumb = true, $query_name = "date",  $meta_key = "", $layout = "list"){

	$args = array( 'meta_key'=> $meta_key,
			     'orderby' => $query_name, 
			     'posts_per_page' => $posts_number );

	$width = 80; $height = 80;

	if ( $layout == "box" ) {
		$width = 300; $height = 190;
	}

	$query = new WP_Query( $args );
	?>

	<?php if( $query->have_posts() ): ?>

		<?php if ( $layout == "list" ): ?><div class="posts-widget"><?php endif; ?>
		
		<ul>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<li class="clearfix">
					<?php if ( $layout == "box"  ): ?><div class="content box-entry"><?php endif; ?>
					<?php if ( $thumb === true &&  has_post_thumbnail() && '' != get_the_post_thumbnail() ): ?>
						<div class="entry-media <?php echo get_post_format(); ?>-format">
							<a href="<?php the_permalink(); ?>">
								<?php van_thumb( $width ,$height); ?>
								<div class="thumb-overlay"></div>
							</a>
							<?php if ( $layout == "box" ): ?>
								<span class="post-format-icon"></span>
							<?php endif; ?>
						</div><!-- .entry-media -->			
					<?php endif; ?>
					
					<?php if ( $layout == "box"  ): ?><div class="entry-container"><?php endif; ?>
					<h4 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'van' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h4><!-- .entry-title -->

					<div class="entry-meta" style="overflow:hidden">

						<?php if ( $query_name == 'date' ): ?>
							<span class="icon-clock icon"></span> <?php the_time(get_option('date_format'));  ?>
						<?php elseif ( $query_name == 'comment_count' ): ?>
							<span class="icon-chat icon"></span> <?php comments_popup_link( __( 'No Comment', 'van' ), __( '1 Comment', 'van' ), __( '% Comments', 'van' ) ); ?>
						<?php elseif ( $query_name == 'rand' ): ?>
							<span class="icon-clock icon"></span> <?php the_time(get_option('date_format'));  ?><br>
							<span class="icon-chat icon"></span> <?php comments_popup_link( __( 'No Comment', 'van' ), __( '1 Comment', 'van' ), __( '% Comments', 'van' ) ); ?>
						<?php elseif ( $query_name == 'meta_value_num' && $meta_key == 'van_post_view_count'): ?>
							<span class="icon-eye icon"></span> <?php echo van_numbers_sin( van_post_view(), __(" View", "van"), __(" Views", "van") ); ?>
						<?php elseif ( $query_name == 'meta_value_num' && $meta_key == 'van_votes_count'): ?>
							<span class="icon-heart icon"></span> <?php echo van_numbers_sin( van_votes_count( get_the_ID() ), __(" Like", "van"),  __(" Likes", "van") ); ?>
						<?php endif; ?>
							
					</div><!-- .entry-meta -->

					<?php if ( $layout == "box"  ): ?></div><!--.entry-container--></div><!--.box-entry--><?php endif; ?>
				</li>
			<?php endwhile; ?>
		</ul>

		<?php if ( $layout == "list" ): ?></div><!--.posts-widget--><?php endif; ?>

	<?php endif; ?>

	<?php
	wp_reset_query();
	
}

/**
*  Custom number text
*/
function van_numbers_sin($num, $sing, $plur){
	if ($num == 1 || $num == 0){
		return $num . $sing;
	}else{
		return $num . $plur;
	}
}

/**
* Commentes
************************************************/
function van_comments( $comments_number = 3 ){
	
	$comments = get_comments( array('status' => 'approve', 'number' => $comments_number) );
	?>
	<div class="posts-widget">
		<ul>
			<?php foreach ( $comments as $comment ): ?>
				<?php 
					$wp_html_excerpt = wp_html_excerpt( $comment->comment_content, 40 );
					$comment_excerpt = ( strlen( $comment->comment_content ) > 40 ) ? $wp_html_excerpt . "..." : $wp_html_excerpt; 
			 	?>
				<li class="clearfix">
					
					<div class="entry-media skipover">
						<?php echo get_avatar( $comment, 55 ); ?>
					</div><!-- .entry-media -->

					<div class="author-comment">
						<a href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
							<strong><?php echo strip_tags($comment->comment_author); ?>: </strong> 
							<p><?php echo $comment_excerpt; ?></p>
						</a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php

}
/**
*   Post Meta conditions
*******************************************************/
function van_meta_conditions( $meta, $single, $archive = true, $falseOptions = false ){
	
	global $post;

	$post_custom = get_post_custom($post->ID);
	$post_meta    = isset( $post_custom[$meta][0] ) ? $post_custom[$meta][0]  : "";
	$vanOption    = false;

	if ( $falseOptions ) {

		if ( is_single() && $post_meta == "") {
			$vanOption = ( van_get_option($single) ) ? false : true;
		}elseif( $archive && !is_single() ){
			$vanOption = ( van_get_option($archive) ) ? false : true;
		}
		
	}else{
		if ( is_single() && $post_meta == "" ) {
			$vanOption = ( van_get_option($single) ) ? true : false;
		}elseif( $archive && !is_single() ) {
			$vanOption = ( van_get_option($archive) ) ? true : false;
		}
	}

	if( ( is_single() && $post_meta == "yes") || $vanOption ) {
		return true;
	}else {
		return false;
	}

}
/**
* Entry Meta
***********************************************************/

// entry meta structure
function van_entry_meta_structure( $option, $divider ) {
	
	global $post;

	switch ( $option ) {
		case 'author':

			printf( '<span class="author-link vcard"><i class="icon-user icon"></i> <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_attr( sprintf( __( 'View all posts by %s', 'van' ), get_the_author() ) ), get_the_author() );
			if ( $divider ) {
				echo '<i class="divider">/</i>';
			}
			
			break;
		
		case 'date':

			echo '<span class="post-date"><i class="icon-clock icon"></i> ' . get_the_time( get_option('date_format') ) . '</span>';

			if ( $divider ) {
				echo '<i class="divider">/</i>';
			}
			
			break;

		case 'category':

			$categories = get_the_category_list( __( ', ', 'van' ) );

			if ( $categories ) {
				echo '<span class="categories-links" ><i class="icon-folder icon"></i> ' . $categories . '</span>';
				
				if ( $divider ) {
					echo '<i class="divider">/</i>';
				}
			}
	
			break;

		case 'comments':

			echo '<span class="comments-link" ><i class="icon-chat icon"></i> ';
				comments_popup_link( __('Leave a Comment', 'van'), __('1 Comment', 'van'), __('% Comments', 'van') );
			echo '</span>';
			if ( $divider ) {
				echo '<i class="divider">/</i>';
			}

			break;

		case 'views':

			echo '<span class="views-count" ><i class="icon-eye icon"></i> ' . van_post_view() . '</span>';
			if ( $divider ) {
				echo '<i class="divider">/</i>';
			}

			break;

		case 'likes':

			$vote_count = van_votes_count( $post->ID );
			$voted 	  = "";

			if ( van_check_voter( $post->ID ) ) {
				$voted  = sprintf( ' class="voted tooltip" title="%s" ', esc_attr__("You are already like this post","van") );
			}
			echo '	<span class="post-like"><a href="javascript:;" id="post-like-' . $post->ID . '"  ' . $voted . ' onclick="vanAddVote(' . $post->ID . ');"><i class="icon-heart icon"></i> <span class="likes-val">' . $vote_count . '</span></a></span>';
			if ( $divider ) {
				echo '<i class="divider">/</i>';
			}
			break;
	}

}



// Get entry meta

function van_entry_meta(){

	$enrty_meta = array();
	$options	  = array();
	$format 	  = get_post_format();

	if ( is_single() ) {
		$enrty_meta = array(
			"author"    => "single_author",
			"date"       => "",
			"category" => "single_cat",
			"comments"=> "single_comments",
			"views"      => "single_views",
			"likes"       => "single_likes"
		);
		if( $format == "quote" || $format == "status" ){
			$enrty_meta["date"] = "single_date";
		}
	}else{
		$enrty_meta = array(
			"author"    => "meta_author",
			"date"       => "",
			"category" => "meta_cat",
			"comments"=> "meta_comments",
			"views"      => "meta_views",
			"likes"       => "meta_likes"
		);
		if( $format == "quote" || $format == "status" || $format == "link" ){
			$enrty_meta["date"] = "meta_date";
		}
	}

	foreach ( $enrty_meta as $key => $option ) {

		if ( van_get_option( $option ) ) {
			$options[] = $key; 
		}
		
	}

	if ( !empty( $options ) && van_meta_conditions("van_postmeta", "single_meta", "post_meta", true , true ) ){

		$count = count( $options );
		$i        = 0;
		$divider = true;	

		echo '<div class="entry-meta">';
		foreach ( $options as $option ) {
			$i++;

			if ( $i == $count ) {
				$divider = false;
			}
			van_entry_meta_structure( $option, $divider );
		}
		echo '</div><!-- .entry-meta -->';
	}

	
}
/**
*  Ribbon
***********************************************************/

function van_ribbon(){

	if ( !van_meta_conditions("van_ribbon", "single_ribbon", "ribbon", true, true) ) {
		return;
	}

	$output = "";

	// Check if Post Format icon enabled
	if ( ( is_single() &&  van_get_option("single_format_icn") ) || ( !is_single() && van_get_option("format_icon")  )  ) {
	
		$output .= '<span class="post-format-icon"></span>';
		
	}
	// Check if Post date enabled
	if(  	get_post_format() != "status" &&  get_post_format() != "link" &&
		( 
			( is_single() && van_get_option("single_date") ) || 
			( !is_single() && van_get_option("meta_date") ) 
		)
	){
		
		$output .= '<i class="divider"></i>';
		$output .= '<span class="post-date">' . get_the_time( get_option('date_format') ) . '</span>';

	}
	// Check if output variable not empty and show result
	if ( "" != $output ) {
		?>
		<div class="ribbon clearfix">
			<?php echo $output; ?>
		</div><!-- .ribbon -->
		<?php
	}
					
						
}

/**
* Entry Content
***********************************************************/
function van_entry_content(){

	$format  = get_post_format();

	if( is_single() ) { 

		echo '<div class="entry-content">';

 		the_content(); 

 		wp_link_pages( array(
	 		'before' => '<p class="post-pagination"><strong>' . __( 'Pages:', 'van' ) . '</strong>',
	 		'after' => '</p>')
 			);
 		echo '</div>';

	} else { 

		if ( van_get_option('display_content')  !== "none" || $format == "status" ) {

			echo '<div class="entry-content">';

			if (  van_get_option('display_content')  == "full" || $format == "status" ) {

				the_content(__( 'Continue reading &rarr;', 'van' ));

			} else {

				the_excerpt();
			}
			echo '</div>';

		}

	} 

}

/**
*	Post navigation
**************************************************/
function van_post_navigation(){

	?>
	<div class="article-navigation clearfix" >

		<?php if (get_adjacent_post(false, '', true)): ?>
			<div class="prev">
				<strong><span>&larr;</span> <?php _e("Previous","van") ?></strong>
				<?php previous_post_link( '%link', '%title' ); ?>
			</div>
		<?php endif; ?>

		<?php if (get_adjacent_post(false, '', false)): ?>
			<div class="next">
				<strong><?php _e("Next","van") ?> <span>&rarr;</span></strong>
				<?php next_post_link( '%link', '%title'  ); ?>
			</div>
		<?php endif; ?>

	</div><!-- .article-navigation -->
	<?php
}

/**
* Social Share
*************************************************/

function van_social_share() {

	$title =urlencode( get_the_title() );
	$url   = urlencode( get_permalink() );

	$facebook     = esc_url( "http://www.facebook.com/share.php?u={$url}&amp;title={$title}" );
	$twitter        = esc_url( "http://twitter.com/home?status={$title}+{$url}" );
	$g_plus         = esc_url( "https://plus.google.com/share?url={$url}" );
	$linkedin       = esc_url( "http://www.linkedin.com/shareArticle?mini=true&amp;url={$url}&amp;title={$title}" );
	$stumbleupon = esc_url( "http://www.stumbleupon.com/submit?url={$url}&amp;title={$title}" );
	?>
	<div class="article-share clearfix">

		<strong><?php _e("Share: ", "van") ?></strong>

		<?php if ( van_get_option("fb_button") ): ?>
			<a href="javascript:;" class="icon-facebook" onclick="vanOpenUrl('<?php echo $facebook; ?>')" class="tooltip share-btn" title="<?php esc_attr_e('Facebook','van'); ?>"></a>
		<?php endif; ?>

		<?php if ( van_get_option("tweet_button") ): ?>
			<a href="javascript:;" class="icon-twitter" onclick="vanOpenUrl('<?php echo $twitter; ?>')" class="tooltip share-btn" title="<?php esc_attr_e('Twitter','van'); ?>"></a>
		<?php endif; ?>

		<?php if ( van_get_option("google_button") ): ?>
			<a href="javascript:;" class="icon-gplus" onclick="vanOpenUrl('<?php echo $g_plus; ?>')" class="tooltip share-btn" title="<?php esc_attr_e('Google+','van'); ?>"></a>
		<?php endif; ?>

		<?php if ( van_get_option("stumbleupon_button") ): ?>
			<a href="javascript:;" class="icon-stumbleupon" onclick="vanOpenUrl('<?php echo $stumbleupon; ?>')" class="tooltip share-btn" title="<?php esc_attr_e('Stumbleupon','van'); ?>"></a>
		<?php endif; ?>

		<?php if ( van_get_option("linkedin_button") ): ?>
			<a href="javascript:;"class="icon-linkedin" onclick="vanOpenUrl('<?php echo $linkedin; ?>')" class="tooltip share-btn" title="<?php esc_attr_e('Linkedin','van'); ?>"></a>
		<?php endif; ?>

	</div><!-- .article-share -->
	<?php

}

/**
*   Post  Tags
***********************************************************/

function van_post_tags(){

	the_tags( '<div class="article-tags clearfix"><strong>' . __( 'Tags: ', 'van' ) . '</strong><div class="tags-container">',' ', '</div></div><!-- .article-tags -->');
}
/**
* Entry footer
***********************************************************/
function van_entry_footer() {
	
	// return null if not is single
	if ( !is_single() ) {
		return;
	}

	//footer
	if ( van_meta_conditions( 'van_postags', 'single_tags', false ) || van_meta_conditions( 'van_sharepost', 'share_post', false ) ) {
		
		echo '<footer id="entry-footer" class="clearfix">';
		if ( van_meta_conditions( 'van_sharepost', 'share_post', false ) ) {
			van_social_share();
		}
		if ( !van_meta_conditions( 'van_postags', 'single_tags', false ) ) {
			van_post_tags();
		}
		echo '</footer>';

	}

	// post navigation
	if ( van_meta_conditions( 'van_postnav', 'post_nav', false ) ) {
		van_post_navigation();
	}

}