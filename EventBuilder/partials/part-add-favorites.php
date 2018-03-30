				<?php 

					global $wpdb;
					$table_name = "td_favorites";

					$user_ID = get_current_user_id();
		      		$this_post_id = $post->ID;
		      		$favStatus = 0;

					if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

		      			global $wpdb;
		      			$myFav = $wpdb->get_results( 'SELECT id FROM td_favorites WHERE user_id = "'.$user_ID.'" AND listing_id = "'.$this_post_id.'" ' );

		      			if(empty($myFav)) {
		      				$favStatus = 0;
		      			} else {
		      				$favStatus = 1;
		      			}

		      			$allFav = $wpdb->get_var( 'SELECT COUNT(*) FROM td_favorites WHERE listing_id = "'.$this_post_id.'" ' );

		      		}

	      			if(empty($allFav)) {
	      				$allFav = 0;
	      			}

	      		?>

	      		<span id="like-listing-container" class="like-listing-container">
	      			<i class="fa fa-heart-o" <?php if(empty($myFav)) { ?>style="display: block"<?php } else { ?>style="display: none"<?php } ?> ></i>
	      			<i class="fa fa-heart" <?php if(empty($myFav)) { ?>style="display: none"<?php } else { ?>style="display: block"<?php } ?>></i>
	      			<i class="fa fa-spinner fa-spin"></i>
	      		</span>

	      		<span class="like-listing-count"><span id="count-bookmarks"><?php echo esc_attr($allFav); ?></span> <?php _e( 'Bookmarks', 'themesdojo' ); ?></span>

	      		<?php 

	      			$user_ID = get_current_user_id(); 

	      			if(empty($user_ID)) {

	      		?>

	      		<script type="text/javascript">

						jQuery(function($) {

							document.getElementById('like-listing-container').addEventListener('click', function(e) {
											
								$.fn.favoriteForm();

								e.preventDefault();

							});

							$.fn.favoriteForm = function() {

								jQuery('#popup-td-login').css('display', 'block');

							}

						});

				</script>

	      		<?php

	      			} else {

	      		?>

	      		<form id="favorite-form">

	      			<input name="favorite_listing_id" id="favorite_listing_id" type="hidden" value="<?php echo esc_attr($this_post_id); ?>" />
	      			<input name="favorite_user_id" id="favorite_user_id" type="hidden" value="<?php echo esc_attr($user_ID); ?>" />
	      			<input name="favorite_status" id="favorite_status" type="hidden" value="<?php echo esc_attr($favStatus); ?>" />

					<input type="hidden" name="action" value="favoriteForm" />
					<?php wp_nonce_field( 'favoriteForm_html', 'favoriteForm_nonce' ); ?>

				</form>

				<form id="favorite-form-update">

					<input name="favorite_listing_id" id="favorite_listing_id_2" type="hidden" value="<?php echo esc_attr($this_post_id); ?>" />

					<input type="hidden" name="action" value="favoriteUpdateForm" />
					<?php wp_nonce_field( 'favoriteUpdateForm_html', 'favoriteUpdateForm_nonce' ); ?>

				</form>

	      		<script type="text/javascript">

						jQuery(function($) {

							jQuery(document).on('click','#like-listing-container', function(e) {
								
								jQuery('#favorite-form').ajaxSubmit({
									type: "POST",
									data: jQuery('#favorite-form').serialize(),
									url: '<?php echo admin_url('admin-ajax.php'); ?>',
									beforeSend: function() {
										jQuery('#like-listing-container .fa').css('display', 'none');
							        	jQuery('.like-listing-container .fa-spinner').css('display', 'inline-block');
							        	jQuery('#like-listing-container .fa-heart-o').removeClass("bounce");
							        	jQuery('#like-listing-container .fa-heart').removeClass("bounce");
							        },	 
								    success: function(response) {
								    	if(response == 1) {
											jQuery('#like-listing-container .fa-heart').css('display', 'block');
											jQuery('#like-listing-container .fa-heart').addClass("bounce");
								        	jQuery('.like-listing-container .fa-spinner').css('display', 'none');
								        	jQuery('#favorite_status').val(1);
								        	$.fn.favoriteUpdateForm();
										} 
										if(response == 0) {
											jQuery('#like-listing-container .fa-heart-o').css('display', 'block');
											jQuery('#like-listing-container .fa-heart-o').addClass("bounce");
								        	jQuery('.like-listing-container .fa-spinner').css('display', 'none');
								        	jQuery('#favorite_status').val(0);
								        	$.fn.favoriteUpdateForm();
										} 
								       	return false;
									}
								});

							});

							$.fn.favoriteUpdateForm = function() {

								jQuery('#favorite-form-update').ajaxSubmit({
									type: "POST",
									data: jQuery('#favorite-form-update').serialize(),
									url: '<?php echo admin_url('admin-ajax.php'); ?>',	 
								    success: function(response) {
								    	jQuery('#count-bookmarks').text(response);
								       	return false;
									}
								});

							}

						});

				</script>

				<?php } ?>