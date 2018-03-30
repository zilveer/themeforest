/*
 * Fullwidth Audio Player V1.4.2
 * Author: Rafael Dery
 * Copyright 2011
 *
 * Only for the sale at the envato marketplaces
 *
 */ (function (a) {
    a.fullwidthAudioPlayer = {
        version: "1.4.2",
        author: "Rafael Dery"
    };
    jQuery.fn.fullwidthAudioPlayer = function (u) {
        function c(d, g) {
            if (!window.fapPopupWin || window.fapPopupWin.closed) window.fapPopupWin = window.open(b.popupUrl, "", "menubar=no,toolbar=no,location=no,width=980,height=" + y + ",left=" + (window.screen.width - 980) / 2 + ",top=" + (window.screen.height - y) / 2 + ""), null == window.fapPopupWin && alert("Pop-Up Music Player can not be opened. Your browser is blocking Pop-Ups. Please allow Pop-Ups for this site to use the Music Player."),
            a(window.fapPopupWin).load(function () {
                a(".fap-enqueue-track").each(function (b, g) {
                    var p = a(g);
                    d += w(p)
                });
                b.autoPlay = g;
                window.fapPopupWin.initPlayer(b, d);
                G = !0
            });
            else {
                var p = a(d);
                a.fullwidthAudioPlayer.addTrack(p.attr("href"), p.attr("title"), p.data("meta") ? a("body").find(p.data("meta")).html() : "", p.attr("rel"), p.attr("target"), g)
            }
        }
        function f() {
            b.playlist && (r = a('<div class="clear"></div><div class="antiscroll-wrap"><div class="box"><div class="antiscroll-inner"><div id="fap-playlist-wrapper" class="box-inner"><ul id="fap-playlist"></ul></div><div class="clear"></div></div></div>'));
            b.xmlPath ? a.ajax({
                type: "GET",
                url: b.xmlPath,
                dataType: "xml",
                cache: !1,
                success: function (d) {
                    var g = a(d).find("playlists");
                    d = b.xmlPlaylist ? d = b.xmlPlaylist : d = g.children("playlist:first").attr("id");
                    q(g.children('playlist[id="' + d + '"]').children("track"));
                    a(".fap-xml-playlist").each(function (d, b) {
                        var c = a(b);
                        c.append("<h3>" + b.title + '</h3><ul class="fap-my-playlist"></ul>');
                        g.children('playlist[id="' + b.id + '"]').children("track").each(function (d, g) {
                            var p = a(g),
                                j = p.attr("target") ? 'target="' + p.attr("target") + '"' :
                                    "",
                                e = p.attr("rel") ? 'rel="' + p.attr("rel") + '"' : "",
                                A = p.find("meta") ? 'data-meta="#' + b.id + "-" + d + '"' : "";
                            c.children("ul").append('<li><a href="' + p.attr("href") + '" title="' + p.attr("title") + '" ' + j + " " + e + " " + A + ">" + p.attr("title") + "</a></li>");
                            c.append('<span id="' + b.id + "-" + d + '">' + p.find("meta").text() + "</span>")
                        })
                    })
                },
                error: function () {
                    alert("XML file could not be loaded. Please check the XML path!")
                }
            }) : q(v.children("a"))
        }
        function q(d) {
            v.bind("fap-tracks-stored", function () {
                ++Q;
                if (Q < d.length) {
                    var g = d.eq(Q);
                    a.fullwidthAudioPlayer.addTrack(g.attr("href"),
                    g.attr("title"), b.xmlPath ? g.children("meta").text() : v.find(g.data("meta")).html(), g.attr("rel"), g.attr("target"))
                } else {
                    v.unbind("fap-tracks-stored");
                    b.randomize && U();
                    n.children("p").remove();
                    n.append('<div id="fap-meta-wrapper" class="clearfix"><img src="" width="' + b.coverSize[0] + '" height="' + b.coverSize[1] + '" id="fap-current-cover" style="border: 1px solid ' + b.strokeColor + ';" /><div id="fap-cover-replacement" style="width: ' + b.coverSize[0] + "px; height:" + b.coverSize[1] + "px; border: 1px solid " + b.strokeColor +
                        ';"></div><p id="fap-current-title"></p><p id="fap-current-meta" style="color: ' + b.metaColor + ';"></p></div>');
                    s = n.children("#fap-meta-wrapper").css("height", b.height - 10);
                    B(document.getElementById("fap-cover-replacement"), b.coverSize[0], b.coverSize[1]);
                    b.socials && s.append('<p id="fap-social-links"><a href="" target="_blank" style="color: ' + b.metaColor + ';">' + b.soundcloudText + '</a><a href="" target="_blank" style="color: ' + b.metaColor + ';">' + b.downloadText + '</a><a href="" target="_blank" style="color: ' + b.metaColor + ';">' + b.facebookText + '</a><a href="" target="_blank" style="color: ' + b.metaColor + ';">' + b.twitterText + "</a></p>");
                    m = n.append('<div id="fap-ui-wrapper"></div>').children("#fap-ui-wrapper").css("height", b.height);
                    g = m.append('<div id="fap-ui-nav"></div>').children("#fap-ui-nav");
                    g.css("margin-top", 0.5 * b.height - 0.5 * g.height());
                    g.append('<a href="#" id="fap-previous" style="background-color: ' + b.fillColor + ';"></a>').children("#fap-previous").click(function () {
                        a.fullwidthAudioPlayer.previous();
                        return !1
                    });
                    g.append('<a href="#" id="fap-play-pause" style="background-color: ' + b.fillColor + ';"></a>').children("#fap-play-pause").click(function () {
                        a.fullwidthAudioPlayer.toggle();
                        return !1
                    });
                    g.append('<a href="#" id="fap-next" style="background-color: ' + b.fillColor + ';"></a>').children("#fap-next").click(function () {
                        a.fullwidthAudioPlayer.next();
                        return !1
                    });
                    m.children("div:first").length && (m.width(), m.children("div:first").position());
                    m.append('<div id="fap-time-bar" class="clearfix"><div id="fap-loading-bar"></div><div id="fap-progress-bar"></div><span id="fap-current-time">00:00:00</span><span id="fap-total-time">00:00:00</span></div>');
                    m.find("#fap-loading-bar, #fap-progress-bar").click(function (d) {
                        d = (d.pageX - a(this).parent().offset().left) / L;
                        H ? t.setPosition(d) : t.setPosition(d * t.duration);
                        j(d)
                    });
                    b.volume && (m.append('<div id="fap-volume-sign"></div><div id="fap-volume-bar"><div id="fap-loading-volume"></div><div id="fap-volume-progress"></div></div>'), m.children("#fap-volume-sign").css("margin-top", 0.5 * b.height - 0.5 * m.children("#fap-volume-sign").height()), m.find("#fap-volume-bar").click(function (d) {
                        d = (d.pageX - a(this).offset().left) / R;
                        a.fullwidthAudioPlayer.volume(d)
                    }));


                    m.find("a").hover(function () {
                        a(this).css("backgroundColor", b.fillColorHover)
                    }, function () {
                        a(this).css("backgroundColor", b.fillColor)
                    });
                    b.keyboard && a(document).keyup(function (d) {
                        switch (d.which) {
                            case 32:
                                a.fullwidthAudioPlayer.toggle();
                                break;
                            case 39:
                                a.fullwidthAudioPlayer.next();
                                break;
                            case 37:
                                a.fullwidthAudioPlayer.previous();
                                break;
                            case 38:
                                a.fullwidthAudioPlayer.volume(D / 100 + 0.05);
                                break;
                            case 40:
                                a.fullwidthAudioPlayer.volume(D / 100 - 0.05)
                        }
                    });
                    s.children("p").css("marginLeft", b.coverSize[0] + 10);
                    v.trigger("onFapReady");
                    G = !0;
                    a(".fap-enqueue-track").each(function (d, b) {
                        var g = a(b);
                        jQuery.fullwidthAudioPlayer.addTrack(g.attr("href"), g.attr("title"), a("body").find(g.data("meta")).html(), g.attr("rel"), g.attr("target"), !1)
                    });
                    v.bind("fap-tracks-stored", function (d, a) {
                        S && e(a, S)
                    });
                    e(0, b.autoPlay);
                    b.autoPlay ? v.trigger("onFapPlay") : v.trigger("onFapPause")
                }
            }).trigger("fap-tracks-stored")
        }
        function w(d) {
            var b = '<a href="' + d.attr("href") + '" title="' + (d.attr("title") ? d.attr("title") : "") + '" target="' + (d.attr("target") ? d.attr("target") : "") + '" rel="' + (d.attr("rel") ? d.attr("rel") : "") + '" data-meta="' + (d.data("meta") ? d.data("meta") : "") + '"></a>';
            if (d.data("meta")) var p = a("body").find(d.data("meta")).html() ? a("body").find(d.data("meta")).html() : "",
                b = b + ('<span id="' + d.data("meta").substring(1) + '">' + p + "</span>");
            return b
        }
        function A(d) {
            a.getJSON((/api\./.test(d) ? d + "?" : "http://api.soundcloud.com/resolve?url=" + d + "&") + "format=json&consumer_key=" + T + "&callback=?", function (b) {
                var p = 0,
                    c = 0;
                if (b.tracks) for (var j = 0; j < b.tracks.length; ++j) c = l(b.tracks[j]), p = c < p ? c : p, 0 == j && (p = c);
                else if (b.duration) b.permalink_url = d, p = l(b);
                else {
                    if (b.username) return /favorites/.test(d) ? A(b.uri + "/favorites") : A(b.uri + "/tracks"), !1;
                    if (a.isArray(b)) for (j = 0; j < b.length; ++j) c = l(b[j]), p = c < p ? c : p, 0 == j && (p = c)
                }
                v.trigger("onFapTracksAdded", [h]);
                v.trigger("fap-tracks-stored", [p])
            })
        }
        function l(d) {
            for (var b = h.length, a = 0; a < h.length; ++a) if (d.title == h[a].title) return b = a;
            h.push(d);
            z(d.artwork_url, d.title);
            return b
        }
        function e(d, g) {
            if (0 >= h.length) return a.fullwidthAudioPlayer.clear(), !1;
            if (H && !N || d == k) return !1;
            k = 0 > d ? h.length - 1 : d == h.length ? 0 : d;
            E = !g;
            var c = /http:\/\/soundcloud/.test(h[k].permalink_url);
            c && !N && (a("body").fapScPlayer({
                apiKey: T,
                autoPlay: g
            }), a(document).bind("fapScPlayer:onAudioReady", function () {
                N = !0;
                t.setVolume(D)
            }));
            a.fapScPlayer.html5() && (N = !0);
            m.find("#fap-progress-bar").width(0);
            m.find("#fap-total-time, #fap-current-time").text("00:00:00");
            s.children("#fap-current-cover").attr("src", h[k].artwork_url);
            s.children("#fap-current-title").html(h[k].title);
            s.children("#fap-current-meta").html(c ? h[k].genre : h[k].meta);
            h[k].artwork_url ? (s.children("#fap-current-cover").show(), s.children("#fap-cover-replacement").hide()) : (s.children("#fap-current-cover").hide(), s.children("#fap-cover-replacement").show());
            if (h[k].permalink_url) {
                s.children("#fap-social-links").children("a").show();
                var j =
                    "http://www.facebook.com/sharer.php?u=" + encodeURIComponent(h[k].permalink_url) + "&t=" + encodeURIComponent(h[k].title) + "",
                    e = "http://twitter.com/share?url=" + encodeURIComponent(h[k].permalink_url) + "&text=" + encodeURIComponent(h[k].title) + "";
                s.find("#fap-social-links a:eq(0)").attr("href", h[k].permalink_url);
                s.find("#fap-social-links a:eq(1)").attr("href", h[k].permalink_url + "/download");
                s.find("#fap-social-links a:eq(2)").attr("href", j);
                s.find("#fap-social-links a:eq(3)").attr("href", e)
            } else s.children("#fap-social-links").children("a").hide();
            r && (r.find("#fap-playlist li").css("background", "none"), r.find("#fap-playlist li").eq(k).css("background", b.activeTrackColor));
            g ? m.find("#fap-play-pause").removeClass("fap-play").addClass("fap-pause") : m.find("#fap-play-pause").removeClass("fap-pause").addClass("fap-play");
            t && t.destruct();
            c ? (H || m.find("#fap-loading-bar").width("100%"), s.children("#fap-social-links").children("a:eq(0)").show(), h[k].downloadable ? s.children("#fap-social-links").children("a:eq(1)").show() : s.children("#fap-social-links").children("a:eq(1)").hide(),
            H = !0, t = a.fapScPlayer, t.setVolume(D), t.load(h[k], g), t.defaults.whileloading = function (b) {
                0 > b && (b = 0);
                100 < b && (b = 100);
                m.find("#fap-loading-bar").width(b + "%")
            }, t.defaults.whileplaying = function (b) {
                W(b, h[k].duration)
            }, t.defaults.onfinish = I) : (s.children("#fap-social-links").children("a:eq(0), a:eq(1)").hide(), H = !1, t = soundManager.createSound({
                id: "fap_sound",
                url: h[k].stream_url,
                autoPlay: g,
                autoLoad: b.autoLoad,
                volume: D,
                whileloading: J,
                whileplaying: O,
                onfinish: I,
                onload: P
            }));
            v.trigger("onFapTrackSelect", [h[k]])
        }
        function J() {
            m.find("#fap-loading-bar").width(this.bytesLoaded / this.bytesTotal * L)
        }
        function O() {
            W(this.position, this.duration)
        }
        function I() {
            b.playNextWhenFinished ? a.fullwidthAudioPlayer.next() : (a.fullwidthAudioPlayer.pause(), t.setPosition(0), j(0))
        }
        function P(b) {
            b || window.console && window.console.log && console.log("MP3 file could not be loaded! Please check the URL: " + this.url)
        }
        function z(d, g) {
            if (!b.playlist) return !1;
            var c = d ? '<img src="' + d + '" style="border: 1px solid ' + b.strokeColor + ';" />' : '<div class="fap-cover-replace-small" style="background: ' + b.wrapperColor +
                "; border: 1px solid " + b.strokeColor + ';"></div>';
            r.find("#fap-playlist").append('<li class="clearfix">' + c + "<span>" + g + '</span><div class="fap-remove-track">&times;</div></li>');
            c = r.find("#fap-playlist li").last().css({
                marginBottom: 5,
                height: 22
            }); - 1 == navigator.appVersion.indexOf("MSIE 7.") && (d || B(c.children(".fap-cover-replace-small").get(0), 20, 20));
            c.delegate("span", "click", function () {
                var b = r.find("#fap-playlist li").index(a(this).parent());
                e(b, !0)
            });
            c.delegate(".fap-remove-track", "click", function () {
                var d = a(this),
                    g = d.parent().parent().children("li").index(d.parent());
                h.splice(g, 1);
                d.parent().remove();
                g == k ? (k--, g = g == h.length ? 0 : g, e(g, E ? !1 : !0)) : g < k && k--;
                C && (C.refresh(), n.find(".antiscroll-scrollbar").css("backgroundColor", b.mainColor))
            });
            C && (C.refresh(), n.find(".antiscroll-scrollbar").css("backgroundColor", b.mainColor))
        }
        function B(d, g, c) {
            a(d).append('<span style="line-height: ' + c + "px; color: " + b.metaColor + ';">&hellip;</span>')
        }
        function j(b) {
            m.find("#fap-progress-bar").width(b * L)
        }
        function W(b, a) {
            var c = X(b / 1E3);
            Y != c && (m.find("#fap-current-time").text(c), m.find("#fap-total-time").text(X(a / 1E3)), j(b / a));
            Y = c
        }
        function X(b) {
            b = Math.abs(b);
            var a = [];
            a[0] = Math.floor(b / 3600 % 24);
            a[1] = Math.floor(b / 60 % 60);
            a[2] = Math.floor(b % 60);
            b = !0;
            for (var c = -1, j = 0; j < a.length; j++) 10 > a[j] && (a[j] = "0" + a[j]), "00" == a[j] && j < a.length - 2 && !b ? c = j : b = !0;
            a.splice(0, c + 1);
            return a.join(":")
        }
        function U() {
            r && r.find("#fap-playlist").empty();
            if (-1 != k) {
                var a = h[k].title;
                h.shuffle();
                V(a);
                for (a = 0; a < h.length; ++a) z(h[a].artwork_url, h[a].title);
                n.find("#fap-playlist-wrapper #fap-playlist").find("li").eq(k).css("backgroundColor",
                b.fillColor);
                n.find("#fap-playlist-wrapper").scrollTop(0)
            } else {
                h.shuffle();
                for (a = 0; a < h.length; ++a) z(h[a].artwork_url, h[a].title)
            }
        }
        function V(a) {
            for (var b = 0; b < h.length; ++b) h[b].title == a && (k = b)
        }
        var b = a.extend({}, a.fn.fullwidthAudioPlayer.defaults, u),
            v, x, n, m, s, r = null,
            C, t, Y, y = 0,
            Q = -1,
            L = 300,
            R = 90,
            k = -1,
            D = 100,
            E, G, N = !1,
            H = !1,
            M = !1,
            S = !1,
            K = !1,
            F = !1,
            T = "d2be7a47322c293cdaffc039a26e05d1",
            h = [];
        a.fullwidthAudioPlayer.play = function () {
            0 < h.length && (t.playState ? t.resume() : t.play(), m.find("#fap-play-pause").removeClass("fap-play").addClass("fap-pause"),
            E = !1, v.trigger("onFapPlay"))
        };
        a.fullwidthAudioPlayer.pause = function () {
            0 < h.length && (t.pause(), m.find("#fap-play-pause").removeClass("fap-pause").addClass("fap-play"), E = !0, v.trigger("onFapPause"))
        };
        a.fullwidthAudioPlayer.toggle = function () {
            E ? a.fullwidthAudioPlayer.play() : a.fullwidthAudioPlayer.pause()
        };
        a.fullwidthAudioPlayer.previous = function () {
            0 < h.length && e(k - 1, !0)
        };
        a.fullwidthAudioPlayer.next = function () {
            0 < h.length && e(k + 1, !0)
        };
        a.fullwidthAudioPlayer.volume = function (b) {
            0 < h.length && (0 > b && (b = 0), 1 < b && (b = 1), D = 100 * b, t && t.setVolume(D), m.find("#fap-volume-progress").width(b * R))
        };
        a.fullwidthAudioPlayer.addTrack = function (d, c, j, e, u, f) {
            if (null == d || "" == d) return !1;
            void 0 === c && (c = "");
            void 0 === j && (j = "");
            void 0 === e && (e = "");
            void 0 === u && (u = "");
            void 0 === f && (f = !1);
            if (K && window.fapPopupWin && !window.fapPopupWin.closed) return window.fapPopupWin.addTrack(d, c, j, e, u, f), window.fapPopupWin.focus(), !1;
            if (b.base64) {
                var k = "",
                    m, q, s, n, t, r = 0;
                for (d = d.replace(/[^A-Za-z0-9\+\/\=]/g, ""); r < d.length;) m = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(d.charAt(r++)),
                q = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(d.charAt(r++)), n = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(d.charAt(r++)), t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".indexOf(d.charAt(r++)), m = m << 2 | q >> 4, q = (q & 15) << 4 | n >> 2, s = (n & 3) << 6 | t, k += String.fromCharCode(m), 64 != n && (k += String.fromCharCode(q)), 64 != t && (k += String.fromCharCode(s));
                r = "";
                for (n = c1 = c2 = d = 0; d < k.length;) n = k.charCodeAt(d), 128 > n ? (r += String.fromCharCode(n),
                d++) : 191 < n && 224 > n ? (c2 = k.charCodeAt(d + 1), r += String.fromCharCode((n & 31) << 6 | c2 & 63), d += 2) : (c2 = k.charCodeAt(d + 1), c3 = k.charCodeAt(d + 2), r += String.fromCharCode((n & 15) << 12 | (c2 & 63) << 6 | c3 & 63), d += 3);
                d = r
            }
            S = f;
            if (/http:\/\/soundcloud/.test(d)) {
                if (!T) return alert("Sorry. You need to set a soundcloud API key first. Please read the documentation how to get and set an API key!"), !1;
                A(d)
            } else c = l({
                stream_url: d,
                title: c,
                meta: j,
                artwork_url: e,
                permalink_url: u
            }), v.trigger("onFapTracksAdded", [h]), v.trigger("fap-tracks-stored", [c]);
            !b.opened && (f && !F) && a.fullwidthAudioPlayer.setPlayerPosition("open", !0)
        };
        a.fullwidthAudioPlayer.setPlayerPosition = function (a, c) {
            if (x.is(":animated")) return !1;
            "open" == a ? (n.children("#fap-wrapper-switcher").html("<div class='button-switcher-close'></div>"), "top" == b.wrapperPosition ? x.animate({
                top: -(y - b.height)
            }, c ? 300 : 0) : x.animate({
                bottom: -(y - b.height)
            }, c ? 300 : 0), b.opened = !0) : "close" == a ? (n.children("#fap-wrapper-switcher").html("<div class='button-switcher-enter'></div>"), "top" == b.wrapperPosition ? x.animate({
                top: -y - 1
            }, c ? 300 : 0) : x.animate({
                bottom: -y - 1
            }, c ? 300 : 0), b.opened = M = !1) : "openPlaylist" == a ? ("top" == b.wrapperPosition ? x.animate({
                top: 0
            }, 300) : x.animate({
                bottom: 0
            }, 300), M = !0) : "closePlaylist" == a && ("top" == b.wrapperPosition ? x.animate({
                top: -(y - b.height)
            }, 300) : x.animate({
                bottom: -(y - b.height)
            }, 300), M = !1)
        };
        a.fullwidthAudioPlayer.clear = function () {
            s.children("#fap-current-cover").hide();
            s.children("#fap-cover-replacement").show();
            s.children("#fap-current-title, #fap-current-meta").html("");
            s.children("#fap-social-links").children("a").attr("href", "").hide();
            m.find("#fap-progress-bar, #fap-loading-bar").width(0);
            m.find("#fap-current-time, #fap-total-time").text("00:00:00");
            m.find("#fap-play-pause").removeClass("fap-pause").addClass("fap-play");
            E = !0;
            k = -1;
            r && r.find("#fap-playlist").empty();
            h = [];
            t && t.destruct();
            C && (C.refresh(), n.find(".antiscroll-scrollbar").css("backgroundColor", b.mainColor));
            v.trigger("onFapClear")
        };
        a.fullwidthAudioPlayer.popUp = function () {
            K && (!window.fapPopupWin || window.fapPopupWin.closed ? c("", !1) : window.fapPopupWin.focus())
        };
        Array.prototype.shuffle = function () {
            for (var b, a, c = 0; c < this.length; c++) a = Math.floor(Math.random() * this.length), b = this[c], this[c] = this[a], this[a] = b
        };
        return this.each(function () {
            a: {
                v = a(this);
                v.hide();
                F = "fap-popup" == this.id;
                if (jQuery.browser.mobile) {
                    if (b.hideOnMobile) break a;
                    b.wrapperPosition = "top";
                    b.autoPlay = b.volume = b.playlist = !1
                }
                G = Boolean(window.fapPopupWin);
                b.autoPopup || (G = !0);
                E = !b.autoPlay;
                var d = function () {
                    if (!G) return !1;
                    var b = a(this),
                        d = !0;
                    b.data("enqueue") && (d = "yes" == b.data("enqueue") ? !1 : !0);
                    if (K) if (b.hasClass("fap-add-playlist")) {
                        var b = b.data("playlist"),
                            j = jQuery('ul[data-playlist="' + b + '"]').first().children("li").find(".fap-single-track"),
                            b = w(a(j.get(0)));
                        if (0 == j.size()) return !1;
                        c(b, d);
                        j.splice(0, 1);
                        window.fapReady = void 0 != window.fapPopupWin.addTrack;
                        var e = setInterval(function () {
                            window.fapReady && (clearInterval(e), j.each(function (b, a) {
                                c(a, !1)
                            }))
                        }, 50)
                    } else b = w(b), c(b, d);
                    else if (b.hasClass("fap-add-playlist")) {
                        b = b.data("playlist");
                        j = jQuery('ul[data-playlist="' + b + '"]').first().children("li").find(".fap-single-track");
                        if (0 == j.size()) return !1;
                        j.each(function (b, c) {
                            var j = a(c);
                            a.fullwidthAudioPlayer.addTrack(j.attr("href"),
                            j.attr("title"), a("body").find(j.data("meta")).html(), j.attr("rel"), j.attr("target"), 0 == b && d)
                        })
                    } else a.fullwidthAudioPlayer.addTrack(b.attr("href"), b.attr("title"), a("body").find(b.data("meta")).html(), b.attr("rel"), b.attr("target"), d);
                    return !1
                };
                "1.7" <= v.jquery ? (a("body").on("click", ".fap-my-playlist li a, .fap-single-track", d), a("body").on("click", ".fap-add-playlist", d)) : (a("body").delegate(".fap-my-playlist li a, .fap-single-track", "click", d), a("body").delegate(".fap-add-playlist", "click", d));
                setTimeout(function () {
                    K && (window.fapPopupWin && !window.fapPopupWin.closed) && a(".fap-enqueue-track").each(function (b, a) {
                        c(a, !1)
                    })
                }, 201);
                y = b.playlist ? b.height + b.playlistHeight + b.offset : b.height;
                "popup" == b.wrapperPosition && !F ? (K = !0, b.playlist || (y = b.height), b.autoPopup && !window.fapPopupWin && c(v.html(), b.autoPlay)) : (d = '<div id="fap-wrapper" class="' + ("top" == b.wrapperPosition ? "fap-wrapper-top" : "fap-wrapper-bottom") + '" style="' + b.wrapperPosition + ": 0; height: " + y + "px; background: " + b.wrapperColor + "; border-color: " + b.strokeColor +
                    ';"><div id="fap-main" style="color:' + b.mainColor + ';"><div id="fap-wrapper-switcher" style="background: ' + b.wrapperColor + "; border-color: " + b.strokeColor + '"></div><p id="fap-init-text">Creating Playlist...</p></div></div>', a("body").append(d), x = a("body").children("#fap-wrapper"), n = x.children("#fap-main"), F && x.addClass("fap-popup-skin"), jQuery.browser.mobile && x.css({
                    position: "absolute"
                }), F ? n.css({
                    marginLeft: 10,
                    marginRight: 10
                }) : "center" == b.mainPosition ? n.css({
                    marginLeft: "auto",
                    marginRight: "auto"
                }) :
                    "right" == b.mainPosition ? n.css({
                    "float": "right",
                    marginRight: 10
                }) : n.css({
                    marginLeft: 10
                }), "top" == b.wrapperPosition ? n.children("#fap-wrapper-switcher").addClass("fap-bordered-bottom").css({
                    bottom: 0,
                    borderTop: "none"
                }) : n.children("#fap-wrapper-switcher").addClass("fap-bordered-top").css({
                    top: -35,
                    borderBottom: "none"
                }), b.opened ? a.fullwidthAudioPlayer.setPlayerPosition("open", !1) : a.fullwidthAudioPlayer.setPlayerPosition("close", !1), n.children("#fap-wrapper-switcher").click(function () {
                    b.opened ? a.fullwidthAudioPlayer.setPlayerPosition("close", !0) : a.fullwidthAudioPlayer.setPlayerPosition("open", !0)
                }), soundManager.onready(f), soundManager.ontimeout(function (b) {
                    alert("SM2 failed to start. Flash missing, blocked or security error? Status: " + b.error.type)
                }))
            }
        })
    };
    a.fn.fullwidthAudioPlayer.defaults = {
        wrapperPosition: "bottom",
        mainPosition: "center",      
        mainColor: "#3c3c3c",
        
        metaColor: "#666",
        
        activeTrackColor: "#E8E8E8",
        twitterText: "Share on Twitter",
        facebookText: "Share on Facebook",
        soundcloudText: "Check on Souncloud",
        downloadText: "Download",
        popupUrl: "popup.html",
        height: 64,
        playlistHeight: 0,
        coverSize: [45, 45],
        offset: 20,
        opened: !0,
        volume: !0,
        playlist: !0,
        autoLoad: !0,
        autoPlay: !1,
        playNextWhenFinished: !0,
        keyboard: !0,
        socials: 0,
        autoPopup: !1,
        randomize: !1,
        shuffle: !0,
        sortable: !1,
        base64: !1,
        xmlPath: "",
        xmlPlaylist: "",
        hideOnMobile: !1
    }
})(jQuery);
(function () {
    var a = /msie/i.test(navigator.userAgent) && !/opera/i.test(navigator.userAgent);
    window.soundcloud = {
        version: "0.1",
        debug: !1,
        _listeners: [],
        _redispatch: function (a, c, f) {
            var q, w = this._listeners[a] || [],
                A = "soundcloud:" + a;
            try {
                q = this.getPlayer(c)
            } catch (l) {
                this.debug && window.console && console.error("unable to dispatch widget event " + a + " for the widget id " + c, f, l);
                return
            }
            window.jQuery ? jQuery(q).trigger(A, [f]) : window.Prototype && $(q).fire(A, f);
            for (var e = 0, J = w.length; e < J; e += 1) w[e].apply(q, [q, f]);
            this.debug && window.console && console.log(A, a, c, f)
        },
        addEventListener: function (a, c) {
            this._listeners[a] || (this._listeners[a] = []);
            this._listeners[a].push(c)
        },
        removeEventListener: function (a, c) {
            for (var f = this._listeners[a] || [], q = 0, w = f.length; q < w; q += 1) f[q] === c && f.splice(q, 1)
        },
        getPlayer: function (u) {
            var c;
            try {
                if (!u) throw "The SoundCloud Widget DOM object needs an id atribute, please refer to SoundCloud Widget API documentation.";
                if (c = a ? window[u] : document[u]) {
                    if (c.api_getFlashId) return c;
                    throw "The SoundCloud Widget External Interface is not accessible. Check that allowscriptaccess is set to 'always' in embed code";
                }
                throw "The SoundCloud Widget with an id " + u + " couldn't be found";
            } catch (f) {
                throw console && console.error && console.error(f), f;
            }
        },
        onPlayerReady: function (a, c) {
            this._redispatch("onPlayerReady", a, c)
        },
        onMediaStart: function (a, c) {
            this._redispatch("onMediaStart", a, c)
        },
        onMediaEnd: function (a, c) {
            this._redispatch("onMediaEnd", a, c)
        },
        onMediaPlay: function (a, c) {
            this._redispatch("onMediaPlay", a, c)
        },
        onMediaPause: function (a, c) {
            this._redispatch("onMediaPause", a, c)
        },
        onMediaBuffering: function (a, c) {
            this._redispatch("onMediaBuffering",
            a, c)
        },
        onMediaSeek: function (a, c) {
            this._redispatch("onMediaSeek", a, c)
        },
        onMediaDoneBuffering: function (a, c) {
            this._redispatch("onMediaDoneBuffering", a, c)
        },
        onPlayerError: function (a, c) {
            this._redispatch("onPlayerError", a, c)
        }
    }
})();
(function (a) {
    var u = a(document),
        c = function (a) {
            try {
                window.console && window.console.log && window.console.log.apply(window.console, arguments)
            } catch (c) {}
        }, f, q = !1;
    try {
        var w = new Audio,
            q = (q = w.canPlayType && /maybe|probably/.test(w.canPlayType("audio/mpeg"))) && /iPad|iphone|mobile|pre\//i.test(navigator.userAgent)
    } catch (A) {}
    callbacks = {
        onReady: function () {
            u.trigger("fapScPlayer:onAudioReady")
        },
        onPlay: function () {
            u.trigger("fapScPlayer:onMediaPlay")
        },
        onPause: function () {
            u.trigger("fapScPlayer:onMediaPause")
        },
        onEnd: function () {
            u.trigger("fapScPlayer:onMediaEnd")
        },
        onBuffer: function (a) {
            u.trigger({
                type: "fapScPlayer:onMediaBuffering",
                percent: a
            })
        }
    };
    if (q) {
        var l = new Audio;
        a('<div class="sc-player-engine-container"></div>').appendTo(document.body).append(l);
        l.addEventListener("play", callbacks.onPlay, !1);
        l.addEventListener("pause", callbacks.onPause, !1);
        l.addEventListener("ended", callbacks.onEnd, !1);
        l.addEventListener("timeupdate", function (a) {
            a = a.target;
            var c = 100 * ((a.buffered.length && a.buffered.end(0)) / a.duration);
            callbacks.onBuffer(c);
            if (a.currentTime === a.duration) callbacks.onEnd()
        }, !1);
        l.addEventListener("progress", function (a) {
            a = a.target;
            a = 100 * ((a.buffered.length && a.buffered.end(0)) / a.duration);
            callbacks.onBuffer(a)
        }, !1);
        q = {
            load: function (a, c) {
                l.pause();
                l.src = a.stream_url + "?consumer_key=" + c;
                l.load();
                l.play()
            },
            play: function () {
                l.play()
            },
            pause: function () {
                l.pause()
            },
            stop: function () {
                l.currentTime && (l.currentTime = 0);
                l.pause()
            },
            seek: function (a) {
                l.currentTime = l.duration * a;
                l.play()
            },
            getDuration: function () {
                return 1E3 * l.duration
            },
            getPosition: function () {
                return 1E3 * l.currentTime
            },
            setVolume: function (a) {
                l && (l.volume = a / 100)
            },
            html5: !0
        }
    } else {
        var e, J = function (c) {
            c = "http://player.soundcloud.com/player.swf?url=" + c + "&amp;enable_api=true&amp;player_type=engine&amp;object_id=fapScPlayerEngine";
            return a.browser.msie ? '<object height="100%" width="100%" id="fapScPlayerEngine" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" data="' + c + '"><param name="movie" value="' + c + '" /><param name="allowscriptaccess" value="always" /></object>' : '<object height="100%" width="100%" id="fapScPlayerEngine"><embed allowscriptaccess="always" height="100%" width="100%" src="' + c + '" type="application/x-shockwave-flash" name="fapScPlayerEngine" /></object>'
        };
        soundcloud.addEventListener("onPlayerReady", function () {
            e = soundcloud.getPlayer("fapScPlayerEngine");
            callbacks.onReady()
        });
        soundcloud.addEventListener("onMediaEnd", callbacks.onEnd);
        soundcloud.addEventListener("onMediaBuffering", function (a, c) {
            callbacks.onBuffer(c.percent)
        });
        soundcloud.addEventListener("onMediaPlay", callbacks.onPlay);
        soundcloud.addEventListener("onMediaPause", callbacks.onPause);
        q = {
            load: function (c) {
                c = c.permalink_url;
                e ? e.api_load(c) : a('<div class="sc-player-engine-container"></div>').appendTo(document.body).html(J(c))
            },
            play: function () {
                e && e.api_play()
            },
            pause: function () {
                e && e.api_pause()
            },
            stop: function () {
                e && e.api_stop()
            },
            seek: function (a) {
                e && e.api_seekTo(e.api_getTrackDuration() * a)
            },
            getDuration: function () {
                return e && e.api_getTrackDuration && 1E3 * e.api_getTrackDuration()
            },
            getPosition: function () {
                return e && e.api_getTrackPosition && 1E3 * e.api_getTrackPosition()
            },
            setVolume: function (a) {
                e && e.api_setVolume && e.api_setVolume(a)
            },
            html5: !1
        }
    }
    f = q;
    var O, I, P = !1,
        z = !1,
        B;
    a.fapScPlayer = function (c) {
        c = a.extend({}, a.fapScPlayer.defaults, c);
        O = c.apiKey;
        I = c.autoPlay
    };
    a.fapScPlayer.html5 = function () {
        return f.html5
    };
    a.fapScPlayer.load = function (c, e) {
        z = !e;
        f.stop();
        f.load(c, O);
        a.fapScPlayer.duration = c.duration
    };
    a.fapScPlayer.play = function () {
        z = !1;
        f.play()
    };
    a.fapScPlayer.pause = function () {
        z = !0;
        f.pause()
    };
    a.fapScPlayer.stop = function () {
        z = !0;
        f.stop()
    };
    a.fapScPlayer.setPosition = function (a) {
        f.seek(a)
    };
    a.fapScPlayer.setVolume = function (a) {
        f.setVolume(a)
    };
    a.fapScPlayer.destruct = function () {
        z = !0;
        f.pause();
        f.stop()
    };
    u.bind("fapScPlayer:onAudioReady", function () {
        f.html5 ? c("Soundcloud Player HTML5: audio engine is ready") : c("Soundcloud Player Flash: audio engine is ready");
        P || !z ? f.play() : I ? f.play() : f.pause();
        P = !0
    }).bind("fapScPlayer:onMediaPlay", function () {
        clearInterval(B);
        if (z) return f.stop(), !1;
        B = setInterval(function () {
            var c = f.getDuration(),
                e = f.getPosition();
            a.fapScPlayer.defaults.whileplaying(e, c)
        }, 500)
    }).bind("fapScPlayer:onMediaPause", function () {
        clearInterval(B);
        B = null
    }).bind("fapScPlayer:onVolumeChange", function () {}).bind("fapScPlayer:onMediaEnd", function () {
        a.fapScPlayer.defaults.onfinish()
    }).bind("fapScPlayer:onMediaBuffering", function (c) {
        a.fapScPlayer.defaults.whileloading(c.percent + 1)
    });
    a.fn.fapScPlayer = function (c) {
        this.each(function () {
            a.fapScPlayer(c, this)
        });
        return this
    };
    a.fapScPlayer.defaults = a.fn.fapScPlayer.defaults = {
        whileloading: function () {},
        whileplaying: function () {},
        onfinish: function () {},
        apiKey: "LFSDttxBaGVSYZfSitrA",
        autoPlay: !0
    }
})(jQuery);
(function (a) {
    jQuery.browser.mobile = /android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,
    4))
})(navigator.userAgent || navigator.vendor || window.opera);
(function (a) {
    function u(c, l) {
        this.el = a(c);
        this.options = l || {};
        this.x = !1 !== this.options.x;
        this.y = !1 !== this.options.y;
        this.padding = void 0 == this.options.padding ? 2 : this.options.padding;
        this.inner = this.el.find(".antiscroll-inner");
        this.inner.css({
            width: "+=" + q(),
            height: "+=" + q()
        });
        this.refresh()
    }
    function c(c) {
        this.pane = c;
        this.pane.el.append(this.el);
        this.innerEl = this.pane.inner.get(0);
        this.shown = this.enter = this.dragging = !1;
        this.pane.el.mouseenter(a.proxy(this, "mouseenter"));
        this.pane.el.mouseleave(a.proxy(this,
            "mouseleave"));
        this.el.mousedown(a.proxy(this, "mousedown"));
        this.pane.inner.scroll(a.proxy(this, "scroll"));
        this.pane.inner.bind("mousewheel", a.proxy(this, "mousewheel"));
        c = this.pane.options.initialDisplay;
        !1 !== c && (this.show(), this.hiding = setTimeout(a.proxy(this, "hide"), parseInt(c, 10) || 3E3))
    }
    function f(a, c) {
        function e() {}
        e.prototype = c.prototype;
        a.prototype = new e
    }
    function q() {
        if (void 0 === w) {
            var c = a('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>');
            a("body").append(c);
            var l = a("div", c).innerWidth();
            c.css("overflow-y", "scroll");
            var e = a("div", c).innerWidth();
            a(c).remove();
            w = l - e
        }
        return w
    }
    a.fn.antiscroll = function (c) {
        return this.each(function () {
            a(this).data("antiscroll") && a(this).data("antiscroll").destroy();
            a(this).data("antiscroll", new a.Antiscroll(this, c))
        })
    };
    a.Antiscroll = u;
    u.prototype.refresh = function () {
        var a = this.inner.get(0).scrollWidth > this.el.width(),
            l = this.inner.get(0).scrollHeight > this.el.height();
        !this.horizontal && a && this.x ? this.horizontal = new c.Horizontal(this) : this.horizontal && !a && (this.horizontal.destroy(), this.horizontal = null);
        !this.vertical && l && this.y ? this.vertical = new c.Vertical(this) : this.vertical && !l && (this.vertical.destroy(), this.vertical = null)
    };
    u.prototype.destroy = function () {
        this.horizontal && this.horizontal.destroy();
        this.vertical && this.vertical.destroy();
        return this
    };
    u.prototype.rebuild = function () {
        this.destroy();
        this.inner.attr("style", "");
        u.call(this, this.el, this.options);
        return this
    };
    c.prototype.destroy = function () {
        this.el.remove();
        return this
    };
    c.prototype.mouseenter = function () {
        this.enter = !0;
        this.show()
    };
    c.prototype.mouseleave = function () {
        this.enter = !1;
        this.dragging || this.hide()
    };
    c.prototype.scroll = function () {
        this.shown || (this.show(), !this.enter && !this.dragging && (this.hiding = setTimeout(a.proxy(this, "hide"), 1500)));
        this.update()
    };
    c.prototype.mousedown = function (c) {
        c.preventDefault();
        this.dragging = !0;
        this.startPageY = c.pageY - parseInt(this.el.css("top"), 10);
        this.startPageX = c.pageX - parseInt(this.el.css("left"), 10);
        document.onselectstart = function () {
            return !1
        };
        var l = a.proxy(this, "mousemove"),
            e = this;
        a(document).mousemove(l).mouseup(function () {
            e.dragging = !1;
            document.onselectstart = null;
            a(document).unbind("mousemove", l);
            e.enter || e.hide()
        })
    };
    c.prototype.show = function () {
        this.shown || (this.update(), this.el.addClass("antiscroll-scrollbar-shown"), this.hiding && (clearTimeout(this.hiding), this.hiding = null), this.shown = !0)
    };
    c.prototype.hide = function () {
        this.shown && (this.el.removeClass("antiscroll-scrollbar-shown"), this.shown = !1)
    };
    c.Horizontal = function (f) {
        this.el = a('<div class="antiscroll-scrollbar antiscroll-scrollbar-horizontal">');
        c.call(this, f)
    };
    f(c.Horizontal, c);
    c.Horizontal.prototype.update = function () {
        var a = this.pane.el.width(),
            c = a - 2 * this.pane.padding,
            e = this.pane.inner.get(0);
        this.el.css("width", c * a / e.scrollWidth).css("left", c * e.scrollLeft / e.scrollWidth)
    };
    c.Horizontal.prototype.mousemove = function (a) {
        var c = this.pane.el.width() - 2 * this.pane.padding,
            e = a.pageX - this.startPageX;
        a = this.el.width();
        var f = this.pane.inner.get(0),
            e = Math.min(Math.max(e, 0), c - a);
        f.scrollLeft = (f.scrollWidth - this.pane.el.width()) * e / (c - a)
    };
    c.Horizontal.prototype.mousewheel = function (a, c, e) {
        if (0 > e && 0 == this.pane.inner.get(0).scrollLeft || 0 < e && this.innerEl.scrollLeft + this.pane.el.width() == this.innerEl.scrollWidth) return a.preventDefault(), !1
    };
    c.Vertical = function (f) {
        this.el = a('<div class="antiscroll-scrollbar antiscroll-scrollbar-vertical">');
        c.call(this, f)
    };
    f(c.Vertical, c);
    c.Vertical.prototype.update = function () {
        var a = this.pane.el.height(),
            c = a - 2 * this.pane.padding,
            e = this.innerEl;
        this.el.css("height",
        c * a / e.scrollHeight).css("top", c * e.scrollTop / e.scrollHeight)
    };
    c.Vertical.prototype.mousemove = function (a) {
        var c = this.pane.el.height(),
            e = c - 2 * this.pane.padding,
            f = a.pageY - this.startPageY;
        a = this.el.height();
        var q = this.innerEl,
            f = Math.min(Math.max(f, 0), e - a);
        q.scrollTop = (q.scrollHeight - c) * f / (e - a)
    };
    c.Vertical.prototype.mousewheel = function (a, c, e, f) {
        if (0 < f && 0 == this.innerEl.scrollTop || 0 > f && this.innerEl.scrollTop + this.pane.el.height() == this.innerEl.scrollHeight) return a.preventDefault(), !1
    };
    var w
})(jQuery);