<div class="gallery-item-wrapper">
    <div class="gallery-item touch-click">
        <div class="overlay">
            <div class="title">
                <div class="intro">
                    <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('View all photos', 'goliath'); ?></a>
                </div>
            </div>
        </div>
        <div class="background">
            <?php
				if(class_exists('Attachments'))
				{
					$attachments = new Attachments( 'plsh_galleries' );
					if( $attachments->exist() )
					{
						for( $i = 1; $i <= 4; $i++ )
						{
							$attachment = $attachments->get();
							if($attachment)
							{
								echo $attachments->image( 'gallery-thumb-one-fourth' );
							}
						}
					}
				}
            ?>
        </div>
    </div>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p>
        <span class="legend-default">
            <?php 
                $date = get_the_date();
                if($date)
                {
                    echo '<i class="fa fa-clock-o"></i>' . $date;
                }
            ?>
            <i class="fa fa-camera"></i>
			
            <?php
				if(class_exists('Attachments'))
				{
					echo esc_html($attachments->total());
				}
			?>
        </span>
    </p>
</div>