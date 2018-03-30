<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	//ratings
	$ratings = get_post_meta( $post->ID, "_".THEME_NAME."_ratings", true );
	$summary = get_post_meta( $post->ID, "_".THEME_NAME."_overall", true );

?>
							<?php if($ratings || $summary) { ?>
                                <!-- Editor review -->
                                <div class="editor_review" itemscope itemtype="http://data-vocabulary.org/Review">
                                    <div class="panel_title">
                                        <div>
                                            <h4><?php  esc_html_e('Editor review', THEME_NAME ); ?></h4>
                                        </div>
                                    </div>
                                    <div class="inner clearfix">
										<?php 
											if($ratings) { 
												$totalRate = array();
												$rating = explode(";", $ratings);
 
												foreach($rating as $rate) { 
													$ratingValues = explode(":", $rate);
													if(isset($ratingValues[1])) {
														$ratingPrecentage = (str_replace(",",".",$ratingValues[1]))*20;
													}
													$totalRate[] = $ratingPrecentage;
													if($ratingValues[0]) {

										?>		 	
	                                        <!-- Review -->
	                                        <div class="review">
	                                            <div class="review_header">
	                                                <div class="title"><?php echo esc_html__($ratingValues[0]);?></div>
	                                                <div class="result"><?php echo round($ratingPrecentage/20, 2);?>/5</div>
	                                            </div>
	                                            <div class="review_footer">
	                                                <span style="width: <?php echo floatval($ratingPrecentage);?>%"></span>
	                                            </div>
	                                        </div>
	                                        <!-- End Review -->
										<?php 
													} 
												} 
											} 
									 	?>
                                        <!-- Review summary -->
                                        <div class="review_summary">

											<?php 
												if(!empty($totalRate)) { 
													$rateCount = count($totalRate);	
													$total = 0;
													foreach ($totalRate as $val) {
														$total = $total + $val;
													}

													$avaragePrecentage = round($total/$rateCount,2);
													$avarageRate = round((($total/$rateCount)/20),2);

													if($avarageRate>=4.75) {
														$rateText = esc_html__("Excellent",THEME_NAME);
													} else if($avarageRate<4.75 && $avarageRate>=3.75) {
														$rateText = esc_html__("Good",THEME_NAME);
													} else if($avarageRate<3.75 && $avarageRate>=2.75) {
														$rateText = esc_html__("Average",THEME_NAME);
													} else if($avarageRate<2.75 && $avarageRate>=1.75) {
														$rateText = esc_html__("Fair",THEME_NAME);
													} else if($avarageRate<1.75 && $avarageRate>=0.75) {
														$rateText = esc_html__("Poor",THEME_NAME);
													} else if($avarageRate<0.75) {
														$rateText = esc_html__("Very Poor",THEME_NAME);
													}
											?>
												<div class="final_result">
													<p itemprop="rating"><?php echo floatval($avarageRate);?></p>
													<strong><?php echo  esc_html__($rateText);?></strong>
													<div class="item_meta clearfix">
														<span class="meta_rating" title="<?php esc_attr_e("Rated", THEME_NAME);?> <?php echo floatval($avarageRate);?> <?php esc_attr_e("out of 5", THEME_NAME);?>">
	                                                        <span style="width: <?php echo floatval($avaragePrecentage);?>%"><strong class="rating"><?php echo floatval($avarageRate);?></strong></span>
	                                                    </span>
													</div>
									                <meta itemprop="itemreviewed" content="<?php echo esc_attr__(get_the_title()); ?>"/>
									                <meta itemprop="reviewer" content="<?php echo esc_attr__(get_the_author());?>"/>
									                <meta itemprop="dtreviewed" content="<?php echo esc_attr__(get_the_time("F d, Y")); ?>"/>
												</div>
											<?php } ?>

											<?php if($summary) { ?>
												<div class="final_summary">
													<h5><?php esc_html_e('Summary', THEME_NAME ); ?></h5>
													<p><?php echo esc_html__($summary);?></p>
												</div>
											<?php } ?>
                                        </div><!-- End Review summary -->
                                    </div>
                                </div><!-- End Editor review -->



						<?php } ?>