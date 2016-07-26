<?php 

/* Best blog tag list widget */

class bestblog_tab_content extends WP_Widget{
	public function __construct(){
		parent::__construct('bestblog_tab_content','Bestblog Tab Content Widgets', array(
			'description' => 'Add Tab Content Bestblog Widgets'
		));
		
	}
	public function widget($args,$instance){
		
		$title = $instance['title'];
		$show_tab_content = $instance['show_tab_content'];
		$show_number_post = $instance['show_number_post'];

		echo $args['before_widget'].'<div class="tab-widget widget">'.
				$args['before_title'].''.$title.''.
				$args['after_title'];		
		
		
		if($show_tab_content){
			
			?>
			
			
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#recent-post" aria-controls="recent-post" role="tab" data-toggle="tab">Recent Posts</a>
				</li>
				<li role="presentation">
					<a href="#popular-post" aria-controls="popular-post" role="tab" data-toggle="tab"><?php _e('Popular Post', 'bestblog'); ?></a>
				</li>
				<li role="presentation">
					<a href="#comments" aria-controls="comments" role="tab" data-toggle="tab"><?php _e('comments', 'bestblog'); ?></a>
				</li>
			</ul>
			
			<div class="tab-content">
			
			<div role="tabpanel" class="tab-pane active" id="recent-post">
			
			<ul class="recent-post">
			<?php 
				$q = new WP_Query(
					array('posts_per_page' => $show_number_post, 'post_type' => 'post')
					);	
					
				if( $q -> have_posts() ) {
				
				while ( $q -> have_posts() ) : $q -> the_post(); 
			?>
			
				
						<li>
						
						<?php
							if(has_post_thumbnail()){ ?>
								<div class="thumbnail pull-left">
								<?php the_post_thumbnail( 'recent_post_widget', array( 'class' => 'img-responsive' ) ); ?>
								</div>
							<?php 
							}
						?>
							
							<div class="entry-title">
								<h1><a href="<?php the_permalink(); ?>" class="transition"><?php the_title(); ?></a></h1>
								<h4>
								<span class="author-name"><strong><?php _e('Post By', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span> | 
								<span class="comments"><strong><?php _e('Comments', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php comments_popup_link('No Comment', '% Comment', 'bestblog'); ?></a></span>
								</h4>
							</div>
						</li>	
					
				
				<?php 
					endwhile; 
					
					} else {
						echo '<h5>'.__( 'No Post added yet!', 'bestblog' ).'</h5>';
					}
					// Reset Query
					wp_reset_query();
				?>	
				</ul>
				</div>
				
				
				<div role="tabpanel" class="tab-pane" id="popular-post">
					<ul class="recent-post popular-post">
						
					
					
					<?php 
					$popularpost = new WP_Query( array( 'posts_per_page' => $show_number_post, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
					
					if( $popularpost -> have_posts() ) {
						
					while ( $popularpost->have_posts() ) : $popularpost->the_post();
					?>
						<li>
							<div class="thumbnail pull-left">
								<?php the_post_thumbnail( 'post-thumbnails', array( 'class' => 'img-responsive' ) ); ?>
							</div>
							<div class="entry-title">
								<h1><a href="<?php the_permalink();  ?>" class="transition"><?php the_title(); ?></a></h1>
								<h4>
								<span class="author-name"><strong><?php _e('Post By', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span> | 
								<span class="comments"><strong><?php _e('Post By', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php comments_popup_link('No Comment', '% Comment', 'bestblog'); ?></a></span>
								</h4>
							</div>
						</li>
					<?php endwhile; ?>
					
					<?php }
					else{
						echo '<p> No propular post yet.</p>';
					}
						?>				
				</ul>
					
				</div>
				
				
				<div role="tabpanel" class="tab-pane" id="comments">
				
				<?php
					$args = array(
					   // args here
					   'number' => $show_number_post,
					);

					// The Query
					$comments_query = new WP_Comment_Query;
					$comments = $comments_query->query( $args );

					// Comment Loop
					if ( $comments ) {
						foreach ( $comments as $comment ) {
							echo '<p>' . $comment->comment_content . '</p>';
						}
					} else {
						echo 'No comments found.';
					}
					?> 

				</div>
			</div>
					
			<?php 
			}
			
			
		echo '</div>'.$args['after_widget'];
		
	}
	
	public function form($instance){
	
	$title = $instance['title'];
	$show_tab_content = $instance['show_tab_content'];
	$show_number_post = $instance['show_number_post'];
	
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bestblog'); ?></label></p>
		<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"/></p>
		
		<p><input type="checkbox" id="<?php echo $this->get_field_id('show_tab_content'); ?>" <?php checked($show_tab_content,1); ?> value="1" name="<?php echo $this->get_field_name('show_tab_content'); ?>" class="" /><label for="<?php echo $this->get_field_id('show_tab_content'); ?>"><?php _e('Show Tab Content', 'bestblog'); ?></label></p>
		
		<p><label for="<?php echo $this->get_field_id('show_number_post'); ?>"><?php _e('Show Number of post', 'bestblog'); ?></label></p>
		<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('show_number_post'); ?>" name="<?php echo $this->get_field_name('show_number_post'); ?>" value="<?php echo $show_number_post; ?>"/></p>
		

	<?php
}
	
	
	public function update($new_instence,$old_instence){
		$instance = $old_instence;
		
		$instance['title'] = $new_instence['title'];
		$instance['show_number_post'] = $new_instence['show_number_post'];
		$instance['show_tab_content'] = $new_instence['show_tab_content'];
		return $instance;
		
	}
}
function tab_content_bestblog(){
	register_widget('bestblog_tab_content');
}
add_action('widgets_init','tab_content_bestblog');