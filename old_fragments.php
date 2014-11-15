<!--header-->		
	<div class="header">
	  <div class="container_12">
	  		<div class="logo">
	  			<a href="www.mpoeduc.com">
		     	<img src="http://localhost/projects/mpoeduc/wp-content/uploads/2013/10/logo-good.gif ">
	            <p><strong>Discover the Educational Sive of Travel with MPO!</strong></p>
	            </a>
	            <h1>MPO Educational Travel</h1>
		    </div> 
		    <div class="header_right">
		        <?php search_form();?> 
	            
	            <!--<div class="toplogin">
		        	<p><a href="#">SIGN IN</a> <span class="separator">|</span> <a href="#">REGISTER</a></p>
		        </div>-->    
	            
	            <div class="header_phone">
		        	<p>CALL US NOW: &nbsp; <strong class="telephone">: 1-888-MPO-EDUC (676-3382)</strong></p>
		        </div>	        
		        
	            <div class="clear"></div>
	        </div>
	        <?php wp_nav_menu(array(
				'theme_location'  => '',
				'menu'            => 'main_menu',
				'container'       => 'div',
				'container_class' => 'topmenu',
				'container_id'    => '',
				'menu_class'      => 'dropdown',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			));?>
			<div class="clear"></div>
	            
	    </div><!-- end container-->
	</div><!--end header-->