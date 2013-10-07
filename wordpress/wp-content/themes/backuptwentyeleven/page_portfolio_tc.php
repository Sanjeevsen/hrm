<?php
/*
Template Name: Portifolio 2 Columns
*/
?>

<?php
get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php
				 $terms = get_terms("tagportifolio");
				 $count = count($terms);
				 echo '<ul id="portfolio-filter">';
					echo '<li><a href="#all" title="">All</a></li>';
				 if ( $count > 0 ){
					
						foreach ( $terms as $term ) {
							
							$termname = strtolower($term->name);
							$termname = str_replace(' ', '-', $termname);
							echo '<li><a href="#'.$termname.'" title="" rel="'.$termname.'">'.$term->name.'</a></li>';
						}
				 }
				 echo "</ul>";
			?>
			
			<!--<ul id="portfolio-filter">
				<li><a href="#all">All</a>
				<li><a rel="jquery" href="#jquery">jQuery</a>
				<li><a rel="webdesign" href="#webdesign">Webdesign</a>
			</ul>-->
			
			<?php 
				$loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1));
				$count =0;
			?>
			
			<div id="portfolio-wrapper">
				<ul id="portfolio-list">
			
				<?php if ( $loop ) : 
					 
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
						<?php
						$terms = get_the_terms( $post->ID, 'tagportifolio' );
								
						if ( $terms && ! is_wp_error( $terms ) ) : 
							$links = array();

							foreach ( $terms as $term ) 
							{
								$links[] = $term->name;
							}
							$links = str_replace(' ', '-', $links);	
							$tax = join( " ", $links );		
						else :	
							$tax = '';	
						endif;
						?>
						
						<?php $infos = get_post_custom_values('_url'); ?>
						
						<li class="portfolio-item <?php echo strtolower($tax); ?> all">
							<div class="thumb"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail( array(400, 160) ); ?></a></div>
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							<p class="excerpt"><a href="<?php the_permalink() ?>"><?php echo get_the_excerpt(); ?></a></p>
							<p class="links"><a href="<?php echo $infos[0]; ?>" target="_blank">Live Preview &rarr;</a> <a href="<?php the_permalink() ?>">More Details &rarr;</a></p>
						</li>
						
					<?php endwhile; else: ?>
					 
					<li class="error-not-found">Sorry, no portfolio entries for while.</li>
						
				<?php endif; ?>
			

				</ul>

				<div class="clearboth"></div>
			
			</div> <!-- end #portfolio-wrapper-->
							
				<!-- 
				<ul id="portfolio-list">
					<li class="portfolio-item webdesign">
						<div class="thumb"><a href="#"><img src="/hifi/site/edit/blog/" alt=""></a></div>
						<h3>PROJECT TITLE</h3>
						<p class="excerpt">Excerpt here...</p>
						<p class="links"><a href="#" class="with-arrow" target="_blank">Live Preview</a> <a href="#" class="with-arrow">More Details</a></p>
					</li>
				</ul>
				-->
			
			<script>
				jQuery(document).ready(function() {	
					jQuery("#portfolio-list").filterable();
				});
			</script>
			
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>