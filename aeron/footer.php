<?php
$target = get_theme_mod( 'social_links_target', '_blank' );
?>

	<?php if (is_page_template('coming-soon.php') || is_page_template('under-maintenance.php')):?>

		<footer id="main_footer" class="coming_soon_footer">
			<div id="footer_copyright" class="container">
				<div class="row">
					<div class="span6 footer_copyright">
						<?php $copyright=get_theme_mod('copyright','');
						if($copyright!=''): ?>
							<?php echo do_shortcode($copyright); ?>
						<?php endif; ?>
					</div>

					<div class="span6 footer_social_links">
						<span>
							<?php $social_links_label=get_theme_mod('social_links_label','');
							if($social_links_label!=''): ?>
								<?php echo do_shortcode($social_links_label); ?>
							<?php endif; ?>
						</span>
						<?php $linkedin_url=get_theme_mod('linkedin_url','');
						if($linkedin_url!=''): ?>
							<a href="<?php echo $linkedin_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-linkedin"></i></a>
						<?php endif; ?>
						<?php $facebook_url=get_theme_mod('facebook_url','');
						if($facebook_url!=''): ?>
							<a href="<?php echo $facebook_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-facebook"></i></a>
						<?php endif; ?>
						<?php $skype_url=get_theme_mod('skype_url','');
						if($skype_url!=''): ?>
							<a href="<?php echo $skype_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-skype"></i></a>
						<?php endif; ?>
						<?php $googleplus_url=get_theme_mod('googleplus_url','');
						if($googleplus_url!=''): ?>
							<a href="<?php echo $googleplus_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-googleplus"></i></a>
						<?php endif; ?>
						<?php $twitter_url=get_theme_mod('twitter_url','');
						if($twitter_url!=''): ?>
							<a href="<?php echo $twitter_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-twitter"></i></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</footer>

	<?php else: ?>

		<footer id="main_footer">
			<div id="footer_columns" class="container">
				<div class="row">
					<div class="span3 clearfix">
						<?php dynamic_sidebar( __('First Footer Widget', 'ABdev_aeron') );?>
					</div>
					<div class="span3 clearfix">
						<?php dynamic_sidebar( __('Second Footer Widget', 'ABdev_aeron') );?>
					</div>
					<div class="span3 clearfix">
						<?php dynamic_sidebar( __('Third Footer Widget', 'ABdev_aeron') );?>
					</div>
					<div class="span3 clearfix">
						<?php dynamic_sidebar( __('Fourth Footer Widget', 'ABdev_aeron') );?>
					</div>
				</div>
			</div>

			<div id="footer_copyright" class="container">
				<div class="row">
					<div class="span5 footer_copyright">
						<?php $copyright=get_theme_mod('copyright','');
						if($copyright!=''): ?>
							<?php echo do_shortcode($copyright); ?>
						<?php endif; ?>
					</div>
					<div class="span2 footer_logo">
						<a href="<?php echo home_url(); ?>">
							<?php $footer_logo = get_theme_mod('footer_logo', '');
							if( $footer_logo!='' ):?>
								<img id="main_logo_footer" src="<?php echo $footer_logo;?>" alt="<?php bloginfo('name');?>">
							<?php else: ?>
								<h1 id="main_logo_textual_footer"><?php bloginfo('name');?></h1>
								<?php $blog_description = get_bloginfo('description');
								if( $blog_description!='' ): ?>
									<h2 id="main_logo_tagline_footer"><?php echo $blog_description;?></h2>
								<?php endif; ?>
							<?php endif; ?>
						</a>
					</div>
					<div class="span5 footer_social_links">
						<span>
							<?php $social_links_label=get_theme_mod('social_links_label','');
							if($social_links_label!=''): ?>
								<?php echo do_shortcode($social_links_label); ?>
							<?php endif; ?>
						</span>
						<?php $linkedin_url=get_theme_mod('linkedin_url','');
						if($linkedin_url!=''): ?>
							<a href="<?php echo $linkedin_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-linkedin"></i></a>
						<?php endif; ?>
						<?php $facebook_url=get_theme_mod('facebook_url','');
						if($facebook_url!=''): ?>
							<a href="<?php echo $facebook_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-facebook"></i></a>
						<?php endif; ?>
						<?php $skype_url=get_theme_mod('skype_url','');
						if($skype_url!=''): ?>
							<a href="<?php echo $skype_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-skype"></i></a>
						<?php endif; ?>
						<?php $googleplus_url=get_theme_mod('googleplus_url','');
						if($googleplus_url!=''): ?>
							<a href="<?php echo $googleplus_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-googleplus"></i></a>
						<?php endif; ?>
						<?php $twitter_url=get_theme_mod('twitter_url','');
						if($twitter_url!=''): ?>
							<a href="<?php echo $twitter_url;?>" target="<?php echo $target; ?>"><i class="ci_icon-twitter"></i></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</footer>

	<?php endif; ?>

	<?php wp_footer(); ?>

	<?php echo (get_theme_mod('boxed_body', false)) ? '</div>' : '' ; ?>

</body>
</html>