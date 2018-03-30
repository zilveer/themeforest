

function venedor_shortcode_open(name, id) {

    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
    W = W - 80;
    H = H - 120;
    tb_show( name + ' Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId='+ id +'-form' );
}

function venedor_shortcode_close() {

}

function venedor_shortcode_animation_type() {
    var html = '<option value="">none</option>\
    <optgroup label="Attention Seekers">\
        <option value="bounce">bounce</option>\
        <option value="flash">flash</option>\
        <option value="pulse">pulse</option>\
        <option value="rubberBand">rubberBand</option>\
        <option value="shake">shake</option>\
        <option value="swing">swing</option>\
        <option value="tada">tada</option>\
        <option value="wobble">wobble</option>\
    </optgroup>\
    <optgroup label="Bouncing Entrances">\
        <option value="bounceIn">bounceIn</option>\
        <option value="bounceInDown">bounceInDown</option>\
        <option value="bounceInLeft">bounceInLeft</option>\
        <option value="bounceInRight">bounceInRight</option>\
        <option value="bounceInUp">bounceInUp</option>\
    </optgroup>\
    <optgroup label="Fading Entrances">\
        <option value="fadeIn">fadeIn</option>\
        <option value="fadeInDown">fadeInDown</option>\
        <option value="fadeInDownBig">fadeInDownBig</option>\
        <option value="fadeInLeft">fadeInLeft</option>\
        <option value="fadeInLeftBig">fadeInLeftBig</option>\
        <option value="fadeInRight">fadeInRight</option>\
        <option value="fadeInRightBig">fadeInRightBig</option>\
        <option value="fadeInUp">fadeInUp</option>\
        <option value="fadeInUpBig">fadeInUpBig</option>\
    </optgroup>\
    <optgroup label="Flippers">\
        <option value="flip">flip</option>\
        <option value="flipInX">flipInX</option>\
        <option value="flipInY">flipInY</option>\
    </optgroup>\
    <optgroup label="Lightspeed">\
        <option value="lightSpeedIn">lightSpeedIn</option>\
    </optgroup>\
    <optgroup label="Rotating Entrances">\
        <option value="rotateIn">rotateIn</option>\
        <option value="rotateInDownLeft">rotateInDownLeft</option>\
        <option value="rotateInDownRight">rotateInDownRight</option>\
        <option value="rotateInUpLeft">rotateInUpLeft</option>\
        <option value="rotateInUpRight">rotateInUpRight</option>\
    </optgroup>\
    <optgroup label="Sliders">\
        <option value="slideInDown">slideInDown</option>\
        <option value="slideInLeft">slideInLeft</option>\
        <option value="slideInRight">slideInRight</option>\
    </optgroup>\
    <optgroup label="Specials">\
        <option value="hinge">hinge</option>\
        <option value="rollIn">rollIn</option>\
    </optgroup>';

    return html;
}

function venedor_shortcode_boolean_true() {
    var html = '<option value="true" selected="selected">True</option>\
        <option value="false">False</option>';

    return html;
}

function venedor_shortcode_boolean_false() {
    var html = '<option value="true">True</option>\
        <option value="false" selected="selected">False</option>';

    return html;
}

function venedor_shortcode_wrapper_type() {
    var html = '<option value="rect">Rect</option>\
        <option value="circle" selected="selected">Circle</option>';

    return html;
}

function venedor_shortcode_target() {
    var html = '<option value=""></option>\
        <option value="_blank">Blank</option>\
        <option value="_self">Self</option>\
        <option value="_parent">Parent</option>\
        <option value="_top">Top</option>';

    return html;
}

function venedor_shortcode_align() {
    var html = '<option value=""></option>\
        <option value="left">Left</option>\
        <option value="center">Center</option>\
        <option value="right">Right</option>';

    return html;
}

function venedor_shortcode_align_center() {
    var html = '<option value="left">Left</option>\
        <option value="center" selected="selected">Center</option>\
        <option value="right">Right</option>';

    return html;
}

function venedor_shortcode_fontawesome_size() {
    var html = '<option value=""></option>\
        <option value="lg">lg</option>\
        <option value="2x">2x</option>\
        <option value="3x">3x</option>\
        <option value="4x">4x</option>\
        <option value="5x">5x</option>';

    return html;
}

function venedor_shortcode_gmap_type() {
    var html = '<option value="roadmap">Roadmap</option>\
        <option value="satellite">Satellite</option>\
        <option value="hybrid">Hybrid</option>\
        <option value="terrain">Terrain</option>';

    return html;
}

function venedor_shortcode_view_mode() {
    var html = '<option value="grid">Grid</option>\
        <option value="list">List</option>\
        <option value="slider">Slider</option>';

    return html;
}

function venedor_shortcode_orderby() {
    var html = '<option value="none">None</option>\
        <option value="ID">ID</option>\
        <option value="title">Title</option>\
        <option value="name">Name</option>\
        <option value="date">Date</option>\
        <option value="modified">Modified</option>\
        <option value="rand">Rand</option>';

    return html;
}

function venedor_shortcode_order() {
    var html = '<option value="desc">Desc</option>\
        <option value="inc">Inc</option>';

    return html;
}

function venedor_shortcode_testimonial_type() {
    var html = '<option value="normal">Normal</option>\
        <option value="banner">Banner</option>';

    return html;
}

function venedor_shortcode_transform() {
    var html = '<option value=""></option>\
        <option value="none">None</option>\
        <option value="capitalize">Capitalize</option>\
        <option value="uppercase">Uppercase</option>\
        <option value="lowercase">Lowercase</option>';

    return html;
}

function venedor_shortcode_title_size() {
    var html = '<option value=""></option>\
        <option value="large">Large</option>';

    return html;
}

function venedor_shortcode_line_pos() {
    var html = '<option value="middle">Middle</option>\
        <option value="top">Top</option>\
        <option value="bottom">Bottom</option>';

    return html;
}

function venedor_shortcode_blog_layout() {
    var html = '<option value="grid">Pinterest</option>\
        <option value="timeline">Timeline</option>\
        <option value="large-alt">Large Alt</option>\
        <option value="medium-alt">Medium Alt</option>\
        <option value="small-alt">Small Alt</option>';

    return html;
}

function venedor_shortcode_arrow_pos() {
    var html = '<option value=""></option>\
        <option value="arrow-top">Top</option>\
        <option value="arrow-bottom">Bottom</option>';

    return html;
}

function venedor_shortcode_fontawesome_icon() {
    var html = '<option value=""></option>\
        <option value="adjust">adjust</option>\
        <option value="adn">adn</option>\
        <option value="align-center">align-center</option>\
        <option value="align-justify">align-justify</option>\
        <option value="align-left">align-left</option>\
        <option value="align-right">align-right</option>\
        <option value="ambulance">ambulance</option>\
        <option value="anchor">anchor</option>\
        <option value="android">android</option>\
        <option value="angle-double-down">angle-double-down</option>\
        <option value="angle-double-left">angle-double-left</option>\
        <option value="angle-double-right">angle-double-right</option>\
        <option value="angle-double-up">angle-double-up</option>\
        <option value="angle-down">angle-down</option>\
        <option value="angle-left">angle-left</option>\
        <option value="angle-right">angle-right</option>\
        <option value="angle-up">angle-up</option>\
        <option value="apple">apple</option>\
        <option value="archive">archive</option>\
        <option value="arrow-circle-down">arrow-circle-down</option>\
        <option value="arrow-circle-left">arrow-circle-left</option>\
        <option value="arrow-circle-o-down">arrow-circle-o-down</option>\
        <option value="arrow-circle-o-left">arrow-circle-o-left</option>\
        <option value="arrow-circle-o-right">arrow-circle-o-right</option>\
        <option value="arrow-circle-o-up">arrow-circle-o-up</option>\
        <option value="arrow-circle-right">arrow-circle-right</option>\
        <option value="arrow-circle-up">arrow-circle-up</option>\
        <option value="arrow-down">arrow-down</option>\
        <option value="arrow-left">arrow-left</option>\
        <option value="arrow-right">arrow-right</option>\
        <option value="arrow-up">arrow-up</option>\
        <option value="arrows">arrows</option>\
        <option value="arrows-alt">arrows-alt</option>\
        <option value="arrows-h">arrows-h</option>\
        <option value="arrows-v">arrows-v</option>\
        <option value="asterisk">asterisk</option>\
        <option value="automobile">automobile</option>\
        <option value="backward">backward</option>\
        <option value="ban">ban</option>\
        <option value="bank">bank</option>\
        <option value="bar-chart-o">bar-chart-o</option>\
        <option value="barcode">barcode</option>\
        <option value="bars">bars</option>\
        <option value="beer">beer</option>\
        <option value="behance">behance</option>\
        <option value="behance-square">behance-square</option>\
        <option value="bell">bell</option>\
        <option value="bell-o">bell-o</option>\
        <option value="bitbucket">bitbucket</option>\
        <option value="bitbucket-square">bitbucket-square</option>\
        <option value="bitcoin">bitcoin</option>\
        <option value="bold">bold</option>\
        <option value="bolt">bolt</option>\
        <option value="bomb">bomb</option>\
        <option value="book">book</option>\
        <option value="bookmark">bookmark</option>\
        <option value="bookmark-o">bookmark-o</option>\
        <option value="briefcase">briefcase</option>\
        <option value="btc">btc</option>\
        <option value="bug">bug</option>\
        <option value="building">building</option>\
        <option value="building-o">building-o</option>\
        <option value="bullhorn">bullhorn</option>\
        <option value="bullseye">bullseye</option>\
        <option value="cab">cab</option>\
        <option value="calendar">calendar</option>\
        <option value="calendar-o">calendar-o</option>\
        <option value="camera">camera</option>\
        <option value="camera-retro">camera-retro</option>\
        <option value="car">car</option>\
        <option value="caret-down">caret-down</option>\
        <option value="caret-left">caret-left</option>\
        <option value="caret-right">caret-right</option>\
        <option value="caret-square-o-down">caret-square-o-down</option>\
        <option value="caret-square-o-left">caret-square-o-left</option>\
        <option value="caret-square-o-right">caret-square-o-right</option>\
        <option value="caret-square-o-up">caret-square-o-up</option>\
        <option value="caret-up">caret-up</option>\
        <option value="certificate">certificate</option>\
        <option value="chain">chain</option>\
        <option value="chain-broken">chain-broken</option>\
        <option value="check">check</option>\
        <option value="check-circle">check-circle</option>\
        <option value="check-circle-o">check-circle-o</option>\
        <option value="check-square">check-square</option>\
        <option value="check-square-o">check-square-o</option>\
        <option value="chevron-circle-down">chevron-circle-down</option>\
        <option value="chevron-circle-left">chevron-circle-left</option>\
        <option value="chevron-circle-right">chevron-circle-right</option>\
        <option value="chevron-circle-up">chevron-circle-up</option>\
        <option value="chevron-down">chevron-down</option>\
        <option value="chevron-left">chevron-left</option>\
        <option value="chevron-right">chevron-right</option>\
        <option value="chevron-up">chevron-up</option>\
        <option value="child">child</option>\
        <option value="circle">circle</option>\
        <option value="circle-o">circle-o</option>\
        <option value="circle-o-notch">circle-o-notch</option>\
        <option value="circle-thin">circle-thin</option>\
        <option value="clipboard">clipboard</option>\
        <option value="clock-o">clock-o</option>\
        <option value="cloud">cloud</option>\
        <option value="cloud-download">cloud-download</option>\
        <option value="cloud-upload">cloud-upload</option>\
        <option value="cny">cny</option>\
        <option value="code">code</option>\
        <option value="code-fork">code-fork</option>\
        <option value="codepen">codepen</option>\
        <option value="coffee">coffee</option>\
        <option value="cog">cog</option>\
        <option value="cogs">cogs</option>\
        <option value="columns">columns</option>\
        <option value="comment">comment</option>\
        <option value="comment-o">comment-o</option>\
        <option value="comments">comments</option>\
        <option value="comments-o">comments-o</option>\
        <option value="compass">compass</option>\
        <option value="compress">compress</option>\
        <option value="copy">copy</option>\
        <option value="credit-card">credit-card</option>\
        <option value="crop">crop</option>\
        <option value="crosshairs">crosshairs</option>\
        <option value="css3">css3</option>\
        <option value="cube">cube</option>\
        <option value="cubes">cubes</option>\
        <option value="cut">cut</option>\
        <option value="cutlery">cutlery</option>\
        <option value="dashboard">dashboard</option>\
        <option value="database">database</option>\
        <option value="dedent">dedent</option>\
        <option value="delicious">delicious</option>\
        <option value="desktop">desktop</option>\
        <option value="deviantart">deviantart</option>\
        <option value="digg">digg</option>\
        <option value="dollar">dollar</option>\
        <option value="dot-circle-o">dot-circle-o</option>\
        <option value="download">download</option>\
        <option value="dribbble">dribbble</option>\
        <option value="dropbox">dropbox</option>\
        <option value="drupal">drupal</option>\
        <option value="edit">edit</option>\
        <option value="eject">eject</option>\
        <option value="ellipsis-h">ellipsis-h</option>\
        <option value="ellipsis-v">ellipsis-v</option>\
        <option value="empire">empire</option>\
        <option value="envelope">envelope</option>\
        <option value="envelope-o">envelope-o</option>\
        <option value="envelope-square">envelope-square</option>\
        <option value="eraser">eraser</option>\
        <option value="eur">eur</option>\
        <option value="euro">euro</option>\
        <option value="exchange">exchange</option>\
        <option value="exclamation">exclamation</option>\
        <option value="exclamation-circle">exclamation-circle</option>\
        <option value="exclamation-triangle">exclamation-triangle</option>\
        <option value="expand">expand</option>\
        <option value="external-link">external-link</option>\
        <option value="external-link-square">external-link-square</option>\
        <option value="eye">eye</option>\
        <option value="eye-slash">eye-slash</option>\
        <option value="facebook">facebook</option>\
        <option value="facebook-square">facebook-square</option>\
        <option value="fast-backward">fast-backward</option>\
        <option value="fast-forward">fast-forward</option>\
        <option value="fax">fax</option>\
        <option value="female">female</option>\
        <option value="fighter-jet">fighter-jet</option>\
        <option value="file">file</option>\
        <option value="file-archive-o">file-archive-o</option>\
        <option value="file-audio-o">file-audio-o</option>\
        <option value="file-code-o">file-code-o</option>\
        <option value="file-excel-o">file-excel-o</option>\
        <option value="file-image-o">file-image-o</option>\
        <option value="file-movie-o">file-movie-o</option>\
        <option value="file-o">file-o</option>\
        <option value="file-pdf-o">file-pdf-o</option>\
        <option value="file-photo-o">file-photo-o</option>\
        <option value="file-picture-o">file-picture-o</option>\
        <option value="file-powerpoint-o">file-powerpoint-o</option>\
        <option value="file-sound-o">file-sound-o</option>\
        <option value="file-text">file-text</option>\
        <option value="file-text-o">file-text-o</option>\
        <option value="file-video-o">file-video-o</option>\
        <option value="file-word-o">file-word-o</option>\
        <option value="file-zip-o">file-zip-o</option>\
        <option value="files-o">files-o</option>\
        <option value="film">film</option>\
        <option value="filter">filter</option>\
        <option value="fire">fire</option>\
        <option value="fire-extinguisher">fire-extinguisher</option>\
        <option value="flag">flag</option>\
        <option value="flag-checkered">flag-checkered</option>\
        <option value="flag-o">flag-o</option>\
        <option value="flash">flash</option>\
        <option value="flask">flask</option>\
        <option value="flickr">flickr</option>\
        <option value="floppy-o">floppy-o</option>\
        <option value="folder">folder</option>\
        <option value="folder-o">folder-o</option>\
        <option value="folder-open">folder-open</option>\
        <option value="folder-open-o">folder-open-o</option>\
        <option value="font">font</option>\
        <option value="forward">forward</option>\
        <option value="foursquare">foursquare</option>\
        <option value="frown-o">frown-o</option>\
        <option value="gamepad">gamepad</option>\
        <option value="gavel">gavel</option>\
        <option value="gbp">gbp</option>\
        <option value="ge">ge</option>\
        <option value="gear">gear</option>\
        <option value="gears">gears</option>\
        <option value="gift">gift</option>\
        <option value="git">git</option>\
        <option value="git-square">git-square</option>\
        <option value="github">github</option>\
        <option value="github-alt">github-alt</option>\
        <option value="github-square">github-square</option>\
        <option value="gittip">gittip</option>\
        <option value="glass">glass</option>\
        <option value="globe">globe</option>\
        <option value="google">google</option>\
        <option value="google-plus">google-plus</option>\
        <option value="google-plus-square">google-plus-square</option>\
        <option value="graduation-cap">graduation-cap</option>\
        <option value="group">group</option>\
        <option value="h-square">h-square</option>\
        <option value="hacker-news">hacker-news</option>\
        <option value="hand-o-down">hand-o-down</option>\
        <option value="hand-o-left">hand-o-left</option>\
        <option value="hand-o-right">hand-o-right</option>\
        <option value="hand-o-up">hand-o-up</option>\
        <option value="hdd-o">hdd-o</option>\
        <option value="header">header</option>\
        <option value="headphones">headphones</option>\
        <option value="heart">heart</option>\
        <option value="heart-o">heart-o</option>\
        <option value="history">history</option>\
        <option value="home">home</option>\
        <option value="hospital-o">hospital-o</option>\
        <option value="html5">html5</option>\
        <option value="image">image</option>\
        <option value="inbox">inbox</option>\
        <option value="indent">indent</option>\
        <option value="info">info</option>\
        <option value="info-circle">info-circle</option>\
        <option value="inr">inr</option>\
        <option value="instagram">instagram</option>\
        <option value="institution">institution</option>\
        <option value="italic">italic</option>\
        <option value="joomla">joomla</option>\
        <option value="jpy">jpy</option>\
        <option value="jsfiddle">jsfiddle</option>\
        <option value="key">key</option>\
        <option value="keyboard-o">keyboard-o</option>\
        <option value="krw">krw</option>\
        <option value="language">language</option>\
        <option value="laptop">laptop</option>\
        <option value="leaf">leaf</option>\
        <option value="legal">legal</option>\
        <option value="lemon-o">lemon-o</option>\
        <option value="level-down">level-down</option>\
        <option value="level-up">level-up</option>\
        <option value="life-bouy">life-bouy</option>\
        <option value="life-ring">life-ring</option>\
        <option value="life-saver">life-saver</option>\
        <option value="lightbulb-o">lightbulb-o</option>\
        <option value="link">link</option>\
        <option value="linkedin">linkedin</option>\
        <option value="linkedin-square">linkedin-square</option>\
        <option value="linux">linux</option>\
        <option value="list">list</option>\
        <option value="list-alt">list-alt</option>\
        <option value="list-ol">list-ol</option>\
        <option value="list-ul">list-ul</option>\
        <option value="location-arrow">location-arrow</option>\
        <option value="lock">lock</option>\
        <option value="long-arrow-down">long-arrow-down</option>\
        <option value="long-arrow-left">long-arrow-left</option>\
        <option value="long-arrow-right">long-arrow-right</option>\
        <option value="long-arrow-up">long-arrow-up</option>\
        <option value="magic">magic</option>\
        <option value="magnet">magnet</option>\
        <option value="mail-forward">mail-forward</option>\
        <option value="mail-reply">mail-reply</option>\
        <option value="mail-reply-all">mail-reply-all</option>\
        <option value="male">male</option>\
        <option value="map-marker">map-marker</option>\
        <option value="maxcdn">maxcdn</option>\
        <option value="medkit">medkit</option>\
        <option value="meh-o">meh-o</option>\
        <option value="microphone">microphone</option>\
        <option value="microphone-slash">microphone-slash</option>\
        <option value="minus">minus</option>\
        <option value="minus-circle">minus-circle</option>\
        <option value="minus-square">minus-square</option>\
        <option value="minus-square-o">minus-square-o</option>\
        <option value="mobile">mobile</option>\
        <option value="mobile-phone">mobile-phone</option>\
        <option value="money">money</option>\
        <option value="moon-o">moon-o</option>\
        <option value="mortar-board">mortar-board</option>\
        <option value="music">music</option>\
        <option value="navicon">navicon</option>\
        <option value="openid">openid</option>\
        <option value="outdent">outdent</option>\
        <option value="pagelines">pagelines</option>\
        <option value="paper-plane">paper-plane</option>\
        <option value="paper-plane-o">paper-plane-o</option>\
        <option value="paperclip">paperclip</option>\
        <option value="paragraph">paragraph</option>\
        <option value="paste">paste</option>\
        <option value="pause">pause</option>\
        <option value="paw">paw</option>\
        <option value="pencil">pencil</option>\
        <option value="pencil-square">pencil-square</option>\
        <option value="pencil-square-o">pencil-square-o</option>\
        <option value="phone">phone</option>\
        <option value="phone-square">phone-square</option>\
        <option value="photo">photo</option>\
        <option value="picture-o">picture-o</option>\
        <option value="pied-piper">pied-piper</option>\
        <option value="pied-piper-alt">pied-piper-alt</option>\
        <option value="pied-piper-square">pied-piper-square</option>\
        <option value="pinterest">pinterest</option>\
        <option value="pinterest-square">pinterest-square</option>\
        <option value="plane">plane</option>\
        <option value="play">play</option>\
        <option value="play-circle">play-circle</option>\
        <option value="play-circle-o">play-circle-o</option>\
        <option value="plus">plus</option>\
        <option value="plus-circle">plus-circle</option>\
        <option value="plus-square">plus-square</option>\
        <option value="plus-square-o">plus-square-o</option>\
        <option value="power-off">power-off</option>\
        <option value="print">print</option>\
        <option value="puzzle-piece">puzzle-piece</option>\
        <option value="qq">qq</option>\
        <option value="qrcode">qrcode</option>\
        <option value="question">question</option>\
        <option value="question-circle">question-circle</option>\
        <option value="quote-left">quote-left</option>\
        <option value="quote-right">quote-right</option>\
        <option value="ra">ra</option>\
        <option value="random">random</option>\
        <option value="rebel">rebel</option>\
        <option value="recycle">recycle</option>\
        <option value="reddit">reddit</option>\
        <option value="reddit-square">reddit-square</option>\
        <option value="refresh">refresh</option>\
        <option value="renren">renren</option>\
        <option value="reorder">reorder</option>\
        <option value="repeat">repeat</option>\
        <option value="reply">reply</option>\
        <option value="reply-all">reply-all</option>\
        <option value="retweet">retweet</option>\
        <option value="rmb">rmb</option>\
        <option value="road">road</option>\
        <option value="rocket">rocket</option>\
        <option value="rotate-left">rotate-left</option>\
        <option value="rotate-right">rotate-right</option>\
        <option value="rouble">rouble</option>\
        <option value="rss">rss</option>\
        <option value="rss-square">rss-square</option>\
        <option value="rub">rub</option>\
        <option value="ruble">ruble</option>\
        <option value="rupee">rupee</option>\
        <option value="save">save</option>\
        <option value="scissors">scissors</option>\
        <option value="search">search</option>\
        <option value="search-minus">search-minus</option>\
        <option value="search-plus">search-plus</option>\
        <option value="send">send</option>\
        <option value="send-o">send-o</option>\
        <option value="share">share</option>\
        <option value="share-alt">share-alt</option>\
        <option value="share-alt-square">share-alt-square</option>\
        <option value="share-square">share-square</option>\
        <option value="share-square-o">share-square-o</option>\
        <option value="shield">shield</option>\
        <option value="shopping-cart">shopping-cart</option>\
        <option value="sign-in">sign-in</option>\
        <option value="sign-out">sign-out</option>\
        <option value="signal">signal</option>\
        <option value="sitemap">sitemap</option>\
        <option value="skype">skype</option>\
        <option value="slack">slack</option>\
        <option value="sliders">sliders</option>\
        <option value="smile-o">smile-o</option>\
        <option value="sort">sort</option>\
        <option value="sort-alpha-asc">sort-alpha-asc</option>\
        <option value="sort-alpha-desc">sort-alpha-desc</option>\
        <option value="sort-amount-asc">sort-amount-asc</option>\
        <option value="sort-amount-desc">sort-amount-desc</option>\
        <option value="sort-asc">sort-asc</option>\
        <option value="sort-desc">sort-desc</option>\
        <option value="sort-down">sort-down</option>\
        <option value="sort-numeric-asc">sort-numeric-asc</option>\
        <option value="sort-numeric-desc">sort-numeric-desc</option>\
        <option value="sort-up">sort-up</option>\
        <option value="soundcloud">soundcloud</option>\
        <option value="space-shuttle">space-shuttle</option>\
        <option value="spinner">spinner</option>\
        <option value="spoon">spoon</option>\
        <option value="spotify">spotify</option>\
        <option value="square">square</option>\
        <option value="square-o">square-o</option>\
        <option value="stack-exchange">stack-exchange</option>\
        <option value="stack-overflow">stack-overflow</option>\
        <option value="star">star</option>\
        <option value="star-half">star-half</option>\
        <option value="star-half-empty">star-half-empty</option>\
        <option value="star-half-full">star-half-full</option>\
        <option value="star-half-o">star-half-o</option>\
        <option value="star-o">star-o</option>\
        <option value="steam">steam</option>\
        <option value="steam-square">steam-square</option>\
        <option value="step-backward">step-backward</option>\
        <option value="step-forward">step-forward</option>\
        <option value="stethoscope">stethoscope</option>\
        <option value="stop">stop</option>\
        <option value="strikethrough">strikethrough</option>\
        <option value="stumbleupon">stumbleupon</option>\
        <option value="stumbleupon-circle">stumbleupon-circle</option>\
        <option value="subscript">subscript</option>\
        <option value="suitcase">suitcase</option>\
        <option value="sun-o">sun-o</option>\
        <option value="superscript">superscript</option>\
        <option value="support">support</option>\
        <option value="table">table</option>\
        <option value="tablet">tablet</option>\
        <option value="tachometer">tachometer</option>\
        <option value="tag">tag</option>\
        <option value="tags">tags</option>\
        <option value="tasks">tasks</option>\
        <option value="taxi">taxi</option>\
        <option value="tencent-weibo">tencent-weibo</option>\
        <option value="terminal">terminal</option>\
        <option value="text-height">text-height</option>\
        <option value="text-width">text-width</option>\
        <option value="th">th</option>\
        <option value="th-large">th-large</option>\
        <option value="th-list">th-list</option>\
        <option value="thumb-tack">thumb-tack</option>\
        <option value="thumbs-down">thumbs-down</option>\
        <option value="thumbs-o-down">thumbs-o-down</option>\
        <option value="thumbs-o-up">thumbs-o-up</option>\
        <option value="thumbs-up">thumbs-up</option>\
        <option value="ticket">ticket</option>\
        <option value="times">times</option>\
        <option value="times-circle">times-circle</option>\
        <option value="times-circle-o">times-circle-o</option>\
        <option value="tint">tint</option>\
        <option value="toggle-down">toggle-down</option>\
        <option value="toggle-left">toggle-left</option>\
        <option value="toggle-right">toggle-right</option>\
        <option value="toggle-up">toggle-up</option>\
        <option value="trash-o">trash-o</option>\
        <option value="tree">tree</option>\
        <option value="trello">trello</option>\
        <option value="trophy">trophy</option>\
        <option value="truck">truck</option>\
        <option value="try">try</option>\
        <option value="tumblr">tumblr</option>\
        <option value="tumblr-square">tumblr-square</option>\
        <option value="turkish-lira">turkish-lira</option>\
        <option value="twitter">twitter</option>\
        <option value="twitter-square">twitter-square</option>\
        <option value="umbrella">umbrella</option>\
        <option value="underline">underline</option>\
        <option value="undo">undo</option>\
        <option value="university">university</option>\
        <option value="unlink">unlink</option>\
        <option value="unlock">unlock</option>\
        <option value="unlock-alt">unlock-alt</option>\
        <option value="unsorted">unsorted</option>\
        <option value="unsorted">unsorted</option>\
        <option value="usd">usd</option>\
        <option value="user">user</option>\
        <option value="user-md">user-md</option>\
        <option value="users">users</option>\
        <option value="video-camera">video-camera</option>\
        <option value="vimeo-square">vimeo-square</option>\
        <option value="vine">vine</option>\
        <option value="vk">vk</option>\
        <option value="volume-down">volume-down</option>\
        <option value="volume-off">volume-off</option>\
        <option value="volume-up">volume-up</option>\
        <option value="warning">warning</option>\
        <option value="wechat">wechat</option>\
        <option value="weibo">weibo</option>\
        <option value="weixin">weixin</option>\
        <option value="wheelchair">wheelchair</option>\
        <option value="windows">windows</option>\
        <option value="won">won</option>\
        <option value="wordpress">wordpress</option>\
        <option value="wrench">wrench</option>\
        <option value="xing">xing</option>\
        <option value="xing-square">xing-square</option>\
        <option value="yahoo">yahoo</option>\
        <option value="yen">yen</option>\
        <option value="youtube">youtube</option>\
        <option value="youtube-play">youtube-play</option>\
        <option value="youtube-square">youtube-square</option>';

    return html;
}

// @koala-append "animate.js"
// @koala-append "background.js"
// @koala-append "block.js"
// @koala-append "brands.js"
// @koala-append "container.js"
// @koala-append "counter.js"
// @koala-append "faq.js"
// @koala-append "feature_box.js"
// @koala-append "fontawesome.js"
// @koala-append "google-map.js"
// @koala-append "person.js"
// @koala-append "pre.js"
// @koala-append "products.js"
// @koala-append "quote.js"
// @koala-append "slider.js"
// @koala-append "testimonial.js"
// @koala-append "content_box.js"
// @koala-append "title.js"
// @koala-append "recent_posts.js"
// @koala-append "recent_portfolios.js"
// @koala-append "grid.js"
// @koala-append "posts.js"