<div class="site-header__branding">
	<?php if ( heap_image_src( 'main_logo' ) ): ?>
		<h1 class="site-title site-title--image">
			<a class="site-logo  site-logo--image" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ) ?>"
			   rel="home">
				<img src="<?php echo heap_image_src( 'main_logo' ); ?>" rel="logo"
				     alt="<?php echo get_bloginfo( 'name' ) ?>"/>
			</a>
		</h1>
	<?php else: ?>
		<h1 class="site-title site-title--text">
			<a class="site-logo  site-logo--text" href="<?php echo home_url() ?>" rel="home">
				<?php bloginfo( 'name' ) ?>
			</a>
		</h1>
	<?php endif; ?>
	<p class="site-header__description"><?php bloginfo( 'description' ); ?></p>
</div>

<?php if ( heap_image_src( 'main_logo' ) ): ?>
	<h1 class="site-title  site-title--small"><a href="<?php echo home_url() ?>"><?php bloginfo( 'name' ) ?></a></h1>
<?php endif; ?>