<?php
/**
* @package   Beauty Salon
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));
include($this['path']->path('layouts:header.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>
<?php echo $this['template']->render('head'); ?>
</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">

	<div class="header-wrapper <?php echo ($this['widgets']->count('toolbar-l + toolbar-r')) ? '' : 'header-wrapper-top-padding' ?>">
		<div class="header-top-wrapper">
			<?php bdt_headerStyle($this); ?>
		</div>
			
		<?php if ($this['widgets']->count('slider')):?>
		<div class="<?php echo ($this['config']->get('slider_full_width')) ? '' : 'uk-container'; ?> uk-container-center slider-wrapper">
		    <section class="<?php echo $grid_classes['slider']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}">
		    	<?php echo $this['widgets']->render('slider', array('layout'=>$this['config']->get('grid.slider.layout'))); ?>
		        <?php if ($this['config']->get('slider_shadow')) : ?>
		        	<div class="uk-width-1-1">
		        		<img class="slider-shadow-img" src="<?php echo TEMPLATEURL ?>/images/shadows/shadow<?php echo $this['config']->get('slider_shadow'); ?>.png" alt="" />
		        	</div>
		    	<?php endif; ?>
		    </section>
		</div>
		<?php else : ?>
			<div class="uk-clearfix"></div>
		<?php endif; ?>
	</div>

	<div class="body-wrapper">
		<div class="uk-container uk-container-center ">

			<?php if ($this['widgets']->count('slider')):?>
				<div class="slider-position"></div>
	        <?php endif; ?>

			<?php if ($this['widgets']->count('top-a')) : ?>
				<section class="<?php echo $grid_classes['top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
					<?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?>
				</section>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-b')) : ?>
				<section class="<?php echo $grid_classes['top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
					<?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?>
				</section>
			<?php endif; ?>

			<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
			<div class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>

				<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
				<div class="<?php echo $columns['main']['class'] ?>">

					<?php if ($this['widgets']->count('main-top')) : ?>
					<section class="<?php echo $grid_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
					<?php endif; ?>

					<?php if ($this['config']->get('system_output', true)) : ?>
					<main class="tm-content">

						<?php if ($this['widgets']->count('breadcrumbs') and !$config->get('page_class')=='home') : ?>
						<?php echo $this['widgets']->render('breadcrumbs'); ?>
						<?php endif; ?>
						
						<?php echo $this['template']->render('content'); ?>

					</main>
					<?php endif; ?>

					<?php if ($this['widgets']->count('main-bottom')) : ?>
					<section class="<?php echo $grid_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
					<?php endif; ?>

				</div>
				<?php endif; ?>

	            <?php foreach($columns as $name => &$column) : ?>
	            <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
	            <aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
	            <?php endif ?>
	            <?php endforeach ?>

			</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('bottom-a')) : ?>
			<section class="<?php echo $grid_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
			<?php endif; ?>
			
		</div>
	</div>

			<div class="bottom-wrapper">
				<div class="uk-container uk-container-center ">
					<?php if ($this['widgets']->count('bottom-b')) : ?>
					<section class="<?php echo $grid_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
					<?php endif; ?>

					<?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
					<footer class="tm-footer">

						<?php if ($this['config']->get('totop_scroller', true)) : ?>
						<a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
						<?php endif; ?>

						<?php
							echo $this['widgets']->render('footer');
							$this->output('warp_branding');
							echo $this['widgets']->render('debug');
						?>

					</footer>
					<?php endif; ?>
				</div>
			</div>


		<?php echo $this->render('footer'); ?>

	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>

</body>
</html>