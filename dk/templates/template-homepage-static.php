<?php
    $pp_homepage_bg = get_option('pp_homepage_bg'); 
    
    if(empty($pp_homepage_bg))
    {
    	$pp_homepage_bg = '/example/bg.jpg';
    }
    else
    {
    	$pp_homepage_bg = '/data/'.$pp_homepage_bg;
    }

?>
<script type="text/javascript"> 
    jQuery.backstretch( "<?php echo get_stylesheet_directory_uri().$pp_homepage_bg; ?>", {speed: 'slow'} );
</script>