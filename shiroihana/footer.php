		
		<footer class="site-footer">

			<?php get_sidebar( 'footer' ); ?>

			<div class="footer-bottom">

				<div class="container">

					<div class="row">

						<div class="col-md-12">
							<?php echo Youxi()->option->get( 'footer_copyright_text' ); ?>
						</div>

					</div>

				</div>

			</div>

		</footer>

		<a href="#" class="back-to-top">
			<i class="fa fa-angle-up"></i>
		</a>

	</div>

<?php wp_footer(); ?>

</body>

</html>