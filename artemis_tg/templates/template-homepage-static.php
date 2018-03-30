<?php
    $pp_homepage_bg = get_option('pp_homepage_bg'); 
    
    if(empty($pp_homepage_bg))
    {
    	$pp_homepage_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
    }

?>
<script type="text/javascript"> 
    jQuery.backstretch( "<?php echo $pp_homepage_bg; ?>", {speed: 'slow'} );
</script>