<?php if( ! get_mental_option( 'preloader_show' ) || wp_is_mobile() ) return ; ?>

<div id="preloader" class="default">
	<div class="middle">
		<div class="middle-inner">
			<div class="spinner-container">
				<!--<i class="preloader-spinner fa fa-spinner fa-spin"></i>-->

				<div class="ip-loader">
					<svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
						<path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
						<path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
					</svg>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	Preloader();
</script>