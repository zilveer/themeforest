<?php 
//get theme options
global $oswc_reviews, $oswc_front, $oswc_single, $oswc_other, $oswc_ads, $oswc_bp, $oswc_misc, $oswcPostTypes;
$oswc_front = get_option( 'oswc_front', $oswc_front );
$oswc_single = get_option( 'oswc_single', $oswc_single );
$oswc_other = get_option( 'oswc_other', $oswc_other );
$oswc_ads = get_option( 'oswc_ads', $oswc_ads );
$oswc_bp = get_option( 'oswc_bp', $oswc_bp );
$oswc_misc = get_option( 'oswc_misc', $oswc_misc );
$oswc_reviews = get_option( 'oswc_reviews', $oswc_reviews );
	
foreach($oswcPostTypes->postTypes as $postType){
	if($postType->enabled){
		$postType->create_review();
	}
}
?>