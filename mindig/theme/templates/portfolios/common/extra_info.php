<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>
 <div class="portfolio_meta">
    <?php if( $year != '' ): ?>
         <div class="portfolio_year">
             <span class="meta_title shade-1"><?php _e( 'Year:', 'yit' ) ?></span>
             <span class="shade-3 meta_content"><?php echo $year ?></span>
         </div>
     <?php endif; ?>
         <?php if( $budget != '' ): ?>
        <div class="budget_year">
            <span class="meta_title shade-1"><?php _e( 'Budget:', 'yit' ) ?></span>
            <span class="shade-3 meta_content"><?php echo $budget ?></span>
        </div>
    <?php endif; ?>
    <?php if( $customer != '' ): ?>
        <div class="portfolio_customer">
            <span class="meta_title shade-1"><?php _e( 'Customer:', 'yit' ) ?></span>
            <span class="shade-3 meta_content"><?php echo $customer ?></span>
        </div>
    <?php endif; ?>
    <?php if( $project != '' ): ?>
        <div class="portfolio_customer">
            <span class="meta_title shade-1"><?php _e( 'Project:', 'yit' ) ?></span>
            <span class="shade-3 meta_content"><?php echo $project ?></span>
        </div>
    <?php endif; ?>
    <?php if( $website != '' ) : ?>
        <div class="portfolio_website">
            <span class="meta_title shade-1"><?php _e( 'Website:', 'yit' ) ?></span>
            <span class="shade-3 meta_content">
                <?php if( $website_url != '' ) : ?>
                    <a href="<?php echo $website_url ?>" class="meta_link">
                        <?php echo $website ?>
                    </a>
                <?php else : ?>
                    <?php echo $website ?>
                <?php endif; ?>
            </span>
        </div>
    <?php endif; ?>
</div>