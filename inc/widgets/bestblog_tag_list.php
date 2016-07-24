<?php 

/* Best blog tag list widget */

class bestblog_tag_list extends WP_Widget{
	public function __construct(){
		parent::__construct('bestblog_tag_list','Bestblog tag list Widgets', array(
			'description' => 'Add tag list box on Bestblog Widgets'
		));
		
	}
	public function widget($args,$instance){
		
		$title = $instance['title'];
		$show_tag_list = $instance['show_tag_list'];

		echo $args['before_widget'].'<div class="tab-widget widget">'.
				$args['before_title'].''.$title.''.
				$args['after_title'];	

				global $wpdb;



				// Select all the post tag IDs
				$the_tags = $wpdb->get_col("SELECT term_id
				FROM $wpdb->term_taxonomy WHERE taxonomy = 'post_tag'" );
				
			if($show_tag_list){
				echo '<ul class="tag list-inline">';
			
				foreach($the_tags as $tag_id) {
					$post_tag = get_term( $tag_id, 'post_tag' );				
					echo '<li><a href="'.get_permalink().'">'.$post_tag->name.'<span class="total-post">'.$post_tag->count.'</span></a></li>';
					// Unset the data when it's not needed
					unset($post_tag);
				}
				echo '</ul>';			
					
				}	
		echo '</div>'.$args['after_widget'];
		
	}
	
	public function form($instance){
	
	$title = $instance['title'];
	$show_tag_list = $instance['show_tag_list'];
	
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bestblog'); ?></label></p>
		<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"/></p>
		
		<p><input type="checkbox" id="<?php echo $this->get_field_id('show_tag_list'); ?>" <?php checked($show_tag_list,1); ?> value="1" name="<?php echo $this->get_field_name('show_tag_list'); ?>" class="" /><label for="<?php echo $this->get_field_id('show_tag_list'); ?>"><?php _e('TitleShow Tag List', 'bestblog'); ?></label></p>

	<?php
}
	
	
	public function update($new_instence,$old_instence){
		$instance = $old_instence;
		
		$instance['title'] = $new_instence['title'];
		$instance['show_tag_list'] = $new_instence['show_tag_list'];
		return $instance;
		
	}
}
function tag_list_bestblog(){
	register_widget('bestblog_tag_list');
}
add_action('widgets_init','tag_list_bestblog');