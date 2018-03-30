<?php
if(!class_exists('MET_Concept_Slider_Two')) {
	class MET_Concept_Slider_Two extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Slider C-2',
				'size' => 'span12'
			);

			//create the widget
			parent::__construct('MET_Concept_Slider_Two', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_csot_add_new', array($this, 'add_tab'));

		}

		function form($instance) {

			$defaults = array(
				'auto_play'				=> 'true',
				'circular'				=> 'true',
				'infinite'				=> 'true',
				'pauseduration'			=> '5000',
				'navigation'			=> 'true',
				'duration'				=> '300',
				'border_color'			=> '#7E8A96',

				'tabs' => array(
					1 => array(
						'title' 				=> 'Slider Item #1',
						'titlebg'				=> '#7E8A96',
						'titlefg'				=> '#FFFFFF',
						'title_arrow_link' 		=> '',
						'title_arrow_linkbg'	=> '#18ADB5',
						'title_arrow_linkfg'	=> '#FFFFFF',
						'title_sub' 			=> '',
						'image' 				=> '',
						'vposition'				=> 'top',
						'hposition'				=> 'left',
						'title_visibility'		=> '0',
						'thumbnail'				=> ''
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
					Show Thumbnails?<br/>
					<?php echo aq_field_select('navigation', $block_id, $bool_options, $navigation) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('border_color') ?>">
					Slider Border Color<br/>
					<?php echo aq_field_color_picker('border_color', $block_id, $border_color, '#7E8A96') ?>
				</label>
			</p>

			<div class="description cf">
				<label for="<?php echo $this->get_field_id('infinite') ?>">Slider Items</label>
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {
						$this->csot($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="csot" class="aq-sortable-add-new button">Add New Slide</a>
				<p></p>
			</div>
		<?php
		}

		function csot($tab = array(), $count = 0) {

			$title_vpositions 	= array('top'=>'Top','bottom'=>'Bottom');
			$title_hpositions 	= array('left'=>'Left','right'=>'Right');
			$title_visible 		= array('0'=>'Hide','1'=>'Show');

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

					<div class="tab-desc description half">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-titlebg">
							Title Background Color<br/>
							<div class="aqpb-color-picker">
								<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-titlebg" class="input-color-picker" value="<?php echo $tab['titlebg'] ?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][titlebg]" data-default-color="#7E8A96"/>
							</div>
						</label>
					</div>

					<div class="tab-desc description half last">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-titlefg">
							Title Text Color<br/>
							<div class="aqpb-color-picker">
								<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-titlefg" class="input-color-picker" value="<?php echo $tab['titlefg'] ?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][titlefg]" data-default-color="#FFFFFF"/>
							</div>
						</label>
					</div>

					<hr>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_arrow_link">
							Title Arrow Link<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_arrow_link" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title_arrow_link]" value="<?php echo $tab['title_arrow_link'] ?>" />
						</label>
					</div>

					<div class="tab-desc description half">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_arrow_linkbg">
							Title Arrow Background Color<br/>
							<div class="aqpb-color-picker">
								<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_arrow_linkbg" class="input-color-picker" value="<?php echo $tab['title_arrow_linkbg'] ?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title_arrow_linkbg]" data-default-color="#18ADB5"/>
							</div>
						</label>
					</div>

					<div class="tab-desc description half last">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_arrow_linkfg">
							Title Arrow Color<br/>
							<div class="aqpb-color-picker">
								<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_arrow_linkfg" class="input-color-picker" value="<?php echo $tab['title_arrow_linkfg'] ?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title_arrow_linkfg]" data-default-color="#FFFFFF"/>
							</div>
						</label>
					</div>

					<hr>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_sub">
							Title (Secondary)<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_sub" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title_sub]" value="<?php echo $tab['title_sub'] ?>" />
						</label>
					</div>

					<!-- -->
					<p class="tab-desc description fourth">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-vposition">
							Title Position (Vertical)<br/>
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-vposition" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][vposition]">
								<?php foreach($title_vpositions as $vposVAL => $vposTITLE): ?>
									<option <?php echo (($vposVAL == $tab['vposition']) ? 'selected=""' : '') ?> value="<?php echo $vposVAL ?>"><?php echo $vposTITLE ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</p>

					<p class="tab-desc description fourth">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-hposition">
							Title Position (Horizontal)<br/>
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-hposition" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][hposition]">
								<?php foreach($title_hpositions as $hposVAL => $hposTITLE): ?>
									<option <?php echo (($hposVAL == $tab['hposition']) ? 'selected=""' : '') ?> value="<?php echo $hposVAL ?>"><?php echo $hposTITLE ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</p>

					<p class="tab-desc description half last">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_visibility">
							Show titles on slider item?<br/>
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title_visibility" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title_visibility]">
								<?php foreach($title_visible as $visVAL => $visTITLE): ?>
									<option <?php echo (($visVAL == $tab['title_visibility']) ? 'selected=""' : '') ?> value="<?php echo $visVAL ?>"><?php echo $visTITLE ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</p>
					<!-- -->

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
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-thumbnail">
							Custom Thumbnail (optional)<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-thumbnail" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][thumbnail]" value="<?php echo $tab['thumbnail'] ?>">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
						<?php if($tab['thumbnail']) { ?>
							<div class="screenshot">
								<img src="<?php echo $tab['thumbnail'] ?>" />
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

			wp_enqueue_script('metcreative-caroufredsel');
			wp_enqueue_style('metcreative-caroufredsel');

			$widgetID = uniqid('met_concept_slider_two_');

			/*
			 * Create Custom Styles for slider
			 * */

			$custom_slider_style[$widgetID] = array();
			$i=1; foreach( $tabs as $tab ){
				if(strtoupper($tab['titlebg']) != '#7E8A96'){
					$custom_slider_style[$widgetID][] = '.'.$widgetID.'_'.$i.'_title{background-color:'.$tab['titlebg'].'!important}';
				}

				if(strtoupper($tab['titlefg']) != '#FFFFFF'){
					$custom_slider_style[$widgetID][] = '.'.$widgetID.'_'.$i.'_title{color:'.$tab['titlefg'].'!important}';
				}

				if(strtoupper($tab['title_arrow_linkbg']) != '#18ADB5'){
					$custom_slider_style[$widgetID][] = '.'.$widgetID.'_'.$i.'_arrow{background-color:'.$tab['title_arrow_linkbg'].'!important}';
				}

				if(strtoupper($tab['title_arrow_linkfg']) != '#FFFFFF'){
					$custom_slider_style[$widgetID][] = '.'.$widgetID.'_'.$i.'_title a:after{color:'.$tab['title_arrow_linkfg'].'!important}';
				}

				$i++;
			}

			if(strtoupper($border_color) != '#7E8A96'){
				$custom_slider_style[$widgetID][] = '#'.$widgetID.'{background-color:'.$border_color.'!important}';
			}


			if($custom_slider_style[$widgetID]){
				echo '<style>';
				foreach($custom_slider_style[$widgetID] as $custom_slider_style_item){
					echo $custom_slider_style_item."\r\n";
				}
				echo '</style>';
			}

			/* +-+-+-+-+-+-+-+-+-+-+-+-+--+-+- */
?>
			<div class="row-fluid">
				<div class="span12">
					<div id="<?php echo $widgetID ?>" class="met_thumbnail_slider_1_wrap met_thumbnail_slider_1_wrap_loading met_bgcolor4 clearfix">

						<div class="met_thumbnail_slider_1_big">
							<div class="met_thumbnail_slider_1_images">
								<?php $i=1; foreach( $tabs as $tab ): ?>
								<div data-slider-format="big-1-<?php echo $i ?>">
									<img src="<?php echo $tab['image'] ?>" />

									<?php if($tab['title_visibility'] == '1'): ?>
									<div class="met_thumbnail_slider_1_effects met_thumbnail_slider_1_effects_<?php echo $tab['hposition'] ?> met_thumbnail_slider_1_<?php echo $tab['vposition'] ?>">
										<div class="met_thumbnail_slider_1_title met_bgcolor4 <?php echo $widgetID.'_'.$i.'_title' ?>">
											<?php echo $tab['title'] ?>
											<?php if(!empty($tab['title_arrow_link'])): ?><a href="<?php echo $tab['title_arrow_link'] ?>" class="met_bgcolor met_color2 met_bgcolor_transition2 <?php echo $widgetID.'_'.$i.'_arrow' ?>"></a><?php endif; ?>
										</div>
										<?php if(!empty($tab['title_sub'])): ?><div class="met_thumbnail_slider_1_subtitle met_bgcolor5_trans"><?php echo $tab['title_sub'] ?></div><?php endif; ?>
									</div>
									<?php endif; ?>

								</div>
								<?php $i++; endforeach; ?>
							</div>
						</div>

						<?php if($navigation == 'true'): ?>
						<div class="met_thumbnail_slider_1_small">
							<div class="met_thumbnail_slider_1_images">
								<?php $i=1; foreach( $tabs as $tab ): ?>
									<?php
										$item_thumbnail = '';
										if(empty($tab['thumbnail'])){
											$item_thumbnail = aq_resize($tab['image'],120,120,true);
										}else{
											$item_thumbnail = $tab['thumbnail'];
										}
									?>
									<img src="<?php echo $item_thumbnail ?>" data-slider-format="small-1-<?php echo $i ?>" />
								<?php $i++; endforeach; ?>
							</div>
						</div>
						<?php endif; ?>

						<div class="met_thumbnail_slider_1_overlay"></div>
					</div>
				</div>
			</div>

			<script>
				jQuery(window).load(function(){
					var $big = jQuery('#<?php echo $widgetID ?> .met_thumbnail_slider_1_big .met_thumbnail_slider_1_images');
					<?php if($navigation == 'true'): ?>var $small = jQuery('#<?php echo $widgetID ?> .met_thumbnail_slider_1_small .met_thumbnail_slider_1_images');<?php endif; ?>

					$big.carouFredSel({
						auto: {play : <?php echo $auto_play ?>, pauseDuration: <?php echo $pauseduration ?>, duration: <?php echo $duration ?>},
						circular: <?php echo $circular ?>,
						infinite: <?php echo $infinite ?>,
						direction: 'up',
						scroll: {
							items: 1,
							duration: 300,
							pauseOnHover: true,
							onBefore: function( data ) {

								var item = data.items.visible.first();
								var src = item.data( 'slider-format' ).split( '-' )[ 2 ];

								jQuery('.met_active_title').removeClass('met_active_title');

								if(src == 'a' && !item.hasClass('met_first_slide')){
									jQuery('.met_thumbnail_slider_1_next').trigger('click');
								}else if(item.hasClass('met_first_slide')){
									item.removeClass('met_first_slide');
								}
							},
							onAfter: function( data ){

								var item = data.items.visible.first();

								item.find('.met_thumbnail_slider_1_title,.met_thumbnail_slider_1_subtitle').addClass('met_active_title');

							}
						},
						items: {
							width: 'variable'
						},
						prev: {
							duration: 'auto'
						},
						next: {
							duration: 'auto'
						},
						onCreate: function( data ){
							var item = data.items.first();
							item.find('.met_thumbnail_slider_1_title,.met_thumbnail_slider_1_subtitle').addClass('met_active_title');
							jQuery(this).parents('.met_thumbnail_slider_1_wrap').removeClass('met_thumbnail_slider_1_wrap_loading');
							jQuery(this).parents('.met_thumbnail_slider_1_wrap').find('.met_thumbnail_slider_1_overlay').fadeOut('fast',function(){
								jQuery(this).remove();
							});
						}
					});

					<?php if($navigation == 'true'): ?>
					$small.carouFredSel({
						align: 'left',
						width: 'variable',
						auto: false,
						items:  4,
						scroll: {
							items: 'variable',
							duration: 300,
							onBefore: function( data ) {
								var item = data.items.visible.first();
								var src = item.data( 'slider-format' ).split( 'small-' )[ 1 ];
								$big.trigger( 'slideTo', [ '[data-slider-format="big-' + src + '"]', {
									fx: 'directscroll',
									duration: 300
								} ] );
							}
						}
					});

					jQuery('.met_thumbnail_slider_1_small img').click(function() {
						if ( $big.triggerHandler( 'isScrolling' ) ) {
							return false;
						}
						var src = jQuery(this).data( 'slider-format' ).split( 'small-' )[ 1 ];
						var isA = jQuery(this).data( 'slider-format' ).split( '-' )[ 2 ];

						if(isA == 'a'){jQuery('[data-slider-format="big-' + src + '"]').addClass('met_first_slide');}

						$big.trigger( 'slideTo', [ '[data-slider-format="big-' + src + '"]' ] );

						return false;
					});
					<?php endif; ?>
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
				'title' 				=> 'Slider Item #'.$count,
				'titlebg'				=> '#7E8A96',
				'titlefg'				=> '#FFFFFF',
				'title_arrow_link' 		=> '',
				'title_arrow_linkbg'	=> '#18ADB5',
				'title_arrow_linkfg'	=> '#FFFFFF',
				'title_sub' 			=> '',
				'image' 				=> '',
				'vposition'				=> 'top',
				'hposition'				=> 'left',
				'title_visibility'		=> '0',
				'thumbnail'				=> ''
			);

			if($count) {
				$this->csot($tab, $count);
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
