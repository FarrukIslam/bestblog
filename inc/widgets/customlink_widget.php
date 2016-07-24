<?php  

class Bestblog_customlink_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct( strtolower( __CLASS__ ), 'Bestblog Custom Link', array(
			'description' => 'Add Custom Quick Link with repeatable fields'
		) );
    }
	
     
    public function form( $instance )
    {
        $title = isset ( $instance['title'] ) ? $instance['title'] : '';
        $title = esc_attr( $title );

		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bestblog'); ?></label></p>
		<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"/></p>
		
		<?php 
		
		//$linktext = $instance['linktext'];
		//$link = $instance['link'];
		
        $fields = isset ( $instance['fields'] ) ? $instance['fields'] : array();
		
        $link = isset ( $instance['link'] ) ? $instance['link'] : array();
		
        $field_num = count( $fields );
        $fields[ $field_num + 1 ] = '';
		
		
        $fields_html = array();
        $fields_counter = 0;
		
		
        $field_link_num = count( $link );
        $link[ $field_link_num + 1 ] = '';
		
        $fields_link_htmls = array();
        $fields_link_counters = 0;
		
		
		

        foreach ( $fields as $name => $value )
        {
			echo '';
            $fields_html[] = sprintf(
				
				'<div class="quick_link_widget"><p><label for="'.$this->get_field_id('linktext').'">'._e('', 'bestblog').'</label><input type="text" class="" id="'.$this->get_field_id('linktext').'" name="%1$s[%2$s]" value="%3$s"/></p>',$this->get_field_name( 'fields' ),$fields_counter,esc_attr( $value ));
				

				$fields_counter += 1;
				
				
				
				
			$fields_link_htmls[] = sprintf(
			
			'<p><label for="'.$this->get_field_id('link').'">'._e('', 'bestblog').'</label><input type="text" class="" id="'.$this->get_field_id('link').'" name="%1$s[%2$s]" value="%3$s"/></p></div>',$this->get_field_name( 'link' ),$fields_link_counters,esc_attr( $value ));
			
            $fields_link_counters += 1;
			
			echo '';
		}
			
		?>
		
		
		<?php 
		/*
		foreach ( $link as $name => $values )
        {
			
            $fields_link_htmls[] = sprintf(
			
			'<p><label for="'.$this->get_field_id('link').'">'._e('', 'bestblog').'</label><input type="text" class="" id="'.$this->get_field_id('link').'" name="%1$s[%2$s]" value="%3$s"/></p>',$this->get_field_name( 'link' ),$fields_link_counters,esc_attr( $values ));
			
            $fields_link_counters += 1;
			
		}
		*/
        print 'Link Text' . join( '', $fields_html );
        print 'Link' . join( '', $fields_link_htmls );
		
		
		
    }

    
    public function widget( $args, $instance )
    {
       
		$title = $instance['title'];
		
		echo $args['before_widget'].''.
				$args['before_title'].''.$title.''.
				$args['after_title'];	
		
			echo '<ul class="quick-links">';
			
			$val = $instance['fields'];
			$link = $instance['link'];
			//var_dump($link);
			foreach($val as $value){
				echo '<li><a href="'.$link.'" class="ion-ios-arrow-forward">'.$value .'</a></li>';
			}
	
		echo '</ul></div>'.$args['after_widget'];
	
    }
	
	
    public function update( $new_instance, $old_instance )
    {
        $instance          = $old_instance;
        $instance['title'] = esc_html( $new_instance['title'] );
		
		$instance['linktext'] = $new_instence['linktext'];
		$instance['link'] = $new_instence['link'];
		
		
        $instance['fields'] = array();
        $instance['link'] = array();

        if ( isset ( $new_instance['fields'] ) )
        {
            foreach ( $new_instance['fields'] as $value )
            {
                if ( '' !== trim( $value ) )
                    $instance['fields'][] = $value;
            }
        }
		
		
        if ( isset ( $new_instance['link'] ) )
        {
            foreach ( $new_instance['link'] as $value )
            {
                if ( '' !== trim( $value ) )
                    $instance['link'][] = $value;
            }
        }

        return $instance;
    }

    public static function register()
    {
        register_widget( __CLASS__ );
    }
}
add_action( 'widgets_init', array ( 'Bestblog_customlink_Widget', 'register' ) );