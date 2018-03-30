<?php
/** Staff block **/
class Team_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Team Member',
			'size' => 'span3',
		);
		
		//create the block
		parent::__construct('team_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'position' => '',
			'media' => '',
			'text' => '',
			'url' => '',
			'fb' => '',
			'twitter' => '',
			'gplus' => '',
			'email' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<div class="description half">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Name
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('position') ?>">
				Title
				<?php echo aq_field_input('position', $block_id, $position, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('media') ?>">
				Upload Photo
				<?php echo aq_field_upload('media', $block_id, $media, 'image') ?>
				<em style="font-size: 0.8em; padding-left: 5px;">Recommended size: 400 x 400 pixel</em>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('url') ?>">
				Link Photo To URL
				<?php echo aq_field_input('url', $block_id, $url, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Description
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('fb') ?>">
				Facebook Profile
				<?php echo aq_field_input('fb', $block_id, $fb, $size = 'full') ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('twitter') ?>">
				Twitter Profile
				<?php echo aq_field_input('twitter', $block_id, $twitter, $size = 'full') ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('gplus') ?>">
				Google Profile
				<?php echo aq_field_input('gplus', $block_id, $gplus, $size = 'full') ?>
			</label>
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('email') ?>">
				Email
				<?php echo aq_field_input('email', $block_id, $email, $size = 'full') ?>
			</label>
		</div>

		<?php
	}
	
	function block($instance) {
		extract($instance);

		?>

		<div class="profile centered">
			<?php if (!empty($media)) { 
				$attachid = get_image_id(esc_url($media));
			}
			?> 
			<div class="post-item">
		   		<div class="item-inner">
		   			<?php echo wp_get_attachment_image($attachid , 'small-square'); ?>
		            <?php if(!empty($url)) { ?>
		            <div class="overlay">
		                <a class="preview btn btn-outlined btn-primary" href="<?php echo esc_url($url); ?>" title="<?php echo strip_tags($title); ?>"><i class="fa fa-link"></i></a>          
		            </div>     
		            <?php } ?>
		        </div>
	        </div>

            <h3 class="profile-name"><?php echo strip_tags($title); ?><br/><small><?php echo strip_tags($position); ?></small></h3>

            <?php echo wpautop(do_shortcode(mpt_content_kses(htmlspecialchars_decode($text)))); ?>

            <div class="social">
                <ul class="team-social">
                	<?php if (!empty($fb)) { ?> 
                    	<li class="twitter"><a href="<?php echo esc_url($fb); ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php } ?>
                    <?php if (!empty($twitter)) { ?>
                    	<li class="facebook"><a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php } ?>
                    <?php if (!empty($gplus)) { ?> 
                    	<li class="google-plus"><a href="<?php echo esc_url($gplus); ?>"><i class="fa fa-google-plus"></i></a></li>
                    <?php } ?>
                    <?php if (!empty($email) && is_email($email) != 'false') { ?> 
                    	<li class="envelope"><a href="<?php echo esc_url($email); ?>"><i class="fa fa-envelope"></i></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

		<?php
	}
	
}