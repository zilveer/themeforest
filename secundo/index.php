<?php get_template_part('templates/page', 'head'); ?>
<?php if($pageTitle = ct_get_option('posts_index_page_title', '')):?>
	<div class="patBlue">
		<div class="container">
			<h1 class="twoLines"><span><?php echo $pageTitle; ?></span></h1>
		</div>
	</div>
<?php endif;?>
<div class="patStd">
	<div class="container">
		<div class="row-fluid">
			<?php if(is_404()):?><div class="span9"><?php else:?><div class="<?php ct_blog_index_class()?>"><?php endif;?>
				<!-- blog left -->
				<div class="rightPadd20">
					<?php get_template_part('templates/content', get_post($post)?get_post_format():false); ?>
				</div>
				<!-- blogContainer -->
			</div>
			<?php if(ct_use_blog_index_sidebar()):?>
                <div class="<?php roots_sidebar_class(); ?>">
					<?php get_template_part('templates/sidebar'); ?>
				</div>
			<?php endif;?>
		</div>
		<!-- row-fluid -->
	</div>
</div>
