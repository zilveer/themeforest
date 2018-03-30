<?php
if ( have_posts() ) : 
    
	while ( have_posts() ) : the_post();

        $template = 'theme/templates/loop';
        $slug = '';

		if(get_post_type() && get_post_type() !== 'post')
        {
            $slug .= get_post_type();
        }
        /*elseif(get_post_format())
		{
            $slug .= get_post_format();
		}*/
		else
		{
			$slug .= 'default';
		}
        
		if(is_single())
		{
			$slug .= '-single';
		}
		else
		{
			if(is_search())
            {
                $slug .= '-search-item';
            }
            else
            {
                $slug .= '-list-item';
            }
		}
        
        //if template does not exist, force default single/item template
        $found = locate_template($template . '-' . $slug . '.php');
        if(strlen($found) == 0)
        {
            $slug = 'default';
            if(is_single())
            {
                $slug .= '-single';
            }
            else
            {
                $slug .= '-list-item';
            }
        }
        
        //load template
        get_template_part($template, $slug);
		
	endwhile;
else :
	echo _e('no posts found!', 'goliath');
endif;
?>