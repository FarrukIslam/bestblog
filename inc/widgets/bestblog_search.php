<?php 

/* Best blog seach widget */

class bestblog_search extends WP_Widget{
	public function __construct(){
		parent::__construct('bestblog_search','Bestblog Seach Widgets', array(
			'description' => 'Add Seach box on Bestblog Widgets'
		));
		
	}
	public function widget($args,$instance){
		
		$title = $instance['title'];
		$show_search = $instance['show-search'];

		echo $args['before_widget'].'<div class="search-widget">'.
				$args['before_title'].''.$title.''.
				$args['after_title'];		
		
		
		if($show_search){
			$showsearch = '<form action="" method="get" class="search-form">
				<input type="search" name="s" id="search" />
				<input type="submit" name="submit" value="Search" id="submit" />
			</form>
			
			';
			}
			echo $showsearch;
			
		echo '</div>'.$args['after_widget'];
		
	}
	
	public function form($instance){
	
	$title = $instance['title'];
	$show_search = $instance['show-search'];
	
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bestblog'); ?></label></p>
		<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"/></p>
		
		<p><input type="checkbox" id="<?php echo $this->get_field_id('show-search'); ?>" <?php checked($show_search,1); ?> value="1" name="<?php echo $this->get_field_name('show-search'); ?>" class="" /><label for="<?php echo $this->get_field_id('show-search'); ?>"><?php _e('Show Custom Seach Widget', 'bestblog'); ?></label></p>

	<?php
}
	
	
	public function update($new_instence,$old_instence){
		$instance = $old_instence;
		
		$instance['title'] = $new_instence['title'];
		$instance['show-search'] = $new_instence['show-search'];
		return $instance;
		
	}
}
function seach_bestblog(){
	register_widget('bestblog_search');
}
add_action('widgets_init','seach_bestblog');