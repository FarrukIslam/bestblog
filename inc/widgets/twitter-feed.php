<?php 

class Twitter_feed extends WP_Widget{
	public function __construct(){
		parent::__construct('Twitter_feed',__('Bestblog Show Twitter Feed','bestblog'),array(
			'description' => 'Add Setting your Twitter Feed Field',
		));
	}
	public function widget($args,$instance){
		
		 $title = $instance['title'];
		 $username = $instance['username'];
		 $consumer_key = $instance['consumer_key'];
		 $consumer_secret = $instance['consumer_secret'];
		 $access_token = $instance['access_token'];
		 $access_token_secret = $instance['access_token_secret'];
		 $number_of_tweets = $instance['number_of_tweets'];
				
		
		
		
		echo $args['before_widget'].'<div class="twitter-widget widget">'.
				$args['before_title'].''.$title.''.
				$args['after_title'];			
				
				
			/* REQUIRES: TwitterOAuth
			 *    https://github.com/abraham/twitteroauth/tree/master/twitteroauth
			 *
			 *    Download and place in a /twitteroauth/ folder in your theme/plugin.
			 *
			 *
			 * Full guide here: http://www.problogdesign.com/wordpress/authenticate-your-twitter-api-calls-before-march/
			 * 
			 * Uses:
			 * Twitter API call:
			 *     http://dev.twitter.com/doc/get/statuses/user_timeline
			 * WP transient API.
			 *		http://www.problogdesign.com/wordpress/use-the-transients-api-to-list-the-latest-commenter/
			 */
			 
			
			 
			  $title = $instance['title'];
			  $username = $instance['username'];
		      $consumer_key = $instance['consumer_key'];
		      $consumer_secret = $instance['consumer_secret'];
		      $access_token = $instance['access_token'];
		      $access_token_secret = $instance['access_token_secret'];
		      $number_of_tweets = $instance['number_of_tweets'];
			 
			 
			 

			$numTweets      = $number_of_tweets;                // Number of tweets to display.
			$name           = $username;  // Username to display tweets from.
			$excludeReplies = true;             // Leave out @replies
			$transName      = 'list-tweets';    // Name of value in database.
			$cacheTime      = 5;                // Time in minutes between updates.

			$backupName = $transName . '-backup';

			// Do we already have saved tweet data? If not, lets get it.
			if(false === ($tweets = get_transient($transName) ) ) :	

			  // Get the tweets from Twitter.
			  include 'twitter/twitterauth.php';
			  
			  $connection = new TwitterOAuth(
				$consumer_key,   // Consumer key
				$consumer_secret,   // Consumer secret
				$access_token,   // Access token
				$access_token_secret    // Access token secret
			  );
			  
			  
			  delete_transient($transName);
			  
			  // If excluding replies, we need to fetch more than requested as the
			  // total is fetched first, and then replies removed.
			  $totalToFetch = ($excludeReplies) ? max(50, $numTweets * 3) : $numTweets;
			  
			  $fetchedTweets = $connection->get(
				'statuses/user_timeline',
				array(
				  'screen_name'     => $name,
				  'count'           => $totalToFetch,
				  'exclude_replies' => $excludeReplies
				)
			  );
			  
			  // Did the fetch fail?
			  if($connection->http_code != 200) :
				$tweets = get_option($backupName); // False if there has never been data saved.
				
			  else :
				// Fetch succeeded.
				// Now update the array to store just what we need.
				// (Done here instead of PHP doing this for every page load)
				$limitToDisplay = min($numTweets, count($fetchedTweets));
				
				for($i = 0; $i < $limitToDisplay; $i++) :
				  $tweet = $fetchedTweets[$i];
				
				  // Core info.
				  $name = $tweet->user->name;
				  $permalink = 'http://twitter.com/'. $name .'/status/'. $tweet->id_str;

				  /* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
				  $image = $tweet->user->profile_image_url;

				  // Message. Convert links to real links.
				  $pattern = '/http:(\S)+/';
				  $replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
				  $text = preg_replace($pattern, $replace, $tweet->text);

				  // Need to get time in Unix format.
				  $time = $tweet->created_at;
				  $time = date_parse($time);
				  $uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);

				  // Now make the new array.
				  $tweets[] = array(
						  'text' => $text,
						  'name' => $name,
						  'permalink' => $permalink,
						  'image' => $image,
						  'time' => $uTime
						  );
				endfor;

				// Save our new transient, and update the backup.
				set_transient($transName, $tweets, 60 * $cacheTime);
				update_option($backupName, $tweets);
			  endif;
			endif; 

				
		// Now display the tweets.
		?>
		
		  <ul class="recent-twitter">
		
		  <?php foreach($tweets as $t) : ?>
		  
			<li><p><strong><?php echo $t['name']; ?></strong><?php echo $t['text']; ?> </p><span class="twt-time"><?php echo human_time_diff($t['time'], current_time('timestamp')); ?> <?php _e('ago', 'bestblog');?></span></li>
										
		  <?php endforeach; ?>
			</ul>	
						
						
			<?php 
				echo '</div>';
			    $args['after_widget'];
				 
		}
	
	
	public function form($instance){
		
		 $title = $instance['title'];
		 $username = $instance['username'];
		 $consumer_key = $instance['consumer_key'];
		 $consumer_secret = $instance['consumer_secret'];
		 $access_token = $instance['access_token'];
		 $access_token_secret = $instance['access_token_secret'];
		 $number_of_tweets = $instance['number_of_tweets'];
		
		
		
		?>
	
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bestblog');?></label></p>
		<p><input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"/></p>
		
		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('User Name', 'bestblog');?></label></p>
		<p><input class="widefat" type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key', 'bestblog');?></label></p>
		<p><input class="widefat" type="text" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $consumer_key; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret', 'bestblog');?></label></p>
		<p><input class="widefat" type="text" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $consumer_secret; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token', 'bestblog');?></label></p>
		<p><input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $access_token; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Token Secret', 'bestblog');?></label></p>
		<p><input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $access_token_secret; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number_of_tweets'); ?>"><?php _e('Number of Twieets', 'bestblog');?></label></p>
		<p><input class="widefat" type="text" id="<?php echo $this->get_field_id('number_of_tweets'); ?>" name="<?php echo $this->get_field_name('number_of_tweets'); ?>" value="<?php echo $number_of_tweets; ?>" /></p>
		
		
		
		<?php
	}
	
	public function update($new_instence,$old_instence){
		$instance = $old_instence;
		
		$instance['title'] = $new_instence['title'];
		$instance['username'] = $new_instence['username'];
		$instance['consumer_key'] = $new_instence['consumer_key'];
		$instance['consumer_secret'] = $new_instence['consumer_secret'];
		$instance['access_token'] = $new_instence['access_token'];
		$instance['access_token_secret'] = $new_instence['access_token_secret'];
		$instance['number_of_tweets'] = $new_instence['number_of_tweets'];
		
		return $instance;
		
	}
	
}
function twitter_feed_widget(){
	register_widget('Twitter_feed');
}
add_action('widgets_init','twitter_feed_widget');
