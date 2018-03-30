

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


jQuery(function($) {

    var form = jQuery('<div id="animate-form"><table id="animate-table" class="form-table">\
			<tr>\
				<th><label for="animate-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="animate-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="animate-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="animate-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="animate-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="animate-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="animate-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="animate-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="animate-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#animate-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[animate';

        for( var index in options) {
            var value = table.find('#animate-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/animate]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="background-form"><table id="background-table" class="form-table">\
			<tr>\
				<th><label for="background-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="background-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="background-image">Image URL *</label></th>\
				<td><input type="text" name="image" id="background-image" value="" />\
				<br/><small>ex: //example.com/image.png</small></td>\
			</tr>\
            <tr>\
				<th><label for="background-color">Text Color</label></th>\
				<td><input type="text" name="color" id="background-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="background-link_color">Link Color</label></th>\
				<td><input type="text" name="link_color" id="background-link_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="background-padding">Padding</label></th>\
				<td><input type="text" name="padding" id="background-padding" value="30px 30px 30px 30px" /></td>\
			</tr>\
			<tr>\
				<th><label for="background-parallax">Parallax</label></th>\
				<td><input type="text" name="parallax" id="background-parallax" value="0" />\
				<br/><small>numerical value</small></td>\
			</tr>\
			<tr>\
				<th><label for="background-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="background-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="background-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="background-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="background-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="background-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="background-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="background-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="background-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#background-submit').click(function(){

        var options = {
            'bg_color'           : '',
            'image'              : '',
            'color'              : '',
            'link_color'         : '',
            'padding'            : '0 0 0 0',
            'parallax'           : '0',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[background';

        for( var index in options) {
            var value = table.find('#background-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/background]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="block-form"><table id="block-table" class="form-table">\
            <tr>\
				<th colspan="2"><strong>Input block id or name.</strong></th>\
			</tr>\
			<tr>\
				<th><label for="block-id">Block ID *</label></th>\
				<td><input type="text" name="id" id="block-id" value="" />\
				<br/><small>numerical value</small></td>\
			</tr>\
			<tr>\
				<th><label for="block-name">Block Name *</label></th>\
				<td><input type="text" name="name" id="block-name" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="block-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="block-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="block-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="block-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="block-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="block-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="block-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="block-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="block-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#block-submit').click(function(){

        var options = {
            'id'                 : '',
            'name'               : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[block';

        for( var index in options) {
            var value = table.find('#block-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="brands-form"><table id="brands-table" class="form-table">\
			<tr>\
				<th><label for="brands-title">Title</label></th>\
				<td><input type="text" name="title" id="brands-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="brands-single_item">Single Item</label></th>\
				<td><select name="single_item" id="brands-single_item">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th colspan="2"><strong>if single item => false</strong></th>\
			</tr>\
			<tr>\
				<th><label for="brands-items">Items</label></th>\
				<td><input type="text" name="items" id="brands-items" value="6" />\
				<br/><small>window width >= 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-items_desktop">Items on Desktop</label></th>\
				<td><input type="text" name="items_desktop" id="brands-items_desktop" value="4" />\
				<br/><small>992px <= window width < 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-items_desktop_small">Items on Small Desktop</label></th>\
				<td><input type="text" name="items_desktop_small" id="brands-items_desktop_small" value="3" />\
				<br/><small>768px <= window width < 992px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-items_tablet">Items on Tablet</label></th>\
				<td><input type="text" name="items_tablet" id="brands-items_tablet" value="2" />\
				<br/><small>480px <= window width < 768px</small></td>\
			</tr>\
            <tr>\
				<th>Items on Microphone</th>\
				<td><strong>1</strong>\
				<br/><small>window width < 480px</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="brands-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="brands-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="brands-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="brands-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="brands-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="brands-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="brands-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="brands-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="brands-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="brands-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#brands-submit').click(function(){

        var options = {
            'title'              : '',
            'single_item'        : 'false',
            'items'              : '6',
            'items_desktop'      : '4',
            'items_desktop_small': '3',
            'items_tablet'       : '2',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[brands';

        for( var index in options) {
            var value = table.find('#brands-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Brand Shortcodes[/brands]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="brand-form"><table id="brand-table" class="form-table">\
			<tr>\
				<th><label for="brand-image">Image URL *</label></th>\
				<td><input type="text" name="image" id="brand-image" value="" />\
				<br/><small>ex: //example.com/image.png</small></td>\
			</tr>\
            <tr>\
				<th><label for="brand-title">Title</label></th>\
				<td><input type="text" name="title" id="brand-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="brand-link">Link URL</label></th>\
				<td><input type="text" name="link" id="brand-link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="brand-target">Link Target</label></th>\
				<td><select name="target" id="brand-target">\
                ' + venedor_shortcode_target() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="brand-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="brand-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="brand-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="brand-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="brand-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="brand-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="brand-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="brand-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="brand-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#brand-submit').click(function(){

        var options = {
            'title'              : '',
            'image'              : '',
            'link'               : '',
            'target'             : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[brand';

        for( var index in options) {
            var value = table.find('#brand-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="container-form"><table id="container-table" class="form-table">\
			<tr>\
				<th><label for="container-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="container-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="container-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="container-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="container-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="container-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="container-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="container-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="container-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#container-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[container';

        for( var index in options) {
            var value = table.find('#container-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/container]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="counter_circle-form"><table id="counter_circle-table" class="form-table">\
			<tr>\
				<th><label for="counter_circle-filledcolor">Filled Color</label></th>\
				<td><input type="text" name="filledcolor" id="counter_circle-filledcolor" value="" />\
				<br/><small>default: button hover background color</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-unfilledcolor">Unfilled Color</label></th>\
				<td><input type="text" name="unfilledcolor" id="counter_circle-unfilledcolor" value="" />\
				<br/><small>default: block background color</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-size">Circle Size *</label></th>\
				<td><input type="text" name="size" id="counter_circle-size" value="220" />\
				<br/><small>numerical value (unit: pixels)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-speed">Animation Speed *</label></th>\
				<td><input type="text" name="speed" id="counter_circle-speed" value="1000" />\
				<br/><small>numerical value (unit: miliseconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-strokesize">Stroke Size *</label></th>\
				<td><input type="text" name="strokesize" id="counter_circle-strokesize" value="11" />\
				<br/><small>numerical value (unit: pixels)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-percent">Filled Percent *</label></th>\
				<td><input type="text" name="percent" id="counter_circle-percent" value="100" />\
				<br/><small>numerical value (min: 0, max: 100)</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc">Description</label></th>\
				<td><textarea name="desc" id="counter_circle-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc_link">Description Link</label></th>\
				<td><input type="text" name="desc_link" id="counter_circle-desc_link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc_fontsize">Description Font Size</label></th>\
				<td><input type="text" name="desc_fontsize" id="counter_circle-desc_fontsize" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-desc_color">Description Color</label></th>\
				<td><input type="text" name="desc_color" id="counter_circle-desc_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_circle-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="counter_circle-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="counter_circle-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#counter_circle-submit').click(function(){

        var options = {
            'filledcolor'        : '',
            'unfilledcolor'      : '',
            'size'               : '220',
            'speed'              : '1000',
            'strokesize'         : '11',
            'percent'            : '100',
            'desc'               : '',
            'desc_link'          : '',
            'desc_fontsize'      : '',
            'desc_color'         : '',
            'class'              : ''
        };

        var shortcode = '[counter_circle';

        for( var index in options) {
            var value = table.find('#counter_circle-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Circle Content[/counter_circle]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="counter_box-form"><table id="counter_box-table" class="form-table">\
			<tr>\
				<th><label for="counter_box-value">Counter Value *</label></th>\
				<td><input type="text" name="value" id="counter_box-value" value="1000" />\
				<br/><small>numerical value</small></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-unit">Counter Unit</label></th>\
				<td><input type="text" name="unit" id="counter_box-unit" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-color">Counter Color</label></th>\
				<td><input type="text" name="color" id="counter_box-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-link">Link URL</label></th>\
				<td><input type="text" name="link" id="counter_box-link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="counter_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="counter_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="counter_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#counter_box-submit').click(function(){

        var options = {
            'value' : '1000',
            'unit' : '',
            'color' : '',
            'link' : '',
            'class' : ''
        };

        var shortcode = '[counter_box';

        for( var index in options) {
            var value = table.find('#counter_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/counter_box]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="faq-form"><table id="faq-table" class="form-table">\
			<tr>\
				<th><label for="faq-cats">FAQ Category IDs</label></th>\
				<td><input type="text" name="cats" id="faq-cats" value="0" />\
				<br/><small>Comma separated list of faq category ids.</small></td>\
			</tr>\
			<tr>\
				<th><label for="faq-filter">Show Filter</label></th>\
                <td><select name="filter" id="faq-filter">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="faq-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="faq-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="faq-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="faq-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="faq-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="faq-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="faq-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="faq-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="faq-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#faq-submit').click(function(){

        var options = {
            'cats'               : '0',
            'filter'             : 'false',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[faq';

        for( var index in options) {
            var value = table.find('#faq-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="feature_box_slider-form"><table id="feature_box_slider-table" class="form-table">\
			<tr>\
				<th><label for="feature_box_slider-title">Title</label></th>\
				<td><input type="text" name="title" id="feature_box_slider-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box_slider-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="feature_box_slider-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="feature_box_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="feature_box_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="feature_box_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="feature_box_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="feature_box_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="feature_box_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#feature_box_slider-submit').click(function(){

        var options = {
            'title'              : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[feature_box_slider';

        for( var index in options) {
            var value = table.find('#feature_box_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Feature Box Shortcodes[/feature_box_slider]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="feature_box-form"><table id="feature_box-table" class="form-table">\
			<tr>\
				<th><label for="feature_box-color">Text Color</label></th>\
				<td><input type="text" name="color" id="feature_box-color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-hcolor">Text Hover Color</label></th>\
				<td><input type="text" name="hcolor" id="feature_box-hcolor" value="" /></td>\
			</tr>\
			<tr>\
				<th colspan="2"><strong>Configure with image or icon options.</strong></th>\
			</tr>\
			<tr>\
				<th><label for="feature_box-size">Image or Icon Wrapper Size</label></th>\
				<td><input type="text" name="size" id="feature_box-size" value="124" />\
				<br/><small>numerical value</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-type">Image or Icon Wrapper Type</label></th>\
				<td><select name="type" id="feature_box-type">\
                ' + venedor_shortcode_wrapper_type() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-image">Image URL</label></th>\
				<td><input type="text" name="image" id="feature_box-image" value="" />\
				<br/><small>ex: //example.com/image.png</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-image_bordercolor">Image Border Color</label></th>\
				<td><input type="text" name="image_bordercolor" id="feature_box-image_bordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-image_hbordercolor">Image Hover Border Color</label></th>\
				<td><input type="text" name="image_hbordercolor" id="feature_box-image_hbordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon">FontAwesome Icon Name</label></th>\
				<td><select name="icon" id="feature_box-icon">\
                ' + venedor_shortcode_fontawesome_icon() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_bg">Icon Background Color</label></th>\
				<td><input type="text" name="icon_bg" id="feature_box-icon_bg" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_hbg">Icon Hover Background Color</label></th>\
				<td><input type="text" name="icon_hbg" id="feature_box-icon_hbg" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_color">Icon Color</label></th>\
				<td><input type="text" name="icon_color" id="feature_box-icon_color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_hcolor">Icon Hover Color</label></th>\
				<td><input type="text" name="icon_hcolor" id="feature_box-icon_hcolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_bordercolor">Icon Border Color</label></th>\
				<td><input type="text" name="icon_bordercolor" id="feature_box-icon_bordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-icon_hbordercolor">Icon Hover Border Color</label></th>\
				<td><input type="text" name="icon_hbordercolor" id="feature_box-icon_hbordercolor" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-title">Title</label></th>\
				<td><input type="text" name="title" id="feature_box-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-link">Link</label></th>\
				<td><input type="text" name="link" id="feature_box-link" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-align">Align</label></th>\
				<td><select name="align" id="feature_box-align">\
                ' + venedor_shortcode_align_center() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="feature_box-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-hbg_color">Hover Background Color</label></th>\
				<td><input type="text" name="hbg_color" id="feature_box-hbg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-line_color">Line Color</label></th>\
				<td><input type="text" name="line_color" id="feature_box-line_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-line_hcolor">Line Hover Color</label></th>\
				<td><input type="text" name="line_hcolor" id="feature_box-line_hcolor" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-border">Hover Effect, Show Image or Icon Wrapper</label></th>\
				<td><select name="border" id="feature_box-border">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-show_bg">Show Background</label></th>\
				<td><select name="show_bg" id="feature_box-show_bg">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="feature_box-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="feature_box-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="feature_box-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="feature_box-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="feature_box-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="feature_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="feature_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="feature_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#feature_box-submit').click(function(){

        var options = {
            'color'              : '',
            'hcolor'             : '',
            'size'               : '124',
            'type'               : 'circle',
            'image'              : '',
            'image_bordercolor'  : '',
            'image_hbordercolor' : '',
            'icon'               : '',
            'icon_bg'            : '',
            'icon_hbg'           : '',
            'icon_color'         : '',
            'icon_hcolor'        : '',
            'icon_bordercolor'   : '',
            'icon_hbordercolor'  : '',
            'title'              : '',
            'link'               : '',
            'align'              : 'center',
            'bg_color'           : '',
            'hbg_color'          : '',
            'line_color'         : '',
            'line_hcolor'        : '',
            'border'             : 'true',
            'show_bg'            : 'false',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[feature_box';

        for( var index in options) {
            var value = table.find('#feature_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/feature_box]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="fontawesome-form"><table id="fontawesome-table" class="form-table">\
			<tr>\
				<th><label for="fontawesome-icon">Icon Name *</label></th>\
				<td><select name="icon" id="fontawesome-icon">\
                ' + venedor_shortcode_fontawesome_icon() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-size">Icon Size</label></th>\
                <td><select name="size" id="fontawesome-size">\
                ' + venedor_shortcode_fontawesome_size() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="fontawesome-fontsize">Icon Font Size</label></th>\
				<td><input type="text" name="fontsize" id="fontawesome-fontsize" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-color">Icon Color</label></th>\
				<td><input type="text" name="color" id="fontawesome-color" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="fontawesome-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="fontawesome-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="fontawesome-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="fontawesome-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="fontawesome-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="fontawesome-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="fontawesome-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="fontawesome-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#fontawesome-submit').click(function(){

        var options = {
            'icon'               : '',
            'size'               : '',
            'fontsize'           : '',
            'color'              : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[fontawesome';

        for( var index in options) {
            var value = table.find('#fontawesome-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="map-form"><table id="map-table" class="form-table">\
			<tr>\
				<th><label for="map-address">Address *</label></th>\
				<td><textarea name="address" id="map-address"></textarea>\
				<br/><small>"|" separated list of google map addresses.</small></td>\
			</tr>\
            <tr>\
				<th><label for="map-type">Type</label></th>\
                <td><select name="type" id="map-type">\
                ' + venedor_shortcode_gmap_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="map-width">Width</label></th>\
				<td><input type="text" name="width" id="map-width" value="100%" /></td>\
			</tr>\
            <tr>\
				<th><label for="map-height">Height</label></th>\
				<td><input type="text" name="height" id="map-height" value="300px" /></td>\
			</tr>\
            <tr>\
				<th><label for="map-zoom">Zoom Level</label></th>\
				<td><input type="text" name="zoom" id="map-zoom" value="14" /></td>\
			</tr>\
            <tr>\
				<th><label for="map-scrollwheel">Scroll Wheel</label></th>\
				<td><select name="scrollwheel" id="map-scrollwheel">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="map-scale">Show Scale</label></th>\
				<td><select name="scale" id="map-scale">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="map-zoom_pancontrol">Show Zoom Pan Control</label></th>\
				<td><select name="zoom_pancontrol" id="map-zoom_pancontrol">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="map-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="map-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="map-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="map-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="map-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="map-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="map-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="map-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="map-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#map-submit').click(function(){

        var options = {
            'address'            : '',
            'type'               : 'roadmap',
            'width'              : '100%',
            'height'             : '300px',
            'zoom'               : '14',
            'scrollwheel'        : 'true',
            'scale'              : 'true',
            'zoom_pancontrol'    : 'true',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[map';

        for( var index in options) {
            var value = table.find('#map-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="persons-form"><table id="persons-table" class="form-table">\
			<tr>\
				<th><label for="persons-title">Title</label></th>\
				<td><input type="text" name="title" id="persons-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="persons-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="persons-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="persons-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="persons-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="persons-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="persons-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="persons-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="persons-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="persons-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="persons-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#persons-submit').click(function(){

        var options = {
            'title'              : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[persons';

        for( var index in options) {
            var value = table.find('#persons-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Person Shortcodes[/persons]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="person-form"><table id="person-table" class="form-table">\
			<tr>\
				<th><label for="person-name">Name *</label></th>\
				<td><input type="text" name="name" id="person-name" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="person-photo" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-role">Role *</label></th>\
				<td><input type="text" name="role" id="person-role" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-facebook">Facebook</label></th>\
				<td><input type="text" name="facebook" id="person-facebook" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-twitter">Twitter</label></th>\
				<td><input type="text" name="twitter" id="person-twitter" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-dribbble">Dribbble</label></th>\
				<td><input type="text" name="dribbble" id="person-dribbble" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-pinterest">Pinterest</label></th>\
				<td><input type="text" name="pinterest" id="person-pinterest" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-instagram">Instagram</label></th>\
				<td><input type="text" name="instagram" id="person-instagram" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-linkedin">Linkedin</label></th>\
				<td><input type="text" name="linkedin" id="person-linkedin" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-tumblr">Tumblr</label></th>\
				<td><input type="text" name="tumblr" id="person-tumblr" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-youtube">Youtube</label></th>\
				<td><input type="text" name="youtube" id="person-youtube" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-email">Email</label></th>\
				<td><input type="text" name="email" id="person-email" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-phone">Phone</label></th>\
				<td><input type="text" name="phone" id="person-phone" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="person-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="person-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="person-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="person-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="person-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="person-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="person-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="person-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#person-submit').click(function(){

        var options = {
            'name'               : '',
            'photo'              : '',
            'role'               : '',
            'facebook'           : '',
            'twitter'            : '',
            'dribbble'           : '',
            'pinterest'          : '',
            'instagram'          : '',
            'linkedin'           : '',
            'tumblr'             : '',
            'youtube'            : '',
            'email'              : '',
            'phone'              : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[person';

        for( var index in options) {
            var value = table.find('#person-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/person]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="person_boxs-form"><table id="person_boxs-table" class="form-table">\
			<tr>\
				<th><label for="person_boxs-title">Title</label></th>\
				<td><input type="text" name="title" id="person_boxs-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="person_boxs-cols">Columns</label></th>\
				<td><input type="text" name="cols" id="person_boxs-cols" value="4" /></td>\
			</tr>\
			<tr>\
				<th><label for="person_boxs-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="person_boxs-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="person_boxs-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="person_boxs-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="person_boxs-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="person_boxs-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="person_boxs-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="person_boxs-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="person_boxs-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#person_boxs-submit').click(function(){

        var options = {
            'title'              : '',
            'cols'               : '4',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[person_boxs';

        for( var index in options) {
            var value = table.find('#person_boxs-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Person Box Shortcodes[/person_boxs]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="person_box-form"><table id="person_box-table" class="form-table">\
			<tr>\
				<th><label for="person_box-name">Name *</label></th>\
				<td><input type="text" name="name" id="person_box-name" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="person_box-photo" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-role">Role *</label></th>\
				<td><input type="text" name="role" id="person_box-role" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="person_box-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-hbg_color">Hover Background Color</label></th>\
				<td><input type="text" name="hbg_color" id="person_box-hbg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="person_box-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="person_box-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="person_box-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="person_box-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="person_box-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="person_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="person_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="person_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#person_box-submit').click(function(){

        var options = {
            'name'               : '',
            'photo'              : '',
            'role'               : '',
            'bg_color'           : '',
            'hbg_color'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[person_box';

        for( var index in options) {
            var value = table.find('#person_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="persons_slider-form"><table id="persons_slider-table" class="form-table">\
			<tr>\
				<th><label for="persons_slider-title">Title</label></th>\
				<td><input type="text" name="title" id="persons_slider-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slider-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="persons_slider-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="persons_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="persons_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="persons_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="persons_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="persons_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="persons_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="persons_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#persons_slider-submit').click(function(){

        var options = {
            'title'              : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[persons_slider';

        for( var index in options) {
            var value = table.find('#persons_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Persons Slide Shortcodes[/persons_slider]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="persons_slide-form"><table id="persons_slide-table" class="form-table">\
			<tr>\
				<th><label for="persons_slide-name">Name *</label></th>\
				<td><input type="text" name="name" id="persons_slide-name" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="persons_slide-photo" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-role">Role *</label></th>\
				<td><input type="text" name="role" id="persons_slide-role" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-link">Link URL</label></th>\
				<td><input type="text" name="link" id="persons_slide-link" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-target">Link Target</label></th>\
				<td><select name="target" id="persons_slide-target">\
                ' + venedor_shortcode_target() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-bg_color">Background Color</label></th>\
				<td><input type="text" name="bg_color" id="persons_slide-bg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-hbg_color">Hover Background Color</label></th>\
				<td><input type="text" name="hbg_color" id="persons_slide-hbg_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="persons_slide-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="persons_slide-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="persons_slide-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="persons_slide-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="persons_slide-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="persons_slide-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="persons_slide-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="persons_slide-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#persons_slide-submit').click(function(){

        var options = {
            'name'               : '',
            'photo'              : '',
            'role'               : '',
            'link'               : '',
            'target'             : '',
            'bg_color'           : '',
            'hbg_color'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[persons_slide';

        for( var index in options) {
            var value = table.find('#persons_slide-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="pre-form"><table id="pre-table" class="form-table">\
			<tr>\
				<th><label for="pre-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="pre-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="pre-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="pre-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="pre-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="pre-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="pre-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="pre-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="pre-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#pre-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[pre';

        for( var index in options) {
            var value = table.find('#pre-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Pre Content[/pre]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="sw_bestseller_products-form"><table id="sw_bestseller_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_bestseller_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_bestseller_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_bestseller_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_bestseller_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_bestseller_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_bestseller_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-single">Single View</label></th>\
				<td><select name="single" id="sw_bestseller_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_bestseller_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_bestseller_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_bestseller_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_bestseller_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_bestseller_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_bestseller_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_bestseller_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_bestseller_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_bestseller_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_bestseller_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_bestseller_products';

        for( var index in options) {
            var value = table.find('#sw_bestseller_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="sw_featured_products-form"><table id="sw_featured_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_featured_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_featured_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_featured_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_featured_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_featured_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_featured_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-orderby">Order By</label></th>\
				<td><select name="orderby" id="sw_featured_products-orderby">\
                ' + venedor_shortcode_orderby() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-order">Order</label></th>\
				<td><select name="order" id="sw_featured_products-order">\
                ' + venedor_shortcode_order() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-single">Single View</label></th>\
				<td><select name="single" id="sw_featured_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_featured_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_featured_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_featured_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_featured_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_featured_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_featured_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_featured_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_featured_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_featured_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_featured_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'orderby'            : 'date',
            'order'              : 'desc',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_featured_products';

        for( var index in options) {
            var value = table.find('#sw_featured_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});

jQuery(function($) {

    var form = jQuery('<div id="sw_sale_products-form"><table id="sw_sale_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_sale_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_sale_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_sale_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_sale_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_sale_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_sale_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-orderby">Order By</label></th>\
				<td><select name="orderby" id="sw_sale_products-orderby">\
                ' + venedor_shortcode_orderby() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-order">Order</label></th>\
				<td><select name="order" id="sw_sale_products-order">\
                ' + venedor_shortcode_order() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-single">Single View</label></th>\
				<td><select name="single" id="sw_sale_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_sale_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_sale_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_sale_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_sale_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_sale_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_sale_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_sale_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_sale_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_sale_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_sale_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'orderby'            : 'date',
            'order'              : 'desc',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_sale_products';

        for( var index in options) {
            var value = table.find('#sw_sale_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});

jQuery(function($) {

    var form = jQuery('<div id="sw_latest_products-form"><table id="sw_latest_products-table" class="form-table">\
			<tr>\
				<th><label for="sw_latest_products-title">Title</label></th>\
				<td><input type="text" name="title" id="sw_latest_products-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-desc">Description</label></th>\
				<td><textarea name="desc" id="sw_latest_products-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-products">Products Count</label></th>\
				<td><input type="text" name="products" id="sw_latest_products-products" value="8" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-cats">Category IDs</label></th>\
				<td><input type="text" name="cats" id="sw_latest_products-cats" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-view">View Mode</label></th>\
				<td><select name="view" id="sw_latest_products-view">\
                ' + venedor_shortcode_view_mode() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-orderby">Order By</label></th>\
				<td><select name="orderby" id="sw_latest_products-orderby">\
                ' + venedor_shortcode_orderby() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-order">Order</label></th>\
				<td><select name="order" id="sw_latest_products-order">\
                ' + venedor_shortcode_order() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-single">Single View</label></th>\
				<td><select name="single" id="sw_latest_products-single">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="sw_latest_products-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_latest_products-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_latest_products-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_latest_products-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_latest_products-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_latest_products-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_latest_products-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_latest_products-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_latest_products-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_latest_products-submit').click(function(){

        var options = {
            'title'              : '',
            "desc"               : '',
            'products'           : '8',
            'cats'               : '',
            'view'               : 'grid',
            'orderby'            : 'date',
            'order'              : 'desc',
            'single'             : 'false',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_latest_products';

        for( var index in options) {
            var value = table.find('#sw_latest_products-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});




jQuery(function($) {

    var form = jQuery('<div id="quote-form"><table id="quote-table" class="form-table">\
			<tr>\
				<th><label for="quote-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="quote-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="quote-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="quote-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="quote-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="quote-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="quote-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="quote-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="quote-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#quote-submit').click(function(){

        var options = {
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[quote';

        for( var index in options) {
            var value = table.find('#quote-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/quote]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="sw_slider-form"><table id="sw_slider-table" class="form-table">\
			<tr>\
				<th><label for="sw_slider-pagination">Pagination</label></th>\
                <td><select name="pagination" id="sw_slider-pagination">\
                ' + venedor_shortcode_boolean_false() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_slider-navigation">Navigation</label></th>\
                <td><select name="navigation" id="sw_slider-navigation">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="sw_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="sw_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="sw_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="sw_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="sw_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="sw_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_slider-submit').click(function(){

        var options = {
            'pagination'         : 'false',
            'navigation'         : 'true',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[sw_slider';

        for( var index in options) {
            var value = table.find('#sw_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert SW Slide Shortcodes[/sw_slider]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="sw_slide-form"><table id="sw_slide-table" class="form-table">\
			<tr>\
				<th><label for="sw_slide-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="sw_slide-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="sw_slide-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#sw_slide-submit').click(function(){

        var options = {
            'class'              : ''
        };

        var shortcode = '[sw_slide';

        for( var index in options) {
            var value = table.find('#sw_slide-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/sw_slide]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="testimonials-form"><table id="testimonials-table" class="form-table">\
			<tr>\
				<th><label for="testimonials-title">Title</label></th>\
				<td><input type="text" name="title" id="testimonials-title" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-type">Show Type</label></th>\
                <td><select name="type" id="testimonials-type">\
                ' + venedor_shortcode_testimonial_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="testimonials-color">Color</label></th>\
				<td><input type="text" name="color" id="testimonials-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-shadow">Shadow</label></th>\
				<td><input type="text" name="shadow" id="testimonials-shadow" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-single_item">Single Item</label></th>\
				<td><select name="single_item" id="testimonials-single_item">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th colspan="2">if single item => false</th>\
			</tr>\
            <tr>\
				<th><label for="testimonials-items">Items</label></th>\
				<td><input type="text" name="items" id="testimonials-items" value="3" />\
				<br/><small>window width >= 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-items_desktop">Items on Desktop</label></th>\
				<td><input type="text" name="items_desktop" id="testimonials-items_desktop" value="3" />\
				<br/><small>992px <= window width < 1200px</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-items_desktop_small">Items on Small Desktop</label></th>\
				<td><input type="text" name="items_desktop_small" id="testimonials-items_desktop_small" value="2" />\
				<br/><small>768px <= window width < 992px</small></td>\
			</tr>\
            <tr>\
				<th>Items on Tablet, Microphone</th>\
				<td><strong>1</strong>\
				<br/><small>window width < 768px</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="testimonials-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="testimonials-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="testimonials-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="testimonials-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="testimonials-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="testimonials-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonials-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="testimonials-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="testimonials-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#testimonials-submit').click(function(){

        var options = {
            'title'              : '',
            'type'               : 'normal',
            'color'              : '',
            'shadow'             : '',
            'single_item'        : 'true',
            'items'              : '3',
            'items_desktop'      : '3',
            'items_desktop_small': '2',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[testimonials';

        for( var index in options) {
            var value = table.find('#testimonials-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Testimonial Shortcodes[/testimonials]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="testimonial-form"><table id="testimonial-table" class="form-table">\
			<tr>\
				<th><label for="testimonial-title">Title</label></th>\
				<td><input type="text" name="title" id="testimonial-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-name">Name</label></th>\
				<td><input type="text" name="name" id="testimonial-name" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-photo">Photo URL</label></th>\
				<td><input type="text" name="photo" id="testimonial-photo" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-link">Link URL</label></th>\
				<td><input type="text" name="link" id="testimonial-link" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-target">Link Target</label></th>\
				<td><select name="target" id="testimonial-target">\
                ' + venedor_shortcode_target() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="testimonial-date">Date</label></th>\
				<td><input type="text" name="date" id="testimonial-date" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="testimonial-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="testimonial-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="testimonial-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="testimonial-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="testimonial-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="testimonial-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="testimonial-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="testimonial-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#testimonial-submit').click(function(){

        var options = {
            'title'              : '',
            'name'               : '',
            'photo'              : '',
            'link'               : '',
            'target'             : '',
            'date'               : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[testimonial';

        for( var index in options) {
            var value = table.find('#testimonial-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/testimonial]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="content_box-form"><table id="content_box-table" class="form-table">\
			<tr>\
				<th><label for="content_box-title">Title</label></th>\
				<td><input type="text" name="title" id="content_box-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="content_box-desc">Description</label></th>\
				<td><input type="text" name="desc" id="content_box-desc" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="content_box-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="content_box-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="content_box-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="content_box-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="content_box-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="content_box-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="content_box-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="content_box-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="content_box-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#content_box-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[content_box';

        for( var index in options) {
            var value = table.find('#content_box-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/content_box]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="title-form"><table id="title-table" class="form-table">\
			<tr>\
				<th><label for="title-title">Title</label></th>\
				<td><input type="text" name="title" id="title-class" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-title_transform">Title Text Transform</label></th>\
				<td><select name="title_transform" id="title-title_transform">\
                ' + venedor_shortcode_transform() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-title_fontsize">Title Font Size</label></th>\
				<td><input type="text" name="title_fontsize" id="title-title_fontsize" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-desc">Description</label></th>\
				<td><textarea name="desc" id="title-desc"></textarea></td>\
			</tr>\
            <tr>\
				<th><label for="title-desc_fontsize">Desc Font Size</label></th>\
				<td><input type="text" name="desc_fontsize" id="title-desc_fontsize" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-size">Title Size</label></th>\
				<td><select name="size" id="title-size">\
                ' + venedor_shortcode_title_size() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-show_line">Show Line</label></th>\
				<td><select name="show_line" id="title-show_line">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-line_pos">Line Position</label></th>\
				<td><select name="line_pos" id="title-line_pos">\
                ' + venedor_shortcode_line_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="title-line_width">Line Width</label></th>\
				<td><input type="text" name="line_width" id="title-line_width" value="40px" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-line_color">Line Color</label></th>\
				<td><input type="text" name="line_color" id="title-line_color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-align">Align</label></th>\
                <td><select name="align" id="title-align">\
                ' + venedor_shortcode_align_center() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="title-color">Text Color</label></th>\
				<td><input type="text" name="color" id="title-color" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-shadow">Text Shadow</label></th>\
				<td><input type="text" name="shadow" id="title-shadow" value="" /></td>\
			</tr>\
            <tr>\
				<th><label for="title-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="title-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="title-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="title-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="title-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="title-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="title-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="title-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="title-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#title-submit').click(function(){

        var options = {
            'title'              : '',
            'title_transform'    : '',
            'title_fontsize'     : '',
            'desc'               : '',
            'desc_fontsize'      : '',
            'size'               : '',
            'show_line'          : 'true',
            'line_pos'           : 'middle',
            'line_width'         : '40px',
            'line_color'         : '',
            'align'              : 'center',
            'color'              : '',
            'shadow'             : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[title';

        for( var index in options) {
            var value = table.find('#title-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="recent_posts-form"><table id="recent_posts-table" class="form-table">\
            <tr>\
				<th><label for="recent_posts-title">Title</label></th>\
				<td><input type="text" name="title" id="recent_posts-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-desc">Description</label></th>\
				<td><textarea name="desc" id="recent_posts-desc"></textarea></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-show_title">Show Post Title</label></th>\
				<td><select name="show_title" id="recent_posts-show_title">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-show_excerpt">Show Post Excerpt</label></th>\
				<td><select name="show_excerpt" id="recent_posts-show_excerpt">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-show_meta">Show Post Meta</label></th>\
				<td><select name="show_meta" id="recent_posts-show_meta">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-items">Posts Count</label></th>\
				<td><input type="text" name="items" id="recent_posts-items" value="6" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="recent_posts-cat" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="recent_posts-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="recent_posts-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="recent_posts-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="recent_posts-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="recent_posts-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="recent_posts-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="recent_posts-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="recent_posts-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="recent_posts-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="recent_posts-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#recent_posts-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'show_title'         : 'true',
            'show_excerpt'       : 'true',
            'show_meta'          : 'true',
            'items'              : '6',
            'cat'                : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[recent_posts';

        for( var index in options) {
            var value = table.find('#recent_posts-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="recent_portfolios-form"><table id="recent_portfolios-table" class="form-table">\
            <tr>\
				<th><label for="recent_portfolios-title">Title</label></th>\
				<td><input type="text" name="title" id="recent_portfolios-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-desc">Description</label></th>\
				<td><textarea name="desc" id="recent_portfolios-desc"></textarea></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-show_title">Show Portfolio Title</label></th>\
				<td><select name="show_title" id="recent_portfolios-show_title">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-show_cats">Show Portfolio Categories</label></th>\
				<td><select name="show_cats" id="recent_portfolios-show_cats">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-items">Portfolios Count</label></th>\
				<td><input type="text" name="items" id="recent_portfolios-items" value="6" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="recent_portfolios-cat" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="recent_portfolios-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="recent_portfolios-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="recent_portfolios-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="recent_portfolios-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="recent_portfolios-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="recent_portfolios-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="recent_portfolios-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="recent_portfolios-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="recent_portfolios-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="recent_portfolios-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#recent_portfolios-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'show_title'         : 'true',
            'show_cats'          : 'true',
            'items'              : '6',
            'cat'                : '',
            'arrow_pos'          : '',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[recent_portfolios';

        for( var index in options) {
            var value = table.find('#recent_portfolios-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="grid_container-form"><table id="grid_container-table" class="form-table">\
			<tr>\
				<th><label for="grid_container-grid_size">Grid Size</label></th>\
				<td><input type="text" name="grid_size" id="grid_container-grid_size" value="0px" />\
			</tr>\
			<tr>\
				<th><label for="grid_container-gutter_size">Gutter Size</label></th>\
				<td><input type="text" name="gutter_size" id="grid_container-gutter_size" value="5px" />\
			</tr>\
			<tr>\
				<th><label for="grid_container-max_width">Max Width</label></th>\
				<td><input type="text" name="max_width" id="grid_container-max_width" value="767px" />\
				<br/><small>will be show as grid only when window width > max width.</small></td>\
			</tr>\
			<tr>\
				<th><label for="grid_container-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="grid_container-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="grid_container-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#grid_container-submit').click(function(){

        var options = {
            'grid_size'          : '0px',
            'gutter_size'        : '5px',
            'max_width'          : '767px',
            'class'              : ''
        };

        var shortcode = '[grid_container';

        for( var index in options) {
            var value = table.find('#grid_container-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Grid Item Shortcodes[/grid_container]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="grid_item-form"><table id="grid_item-table" class="form-table">\
			<tr>\
				<th><label for="grid_item-gutter_size">Width</label></th>\
				<td><input type="text" name="width" id="grid_item-width" value="200px" />\
			</tr>\
			<tr>\
				<th><label for="grid_item-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="grid_item-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="grid_item-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#grid_item-submit').click(function(){

        var options = {
            'width'              : '200px',
            'class'              : ''
        };

        var shortcode = '[grid_item';

        for( var index in options) {
            var value = table.find('#grid_item-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']Insert Content[/grid_item]';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="posts-form"><table id="posts-table" class="form-table">\
            <tr>\
				<th><label for="posts-title">Title</label></th>\
				<td><input type="text" name="title" id="posts-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts-layout">Layout</label></th>\
				<td><select name="layout" id="posts-layout">\
                ' + venedor_shortcode_blog_layout() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="posts-cat" value="" />\
				<br/><small>comma separated list of category ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts-post_in">Post IDs</label></th>\
				<td><input type="text" name="post_in" id="posts-post_in" value="" />\
                <br/><small>comma separated list of post ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts-count">Posts Count</label></th>\
				<td><input type="text" name="count" id="posts-count" value="10" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts-arrow_pos">Arrow Position</label></th>\
				<td><select name="arrow_pos" id="posts-arrow_pos">\
                ' + venedor_shortcode_arrow_pos() + '\
				</select></td>\
			</tr>\
            <tr>\
				<th><label for="posts-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="posts-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="posts-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#posts-submit').click(function(){

        var options = {
            'title'              : '',
            'layout'             : 'grid',
            'cat'                : '',
            'post_in'            : '',
            'count'              : '10',
            'arrow_pos'          : '',
            'class'              : ''
        };

        var shortcode = '[posts';

        for( var index in options) {
            var value = table.find('#posts-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});


jQuery(function($) {

    var form = jQuery('<div id="posts_slider-form"><table id="posts_slider-table" class="form-table">\
            <tr>\
				<th><label for="posts_slider-title">Title</label></th>\
				<td><input type="text" name="title" id="posts_slider-title" value="" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-desc">Description</label></th>\
				<td><textarea name="desc" id="posts_slider-desc"></textarea></td>\
			</tr>\
			<tr>\
				<th><label for="posts-cat">Category IDs</label></th>\
				<td><input type="text" name="cat" id="posts-cat" value="" />\
				<br/><small>comma separated list of category ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts-post_in">Post IDs</label></th>\
				<td><input type="text" name="post_in" id="posts-post_in" value="" />\
                <br/><small>comma separated list of post ids</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-show_title">Show Post Title</label></th>\
				<td><select name="show_title" id="posts_slider-show_title">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-show_excerpt">Show Post Excerpt</label></th>\
				<td><select name="show_excerpt" id="posts_slider-show_excerpt">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-show_meta">Show Post Meta</label></th>\
				<td><select name="show_meta" id="posts_slider-show_meta">\
                ' + venedor_shortcode_boolean_true() + '\
				</select></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-count">Posts Count</label></th>\
				<td><input type="text" name="count" id="posts_slider-count" value="6" /></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-animation_type">Animation Type</label></th>\
                <td><select name="animation_type" id="posts_slider-animation_type">\
                ' + venedor_shortcode_animation_type() + '\
				</select></td>\
            </tr>\
			<tr>\
				<th><label for="posts_slider-animation_duration">Animation Duration</label></th>\
				<td><input type="text" name="animation_duration" id="posts_slider-animation_duration" value="1" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
			<tr>\
				<th><label for="posts_slider-animation_delay">Animation Delay</label></th>\
				<td><input type="text" name="animation_delay" id="posts_slider-animation_delay" value="0" />\
				<br/><small>numerical value (unit: seconds)</small></td>\
			</tr>\
            <tr>\
				<th><label for="posts_slider-class">Custom Class</label></th>\
				<td><input type="text" name="class" id="posts_slider-class" value="" />\
				<br/><small>can add margin classes like "m-t-xxl m-b-xxl"</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="posts_slider-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');

    var table = form.find('table');
    form.appendTo('body').hide();

    form.find('#posts_slider-submit').click(function(){

        var options = {
            'title'              : '',
            'desc'               : '',
            'cat'                : '',
            'post_in'            : '',
            'show_title'         : 'true',
            'show_excerpt'       : 'true',
            'show_meta'          : 'true',
            'count'              : '6',
            'animation_type'     : '',
            'animation_duration' : '1',
            'animation_delay'    : '0',
            'class'              : ''
        };

        var shortcode = '[posts_slider';

        for( var index in options) {
            var value = table.find('#posts_slider-' + index).val();

            if ( value !== options[index] && (typeof value !== 'undefined'))
                shortcode += ' ' + index + '="' + value + '"';
        }

        shortcode += ']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        tb_remove();
    });
});