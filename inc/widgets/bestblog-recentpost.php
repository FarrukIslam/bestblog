<?php 
/* Best blog recent post widget */

class Bestblog_recentpost extends WP_Widget{
	public function __construct(){
		parent::__construct('Bestblog_recentpost','Bestblog Recent post Widgets', array(
			'description' => 'Add Bestblog recent post'
		));
		
	}
	
	// widget output layout
	public function widget($args,$instance){
		
		$title = $instance['title'];
		$numberofpost = $instance['numberofpost'];
		
		
		echo $args['before_widget'].''.
				$args['before_title'].''.$title.''.
				$args['after_title'];
		?>	
		<?php 
			$q = new WP_Query(
				array('posts_per_page' => $numberofpost, 'post_type' => 'post')
				);	
				
			if( $q -> have_posts() ) {
			echo '<ul class="recent-post">';
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
				<span class="comments"><strong><?php _e('Comments', 'bestblog'); ?></strong> - <a href="<?php the_permalink(); ?>"><?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?></a></span>
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
	
		<?php 
		
		echo '</ul>'.$args['after_widget'];		
	}
	
	// widget form input 
	public function form($instance){
		
		$title = $instance['title'];
		$numberofpost = $instance['numberofpost'];
		
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','bestblog'); ?></label></p>
			<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"/></p>
			
			
			<p><label for="<?php echo $this->get_field_id('numberofpost'); ?>"><?php _e('Show Numbers of Post','bestblog'); ?></label></p>
			<p><input type="number" class="widefat" id="<?php echo $this->get_field_id('numberofpost'); ?>" name="<?php echo $this->get_field_name('numberofpost'); ?>" value="<?php echo $numberofpost; ?>"/></p>

		<?php
	}
	
	// widget fields data update 
	
	public function update($new_instence,$old_instence){
		$instance = $old_instence;
		
		$instance['title'] = $new_instence['title'];
		$instance['numberofpost'] = $new_instence['numberofpost'];

		return $instance;
		
	}
	
	
}	

function recentpost_bestblog_widget(){
	register_widget('Bestblog_recentpost');
}
add_action('widgets_init','recentpost_bestblog_widget');