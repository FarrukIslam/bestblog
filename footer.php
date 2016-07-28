	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-top">
					<?php dynamic_sidebar('footer_sidebar'); ?>
				</div>
			</div>
			
			<div class="row">
				<div class="copyright">
					<div class="copyright-text col-md-6 col-sm-6 col-xs-12">
						<?php 
							$copy_right_text = get_theme_mod( 'copy_right_text');
		
							if($copy_right_text){
								echo $copy_right_text;
							}
							else{
								echo '© 2016 All Rights Reserved.';
							}
						?>			
											
					</div>
					<div class="theme-author col-md-6 col-sm-6 col-xs-12 text-right">
						<p>
							<?php 
								$theme_author_text = get_theme_mod( 'theme_author_text');
			
								if($copy_right_text){
									echo $theme_author_text;
								}
								else{
									echo 'Design By <a href="#">admin</a>';
								}
							?>			
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>