<?php
if(!class_exists('MET_Icon_Tabs_Block')) {
	class MET_Icon_Tabs_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Tabs (Icon)',
				'size' => 'span6',
			);

			parent::__construct('MET_Icon_Tabs_Block', $block_options);

			add_action('wp_ajax_aq_block_tabi_add_new', array($this, 'add_tab'));
		}

		function form($instance) {

			$defaults = array(
				'tabs' => array(
					1 => array(
						'icon' => 'icon-circle-blank',
						'content' => 'My tab contents',
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
						$this->tabi($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="tabi" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
		<?php
		}

		function tabi($tab = array(), $count = 0) {

			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">

				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $tab['icon'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>

				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon">
							Tab Icon (<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Icon List</a> )<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][icon]" value="<?php echo $tab['icon'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
							Tab Content<br/>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $tab['content'] ?></textarea>
						</label>
					</p>
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>

			</li>
		<?php
		}

		function block($instance) {
			extract($instance);

			$widgetID = uniqid('met_icon_tab_');
?>

			<div class="row-fluid">
				<div class="span12">
					<div id="<?php echo $widgetID ?>" class="met_icon_tabs">

						<nav class="met_bgcolor5 clearfix">
							<?php $i=1; foreach( $tabs as $tab ): ?>
							<a href="#tab_<?php echo $tab['icon'].'-'.$i ?>" <?php echo (($i==1) ? 'class="met_active_tab"' : '') ?>><i class="<?php echo $tab['icon'] ?>"></i></a>
							<?php $i++; endforeach; ?>
						</nav>

						<div class="met_icon_tabs_descrs">
							<?php $i=1; foreach( $tabs as $tab ): ?>
								<article id="tab_<?php echo $tab['icon'].'-'.$i ?>" <?php echo (($i==1) ? 'class="met_open_tab"' : '') ?>>
									<?php echo do_shortcode(htmlspecialchars_decode($tab['content'])) ?>
								</article>
							<?php $i++; endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<script>
				jQuery(document).ready(function(){
					jQuery('#<?php echo $widgetID ?> nav a').click(function(e){
						e.preventDefault();
						if(!jQuery(this).hasClass('met_active_tab')){
							var tabContainer = jQuery(this).parents('.met_icon_tabs');
							var href = jQuery(this).attr('href');

							tabContainer.find('.met_active_tab').removeClass('met_active_tab');
							tabContainer.find('.met_open_tab').removeClass('met_open_tab');

							jQuery(this).addClass('met_active_tab');
							jQuery(this).addClass('met_active_tab');

							tabContainer.find(href).addClass('met_open_tab');
						}
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
				'icon' => 'icon-circle-blank',
				'content' => ''
			);

			if($count) {
				$this->tabi($tab, $count);
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
