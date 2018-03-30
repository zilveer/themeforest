<?php global $term, $h; ?>

      <div class="folio_box col_<?php echo taxonomy_get_size($term->term_id); ?> for_post_<?php echo $term->term_id; ?>">
        <div class="folio" style="background: url(<?php echo $term->pic; ?>) 0 0; height: <?php echo $h; ?>px;">
  
          <div class="folio_mask">

            <div class="folio_caption">
              <div>
                <div>
                  <a href="#"><?php echo $term->name; ?></a>
                </div>
              </div>
            </div>
            <div class="folio_desc">

              <div class="desc_body">
                <?php echo $term->description; ?>
              </div>
              <div class="goto_post"><a href="#" class="go_more"><span><i></i>View pictures</span></a> <!-- <span class="ico_link date">1 day ago</span> --></div>
            </div>
          </div>
  
          <div class="folio_just_caption">
            <div>

              <div>
                <a href="#"><?php echo $term->name; ?></a>
              </div>
            </div>
          </div>
  
        </div>
      </div>
