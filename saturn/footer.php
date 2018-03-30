<?php global $saturn_global_data;?>
	<footer class="footer" id="footer">
		<div class="container">
			<?php if( isset( $saturn_global_data['footer-text'] ) ):?>
				<div class="copyright">
					<p><?php print wp_kses_post( $saturn_global_data['footer-text'] );?></p>
				</div>
			<?php endif;?>
			<div class="socials">
				<ul>
					<?php 
					$socials = function_exists( 'saturn_social_profile' ) ? saturn_social_profile() : '';
					if( !empty( $socials ) && is_array( $socials ) ):
						foreach ($socials as $key=>$value):
							if( !empty( $saturn_global_data[ $key ] ) ):
								print '<li><a class="link-'.esc_attr( $key ).'" href="'.esc_url( $saturn_global_data[$key] ).'"><i class="fa '.esc_attr( $key ).'"></i></a></li>';
							endif;
						endforeach;
					endif;?>
					<li class="link-rss"><a class="link-fa-rss" href="<?php bloginfo( apply_filters( 'saturn_rss_url' , 'rss2_url') );?>"><i class="fa fa-rss"></i></a></li>
				</ul>
			</div>
		</div>
	</footer>
	<?php wp_footer();?>
</body>
</html>