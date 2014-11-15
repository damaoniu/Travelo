<?php
/** SURGEWP MODS BEGIN **
 *
 * Important, functions included require PHP 5 >= 5.3.0
 *
 * SurgeWP
 * surgewp.com
 *
 * Brad Cavanaugh
 * bradkcavanaugh@gmail.com
 *
 */



// add new client role
add_role(
		'mpo_client',
		__( 'Client' ),
		array(
				'read'         => TRUE,
				'edit_posts'   => FALSE,
				'delete_posts' => FALSE,
		)
);

function create_client_form_post_type() {
	register_post_type( 'client_form',
		array(
			'labels' => array(
				'name' => __( 'Client Forms' ),
				'singular_name' => __( 'Client Form' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
}
add_action( 'init', 'create_client_form_post_type' );

function create_school_post_type() {
	register_post_type( 'school',
		array(
			'labels' => array(
				'name' => __( 'Schools' ),
				'singular_name' => __( 'School' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
}
add_action( 'init', 'create_school_post_type' );


function swp_register_styles() {
		wp_register_style( 'boot_strap', "//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css", 'mpocss' );
		wp_enqueue_style( 'boot_strap' );
		wp_register_style( 'mpo_angularjs_forms', ( get_template_directory_uri()."/css/mpo_angularjs_forms.css" ), 'boot_strap' );
		wp_enqueue_style( 'mpo_angularjs_forms' );
		wp_register_style( 'font_awesome', "//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" );
		wp_enqueue_style( 'font_awesome' );
}

function swp_register_scripts() {
		wp_register_script('pdf_make_js', ( get_template_directory_uri() . "/js/libs/pdfmakejs/pdfmake.js" ), array('jquery'), '0.1.8');
		wp_register_script('vfs_fonts_js', ( get_template_directory_uri() . "/js/libs/pdfmakejs/vfs_fonts.js" ), array('jquery'), '0.1.8');
		wp_register_script('angular_js', "//ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.18/angular.min.js", array('jquery'), '1.3.0-Beta.19', TRUE);
		wp_register_script('angular_js_route', ( get_template_directory_uri() . "/js/libs/angularjs/angular-route.min.js" ), array('jquery', 'angular_js'), '1.3.0-Beta.19', TRUE);
		wp_register_script('angular_js_resource', ( get_template_directory_uri() . "/js/libs/angularjs/angular-resource.min.js" ), array('jquery', 'angular_js'), '1.3.0-Beta.19', TRUE);
		wp_register_script('angular_js_sanitize', ( get_template_directory_uri() . "/js/libs/angularjs/angular-sanitize.min.js" ), array('jquery', 'angular_js'), '1.3.0-Beta.19', TRUE);
		wp_register_script('angular_js_ui_date', ( get_template_directory_uri() . "/js/libs/angularjs/ui-bootstrap-datepicker-tpls.js" ), array('jquery', 'angular_js', 'angular_js_route', 'angular_js_resource'), '1.3.0-Beta.19', TRUE);
		wp_register_script('angular_js_app', ( get_template_directory_uri() . "/js/app.js" ), array('jquery', 'angular_js', 'angular_js_route', 'angular_js_resource'), '1.3.0-Beta.19', TRUE);

		wp_enqueue_script('pdf_make_js');
		wp_enqueue_script('vfs_fonts_js');
		wp_enqueue_script('angular_js');
		wp_enqueue_script('angular_js_route');
		wp_enqueue_script('angular_js_resource');
		wp_enqueue_script('angular_js_sanitize');
		wp_enqueue_script('angular_js_ui_date');
		wp_enqueue_script('angular_js_app');
}


function swp_get_user_info( $sRedirect = FALSE ) {
	if( !is_user_logged_in() ) {
		if( !$sRedirect ) {
			$sRedirect = home_url();
		}

		$redirectUrl = wp_login_url( $sRedirect );

		wp_redirect( $redirectUrl );
		exit();
	} else {
		// get user info
		global $current_user, $swp_current_user;
			get_currentuserinfo();

			$swp_current_user = array(
					'fname' => $current_user->user_firstname,
					'lname' => $current_user->user_lastname,
					'id' => $current_user->ID,
					'isAdmin' => FALSE
				);
	}
}


function swp_redirect_to_forms () {
	global $swp_current_user;

	$args = array(
		'posts_per_page'  => -1,
		'post_type'       => 'client_form',
		// 'meta_query'      => array(
		// 						array(
		// 							'key' => 'clients'
		// 						)
		// 					)
	);

	$pagesArr = array();

	$postsWithClients = new WP_Query($args);
	if( $postsWithClients->have_posts() ):
		while( $postsWithClients->have_posts() ): $postsWithClients->the_post();
			$clientsArr = get_field('clients', get_the_ID(),FALSE);
			if( $clientsArr ) {
				$onceForAdmin = TRUE;
				foreach ($clientsArr as $sID) {
					if((((int)$swp_current_user[id]) === ((int) $sID)) || (current_user_can('edit_posts') && $onceForAdmin)) {
						$onceForAdmin = FALSE;
						$pagesArr[] = array(
							'url' 	=> get_permalink(),
							'title' => get_field('trip_title'),
							'trip_number' => get_field('trip_number')
						);
					}
				}
			} elseif(current_user_can('edit_posts')){
				$pagesArr[] = array(
							'url' 	=> get_permalink(),
							'title' => get_field('trip_title'),
							'trip_number' => get_field('trip_number')
						);
			}
		endwhile;
	endif;


	if(count($pagesArr) === 0){
		wp_redirect( home_url() );
		exit();
	} elseif(count($pagesArr) === 1) {
		wp_redirect( $pagesArr[0]['url'] );
		exit();
	} else {
		$html = '<html><body>';
		foreach ( $pagesArr as $page ) {
			$html .= '<a href="'.$page[url].'">Trip #: '.$page[trip_number].' '.$page[title].'</a><br/>';
		}
		$html .='</body></html>';
		echo $html;
		exit();
	}
}

function swp_post_type_query(){
	global $current_user, $swp_current_user;

	// get id of current page
	$the_id = get_queried_object_id();

	if(get_post_type($the_id) == "client_form" && is_single()){

		// get user info
		swp_get_user_info( get_permalink() );

		// enque styles and scripts
		add_action( 'wp_enqueue_scripts', 'swp_register_styles' );
		add_action( 'wp_enqueue_scripts', 'swp_register_scripts' );

		// if an admin, enque media uploader
		if( current_user_can('edit_posts') ) {
			wp_enqueue_media();
			$swp_current_user['isAdmin'] = TRUE;
		}
	} elseif( strripos( $_SERVER['REQUEST_URI'], "/myforms" ) !== FALSE ) {

		// get user info
		swp_get_user_info( home_url().'/myforms' );

		// redirect to available form page / pages links
		swp_redirect_to_forms();
	}

	return;
}
add_action('wp', 'swp_post_type_query');

function swp_blockusers_init() {

	// //$testPost = $wp_query->post;
	// // $testPost = get_post();
	// // $testVar =
	// // var_dump($testVar);
	// //var_dump($testPost);
	//   exit();

	// show admin bar only for admins and editors
	if (!current_user_can('edit_posts')) {
		add_filter('show_admin_bar', '__return_false');
	}

	// redirect from dash board if not admin or editor
	if ( is_admin() && ! current_user_can( 'edit_posts' ) && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit();
	}
}
add_action( 'init', 'swp_blockusers_init' );

// events - Schedule only once
if( !wp_next_scheduled( 'mpo_events_schedule' ) ) {
	$month = (int) date('m');
	$day = (int) date('j');
	$year = (int) date('Y');
	$init_time = mktime( 8, 0, 0, $month, $day, $year );  // 8am following the day this is first initialized
   wp_schedule_event( $init_time, 'daily', 'mpo_events_schedule' );
}
add_action( 'mpo_events_schedule', 'processmpoevents');

// add_action( 'mpo_events_schedule', 'processmpoevents' );
function processmpoevents() {
	$events_to_process = array();

	$args = array (
		'post_type' 	=> 'client_form',
		'meta_key' 		=> 'event_reminders',
		'fields' 		=> 'ids'
	);

	$query = new WP_Query( $args );

	if( $query->have_posts() ):
		// $today = time();
		$today = strtotime("-12 hours", date("Y-m-d"));
		while( $query->have_posts() ): $query->the_post();
			$the_id = get_the_ID();
			// echo "<pre>";
			// var_dump($the_id);
			// echo "</pre>";
			$eventsArr = get_post_meta( $the_id, 'event_reminders', TRUE);
			if( $eventsArr ){
				$delete_events = array();

				foreach ($eventsArr as $key => $value) {
					$reminder_date = strtotime( $value['reminder_date'] );

					// should reminder be sent
					if( $reminder_date < $today ){

						// push to process
						$events_to_process[] = $value;

						// set to delete
						$delete_events[] = sanitize_title($value['event_title']);
					}
				}

				if( $delete_events ){
					foreach ($delete_events as $event_slug) {
						unset($eventsArr[$event_slug]);
					}
					update_post_meta( $the_id, 'event_reminders', $eventsArr );
				}
			}
		endwhile;
	endif;

	if( $events_to_process ){
		// echo "<pre>";
		$subject = "Your MPO Travel Event Reminder";
		$headers[] = "From: MPO Travel <info@mpoeduc.com>";

		// TODO: Testing, remove
		$headers[] = "Bcc: Brad <bcavanaugh@surgeforward.com>";

		foreach ($events_to_process as $event_to_process ) {
			// var_dump($event_to_process);

			$message = "This is a courtesy reminder from MPO Travel for the following event:\r\n";
			$message .= $event_to_process['event_date'] . " - " . $event_to_process['event_title'] . "\r\n\r\n";
			$message .= "The related forms may be viewed at http://mpoeduc.com/myforms";

			wp_mail( $reminder_email, $subject, $message, $headers );
		}
		// echo "</pre>";
	}
}

class TripForms {

	private static $user_id;
	private static $current_user;
	private static $form_action;
	private static $post_id;
	private static $method;
	private static $user_is_admin;
	private static $current_datetime_obj;

	static function init() {
		self::$method = $_SERVER['REQUEST_METHOD'];

		if( self::$method != "POST" && self::$method != "PUT" )
			return;

		if( empty($_REQUEST['formapi']) )
			return;

		add_action( 'init', array( __CLASS__, 'process_request' ) );
		// self::process_request();
	}

	static function process_request() {
		self::$current_user = wp_get_current_user();

		self::$user_id = self::$current_user->ID;

		self::$user_is_admin = ( current_user_can( 'manage_options' ) );

		self::validate();

		self::$current_datetime_obj = new DateTime();

		if(self::$method == 'POST') {
			if( empty($_REQUEST['formaction']) ) // is a "fetch" request
				self::get_form_data();

			self::$form_action = $_REQUEST['formaction'];

			if( self::$form_action == "lock" ) // request to lock for user editing
				self::try_to_lock();

			if( self::$form_action == "unlock" ) // request to unlock to stop editing
				self::try_to_unlock();

			if( self::$form_action == "addreminder" ) // request to unlock to stop editing
				self::add_reminder();

			if( self::$form_action == "removereminder" ) // request to unlock to stop editing
				self::remove_reminder();
		}

		elseif(self::$method == 'PUT') // is an "update" request
			self::update_form_data();

		self::response('Improper Exit');
		exit('Improper Exit');
	}


	private function response( $message = "Form Processing Error.", $isSuccess = FALSE, $data = FALSE, $locked_info = FALSE ) {

		// header('Content-type: application/json');
		$phpArr = array( 'success' => $isSuccess, 'message' => $message );

		if( is_string( $data ))
			$data = json_decode( $data, TRUE );

		if( $data !== FALSE ){
			$phpArr['data'] = $data;
		}

		if( $locked_info !== FALSE ){
			$phpArr['lockedInfo'] = $locked_info;
		}

		$phpArr['last_updated'] = self::get_time_stamp();

		$jsonString = json_encode( $phpArr );

		exit( $jsonString );
	}


	private function validate() {

		// validate user
		if( !self::$user_id )
			self::response('User is not logged in: '.self::$user_id);

		// verify nonce
		if( !(wp_verify_nonce( $_REQUEST['_swpnonce'], "trip-form") ) )
			self::response( 'Invalid nonce: '.$_REQUEST['_swpnonce'] );

		// verify a post id was received, if so, set
		if( empty($_REQUEST['item']) )
			self::response( 'No post id received.' );
		else
			self::$post_id = $_REQUEST['item'];

		// validate that this user can modify this post
		if( !self::$user_is_admin ) {
			$validUserIdsArr = get_field('clients', self::$post_id, FALSE);
			if( !in_array( self::$user_id, $validUserIdsArr) )
				self::response( 'User not authorized to edit this post.');
		}

		return 1;
	}

	private function set_time_stamp() {
		return ( update_post_meta(self::$post_id, 'last_updated', self::$current_datetime_obj->getTimestamp()) !== FALSE );
	}

	private function get_time_stamp() {
		return get_post_meta(self::$post_id, 'last_updated', TRUE);
	}

	private function get_form_data( $locked_info = FALSE ) {
		$message = "";

		$formData = get_post_meta( self::$post_id, 'formData', TRUE );

		if( !$formData ){
			// initial values
				// room number
				$rooms_arr = array();

				$init_rooms_num = get_field('init_rooms', self::$post_id );

				$i = 0;
				do {
					$rooms_arr[] = array(
							'guests' => array(NULL, NULL, NULL, NULL),
							'isCot' => FALSE
						);
					$i++;
				} while ( $i < $init_rooms_num );

			// construct the main form
			$newDataObj = array(
					'general' => array(
						'created' => self::$current_datetime_obj->getTimestamp()
					),
					'calendar' => array(),
					'participants' => array(
						'lockPending' => FALSE,
						'id_increment' => 0,
						'list' => array()
					),
					'rooming' => array(
						'lockPending' => FALSE,
						'id_increment' => 0,
						'list' => $rooms_arr
					),
					'payment' => array(
						'schedule' => array(),
						'messages' => array(),
						'costOfTrip' => array()
					),
					'events' => array(
						'clientAdded' => array(),
						'adminAdded' => array()
					)
				);

			self::set_time_stamp();


			// $formData = json_encode($newDataObj);


			if( update_post_meta(self::$post_id, 'formData', json_encode($newDataObj)) === FALSE )
				self::response( 'Server error.  Could not create new Form Data.' );

			$formData = $newDataObj;

			$message = "No Data found.  Returned new Object.";

			// exit("newObject");

		} else {
			$message = "Data loaded.";
			$formData = json_decode($formData, TRUE);
		}

		// load values specified in the post
			// dietary
				$dietaryList = get_field('dietary_checkboxes', self::$post_id, FALSE);
				$dietaryArr = explode(",", $dietaryList);

				$newDietaryArr = array();
				foreach ($dietaryArr as $item) {
					$item = trim($item);
					$newDietaryArr[$item] = FALSE;
				}

				$formData['general']['dietary'] = $newDietaryArr;

			// medical
				$medicalList = get_field('medical_checkboxes', self::$post_id, FALSE);
				$medicalArr = explode(",", $medicalList);

				$newMedicalArr = array();
				foreach ($medicalArr as $item) {
					$item = trim($item);
					$newMedicalArr[$item] = FALSE;
				}

				$formData['general']['medical'] = $newMedicalArr;

			// curency
			$formData['general']['currency'] = get_field('currency', self::$post_id);

			// number of students
			$formData['payment']['costOfTrip']['numberOfStudents'] = get_field('number_students', self::$post_id);

			// number of adults
			$formData['payment']['costOfTrip']['numberOfAdults'] = get_field('number_adults', self::$post_id);

			// number of free adults
			$formData['payment']['costOfTrip']['numberFreeAdults'] = get_field('number_free_adults', self::$post_id);

			// number of free students
			$formData['payment']['costOfTrip']['numberFreeStudents'] = get_field('number_free_students', self::$post_id);

			// cost per student
			$formData['payment']['costOfTrip']['costPerStudent'] = get_field('cost_per_student', self::$post_id);

			// cost per adult
			$formData['payment']['costOfTrip']['costPerAdult'] = get_field('cost_per_adult', self::$post_id);

			// adjustments
			$formData['payment']['costOfTrip']['adjustments'] = get_field('adjustments', self::$post_id);

			// isParticipantListLocked
			$formData['participants']['isLocked'] = ( get_field('participants_is_locked', self::$post_id) == "true" ) ? true : false ;
			if( get_field('participants_lock_date', self::$post_id ) ) {
				if( strtotime("+1 day", strtotime(get_field('participants_lock_date', self::$post_id))) < self::$current_datetime_obj->getTimestamp() )
					$formData['participants']['isLocked'] = TRUE;
			}

			// isRoomingListLocked
			$formData['rooming']['isLocked'] = ( get_field('rooming_is_locked', self::$post_id) == "true" ) ? true : false ;
			if( get_field('rooming_lock_date', self::$post_id ) ) {
				if( strtotime("+1 day", strtotime(get_field('rooming_lock_date', self::$post_id))) < self::$current_datetime_obj->getTimestamp() )
					$formData['rooming']['isLocked'] = TRUE;
			}

			// TODO: Testing, remove
			// var_dump($formData);
			// exit();

		self::response( $message, TRUE, $formData, $locked_info );
	}

	private function lock() {
		$f_initial = substr((string) self::$current_user->user_firstname, 0, 1);
		$l_name = (string) self::$current_user->user_lastname;

		$locked_arr = array(
				'locked_by_id' 	=> self::$user_id,
				'f_initial' 	=> $f_initial,
				'l_name' 		=> $l_name,
				'date_time' 	=> self::$current_datetime_obj->getTimestamp()
			);

		if( update_post_meta( self::$post_id, 'swp_locked', $locked_arr ) !== FALSE){
			// set update timestamp
			self::set_time_stamp();

			self::get_form_data( $locked_arr );

			return;
		} else {
			self::response( 'Update of swp_locked returned false.');
		}

		self::response( 'Could not lock file.' );

		return;
	}

	// user want to edit form
	private function try_to_lock() {

		// get current locked status
		$locked_arr = get_post_meta( self::$post_id, 'swp_locked', TRUE );

		if(!$locked_arr) { // not locked or available to lock
			self::lock();
		} else {
			// if the same user, refresh lock
			if($locked_arr['locked_by_id'] == self::$user_id){
				self::lock();
			}

			$lastUpdated = get_post_meta(self::$post_id, 'last_updated', TRUE);
			$expireTime = $lastUpdated + (10 * 60); // add 10 minutes
			$currentTime = self::$current_datetime_obj->getTimestamp();

			// check if it's been over 10 min since last save
			if( $currentTime > $expireTime ){
				// over 10 minutes, unlock
				self::lock();
			} else {
				self::get_form_data($locked_arr);
			}
		}
	}

	// user is done editing the form
	private function try_to_unlock() {

		// get current locked status
		$locked_arr = get_post_meta( self::$post_id, 'swp_locked', TRUE );

		if(!$locked_arr){
			self::response( 'Already unlocked.', TRUE );
		} elseif ($locked_arr['locked_by_id'] == self::$user_id) {
			update_post_meta( self::$post_id, 'swp_locked', array() );
			self::response( 'Unlocked.', TRUE );
		} else {
			self::response( 'Locked by someone else.' );
		}
	}

	private function update_form_data() {
		// get current locked status
		$locked_arr = get_post_meta( self::$post_id, 'swp_locked', TRUE );

		if($locked_arr['locked_by_id'] != self::$user_id) {
			self::response( 'File locked by another user.' );
			return;
		}

		$updatedData = file_get_contents("php://input");

		if($updatedData === FALSE)
			self::response( 'Failed to update data.' );

		if( update_post_meta(self::$post_id, 'formData', $updatedData) !== FALSE ){
			self::set_time_stamp();
			self::response( 'UPDATED.', TRUE );
		} else {
			self::response( 'No Data Change.', TRUE );
		}

		return;
	}

	private function reminder_update_response( $message = FALSE, $is_success = FALSE) {
		$response_arr = array();

		$message = (!!$message)?$message:"Server error processesing reminder add/remove.";

		$response_arr['message'] = $message;
		$response_arr['success'] = $is_success;

		exit(json_encode($response_arr));
	}

	private function add_reminder() {
		if(!isset($_REQUEST['reminderDate']))
			self::reminder_update_response('Missing reminder date.');
		if(!isset($_REQUEST['reminderEventDate']))
			self::reminder_update_response('Missing event date.');
		if(!isset($_REQUEST['reminderTitle']))
			self::reminder_update_response('Missing reminder title.');

		$reminders_arr = get_post_meta( self::$post_id, 'event_reminders', TRUE);
		if(!$reminders_arr)
			$reminders_arr = array();

		$eventTitle = wp_kses((string) $_REQUEST['reminderTitle']);
		$eventDate = wp_kses((string) $_REQUEST['reminderEventDate']);
		$reminderDate = wp_kses((string) $_REQUEST['reminderDate']);;


		// need "teacher's email"
		if( function_exists('get_field')) {
			$reminderEmail = get_field('teacher_e-mail', self::$post_id );
		} else {
			self::reminder_update_response("ACF function not available.");
		}

		if(!$reminderEmail) {
			self::reminder_update_response("Teacher's e-mail not found.");
		}

		$slug = sanitize_title($eventTitle);

		$reminders_arr[$slug] = array(
				'event_title' 		=> $eventTitle,
				'event_date' 		=> $eventDate,
				'reminder_date' 	=> $reminderDate,
				'reminder_email' 	=> $reminderEmail,
			);

		if( update_post_meta(self::$post_id, 'event_reminders', $reminders_arr) !== FALSE )
			self::reminder_update_response("Reminder added.", TRUE);
		else
			self::reminder_update_response("Could not update the post meta values.");

		self::reminder_update_response();
	}

	private function remove_reminder() {
		if(!isset($_REQUEST['reminderDate']) || !isset($_REQUEST['reminderEventDate']) || !isset($_REQUEST['reminderTitle'])){
			self::reminder_update_response('Missing reminder information');
		}

		$reminders_arr = get_post_meta( self::$post_id, 'event_reminders', TRUE);
		if(!$reminders_arr)
			self::reminder_update_response("No reminders found.");

		$eventTitle 	= wp_kses((string) $_REQUEST['reminderTitle']);
		$eventDate 		= wp_kses((string) $_REQUEST['reminderEventDate']);
		$reminderDate 	= wp_kses((string) $_REQUEST['reminderDate']);;
		$reminderEmail 	= $current_user->user_email;

		$slug = sanitize_title($eventTitle);

		unset($reminders_arr[$slug]);

		if( update_post_meta(self::$post_id, 'event_reminders', $reminders_arr) !== FALSE )
			self::reminder_update_response("Reminder removed.", TRUE);
		else
			self::reminder_update_response("Could not update the post meta values.");

		self::reminder_update_response();

	}

}
TripForms::init();

?>