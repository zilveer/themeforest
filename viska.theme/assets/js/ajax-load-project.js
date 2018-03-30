jQuery(document).ready(function($){

var window_height = $(window).height(),
    testMobile,
    loadingError = '<p class="error">The Content cannot be loaded.</p>',
    nameError = '<div class="alert alert-error">Please enter your name.</div>',
    emailError = '<div class="alert alert-error">Please enter your e-mail address.</div>',
    invalidEmailError = '<div class="alert alert-error">Please enter a valid e-mail address.</div>',
    subjectError = '<div class="alert alert-error">Please enter the subject.</div>',
    messageError = '<div class="alert alert-error">Please enter your message.</div>',
    mailSuccess = '<div class="alert alert-success">Your message has been sent. Thank you!</div>',
    mailResult = $('#contact .result'),
    current,
    next,
    prev,
    target,
    hash,
    url,
    page,
    title,
    projectIndex,
    scrollPostition,
    projectLength,
    ajaxLoading = false,
    wrapperHeight,
    pageRefresh = true,
    content =false,
    loader = $('div#loader'),
    workGrid = $('div#work-wrap'),
    projectContainer = $('div#ajax-content-inner'),
    projectNav = $('#project-navigation ul'),
    exitProject = $('div.closeProject a'),
    easing = 'easeOutExpo',
    folderName ='projects';





/*----------------------------------------------------*/
// LOAD PROJECT
/*----------------------------------------------------*/



$(function(){


    $(window).bind( 'hashchange', function() {


        hash = $(window.location).attr('hash');
        var root = '#'+ folderName +'-';
        var rootLength = root.length;
        if( hash.substr(0,rootLength) != root ){
            return;
        } else {

            var correction = 50;
            var headerH = $('header#header').outerHeight()+correction;
            hash = $(window.location).attr('hash');
            single = hash.replace(/[#]/g, '' );
            s = single.replace(/projects-/gi,'');
            url = location.origin + location.pathname + '?awe_portfolio=' + s;
            //url = 'http://localhost/viska/?awe_portfolio=tets';
            workGrid.find('div.work-item.current').children().removeClass('active');
            workGrid.find('div.work-item.current').removeClass('current' );
            /* IF URL IS PASTED IN ADDRESS BAR AND REFRESHED */
            if(pageRefresh == true && hash.substr(0,rootLength) ==  root){
                $('html,body').stop().animate({scrollTop: (projectContainer.offset().top-20)+'px'},800,'easeOutExpo', function(){
                    loadProject();
                });
                /* CLICKING ON work GRID OR THROUGH PROJECT NAVIGATION */
            }else if(pageRefresh == false && hash.substr(0,rootLength) == root){
                $('html,body').stop().animate({scrollTop: (projectContainer.offset().top-headerH)+'px'},800,'easeOutExpo', function(){

                    if(content == false){
                        loadProject();
                    }else{
                        projectContainer.animate({opacity:0,height:wrapperHeight},function(){
                            loadProject();
                        });
                    }

                    projectNav.fadeOut('100');
                    exitProject.fadeOut('100');

                });

                /* USING BROWSER BACK BUTTON WITHOUT REFRESHING */
            }else if(hash=='' && pageRefresh == false || hash.substr(0,rootLength) != root && pageRefresh == false || hash.substr(0,rootLength) != root && pageRefresh == true){
                scrollPostition = hash;
                console.log(scrollPostition);
                $('html,body').stop().animate({scrollTop: scrollPostition+'px'},1000,function(){

                    deleteProject();

                });

                /* USING BROWSER BACK BUTTON WITHOUT REFRESHING */
            }



            /* ADD ACTIVE CLASS TO CURRENTLY CLICKED PROJECT */
            workGrid.find('div.work-item .work a[href="#projects-' + s + '"]' ).parent().parent().addClass( 'current' );
            workGrid.find('div.work-item.current').find('.work').addClass('active');
        }

    }); // end window bind
    /* LOAD PROJECT */
    function loadProject(){
        $('#ajax-content-inner').html('');
        loader.fadeIn().removeClass('projectError').html('');


        if(!ajaxLoading) {
            ajaxLoading = true;

            projectContainer.load( url +' div#ajaxpage', function(xhr, statusText, request){

                if(statusText == "success"){

                    ajaxLoading = false;

                    page =  $('div#ajaxpage');

                    $(".owl-box").owlCarousel({
                        autoPlay: 10000,
                        slideSpeed : 1000,
                        navigation: true,
                        navigationText : ["", ""],
                        pagination: false,
                        singleItem:true
                    });

                    hideLoader();

                    $(".ajax-inner").fitVids();

                }

                if(statusText == "error"){

                    loader.addClass('projectError').append(loadingError);

                    loader.find('p').slideDown();

                }

            });

        }

    }



    function hideLoader(){
        loader.fadeOut('fast', function(){
            showProject();
        });
    }


    function showProject(){
        if(content==false){
            wrapperHeight = projectContainer.children('div#ajaxpage').outerHeight()+'px';
            projectContainer.css('overflow', 'hidden').animate({opacity:1}, function(){
                $(".ajax-inner").fitVids();
                scrollPostition = $('html,body').scrollTop();
                projectNav.fadeIn();
                exitProject.fadeIn();
                content = true;
            });

        }else{
            wrapperHeight = projectContainer.children('div#ajaxpage').outerHeight()+'px';
            projectContainer.animate({opacity:1,height:wrapperHeight}, function(){
                $(".ajax-inner").fitVids();
                scrollPostition = $('html,body').scrollTop();
                projectNav.fadeIn();
                exitProject.fadeIn();

            });
        }


        projectIndex = workGrid.find('div.work-item.current').index();
        projectLength = $('div.work-item .work').length-1;


        if(projectIndex == projectLength){

            $('ul li.nextProject a').addClass('disabled');
            $('ul li.prevProject a').removeClass('disabled');

        }else if(projectIndex == 0){

            $('ul li.prevProject a').addClass('disabled');
            $('ul li.nextProject a').removeClass('disabled');

        }else{

            $('ul li.nextProject a,ul li.prevProject a').removeClass('disabled');

        }

    }



    function deleteProject(closeURL){
        projectNav.fadeOut(100);
        exitProject.fadeOut(100);
        projectContainer.animate({opacity:0,height:'0px'});
        if(typeof closeURL!='undefined' && closeURL!='') {
            location = '#_';
        }
        workGrid.find('div.work-item.current').children().removeClass('active');
        workGrid.find('div.work-item.current').removeClass('current' );
    }


    /* LINKING TO PREIOUS AND NEXT PROJECT VIA PROJECT NAVIGATION */
    $('.nextProject a').on('click',function () {

        current = workGrid.find('.work-item.current');
        next = current.next('.work-item');
        target = $(next).children('div').children('a').attr('href');
        $(this).attr('href', target);
        console.log(current);

        if (next.length === 0) {
            console.log("return");
            return false;
        }

        current.removeClass('current');
        current.children().removeClass('active');
        next.addClass('current');
        next.children().addClass('active');



    });



    $('.prevProject a').on('click',function () {

        current = workGrid.find('.work-item.current');
        prev = current.prev('.work-item');
        target = $(prev).children('div').children('a').attr('href');
        $(this).attr('href', target);


        if (prev.length === 0) {
            return false;
        }

        current.removeClass('current');
        current.children().removeClass('active');
        prev.addClass('current');
        prev.children().addClass('active');

    });


    /* CLOSE PROJECT */
    /* CLOSE PROJECT */
    $('.work-item .work-image').on('click',function () {
        // $('#ajax-content-outer').css('margin-top','70px');
    });
    $('.closeProject a').on('click',function () {
        //console.log("clicked");
        $('#ajax-content-outer').css('margin-top','0px');
        deleteProject($(this).attr('href'));
        workGrid.find('div.work-item.current').children().removeClass('active');
        loader.fadeOut();
        return false;

    });



    pageRefresh = true;


});

});/////////
	 
