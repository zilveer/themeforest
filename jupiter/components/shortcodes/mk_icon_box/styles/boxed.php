<div class="icon-box-boxed <?php echo $view_params['icon_location']; ?>">

	<?php
		echo !empty( $view_params['read_more_url'] ) ? '<a href="'.$view_params['read_more_url'].'">' : '';
			echo '<i class="mk-main-ico '.$view_params['backward_icon'].'">'.$view_params['icon'].'</i>';
		echo !empty( $view_params['read_more_url'] ) ? '</a>' : '';


		echo mk_get_shortcode_view('mk_icon_box', 'components/title', true, ["title" => $view_params["title"], "read_more_url" => $view_params["read_more_url"]]);

		echo wpb_js_remove_wpautop( $view_params['content'], true );

		echo mk_get_shortcode_view('mk_icon_box', 'components/read-more', true, ["read_more_txt" => $view_params["read_more_txt"], "read_more_url" => $view_params["read_more_url"]]);

	?>

	<div class="clearboth"></div>
</div>


