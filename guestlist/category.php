<?php

while(have_posts())
{
    the_post();

    if(has_post_thumbnail())
    {
        include('loop-thumb.php');
    }else {
        include('loop.php');
    }
    


}
?>
<ul class="blog_nav">
    <li><?php next_posts_link( __( 'previous posts', $bSettings->getPrefix() ) ); ?></li>
    <li><?php previous_posts_link( __( 'next posts', $bSettings->getPrefix() ) ); ?></li>
</ul>