<?php $data = ct_get_posts_grouped_by_cat(array('post_type' => 'faq', 'showposts' => -1), 'faq_category');?>

<div class="inner">
	<div class="row-fluid">
	    <div class="span4">
			<?php if($data):?>
	            <div id="faq1" class="faqMenu" data-spy="affix" data-offset-top="160">
	                <ul class="nav">
			        <?php $counter = 0;?>
					<?php foreach($data as $catId => $details): ?>
					    <?php if(isset($details['cat'])):?>
					        <?php $counter++;?>
				            <li<?php if($counter==1):?> class="active"<?php endif; ?>><a href="#q<?php echo $catId?>"><?php echo $details['cat']; ?></a></li>
					    <?php endif;?>
					<?php endforeach;?>
		            </ul>
		        </div>
			<?php endif;?>
	    </div>

		<div class="span8">
			<?php if($data):?>
				<?php foreach($data as $catId => $details): ?>
					<div class="sectionFaq" id="q<?php echo $catId;?>">
				    <?php if(isset($details['posts']) && isset($details['cat'])):?>
						<h3 class="std"><?php echo $details['cat']; ?></h3>

						<?php foreach($details['posts'] as $faq): ?>
								<h4><?php echo $faq->post_title; ?></h4>

			                    <p>
			                        <?php echo $faq->post_content; ?>
			                    </p>
						<?php endforeach; ?>
				    <?php endif;?>
					</div>
				<?php endforeach;?>
			<?php endif;?>
	    </div>
	</div>
</div>