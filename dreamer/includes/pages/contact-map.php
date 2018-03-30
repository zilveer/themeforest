<?php global $smof_data; $dreamer_contact_page_map = $smof_data['contact_page_map']; ?>

<?php if (!empty($dreamer_contact_page_map)): ?>
	<!-- Contact Page -->
	<div class="page-container pattern-1" id="contact">
		<div class="row contact-map-holder">
	    <?php echo $dreamer_contact_page_map ?>
	  	</div>
	</div>
<?php endif ?>

<?php wp_reset_query(); ?>