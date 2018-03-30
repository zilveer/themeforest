<?php

class PeThemeTemplate {

	public $master;
	public $args;
	protected $datas = array();
	protected $template_stack = array();

	public function __construct($master) {
		$this->master =& $master;
	}

	public function inside($slug) {
		$this->template_stack[] = $slug;
	}

	public function ancestor($slug) {
		return in_array($slug,$this->template_stack);
	}


	public function outside() {
		array_pop($this->template_stack);
	}

	public function exists($slug,$name = null) {
		if (isset($name)) $templates[] = "{$slug}-{$name}.php";
		$templates[] = "{$slug}.php";
		return locate_template($templates);
	}

	public function data() {
		if (func_num_args()) {
			$this->datas[] = func_get_args();;
		} else {
			return array_pop($this->datas);
		}
	}

	public function custom(&$loop,$slug,$name = null) {
		if (isset($name)) $templates[] = "{$slug}-{$name}.php";
		$templates[] = "{$slug}.php";
		if (locate_template($templates)) {
			$this->master->data->set($loop);
			get_template_part($slug,$name);
			return true;
		}
		return false;
	}

	public function comment_form() {
		$loop = false;
		if ($this->custom($loop,"comment-form")) return;
?>
<?php $t =& peTheme(); ?>
<?php $comments =& $t->comments; ?>
<?php if ($comments->open()): ?>
<div id="respond">

	<?php if ($comments->requireRegistered()) : ?>
	
	<div class="row-fluid">
		<div class="span12">
			<p class="comment-notes must-log-in"><?php $comments->register(); ?></p>
		</div>
	</div>

	<?php else : ?>

	<div class="row-fluid">
		<div class="span12">
			<h3 id="reply-title"><?php echo __("Leave A Comment",'Pixelentity Theme/Plugin') ?> <div class="pull-right"><?php cancel_comment_reply_link(__("Cancel Reply",'Pixelentity Theme/Plugin')); ?></div></h3>
		</div>
	</div>
	
	<!--comment form-->
	<div class="row-fluid">
		<div class="span12">
			<form action="<?php $comments->action(); ?>" method="post" id="commentform" class="form-horizontal">
				<?php do_action( 'comment_form_top' ); ?>
				<?php if ($comments->logged()): ?>
				<p class="comment-notes logged-in-as"><?php $comments->logout(); ?></p>

				<?php else: ?>
				<p class="comment-notes"><?php echo __('Your email address will not be published. Required fields are marked','Pixelentity Theme/Plugin'); ?> <span class="required">*</span></p>
				<div class="comment-form-author control-group">
					
					<div class="controls">
						<input class="span4" id="author" name="author" type="text" value="" size="30" aria-required="true"/>
					</div>
					<label class="control-label" for="author"><?php _e("Name",'Pixelentity Theme/Plugin'); ?> <span class="required">*</span></label>
				</div>
				
				<div class="comment-form-email control-group">
					<div class="controls">
						<input class="span4" id="email" name="email" type="text" value="" size="30" aria-required="true"/>
					</div>
					<label class="control-label" for="email"><?php _e("Email",'Pixelentity Theme/Plugin'); ?> <span class="required">*</span></label>
				</div>
				
				<div class="comment-form-url control-group">
					
					<div class="controls">
						<input class="span4" id="url" name="url" type="text" value="" size="30"/>
					</div>
					<label class="control-label" for="url"><?php _e("Website",'Pixelentity Theme/Plugin'); ?></label>
				</div>
				<?php endif; ?>
				
				<div class="comment-form-comment control-group">
					<div class="controls">
						
						<textarea class="span7" id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="<?php _e("Your comment here..",'Pixelentity Theme/Plugin'); ?>"></textarea>
					</div>
				</div>
				
				<div class="form-submit">
					<div class="controls">
						<button class="<?php echo apply_filters("pe_theme_comment_submit_class","btn btn-success"); ?>" type="submit"><?php _e("Post Comment",'Pixelentity Theme/Plugin'); ?></button>
						<?php $comments->fields(); ?>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--end comment form-->
	
<?php endif; ?>
</div>
<!--end respond--> 
<?php $comments->end(); ?>
<?php else: ?>
<div class="row-fluid">
	<div class="span12">
		<p><?php _e("The comments are now closed.",'Pixelentity Theme/Plugin'); ?></p> 
	</div>
</div>
<?php endif; ?>
<?php
	}


	public function slider_volo($slider,$name = "gallery") {
		if (!$slider || !isset($slider->main->loop)) return "";
		if (!$this->custom($slider,"slider-volo",$name)) {
			$this->slider_volo_gallery($slider);
		}
	}

	public function intro_gallery($id,$w,$h,$name,$cols = 4,$class = "span3",$meta = null) {
		$loop =& $this->master->gallery->getSliderLoop($id,$w,$h,$cols,$class);
		if (!$loop) return;
		if (!$this->custom($loop,"intro-gallery",$name)) {
			$this->{"intro_gallery_$name"}($loop,$meta);
		}
	}

	public function intro_gallery_thumbnails($loop,$galopts = null) {
		$width = $loop->main->width;
		$height = $loop->main->height;
		$id = $loop->main->id;
		$cols = $loop->main->cols;
		$t =& peTheme();
		if ($galopts) {
			// use provided gallery options
			$meta = new StdClass();
			$meta->gallery = $galopts;
		} else {
			// fetch meta from current post
			$meta =& $t->content->meta();
		}
		$flarePlugin = isset($meta->gallery->lbType) && $meta->gallery->lbType ? $meta->gallery->lbType : "default";
		$maxThumbs = isset($meta->gallery->maxThumbs) ? intval($meta->gallery->maxThumbs) : 0;
		$flareScale = isset($meta->gallery->lbScale) && $meta->gallery->lbScale ? $meta->gallery->lbScale : "fit";
		$overClass = apply_filters("pe_theme_image_over_class","peOver","gallery_thumbnail",$loop->main->class);
?>
<?php while ($item =& $loop->next()): ?>
<?php $hidden = ($maxThumbs > 0 && $item->idx >= $maxThumbs); ?>
<?php if ($cols > 0 && ($item->idx % $cols) == 0): ?>
<div class="row-fluid post-thumbs">
<?php endif; ?>
<div class="<?php echo $loop->main->class . (($hidden) ? " hiddenLightboxContent" : "") ?>" >
	<a 
		title="<?php echo esc_attr($item->title); ?>"
		class="<?php echo $overClass ?>"
		data-target="flare" 
		data-flare-gallery="galPostThumb<?php echo $id ?>"
		id="galPostThumb<?php echo "{$id}_{$item->id}" ?>"
		data-flare-thumb="<?php echo $t->image->resizedImgUrl($item->img,$width,$height); ?>"
		<?php if ($flarePlugin === "shutter"): ?>
		data-flare-bw="<?php echo $t->image->bw($item->img); ?>"
		<?php endif; ?>
		data-flare-plugin="<?php echo $flarePlugin ?>"
		data-flare-scale="<?php echo $flareScale ?>"
		href="<?php echo $item->img; ?>"
		>
		<?php echo $hidden ? "" : $t->image->resizedImg($item->img,$width,$height); ?>
	</a>
</div>
<?php if ($cols > 0 && (($item->idx == $loop->last) || ($item->idx % $loop->main->cols) == ($loop->main->cols-1))): ?>
</div>
<?php endif; ?>
<?php endwhile; ?>
<?php
	}

	public function intro_gallery_fullscreen($loop,$galopts) {
		$t =& peTheme();
		if ($galopts) {
			// use provided gallery options
			$meta = new StdClass();
			$meta->gallery = $galopts;
		} else {
			// fetch meta from current post
			$meta =& $t->content->meta();
		}
		// if a custon url is defined for the gallery (cover), we don't need to add the hidden images for the lightbox window
		if ($meta->gallery->link) return;

		$width =& $loop->main->width;
		$height =& $loop->main->height;
		$id =& $loop->main->id;

		$flarePlugin = isset($meta->gallery->lbType) && $meta->gallery->lbType ? $meta->gallery->lbType : "shutter";
		$flareScale = isset($meta->gallery->lbScale) && $meta->gallery->lbScale ? $meta->gallery->lbScale : "fillmax";
?>
<div class="hiddenLightboxContent">
	<?php while ($item =& $loop->next()): ?>
	<a href="<?php echo $item->img; ?>"
	   title="<?php echo esc_attr($item->title); ?>"
	   data-flare-thumb="<?php echo $t->image->resizedImgUrl($item->img,$width,$height); ?>"
	   data-flare-bw="<?php echo $t->image->bw($item->img); ?>"
	   data-target="flare"
	   data-flare-plugin="<?php echo $flarePlugin; ?>"
	   data-flare-gallery="fsGallery<?php echo $id ?>"
	   data-flare-scale="<?php echo $flareScale; ?>"
	   >
	</a>
	<?php endwhile; ?>
</div>
<?php
	}


	public function gallery_cover($w,$h,$galopts = null) {
		$loop = false;
		if ($this->custom($loop,"gallery-cover")) return;
		$t =& peTheme();
		if ($t->content->type() != "gallery") {
			// gallery is linked to other post, fetch info from post meta
			$gallery = $galopts ? $galopts : $t->content->meta()->gallery;
			$id = $gallery->id;
			$type = $gallery->type;
			$title = isset($gallery->title) ? $gallery->title : "";
		} else {
			// post = gallery, fetch info from gallery itself
			$id = $GLOBALS["post"]->ID;
			$type = "fullscreen";
			$title = "gallery";
		}

		switch ($title) {
		case "gallery":
			$title = $t->gallery->title($id);
			break;
		case "custom":
			$title = $gallery->custom;
			break;
		default:
			$title = false;
		}

		$count = $t->gallery->count($id);

		$info = sprintf('<div class="title"><span>%s</span>%s</div>',
						apply_filters("pe_theme_gallery_cover_count"," &times; $count",$count),
						$title ? sprintf('<a href="%s">%s</a>',get_permalink(),$title) : '<i></i>'
						);

		$info = apply_filters("pe_theme_gallery_cover_info",$info,$title,$count);
		$fullscreen = ($type == "fullscreen" && (is_single() || is_page()));
		$link = isset($gallery->link) && $gallery->link  ? $gallery->link : false;
		$overClass = apply_filters("pe_theme_image_over_class",$fullscreen ? "peOver" : "","gallery_cover");
?>
<!--album cover-->
<div class="portfolioItem galleryCover">
	<?php if ($fullscreen && !$link ): ?>
	<a class="<?php echo $overClass; ?>" href="#fsGallery<?php echo $id; ?>" data-target="flare">
	<?php else: ?>		
	<a class="<?php echo $overClass; ?>" href="<?php if ($link) { echo $link;} else { $t->content->link(); } ?>">
	<?php endif; ?>
	<?php if ($t->content->hasFeatImage()): ?>
	<?php $t->content->img($w,$h) ?>
	<?php else: ?>
	<?php echo $t->image->resizedImg($t->gallery->cover($id),$w,$h); ?>
	<?php endif; ?>
	<?php echo apply_filters("pe_theme_gallery_cover_icon","<span></span>",$count,$title,$fullscreen); ?>
	</a>
	<?php echo $info; ?>
</div>
<!--end album cover-->
<?php
	}


	public function slider_volo_gallery($slider) {
		if (!$slider || !isset($slider->main->loop)) return "";

		$deflink = isset($slider->main->link) ? $slider->main->link : null;
		if ($deflink !== false) {
			$deflink = is_single() || is_page() ? false : get_permalink();
		}

		$captionManager = peTheme()->captions;

		$customAttr = peTheme()->gallery->getSliderConf(isset($slider->main->config) ? $slider->main->config : null);
		$customAttr = apply_filters("pe_theme_slider_attributes",$customAttr,$slider);
		$delay = isset($customAttr["delay"]) ? sprintf('data-delay="%s"',$customAttr["delay"]) : "";
?>
<div class="peSlider peVolo" data-autopause="enabled" <?php echo $this->master->utils->getAttributes($customAttr); ?>>
	<?php while ($slide =& $slider->next()): ?>
	<?php $customAttr = apply_filters("pe_theme_slider_slide_attributes",array(),$slide,$slider); ?>
	<div <?php echo $delay; ?> <?php echo $this->master->utils->getAttributes($customAttr); ?> <?php echo $slide->idx == 0 ? ' class="visible"' : ''; ?>>
		<?php if (isset($slide->captions)) $captionManager->output($slide->captions); ?>
		<?php $link = $deflink ? $deflink : (isset($slide->link) ? $slide->link : false); ?>
		<?php $img = peTheme()->image->resizedImg($slide->img,$slider->main->width,$slider->main->height); ?>
		<?php if ($link):  ?>
		<a href="<?php echo $link; ?>">
			<?php echo $img; ?>
		</a>
		<?php else: ?>
		<?php echo $img; ?>
		<?php endif; ?>
	</div>
	<?php endwhile; ?>
</div>
<?php
	}

	public function get_for($id,$slug,$name = "") {
		if (!$id) return;
		$post = get_post($id);
		if ($post) {
			$this->master->data->postSetup($post);
			get_template_part($slug,$name);
			$this->master->data->postReset();
		}
		
	}

	public function get_part(&$args,$slug,$name = "") {
		$this->args =& $args;
		get_template_part($slug,$name);
	}


	public function paginate_links($loop) {
		if (!$loop) return "";
?>
<div class="row-fluid post-pagination">
	<div class="<?php echo $loop->main->class ?>">
		<div class="pagination">
			<ul>
				<li class="<?php echo esc_attr( $loop->main->prev->class ); ?>">
					<a href="<?php echo esc_url( $loop->main->prev->link ); ?>"><?php _e("Prev",'Pixelentity Theme/Plugin'); ?></a>
				</li>
				<?php while ($page =& $loop->next()): ?>
				<li class="<?php echo esc_attr( $page->class ); ?>">
					<a href="<?php echo esc_url( $page->link ); ?>"><?php echo $page->num; ?></a>
				</li>
				<?php endwhile; ?>
				<li class="<?php echo esc_attr( $loop->main->next->class ); ?>">
					<a href="<?php echo esc_url( $loop->main->next->link ); ?>"><?php _e("Next",'Pixelentity Theme/Plugin'); ?></a>
				</li>
			</ul>
		</div>  
	</div>
</div>
<?php
	}


}

?>