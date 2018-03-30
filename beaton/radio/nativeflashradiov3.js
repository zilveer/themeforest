/*
 * Native Flashradio V3.15.04.20
 * http://native.flashradio.info
 *
 * Copyright (C) SODAH | JOERG KRUEGER
 * http://blog.codingexpert.de | http://www.sodah.de
 * 
 * COMPRESSOR: http://closure-compiler.appspot.com/home
 */
(function(b, z) {
    "function" === typeof define && define.amd ? define(["jquery"], z) : b.jQuery ? z(b.jQuery) : z(b.Zepto)
})(this, function(b, z) {
    b.fn.flashradio = function(G) {
        var p = "string" === typeof G,
            Z = Array.prototype.slice.call(arguments, 1),
            aa = this;
        G = !p && Z.length ? b.extend.apply(null, [!0, G].concat(Z)) : G;
        if (p && "_" === G.charAt(0)) return aa;
        p ? this.each(function() {
            var p = b(this).data("flashradio"),
                ba = p && b.isFunction(p[G]) ? p[G].apply(p, Z) : p;
            if (ba !== p && ba !== z) return aa = ba, !1
        }) : this.each(function() {
            var p = b(this).data("flashradio");
            p ? p.option(G || {}) : b(this).data("flashradio", new b.flashradio(this, G))
        });
        return aa
    };
    b.flashradio = function(G, p) {
        function Z(b) {
            "" != ca && (h.style.visibility = "visible");
            return !1
        }

        function aa(b) {
            h.style.visibility = "hidden";
            return !1
        }

        function Ra() {
            if (Ea != z) b.get(Ea + "?hash=" + Math.random(), function(a) {
                b(a).find("THEME").attr("COLOR") && (v = b(a).find("THEME").attr("COLOR"));
                b(a).find("THEME").attr("STARTVOLUME") && (t = b(a).find("THEME").attr("STARTVOLUME"));
                if (v == z || "" == v) v = "#0d72bf";
                ga = ha(v, -.5);
                ea = ha(v, -.9);
                H = "";
                b(a).find("RADIO").each(function() {
                    b(this).attr("NAME") && "" != b(this).attr("NAME") && (I = b(this).attr("NAME"));
                    b(this).attr("SCROLL") && "" != b(this).attr("SCROLL") && (O = b(this).attr("SCROLL"));
                    b(this).attr("AUTOPLAY") && "" != b(this).attr("AUTOPLAY") && (ia = "TRUE" == b(this).attr("AUTOPLAY").toUpperCase() ? !0 : !1);
                    b(this).attr("HTML5CHROME") && "" != b(this).attr("HTML5CHROME") && (b(this).attr("HTML5CHROME").toUpperCase(), la = !1);
                    b(this).attr("DEBUG") && "" != b(this).attr("DEBUG") && (L = "TRUE" == b(this).attr("DEBUG").toUpperCase() ?
                        !0 : !1);
                    b(this).attr("SONGTITLEURL") && "" != b(this).attr("SONGTITLEURL") && (P = Q + "currentsong.php?ownurl=" + ja(b(this).attr("SONGTITLEURL")));
                    b(this).attr("STARTVOLUME") && "" != b(this).attr("STARTVOLUME") && (t = parseInt(b(this).attr("SONGTITLEURL")));
                });
                b(a).find("CHANNEL").each(function() {
                    var a =
                        ja(b(this).attr("URL")),
                        a = Fa(a),
                        m = a.split("/");
                    "" == P && (P = Q + "currentsong.php?url=" + a);
                    ma.push(a);
                    4 > m.length ? (T.push(a + "/;"), H = H + "|" + a + "/;") : (T.push(a), H = H + "|" + a)
                });
                ba()
            }).done(function() {}).fail(function() {}).always(function() {}).always(function() {});
            else {
                Ga != z && (v = Ga);
                ga = ha(v, -.5);
                ea = ha(v, -.9);
                H = "";
                na != z && "" != na && (I = na);
                oa != z && "" != oa && (O = oa);
                pa != z && "" != pa && (ia = "TRUE" == pa.toUpperCase() ? !0 : !1);
                qa != z && "" != qa && (qa.toUpperCase(), la = !1);
                ra != z && "" != ra && (L = "TRUE" == ra.toUpperCase() ? !0 : !1);
                sa != z && "" != sa && (P =
                    Q + "currentsong.php?ownurl=" + ja(sa));
                ta != z && "" != ta && (t = parseInt(ta));
                
                for (var a = [], a = va != z && "" != va ? va.split("|") : ["http://46.165.232.53:80", "http://46.165.233.194:80"], c = 0; c < a.length; c += 1) {
                    var d = ja(a[c]),
                        d = Fa(d),
                        e = d.split("/");
                    "" == P && (P = Q + "currentsong.php?url=" + d);
                    ma.push(d);
                    4 > e.length ? (T.push(d + "/;"), H = H + "|" + d + "/;") : (T.push(d), H = H + "|" + d)
                }
                "NATIVE FLASH RADIO V3 BY SODAH.DE" ==
                I && (I = "", wa(), Sa());
                ba()
            }
        }

        function ba() {
            navigator.userAgent.toLowerCase();
            if (la && /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()) || mobilecheck() || 10.1 > getFlashPluginVersion()) R = !0;
            try {
                var m = window.localStorage.getItem(a + "volume");
                null !== m && (t = m)
            } catch (c) {}
            M = document.getElementById(a);
            M.innerHTML = "";
            M.style.overflow = "hidden";
            M.style.display = "block";
            w = document.createElement("div");
            w.id = a + "containerinside";
            w.style.position = "relative";
            w.style.left = "0px";
            w.style.top = "0px";
            w.style.height = "100%";
            w.style.width =
                "100%";
            M.appendChild(w);
            k = document.createElement("div");
            k.id = a + "volumecontroller";
            k.style.position = "absolute";
            w.appendChild(k);
            b("#" + a + "volumecontroller").disableSelection();
            if (canvassupport) try {
                e = document.createElement("canvas"), e.id = a + "canvas", e.style.display = "block", e.style.background = "none", e.style.position = "absolute", w.appendChild(e), f = e.getContext("2d"), f.fillStyle = v
            } catch (d) {}
   
            channelname = document.createElement("div");
            channelname.id = a + "channelname";
            channelname.style.position = "absolute";
            channelname.style.textAlign = "left";
            channelname.style.whiteSpace = "nowrap";
            w.appendChild(channelname);
            b("#" + a + "channelname").disableSelection();
            L && (q = document.createElement("div"), q.id = a + "devicetext", q.style.position = "absolute", q.style.overflow = "visible", q.style.fontFamily = "'Oswald', sans-serif", q.style.fontWeight = "400", q.style.color = "#555555", q.style.whiteSpace = "nowrap", q.style.textAlign = "left", w.appendChild(q), b("#" + a + "devicetext").disableSelection(), b("#" + a + "devicetext").css({
                opacity: .7
            }), mobilecheck() ? q.innerHTML = "" : q.innerHTML = "");
            r = document.createElement("div");
            r.id = a + "statustext";
            r.style.position = "absolute";
            r.style.overflow = "visible";
            r.style.whiteSpace = "nowrap";
            r.style.textAlign = "left";
            w.appendChild(r);
            b("#" + a + "statustext").disableSelection();
            D = document.createElement("div");
            D.id = a + "infocontainer";
            D.style.position = "absolute";
           
            w.appendChild(D);
            b("#" + a + "infocontainer").disableSelection();
            F = document.createElement("img");
            F.id = a + "volumeimg";
            F.style.position = "absolute";
            F.src = "data:image/png;base64,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";
            D.appendChild(F);
            b("#" + a + "volumeimg").disableSelection();
            n = document.createElement("div");
            n.id = a + "volumetext";
            n.style.position = "absolute";
            n.style.whiteSpace = "nowrap";
            n.style.textAlign = "center";
            D.appendChild(n);
            b("#" + a + "volumetext").disableSelection();
            A = document.createElement("img");
            A.id = a + "infoclick";
            A.style.position = "absolute";
            A.src = "data:image/gif;base64,R0lGODlhAQABAJEAAAAAAP///////wAAACH5BAEAAAIALAAAAAABAAEAAAICVAEAOw%3D%3D";
            A.style.cursor = "pointer";
            D.appendChild(A);
            b("#" + a + "infoclick").disableSelection();
            A.onmouseover = function(m) {
                b("#" + a + "volumeimg").stop();
                b("#" + a + "volumeimg").animate({
                    opacity: .7
                }, 200, function() {});
                return !1
            };
            A.onmouseout = function(m) {
                b("#" + a + "volumeimg").stop();
                b("#" + a + "volumeimg").animate({
                    opacity: 1
                }, 200, function() {});
                return !1
            };
            A.onclick = function(a) {
                0 == t ? (t = Ia, xa(t)) : (Ia = t, xa(0, t), t = 0);
                return !1
            };
            x = document.createElement("img");
            x.id = a + "volumegrab";
            x.style.position = "absolute";
            x.src = "data:image/gif;base64,R0lGODlhAQABAJEAAAAAAP///////wAAACH5BAEAAAIALAAAAAABAAEAAAICVAEAOw%3D%3D";
            w.appendChild(x);
            b("#" + a + "volumegrab").disableSelection();
            y = document.createElement("div");
            y.id = a + "playstopcontainer";
            y.style.position = "absolute";
            y.style.left = "0px";
            y.style.top = "0px";
            y.style.cursor = "pointer";
            w.appendChild(y);
            b("#" + a + "playstopcontainer").disableSelection();
            y.onmouseover = function(m) {
                J ? (b("#" + a + "stopbutton").stop(), b("#" + a + "stopbutton").animate({
                    opacity: .7
                }, 200, function() {})) : (b("#" + a + "playbutton").stop(), b("#" + a + "playbutton").animate({
                    opacity: .7
                }, 200, function() {}));
                return !1
            };
            y.onmouseout = function(m) {
                J ? (b("#" + a + "stopbutton").stop(), b("#" + a + "stopbutton").animate({
                    opacity: 1
                }, 200, function() {})) : (b("#" + a + "playbutton").stop(), b("#" + a + "playbutton").animate({
                    opacity: 1
                }, 200, function() {}));
                return !1
            };
            y.onclick = function(b) {
                if (J = !J) ya();
                else {
                    J = !1;
                    if (R) {
                        for (g.pause(); g.firstChild;) g.removeChild(g.firstChild);
                        g.load()
                    } else document[a + "flash"].fl_pause();
                    Ta()
                }
                return !1
            };
            K = document.createElement("div");
            K.style.position = "absolute";
            K.style.top = "0px";
            K.style.left = "0px";
            K.style.width ="0px";
            K.style.height = "0px";
            K.id = a + "player";
            y.appendChild(K);
            B = document.createElement("img");
            B.id = a + "playbutton";
            B.style.position = "absolute";
            B.src = "data:image/png;base64,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";
            B.style.cursor = "pointer";
            y.appendChild(B);
            b("#" + a + "playbutton").disableSelection();
            J && (B.style.visibility = "hidden");
            C = document.createElement("img");
            C.id = a + "stopbutton";
            C.style.position = "absolute";
            C.src = "data:image/png;base64,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";
            C.style.cursor = "pointer";
            y.appendChild(C);
            J || (C.style.visibility = "hidden");
            b("#" + a + "stopbutton").disableSelection();
            b("#" + a + "volumegrab").mouseover(function(m) {
                b("#" + a + "volumegrab").css("cursor", "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNAay06AAAALlSURBVEiJxZe9bhNBEMd/5zsSkhjs0Fi0SYG7CAmltQUpeAGeISmTB6CFSOQFkoKOwqJAQAQNCCHyIUs0KYAiEmUaQ2GshORuPyhu196c95wLSHik0a3v7P3Nf2Zudx1orRmHlcZCHSc48t0MgqDIbwPjANr4SHPL6gWPsJIDe2k+PwAUIIwXaxqt9ZB7LAC2gTfANeCtNga8A24CVeAqEDrB5bKKgrctaHNzU5fLZe2Aj42/B2omsEkTQC64SHOVgMaI54GUcjqO47vAd+AFcB2YAq7kqS8K9ppSCiAQQiCEAAi63e494DkwC0yT9tEQvAjY7V7m5+cBkFJaGEmS9MFCCDqdTgN4Rlr3aTxpLwLWwMOtrS0Ams0mjUZjCGaDcMZ3gBvADJ6UFwU/XV5ePraTKqXIgbnjgLTWFnyOVeQ91qTvJ0mSoJSi1Wr1A7AwKWVfvRlD2t0TeFI9Cmxr238vLUwphZQSKSVHR0eTLiwDDo1Sd+GBrPyMvQa6wCvSBumn0dbXNpj1w8PDSaf2Nniv5SkuAY1er1dWSt2vVCotTBqtWt/VHRvLXT7zFAfAjlXU6XSaFmwV+dw+29vbA/hGuoYrPJtIbqqjKFqvVqsf7KRLS0tTPojPV1ZWDhg0pTTwQoq1EOJzGIYbtVrtU5IkrK6uemG+e8At4BEQG5dZxXk1VkAipWwDQghBvV4nW2Nfndvttp0jBk6BMzzb5aiuFsBJFEXrc3NzH0fV1PW1tbUD4Ou/gBUQCyH2wzB8Uq/Xdy5qKifNjw30FEi4RI1d+JmUcj8Mw42FhYVdC8mrt7EY+G089oEvWjJtZ55IKXfDMAwWFxdvk9mxMvbFAE/ISTNA4DtxeA57JdJ1d4Z0n50FyqTrsJs1TarwF/AD+El6OpHwd4c9ZaLXzthu8lmwIFXcM98bSjMUV2ytZGAT5jq06zA4ccYMFpA0Kod1WTAM6juqzjYz5ya/EPw/bGx/Yf4AHxykPX4eCXQAAAAASUVORK5CYII%3D), auto")
            });
            b("#" + a + "volumegrab").grab({
                onstart: function(m) {
                    b("#" + a + "volumegrab").css("cursor", "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNAay06AAAAKmSURBVEiJ7ZbPaxNBFMc/m4lttYtNBem9F3MrgvRawR78C/wbemz/CS3Yf8OLXgQ9KAgi9gcBLz2oh0IOhfZSLdUkTZN9s+NhZtpNdrJZFeyhDgzz2GTn8977vnmzkTGGyxiVS6H+B18JcDX0MIqiMu9GbgKYoTU4sicoCC4BU8BLZz8CUkC7mToHis+pMSY3C6CvgRbwRkRMr9czwDugDbwFbgExMOmcG8kqC47iODbGGCMiJo5j0+12TafTMUDn5OTEHB8fG6DjHLntHLjGhRwDjLLFFbXb7baIICIAZOxKxo4ODg4eAC+AWeAGVs5c0ZQFK4AkSUJgRIQkSQAiEaHZbC4Bz4Cag+fSXlRcvpAq3msRIU1T9vf3ERG01hweHk552zvh7HtYzROgjy28cx2LIn4F/HBrnI3SR661Pn8mIuzt7U1lshIBN4FprNYDrFERV4ClVqsVp2n6cGZm5nk2Yq11cM3abkw6aC7VoyKOgE0f0dHR0X0P9hGFpv9te3sb4CuDTaYUmGq1ul6r1d77TZeXl6+HIKG5srKyi9VTGNJ2HNiIyCel1Mbc3NzHJElYXV0NwkLPgDvAY2xR5QoLRmucAonWugGIiFCv1xnWOKRzo9Hwe/SBM6DnIh8AF1W1AKfVanV9fn7+Q5Gm2bm2trYLfPkbcAr0RWRHKfW0Xq9vjiuqTJqfOOgZ9hynw5uP61wp0NNa7yilNhYWFrY8ZJTebvSBrpv9EHjctegr81RrvaWUihYXF+9ScEyAzw54yog0A0Sh2yjwIVDBNoNpbPOfxXazCQazZrAR/gS+Ad+xN5aGP/sQSJ33JmP7m2cYLNiIW+5/uTRD+Yj98BfGhFtzrdCBBBu5byDWqwzrd8FwoW+Rzj4zA5uPBf+LcfW+q38BmqVkrsNuDnIAAAAASUVORK5CYII%3D), auto");
                    U = N ? parseInt(k.style.height) : parseInt(k.style.width)
                },
                onmove: function(a) {
                    if (N) {
                        U + a.offset.y < parseInt(x.style.height) ? k.style.height = U + a.offset.y + "px" : k.style.height = parseInt(x.style.height) + "px";
                        0 > U + a.offset.y && (k.style.height = "0px");
                        if (canvassupport) try {
                            e.height = parseInt(k.style.height)
                        } catch (b) {}
                        t = 100 * parseInt(k.style.height) / parseInt(x.style.height)
                    } else {
                        U + a.offset.x < parseInt(x.style.width) ? k.style.width = U + a.offset.x + "px" : k.style.width = parseInt(x.style.width) + "px";
                        0 > U + a.offset.x && (k.style.width =
                            "0px");
                        if (canvassupport) try {
                            e.width = parseInt(k.style.width)
                        } catch (m) {}
                        t = 100 * parseInt(k.style.width) / parseInt(x.style.width)
                    }
                    n.innerHTML = Math.ceil(t) + "%";
                    R ? g.volume = t / 100 : u.fl_volume(t / 100)
                },
                onfinish: function(m) {
                    b("#" + a + "volumegrab").css("cursor", "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNAay06AAAALlSURBVEiJxZe9bhNBEMd/5zsSkhjs0Fi0SYG7CAmltQUpeAGeISmTB6CFSOQFkoKOwqJAQAQNCCHyIUs0KYAiEmUaQ2GshORuPyhu196c95wLSHik0a3v7P3Nf2Zudx1orRmHlcZCHSc48t0MgqDIbwPjANr4SHPL6gWPsJIDe2k+PwAUIIwXaxqt9ZB7LAC2gTfANeCtNga8A24CVeAqEDrB5bKKgrctaHNzU5fLZe2Aj42/B2omsEkTQC64SHOVgMaI54GUcjqO47vAd+AFcB2YAq7kqS8K9ppSCiAQQiCEAAi63e494DkwC0yT9tEQvAjY7V7m5+cBkFJaGEmS9MFCCDqdTgN4Rlr3aTxpLwLWwMOtrS0Ams0mjUZjCGaDcMZ3gBvADJ6UFwU/XV5ePraTKqXIgbnjgLTWFnyOVeQ91qTvJ0mSoJSi1Wr1A7AwKWVfvRlD2t0TeFI9Cmxr238vLUwphZQSKSVHR0eTLiwDDo1Sd+GBrPyMvQa6wCvSBumn0dbXNpj1w8PDSaf2Nniv5SkuAY1er1dWSt2vVCotTBqtWt/VHRvLXT7zFAfAjlXU6XSaFmwV+dw+29vbA/hGuoYrPJtIbqqjKFqvVqsf7KRLS0tTPojPV1ZWDhg0pTTwQoq1EOJzGIYbtVrtU5IkrK6uemG+e8At4BEQG5dZxXk1VkAipWwDQghBvV4nW2Nfndvttp0jBk6BMzzb5aiuFsBJFEXrc3NzH0fV1PW1tbUD4Ou/gBUQCyH2wzB8Uq/Xdy5qKifNjw30FEi4RI1d+JmUcj8Mw42FhYVdC8mrt7EY+G089oEvWjJtZ55IKXfDMAwWFxdvk9mxMvbFAE/ISTNA4DtxeA57JdJ1d4Z0n50FyqTrsJs1TarwF/AD+El6OpHwd4c9ZaLXzthu8lmwIFXcM98bSjMUV2ytZGAT5jq06zA4ccYMFpA0Kod1WTAM6juqzjYz5ya/EPw/bGx/Yf4AHxykPX4eCXQAAAAASUVORK5CYII%3D), auto");
                    try {
                        window.localStorage.removeItem(a + "volume"), window.localStorage.setItem(a + "volume", t)
                    } catch (c) {}
                }
            });
            b(window).resize(function() {
                Ja()
            });
            h = document.createElement("div");
            h.id = a + "contextmenu";
            h.style.zIndex = 987;
            h.style.position = "absolute";
            h.style.backgroundColor = ea;
            h.style.visibility = "hidden";
            h.style.whiteSpace = "nowrap";
            h.style.color = "#FFFFFF";
            h.style.fontFamily = "'Oswald', sans-serif";
            h.style.fontWeight = "300";
            h.style.textAlign = "left";
            h.style.cursor = "pointer";
            w.appendChild(h);
            h.onmouseover = function(a) {
                h.style.backgroundColor =
                    ga;
                h.style.color = "#FFFFFF";
                mouseOverContext = !0;
                return !1
            };
            h.onmouseout = function(a) {
                h.style.backgroundColor = ea;
                h.style.color = "#FFFFFF";
                return mouseOverContext = !1
            };
            h.onmousedown = function(a) {
                top.location != za.location ? top.location.href = ka : za.location.href = ka;
                h.style.visibility = "hidden";
                h.style.display = "none";
                return mouseOverContext = !1
            };
            M.oncontextmenu = Z;
            Aa(M, "contextmenu", Z);
            Aa(M, "mousedown", aa);
            Aa(M, "touchstart", aa);
            Ja();
            if (R) {
                g = document.createElement("audio");
                g.id = a + "html5audio";
                g.controls = !0;
                g.style.position =
                    "absolute";
                g.style.width = "0px";
                g.style.height = "0px";
                K.appendChild(g);
                g.preload = "auto";
                if (Ba) try {
                    Ca = new(window.AudioContext || window.webkitAudioContext), V = Ca.createAnalyser(), V.smoothingTimeConstant = .9, V.fftSize = 1024, Ua.connect(V), V.connect(Ca.destination)
                } catch (l) {}
                g.onabort = function() {};
                g.onended = function() {};
                g.oncanplay = function() {};
                g.ondurationchange = function() {
                    L && "console" in window && console.log(g.currentSrc)
                };
                g.onerror = function() {};
                g.onloadeddata = function() {};
                g.onloadedmetadata = function() {};
                g.onloadstart =
                    function() {};
                g.onpause = function() {};
                g.onplay = function() {};
                g.onplaying = function() {};
                g.onprogress = function() {};
                g.onseeked = function() {};
                g.onstalled = function() {};
                g.onsuspend = function() {};
                g.onwaiting = function() {
                    g.play()
                };
                g.addEventListener("timeupdate", function() {}, !1);
                ia && !mobilecheck() && (J = !0, ya())
            } else Va();
            Ka();
            setInterval(function() {
                Ka()
            }, 2E4);
            N ? k.style.height = "0px" : k.style.width = "0px";
            xa(t, 0)
        }

        function Wa() {
            C.style.visibility = "visible";
            try {
                b("#" + a + "stopbutton").css("opacity", "0.0"), b("#" + a + "playbutton").stop(),
                    b("#" + a + "playbutton").animate({
                        opacity: 0
                    }, 200, function() {
                        B.style.visibility = "hidden"
                    }), b("#" + a + "stopbutton").stop(), b("#" + a + "stopbutton").animate({
                        opacity: 1
                    }, 200, function() {})
            } catch (m) {}
        }

        function Ta() {
            B.style.visibility = "visible";
            try {
                b("#" + a + "playbutton").css("opacity", "0.0"), b("#" + a + "playbutton").stop(), b("#" + a + "playbutton").animate({
                    opacity: 1
                }, 200, function() {}), b("#" + a + "stopbutton").stop(), b("#" + a + "stopbutton").animate({
                    opacity: 0
                }, 200, function() {
                    C.style.visibility = "hidden"
                })
            } catch (m) {}
        }

        function xa(m,
            fa) {
            fa = fa || 0;
            fa != m && b({
                countNum: fa
            }).animate({
                countNum: Math.floor(m)
            }, {
                duration: 800,
                easing: "linear",
                step: function() {
                    n.innerHTML = Math.ceil(this.countNum) + "%";
                    try {
                        0 == Math.ceil(this.countNum) % 5 && (R ? g.volume = this.countNum / 100 : u.fl_volume(Math.floor(this.countNum) / 100))
                    } catch (a) {}
                },
                complete: function() {
                    n.innerHTML = Math.floor(m) + "%";
                    try {
                        if (R) g.volume = m / 100;
                        else {
                            var a = Math.round(m) / 100;
                            u.fl_volume(a)
                        }
                    } catch (b) {}
                }
            });
            if (N) {
                if (k.style.left = "0px", k.style.top = d + "px", b("#" + a + "volumecontroller").stop(), b("#" + a +
                        "volumecontroller").animate({
                        height: l / 100 * m + "px"
                    }, {
                        duration: 800,
                        progress: function() {
                            if (canvassupport) try {
                                e.height = Math.round(parseInt(k.style.height))
                            } catch (a) {}
                        },
                        complete: function() {
                            if (canvassupport) try {
                                e.height = Math.round(parseInt(k.style.height))
                            } catch (a) {}
                        }
                    }), k.style.width = d + "px", b("#" + a + "volumecontroller").css("border-right", "none"), canvassupport) try {
                    e.style.left = "0px", e.style.top = d + "px", e.width = d
                } catch (f) {}
            } else if (k.style.top =
                "0px", b("#" + a + "volumecontroller").stop(), b("#" + a + "volumecontroller").animate({
                    width: l / 100 * m + "px"
                }, {
                    duration: 800,
                    progress: function() {
                        if (canvassupport) try {
                            e.width = Math.round(parseInt(k.style.width))
                        } catch (a) {}
                    },
                    complete: function() {
                        if (canvassupport) try {
                            e.width = Math.round(parseInt(k.style.width))
                        } catch (a) {}
                    }
                }), k.style.height = c + "px", b("#" + a + "volumecontroller").css("border-bottom", "none"), canvassupport) try {
                e.style.top = "0px",
                    e.height = c
            } catch (h) {}
        }

        function Ja() {
            d = b("#" + a).width();
            c = b("#" + a).height();
            if (N = d < c ? !0 : !1) {
                l = c - 2 * d;
                b("#" + a + "volumecontroller").stop();
                k.style.left = "0px";
                k.style.top = d + "px";
                k.style.width = d + "px";
                k.style.height = l / 100 * t + "px";
                b("#" + a + "volumecontroller").css("border-bottom", "solid 1px " + v);
                b("#" + a + "volumecontroller").css("border-right", "none");
                if (canvassupport) try {
                    e.height = Math.round(l / 100 * t), e.style.left = "0px", e.style.top = d + "px", e.width = d
                } catch (m) {}
                y.style.height = d + "px";
                y.style.width =
                    d + "px";
                B.style.top = "0px";
                B.style.left = "0px";
                B.style.height = d + "px";
                B.style.width = d + "px";
                C.style.top = "0px";
                C.style.left = "0px";
                C.style.height = d + "px";
                C.style.width = d + "px";

                channelname.style.fontSize = d / 2 + "px";
                channelname.style.lineHeight = d / 2 + "px";
                channelname.style.width = l + "px";
                channelname.style.height = d / 2 + "px";
                channelname.style.top = d + l / 2 + "px";
                channelname.style.left =
                    d - parseInt(channelname.style.height) / 2 - l / 2 + "px";
                b("#" + a + "channelname").css({
                    rotate: "90deg"
                });
                x.style.left = "0px";
                x.style.top = d + "px";
                x.style.height = l + "px";
                x.style.width = d + "px";
                D.style.left = "0px";
                D.style.top = d + l + "px";
                D.style.width = d + "px";
                D.style.height = d + "px";
                F.style.height = d / 2 + "px";
                F.style.width = d / 2 + "px";
                F.style.top = (d - d / 2) / 2 + "px";
                F.style.left = d - (d / 20 + d / 2) + "px";
                b("#" + a + "volumeimg").css({
                    rotate: "90deg"
                });
                n.style.fontSize = d / 4 + "px";
                n.style.lineHeight = d / 4 + "px";
                n.style.height = d / 4 + "px";
                n.style.width = d + "px";
                n.style.top = parseInt(n.style.width) / 2 - d / 8 + "px";
                n.style.left = parseInt(n.style.height) / 2 - parseInt(n.style.width) / 2 + d / 10 + "px";
                b("#" + a + "volumetext").css({
                    rotate: "90deg"
                });
                A.style.width = d + "px";
                A.style.height = d + "px";
                A.style.left = "0px";
                A.style.top = "0px";
                L && (q.style.fontSize = d / 4 + "px", q.style.lineHeight = d / 4 + "px", q.style.height = d / 4 + "px", q.style.width = d / 4 + "px", q.style.top = c - d - parseInt(q.style.width) + "px", q.style.left = d / 10 + "px", b("#" + a + "devicetext").css({
                    rotate: "90deg"
                }));
                r.style.fontSize = d / 4 + "px";
                r.style.lineHeight =
                    d / 4 + "px";
                r.style.height = d / 4 + "px";
                r.style.width = l + "px";
                r.style.top = d + parseInt(r.style.width) / 2 + "px";
                r.style.left = 0 - parseInt(r.style.width) / 2 + d / 10 + d / 4 / 2 + "px";
                b("#" + a + "statustext").css({
                    rotate: "90deg"
                });
                h.style.left = 0 - (l / 2 - d / 2) + "px";
                h.style.top = l / 2 - d / 2 + d + "px";
                h.style.width = l + "px";
                h.style.height = d + "px";
                h.style.fontSize = d / 2 + "px";
                h.style.lineHeight = d + "px";
                b("#" + a + "contextmenu").css({
                    rotate: "90deg"
                })
            } else {
                l = d - 2 * c;
                b("#" + a + "volumecontroller").stop();
                k.style.top = "0px";
                k.style.height = c + "px";
                k.style.width = l / 100 * t + "px";
                b("#" + a + "volumecontroller").css("border-bottom", "none");
                if (canvassupport) try {
                    e.width = Math.round(l / 100 * t), e.style.top = "0px", e.height = c
                } catch (fa) {}
                y.style.height = c + "px";
                y.style.width = c + "px";
                B.style.top = "0px";
                B.style.left = "0px";
                B.style.height = c + "px";
                B.style.width = c + "px";
                C.style.top = "0px";
                C.style.left = "0px";
                C.style.height = c + "px";
                C.style.width = c + "px";

             
                b("#" + a + "channelname").css({
                    rotate: "0deg"
                });
                x.style.top = "0px";
                x.style.left = c + "px";
                x.style.width = l + "px";
                x.style.height = c + "px";
                b("#" + a + "volumeimg").css({
                    rotate: "0deg"
                });
                n.style.fontSize = c / 4 + "px";
                n.style.lineHeight = c / 4 + "px";
                n.style.height = c / 4 + "px";
                n.style.width = c + "px";
                n.style.left = "0px";
                b("#" + a + "volumetext").css({
                    rotate: "0deg"
                });
                L && (q.style.fontSize = c / 4 + "px", q.style.lineHeight = c / 4 + "px", q.style.height = c / 4 + "px", q.style.width = c / 4 + "px", q.style.top = c - parseInt(q.style.height) - c / 10 + c /
                    40 + "px", q.style.right = c + "px");
       
                b("#" + a + "statustext").css({
                    rotate: "0deg"
                });
                D.style.left = c + l + "px";
                D.style.top = "0px";
                D.style.width = c + "px";
                D.style.height = c + "px";
                A.style.width = c + "px";
                A.style.height = c + "px";
                A.style.left = "0px";
                A.style.top = "0px";
                h.style.top = "0px";
                h.style.left = c + "px";
                h.style.width = l + "px";
                h.style.height = c + "px";
                h.style.fontSize = c / 2 + "px";
                h.style.lineHeight = c + "px";
                b("#" + a + "contextmenu").css({
                    rotate: "0deg"
                })
            }
            wa();
            La();
            b("#" + a + "contextmenu").html('<div style="height:' + c + "px; overflow: hidden; width:" + l + 'px;" class="' + a + 'marquee_contextmenu">' + ca + "</div>");
            try {
                Ma.marquee("destroy")
            } catch (f) {}
            Ma = b("." + a + "marquee_contextmenu").marquee({
                duration: 2E3 * l / 300,
                gap: 0,
                delayBeforeStart: 0,
                direction: "left",
                duplicated: !1
            })
        }

        function wa() {
            b("#" + a + "channelname").html("<span>" + I + "</span>");
            "TRUE" == O.toUpperCase() &&
                b("#" + a + "channelname").html('<div style="height:' + c + "px; vertical-align: top; overflow: hidden; width:" + l + 'px;" class="' + a + 'marquee_channelname">' + I + "</div>");
            "FALSE" == O.toUpperCase() && b("#" + a + "channelname").html('<div style="height:' + c + "px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:" + l + 'px;">' + I + "</div>");
            "AUTO" == O.toUpperCase() && (b("#" + a + "channelname").html("<span>" + I + "</span>"), N ? b("#" + a + "channelname").find("span:first").width() > c - 2 * d && b("#" + a + "channelname").html('<div style="height:' +
                c + "px; vertical-align: top; overflow: hidden; width:" + l + 'px;" class="' + a + 'marquee_channelname">' + I + "</div>") : b("#" + a + "channelname").find("span:first").width() > d - 2 * c && b("#" + a + "channelname").html('<div style="height:' + c + "px; vertical-align: top; overflow: hidden; width:" + l + 'px;" class="' + a + 'marquee_channelname">' + I + "</div>"));
            try {
                Na.marquee("destroy")
            } catch (m) {}
            Na = b("." + a + "marquee_channelname").marquee({
                duration: 5E3 * l / 300,
                gap: 0,
                delayBeforeStart: 0,
                direction: "left",
                duplicated: !1
            })
        }

        function La() {
            b("#" +
                a + "statustext").html("<span>" + S + "</span>");
            "TRUE" == O.toUpperCase() && b("#" + a + "statustext").html('<div style="height:' + c + "px; vertical-align: top; overflow: hidden; width:" + l + 'px;" class="' + a + 'marquee_statustext">' + S + "</div>");
            "FALSE" == O.toUpperCase() && b("#" + a + "statustext").html('<div style="height:' + c + "px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:" + l + 'px;">' + S + "</div>");
            "AUTO" == O.toUpperCase() && (b("#" + a + "statustext").html("<span>" + S + "</span>"), N ? b("#" + a + "statustext").find("span:first").width() >
                c - 2 * d && b("#" + a + "statustext").html('<div style="height:' + c + "px; vertical-align: top; overflow: hidden; width:" + l + 'px;" class="' + a + 'marquee_statustext">' + S + "</div>") : b("#" + a + "statustext").find("span:first").width() > d - 2 * c && b("#" + a + "statustext").html('<div style="height:' + c + "px; vertical-align: top; overflow: hidden; width:" + l + 'px;" class="' + a + 'marquee_statustext">' + S + "</div>"));
            try {
                Oa.marquee("destroy")
            } catch (m) {}
            Oa = b("." + a + "marquee_statustext").marquee({
                duration: 5E3 * l / 300,
                gap: 0,
                delayBeforeStart: 0,
                direction: "left",
                duplicated: !1
            })
        }

        function Va() {
            if (W.msie && (9 > Number(W.version) || 9 > W.documentMode)) {
                var b = ['<param name="movie" value="' + Q + 'flashradio.swf" />', '<param name="FlashVars" value="id=' + a + '" />', '<param name="allowScriptAccess" value="always" />', '<param name="bgcolor" value="#ffffff" />', '<param name="wmode" value="window" />'];
                u = document.createElement('<object id="' + a + 'flash" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="0" height="0" tabindex="-1"></object>');
                for (var c = 0; c < b.length; c++) u.appendChild(document.createElement(b[c]))
            } else b =
                function(a, b, m) {
                    var c = document.createElement("param");
                    c.setAttribute("name", b);
                    c.setAttribute("value", m);
                    a.appendChild(c)
                }, u = document.createElement("object"), u.setAttribute("id", a + "flash"), u.setAttribute("name", a + "flash"), u.setAttribute("data", Q + "flashradio.swf"), u.setAttribute("type", "application/x-shockwave-flash"), u.setAttribute("width", "1"), u.setAttribute("height", "1"), u.setAttribute("tabindex", "-1"), b(u, "flashvars", "id=" + a), b(u, "allowscriptaccess", "always"), b(u, "bgcolor", "#ffffff"), b(u, "wmode",
                    "window");
            K.appendChild(u)
        }

        function ya() {
            if (0 < T.length)
                if (R) {
                    for (var a = 0; a < T.length; a += 1) {
                        var b = document.createElement("source");
                        b.type = "audio/mpeg";
                        b.src = T[a];
                        g.appendChild(b)
                    }
                    g.load();
                    g.play()
                } else J = !0, u.fl_setStream(H), u.fl_play();
            Wa();
            da()
        }

        function da() {
            if (canvassupport) try {
                if (window.requestAnimationFrame(da) || window.mozRequestAnimationFrame(da) || window.webkitRequestAnimationFrame(da) || window.msRequestAnimationFrame(da) || window.oRequestAnimationFrame(da), g) {
                    if (Ba) {
                        var a = new Uint8Array(V.frequencyBinCount);
                        V.getByteFrequencyData(a);
                        f.clearRect(0, 0, e.width, e.height);
                        f.lineWidth = 1;
                        f.miterLimit = 1;
                        f.beginPath();
                        if (N)
                            for (f.moveTo(0, 0), b = 0; b < a.length / 2; b += 1) f.lineTo(a[b] * e.width / 255, b * e.height / a.length * 2);
                        else {
                            f.moveTo(0, e.height);
                            for (var b = 0; b < a.length / 2; b += 1) f.lineTo(b * e.width / a.length * 2, e.height - a[b] * e.height / 255)
                        }
                        f.strokeStyle = v;
                        f.shadowColor = "#FFFFFF";
                        f.shadowBlur = 10;
                        f.shadowOffsetX = 0;
                        f.shadowOffsetY = 0;
                        f.stroke();
                        f.closePath()
                    }
                } else f.clearRect(0, 0, e.width, e.height), f.lineWidth = 1, f.miterLimit = 1, f.beginPath(),
                    X += (Pa - X) / 6, Y += (Qa - Y) / 6, N ? (f.moveTo(e.width, 1), f.lineTo(e.width, X / 100 * e.height), f.lineTo(e.width / 2, X / 100 * e.height), f.lineTo(e.width / 2, Y / 100 * e.height), f.lineTo(0, Y / 100 * e.height), f.lineTo(0, 0), f.lineTo(e.width, 1)) : (f.moveTo(1, 0), f.lineTo(X / 100 * e.width, 0), f.lineTo(X / 100 * e.width, e.height / 2), f.lineTo(Y / 100 * e.width, e.height / 2), f.lineTo(Y / 100 * e.width, e.height), f.lineTo(1, e.height), f.lineTo(1, 0)), f.strokeStyle = v, f.stroke(), f.fillStyle = v, f.fill(), f.closePath()
            } catch (c) {}
        }

        function Sa() {
            b.get(Q + "radioname.php?url=" +
                ma[0],
                function(a) {
                    I = a;
                    wa()
                }).done(function() {}).fail(function() {}).always(function() {}).always(function() {})
        }

        function Ka() {
            if ("" != P) b.get(P, function(a) {
                S != a && (S = a, La())
            }).done(function() {}).fail(function() {}).always(function() {}).always(function() {});
            else try {
                b("#" + a + "statustext").html("")
            } catch (m) {}
        }

        function Aa(a, b, c) {
            a.addEventListener ? a.addEventListener(b, c, !1) : a.attachEvent && (a["e" + b + c] = c, a[b + c] = function() {
                a["e" + b + c](window.event)
            }, a.attachEvent("on" + b, a[b + c]))
        }

        function ja(a) {
            /^(f|ht)tps?:\/\//i.test(a) ||
                (a = "http://" + a);
            return a
        }

        function Fa(a) {
            "/" == a.slice(a.length - 1, a.length) && (a = a.slice(0, a.length - 1));
            "/;" == a.slice(a.length - 2, a.length) && (a = a.slice(0, a.length - 2));
            return a
        }

        function ha(a, b) {
            a = String(a).replace(/[^0-9a-f]/gi, "");
            6 > a.length && (a = a[0] + a[0] + a[1] + a[1] + a[2] + a[2]);
            b = b || 0;
            var c = "#",
                d, e;
            for (e = 0; 3 > e; e++) d = parseInt(a.substr(2 * e, 2), 16), d = Math.round(Math.min(Math.max(0, d + d * b), 255)).toString(16), c += ("00" + d).substr(d.length);
            return c
        }
        var Xa = G.id;
        if (arguments.length) {
            this.element = b(G);
            this.options =
                b.extend(!0, {}, this.options, p);
            var za = this;
            this.element.bind("remove.flashradio", function() {
                za.destroy()
            })
        }
        var v = "#0d72bf",
            I = "NATIVE FLASH RADIO V3 BY SODAH.DE",
            O = "AUTO",
            ia = !1,
            la = !1,
            L = !1,
            P = "",
            ca = "",
            ka = "",
            Ga = p.themecolor,
            va = p.channelurls,
            na = p.radioname,
            oa = p.scroll,
            pa = p.autoplay,
            qa = p.html5chrome,
            ra = p.debug,
            sa = p.songtitleurl,
            ta = p.startvolume,
            Ea = p.settings,
            ua = p.infotext,
            Ha = p.infolink,
            a, M, w, y, B, C, u, k, ea, ga, J = !1,
            N = !1,
            x, U, l, t = 75,
            n, T = [],
            ma = [],
            R = !1,
            e, V, f, Ca, Ua, r, q, E, F, S = "",
            D, A, d = 0,
            c = 0,
            Ia = 0,
            h, Oa, Na, Ma, g, Ba = !1,
            K, H, W = {},
            Pa = 0,
            X = 0,
            Qa = 0,
            Y = 0,
            Q;
        b(document).ready(function() {
            a = Xa;
            var b = document.createElement("canvas");
            canvassupport = !(!b.getContext || !b.getContext("2d"));
            mobilecheck() || /firefox/.test(navigator.userAgent.toLowerCase());
            Ba = !1;
            var b = document.getElementsByTagName("script"),
                c, d;
            for (c = 0; d = b[c]; c++)
                if (d = d.src, 0 <= d.indexOf("nativeflashradiov3.js")) var e = d.substring(0, d.indexOf("nativeflashradiov3.js"));
            Q = e;
            Ra()
        });
        this.FlashStreamStarted = function() {};
        this.FlashStreamStoped = function(a) {};
        this.PeakmeterLeft =
            function(a) {
                Pa = a
            };
        this.PeakmeterRight = function(a) {
            Qa = a
        };
        this.FlashIsReady = function() {
            ia && (J = !0, ya())
        };
        getFlashPluginVersion = function() {
            var a = 0,
                b;
            if (window.ActiveXObject) try {
                if (b = new ActiveXObject("ShockwaveFlash.ShockwaveFlash")) {
                    var c = b.GetVariable("$version");
                    c && (c = c.split(" ")[1].split(","), a = parseInt(c[0], 10) + "." + parseInt(c[1], 10))
                }
            } catch (d) {} else navigator.plugins && 0 < navigator.mimeTypes.length && (b = navigator.plugins["Shockwave Flash"]) && (a = navigator.plugins["Shockwave Flash"].description.replace(/.*\s(\d+\.\d+).*/,
                "$1"));
            return 1 * a
        };
        mobilecheck = function() {
            return navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ? !0 : !1
        };
        uaBrowser = function(a) {
            a = a.toLowerCase();
            var b = /(opera)(?:.*version)?[ \/]([\w.]+)/,
                c = /(msie) ([\w.]+)/,
                d = /(mozilla)(?:.*? rv:([\w.]+))?/;
            a = /(webkit)[ \/]([\w.]+)/.exec(a) || b.exec(a) ||
                c.exec(a) || 0 > a.indexOf("compatible") && d.exec(a) || [];
            return {
                browser: a[1] || "",
                version: a[2] || "0"
            }
        };
        uaPlatform = function(a) {
            var b = a.toLowerCase(),
                c = /(android)/,
                d = /(mobile)/;
            a = /(ipad|iphone|ipod|android|blackberry|playbook|windows ce|webos)/.exec(b) || [];
            b = /(ipad|playbook)/.exec(b) || !d.exec(b) && c.exec(b) || [];
            a[1] && (a[1] = a[1].replace(/\s/g, "_"));
            return {
                platform: a[1] || "",
                tablet: b[1] || ""
            }
        };
        var Da = uaBrowser(navigator.userAgent);
        Da.browser && (W[Da.browser] = !0, W.version = Da.version);
        uaPlatform(navigator.userAgent);
        getDocMode = function() {
            var a;
            W.msie && (document.documentMode ? a = document.documentMode : (a = 5, document.compatMode && "CSS1Compat" === document.compatMode && (a = 7)));
            return a
        };
        W.documentMode = getDocMode()
    }
});




/*
jQuery grab 
https://github.com/jussi-kalliokoski/jQuery.grab
Ported from Jin.js::gestures   
https://github.com/jussi-kalliokoski/jin.js/
Created by Jussi Kalliokoski
Licensed under MIT License. 

Includes fix for IE
*/
(function($) {
    function unbind(e, t, n) {
        if (t.substr(0, 5) !== "touch") {
            return $(e).unbind(t, n)
        }
        var r, i;
        for (i = 0; i < bind._binds.length; i++) {
            if (bind._binds[i].elem === e && bind._binds[i].type === t && bind._binds[i].func === n) {
                if (document.addEventListener) {
                    e.removeEventListener(t, bind._binds[i].fnc, false)
                } else {
                    e.detachEvent("on" + t, bind._binds[i].fnc)
                }
                bind._binds.splice(i--, 1)
            }
        }
    }

    function bind(e, t, n, r) {
        if (t.substr(0, 5) !== "touch") {
            return $(e).bind(t, r, n)
        }
        var i, s;
        if (bind[t]) {
            return bind[t].bind(e, t, n, r)
        }
        i = function(t) {
            if (!t) {
                t = window.event
            }
            if (!t.stopPropagation) {
                t.stopPropagation = function() {
                    this.cancelBubble = true
                }
            }
            t.data = r;
            n.call(e, t)
        };
        if (document.addEventListener) {
            e.addEventListener(t, i, false)
        } else {
            e.attachEvent("on" + t, i)
        }
        bind._binds.push({
            elem: e,
            type: t,
            func: n,
            fnc: i
        })
    }

    function grab(e, t) {
        var n = {
            move: {
                x: 0,
                y: 0
            },
            offset: {
                x: 0,
                y: 0
            },
            position: {
                x: 0,
                y: 0
            },
            start: {
                x: 0,
                y: 0
            },
            affects: document.documentElement,
            stopPropagation: false,
            preventDefault: true,
            touch: true
        };
        extend(n, t);
        n.element = e;
        bind(e, mousedown, mouseDown, n);
        if (n.touch) {
            bind(e, touchstart, touchStart, n)
        }
    }

    function ungrab(e) {
        unbind(e, mousedown, mousedown)
    }

    function mouseDown(e) {
        e.data.position.x = e.pageX;
        e.data.position.y = e.pageY;
        e.data.start.x = e.pageX;
        e.data.start.y = e.pageY;
        e.data.event = e;
        if (e.data.onstart && e.data.onstart.call(e.data.element, e.data)) {
            return
        }
        if (e.preventDefault && e.data.preventDefault) {
            e.preventDefault()
        }
        if (e.stopPropagation && e.data.stopPropagation) {
            e.stopPropagation()
        }
        bind(e.data.affects, mousemove, mouseMove, e.data);
        bind(e.data.affects, mouseup, mouseUp, e.data)
    }

    function mouseMove(e) {
        if (e.preventDefault && e.data.preventDefault) {
            e.preventDefault()
        }
        if (e.stopPropagation && e.data.preventDefault) {
            e.stopPropagation()
        }
        e.data.move.x = e.pageX - e.data.position.x;
        e.data.move.y = e.pageY - e.data.position.y;
        e.data.position.x = e.pageX;
        e.data.position.y = e.pageY;
        e.data.offset.x = e.pageX - e.data.start.x;
        e.data.offset.y = e.pageY - e.data.start.y;
        e.data.event = e;
        if (e.data.onmove) {
            e.data.onmove.call(e.data.element, e.data)
        }
    }

    function mouseUp(e) {
        if (e.preventDefault && e.data.preventDefault) {
            e.preventDefault()
        }
        if (e.stopPropagation && e.data.stopPropagation) {
            e.stopPropagation()
        }
        unbind(e.data.affects, mousemove, mouseMove);
        unbind(e.data.affects, mouseup, mouseUp);
        e.data.event = e;
        if (e.data.onfinish) {
            e.data.onfinish.call(e.data.element, e.data)
        }
    }

    function touchStart(e) {
        e.data.position.x = e.touches[0].pageX;
        e.data.position.y = e.touches[0].pageY;
        e.data.start.x = e.touches[0].pageX;
        e.data.start.y = e.touches[0].pageY;
        e.data.event = e;
        if (e.data.onstart && e.data.onstart.call(e.data.element, e.data)) {
            return
        }
        if (e.preventDefault && e.data.preventDefault) {
            e.preventDefault()
        }
        if (e.stopPropagation && e.data.stopPropagation) {
            e.stopPropagation()
        }
        bind(e.data.affects, touchmove, touchMove, e.data);
        bind(e.data.affects, touchend, touchEnd, e.data)
    }

    function touchMove(e) {
        if (e.preventDefault && e.data.preventDefault) {
            e.preventDefault()
        }
        if (e.stopPropagation && e.data.stopPropagation) {
            e.stopPropagation()
        }
        e.data.move.x = e.touches[0].pageX - e.data.position.x;
        e.data.move.y = e.touches[0].pageY - e.data.position.y;
        e.data.position.x = e.touches[0].pageX;
        e.data.position.y = e.touches[0].pageY;
        e.data.offset.x = e.touches[0].pageX - e.data.start.x;
        e.data.offset.y = e.touches[0].pageY - e.data.start.y;
        e.data.event = e;
        if (e.data.onmove) {
            e.data.onmove.call(e.data.elem, e.data)
        }
    }

    function touchEnd(e) {
        if (e.preventDefault && e.data.preventDefault) {
            e.preventDefault()
        }
        if (e.stopPropagation && e.data.stopPropagation) {
            e.stopPropagation()
        }
        unbind(e.data.affects, touchmove, touchMove);
        unbind(e.data.affects, touchend, touchEnd);
        e.data.event = e;
        if (e.data.onfinish) {
            e.data.onfinish.call(e.data.element, e.data)
        }
    }
    var extend = $.extend,
        mousedown = "mousedown",
        mousemove = "mousemove",
        mouseup = "mouseup",
        touchstart = "touchstart",
        touchmove = "touchmove",
        touchend = "touchend",
        touchcancel = "touchcancel";
    bind._binds = [];
    $.fn.grab = function(e, t) {
        return this.each(function() {
            return grab(this, e, t)
        })
    };
    $.fn.ungrab = function(e) {
        return this.each(function() {
            return ungrab(this, e)
        })
    }
})(jQuery);

// This jQuery Plugin will disable drag or selection for Android and iOS devices.
jQuery.fn.extend({
    disableSelection: function() {
        this.each(function() {
            this.onselectstart = function() {
                return false;
            };
            this.onmousedown = function(ev) { //drag unterbinden
                return false;
            };
            this.unselectable = "on";
            jQuery(this).css('-moz-user-select', 'none');
            jQuery(this).css('-webkit-user-select', 'none');
            jQuery(this).css('-webkit-touch-callout', 'none');
            jQuery(this).css('-khtml-user-select', 'none');
            jQuery(this).css('-ms-user-select', 'none');
            jQuery(this).css('user-select', 'none');
            jQuery(this).css('tap-highlight-color', 'rgba(0, 0, 0, 0)');
            jQuery(this).css('-o-tap-highlight-color', 'rgba(0, 0, 0, 0)');
            jQuery(this).css('-moz-tap-highlight-color', 'rgba(0, 0, 0, 0)');
            jQuery(this).css('-webkit-tap-highlight-color', 'rgba(0, 0, 0, 0)');
        });
    }
});

/*
 * rotate: A jQuery cssHooks adding a cross browser 'rotate' property to $.fn.css() and $.fn.animate()
 *
 * Limitations:
 * - requires jQuery 1.4.3+
 * - cannot be used together with jquery.scale.js
 *
 * Copyright (c) 2010 Louis-RÃ©mi BabÃ© twitter.com/louis_remi
 * Licensed under the MIT license.
 * 
 * This saved you an hour of work? 
 * Send me music http://www.amazon.fr/wishlist/HNTU0468LQON
 *
 */
(function($) {
    var div = document.createElement('div'),
        divStyle = div.style,
        support = $.support;
    support.transform = divStyle.MozTransform === '' ? 'MozTransform' : (divStyle.MsTransform === '' ? 'MsTransform' : (divStyle.WebkitTransform === '' ? 'WebkitTransform' : (divStyle.OTransform === '' ? 'OTransform' : (divStyle.transform === '' ? 'transform' : false))));
    support.matrixFilter = !support.transform && divStyle.filter === '';
    div = null;
    $.cssNumber.rotate = true;
    $.cssHooks.rotate = {
        set: function(elem, value) {
            var _support = support,
                supportTransform = _support.transform,
                cos, sin, centerOrigin;
            if (typeof value === 'string') {
                value = toRadian(value)
            }
            $.data(elem, 'transform', {
                rotate: value
            });
            if (supportTransform) {
                elem.style[supportTransform] = 'rotate(' + value + 'rad)'
            } else if (_support.matrixFilter) {
                cos = Math.cos(value);
                sin = Math.sin(value);
                elem.style.filter = ["progid:DXImageTransform.Microsoft.Matrix(", "M11=" + cos + ",", "M12=" + (-sin) + ",", "M21=" + sin + ",", "M22=" + cos + ",", "SizingMethod='auto expand'", ")"].join('');
                if (centerOrigin = $.rotate.centerOrigin) {
                    elem.style[centerOrigin == 'margin' ? 'marginLeft' : 'left'] = -(elem.offsetWidth / 2) + (elem.clientWidth / 2) + "px";
                    elem.style[centerOrigin == 'margin' ? 'marginTop' : 'top'] = -(elem.offsetHeight / 2) + (elem.clientHeight / 2) + "px"
                }
            }
        },
        get: function(elem, computed) {
            var transform = $.data(elem, 'transform');
            return transform && transform.rotate ? transform.rotate : 0
        }
    };
    $.fx.step.rotate = function(fx) {
        $.cssHooks.rotate.set(fx.elem, fx.now + fx.unit)
    };

    function radToDeg(rad) {
        return rad * 180 / Math.PI
    }

    function toRadian(value) {
        if (~value.indexOf("deg")) {
            return parseInt(value, 10) * (Math.PI * 2 / 360)
        } else if (~value.indexOf("grad")) {
            return parseInt(value, 10) * (Math.PI / 200)
        }
        return parseFloat(value)
    }
    $.rotate = {
        centerOrigin: 'margin',
        radToDeg: radToDeg
    }
})(jQuery);



/*
 * Google Font
 * Oswald
 *
 */
WebFontConfig = {
    google: {
        families: ['Oswald:400,700,300:latin,latin-ext']
    }
};
(function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();


/**
 * jQuery.marquee - scrolling text like old marquee element
 * @author Aamir Afridi - aamirafridi(at)gmail(dot)com / http://aamirafridi.com/jquery/jquery-marquee-plugin
 */
;
(function(e) {
    e.fn.marquee = function(t) {
        return this.each(function() {
            var n = e.extend({}, e.fn.marquee.defaults, t),
                r = e(this),
                i, s, o, u, a, f = 3,
                l = "animation-play-state",
                c = false,
                h = function(e, t, n) {
                    var r = ["webkit", "moz", "MS", "o", ""];
                    for (var i = 0; i < r.length; i++) {
                        if (!r[i]) t = t.toLowerCase();
                        e.addEventListener(r[i] + t, n, false)
                    }
                },
                p = function(e) {
                    var t = [];
                    for (var n in e) {
                        if (e.hasOwnProperty(n)) {
                            t.push(n + ":" + e[n])
                        }
                    }
                    t.push();
                    return "{" + t.join(",") + "}"
                },
                d = function() {
                    r.timer = setTimeout(M, n.delayBeforeStart)
                },
                v = {
                    pause: function() {
                        if (c && n.allowCss3Support) {
                            i.css(l, "paused")
                        } else {
                            if (e.fn.pause) {
                                i.pause()
                            }
                        }
                        r.data("runningStatus", "paused");
                        r.trigger("paused")
                    },
                    resume: function() {
                        if (c && n.allowCss3Support) {
                            i.css(l, "running")
                        } else {
                            if (e.fn.resume) {
                                i.resume()
                            }
                        }
                        r.data("runningStatus", "resumed");
                        r.trigger("resumed")
                    },
                    toggle: function() {
                        v[r.data("runningStatus") == "resumed" ? "pause" : "resume"]()
                    },
                    destroy: function() {
                        clearTimeout(r.timer);
                        r.find("*").andSelf().unbind();
                        r.html(r.find(".js-marquee:first").html())
                    }
                };
            if (typeof t === "string") {
                if (e.isFunction(v[t])) {
                    if (!i) {
                        i = r.find(".js-marquee-wrapper")
                    }
                    if (r.data("css3AnimationIsSupported") === true) {
                        c = true
                    }
                    v[t]()
                }
                return
            }
            var m = {},
                g;
            e.each(n, function(e, t) {
                g = r.attr("data-" + e);
                if (typeof g !== "undefined") {
                    switch (g) {
                        case "true":
                            g = true;
                            break;
                        case "false":
                            g = false;
                            break
                    }
                    n[e] = g
                }
            });
            n.duration = n.speed || n.duration;
            u = n.direction == "up" || n.direction == "down";
            n.gap = n.duplicated ? n.gap : 0;
            r.wrapInner('<div class="js-marquee"></div>');
            var y = r.find(".js-marquee").css({
                "margin-right": n.gap,
                "float": "left"
            });
            if (n.duplicated) {
                y.clone(true).appendTo(r)
            }
            r.wrapInner('<div style="width:100000px" class="js-marquee-wrapper"></div>');
            i = r.find(".js-marquee-wrapper");
            if (u) {
                var b = r.height();
                i.removeAttr("style");
                r.height(b);
                r.find(".js-marquee").css({
                    "float": "none",
                    "margin-bottom": n.gap,
                    "margin-right": 0
                });
                if (n.duplicated) r.find(".js-marquee:last").css({
                    "margin-bottom": 0
                });
                var w = r.find(".js-marquee:first").height() + n.gap;
                n.duration = (parseInt(w, 10) + parseInt(b, 10)) / parseInt(b, 10) * n.duration
            } else {
                a = r.find(".js-marquee:first").width() + n.gap;
                s = r.width();
                n.duration = (parseInt(a, 10) + parseInt(s, 10)) / parseInt(s, 10) * n.duration
            }
            if (n.duplicated) {
                n.duration = n.duration / 2
            }
            if (n.allowCss3Support) {
                var E = document.body || document.createElement("div"),
                    S = "marqueeAnimation-" + Math.floor(Math.random() * 1e7),
                    x = "Webkit Moz O ms Khtml".split(" "),
                    T = "animation",
                    N = "",
                    C = "";
                if (E.style.animation) {
                    C = "@keyframes " + S + " ";
                    c = true
                }
                if (c === false) {
                    for (var k = 0; k < x.length; k++) {
                        if (E.style[x[k] + "AnimationName"] !== undefined) {
                            var L = "-" + x[k].toLowerCase() + "-";
                            T = L + T;
                            l = L + l;
                            C = "@" + L + "keyframes " + S + " ";
                            c = true;
                            break
                        }
                    }
                }
                if (c) {
                    N = S + " " + n.duration / 1e3 + "s " + n.delayBeforeStart / 1e3 + "s infinite " + n.css3easing;
                    r.data("css3AnimationIsSupported", true)
                }
            }
            var A = function() {
                    i.css("margin-top", n.direction == "up" ? b + "px" : "-" + w + "px")
                },
                O = function() {
                    i.css("margin-left", n.direction == "left" ? s + "px" : "-" + a + "px")
                };
            if (n.duplicated) {
                if (u) {
                    i.css("margin-top", n.direction == "up" ? b : "-" + (w * 2 - n.gap) + "px")
                } else {
                    i.css("margin-left", n.direction == "left" ? s + "px" : "-" + (a * 2 - n.gap) + "px")
                }
                f = 1
            } else {
                if (u) {
                    A()
                } else {
                    O()
                }
            }
            var M = function() {
                if (n.duplicated) {
                    if (f === 1) {
                        n._originalDuration = n.duration;
                        if (u) {
                            n.duration = n.direction == "up" ? n.duration + b / (w / n.duration) : n.duration * 2
                        } else {
                            n.duration = n.direction == "left" ? n.duration + s / (a / n.duration) : n.duration * 2
                        }
                        if (N) {
                            N = S + " " + n.duration / 1e3 + "s " + n.delayBeforeStart / 1e3 + "s " + n.css3easing
                        }
                        f++
                    } else if (f === 2) {
                        n.duration = n._originalDuration;
                        if (N) {
                            S = S + "0";
                            C = e.trim(C) + "0 ";
                            N = S + " " + n.duration / 1e3 + "s 0s infinite " + n.css3easing
                        }
                        f++
                    }
                }
                if (u) {
                    if (n.duplicated) {
                        if (f > 2) {
                            i.css("margin-top", n.direction == "up" ? 0 : "-" + w + "px")
                        }
                        o = {
                            "margin-top": n.direction == "up" ? "-" + w + "px" : 0
                        }
                    } else {
                        A();
                        o = {
                            "margin-top": n.direction == "up" ? "-" + i.height() + "px" : b + "px"
                        }
                    }
                } else {
                    if (n.duplicated) {
                        if (f > 2) {
                            i.css("margin-left", n.direction == "left" ? 0 : "-" + a + "px")
                        }
                        o = {
                            "margin-left": n.direction == "left" ? "-" + a + "px" : 0
                        }
                    } else {
                        O();
                        o = {
                            "margin-left": n.direction == "left" ? "-" + a + "px" : s + "px"
                        }
                    }
                }
                r.trigger("beforeStarting");
                if (c) {
                    i.css(T, N);
                    var t = C + " { 100%  " + p(o) + "}",
                        l = e("style");
                    if (l.length !== 0) {
                        l.filter(":last").append(t)
                    } else {
                        e("head").append("<style>" + t + "</style>")
                    }
                    h(i[0], "AnimationIteration", function() {
                        r.trigger("finished")
                    });
                    h(i[0], "AnimationEnd", function() {
                        M();
                        r.trigger("finished")
                    })
                } else {
                    i.animate(o, n.duration, n.easing, function() {
                        r.trigger("finished");
                        if (n.pauseOnCycle) {
                            d()
                        } else {
                            M()
                        }
                    })
                }
                r.data("runningStatus", "resumed")
            };
            r.bind("pause", v.pause);
            r.bind("resume", v.resume);
            if (n.pauseOnHover) {
                r.bind("mouseenter mouseleave", v.toggle)
            }
            if (c && n.allowCss3Support) {
                M()
            } else {
                d()
            }
        })
    };
    e.fn.marquee.defaults = {
        allowCss3Support: true,
        css3easing: "linear",
        easing: "linear",
        delayBeforeStart: 1e3,
        direction: "left",
        duplicated: false,
        duration: 5e3,
        gap: 20,
        pauseOnCycle: false,
        pauseOnHover: false
    }
})(jQuery);