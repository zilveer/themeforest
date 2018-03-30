<?php //since: v2
if(!class_exists('MET_Gallery')) {
	class MET_Gallery extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Gallery',
				'size' => 'span12'
			);

			//create the widget
			parent::__construct('MET_Gallery', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_mg_add_new', array($this, 'add_tab'));

		}

		function form($instance) {

			$defaults = array(
				'tabs' => array(
					1 => array(
						'title'			=> 'Gallery Item #1',
						'photo'			=> ''
					)
				)
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>

			<p></p>
			<div class="description cf">
				Gallery Images
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {
						$this->mg($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="mg" class="aq-sortable-add-new button">Add New Gallery Item</a>
				<p></p>
			</div>
		<?php
		}

		function mg($tab = array(), $count = 0) {

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
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-photo">
							Photo<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-photo" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][photo]" value="<?php echo $tab['photo'] ?>">
							<a href="#" class="aq_upload_button button" rel="image">Select Or Upload Photo</a><p></p>
						</label>
						<?php if($tab['photo']) { ?>
							<div class="screenshot">
								<img src="<?php echo $tab['photo'] ?>" />
							</div>
							<div style="clear: both"></div>
						<?php } ?>
					</div>
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>

			</li>
		<?php
		}

		function block($instance) {
			extract($instance);

			wp_enqueue_style('metcreative-magnific-popup');
			wp_enqueue_script('metcreative-magnific-popup');

			$gallery_id = uniqid('MET_gal_');
?>

			<div id="<?php echo $gallery_id ?>" class="row-fluid met_gallery">

				<?php foreach( $tabs as $tab ): ?>
				<div class="span3">
					<div class="met_gallery_wrap clearfix">
						<a href="#"><img src="<?php echo aq_resize($tab['photo'],270,270,true) ?>" alt="<?php echo esc_attr($tab['title']) ?>"></a>
						<div class="met_gallery_overlay met_bgcolor6_trans">
							<a href="<?php echo $tab['photo'] ?>" class="met_bgcolor met_bgcolor_transition2 met_color2" rel="lb_<?php echo $gallery_id ?>" title="<?php echo esc_attr($tab['title']) ?>"><i class="icon-picture"></i></a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
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
				'title' 		=> 'Gallery Item #'.$count,
				'photo'			=> ''
			);

			if($count) {
				$this->mg($tab, $count);
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
