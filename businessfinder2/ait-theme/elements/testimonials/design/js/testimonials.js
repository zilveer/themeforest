

jQuery(document).ready(function() {
    var holder = jQuery('ul.testimonials'),
        height = holder.find('li#testimonial-1').css('height');
    holder.css('height', height);
    holder.parent().css('visibility', 'visible');
});

jQuery(window).load(function(){
    slider();
});

function slider(){
    var sliderAnimSpeed = 1000;
    var sliderAnimDelay = 5000;

    var interval = setInterval( "run("+sliderAnimSpeed+")", sliderAnimDelay );

    jQuery('div.testimonial-arrows div.arrow-left').stop(true,true).click(function(){
        clearInterval(interval);
        move('prev', sliderAnimSpeed);
    });
    jQuery('div.testimonial-arrows div.arrow-right').stop(true,true).click(function(){
        clearInterval(interval);
        move('next', sliderAnimSpeed);
    });

    // hover freeze
    jQuery('div.testimonials-container').hover(function(){
        clearInterval(interval);
    },function(){
        interval = setInterval( "run("+sliderAnimSpeed+")", sliderAnimDelay );
    });
}

function run(speed){
    var itemContainer = jQuery('ul.testimonials');
    var itemCount = itemContainer.children().length;
    var currentItem = itemContainer.find('li.active');
    var currentItemIndex = currentItem.index()+1;

    if(itemCount == 1){

    } else {
        if(currentItemIndex == itemCount){
            itemContainer.css('height', itemContainer.find('li#testimonial-'+1).css('height'));
            itemContainer.find('li#testimonial-'+currentItemIndex).removeClass('active').fadeOut(parseInt(speed/2));
            itemContainer.find('li#testimonial-'+1).addClass('active').fadeIn(parseInt(speed));
        } else {
            itemContainer.css('height', itemContainer.find('li#testimonial-'+(currentItemIndex+1)).css('height'));
            itemContainer.find('li#testimonial-'+currentItemIndex).removeClass('active').fadeOut(parseInt(speed/2));
            itemContainer.find('li#testimonial-'+(currentItemIndex+1)).addClass('active').fadeIn(parseInt(speed));
        }
    }
}

function move(direction, speed){
    var itemContainer = jQuery('ul.testimonials');
    var itemCount = itemContainer.children().length;
    var currentItem = itemContainer.find('li.active');
    var currentItemIndex = currentItem.index()+1;


    switch(direction){
        case 'next':
            var nextItemIndex = 0;
            if(currentItemIndex == itemCount){
                nextItemIndex = 1;
            } else {
                nextItemIndex = currentItemIndex + 1;
            }
            itemContainer.css('height', itemContainer.find('li#testimonial-'+nextItemIndex).css('height'));
            itemContainer.find('li#testimonial-'+currentItemIndex).removeClass('active').fadeOut(parseInt(speed/2));
            itemContainer.find('li#testimonial-'+nextItemIndex).addClass('active').fadeIn(parseInt(speed));
        break;
        case 'prev':
            var prevItemIndex = 0;
            if(currentItemIndex == 1){
                prevItemIndex = itemCount;
            } else {
                prevItemIndex = currentItemIndex - 1;
            }
            itemContainer.css('height', itemContainer.find('li#testimonial-'+prevItemIndex).css('height'));
            itemContainer.find('li#testimonial-'+currentItemIndex).removeClass('active').fadeOut(parseInt(speed/2));
            itemContainer.find('li#testimonial-'+prevItemIndex).addClass('active').fadeIn(parseInt(speed));
        break;

    }
}
