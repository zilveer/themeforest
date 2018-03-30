<?php
/*
	@package WordPress
	@subpackage The Cause
*/
?>

<!-- SIDEBAR -->
<div id="sidebar" class="<?php tb_write_bckg('buttons'); ?>">

	<div class="widget box">
    	<h3 class="first">Event details</h3>
        <div class="eventDetails tbFonts">
		
		<p>
		
		<?php
		$postMeta = $_SESSION['postMeta'];
		$location = $postMeta['_location'][0];
		$venue = $postMeta['_venue'][0];
		$startDate = $postMeta['_start_date'][0];
		$endDate = $postMeta['_end_date'][0];
		$time = $postMeta['_time'][0];
		$eventPhotos = $postMeta['_event_photos'];
		
		if ($location) echo "LOCATION: <strong>$location</strong><br>";
		if ($venue) echo "VENUE: <strong>$venue</strong><br>";
		
		if ($startDate) {
			$startDateArray = tb_get_date($startDate);
			echo 'START DATE: <strong>' . $startDateArray['monthname'] . ' ' . $startDateArray['day'] . $startDateArray['sufix'] . ', ' . $startDateArray['year'] . '</strong><br>';
		}
		
		if ($time) {
			echo 'TIME: <strong>' . date("g:ia", strtotime($time)) . '</strong><br>';
		}
		
		if ($endDate) {
			$endDateArray = tb_get_date($endDate);
			echo 'END DATE: <strong>' . $endDateArray['monthname'] . ' ' . $endDateArray['day'] . $endDateArray['sufix'] . ', ' . $endDateArray['year'] . '</strong><br>';
		}
		?>
		
		</p>
		
		<?php global $post; ?>
		
		<p class="center"><a href="<?php tb_write_link('tb_page_contact') ?>?msgSubject=<?php echo $post->ID; ?>" class="button">Attend...</a></p>
		
		
        </div>
    </div>
				
</div>
<!-- SIDEBAR -->