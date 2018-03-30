<?php
if(!class_exists('MET_Logo_Carousel')) {
	class MET_Logo_Carousel extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Logo Carousel',
				'size' => 'span12'
			);

			//create the widget
			parent::__construct('MET_Logo_Carousel', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_lc_add_new', array($this, 'add_tab'));

		}

		function form($instance) {

			$defaults = array(
				'widget_title' => 'Client Partners',
				'tabs' => array(
					1 => array(
						'title' => 'Logo #1',
						'logo' => '',
						'logo_link' => 'http://'
					)
				)
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('widget_title') ?>">
					Widget Title<br/>
					<?php echo aq_field_input('widget_title', $block_id, $widget_title,'full','text') ?>
				</label>
			</p>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {
						$this->lc($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="lc" class="aq-sortable-add-new button">Add New Logo</a>
				<p></p>
			</div>
		<?php
		}

		function lc($tab = array(), $count = 0) {

			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">

				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $tab['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>

				<div class="sortable-body">
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</label>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-logo">
							Logo Image<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-logo" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][logo]" value="<?php echo $tab['logo'] ?>">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
						<?php if($tab['logo']) { ?>
							<div class="screenshot">
								<img src="<?php echo $tab['logo'] ?>" />
							</div>
							<div style="clear: both"></div>
						<?php } ?>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-logo_link">
							Link<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-logo_link" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][logo_link]" value="<?php echo $tab['logo_link'] ?>" />
						</label>
					</div>
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>

			</li>
		<?php
		}

		function block($instance) {
			extract($instance);
			wp_enqueue_script('metcreative-caroufredsel');
			wp_enqueue_style('metcreative-caroufredsel');

			$widget_id = uniqid('met_carousel_');
?>

<div class="row-fluid scrolled">
	<div class="span12 scrolled__item">
		<div class="<?php echo $widget_id ?> met_brand_carousel_wrap">
			<div class="met_brand_carousel">

			<?php
				$i = 1;
				foreach( $tabs as $tab ){
					echo '<a href="'.$tab["logo_link"].'" title="'.esc_attr($tab["title"]).'"><img src="'.$tab["logo"].'" alt="'.esc_attr($tab["title"]).'" /></a>';
					$i++;
				}
			?>

			</div>
			<a href="#" class="met_recent_works_nav_prev"><i class="icon-chevron-left"></i></a>
			<a href="#" class="met_recent_works_nav_next"><i class="icon-chevron-right"></i></a>
		</div>
	</div>
</div>
<script>
	jQuery(window).load(function(){
		jQuery(".<?php echo $widget_id ?> .met_brand_carousel").carouFredSel({
			scroll	: {
				items			: 1,
				duration		: 1000,
				timeoutDuration	: 2000
			},
			auto	: false,
			prev	: ".<?php echo $widget_id ?> .met_recent_works_nav_prev",
			next	: ".<?php echo $widget_id ?> .met_recent_works_nav_next"
		});
	})
</script>

<?php

		}

		/* AJAX add tab */
		function add_tab() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');

			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			//default key/value for the tab
			$tab = array(
				'title' => 'Logo #'.$count,
				'logo' => '',
				'logo_link' => 'http://'
			);

			if($count) {
				$this->lc($tab, $count);
			} else {
				die(-1);
			}

			die();
		}

		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
