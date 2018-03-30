(function ($) {
    var ModalBox, linkHandler, closeHandler, scrollHandler;

    ModalBox = function (el) {
        this.el = $(el);
    }

    ModalBox.prototype.center = function () {
        var $el = this.el,
            $modalBox = $el.find('.modal-box'),
            parentHeight = $el.height(),
            childHeight = $modalBox.outerHeight(),
            offsetTop;

        if ( !$modalBox.is('.top') && !$modalBox.is('.bottom') ) {
            offsetTop = (parentHeight - childHeight) / 2;
            $modalBox.css('top', offsetTop);
        }

        if ( $modalBox.is('.bottom') ) {
            offsetTop = (parentHeight - childHeight);
            $modalBox.css('top', offsetTop);
        }
    };

    ModalBox.prototype.show = function () {
        var $el = this.el,
            id = $el.data('modal'),
            animation = $el.find('.modal-box').data('animation'),
            trigger = $el.find('.modal-box').data('cookie-trigger'),
            key = $el.find('.modal-box').data('cookie-key'),
            cookie_expire = $el.find('.modal-box').data('cookie'),
            $iframe = $el.find('iframe');

            var cookie = getCookie(id);

            if (cookie == key) {
                return;
            }

            if(trigger == 'open') {
             setCookie(id, key, cookie_expire);
            }


        if ( $('[data-modal].open').length ) $('[data-modal].open').modalBox('hide');

        if ( $iframe.length ) $iframe.attr('src', $iframe.data('iframeSrc'));

        $el.addClass('open');




        if ( animation == 'none' ) {
            $el.show();

        }else {
            $el.fadeIn(250);
        }




        this.center();
    };

    ModalBox.prototype.hide = function() {
        var $el = this.el,
            id = $el.data('modal'),
            animation = $el.find('.modal-box').data('animation'),
            trigger = $el.find('.modal-box').data('cookie-trigger'),
            key = $el.find('.modal-box').data('cookie-key'),
            cookie_expire = $el.find('.modal-box').data('cookie'),
            $iframe = $el.find('iframe');

            if(trigger == 'close') {
              setCookie(id, key, cookie_expire);
            }

        $el.removeClass('open');

        if ( animation && animation == 'none' ) {
            $el.hide();

            if ( $iframe.length ) $iframe.attr('src', '');

        }else {
            $el.fadeOut(250);

            setTimeout(function () {
                if ( $iframe.length ) $iframe.attr('src', '');
            }, 250);

        }
    };

    $.fn.modalBox = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('modalBox');

            if ( !data ) {
                data = new ModalBox(this);
                $this.data('modalBox', data);
            }

            if (typeof option == 'string') {
                data[option]();
            }
        });
    };

    linkHandler = function (event) {
        event.preventDefault();

        var modalId = $(this).data('modalLink'),
            $modalBox = $('[data-modal=' + modalId + ']');
        $modalBox.modalBox('show');
    };


    clickHandler = function (event) {
	//to refactor
	/*
        var $target = $(event.target);
        if ( !$target.closest('.modal-box').length ) {
            $(this).modalBox('hide');
        }
	*/
    };

    closeHandler = function () {
        $(this).closest('[data-modal]').modalBox('hide');
    };

    resizeHandler = function () {
        if ( $('[data-modal].open').length ) $('[data-modal].open').modalBox('center');
    };

    scrollHandler = function (event) {
		var $modalWindow = $(event.target).closest('.modal-window');
		scroll_lock = $modalWindow.data('scroll-lock');
		if (scroll_lock == 1){
			event.preventDefault();
			var e0 = event.originalEvent,
				delta = e0.wheelDelta || -e0.detail,
				$modalBox = $(event.target).closest('.modal-box');

			if ( $modalBox.length ) {
				$modalBox.get(0).scrollTop -= delta;
			}
		}
    };

    $('a').each(function(){

      var $link = $(this);
          $iframe =  $(this).data('iframe');
          if($iframe) {
            $modalId =  $(this).data('modalLink');
            $href = $(this).attr('href');
            // $w = $(this).data('width');
            // $h = $(this).data('height');

            $iframe = '<iframe src="'+$href+'" frameborder="0" allowfullscreen></iframe>';
            $modalBox = '<div class="modal-window" data-modal="'+$modalId+'"><div class="modal-box"><span class="close-btn icon icon-office-52"></span>'+$iframe+'</div></div>';
            $('body').append($modalBox);

          }

    });

    $('.modal-window').each(function () {
        var $modal = $(this),
            $modalBox = $modal.find('.modal-box'),
            id = $(this).data('modal'),
            time = $modal.data('timeout'),
            scroll = $modal.data('scroll');

        if ( $modal.find('iframe').length ) {
            var iframe = $modal.find('iframe'),
                src = iframe.attr('src');

            $modalBox.addClass('iframe-box');
            iframe.attr('src', '');
            iframe.data('iframeSrc', src);
        }

        if ( time ) {
            setTimeout(function () {
                $modal.modalBox('show');
            }, time);
        }

        if ( scroll ) {
            $(window).on('scroll.modalBox' + id, function () {
                if ( $(this).scrollTop() >= scroll ) {
                    $modal.modalBox('show');

                    $(window).off('.modalBox' + id);
                }
            });
        }
    });


    function setCookie(cname, cvalue, exdays) {
      var expires;
      var d = new Date();
      if(exdays == 0) {
        expires = 0;
      }
      else {
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        expires = "expires=" + d.toGMTString();
      }
      document.cookie = cname + "=" + cvalue + "; " + expires+ "; path=/";
    }

    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') c = c.substring(1);
          if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
      }
      return "";
    }

    $(document)
        .on('click.modalBox', '[data-modal-link]', linkHandler)
        .on('click.modalBox', '[data-modal]', clickHandler)
        .on('click.modalBox', '[data-modal] .close-btn', closeHandler)
        .on('mousewheel.modalBox DOMMouseScroll.modalBox', '[data-modal]', scrollHandler);

    $(window).on('resize.modalBox', resizeHandler);


})(jQuery);
