<?php
/*
Theme Name: PCCTI
Version: 1.0.20110105
Author: Cis
The main template file.
*/
?>
<?php get_header(); ?>
<?php get_sidebar('banner'); ?>
<!--<div class="slider-room-rental">
  <div class="slider-new">
    <div id="container">
    
      <div id="banner-slide" style="position: relative; max-width: 1011px; height: 397px;">
        <div class="bjqs-wrapper" style="width: 1011px; height: 397px; overflow: hidden; position: relative;">

<?php   //if (function_exists('get_thethe_image_slider')) {
                //print get_thethe_image_slider('slider');}
        ?>
        </div>
      </div>
        
    </div>
    </div>
    <div class="shadow_slider"><img width="1024" height="33" src="<?php bloginfo('template_url')?>/images/shadow-slider.png"></div>
    <div class="clr"></div>
    
</div>-->
   <!-- Add comment by sheruji srt content area for inner page  18 jan 2013-->
 <div class="content">
	<div class="inner_content">	
        <div class="content_text">
	      <?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
		
        <div class="clr"></div>
        </div>
    </div>
    
    <div class="clr"></div>
</div>
<div class="clr"></div>
   <!-- Add comment by sheruji end content area for inner page  18 jan 2013-->
  <?php get_footer(); ?>
	

