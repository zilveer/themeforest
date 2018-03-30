<?php if($view_params['icon_type'] != 'video') return false; ?>
<div class="imagebox-video mk-video-wrapper padding-<?php echo $view_params['image_padding']; ?>">
    <div class="mk-video-container">
        <video muted="muted" preload="auto" loop="true" autoplay="true" poster="<?php echo $view_params['preview_image']; ?>">

          <?php if ( !empty( $view_params['mp4'] ) ) { ?>
            <source type="video/mp4" src="<?php echo $view_params['mp4']; ?>" />
          <?php }
          if ( !empty( $view_params['webm'] ) ) { ?>
            <source type="video/webm" src="<?php echo $view_params['webm']; ?>" />
          <?php }
          if ( !empty( $view_params['ogv'] ) ) { ?>
            <source type="video/ogg" src="<?php echo $view_params['ogv']; ?>" />
          <?php } ?>

        </video>
    </div>
</div>