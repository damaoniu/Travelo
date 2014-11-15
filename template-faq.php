<?php
/*
Template Name:FAQ
*/
get_header();
$questions=get_field("frequent_questions");
?>

<div id="middle" class="full_width">
	<div class="container_12">
		<div class="content">
			<div class="widget-container widget_categories">
				<h3 class="widget-title">Frequent asked Questions & Answers:</h3>
					<ul>
						
						<li class="even"><a href="#teachers" hidefocus="true" style="outline: none;"><span>For Teachers</span></a></li>
						<li class="even"><a href="#parents" hidefocus="true" style="outline: none;"><span>For Parents</span></a></li>
						<li class="even"><a href="#students" hidefocus="true" style="outline: none;"><span>For Students</span></a></li>
						
					</ul>
                    <div class="clear"></div>
			</div>
			<!--/content tanble-->
			<!--question and answer-->
			<div class="post_detail">
				<!--For Teachers-->
				<div class="row" id="teachers">
					<h3>For Teachers</h3>
			     <?php 
			     	$questions=get_field("for_teachers");
			     	$count=0;
					if($questions):
						foreach ($questions as $question):
							$count++;
				?>  
				                 	
                <div class="faq_question toggle" ><span class="faq_q"><?php echo $count;?> Q:</span><span class="faq_title"><?php echo $question['question_title'];?></span> <span class="ico"></span></div>
            	<div class="faq_answer toggle_content" style="display: none;">
            	<p><?php echo $question['question_content'];?></p>
				</div>

				<?php
						endforeach;
					endif;
				?>
				</div>
				<!--For Teachers-->
				<!--For parents-->
				<div class="row" id="parents">
					<h3>For Parents</h3>
			     <?php 
			     	$questions=get_field("for_parents");
			     	$count=0;
					if($questions):
						foreach ($questions as $question):
							$count++;
				?>  
				                 	
                <div class="faq_question toggle" ><span class="faq_q"><?php echo $count;?> Q:</span><span class="faq_title"><?php echo $question['parents_question_title'];?></span> <span class="ico"></span></div>
            	<div class="faq_answer toggle_content" style="display: none;">
            	<p><?php echo $question['parents_question_content'];?></p>
				</div>

				<?php
						endforeach;
					endif;
				?>
				</div>
				<!--For parents-->
				<!--For students-->
				<div class="row" id="students">
					<h3>For Students</h3>
			     <?php 
			     	$questions=get_field("for_students");
			     	$count=0;
					if($questions):
						foreach ($questions as $question):
							$count++;
				?>  
				                 	
                <div class="faq_question toggle" ><span class="faq_q"><?php echo $count;?> Q:</span><span class="faq_title"><?php echo $question['students_question_title'];?></span> <span class="ico"></span></div>
            	<div class="faq_answer toggle_content" style="display: none;">
            	<p><?php echo $question['students_question_content'];?></p>
				</div>

				<?php
						endforeach;
					endif;
				?>
				</div>
				<!--For Students-->
			</div>
			<!--question and answer-->
			<div class="clear"></div>
        </div>
        <div class="clear"></div>  
    </div>
</div>   
<div class="clear"></div>      
<?php
after_content();
get_footer();
?>