function smoothScrollTo(y, speed) {

    speed = typeof speed == "undefined" ? 1 : speed;

    var distance = Math.abs(latestKnownScrollY - y),
        time     = speed * distance / 2000;

    TweenMax.to($(window), time, {scrollTo: {y: y, autoKill: true, ease: Quint.easeInOut}});
}