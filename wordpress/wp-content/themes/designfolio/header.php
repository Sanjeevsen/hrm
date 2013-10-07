<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
<!--<link rel="profile" href="http://gmpg.org/xfn/11" />-->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/demo.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style1.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
<noscript>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/noscript.css" />
</noscript>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php  
/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		//wp_enqueue_script( 'comment-reply' );
	/* Always have wp_head() just before the closing </head>

	 * tag of your theme, or you will break many plugins, which

	 * generally use this hook to add elements to <head> such

	 * as styles, scripts, and meta tags.

	 */
wp_head();
//start_cforms_session();?>
</head>
<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

?>
<body>
    <?php
 $currenturl=curPageURL();
$checksignup=strpos($currenturl,"test");
global $current_user;
$userid=$current_user->ID;
 ?>
 <div class="header">
	<div class="header_top">
    	<div class="header_top_left"> <a href="<?php echo home_url();?>"><img src="<?php bloginfo('template_url')?>/images/logo.png" alt="" /></a>
        </div>
    	<div class="header_top_right">
	   
       <?php if(!$checksignup && $userid==0) {?>
            <p><a href="?page_id=241" class="sign_up">Sign up</a>
             <?php } ?>
	     <!-- For Login  srt-->
	      <?php if ( function_exists('flexible_frontend_login_modal') ) flexible_frontend_login_modal(); ?>
	      <?php //if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( $vertical, $horizontal ); ?>
	    <!-- For Login  end-->
	    <!--<a href="#"  class="login" >Login</a> --></p>
	    <p><a href="#"><img src="<?php bloginfo('template_url')?>/images/regi_btn.png" /></a>
	    </p>
            <p>
	<?php if ( is_active_sidebar( 'social-widget-area' ) ) : ?><?php  dynamic_sidebar( 'Social Widget Area' ); ?><?php endif; ?>
        <!--<span>Follow Us:</span><a href="#"><img src="<?php bloginfo('template_url')?>/images/twitter_icon.png" /></a><a href="#"><img src="<?php bloginfo('template_url')?>/images/fb_icon.png" /></a>-->
            </p>
        </div>
    </div>
	
    <div class="clr"></div>
	<div class="menu_bg">
	<div class="menu_bg_in">
	    
	<?php
	$defaults = array(
	'theme_location'  => '',
	'menu'            => '',
	'container'       => 'div',
	'container_class' => 'menu',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);
wp_nav_menu($defaults);
	?>
	  <?php
	// Has the text been hidden?
          ?>
	  <div class="search">
	  <?php get_search_form(); ?>
	  </div>
        </div>
    </div>
</div>

<!--Header end-->

	