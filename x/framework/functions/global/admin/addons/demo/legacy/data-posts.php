<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/DEMO/DATA-POSTS.PHP
// -----------------------------------------------------------------------------
// Demo data for posts.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Specify $posts Array
//   02. Add Post Data
// =============================================================================

// Specify $posts Array
// =============================================================================

$posts = array();



// Add Post Data
// =============================================================================

if ( $include_posts || $front_page_is_blog ) {

  //
  // Setup categories.
  //

  $categories = array(
    'standard' => 'Standard',
    'link'     => 'Link',
    'gallery'  => 'Gallery',
    'quote'    => 'Quote',
    'image'    => 'Image',
    'video'    => 'Video',
    'audio'    => 'Audio'
  );

  $category_ids = x_demo_content_add_categories( $categories, 'category' );

  $standard = $category_ids['standard'];
  $link     = $category_ids['link'];
  $gallery  = $category_ids['gallery'];
  $quote    = $category_ids['quote'];
  $image    = $category_ids['image'];
  $video    = $category_ids['video'];
  $audio    = $category_ids['audio'];


  //
  // Entry data.
  //

  $posts['post-1'] = array(
    'post_title'   => 'Demo: 5 Reasons You Need The X Theme',
    'post_content' => '<p>X is not your grandmother\'s WordPress theme, and we want to prove it to you. Here are the top 5 reasons you need to buy X today!</p><h3>Stacks, Stacks, &amp; More Stacks</h3><p>Instead of being stuck with one design for your next project, X is a gift that keeps on giving. Built with our custom Stacks, X is the most versatile premium WordPress theme on the market today. Think of Stacks like full site designs built into the theme with each one giving a totally unique look and feel. There are currently three Stacks to chose from: Integrity, Renew, and Icon.</p><h3>Point &amp; Click</h3><p>X is not only one of the most cutting edge themes on the market today, it\'s incredibly easy to customize using the latest innovation from WordPress: the Theme Customizer. Instead of clicking through pages and pages of an admin panel only to have to click back and forth between the dashboard and your live site, with X you can change every aspect of your site while viewing it through the Customizer. See in real time how every color, layout, and pixel will look then click "Save" and you\'re done. Customizing a theme has never been so easy.</p><h3>Built By Experts</h3><p>We weren\'t satisfied with just making "another" WordPress theme...so we decided to do something different. We reached out to many of the top business and internet marketing minds of today to ask them about things like conversion, copywriting, layouts, squeeze pages, SEO, and more. X is the culmination of over a dozen of the smartest marketers on the planet who shared their expertise to build into this truly ultimate theme. You can learn more about the experts who contributed in our <a href="//theme.co/x/features/" title="X WordPress Theme Features">features</a> section.</p><h3>Future Proof</h3><p>HTML5. CSS3. Fully Responsive, and more! X is not only built to be the most beautiful and powerful WordPress Theme of 2013, it is ready for the future. With a sharp development team that stays on the cutting edge of all that WordPress has to offer, you can rest assured that any site using X will be steps ahead of the pack employing the high-end functionality your site demands.</p><h3>Simply The Best</h3><p>Don\'t just take our word for it. See for yourself. First time users frequently report how fun and easy it is to customize X exactly to their likings. Whether that\'s boxed or full width, dark or light, multi colors or minimal, large fonts or small &mdash; X is like nothing you have ever seen!</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-2 days' ) ),
    'tax_input'    => array(
      'category' => array( $standard ),
      'post_tag' => array( 'Reflective', 'Standard', 'Training', 'Wisdom', 'Ponder', 'X' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      )
    )
  );

  $posts['post-2'] = array(
    'post_title'   => 'Demo: Affiliate Marketing 101 (Self Hosted Video)',
    'post_content' => '[pullquote]If you like the format of the video above, we have put together dozens of others for everyone who purchases X. Learn about all sorts of different topics like Affiliate Marketing, Email Marketing, SEO, Digital Products, and more.[/pullquote]<p>For those looking for a more customized solution, you can upload your own self-hosted videos using the nifty Video Post Format right from within your dashboard. Each video will be fully responsive and look great on any device!</p><p>Simply create a post like you always would, select Video in the format box, then enter the destination of your video file (MP4, M4V, OGV) right below the main content area. In addition you can select the desired aspect ratio for optimum viewing.</p><p>Like above, you can optionally set a featured image that will show before the video is played.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-3 days' ) ),
    'tax_input'    => array(
      'category' => array( $video ),
      'post_tag' => array( 'Instruction', 'Training', 'X' )
    ),
    'x_info' => array(
      'post_format' => 'video',
      'images' => array(
        'featured' => $content_url . '/img-5.png'
      ),
      'meta' => array(
        '_x_video_aspect_ratio' => '16:9',
        '_x_video_m4v'          => 'http://assets.theme.co/demo-content/video.mp4'
      )
    )
  );

  $posts['post-3'] = array(
    'post_title'   => 'Demo: Thought For The Day',
    'post_content' => '<p>This is quote post where you can share all your favorite sayings. The featured image is optional.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-4 days' ) ),
    'tax_input'    => array(
      'category' => array( $quote ),
      'post_tag' => array( 'Reflection', 'Wisdom' )
    ),
    'x_info' => array(
      'post_format' => 'quote',
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_quote_quote' => 'The man of integrity walks securely, but he who takes crooked paths will be found out.',
        '_x_quote_cite'  => 'Proverbs'
      )
    )
  );

  $posts['post-4'] = array(
    'post_title'   => 'Demo: Standard Post With A Featured Image',
    'post_content' => '<p>Sometimes you\'ll want to add featured images to your post. Here\'s what a post would look like with a featured image. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-5 days' ) ),
    'tax_input'    => array(
      'category' => array( $standard ),
      'post_tag' => array( 'Standard', 'X' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      )
    )
  );

  $posts['post-5'] = array(
    'post_title'   => 'Demo: Image Post',
    'post_content' => '<p>This is a great way to showcase cool individual images in a quick and easy way. While writing your post: select the image format, add your featured image, then click Publish!</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-6 days' ) ),
    'tax_input'    => array(
      'category' => array( $image ),
      'post_tag' => array( 'Creative', 'Fun', 'Inspiring' )
    ),
    'x_info' => array(
      'post_format' => 'image',
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      )
    )
  );

  // $posts['post-6'] = array(
  //   'post_title'   => 'Demo: Beautiful Gallery Post',
  //   'post_content' => '<p>In this gallery post format, you can include a grouping of images to share with your visitors or customers. In addition you can type any text you want to show up below or leave this area blank to just show the images. You can even use the arrows to browse through the images without having to click through to the post.</p>',
  //   'post_type'    => 'post',
  //   'post_status'  => 'publish',
  //   'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-7 days' ) ),
  //   'tax_input'    => array(
  //     'category' => array( $gallery ),
  //     'post_tag' => array( 'Blue', 'Green', 'Yellow' )
  //   ),
  //   'x_info' => array(
  //     'post_format' => 'gallery',
  //     'images' => array(
  //       'featured'  => $content_url . '/img-1.png',
  //       'gallery-1' => $content_url . '/img-2.png',
  //       'gallery-2' => $content_url . '/img-3.png',
  //       'gallery-3' => $content_url . '/img-4.png'
  //     )
  //   )
  // );

  $posts['post-7'] = array(
    'post_title'   => 'Demo: Little Red Riding Hood (Embedded Video)',
    'post_content' => '<p>Looking to embed videos from YouTube, Vimeo, or any of the other popular video sites? No problem at all. Simply take the embed video code, add it to the video settings, and you\'re done.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-8 days' ) ),
    'tax_input'    => array(
      'category' => array( $video ),
      'post_tag' => array( 'Creative' )
    ),
    'x_info' => array(
      'post_format' => 'video',
      'meta' => array(
        '_x_video_aspect_ratio' => '16:9',
        '_x_video_embed'        => '<iframe src="//player.vimeo.com/video/3514904" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
      )
    )
  );

  $posts['post-8'] = array(
    'post_title'   => 'Demo: Audio Without Image',
    'post_content' => '<p>You can share your favorite audio files for all your visitors to listen to. You have the choice to set a featured image, however this is how things look when you have an audio post without one.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-9 days' ) ),
    'tax_input'    => array(
      'category' => array( $audio ),
      'post_tag' => array( 'Melancholy', 'Reflective', 'Piano' )
    ),
    'x_info' => array(
      'post_format' => 'audio',
      'meta' => array(
        '_x_audio_mp3' => 'http://assets.theme.co/demo-content/audio.mp3'
      )
    )
  );

  $posts['post-9'] = array(
    'post_title'   => 'Demo: Have You Heard Of Them?',
    'post_content' => '<p>Link posts are great for sharing cool sites and online resources. All links open in a new window, and the title of your post shows above the link. As always the featured image is optional. Should you decide to use a featured image, you can upload any size (height and width), and X will take care of the rest.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-10 days' ) ),
    'tax_input'    => array(
      'category' => array( $link ),
      'post_tag' => array( 'Links', 'Shminks' )
    ),
    'x_info' => array(
      'post_format' => 'link',
      'meta' => array(
        '_x_link_url' => 'https://www.google.com/'
      )
    )
  );

  $posts['post-10'] = array(
    'post_title'   => 'Demo: Audio With Image',
    'post_content' => '<p>Sometimes there\'s nothing more powerful than the perfect song and image to go with it. Here is an audio post with the optional featured image.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-11 days' ) ),
    'tax_input'    => array(
      'category' => array( $audio ),
      'post_tag' => array( 'Melancholy', 'Reflective', 'Piano' )
    ),
    'x_info' => array(
      'post_format' => 'audio',
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_audio_mp3' => 'http://assets.theme.co/demo-content/audio.mp3'
      )
    )
  );

  $posts['post-11'] = array(
    'post_title'   => 'Demo: Standard Post With No Featured Image',
    'post_content' => '<p>Sometimes you just want to type. No messing with images. Here\'s what a post would look like with no featured image. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium, nisi ut volutpat mollis, leo risus interdum arcu, eget facilisis quam felis id mauris. Ut convallis, lacus nec ornare volutpat, velit turpis scelerisque purus, quis mollis velit purus ac massa. Fusce quis urna metus. Donec et lacus et sem lacinia cursus.</p>',
    'post_type'    => 'post',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-12 days' ) ),
    'tax_input'    => array(
      'category' => array( $standard ),
      'post_tag' => array( 'Standard', 'X' )
    )
  );

}