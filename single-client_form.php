<?php
/*
Custom Post Type Template for 'client_form'
SurgeWP
surgewp.com
Brad Cavanaugh
bcavanaugh@surgewp.com
*/



 get_header(); the_post(); ?>

<!-- header contains <body><div class="body_wrap homepage"> -->
<!-- FOR TESTING RESPONSIVE GRID BREAKS -->
	<?php $swp_domain = $_SERVER['SERVER_NAME'];
		if( strripos($swp_domain, '.dev') ) {
	?>
		<style>
			#bs-responsive-testing {
				position:fixed;
				width: 200px;
				top: 75px;
				right: calc(50% - 100px);
				color:white;
				padding: 2px;
				font-size: 20px;
				text-align:center;
				z-index:1900;
			}
			#wpadminbar {
				z-index: 500 !important;
			}
			#bs-responsive-testing .visible-xxs {
				display: none;
			}
			@media only screen and (max-width: 479px) {
				#bs-responsive-testing .visible-xxs {
					display: inline-block;
				}
				#bs-responsive-testing .visible-xs {
					display: none !important;
				}
			}
		</style>

		<div id="bs-responsive-testing">
			<span class="visible-xxs" style="background:RED">--XXS GROUP --</span>
			<span class="visible-xs" style="background:YELLOW;color:BLACK;">--XS GROUP--</span>
			<span class="visible-sm" style="background:ORANGE">--SM GROUP--</span>
			<span class="visible-md" style="background:BROWN">--MD GROUP--</span>
			<span class="visible-lg" style="background:GREEN">--LG GROUP--</span>
		</div>
<!-- END RESPONSIVE TESTING SECTION -->
<?php } ?>

<!-- FORM WRAPPER -->
	<script type="text/javascript">
		<?php
			$swp_request_uri = $_SERVER['REQUEST_URI'];
			$swp_template_url = get_template_directory_uri().'/partials/';

			if(isset($_GET["clientview"]))
				$swp_is_admin = FALSE;
		?>
		var swpFormObj = {};
		swpFormObj.baseUrl = '<?= $swp_request_uri ?>';
		swpFormObj.baseTemplateUrl = '<?= $swp_template_url ?>';
		swpFormObj.tripPostId = '<?= get_the_ID() ?>';
		swpFormObj.security = '<?php echo wp_create_nonce("trip-form"); ?>';
		swpFormObj.userId = <?php echo ($swp_current_user["id"] >= 0)?$swp_current_user[id]:"false"; ?>;
		swpFormObj.isAdmin = <?php echo($swp_current_user["isAdmin"])?"true":"false"; ?>;
		swpFormObj.isClientView = <?php echo(isset($_GET["clientview"]))?"true":"false"; ?>;
		swpFormObj.pageIntros = {};
		swpFormObj.addEventUrl = {};
		swpFormObj.pageIntros['start'] 			= '<?= str_replace( array("\r", "\n"), "", get_field("intro_start")) ?>';
		swpFormObj.pageIntros['participants'] 	= '<?= str_replace( array("\r", "\n"), "", get_field("intro_participants")) ?>';
		swpFormObj.pageIntros['dietary'] 		= '<?= str_replace( array("\r", "\n"), "", get_field("intro_dietary")) ?>';
		swpFormObj.pageIntros['rooming'] 		= '<?= str_replace( array("\r", "\n"), "", get_field("intro_rooming")) ?>';
		swpFormObj.pageIntros['pay'] 			= '<?= str_replace( array("\r", "\n"), "", get_field("intro_pay")) ?>';

		<?php $schoolId = get_field("school_information")->ID; ?>

		swpFormObj.tripDetails = {
			school: "<?= get_field( 'school_name', $schoolId ) ?>",
			tripContact: {
				name: "<?= get_field( 'trip_contact_name' ) ?>",
				phone: "<?= get_field( 'teacher_phone' ) ?>",
				email: "<?= get_field( 'teacher_e-mail' ) ?>",
			},
			tripTitle: "<?= get_field( 'trip_title' ) ?>",
			tripNumber: "<?= get_field( 'trip_number' ) ?>",
			startDate: new Date("<?php
				$startDate = get_field( 'start_date' );
				$startDateFormatted = substr( $startDate, 0, 4 ) .'-'. substr( $startDate, 4, 2 ) .'-'. substr( $startDate, 6, 2 );
				echo $startDateFormatted;
			?>"),
			endDate: new Date("<?php
				$endDate = get_field( 'end_date' );
				$endDateFormatted = substr( $endDate, 0, 4 ) .'-'. substr( $endDate, 4, 2 ) .'-'. substr( $endDate, 6, 2 );
				echo $endDateFormatted;
			?>"),
		};


		swpFormObj.getTemplateUrl = function(template){
			var url = swpFormObj.baseTemplateUrl;
			if(swpFormObj.isAdmin)
				url+="admin-";
			else
				url+="client-";
			url+=template;
			if(swpFormObj.isClientView)
				url+="?clientview";
      		return url;
		};
		if(!swpFormObj.baseUrl || !swpFormObj.baseTemplateUrl) {
			alert("A base URI is not set.");
			window.location.href('/');
		}
	</script>


	<div id="mpoapp" ng-app="mpoApp">

	    <div id="mpo-travel-form" class="container" ng-controller="MainController as main">

	    	<div class="row swp-header">
	    		<div class="col-xs-6 swp-client-info swp-breadcrumbs">
	    			<?php if($swp_current_user["isAdmin"]): ?>
		    			<div id="swp-view-options">
		    				<a ng-class="{active : !main.temp.clientView }" href="<?= get_permalink() ?>">Administrator View</a> | <a ng-class="{ active : main.temp.clientView }" href="<?= get_permalink() . '?clientview' ?>">Client View</a>
		    			</div>
	    			<?php endif; ?>
	    		</div>
	    		<div class="col-xs-6 swp-client-info text-right">
	    			<?php
	    				if($swp_current_user) :
	    					echo $swp_current_user['fname'] . " " . $swp_current_user['lname'];
	    					echo " | ";
	    					echo '<a href="'.wp_logout_url().'">Sign out</a>';
	    				endif;
	    			?>
	    		</div>
	    	</div>
	    	<div class="row">
	    	</div>

	    	<div class="mpo-form-navigation">
	    		<ul class="nav nav-tabs nav-justified" role="tablist">
	    			<li ng-class="{ active : main.page.current == 'start' }"><a ng-click="main.page.navigate('start')"><i class="fa fa-flag"></i> Start</a></li>
	    			<li ng-class="{ active : main.page.current == 'participants' }"><a ng-click="main.page.navigate('participants')"><i class="fa fa-users"></i> Participants</a></li>
	    			<li ng-class="{ active : main.page.current == 'dietmed' }"><a ng-click="main.page.navigate('diet-med')"><i class="fa fa-file-text"></i> Dietary / Medical</a></li>
	    			<li ng-class="{ active : main.page.current == 'rooming' }"><a ng-click="main.page.navigate('rooming')"><i class="fa fa-building"></i> Rooming List</a></li>
	    			<li ng-class="{ active : main.page.current == 'pay' }"><a ng-click="main.page.navigate('pay-schedule')"><i class="fa fa-tasks"></i> Payment Schedule</a></li>
				</ul>
	    	</div>

	    	<div class="mpo-form-wrapper">
	    		<div class="mpo-form-subwrapper">



		    		<!-- LOADING MESSAGE -->
		    			<div id="mpo-loading-message" ng-hide="!main.page.loadingMessage" ng-init="main.page.loadingMessage='LOADING...'">
		    				<div style="position:relative;height:100%;">
		    					<div style="position:absolute;height:100%;width:100%;display:table;">
		    						<div style="display:table-cell;vertical-align:middle; text-align:center;" ng-bind="main.page.loadingMessage">
		    						</div>
		    					</div>
		    				</div>
		    			</div>




			    	<!-- CONFIRM OVERLAY -->
				    	<div id="confirm-overlay" ng-class="{ active : main.temp.displayConfirm }" ng-click="main.btnCancelAction()">
				    	</div>

		    		<!-- CONFIRM MESSAGE -->
		    			<div id="mpo-confirm-message" ng-class="{ active : main.temp.displayConfirm }">
		    				<div class="mpo-dialog-title">MPO Travel Forms</div>
		    				<div class="mpo-dialog-text" ng-bind-html="main.temp.confirmMessage"></div>
		    				<div id="mpo-dialog-timer" ng-if="main.temp.timer">
		    					<span ng-bind="main.temp.timer"></span>
		    				</div>
		    				<div id="confirm-dialog" ng-class="{ active : main.temp.displayConfirm }">
		    					<div class="button-wrapper" ng-class="{ 'single' : !main.temp.btnCancelAction }" style="float:left;">
		    						<button style="display:inline-block;" class="btn btn-default" ng-if="main.temp.btnOkAction" ng-click="main.btnOkAction()">OK</button>
		    					</div>
		    					<div class="button-wrapper" ng-class="{}" style="float:right;">
		    						<button style="display:inline-block;" class="btn btn-default" ng-if="main.temp.btnCancelAction" ng-click="main.btnCancelAction()">Cancel</button>
		    					</div>
		    					<div style="clear:both;"></div>
		    				</div>
		    			</div>




		    		<!-- QUICK MESSAGE -->
		    			<div id="mpo-delay-message" class="mpo-lower-message" ng-class="{ active : main.temp.quickMessage }">
		    				<span ng-bind-html="main.temp.quickMessage"></span>
		    			</div>
		    		<!-- DELAY MESSAGE -->
		    			<div id="mpo-quick-message" class="mpo-lower-message" ng-class="{ active : main.temp.delayMessage }">
		    				<span ng-bind-html="main.temp.delayMessage"></span>
		    			</div>





		    		<!-- HELPER MENU -->
		    			<div id="mpo-helper-menu">
		    				<div ng-if="main.page.showSave" id="helper-menu-save" class="helper-menu-item">
		    					<a class="pointer" ng-click="main.updateForm('button')"><i class="fa fa-save"></i>save</a>
		    				</div>
		    				<div ng-if="main.page.showDownload" id="helper-menu-download" class="helper-menu-item">
		    					<a class="pointer" ng-click="main.openPdf()"><i class="fa fa-download"></i>pdf / print</a>
		    				</div>
		    				<!-- <div ng-if="main.page.showPrint" id="helper-menu-print" class="helper-menu-item">
		    					<a class="pointer"><i class="fa fa-print"></i>print</a>
		    				</div> -->
		    				<div ng-if="main.page.showHelp" id="helper-menu-help" class="helper-menu-item">
		    					<a class="pointer" ng-click="main.displayHelp()"><i class="fa fa-question-circle"></i>help</a>
		    				</div>
		    				<div style="clear:both;"></div>
		    			</div>

		    		<!-- MAIN CONTENT INSERTION -->
			    		<div ng-view>
			    			<!-- CONTENT -->
			    		</div>

	    				<div style="clear:both;"></div>
	    		</div>
	    		<div style="clear:both;"></div>
	    	</div>

	    	<!-- FOOTER NAVIGATION -->
		    	<div class="row mpo-footer-nav" ng-class="{ active : (!main.page.quickMessage && !main.page.loadingMessage) }">
		    		<div class="col-xs-6 col-xxs pull-right">
		    			<div ng-if="main.page.nextTitle != false" class="text-left">
		    				<button class="btn btn-navigation" ng-click="main.page.navigate('next')">{{ main.page.nextTitle }} <i class="fa fa-angle-double-right"></i></button>
		    			</div>
		    		</div>
		    		<div class="col-xs-6 col-xxs pull-left">
		    			<div ng-if="main.page.prevTitle != false" class="text-right">
		    				<button class="btn btn-navigation" ng-click="main.page.navigate('prev')"><i class="fa fa-angle-double-left"></i> {{ main.page.prevTitle }}</button>
		    			</div>
		    		</div>
		    		<div class="col-xs-12 col-xxs text-right" style="margin-top:10px;">
	    				<small ng-bind="'Last Updated: '+main.temp.lastUpdated"></small>
		    		</div>
		    		<div class="col-xs-12 col-xxs text-right" style="margin-top:0px;">
		    			<small ng-show="main.temp.formLocked">Form is currently <strong>Locked</strong> by you for editing. | <a class="pointer" ng-click="main.unlockForm()">Manually Unlock</a></small>
		    			<small ng-show="!main.temp.formLocked">You have not locked this form for editing. | <a class="pointer" ng-click="main.lockForm()">Manually Lock</a></small>
		    		</div>

		    	</div>

	    	<!-- TODO: testing, remove  -->
	    	<!-- <div>
	    		<pre>
	    			{{ main.formData | json }}
	    		</pre>
	    	</div> -->
	    	<!-- END TODO -->


	    </div>

	</div>
	<div style="clear:both;"></div>
<!-- END FORM WRAPPER -->

<?php
	after_content();
	get_footer();