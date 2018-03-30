<?php 
global $kowloonbay_redux_opts;
global $kowloonbay_allowed_html;
?>
</main>
<footer class="page-padding-h page-padding-v page-padding-v-sm page-padding-h-sm <?php echo esc_attr( kowloonbay_is_home() ? 'home':'' ); ?>" >
	<?php echo wp_kses( $kowloonbay_redux_opts['general_footer_content'], $kowloonbay_allowed_html ); ?>
</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>