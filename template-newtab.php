<?php
/*
Template Name: New tabs
*/
get_header();
get_search_form();
?>
<div class="newcontent stepsBody">
  <form method="ppost" action="" id="inform">  
    <div class="tabHolder">
        <div class="tabsWrapper">

            <div class="tabs" id="tabs-0" style="width:940px;">
                <div class="tabsHeader">
                    <h2 class="tab tabHeaderActive">1: Information &Intenary >></h2>
                    <h2 class="tab tabHeaderPasive">2: Destination & Activit >></h2>
                    <h2 class="tab tabHeaderPasive">3: Transportation & Lodgin >></h2>
                    <h2 class="tab tabHeaderPasive">Review quote</h2>
                </div>
                <div class="tabsBody tabsHeaderActive">
                    <div style="display:block;">
                    <div  class="newLeft" >
                      <div class="leftInform">
                                <table class="table-hover">
                                    <strong><h2>Who you are? </h2></strong>
                                    <tr>
                                        <td>School/company/Organization*:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="school" placeHolder="required" value='<?php echo $_POST['school'];?>'/></td>
                                    </tr>
                                    <tr>
                                        <td>Contact Name*:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="contact" placeHolder="required"/></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Contact Phone number*:</strong></td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="phone" placeHolder="required"/></td>
                                    </tr>
                                    <tr>
                                        <td>Email*:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="email" placeHolder="required"/></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Full address:</strong> stree name:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="address"/></td>
                                    </tr>
                                    <tr>
                                        <td>City:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="city"/></td>
                                    </tr>
                                    <tr>
                                        <td>Province/State:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="state" /></td>
                                    </tr>
                                    <tr>
                                        <td >Country:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="country" size="10"/></td>
                                    </tr>
                                    <tr>
                                        <td>Post Code:</td>
                                        <td><input type="text" class="bookInputFieldsTwo" name="postcode" size="10"/></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Give a name to your trip:</strong></td>
                                        <td><input type="text" class="bookInputFieldsTwo" id="tripName" name="tripName"></td>
                                    </tr>
                                </table>  
                        </div> 
                        <div class="rightInform">
                                <table class="table-condensed">
                                    <h4>Your travel Information</h4>
                                    <tr>
                                        <td>       
                                            <label for="from">Leaving</label> 
                                            <input type="text" id="from" class="bookInputFieldsThree" name="from" size="10" />
                                        </td>
                                        <td>
                                            <label for="to">Returning</label>
                                            <input type="text" id="to" class="bookInputFieldsThree" name="to"  size="10"/>
                                        </td>
                                    
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="0"/> I don't know
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Time of the Years:</label>
                                            </td>
                                        <td>
                                            <input list="season" name="season" class="bookInputFieldsThree" size="10"><datalist id="season">
                                            <option value="Spring">
                                            <option value="Summer">
                                            <option value="Autumn">
                                            <option value="Winter">
                                        </datalist>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="children">Number of children:</label>
                                        </td>
                                        <td>
                                            <input id="children" value="0" size="5" name="children" class="spinner bookInputFieldsThree" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="adult">Number of adults:</label>
                                        </td> 
                                        <td>
                                             <input id="adult" value="0" size="5" name="adult" class="spinner bookInputFieldsThree"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="age">Average Age of Students:</label>
                                        </td>
                                        <td>
                                            <input id="age" value="0" size="5" name="age" class="spinner bookInputFieldsThree"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="grade">Grade Level:</label>
                                        </td>
                                        <td>
                                            <input id="grade" value="0" size="5" name="grade" class="spinner bookInputFieldsThree"/>
                                        </td>
                                    </tr>
                                </table> 
                                <button type="button" id="informQuote" name="Quote" class="bookFormBtnSubmit" />Request a quote</button>
                            </div>
                    </div>
                    </div>
                    <div style="display:none;">
                        <div name="left-cities" class="newLeft" >
                        <h4>Choose your destinations and drage them into order!</h4>
                        <div id="tabs-0" class="tabs">
                            <div class="tabsHeader">
                                <h3 class="tab tabHeaderActive">US Destinations</h3>
                                <h3 class="tab tabHeaderPasive">Canada Destinations</h3>
                                <h3 class="tab tabHeaderPasive">International Destinations</h3>
                            </div>

                            <div class="tabsBody tabHeaderActive">
                              <div style="display:block;" id="us" name="city">
                                    <h5>Cities in US</h5>
                                    
                                        <div>
                                            <?php $tourCategories = get_field('filter_options_attributes','options');?>
                                            <?php if($tourCategories):?>
                                                <?php foreach ($tourCategories as $tax): ?>
                                                
                                                <span class="btn btn-default btn-sm">
                                                    <input  type="checkbox" name="US_city[]" value="<?php echo $tax['category_name']; ?>"><span><?php echo $tax['category_name']; ?></span>
                                                </span>
                                                
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>

                              </div>
                                
                             
                              <div style="display:none;" id="canada" name="city">
                                    <h5>Cities in Canada</h5>
                                    
                                        <div>
                                            <?php $tourCategories = get_field('filter_options_attributes','options');?>
                                            <?php if($tourCategories):?>
                                                <?php foreach ($tourCategories as $tax): ?>
                                                
                                                <span class="btn btn-default btn-sm">
                                                    <input  type="checkbox" name="Canada_city[]" value="<?php echo $tax['category_name']; ?>"><span><?php echo $tax['category_name']; ?></span>
                                                </span>
                                                
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                              </div>

                                
                               
                              <div style="display:none;" id="other">
                                <h5> International Cities</h5>
                                <div>
                                <?php $tourCategories = get_field('filter_options_attributes','options');?>
                                            <?php if($tourCategories):?>
                                                <?php foreach ($tourCategories as $tax): ?>
                                                
                                                <span class="btn btn-default btn-sm">
                                                    <input  type="checkbox" name="Other_city[]" value="<?php echo $tax['category_name']; ?>"><span><?php echo $tax['category_name']; ?></span>
                                                </span>
                                                
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                </div>

                              </div>
                             
                        </div>
                        </div>
                        <div >
                            <h4> The cities you have chosen, drag them into the right order</h4>
                            <ul id="chosenCity">
                            <li id="test" name="chosen" class="chosen ui-state-default">hah</li>
                            </ul>
                          
                                  
                        </div>
                        <div name="right-activities" class="newLeft">
                            <div class="stepsBody last">
                                <p>Some <span name="activity"><strong>Activities</strong></span> You want to do:<textarea type="text" id="customActivity" name="activity" class="bookInputFields"></textarea></p>
                            </div>
                            <div class="hiddenActivity termsAndConditions">
                              <p><strong>this is a popup activity</strong></p>
                            </div>

                        </div>
                        
                        <button type="button" id="informQuote2" name="Quote" class="bookFormBtnSubmit" />Request a quote</button>
                   
                    </div>
                        
                    </div>
                    <div style="display:none;">
                    <div  class="newLeft" >
                      <div id="tabs=-0" class="tabs">
                        <div class="tabsHeader">
                            <h4 class="tab taHeaderActive">Hotel >></h4>
                            <h4 class="tab taHeaderPasive">Transportation >></h4>
                            <h4 class="tab taHeaderPasive">Meals >></h4>
                            <h4 class="tab taHeaderPasive">Tour Director</h4>
                         </div>
                         <div class="tabsBody">
                            <div style="display:block;" id="hotel">
                                <table class="table table-hover">
                                    <tr><td><h4> Type of Hotel:</h4></td></tr>
                                    <tr><td>Hotel:</td></tr>
                                    <tr><td><td><input type="radio" name="hotel" value="2 and half Stars"/>2 and half Stars</td></td></tr>
                                    <tr><td><td><input type="radio" name="hotel" value="3 and half Stars"/>3 and half Stars</td></td></tr>
                                    <tr><td><td><input type="radio" name="hotel" value="4 and half Stars"/>4 and half Stars</td></td></tr>
                                    <tr><td><td><input type="radio" name="hotel" value="Youth Hotel"/>Youth Hotel</td></td></tr>
                                    <tr><td>Students Rooms:</td></tr>
                                    <tr><td><td><input type="radio" name="student_rooms" value="Double"/>Double<br/></td></td></tr>
                                    <tr><td><td><input type="radio" name="student_rooms" value="Quad"/>Quad</td></td></tr>
                                    <tr><td>Adults Rooms:</td></tr>
                                    <tr><td><td><input type="radio" name="adults_rooms" value="Single"/>Single</td></td></tr>
                                    <tr><td><td><input type="radio" name="adults_rooms" value="Double"/>Double</td></td></tr>

                                </table>
                            </div>
                            <div style="display:none;" id="transport">
                                <table class="table table-hover">
                                    <tr><td><h4> Transportation:</h4></td></tr>
                                    <tr><td>Air:</td></tr>
                                    <tr><td><td><input type="radio" name="air" value="Yes"/>Yes</td></td></tr>
                                    <tr><td><td><input type="radio" name="air" value="No"/>No</td></td></tr> 
                                    <tr><td>Type of Bus:</td></tr>
                                    <tr><td><td><input type="radio" name="bus" value="Coach Only"/>Coach Only</td></td></tr>
                                    <tr><td><td><input type="radio" name="bus" value="School Bus Only"/>School Bus Only</td></td></tr>
                                    <tr><td><td><input type="radio" name="bus" value="Both"/>Both</td></td></tr>
                                    <tr><td>Other Transportation that could be used:</td></tr>
                                    <tr><td><td><input type="radio" name="otherTrans" value="Public"/>Public (Subway)</td></td></tr>
                                    <tr><td><td><input type="radio" name="otherTrans" value="Taxi"/>Taxi</td></td></tr>
                                    <tr><td><td><input type="radio" name="otherTrans" value="Train"/>Train</td></td></tr>
                                </table>
                            </div>
                            <div id= "meals" style="display:none;">
                                <table  class="table table-hover">
                                    <tr><td><h4> Meals:</h4></td></tr>
                                    <tr><td><input type="radio" name="meals" value="No Meals"/>No Meals</td></tr>
                                    <tr><td><input type="radio" name="meals" value="Standard"/>Standard</td></tr>
                                    <tr><td></td><td>Breakfast</td></tr>
                                    <tr><td></td><td>Lunch</td></tr>
                                    <tr><td></td><td>Supper (3 Choices)</td></tr>
                                    <tr><td><input type="radio" name="meals" id="buffet" value="Buffet"/>Buffet</td></tr>
                                    <tr><td><td><input disabled="disabled" type="radio" name="buffet" value="Every Meal"/>Every Meal</td></td></tr>
                                    <tr><td><td><input disabled="disabled" type="radio" name="buffet" value="Some Meals"/>Some Meals</td></td></tr> 
                                    <tr><td><input type="radio" name="meals" value="Dinner Theater"/>Dinner Theater</td></tr>
                                    <tr><td><input type="radio" name="meals" value="Thematic Meals"/>Thematic Meals</td></tr>
                                </table>
                            </div>
                            <div id= "guide" style="display:none;"> 
                                <table class="table table-hover">
                                    <tr><td><h4> Tour Directour:</h4></td></tr>
                                    <tr><td><input type="radio" name="guide" value="Yes"/>Yes</td></tr>
                                    <tr><td><input type="radio" name="guide" value="No"/>No</td></tr>
                                    <tr><td>Night security</td></tr>
                                    <tr><td><input type="radio" name="secure" value="Yes"/>Yes</td></tr>
                                    <tr><td><input type="radio" name="secure" value="No"/>No</td></tr>
                                    <tr><td>Language of the Tour</td></tr>
                                    <tr><td><input type="checkbox" name="language[]" value="English"/>English</td></tr>
                                    <tr><td><input type="checkbox" name="language[]" value="French"/>French</td></tr> 
                                    <tr><td><input type="checkbox" name="language[]" value="Other"/>Other</td></tr>
                                    <tr><td>Insurance</td></tr>
                                    <tr><td><input type="radio" name="insurance" value="Yes"/>Yes</td></tr>
                                    <tr><td><input type="radio" name="insurance" value="No"/>No</td></tr>
                                </table>
                            </div> 
                        </div>
                        <button type="button" id="informQuote3" name="Quote" disabled="disabled"  class="bookFormBtnSubmit"/> disabled Request a quote</button>
                      </div>
                    </div>
                    </div>
                    <div style="display:none;">
                        <div  id="myQuote" calss="newLeft">
                                <h4><b> Your tour:<?php echo $_POST['tripName'];?></b></h4>
                                <table>
                                    <tr><td>School/company/Organization:</td> <td><span id="schoolR"></span></td></tr>
                                    <tr><td>Name:</td> <td><span id="nameR"></span></td></tr>
                                    <tr><td>Phone:</td> <td><span id="phoneR"></span></td></tr>
                                    <tr><td>Email:</td> <td><span id="emailR"></span></td></tr>
                                     <tr><td>Children:</td><td><span id="childrenR"></span></td></tr>
                                    <tr><td>Adults:</td> <td><span id="adultR"></span></td></tr>
                                    


                                </table>

                                <div class="submitNew">
                                    <form method="post" action="" id="sendQuote">
                                    <?php $checkForTerms = get_field('terms_and_conditions','options');
                                    if($checkForTerms):?>
                                    <div class="termsText"><input name="um_checkTerms" id="um_checkTerms" type="checkbox"><p id="terms"><?php the_field('terms_and_conditions_short_text','options');?></p></div>
                                    <?php else:?>
                                    <input type="hidden"  name="um_checkTerms" id="um_checkTerms" value="TRUE"/> 
                                    <?php endif;?>
                                    <input type="hidden" name="um_submitted" value="true" />
                                    <input type="button"  class="bookFormBtnSubmit" name="Quote" value="Send quote"/>
                                    <input type="reset" class="bookFormBtnReset" name="reset" value="Reset"/>
                                    </form>
                                </div>
                                 
                                <div id="quoteResponse"></div>    
                        </div><!-- END myQuote -->
                    </div>

                </div>
            </div>
        </div>
    </div>
  </form>
</div>
                
  <?php get_footer(); ?>
               

