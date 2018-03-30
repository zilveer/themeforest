{var $datesCount = count($dates)}

{if $datesCount > 1}

	{if isset($layout) and $layout == 'infobox'}

		<ul class="recurring-dates">
		{foreach $dates as $date}
			{var $counter = $iterator->counter}

			{var $dateFrom_timestamp = strtotime($date['dateFrom'])}
			{var $dateFromDay        = date('d', $dateFrom_timestamp)}
			{var $dateFromMonth      = date('M', $dateFrom_timestamp)}

			<li><span class="day">{$dateFromDay}</span><span class="month">{$dateFromMonth}</span></li>

			{if isset($count) and $counter === $count} {? break} {/if}
		{/foreach}
		</ul>

	{else}

		<div id="schedule" class="recurring-dates-container">
			{var $allDates = array()}

			<div class="calendar-toggle">
				<h2 class="title"><span class="calendar-count">{$datesCount}</span> {__ ('Scheduled Dates')}</h2>
				<div class="carousel-arrows">
					<div class="arrow arrow-left disabled"><i class="fa fa-chevron-left"></i></div>
					<div class="arrow arrow-right"><i class="fa fa-chevron-right"></i></div>
				</div>
			</div>

			<div class="content">
				<div class="recurring-dates">
					<div class="dates-wrap">
						<div class="dates-carousel">
						{foreach $dates as $date}
							{var $dateFrom_timestamp = strtotime($date['dateFrom'])}
							{var $dateFromDay        = date('d', $dateFrom_timestamp)}
							{var $dateFromMonth      = date('M', $dateFrom_timestamp)}
							{var $timeFrom           = date('H:i', $dateFrom_timestamp)}

							{var $oneDate = array(
								'start'  => $date['dateFrom'],
								'end'    => !empty($date['dateTo']) ? $date['dateTo'] : '',
								'allDay' => false
							)}
							{? array_push($allDates, $oneDate)}

							<div class="single-date">
								<a href="#" data-date="{$date['dateFrom']}">
									<div class="date">
										<span class="day">{$dateFromDay}</span><span class="month">{$dateFromMonth}</span>
									</div>

									<div class="time">
										<span>{$timeFrom}</span>
									</div>
								</a>
							</div>
						{/foreach}
						</div>
					</div>
				</div>

				<div id="event-calendar" class="event-calendar"></div>
			</div>

			<script>

				jQuery(document).ready(function() {

					/* Carousel Init */
					eventsCarousel();

					jQuery("#schedule .single-date > a").click(function(e) {
						e.preventDefault();
						var date = jQuery(this).data('date');
						jQuery('#event-calendar').fullCalendar( 'gotoDate', date )
						jQuery('#event-calendar .fc-event').removeClass('active');
						jQuery('#schedule .single-date > a').removeClass('active');
						jQuery('#event-calendar').find('[data-date="'+date+'"]').addClass('active');
						jQuery(this).addClass('active');
					});

					/* Carousel Controls */
					jQuery("#schedule .arrow-left").click(function() {
						eventsCarouselMove('left');
					});
					jQuery("#schedule .arrow-right").click(function() {
						eventsCarouselMove('right');
					});

					/* Calendar Init */
					jQuery('#event-calendar').fullCalendar({
						height: "auto",
						header: {
							left: 'title',
							right: 'month,agendaWeek,agendaDay today prev,next'
						},
						defaultDate: {$allDates[0]['start']},
						// lang: {AitLangs::getCurrentLanguageCode()},
						eventLimit: false,
						events: {$allDates},
						timeFormat: 'H:mm',
						displayEventEnd: true,
						/*viewRender: function(view, element) {
							if (!isMobile()) {
								calendarScrollbar();
							}
						},*/
						eventRender: function(event, element) {
							element.attr("data-date", event.start._i);
						},
					});

					/* Activate First Date */
					jQuery("#schedule .single-date:first-of-type > a").trigger('click');

					/* Calendar Responsive */
					if (isResponsive(640)) {
						jQuery('#event-calendar').fullCalendar( 'changeView', 'agendaDay' );
					} else {
						jQuery('#event-calendar').fullCalendar( 'changeView', 'month' );
					}
				});

				jQuery(window).resize(function() {

					/* Carousel */
					eventsCarousel();

					/* Calendar View */
					if (isResponsive(640)) {
						jQuery('#event-calendar').fullCalendar( 'changeView', 'agendaDay' );
					} else {
						jQuery('#event-calendar').fullCalendar( 'changeView', 'month' );
					}
				});

				/* Carousel */
				function eventsCarousel() {
					var container = jQuery("#schedule"),
						carousel = jQuery("#schedule .dates-carousel"),
						carouselWidth = jQuery("#schedule .dates-wrap").width(),
						carouselArrows = jQuery("#schedule .carousel-arrows"),
						oneBoxWidth = jQuery("#schedule .dates-carousel .single-date").width(),
						boxGap = parseInt(carousel.find(".single-date").css('margin-right')),
						allBoxes = 0,
						count = 0;

					carousel.find(".single-date").each(function(){
						allBoxes = allBoxes + jQuery(this).outerWidth(true);
						count = count + 1;
					});

					var max = Math.round(carouselWidth / oneBoxWidth);

					carousel.attr("data-max", max);
					carousel.attr("data-all", count);

					if ((allBoxes - boxGap) > (carouselWidth + (oneBoxWidth / 2))) {
						container.addClass('carousel-on');

						// compute new width .. after the carousel-on class has been applied
						carouselWidth = jQuery("#schedule .dates-wrap").width();

						carousel.width(carouselWidth);
						carousel.css('margin-left', 0)
						carouselArrows.show();
						eventsCarouselMove('reset');
					} else {
						container.removeClass('carousel-on');
						carouselArrows.hide();
					}
				}

				function eventsCarouselMove(direction) {
					var boxWidth = parseInt(jQuery("#schedule .dates-carousel .single-date").outerWidth(true)),
						carousel = jQuery("#schedule .dates-carousel"),
						maxClicks = carousel.data('all') - carousel.data('max'),
						step = parseInt(carousel.css('margin-left'))*(-1),
						arrowLeft = jQuery("#schedule .arrow-left"),
						arrowRight = jQuery("#schedule .arrow-right");

					switch(direction) {
						case "left":
							if (step >= boxWidth && !carousel.hasClass("moving")) {
								carousel.addClass("moving");
								carousel.css({'margin-left':-(step - boxWidth)});
								arrowRight.removeClass("disabled");
								setTimeout(function(){
									carousel.removeClass("moving");
								}, 600);
							}

							if (step == boxWidth || step == 0) {
								arrowLeft.addClass("disabled");
							} else {
								arrowLeft.removeClass("disabled");
								arrowRight.removeClass("disabled");
							}

						break;

						case "right":
							if (step < (boxWidth * maxClicks) && !carousel.hasClass("moving")) {
								carousel.addClass("moving");
								carousel.css({'margin-left':-(step + boxWidth)});
								arrowLeft.removeClass("disabled");
								setTimeout(function(){
									carousel.removeClass("moving");
								}, 600);
							}

							if (step == (boxWidth * maxClicks) - boxWidth || step == (boxWidth * maxClicks)) {
								arrowRight.addClass("disabled");
							} else {
								arrowLeft.removeClass("disabled");
								arrowRight.removeClass("disabled");
							}
						break;

						case "reset":
							if (!arrowLeft.hasClass("disabled")) arrowLeft.addClass("disabled");
							arrowRight.removeClass("disabled");
						break;
					}
				}


			</script>
		</div>

	{/if}

{/if}
