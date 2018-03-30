<?php
class MET_Info_Box_Photo extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'InfoBox (Image)',
			'size' => 'span6'
		);

		parent::__construct('MET_Info_Box_Photo', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'title'				=> '',
			'title_sub'			=> '',
			'image'				=> '',
			'image_lightbox'	=> 'true',
			'text' 				=> '',
			'contentbox_bg'		=> '#A4AEB9'
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$bool_options = array('false' => 'FALSE' , 'true' => 'TRUE');
		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title) ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title_sub') ?>">
				Title (Secondary)
				<?php echo aq_field_input('title_sub', $block_id, $title_sub) ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				Image
				<?php echo aq_field_upload('image', $block_id, $image) ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('image_lightbox') ?>">
				Image Lightbox?<br/>
				<?php echo aq_field_select('image_lightbox', $block_id, $bool_options, $image_lightbox) ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text,'full met_ckeditor') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('contentbox_bg') ?>">
				ContentBox Background
				<?php echo aq_field_color_picker('contentbox_bg', $block_id, $contentbox_bg) ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		if($image_lightbox == 'true'){
			wp_enqueue_script('metcreative-magnific-popup');
			wp_enqueue_style('metcreative-magnific-popup');
		}

		$widgetID = uniqid('met_infobox_image_');
		$text = wpautop(do_shortcode(htmlspecialchars_decode($text)));

		if(!empty($image)){
			$boxImage = aq_resize($image,270,240,true);
			if(!$boxImage){
				$boxImage = $image;
			}
			$lbImage = $image;
		}else{
			$boxImage = 'http://placehold.it/270x240';
			$lbImage = 'http://placehold.it/800x600';
		}

?>
		<div class="row-fluid">
			<div class="span12">
				<div id="<?php echo $widgetID ?>" class="met_img_with_text clearfix">

					<div class="met_img_with_text_preview">
						<img src="<?php echo $boxImage ?>" alt="<?php echo esc_attr($title) ?>">
						<?php if($image_lightbox == 'true'): ?>
						<div class="met_img_with_text_overlay met_bgcolor5_trans">
							<a href="<?php echo $lbImage ?>" rel="lb_<?php echo $widgetID ?>" class="met_portfolio_item_lb met_bgcolor5 met_color2"><i class="icon-search"></i></a>
						</div>
						<?php endif; ?>
					</div>

					<article class="met_color2 met_bgcolor5" style="background-color: <?php echo $contentbox_bg ?>">
						<div>
							<?php if(!empty($title)): ?><h2 class="met_title_stack"><?php echo $title ?></h2><?php endif; ?>
							<?php if(!empty($title_sub)): ?><h3 class="met_title_stack met_bold_one"><?php echo $title_sub ?></h3><br><?php endif; ?>
							<?php if(!empty($text)): ?><p><?php echo htmlspecialchars_decode($text) ?></p><?php endif; ?>
						</div>
					</article>
				</div>
			</div>
		</div>
		<style>
			#<?php echo $widgetID ?> article.met_bgcolor5:before {
				border-color : transparent <?php echo $contentbox_bg ?> transparent transparent !important;
			}
		</style>
<?php
	}

}