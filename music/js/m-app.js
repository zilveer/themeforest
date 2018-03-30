;(function ($) {

    $.cromaPlay = function(el) {
        var croma       = $(el),
            methods     = {},
            playlist    = croma.find('#croma-playlist').find('ul'),
            playTrack   = croma.find('.croma-track'),
            playArtist  = croma.find('.croma-artist'),
            currentTime = croma.find('.croma-current-time'),
            playcov     = croma.find('.croma-cover a'),
            pBar        = croma.find('.croma-playbar'),
            firstMedia  =  CromaMultiplay[0].mp3,
            listItems   = '',
            autop       = Cromaplayauto.autoplay;

        playlist.empty();
        for (i=0; i < CromaMultiplay.length; i++) {
            listItems += '<li><a class="croma-playlist-item" tabindex="1" href="javascript:;" rel="' + i +  '"><span class="listtrack smallfont">' +  CromaMultiplay[i].name   +  '</span><span class="listauthor smallfont">' +  CromaMultiplay[i].artist   +  '</span></a></li>';
        }


        playcov.click(function() {
            var ref = $(this).attr('href');
            window.location = ref;
        })

        currentTime.css('color',CromaplaySettings.color);
        pBar.css('background',CromaplaySettings.color);

        selectors = {
                play            : '.croma-play',
                pause           : '.croma-pause',
                stop            : '.croma-stop',
                currentTime     : '.croma-current-time',
                seekBar         : '.croma-seek',
                playBar         : '.croma-playbar',
                gui             : '.croma-playerinterface',
                volumeBar       : '.croma-volume-back',
                volumeBarValue  : '.croma-volume-bar'
            };

        playTrack.html(CromaMultiplay[0].name);
        playArtist.html(CromaMultiplay[0].artist);
        playlist.append(listItems);

        playlist.find('a').bind('click',clicklist);

        playlist.find('li:eq(0)').addClass('current');

        playmedia(firstMedia, autop);


        $('.croma-next').click(function() {
            var current     = playlist.find('.current'),
                next        = current.next('li').length ? current.next('li'): playlist.find('li:eq(0)'),
                reller      = next.find('a').attr('rel'),
                medialink   = CromaMultiplay[reller].mp3;
            
            current.toggleClass('current');
            next.addClass('current');
            playTrack.html(CromaMultiplay[reller].name);
            playArtist.html(CromaMultiplay[reller].artist);
            $('#cromaplay').jPlayer('setMedia', {
                mp3: medialink
            });
            $('#cromaplay').jPlayer('play');
        });

        $('.croma-previous').click(function() {
            var current     = playlist.find('.current'),
                next        = current.prev('li').length ? current.prev('li'): playlist.find('li:last'),
                reller      = next.find('a').attr('rel'),
                medialink   = CromaMultiplay[reller].mp3;
            
            current.toggleClass('current');
            next.addClass('current');
            playTrack.html(CromaMultiplay[reller].name);
            playArtist.html(CromaMultiplay[reller].artist);
            $('#cromaplay').jPlayer('setMedia', {
                mp3: medialink
            });
            $('#cromaplay').jPlayer('play');
        });

        function clicklist() {
            playlist.find('.current').toggleClass('current');
            $(this).parents('li').addClass('current');
            var reller = $(this).attr('rel');
            medialink = CromaMultiplay[reller].mp3;
            playTrack.html(CromaMultiplay[reller].name);
            playArtist.html(CromaMultiplay[reller].artist);
            changemedia(medialink);
        }

        function playnext() {
            var current     = playlist.find('.current'),
                next        = current.next('li'),
                reller      = next.attr('rel'),
                medialink   = CromaMultiplay[reller].mp3;
            
            playlist.find('.current').toggleClass('current');
            playTrack.html(CromaMultiplay[reller].name);
            playArtist.html(CromaMultiplay[reller].artist);
            changemedia(medialink);
        }

        function changemedia(mediasource) {
            $('#cromaplay').jPlayer('setMedia', {
                mp3: mediasource
            });
            $('#cromaplay').jPlayer('play');
        }

        function playnext() {
            var current     = playlist.find('.current'),
                next        = current.next('li'),
                reller      = next.attr('rel'),
                medialink   = CromaMultiplay[reller].mp3;
            
            current.toggleClass('current');
            playTrack.html(CromaMultiplay[reller].name);
            playArtist.html(CromaMultiplay[reller].artist);
            changemedia(medialink);
        }

        function playmedia(mediasource, autop) {
            $('#cromaplay').jPlayer({
                ready: function () {
                    $('#cromaplay').jPlayer('setMedia', {
                        mp3: mediasource
                    });
                    if (autop == 'yes') {
                       $(this).jPlayer('play');
                    }

                },
                ended: function() {
                    var current     = playlist.find('.current'),
                        next        = current.next('li').length ? current.next('li'): playlist.find('li:eq(0)'),
                        reller      = next.find('a').attr('rel'),
                        medialink   = CromaMultiplay[reller].mp3;
            
                        current.toggleClass('current');
                        next.addClass('current');
                        playTrack.html(CromaMultiplay[reller].name);
                        playArtist.html(CromaMultiplay[reller].artist);
                        $('#cromaplay').jPlayer('setMedia', {
                            mp3: medialink
                        });
                        $('#cromaplay').jPlayer('play');
                },
                play: function() {
                    $(this).jPlayer("pauseOthers");
                    $('.psholder').hide();
                },
                swfPath: CromaplaySettings.swfPath,
                supplied: 'mp3',
                solution: 'html, flash',
                cssSelectorAncestor: '#cromaplay_composite',
                cssSelector: selectors
            }); // this.jplayer
        }
    }

    $.cromaSPlay = function(el, ammt) {
        var croma       = $(el),
            methods     = {},
            currentTime = croma.find('.croma-current-time-s-' + ammt),
            pBar        = croma.find('.croma-playbar-s-' + ammt),
            firstMedia  = croma.attr('rel'),
            identi      = '#cromaplay-s-' + ammt,
            ancest      = '#cromaplay_single-' + ammt,
            playlist    = croma.parents('.themusic');


        playlist.find('.ui-singlename').bind('click',clicklist);

        pBar.css('background',CromaplaySettings.color);

        selectors = {
                play            : '.croma-play-s-' + ammt,
                pause           : '.croma-pause-s-' + ammt,
                currentTime     : '.croma-current-time-s-' + ammt,
                seekBar         : '.croma-seek-s-' + ammt,
                playBar         : '.croma-playbar-s-' + ammt,
                gui             : '.croma-playerinterface-s-' + ammt
            };


        function clicklist() {
            var reller = $(this).attr('rel');
            var posit = $(this).parents('.singleout').position();
            $('body').find('.mplayhold').show();
            $('.mplayhold').css('top', posit.top + 'px');
            $('.ui-singlename').each(function() {
                $(this).css('display','block');
            });
            $(this).css('display', 'none');
            changemedia(reller, identi);

        }


        function changemedia(mediasource, identi) {
            $('#cromaplay-s-0').jPlayer('setMedia', {
                mp3: mediasource
            });
             $('#cromaplay-s-0').jPlayer('play');
        }


        playmedia(firstMedia, identi, ancest);

        function playmedia(mediasource, identi, ancest) {
            $('#cromaplay-s-0').jPlayer({
                ended: function() {
                    $(ancest).find('.psholder').fadeOut('slow');                  
                },
                play: function() {
                    $(this).jPlayer("playHead",0);
                    $('.psholder').hide();
                    $(ancest).find('.psholder').fadeIn('slow'); 
                    $(this).jPlayer("pauseOthers");
                    $(this).jPlayer('play');

                },
                swfPath: CromaplaySettings.swfPath,
                supplied: 'mp3',
                solution: 'html, flash',
                cssSelectorAncestor: ancest,
                cssSelector: selectors
            }); // this.jplayer
        }
    }

    $.fn.cromaPlay = function() {
        var $this = $(this);    
        new $.cromaPlay(this);
    };

    $.fn.cromaSPlay = function() {
        var $this = $(this);
        new $.cromaSPlay(this, 0);
    };


})(jQuery);


jQuery(document).ready(function($) {
    jQuery('#cromaplay_composite').cromaPlay();

    jQuery('#cromaplay_single-0').cromaSPlay();
});