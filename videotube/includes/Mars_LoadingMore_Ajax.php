<?php
if( !defined('ABSPATH') ) exit;
if( !class_exists( 'Mars_LoadingMore_Ajax' ) ){
	class Mars_LoadingMore_Ajax {
		function __construct() {
			add_action('wp_ajax_loading_more_videos', array( $this, 'access' ));
			add_action('wp_ajax_nopriv_loading_more_videos', array( $this, 'access' ));
			add_filter('videotube_infinity_loop_number', array( $this, 'set_loop_number' ), 10, 1);
		}
		function access(){
			$htmlDATA = null;
			$post_id = isset( $_POST['post_id'] ) ? (int)$_POST['post_id'] : null;
			$paged = isset( $_POST['paged'] ) ? (int)$_POST['paged'] : null;
			$nextpaged = $paged + 1;
			$current_indexpage = isset( $_POST['current_indexpage'] ) ? (int)$_POST['current_indexpage'] : 0;
			$post_type = isset( $_POST['post_type'] ) ? trim( $_POST['post_type'] ) : 'video';
			if( $paged == null )
				return;
							
			$query = array(
				'post_type'	=>	$post_type,
				'paged'	=>	$nextpaged,
				'post_status'	=>	'publish'
			);
			$wp_query = new WP_Query( apply_filters( 'mars_scrolling_post_args' , $query) );
			
			if( $this->get_loop_limit() >= $this->get_loop_number() && $wp_query->found_posts > 0 ){
				$redirect_url = $current_indexpage > 0 ? get_permalink( $current_indexpage ) : home_url();
				$post_type_obj = get_post_type_object( $post_type );
				//echo $post_type_obj->labels->singular_name;
				echo json_encode(array(
					'resp'	=>	'next_paged',
					'message'	=>	'<button onclick="window.location.href='. '\'' . $redirect_url.'?paged='.$nextpaged. '\'' .'" type="button" class="btn btn-lg navigation">'. sprintf( __('I want more %s','mars'), $post_type_obj->labels->singular_name ) .'</button>',
				));
				exit;
			}
			$class = ( $post_type == 'video' ) ? 'row video' : 'row post';
			if( $wp_query->have_posts()):
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$htmlDATA .= '
						<div id="'.get_the_ID().'" class="' . join( ' ', get_post_class( $class , get_the_ID() ) ) . '">
                    		<div class="col-sm-5 item list">';
								if( $post_type == 'video' ):
                    				$htmlDATA .='<div class="item-img">';
                    			endif;
			                		if( has_post_thumbnail(get_the_ID()) ){
			                			$htmlDATA .= '<a href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(get_the_ID(),'video-category-featured', array('class'=>'img-responsive')) .'</a>';
			                		}
			                		if( $post_type == 'video' ):
										$htmlDATA .= '
										<a href="'.get_permalink(get_the_ID()).'"><div class="img-hover"></div></a>
			                		</div>';
		                		endif;
		                		$htmlDATA .= '
                    		</div>
                    		<div class="col-sm-7 item list">';
		                		if( $post_type == 'post' ):
		                			$htmlDATA .= '<div class="post-header">';
		                		endif;
		                		$htmlDATA .= '
                    			<h3><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h3>';
		                		if( $post_type == 'post' ):
		                			ob_start();
		                			do_action( 'mars_blog_metas' );
		                			$htmlDATA .= ob_get_clean();
		                			$htmlDATA .= '</div>';
		                		endif;
		                		if( $post_type == 'video' ):
		                			ob_start();
		                			do_action( 'mars_video_meta' );
                    				$htmlDATA .= ob_get_clean();
                    				$htmlDATA .= '<p>'.get_the_excerpt().'</p>';
                    			endif;
                    			if( $post_type == 'video' ):
                    			$htmlDATA .= '<p><a href="'.get_permalink(get_the_ID()).'"><i class="fa fa-play-circle"></i>'. __('Watch Video','mars').'</a></p>';
                    			else:
                    				$htmlDATA .= '
	                    				<div class="post-entry">';
                    						$htmlDATA .= '<p>'.get_the_excerpt().'</p>
	                    					<a href="'.get_permalink(get_the_ID()).'" class="readmore">'. __('Read More','mars') .'</a>
	                    				</div>                    				
                    				';
                    			endif;
                    			$htmlDATA .= '
                    		</div>
						</div>
					';
				endwhile;
			else:
				$htmlDATA .= __('nothing','mars');
			endif;
			$reponse = array(
				'resp'=>'success',
				'message'=>$htmlDATA,
				'paged'	=>	$wp_query->found_posts > 0 ? $nextpaged : 0
			);
			echo json_encode( $reponse );
			exit;
		}
		function get_loop_number( $number = 5 ){
			return apply_filters('videotube_infinity_loop_number', $number);
		}
		function set_loop_number(){
			return 50;
		}
		/**
		 * Update the loop count number limitation.
		 * @param int $loop
		 * return loop number count.
		 */
		function get_loop_limit(){
			if(!isset($_SESSION)){ session_start();}
			$loading_loop = isset( $_SESSION['loading_loop'] ) ? (int)$_SESSION['loading_loop'] : 0;
			if( $loading_loop == 0 ){
				$loading_loop++;
			}
			elseif( $loading_loop >= $this->get_loop_number() ){
				$loading_loop = 0;
			}
			else{
				$loading_loop++;
			}
			$_SESSION['loading_loop'] = $loading_loop;
			return $loading_loop;
		}
	}
	new Mars_LoadingMore_Ajax();
}