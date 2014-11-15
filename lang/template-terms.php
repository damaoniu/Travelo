<?php
/*
Template Name:Terms
*/
get_header();
?>
<div id="middle" class="full_width">
	<div class="container_12">
		<div class="content">
			<!--content tanble-->
			<div class="widget-container widget_categories">
							<h3 class="widget-title">Terms and Conditions:</h3>
								<ul>
									<?php 
									$terms =get_field("termsandcondtions");
										if($terms):
											foreach ($terms as $term):
									?>
									<li class="even"><a href="#<?php echo $term['term_title'];?>" hidefocus="true" style="outline: none;"><span><?php echo $term['term_title'];?></span></a></li>
									
									<?php
											endforeach;
										endif;
									?>
								</ul>
			                    <div class="clear"></div>
						</div>
			<!--/content tanble-->
			<!--content-->
			<div class="row">
				<?php 
					if($terms):
						foreach ($terms as $term):
				?>
					<h3 class="toggle box" id="<?php echo $term['term_title'];?>"><?php echo $term['term_title'];?><span class="ico"></span></h3>
					<div class="toggle_content boxed" style="display: none;">
		            	<p>E<?php echo $term['term_content'];?></p>
					</div>
				<?php
						endforeach;
					endif;
				?>
			</div>
			<!--/content-->
		</div>
	</div>
</div>
<?php
after_content();
get_footer();
?>