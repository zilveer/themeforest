<?php


class AitSkeletonUpgrade2913
{

	protected $errors = array();



	public function execute()
	{
		$this->fixEvents();

		return $this->errors;
	}



	protected function fixEvents()
	{
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'ait-event',
			'post_status'      => 'publish',
		);

		$events = get_posts( $args );

		foreach($events as $event){
			$meta = get_post_meta($event->ID, '_ait-event_event-data', true);
			if(isset($meta) && isset($meta['dateFrom'])){
				clean_post_cache( $event->ID );
				update_post_meta($event->ID, 'event_date_from', $meta['dateFrom']);
			}
		}
	}

}
