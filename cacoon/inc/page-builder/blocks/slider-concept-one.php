<?php
if(!class_exists('MET_Concept_Slider_One')) {
	class MET_Concept_Slider_One extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Slider C-1',
				'size' => 'span12'
			);

			//create the widget
			parent::__construct('MET_Concept_Slider_One', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_cso_add_new', array($this, 'add_tab'));

		}

		function form($instance) {

			$defaults = array(
				'auto_play'				=> 'true',
				'circular'				=> 'true',
				'infinite'				=> 'true',
				'pauseduration'			=> '0',
				'navigation'			=> 'true',
				'duration'				=> '2000',

				'tabs' => array(
					1 => array(
						'title' 		=> 'Slider Item #1',
						'title_sub' 	=> '',
						'content' 		=> '',
						'button_text' 	=> '',
						'button_link' 	=> '',
						'image' 		=> '',
						'image_link' 	=> 'http://'
					)
				)

			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$bool_options = array('false' => 'FALSE' , 'true' => 'TRUE');

			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('auto_play') ?>">
					Auto Play<br/>
					<?php echo aq_field_select('auto_play', $block_id, $bool_options, $auto_play) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('duration') ?>">
					Auto Play (Duration)<br/>
					<?php echo aq_field_input('duration', $block_id, $duration) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('pauseduration') ?>">
					Auto Play (Pause Duration)<br/>
					<?php echo aq_field_input('pauseduration', $block_id, $pauseduration) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('circular') ?>">
					Circular<br/>
					<?php echo aq_field_select('circular', $block_id, $bool_options, $circular) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('infinite') ?>">
					Infinite<br/>
					<?php echo aq_field_select('infinite', $block_id, $bool_options, $infinite) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('navigation') ?>">
					Show Navigation<br/>
					<?php echo aq_field_select('navigation', $block_id, $bool_options, $navigation) ?>
				</label>
			</p>

			<div class="description cf">
				<label for="<?php echo $this->get_field_id('infinite') ?>">Slider Items</label>
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {
						$this->cso($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="cso" class="aq-sortable-add-new button">Add New Slide</a>
				<p></p>
			</div>
		<?php
		}

		function cso($tab = array(), $count = 0) {

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
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_sub">
							Title (Secondary)<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_sub" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title_sub]" value="<?php echo $tab['title_sub'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-image">
							Background Image<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]" value="<?php echo $tab['image'] ?>">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
						<?php if($tab['image']) { ?>
							<div class="screenshot">
								<img src="<?php echo $tab['image'] ?>" />
							</div>
							<div style="clear: both"></div>
						<?php } ?>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-image_link">
							Image Link<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-image_link" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image_link]" value="<?php echo $tab['image_link'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
							Content<br/>
							<textarea name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="input-full"><?php echo $tab['content'] ?></textarea>
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-button_text">
							Button Text<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-button_text" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][button_text]" value="<?php echo $tab['button_text'] ?>" />
						</label>
					</div>
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-button_link">
							Button Link<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-button_link" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][button_link]" value="<?php echo $tab['button_link'] ?>" />
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

			$widgetID = uniqid('met_concept_slider_');
?>
			<div class="row-fluid">
				<div class="span12">
					<div class="met_slider_wrap">
						<div id="<?php echo $widgetID ?>" class="met_slider clearfix">
							<?php foreach( $tabs as $tab ): ?>
								<div class="met_slider_item clearfix">
									<div class="met_slider_item_preview"><a href="<?php echo $tab["image_link"] ?>"><img src="<?php echo $tab["image"] ?>" alt="<?php echo esc_attr($tab["title"]) ?>"></a></div>
									<article class="met_slider_item_caption met_bgcolor4 met_color2">
										<div>
											<?php if(!empty($tab["title"])): ?><h2 class="met_title_stack"><?php echo $tab["title"] ?></h2><?php endif; ?>
											<?php if(!empty($tab["title_sub"])): ?><h3 class="met_title_stack met_bold_one"><?php echo $tab["title_sub"] ?></h3><br><?php endif; ?>
											<?php if(!empty($tab["content"])): ?><p><?php echo htmlspecialchars_decode($tab["content"]) ?></p><?php endif; ?>
											<?php if(!empty($tab["button_text"])): ?><br><a href="<?php echo $tab["button_link"] ?>" class="met_bgcolor met_button"><?php echo $tab["button_text"] ?></a><?php endif; ?>
										</div>
									</article>
								</div>
							<?php endforeach; ?>
						</div>
						<?php if($navigation == 'true'): ?>
						<a href="#" class="met_slider_nav_prev met_bgcolor met_bgcolor_transition2 met_color2"><i class="icon-chevron-left"></i></a>
						<a href="#" class="met_slider_nav_next met_bgcolor met_bgcolor_transition2 met_color2"><i class="icon-chevron-right"></i></a>
						<?php endif; ?>
						<div class="met_slider_overlay"></div>
					</div>
				</div>
			</div><!-- Slider Ends  -->

			<script>
				jQuery(window).load(function(){
					jQuery("#<?php echo $widgetID ?>").carouFredSel({
						responsive: true,
						prev: { button : function(){ return jQuery(this).parents('.met_slider_wrap').find('.met_slider_nav_prev') } },
						next:{ button : function(){ return jQuery(this).parents('.met_slider_wrap').find('.met_slider_nav_next') } },
						circular: <?php echo $circular ?>,
						infinite: <?php echo $infinite ?>,
						auto: { play : <?php echo $auto_play ?>, pauseDuration: <?php echo $pauseduration ?>, duration: <?php echo $duration ?> },
						scroll: { items: 1, duration: 400, wipe: true, pauseOnHover: true, fx: 'crossfade' },
						items: { visible: { min: 1, max: 1 }, height: 'variable' },
						onCreate: function(){
							jQuery(this).parents('.met_slider_wrap').find('.met_slider_overlay').fadeOut('fast',function(){
								jQuery(this).remove();
							});
						}
					});
				});
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
				'title' 		=> 'Slider Item #'.$count,
				'title_sub' 	=> '',
				'content' 		=> '',
				'button_text' 	=> '',
				'button_link' 	=> '',
				'image' 		=> '',
				'image_link' 	=> 'http://'
			);

			if($count) {
				$this->cso($tab, $count);
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
