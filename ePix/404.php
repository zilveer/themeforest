<?php
/**
 * @package WordPress
 * @subpackage NorthVantage
*/

	get_header();
	
	// get page layout
	$NV_layout = of_get_option('pagelayout','layout_four'); 
	
	$columns = '';
		
	if( $NV_layout == "layout_one" ) 		$columns = 'twelve';
	elseif( $NV_layout == "layout_two" )	$columns = 'eight last';
	elseif( $NV_layout == "layout_three" )	$columns = 'six last';
	elseif( $NV_layout == "layout_four" )	$columns = 'eight';
	elseif( $NV_layout == "layout_five" )   $columns = 'six';
	elseif( $NV_layout == "layout_six" )  	$columns = 'six';
	else $columns = 'eight';	
		
	echo "\n\t". '<div id="content" class="columns '. $columns .' '. $NV_layout .'">'; ?>
 
		<article class="post">
			<header>
				<h2 class="pagetitle"><?php _e("We're sorry but that page could not be found.", 'themeva' ); ?></h2>
			</header>
            
            <section class="entry">
                <div class="list arrow grey">
                    <ul>
                        <?php wp_list_pages('title_li='); ?>
                    </ul>
                </div>      
            </section>                                  
		</article>
        
	<?php
		
	echo "\n\t\t". '<div class="clear"></div>';
	echo "\n\t". '</div><!-- #content -->';
		
	get_sidebar(); 
	get_footer();