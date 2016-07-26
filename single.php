<?php get_header(); ?>
		
		<section class="blog-content">
			<div class="container">
				<div class="row">
					<div class="left-side blog-single col-md-9">
						<div class="blog-wrapper">
							<!-- standard blog post -->
							
							<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
							
							<article id="<?php the_ID(); ?>" class="blog-post-item <?php post_class(); ?>">
								<div class="top-bg color-4"></div>
								<div class="thumbnail">
									<?php the_post_thumbnail( 'post-thumbnails', array( 'class' => 'img-responsive' ) ); ?>
								</div>
								<div class="content-wrapper">
									<header class="entry-header">
										<div class="entry-date pull-left">
											<span class="binds"></span>
											<span class="month color-4"><?php the_time('F') ?></span>
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
										<?php the_content(); ?>
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
								
								<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || '0' != get_comments_number() )
										comments_template();
								?>
								
								
							</article>
						<?php endwhile; ?>
						<?php else : ?>
							  <h3><?php _e('404 Error&#58; Not Found', 'bestblog'); ?></h3>
						<?php endif; ?>
						</div>
					</div>
					
					<div class="right-side col-md-3">
						<!-- sidebar -->
						<?php get_sidebar(); ?>
						<!--end sidebar-->
					</div>	
				</div>
			</div>
		</section>
		
		<section class="related-post-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="title"><?php _e('Related Post','bestblog'); ?></h2>
					</div>
				</div>
				<div class="row">
				
				<?php 
					$related_args = array(
						'post_type' => 'post',
						'posts_per_page' => 6,
						'post__not_in' => array($post->ID),

					);
					$related = new WP_Query( $related_args );
					 
					if( $related->have_posts() ):
				?>
					<ul class="related-post">
					 <?php while( $related->have_posts() ): $related->the_post(); ?>
					
						<li>
							<!-- Slider blog post -->
							<article id="standard" class="blog-post-item">
								<div class="top-bg color-2"></div>
								<div class="thumbnail">
									<?php the_post_thumbnail( 'post-thumbnails', array( 'class' => 'img-responsive' ) ); ?>
								</div>
								<div class="content-wrapper">
									<header class="entry-header">
										<div class="entry-title">
											<h1><a href="<?php the_permalink(); ?>" class="transition"><?php the_title(); ?></a></h1>
											<h4>
											<span class="author-name"><strong><?php _e('Post By', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span> | 
											<span class="comments"><strong><?php _e('Comments', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php comments_popup_link('No Comment', '% Comment', 'bestblog'); ?></a></span>
											</h4>
										</div>
									</header>
								</div>
								<footer class="entry-footer">
									<ul class="social-share list-inline">
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
						</li>
						
						
						
				
					<?php endwhile; ?>
					</ul>
					
				<?php
					endif;
					wp_reset_postdata();
				?>
				</div>
			</div>
		</section>
		
<?php get_footer(); ?>