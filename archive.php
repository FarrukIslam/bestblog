<?php get_header(); ?>

	
	<section class="blog-content">
		<div class="container">
			<div class="row">
				<div class="left-side col-md-9">
					<div class="blog-wrapper">
					
						<h1 class="page-title-archive"> 
			
						<?php _e('Showing Archives for:','bestblog'); 
						
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author: %s', 'bestblog' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'bestblog' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'bestblog' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'bestblog' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'bestblog' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'bestblog');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'bestblog' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'bestblog' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'bestblog' );

						else :
							_e( 'Archives', 'bestblog' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
				
					<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
					
						<!-- standard blog post -->
						<article id="standard" class="blog-post-item">
							<div class="top-bg color-1"></div>
							
							<div class="thumbnail">
								<?php the_post_thumbnail( 'post-thumbnails', array( 'class' => 'img-responsive' ) ); ?>
							</div>
							
							<div class="content-wrapper">
								<header class="entry-header">
									<div class="entry-date pull-left">
										<span class="binds"></span>
										<span class="month color-1"><?php the_time('F') ?></span>
										<h4 class="day"><?php the_time('j') ?></h4>
									</div>
									<div class="entry-title">
										<h1><a href="<?php the_permalink(); ?>" class="transition"><?php the_title(); ?></a></h1>
										<h4>
										<span class="author-name"><strong><?php _e('Post By', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span> | 
										<span class="comments"><strong><?php _e('Comments', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php comments_popup_link('No Comment', '% Comment', 'bestblog'); ?></a></span>
										</h4>
									</div>
								</header>
								
								<div class="entry-content">
									<?php the_excerpt(); ?>
								</div>
							</div>
							
							<footer class="entry-footer">
								
								<?php
								echo get_the_tag_list('<ul class="tag list-inline pull-left">
									<strong>Tag: </strong> <li>','</li><li> ','</li></ul>');
								?>
								<ul class="social-share list-inline pull-right">
									<strong>Share: </strong>
									<li><a href="#"><span class="ion-social-facebook-outline"></span></a></li>
									<li><a href="#"><span class="ion-social-twitter-outline"></span></a></li>
									<li><a href="#"><span class="ion-social-linkedin-outline"></span></a></li>
									<li><a href="#"><span class="ion-social-googleplus-outline"></span></a></li>
									<li><a href="#"><span class="ion-social-pinterest-outline"></span></a></li>
									<li><a href="#"><span class="ion-ios-email-outline"></span></a></li>
								</ul>
							</footer>
						</article>
						
					<?php endwhile; ?>
					
					 <?php  ?>
					 
						<?php else : ?>
							  <h3><?php _e('404 Error&#58; Not Found', 'bestblog'); ?></h3>
						<?php endif; ?>	
						
					</div><!-- End blog wrapper -->
					
					<!-- Pagination -->
					
						<?php bestblog_pagination(); ?>
						
					<!-- End Pagination -->
					
					<!-- Pagination -->

				</div><!-- End left side -->
				
				<div class="right-side col-md-3">
					 <?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>
	
<?php get_footer(); ?>