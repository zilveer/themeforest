<?php
if(!class_exists('MET_Testimonial_Ticker')) {
	class MET_Testimonial_Ticker extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Testimonials',
				'size' => 'span12'
			);

			parent::__construct('MET_Testimonial_Ticker', $block_options);

			add_action('wp_ajax_aq_block_teti_add_new', array($this, 'add_tab'));

		}

		function form($instance) {

			$defaults = array(
				'title' 		=> '',
				'sub_title'		=> '',
				'tabs' => array(
					1 => array(
						'title' 			=> 'Customer #1',
						'customer_name'		=> '',
						'avatar'			=> '',
						'customer_comment'	=> ''
					)
				)
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
						$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
						$count = 1;
						foreach($tabs as $tab) {
							$this->teti($tab, $count);
							$count++;
						}
					?>
				</ul>
				<p></p>
				<a href="#" rel="teti" class="aq-sortable-add-new button">Add New Customer</a>
				<p></p>
			</div>
		<?php
		}

		function teti($tab = array(), $count = 0) {

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
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-customer_name">
							Customer Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-customer_name" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][customer_name]" value="<?php echo $tab['customer_name'] ?>" />
						</label>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-avatar">
							Customer Photo<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-avatar" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][avatar]" value="<?php echo $tab['avatar'] ?>">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
						<?php if($tab['avatar']) { ?>
							<div class="screenshot">
								<img src="<?php echo $tab['avatar'] ?>" />
							</div>
							<div style="clear: both"></div>
						<?php } ?>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-customer_comment">
							Customer Comment<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-customer_comment" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][customer_comment]" value="<?php echo $tab['customer_comment'] ?>" />
						</label>
					</div>
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>

			</li>
		<?php
		}

		function block($instance) {
			extract($instance);

			$widget_id = uniqid('met_testimonial_');
?>

			<div id="<?php echo $widget_id ?>" class="met_testimonials">
				<div class="met_testimonial_photos clearfix">
					<?php foreach( $tabs as $tab ): ?>
					<div class="met_testimonial">
						<div class="met_testimonial_photo">
							<img src="<?php echo $tab['avatar'] ?>" alt="<?php echo esc_attr($tab['customer_name']) ?>"/>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="met_testimonial_messages">
					<?php foreach( $tabs as $tab ): ?>
					<div>
						<?php if(!empty($tab['title'])): ?><h2><b><?php echo $tab['title'] ?></b></h2><?php endif; ?>
						<?php echo $tab['customer_comment'] ?>
						<?php if(!empty($tab['customer_name'])): ?><br><h3 class="met_color"><b><?php echo $tab['customer_name'] ?></b></h3><?php endif; ?>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
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
				'title' 			=> 'Customer #'.$count,
				'customer_name' 	=> '',
				'avatar'			=> '',
				'customer_comment'	=> ''
			);

			if($count) {
				$this->teti($tab, $count);
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
