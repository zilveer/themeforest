<?php get_header();?>
        <!-- BEGIN OF PAGE TITLE -->      
        <div id="page-title">
        	<div id="page-title-inner">
                <div class="title">
                <h1>404 Page</h1>
                </div>
                <div class="dot-separator-title"></div>
                <div class="description">
                <?php $data = get_post_meta($post->ID, 'vulcan_meta_options', true ); ?>
                <?php $site_slogan = get_option('vulcan_site_slogan');?>
                <p><?php if ($data['short_desc']) echo stripslashes($data['short_desc']);?></p>
                </div>
            </div>   	            
        </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-left">          
                <div class="maincontent">
                <?php
                  $_404_text = (get_option('vulcan_404_text')) ? get_option('vulcan_404_text') : __('Apologies, but the page you requested could not be found','vulcan');
                ?>
                <h2><?php echo stripslashes($_404_text);?></h2>
                <?php get_search_form();?>
                </div>
            </div>
          <?php get_sidebar();?>             
                  
        </div>
        <!-- END OF CONTENT -->
      	<script type="text/javascript">
      		// focus on search field after it has loaded
      		document.getElementById('s') && document.getElementById('s').focus();
      	</script>        
        <?php get_footer();?>
