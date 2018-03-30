<?php
global $zorka_data;
?>
		</div><!-- end #wapper-content-->
		<?php
            global $footer_style;
            if(!isset($footer_style))
                $footer_style = 'template';
            get_template_part('templates/footer/footer', $footer_style);
        ?>
	</div><!-- end #wapper-->
	<?php if($zorka_data['show-back-to-top']==1): ?>
		<a class="gotop" href="javascript:;">
			<i class="pe-7s-angle-up"></i>
		</a>
	<?php endif ?>
	<?php wp_footer(); ?>
</body>
</html> <!-- end of site. what a ride! -->