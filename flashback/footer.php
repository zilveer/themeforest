		</div>
		
	</section>
	<!--// BEGIN #main //-->
	
	
	
	<?php if (of_get_option("show_widgets") == "1") : ?>
	
		<!--// BEGIN #footer //-->
		<footer id="footer">
		
			<a class="tog"><span class="open"><i class="icon-plus"></i></span><span class="close"><i class="icon-minus"></i></span></a>
			
			<?php get_sidebar(); ?>
			
			<div id="copy">
			
				<p class="inner">&copy; <?php bloginfo("name"); ?>. <?php echo of_get_option("footer_copy"); ?>
				
					<?php 
					
					$twitter = of_get_option("social_twitter");
					$facebook = of_get_option("social_facebook");
					
					if ($twitter != ""  || $facebook != "") { echo "- "; }
					
					if ($twitter != "") { echo "<a href='http://twitter.com/$twitter'>" . __('Twitter', 'shorti') . "</a>"; }
					
					if ($facebook != "") { echo ", <a href='http://facebook.com/$facebook'>" . __('Facebook', 'shorti') . "</a>"; }
					
					?>
				
				</p>
			
			</div>
		
		</footer>
		<!--// END #footer //-->
	
	<?php endif; ?>
	
	
	
<?php get_template_part( "includes/background" ); ?>	

<?php wp_footer(); ?>

</body>

</html>