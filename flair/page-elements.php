<?php
	get_header();
	the_post();
?>
			
	<div class="pad90"></div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-lg-12">
						<h1 class="wow fadeInRightBig" data-wow-offset="80" data-wow-duration="2s">
							Elements
						</h1>
						
						<div class="lead wow fadeInRightBig" data-wow-offset="80" data-wow-duration="2s">
							Tabs, 
							accordion, <span class="colour"><strong>social</strong></span> streams, carousels &amp; <span class="colour">responsive</span> videos. 
						</div>
					</div>
				</div>
			</div>
			
<!-- BARS -->		
	<div class="container pad30"><div class="row">
		<div class="col-md-12"><div class="row"><div class="col-md-6">		
				<h4>Progress Bars</h4>
				<!-- skill bars -->
				<div class="bars-wrapper">
				<!-- 1 -->
					<div>
						<div class="pull-left">Web Design</div>
						<div class="pull-right">90%</div>
						<div class="clearfix"></div>
					</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
					</div>
				</div>
				
				<!-- 2 -->				
					<div>
						<div class="pull-left">Photography</div>
						<div class="pull-right">65%</div>
						<div class="clearfix"></div>
					</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
					</div>
				</div>
				<!-- 3 -->
				<div>
					<div class="pull-left">Illustration</div>
					<div class="pull-right">75%</div>
					<div class="clearfix"></div>
				</div>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
			</div>
		</div>			
			</div>
			<!-- //end bars -->
			</div>
					
<!-- TOOLTIPS -->						
				<div class="col-md-6">		
				<h4>Tooltips</h4>
				<p>Lorem ipsum dolor sit amet, <a data-rel="tooltip" href="#" data-original-title="left tooltip" data-placement="left"> left tooltip</a> consectetur  elit. 
				Curabitur pellentesque neque eget <a data-rel="tooltip" href="#" data-original-title="right tooltip" data-placement="right">right tooltip</a> diam posuere porta. <br>
				Quisque ut nulla lacinia adipiscing porta tellus, 
				<a data-rel="tooltip" href="#" data-original-title="bottom tooltip" data-placement="bottom">bottom tooltip</a> adipiscing sit  ultrices posuere amet.  <br>
				In eu justo a felis  vel id metus. Vestibulum ante ipsum primis
				<a data-rel="tooltip" href="#" data-original-title="top tooltip">top tooltip</a> luctus et ultrices posuere cubilia Curae.</p>
						</div>
							</div>
						</div>
					</div>

<!-- PHOTOSTREAMS -->	
	<div class="container pad30"><div class="row"> 
		<div class="col-md-12"><div class="row"> 
			<h4>Photostreams</h4>
				<div class="row"> 
					
					<div class="col-md-3 text-left">
						<article class="social-feed flickr-feed"></article>
					<small>FLICKR</small>
					</div>
					
					<div class="col-md-3">
						<article class="social-feed dribbble-feed"></article>	
					<small>DRIBBBLE</small>
					</div>
						
					<div class="col-md-3">
						<article class="social-feed pinterest-feed"></article>		
					<small>PINTEREST</small>
					</div>
					
					<div class="col-md-3">
						<article class="social-feed youtube-feed"></article>
					<small>YOU TUBE</small>
					</div>
					
					</div>
				</div>
			</div>
		</div>
			</div>
						
<!-- CAROUSEL -->	
	<div class="col-md-12 pad45">
		<div class="row">
			<div class="col-md-6"><div class="row">
					<h4>Carousel</h4>
					
						<div id="big" class="owl-carousel pad5">
             <div class="item">
				<img  src="<?php echo get_template_directory_uri(); ?>/img/gallery/p2.jpg" alt="Image 1">
			</div>
			<div class="item">
				<img src="<?php echo get_template_directory_uri(); ?>/img/gallery/p3.jpg" alt="Image 2">
			</div>
			</div>
		</div>
			</div>
			
			<div class="col-md-6">	
				<h4>Tabs</h4>
<!-- TABS-->	
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-star hue"></i> Tab1</a></li>
					<li><a href="#tab2" data-toggle="tab"><i class="fa fa-tag hue"></i> Tab2</a></li>
				</ul>
					<div class="tab-content">
					<!-- 1 -->
						<div class="tab-pane fade in active" id="tab1">
							<h6>Happy clients</h6>
								<p>Knight Foundation Bill Keller afternoon paper I love the Weather Opera section bloggers in their mother's basement retweet analog thinking crowdsourcing, 
								just across the wire David Cohn mthomps.</p> 
							<h6>Elements galore</h6>
								<p>Newspaper, the medium is the message tags tools Gardening War section The Work of Art in the Age of Mechanical Reproduction got drudged. 
								Demand Media put the paper to bed MinnPost. </p>
							</div>
							<!-- 2 -->		
						<div class="tab-pane fade" id="tab2">
							<h6>Journo Ipsum</h6>
								<p>Fuego scoop afternoon paper Sulzberger Andy Carvin rubber cement hyperlocal newsroom cafe future of narrative stream digital first, crowdsourcing layoffs in the 
								slot just across the wire Android blog Julian Assange Aron Pilhofer go viral.</p>
							<h6>News nerds</h6>
								<p>Journal Register Dan Fleckner Frontline copyright linkbait layoffs WordPress Fuego open newsroom, media diet data visualization backpack journalist newsroom 
								cafe hackgate WSJ.</p> 
							</div>
						</div>
					</div>
				</div>
					</div>
						</div>

<!-- ACCORDION -->				
		<div class="col-md-12 pad45">
		<div class="row">
			<div class="col-md-6"><div class="row">
		<h4>Accordion</h4>
		<div class="panel-group pad5" id="accordion">
			<!-- 1 -->
				<div class="accordion-group">
					<div class="panel-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href=".collapseOne">
								<div class="collapseOne collapse in">
								<i class="fa fa-chevron-down pull-right marg-right5 ic-acc2"></i>
								What services do you provide?
								</div> 
								<div class="collapseOne collapse">
								<i class="fa fa-chevron-up pull-right marg-right5 ic-acc2"></i>
								What services do you provide?
								</div>
							</a>
								</div>
								
								<div class="collapseOne accordion-body collapse in">
									<div class="panel-body">
										Voice of San Diego Pulse +1 NYT RD Gardening War section tweets Colbert bump WordPress stream, Robin Sloan stream Paul Steiger scoop Gawker 
										Bill Keller copyright, hyperlocal filters stream Article Skimmer.
									</div>
								</div>
							</div>

				</div>
						</div>
							</div>
							
							<div class="col-md-6">
							<h4>Responsive Video</h4>
							<div class="vendor">
							<iframe src="http://player.vimeo.com/video/89413330?title=0&amp;byline=0&amp;portrait=0"></iframe>
						</div>
					</div>
				</div>
			</div>
				</div>
					<div class="pad60"></div>

<?php get_footer();