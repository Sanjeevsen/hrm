<div class="footer">
	
	<?php
	$defaults = array(
	'theme_location'  => '',
	'menu'            => '',
	'container'       => 'div',
	'container_class' => 'footer_top',
       'container_id'    => '',
	'menu_class'      => 'footer_top_in',
	'menu_id'         => 'menu',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
   'link_before'     => '<h1>',
	'link_after'      => '</h1>',
	'items_wrap'      => '%3$s',
	'depth'           => 0,
	'walker'          => ''
);
wp_nav_menu($defaults);
	?> 
    <div class="clr"></div>
    <div class="footer_bottom">
      <div class="footer_bottom_in">
     <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?><?php  dynamic_sidebar( 'Footer Widget Area' ); ?><?php endif; ?>
        </div>
    </div>
</div>
    </div>
</body>
</html>




