<?php

/*
	@package WordPress
	@subpackage The Cause
*/

get_header('sidebar');
?>

    <h2>Error 404</h2>
    
    <div id="post-error404">
	<div>

    <?php get_sidebar(); ?>
	
    <!-- INNER content -->
    <div id="inner"> 
	<p>The page you are looking for doesn't exist.</p>
    </div>
	
    </div>
    </div>

<?php
get_footer();
?>