<?php wp_reset_query(); ?>
<?php

if ( of_get_option('clients_status') ) {

if ( of_get_option('clients_frontpage') && is_front_page() || !of_get_option('clients_frontpage') && !is_front_page() || !of_get_option('clients_frontpage') && is_front_page() ) {
?>

<div class="portfolio-shoutout clearfix">
	<div class="entry-content">
		<?php echo stripslashes_deep( of_get_option('clients_message') ); ?>
	</div>
</div>
<div class="portfolio-clients">
<ul>
	<?php
	for ($client_count=0; $client_count<=10; $client_count++) {
	
	$client_logo= of_get_option ( "client_" .$client_count . "_logo" );
	$client_link= of_get_option ( "client_" .$client_count . "_link");
	$client_hovertext= of_get_option ( "client_" .$client_count . "_hovertext");
	
		if ($client_logo<>"") {
	
			echo '<li>';
			
				if ($client_link) echo '<a href="'. $client_link .'">';
				
					echo '<img ';
					if ($client_hovertext) {
						echo 'class="stips" original-title="'.$client_hovertext.'" ';
					} 
					echo 'src="'. $client_logo . '" alt="client logo" />';
				
				if ($client_link) echo '</a>';
			
			echo '</li>';
		}
	
	}
	?>
</ul>
</div>

<?php
}
}
?>