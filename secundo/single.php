<?php if($pageTitle = ct_get_option('posts_single_page_title', '')):?>
	<div class="patBlue">
		<div class="container">
			<h1 class="twoLines"><span><?php echo $pageTitle; ?></span></h1>
		</div>
	</div>
<?php endif;?>

<div class="patStd nomrg">
    <div class="container">
        <div class="row-fluid">
            <div class="span6">
                <br>
                <a href="<?php echo ct_get_blog_url()?>" class="arrowIcon vsmall"><i class="arrow-toTop"></i><?php _e('BACK TO BLOG', 'ct_theme')?></a>
            </div>
	        <?php $prev = get_previous_post();?>
	        <?php $next = get_next_post();?>

            <div class="span3 doRight">
                <br>
	            <?php if($next):?>
                <a href="<?php echo get_permalink($next->ID);?>" class="arrowIcon vsmall"><i class="arrow-tinyLeft"></i><?php _e('PREV POST', 'ct_theme')?></a>
	            <?php endif;?>
            </div>

            <div class="span3 doRight">
                <br>
	            <?php if($prev):?>
                <a href="<?php echo get_permalink($prev->ID);?>" class="arrowIcon vsmall"><?php _e('NEXT POST', 'ct_theme')?><i class="arrow-tinyRight"></i></a>
	            <?php endif;?>
            </div>
        </div>
        <!-- / row-fluid -->
    </div>
</div>

<div class="patStd nomrg">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <hr>
            </div>
        </div>
    </div>
</div>

<div class="patStd">
	<div class="container">
		<div class="row-fluid">
			<?php if(is_404()):?><div class="span9"><?php else:?><div class="<?php ct_blog_post_class()?>"><?php endif;?>
				<!-- blog left -->
				<div class="rightPadd20">
					<?php get_template_part('templates/content', 'single'); ?>
				</div>
				<!-- blogContainer -->
			</div>
			<?php if(ct_use_blog_post_sidebar()):?>
                <div class="<?php roots_sidebar_class(); ?>">
					<?php get_template_part('templates/sidebar'); ?>
				</div>
			<?php endif;?>
		</div>
		<!-- row-fluid -->
	</div>
</div>