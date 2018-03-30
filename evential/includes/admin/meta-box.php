<?php
//==========================================
// Team Meta Box
//==========================================
class team_meta_box_plugin {
  function __construct() {
    add_action( 'add_meta_boxes', array( $this, 'our_team_meta_box' ) );
  }
  function our_team_meta_box()
	{
		add_meta_box('our_schedule', __('Extra Information', 'evential'), 'our_team_meta_action', 'team', 'advanced', 'high' );
	}
}
new team_meta_box_plugin();

function our_team_meta_action($post) { ?>
    <?php $designation = get_post_meta($post->ID, 'designation', true); ?>
    <div class="meta_tr"><div class="meta_lable">Designation</div><div class="meta_field"><input type="text" name="designation" value="<?php echo esc_attr($designation); ?>"></div></div>
    <?php $facebook = get_post_meta($post->ID, 'facebook', true); ?>
    <div class="meta_tr"><div class="meta_lable">Facebook</div><div class="meta_field"><input type="text" name="facebook" value="<?php echo esc_attr($facebook); ?>"></div></div>
    <?php $linkedin = get_post_meta($post->ID, 'linkedin', true); ?>
    <div class="meta_tr"><div class="meta_lable">Linked In</div><div class="meta_field"><input type="text" name="linkedin" value="<?php echo esc_attr($linkedin); ?>"></div></div>
    <?php $google = get_post_meta($post->ID, 'google', true); ?>
    <div class="meta_tr"><div class="meta_lable">Google Plus</div><div class="meta_field"><input type="text" name="google" value="<?php echo esc_attr($google); ?>"></div></div>
    <?php $twitter = get_post_meta($post->ID, 'twitter', true); ?>
    <div class="meta_tr"><div class="meta_lable">Twitter</div><div class="meta_field"><input type="text" name="twitter" value="<?php echo esc_attr($twitter); ?>"></div></div>
    <div class="clr"></div>
<?php 
}

add_action( 'save_post', 'save_team_extra_info' );
function save_team_extra_info($post_ID)
{
    global $post;
    if(isset($_POST))
    {
        if(isset($_POST['designation']))
        {
            update_post_meta( $post_ID, 'designation', strip_tags($_POST['designation']) );
        }
        if(isset($_POST['facebook']))
        {
            update_post_meta( $post_ID, 'facebook', strip_tags($_POST['facebook']) );
        }
        if(isset($_POST['linkedin']))
        {
            update_post_meta( $post_ID, 'linkedin', strip_tags($_POST['linkedin']) );
        }
        if(isset($_POST['google']))
        {
            update_post_meta( $post_ID, 'google', strip_tags($_POST['google']) );
        }
        if(isset($_POST['twitter']))
        {
            update_post_meta( $post_ID, 'twitter', strip_tags($_POST['twitter']) );
        }
        
    }
}

//==========================================
// Schedule Meta Box
//==========================================
class schedule_meta_box_plugin {
  function __construct() {
    add_action( 'add_meta_boxes', array( $this, 'our_schedule_meta_box' ) );
  }
  function our_schedule_meta_box()
	{
		add_meta_box('our_schedule', __('Extra Information', 'evential'), 'our_schedule_meta_action', 'schedule', 'advanced', 'high' );
	}
}
new schedule_meta_box_plugin();

function our_schedule_meta_action($post) { ?>
    <?php $tname = get_post_meta($post->ID, 'tname', true); ?>
    <div class="meta_tr"><div class="meta_lable">Teacher Name</div><div class="meta_field"><input type="text" name="tname" value="<?php echo esc_attr($tname); ?>"></div></div>
    <?php $iclass = get_post_meta($post->ID, 'iclass', true); ?>
    <div class="meta_tr"><div class="meta_lable">Font-Awesome Icon Class</div><div class="meta_field"><input type="text" name="iclass" value="<?php echo esc_attr($iclass); ?>"></div></div>
    <div class="clr"></div>
	<?php $stime = get_post_meta($post->ID, 'stime', true); ?>
    <div class="meta_tr"><div class="meta_lable">Schedule Time</div><div class="meta_field"><input type="text" name="stime" value="<?php echo esc_attr($stime); ?>"></div></div>
    <div class="clr"></div>
<?php 
}

add_action( 'save_post', 'save_schedule_extra_info' );
function save_schedule_extra_info($post_ID)
{
    global $post;
    if(isset($_POST))
    {
        if(isset($_POST['tname']))
        {
            update_post_meta( $post_ID, 'tname', strip_tags($_POST['tname']) );
        }
        if(isset($_POST['iclass']))
        {
            update_post_meta( $post_ID, 'iclass', strip_tags($_POST['iclass']) );
        }
		if(isset($_POST['stime']))
        {
            update_post_meta( $post_ID, 'stime', strip_tags($_POST['stime']) );
        }
    }
}