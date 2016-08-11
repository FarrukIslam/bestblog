<?php 

/* Best blog category list widget */

class bestblog_category_list extends WP_Widget{
	public function __construct(){
		parent::__construct('bestblog_category_list','Bestblog category list Widgets', array(
			'description' => 'Add category list box on Bestblog Widgets'
		));
		
	}
	public function widget($args,$instance){
		
		$title = $instance['title'];
		$show_category_list = $instance['show_category_list'];

		echo $args['before_widget'].'<div class="categories-widget">'.
				$args['before_title'].''.$title.''.
				$args['after_title'];	
		
		
		 if($show_category_list){
			
		
			
		echo '<ul class="categories">';
		
		$cat_value = array(
			'type'                     => 'post',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'category',
			'pad_counts'               => false 

		); 
		
		$categories = get_categories( $cat_value );
		if($categories){
			foreach($categories as $cat) {
				echo '
				<li><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '<span class="total-post pull-right">'.get_the_time('j').'</span></a></li>
				
				';
			}
		} else {
			echo '<p>'.__( 'No Category found!', 'bestblog' ).'</p>';
		}
	
			} 
			
			
		echo '</ul></div>'.$args['after_widget'];
		
	}
	
	public function form($instance){
	
	$title = $instance['title'];
	$show_category_list = $instance['show_category_list'];
	
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bestblog'); ?></label></p>
		<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"/></p>
		
		<p><input type="checkbox" id="<?php echo $this->get_field_id('show_category_list'); ?>" <?php checked($show_category_list,1); ?> value="1" name="<?php echo $this->get_field_name('show_category_list'); ?>" class="" /><label for="<?php echo $this->get_field_id('show_category_list'); ?>"><?php _e('Show category List', 'bestblog'); ?></label></p>

	<?php
}
	
	
	public function update($new_instence,$old_instence){
		$instance = $old_instence;
		
		$instance['title'] = $new_instence['title'];
		$instance['show_category_list'] = $new_instence['show_category_list'];
		return $instance;
		
	}
}
function category_bestblog(){
	register_widget('bestblog_category_list');
}
add_action('widgets_init','category_bestblog');