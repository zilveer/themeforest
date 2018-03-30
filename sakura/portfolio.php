<?php the_post(); ?>

<?php echo sakura_posted_on_date2(false); ?>

<div class="article"> 
  <h1 class="entry-title _cf"><?php the_title(); ?></h1> 
  
  <div class="entry-content"> 
   <?php sakura_post_before(); ?>
   <?php the_content(); ?>
   <?php edit_post_link( __( 'Edit', 'sakura' ), '<p><span class="edit-link">', '</span></p>' ); ?>

<div class="gallery">

<?php

global $post, $prev_post;
$prev_post=$post;

$_tag=$cat;
$args = array(
   'category' => $_tag,
   'numberposts' => 30,
   'orderby' => 'date',
   'order' => 'DESC'
);
$posts_sl = get_posts($args);
$c=1;
                  global $portfolio;
$ttt= (int)$portfolio->get_lb();

if ($ttt) echo '<script>gal_use_lb = '.$ttt.';</script>';

foreach ($posts_sl as $post_item) {
?>

      <?php //if ($c!=1 && $c%3==1) echo '</div><div class="port_tr">'; $c++; ?>

   <?php
   
            global $post, $more;
            $post=$post_item;
            //the_content_limit(20, "[Read more]");
            setup_postdata($post);
   
   ?>

      <div class="gallery_item<?php if ($c++<3) echo ' first'; ?>"> 
      
        <h4><a href="<?php echo get_permalink($post_item->ID); ?>" title="<?php echo $post_item->post_title; ?>" rel="bookmark"><?php echo $post_item->post_title; ?></a></h4> 
      
			   <?php
			         ob_start();
			         echo get_permalink($post_item->ID);
			         $link=ob_get_clean();
                  


//var_dump($t);

if ($ttt) $link = sakura_postimage(800, 0);

                  if (sakura_post_has_image())
                  echo '<a href="'.$link.'" class="shadow_light"'.($ttt ? ' rel="gal[g]"' : '').'><img src="'.sakura_postimage(280, 150).'" width="280" height="150" class="gallery_img" /></a>';
                  else echo 'no image';
			   ?>

         <?php
				ob_start();
				//the_excerpt(  );
            $more=0;
				the_content( __( '#LINK#', 'sakura' ) );
				//echo $post_item->post_content;
				$ret=ob_get_clean();
				
			   if (preg_match('/(<a[^>]+>#LINK#<\/a>)/', $ret, $m))
			   {
				   $ret=str_replace($m[1], '', $ret);
			   }
			   //$ret=wp_trim_excerpt($ret);
			   echo $ret;
         ?>
         <?php edit_post_link( __( 'Edit', 'sakura' ), '<p><span class="edit-link">', '</span></p>' ); ?>      

			<?php
			   if ($m[1])
			   {
			      $m[1]=str_replace('#LINK#', '', $m[1]);
			      $m[1]=str_replace('more-link', 'go_details', $m[1]);
			      echo ''.$m[1].'';
			   }
			?>
      </div> 

<?php
}
?>

</div>

</div>

</div>

<?php 
global $post, $prev_post;
$post=$prev_post;
setup_postdata($post);
//global $post;
//$post = $wp_query->post;
//print_r($post);
comments_template( '', true );
 ?>


