<?php
/*
Template Name:conditions
*/
get_header();
?>
<div id="middle" class="full_width">
	<div class="container_12">
		<div class="content">
			<!--content tanble-->
			<div class="widget-container widget_categories">
				<h3 class="widget-title">Terms and Conditions:</h3>
						<?php 
						$conditions = get_field("new_terms");
						//print_r($conditions);
							if($conditions):
								foreach ($conditions as $condition):
						?>
						<li class="even"><a href="#<?php echo $condition['term_title'];?>" hidefocus="true" style="outline: none;"><span><?php echo $condition['term_title'];?></span></a></li>
						
						<?php
								endforeach;
							endif;
						?>
					</ul>
	                <div class="clear"></div>
			</div>
			<!--/content tanble-->
			<!--content-->
			<div class="row box" id="general">   	
				<?php 
					if($conditions):
						foreach ($conditions as $condition):
				?>
					<div class="row" id="<?php echo $condition['term_title'];?>">
						<h3 class="toggle box" ><?php echo $condition['term_title'];?><span class="ico"></span></h3>
						<div class="toggle_content boxed" style="display: none;">
			            	<p><?php echo $condition['term_content'];?></p>
						</div>
					</div>
					<div class="clear"></div>
				<?php
						endforeach;
					endif;
				?>
			</div>
			<!--/content-->
		</div>
		<div class="clear"></div>  
	</div>
</div>
<div class="clear"></div>
<?php
after_content();
get_footer();
?>