	<?php 
	if( is_single() ) 
	{ ?>
       <footer class="row">
        	<section class="twelve columns"> 
                  <?php include(NV_FILES .'/inc/classes/single-class.php'); ?>          
            </section>
        </footer>
	<?php }