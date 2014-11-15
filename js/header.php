<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="MPO Educational Travel, Discover the educational side of Travel">
	<meta name="keywords" content="Educational Travel">
	<link href="http://fonts.googleapis.com/css?family=Lato:400,400italic,700|Sorts+Mill+Goudy:400,400italic" rel="stylesheet">
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <?php if(get_field("site_favicon","options")): ?>
    <link rel="icon" type="image/png" href="<?php the_field("site_favicon","options"); ?>" />
    <?php endif; ?>

    <!--from the right one-->
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri();?>/images/apple-touch-icon-57x57-iphone.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri();?>/images/apple-touch-icon-72x72-ipad.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri();?>/images/apple-touch-icon-114x114-iphone4.png">
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>			 

    <!--end the right one-->
	<script>
        var theme_directory = "<?php echo get_template_directory_uri(); ?>";
    </script>
    <?php 
        $costumCss = get_field('custom_css','options');
        if($costumCss)
        {
            echo '<style type="text/css">'.$costumCss.'</style>';
        }
        $costumJavascript = get_field('custom_javascript','options');
        if($costumJavascript)
        {
            echo '<script type="text/javascript">
                jQuery.noConflict();
                (function($) {
                  '.$costumJavascript.'
                })(jQuery);
                </script>';
        }
       ?>

       
       <?php $webFont = get_field('google_fonts','options');
			if($webFont):
				wp_enqueue_style("Content-Font","http://fonts.googleapis.com/css?family=".$webFont['family'], false, "1.0");
		?>
			<style>
				body , input, textarea, .bucketBlog h3, .hasDatepicker, .sbHolder, #addReviewBtn, .bookFormBtnSubmit, .bookFormBtnReset{
					font-family:<?php echo $webFont['family']; ?>!important;
				}
			</style>
		<?php endif;?>	

    	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="body_wrap homepage">
<?php
new_header();
if(is_page_template('template-home.php')):
?>
	<!-- header slider -->
	<div class="header_slider" style="background-image:url(images/pattern_4.png); background-color:#222">
	    	
	        	<div class="slides_container">
	            	
				  	
				  	
				  	<?php 
						if(get_field('home_sliders')):
							$revSliders = get_field('home_sliders');
					   		foreach ($revSliders as $revSlider):
							?>
						  	<div class="slide">
								
								<?php if (preg_match('/(\[.* )(.*?)(\])/', $revSlider['shortcode'], $matches)) {
									putRevSlider($matches[2]);
								}
								else{
									putRevSlider($revSlider['shortcode']);
								}
								?>
						  	</div>
						  <?php endforeach;
						endif;  
					?>
	          	</div>
	          	
	            <div class="pagination_wrap">
	            	<div class="pagination_inner">
					<ul class="pagination">
					<?php foreach ($revSliders as $revSlider):?>
						<li><a><?php echo $revSlider['title'];?></a></li>
		                <?php endforeach;?>
		          	</ul>
	                </div>
	            </div>
	            
	          	<script>
					jQuery(document).ready(function($) {
							$('.header_slider').slides({
								generatePagination: false,
								generateNextPrev: true,
								play: 5000,
								pause: 3500,
								hoverPause: true,
								effect: 'fade',
								crossfade: true,
								preload: true,
								preloadImage: '<?php?>images/loading.gif'
							});
					});
				</script>
	        
	</div>
	<!--/ header slider -->
<?php
 endif;

 ?>
	


  


