<?php if (!defined('ABSPATH')) die('No direct access allowed');
/*
  Template Name: Edit Car
 */


if (!is_user_logged_in()) {
    $redirect_to = get_permalink( TMM::get_option('user_login_page', TMM_APP_CARDEALER_PREFIX) );
    if (TMM::get_option('edit_page', TMM_APP_CARDEALER_PREFIX) && isset($_GET['post_id'])) {
		$redirect_to .= '?redirect=' . urlencode( get_permalink( TMM::get_option('edit_page', TMM_APP_CARDEALER_PREFIX) ) . '?post_id=' . $_GET['post_id']);
	}
    wp_redirect($redirect_to, 302);
    return;
}

$user_id = get_current_user_id();
$post_id = (int) $_GET['car_id'];

if (isset($_POST['car_was_edited']) && TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX)) {
    wp_redirect( TMM_Helper::get_permalink_by_lang( TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX), array('car_was_edited' => $post_id) ) );
}

get_header();

if (!empty($_POST)) {
    if (get_post_field('post_author', $post_id) == $user_id) {
        TMM_Ext_PostType_Car::save($post_id);
    }
}

if (is_user_logged_in() && $post_id > 0 && get_post_field('post_author', $post_id) == $user_id){

    $car_data = TMM_Ext_PostType_Car::get_car_data($post_id);
    $data = array();
    $data['post_id'] = $post_id;
    $data['photo_set_hash'] = $post_id;
    $data['user'] = get_userdata($user_id);
    $data['car_cover_image'] = tmm_get_car_cover_image($post_id, 'thumb');
    $data['user_photo_set'] = TMM_Ext_PostType_Car::get_post_photos($post_id, $user_id);
    $data['user_photo_set_thumbs'] = TMM_Ext_PostType_Car::get_post_photos($post_id, $user_id, 'thumb');
    ?>

    <h2 class="section-title">
	    <?php tmm_get_car_title($post_id, 1); ?>
	</h2>

    <form id="save_edited_car" class="form-edit-ad" action="" method="post" name="save_edited_car">

        <?php
        echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/car_photos.php', $data);
        echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/car_attributes.php', $car_data);
        ?>

        <input type="submit" class="input-save-edit button orange big" name="car_was_edited" value="<?php _e('Update Vehicle', 'cardealer'); ?>" />

    </form>

    <?php
}
?>

<script type="text/javascript">

    jQuery(function() {
        jQuery(".option_checkbox").life('click', function() {
            if (jQuery(this).is(":checked")) {
                jQuery(this).prev("input[type=hidden]").val(1);
                jQuery(this).next("input[type=hidden]").val(1);
            } else {
                jQuery(this).prev("input[type=hidden]").val(0);
                jQuery(this).next("input[type=hidden]").val(0);
            }
        });
    });

</script>

<?php get_footer(); ?>

