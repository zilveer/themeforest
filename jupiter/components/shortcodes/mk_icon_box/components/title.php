<h4 class="icon-box-title">
     <?php if(!empty( $view_params['read_more_url'] )) { ?>
     		<a href="<?php echo $view_params['read_more_url']; ?>"><?php echo $view_params['title']; ?></a>
     <?php } else {
     		echo $view_params['title'];
     	} ?>
</h4>


