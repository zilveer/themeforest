<!-- right side [sidebar] -->
<div id="sidebar" class="sidebar col-md-4 col-xs-12">
	<div id="sidebar-content">

			<div id="masonry-sidebar" class="sidebar-inner-content">
				
					
					<?php 

					if(is_search() || is_archive()) :

							dynamic_sidebar('sidebar');

					else :
							if(get_post_meta(get_the_ID() , 'sidebar' , true) != '') {
							    dynamic_sidebar(get_post_meta(get_the_ID() , 'sidebar' , true));
							}else{
							    dynamic_sidebar('sidebar');
							}
					endif;
					?>



			</div>
		<!-- end sidebar inner -->
	</div>
	<!-- end sidebar content -->
</div><!-- end sidebar -->