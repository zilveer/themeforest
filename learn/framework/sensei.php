<?php

/*Remove progress*/
function learn_remove_progress_actions(){
    remove_action( 'sensei_single_course_content_inside_before' , array( Sensei()->course, 'the_progress_statement' ), 15 );
}

add_action( 'sensei_single_course_content_inside_before', 'learn_remove_progress_actions', 10 );

function learn_lesson_length(){

    global $post;
    $course_id = $post->ID;
   	$course_lessons = Sensei()->course->course_lessons( $course_id );
	if (count($course_lessons) > 0) {

        foreach ($course_lessons as $lesson) {
            $lesson_length += intval(get_post_meta( $lesson->ID, '_lesson_length', true ));
  		}
    }
    return $lesson_length;
}

/*Add progress course*/
function learn_add_progress_actions(){

	if( empty( $course_id ) ){
        global $post;
        $course_id = $post->ID;
    }

    if( empty( $user_id ) ){
        $user_id = get_current_user_id();
    }

    echo '<span class="progress statement  course-completion-rate">' . Sensei()->course->get_progress_statement( $course_id, $user_id  ) . '</span>';

	if( 'course' != get_post_type( $course_id ) || ! get_userdata( $user_id )
	    || ! WooThemes_Sensei_Utils::user_started_course( $course_id ,$user_id ) ){
	    return;
	}
	$percentage_completed = Sensei()->course->get_completion_percentage( $course_id, $user_id );

	echo Sensei()->course->get_progress_meter( $percentage_completed ).'<i class="icon-trophy"></i><hr>';
}

add_action( 'learn_course_single_meta', 'learn_add_progress_actions', 20 );

/*Add button cart*/
function learn_add_btncart_actions(){

	Sensei()->frontend->sensei_get_template( 'woocommerce/add-to-cart.php' );
}

add_action( 'learn_course_single_btncart', 'learn_add_btncart_actions', 20 );


/**
 * Enables the comments in Course edit screen.
 */
function learn_add_comments_support_for_course() {
	add_post_type_support( 'course', 'comments' );
}
add_action( 'init', 'learn_add_comments_support_for_course' );


/**
 * Rating field for comments.
 *
 * @param int $comment_id
 */
function learn_add_comment_rating( $comment_id ) {
 if ( isset( $_POST['rating'] ) && 'course' === get_post_type( $_POST['comment_post_ID'] ) ) {
  if ( ! $_POST['rating'] || $_POST['rating'] > 5 || $_POST['rating'] < 0 ) {
   return;
  }
  add_comment_meta( $comment_id, 'rating', (int) esc_attr( $_POST['rating'] ), true );
 }
}

add_action( 'comment_post', 'learn_add_comment_rating', 1 );


/**
 * Custom fields comment form
 *
 * @since  1.0
 *
 * @return  array  $fields
 */

add_filter( 'comment_form_logged_in', 'learn_comment_form_logged_in', 10, 3 );

function learn_comment_form_logged_in( $logged_in_as, $commenter, $user_identity ) {
	if ( is_singular( 'course' ) ) {
		$commenter['rating'] = '<p class="comment-form-rating">' .
							   '<span class="stars"><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span>' .
							   '<select name="rating" id="rating" style="display: none;">' .
							   '<option value="">' . esc_html__( 'Rate...', 'learn' ) . '</option>' .
							   '<option value="5">' . esc_html__( 'Perfect', 'learn' ) . '</option>' .
							   '<option value="4">' . esc_html__( 'Good', 'learn' ) . '</option>' .
							   '<option value="3">' . esc_html__( 'Average', 'learn' ) . '</option>' .
							   '<option value="2">' . esc_html__( 'Not that bad', 'learn' ) . '</option>' .
							   '<option value="1">' . esc_html__( 'Very poor', 'learn' ) . '</option>' .
							   '</select></p>';
						   
		return $logged_in_as . $commenter['rating'];
	}else{
		return $logged_in_as;
	}
}


/**
 * Retrieves related product terms
 *
 * @param string $term
 * @return array
 */
function learn_get_related_terms($term, $post_id = null) {
 $post_id = $post_id ? $post_id : get_the_ID();
 $terms_array = array(0);

 $terms = wp_get_post_terms($post_id, $term);
 foreach( $terms as $term ) {
  $terms_array[] = $term->term_id;
 }

 return array_map('absint', $terms_array);
}

function learn_get_rating_course($post_id = null) {
 $post_id = $post_id ? $post_id : get_the_ID();

 $args = array(
 		'status' => 'approve',
		'post_id' => $post_id, // use post_id, not post_ID
	);
	$comments = get_comments($args);
	if($comments){
		$i=0;
		$rate = 0;
		foreach($comments as $comment){
			$rate += intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
			if($rate > 0){
				$i++;
			}
		}
	}
	if($rate > 0){ $rates = $rate/$i; }
		     						
	$rates2 = $rates + 0.5;
	$rates3 = $rates + 0.25;
	for ( $j = 1; $j <= 5; $j ++ ) {
		if ( $j <= $rates || $j <= $rates3 ) {
			echo '<i class="icon-star"></i>';
			}elseif( $j <= $rates2 ) {
			echo '<i class="icon-star-half-alt"></i>';
			} else {
			echo '<i class="icon-star-empty"></i>';
		}
	}

}

?>