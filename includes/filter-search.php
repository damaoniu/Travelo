<?php
 if(!isset($_SESSION)) 
    { 
		session_start();
	}
function filterSessionStart() {
    if(!session_id()){
        session_start();
    }
}
/* Session for filter */
add_action('init', 'filterSessionStart', 1);
add_action('wp_logout', 'EndSession');
add_action('wp_login', 'EndSession');

function EndSession() {
    session_destroy ();
}

/* Filter */

add_action("init","addCategories");
function addCategories(){
    $filterOptions = get_field('filter_options_attributes', 'options');
        if($filterOptions){
        foreach ($filterOptions as $option)
        {
            if($option["category_name"]){
            $current_cat = "um_".toAscii($option["category_name"]);
            register_taxonomy($current_cat,array (
		          0 => 'tours_post',
                  1=> 'activity',
		        ),array( 'hierarchical' => true, 
                'label' => $option["category_name"],
                'show_ui' => true,'query_var' => true,'singular_label' => $option["category_name"]) );
            }
        }
    }    
}

function toAscii($str) {
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

	return $clean;
}

function printFilter(){
       
        $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-search.php',
                'hierarchical' => 0
        )); 
    ?>
    
    <form method="get" id="filterSearcher" class="form_search" action="<?php echo get_permalink(get_page_by_title($pages[0]->post_title)); ?>" >
        <input type="hidden" name="um_FilterSearch" value="true">
            <div class="search_col_1">
                    <div class="row input_styled checklist">
                        <h6>By Theme:</h6>
                        <br/>
                        <?php 
                             $types= get_terms("um_".toAscii('subjects'),array("hide_empty"=>false));
                             if($types):
                                foreach ($types as $type):
                                    $name="um_".toAscii('subjects');
                            ?>
                        <div class="rowRadio" id="subjects">
                            <input type="checkbox" name="subjects" id="<?php echo $type->slug;?>" value="<?php echo $type->slug;?>" >
                            <label for="<?php echo $type->slug;?>"><?php echo $type->name;?></label>
                        </div>
                        <?php
                                endforeach;
                                endif;
                                
                            ?>
                        
                    </div>
                    
            </div>
                
            <div class="search_col_2">

                    <div class="row">
                        <h6>By City:</h6>
                        <br/>
                        <?php city_autocomplete();?>
                    </div>

                    <div class="row">
                        <h6>Find Your Tour:</h6>
                        <br/>
                        <input type="button" id="searcherButton" value="Search" class="btn btn-find">
                    </div>

                    <div class="row">
                        <h6>By Grade:</h6>
                        <br/>
                        <select name="grade_level" class="select_styled white_select">
                            <option  value="" selected="selected">Choose a grade</option>
                            <?php $grades = get_terms("um_".toAscii('grade_level'),array("hide_empty"=>false));
                                foreach ($grades as $grade):
                            ?>
                                <option name="grade_level" value="<?php echo $grade->slug;?>"><?php echo $grade->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                    <div class="row">
                        <h6>By Number of Days:</h6>
                        <br/>
                        <select name="length" class="select_styled white_select">
                        <option name="length" value="" selected="selected">Choose days</option>
                        <?php $days = get_terms("um_".toAscii('number_of_days'),array("hide_empty"=>false));
                            foreach ($days as $day):
                        ?>
                            <option  value="<?php echo $day->slug;?>"><?php echo $day->name;?></option>
                        <?php endforeach;?>
                        </select>
                    </div>
                   
            </div> 
            <div class="clear"></div>  
        </form>
            
<?php }

function search_filter(){    
    $arg = array (
        'post_type'=>'tours_post',
        'sample_tour' => 'no',
        'posts_per_page' => 10,
        );

    if(isset($_GET['country'])&&!empty($_GET['country'])){
        $country=strtolower($_GET['country']);
        //echo "haha";
        //echo $country;
    }
    if(isset($_GET['city_auto'])&&!empty($_GET['city_auto'])){
        $city=strtolower($_GET['city_auto']);
        if($city=='montréal'){
            $city='montreal';
        }
        //echo $city;
    }else if(isset($_GET['city_auto_new'])&&!empty($_GET['city_auto_new'])){
        $city=strtolower($_GET['city_auto_new']);
    }
    
    if($city&&$country){
        $arg_new=array('um_'.toAscii($country)=>$city);
        $arg=array_merge($arg,$arg_new);
    }
    if(isset($_GET['grade_level'])&&!empty($_GET['grade_level'])){
        $grade=$_GET['grade_level'];
        //echo $grade;
        $arg_new=array ('um_'.toAscii('grade-level')=>$grade);
        $arg=array_merge($arg,$arg_new); 
    }
    if(isset($_GET['length'])&&!empty($_GET['length'])){
        $length=$_GET['length'];
        //echo $length;
        $arg_new=array ('um_'.toAscii('number-of-days')=>$length);
        $arg=array_merge($arg,$arg_new);
    }
    if(isset($_GET['subjects'])&&!empty($_GET['subjects'])){
        $subjects=$_GET['subjects'];
        //$subjects=implode(",",$subjects);
        //echo $subjects;
        $arg_new=array ('um_'.toAscii('subjects')=>$subjects);
        $arg=array_merge($arg,$arg_new);
    }
    if(isset($_GET['price'])&&!empty($_GET['price'])){
        $price=$_GET['price'];
        $arg_new=array ('um_'.toAscii('price')=>$price);
        $arg=array_merge($arg,$arg_new);
    }

    global $paged;
    
    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }//echo "paged"; }
    elseif ( get_query_var('page') ) { $paged = get_query_var('page');} //echo "page"; }
    else { $paged = 1; }//echo "la paged =1 la";}  
    $arg_new= array('paged' => $paged);  
    $arg=array_merge($arg,$arg_new);
    return $arg;
}


?>