/**
 * Created by Ancora Themes on 26.05.2015.
 */

function ready() {
    var els = document.getElementsByTagName('a');
    for (var i = 0; i < els.length; i++) {
        els[i].setAttribute('title', els[i].text);
    }
}

document.addEventListener("DOMContentLoaded", ready);