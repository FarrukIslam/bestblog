<?php get_header(); ?>

	
	<section class="blog-content">
		<div class="container">
			<div class="row">
				<div class="left-side col-md-9">
					<div class="blog-wrapper">
			
						<h1 class="page-title-archive"><?php _e( 'Oops! That page can&rsquo;t be found.', 'bestblog' ); ?></h1>
									
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'bestblog' ); ?></p>

						<?php get_search_form(); ?>
						<br />
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
				
						
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