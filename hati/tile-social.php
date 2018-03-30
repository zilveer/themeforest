
<h4><?php Acorn::eget( 'heading-2' ) ?></h4>
<p class="social">
  
<?php
  
  $before = $after = '';

  # usernames
  
  if ($n = Acorn::get('social-dribbble-name'))
    echo "{$before}<a href='http://dribbble.com/{$n}'>d</a>{$after}";
  
  if ($n = Acorn::get('social-github-name'))
    echo "{$before}<a href='http://github.com/{$n}'>H</a>{$after}";
  
  if ($n = Acorn::get('social-instagram-name'))
    echo "{$before}<a href='http://instagram.com/{$n}'>I</a>{$after}";
  
  if ($n = Acorn::get('social-pinterest-name'))
    echo "{$before}<a href='http://pinterest.com/{$n}'>p</a>{$after}";
  
  if ($n = Acorn::get('social-twitter-name'))
    echo "{$before}<a href='http://twitter.com/{$n}'>T</a>{$after}";
  
  if ($n = Acorn::get('social-vimeo-name'))
    echo "{$before}<a href='http://vimeo.com/{$n}'>V</a>{$after}";
    
  # URLs  
  
  if ($u = Acorn::get('social-facebook-url'))
    echo "{$before}<a href='{$u}'>F</a>{$after}";
  
  if ($u = Acorn::get('social-googleplus-url'))
    echo "{$before}<a href='{$u}'>g</a>{$after}";
  
  if ($u = Acorn::get('social-linkedin-url'))
    echo "{$before}<a href='{$u}'>l</a>{$after}";
  
  if ($u = Acorn::get('social-tumblr-url'))
    echo "{$before}<a href='{$u}'>u</a>{$after}";

?>

</p>