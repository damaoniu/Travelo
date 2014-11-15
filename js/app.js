(function(){
  var mpoApp = angular.module("mpoApp", [
	'ngRoute',
	'mpoControllers',
	]);
   // Local Routes
	mpoApp.run( function() {
	  // alert(swpFormObj.baseUrl);
	}).config(['$routeProvider', '$locationProvider',
		function($routeProvider, $locationProvider) {
			$routeProvider.
				// Start/Intro Page
				when('/', {
					templateUrl: swpFormObj.getTemplateUrl('start.php'),
					controller: 'StartController'
				}).
				// Participants Listing page
				when( '/participants', {
					templateUrl: swpFormObj.getTemplateUrl('participants.php'),
					controller: 'ParticipantsController'
				}).
				// Dietary and Medical Needs Page
				when('/diet-med', {
					templateUrl:swpFormObj.getTemplateUrl('diet-med.php'),
					controller: 'DietmedController'
				}).
				// Rooming Arrangements Page
				when('/rooming', {
					templateUrl: swpFormObj.getTemplateUrl('rooming.php'),
					controller: 'RoomingController'
				}).
				// Payment Schedule Page
				when('/pay-schedule', {
					templateUrl: swpFormObj.getTemplateUrl('pay-schedule.php'),
					controller: 'PayController'
				}).
				// catch to redirect to start
				otherwise({
					redirectTo: '/'
				});

			// $locationProvider.html5Mode(true);
	}]);
})();

// controllers
( function() {
	var mpoControllers = angular.module("mpoControllers", [
	  'ngRoute',
	  'ngSanitize',
	  'mpoServices',
	  'ui.bootstrap',
	  // 'mpoFilters'
	])
	.controller('MainController', ['$rootScope', '$scope', '$route', '$sce', '$http', '$filter', '$location', '$timeout', '$interval', '$parse', '$anchorScroll', 'FormData',
		function( $rootScope, $scope, $route, $sce, $http, $filter, $location, $timeout, $interval, $parse, $anchorScroll, FormData ) {
		// init
		$this = this;

		this.page = {
			showSave: true, // bool TODO: move to each page setting
			showDownload: true, // bool TODO: move to each page setting
			showPrint: true, // bool TODO: move to each page setting
			showHelp: true,
			loadingMessage: "LOADING...",
			formDirty: false,
			intro: swpFormObj.pageIntros.start,
			participants: swpFormObj.pageIntros.participants,
			dietary: swpFormObj.pageIntros.dietary,
			rooming: swpFormObj.pageIntros.rooming,
			pay: swpFormObj.pageIntros.pay,
			navigate: function( sNav ){
				// TODO: trigger save if dirty forms
				var sNav = sNav || '';
				var navigateTo;

				// get desired page
				if( sNav == "next" ){
					navigateTo = $this.page.nextLocation;
				} else if( sNav == "prev" ) {
					navigateTo = $this.page.prevLocation;
				} else {
					navigateTo = sNav;
				}

				// save if form is dirty
				if($this.page.formDirty) {
					return $this.updateForm('auto', function( err, data ) {
						if( err )
							return console.log("Error returned from save.");

						return $location.path( "/" + navigateTo );
					});
				} else {
					return $location.path( "/" + navigateTo );
				}
			}
		};

		this.temp = {
			adminMode : swpFormObj.isAdmin,
			clientView : swpFormObj.isClientView,
			formLocked : false,
			userId : swpFormObj.userId,
			event: {
				isReminder : false
			},
			adminEvent : {
				isReminder : false
			},
			addPaySchedule : {},
			eventSort : 'date',
			timer : false, 					// int - counting of confirm timer
			stopTime : false, 				// promise - confirm timer
			formTimeout : (1000 * 60 * 5), 	// form edit timer in seconds, timesout if no saves within this time
			delayTimeout : false,  			// promise - delay message only
			delayMessage : false,
			quickMessage: false,
			confirmMessage: false,
			displayConfirm: false,
			btnOkAction: false,
			btnCancelAction: false,
		};

		this.temp.kit = {};

		this.formData = {};

		this.formConstants = {};
		this.formConstants.types = ["list-form", "checkpoint", "payment", "other"];
		this.formConstants.roomTypes = ["Male Room", "Female Room"];
		this.formConstants.pageLinks = [
			{
				"name" : "Checklist",
				"url" : "//" + window.location.host + swpFormObj.baseUrl + "#/"
			},
			{
				"name" : "Participants",
				"url" : "//" + window.location.host + swpFormObj.baseUrl + "#/participants"
			},
			{
				"name" : "Dietary/Medical",
				"url" : "//" + window.location.host + swpFormObj.baseUrl + "#/diet-med"
			},
			{
				"name" : "Rooming List",
				"url" : "//" + window.location.host + swpFormObj.baseUrl + "#/rooming"
			},
			{
				"name" : "Payment Schedule",
				"url" : "//" + window.location.host + swpFormObj.baseUrl + "#/pay-schedule"
			}
		];

		this.formConstants.tripDetails = swpFormObj.tripDetails;

		FormData.fetch({item:swpFormObj.tripPostId}, function ( resp ) {
			// TODO: testing, remove
			// var test = [];
			// for (var key in resp) {
			//   if (resp.hasOwnProperty(key)) {
			//     test.push(resp[key]);
			//   }
			// }
			// console.log( test.join("") );

			// attach to view
			if( resp.success && resp.data ) {
				$this.formData = $this.processFormData(resp.data);

				if( resp.last_updated )
					$this.temp.lastUpdated = ( new Date(resp.last_updated * 1000) ).toLocaleTimeString();

				$this.formConstants.medical = $this.formData.general.medical;
				$this.formConstants.dietary = $this.formData.general.dietary;

				// populate defaults if they do not exist
					if(!$this.formData.kits)
						$this.formData.kits = [];

					if(!$this.formData.events)
						$this.formData.events = {};
			} else {
				console.log("Error Loading Server Data.");
				console.log(resp);
				return false;
			}

			$timeout( function() { // slight delay for page transition
				return $this.page.loadingMessage = false;
			}, 500 );
		});

		$scope.$on('$routeChangeSuccess', function(event, toState, toParams, fromState, fromParams){
			console.log("ROUTE CHANGE");
			// move to top of form
			$location.hash('mpo-travel-form');
	        $anchorScroll();
		});

		this.openPdf = function() {
			var personObj = false;
			if( arguments[0] )
				personObj = arguments[0];

			//var logoDataUrl = 
			// var headerMargins = 0;
			// var footerMargins = 0;
			var headerMargins = 10;
			var footerMargins = 10;
			var pageMargins = [ 40, 40, 40, 20 ];
			// var pageMargins = 0;
			var dateNow = $filter('date')( new Date(), 'fullDate');
			var docDefinition = {};

			var TripDetails = function() {
				var startDate = $filter('date')( $this.formConstants.tripDetails.startDate, 'yyyy/MM/dd');
				var endDate = $filter('date')( $this.formConstants.tripDetails.endDate, 'yyyy/MM/dd');
				return [
					{ columns : [
						{
							columns : [
								{ stack: [
										{ text: "School", style: 'headerTwo' },
										$this.formConstants.tripDetails.school
									]},
								{stack: [
										{ text: "Trip Title", style: 'headerTwo' },
										$this.formConstants.tripDetails.tripTitle
									]},
								{stack: [
										{ text: "Trip Number", style: 'headerTwo' },
										$this.formConstants.tripDetails.tripNumber
									]},
							]
						},
					], margin: [0, 0, 0, 10] },
					{ columns : [
						{
							columns : [
								{ stack: [
										{ text: "Trip Contact", style: 'headerTwo' },
										$this.formConstants.tripDetails.tripContact.name
									]},
								{stack: [
										{ text: "Phone", style: 'headerTwo' },
										$this.formConstants.tripDetails.tripContact.phone
									]},
								{stack: [
										{ text: "E-mail", style: 'headerTwo' },
										$this.formConstants.tripDetails.tripContact.email
									]},
							]
						},
					], margin: [0, 0, 0, 10] },
					{ columns : [
						{
							columns : [
								{ stack: [
										{ text: "Start Date", style: 'headerTwo' },
										startDate
									]},
								{stack: [
										{ text: "End Date", style: 'headerTwo' },
										endDate
									]},
								{ text: "" },
							]
						},
					], margin: [0, 0, 0, 10] },
				];
			};

			var CheckList = function() {
				var contentArr = [
					{ text: "Check List", style: 'headerOne' },
					{ table: {
						headerRows: 1,
						widths: [ 'auto', '*', 'auto', ],
						body: [
							[ 'Date', 'Task', 'Completed?'],
						]
					} }
				];

				var events = $filter('orderBy')( $this.getAllEvents(), 'date' );

				angular.forEach( events, function( value ) {
					var isComplete = ( value.isComplete )?"Yes":"";
					contentArr[1].table.body.push([ value.date, value.name, isComplete ]);
				});

				return contentArr;
			};

			var Template = function() {
				return {
					header: {
						columns: [
							{
								//text: "MPO Travel",
								// margin: [ 0, 20, 0, 0]
								
								//stopped working, unsure why
								image : "mpoLogo",
								fit: [ 25, 40 ]
								//margin: [ 0, 20, 0, 0]
								
							},
							{
								text: '',
								// width: '*',
								alignment: 'right',
								// margin: [ 0, 20, 0, 0]
							}
						],
						margin: headerMargins,
						height: 50
					},
					footer: {
						text: "http://mpoeduc.com/myforms",
						alignment: "center"
					},
					content: [
					],
					styles: {
						headerOne: {
							fontSize: 22,
							bold: true
						},
						headerTwo: {
							fontSize: 16,
							bold: true
						}
					},
					images: {
						mpoLogo: "data:image/png;base64,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" +
				"ccllPAAAAABJRU5ErkJggg=="
					},
					pageMargins: pageMargins,
				};
			};

			var ParticipantsList = function() {
				var contentArr = [
					{ text: "Participants", style: 'headerOne' },
					{ table: {
						headerRows: 1,
						widths: [ 30, 100, 100, '*', 100, 100, 60, 60 ],
						body: [
							[ { text: '#', alignment: 'center'}, 'First Name', 'Middle Name', 'Last Name', "DOB", "Nationality", "Gender", "Type"],
						]
					} }
				];

				var participants = $filter('orderBy')( $this.formData.participants.list, 'name.last' );

				angular.forEach( participants, function( v, k ) {
					var value = JSON.parse(JSON.stringify( v )) || {};
					value.name = value.name || {};
					value.name.first = value.name.first || "";
					value.name.middle = value.name.middle || "";
					value.name.last = value.name.last || "";

					if( value.dob )
						value.dob = $filter('date')( value.dob, 'yyyy-MM-dd' );
					else
						value.dob = "";

					value.nationality = value.nationality || "";
					value.gender = value.gender || "";
					value.type = value.type || "";
					contentArr[1].table.body.push([ { text: (k + 1).toString(), alignment: 'center' }, value.name.first, value.name.middle, value.name.last, value.dob, value.nationality, value.gender, value.type ]);
				});

				var totalParticipants = participants.length;
				var totalMaleStudents = ($filter('filter')( participants, { type: "Student", gender: "Male" }, true )).length;
				var totalFemaleStudents = ($filter('filter')( participants, { type: "Student", gender: "Female" }, true )).length;
				var totalAdults = ($filter('filter')( participants, { type: "Adult" }, true )).length;

				var totals = [
					{ text: ("Total Number of Participants: " +  totalParticipants), margin: [0,10], style: 'headerTwo' },
					{ text: ("# of Male Students: " +  totalMaleStudents) },
					{ text: ("# of Female Students: " +  totalFemaleStudents) },
					{ text: ("# of Adults: " +  totalAdults) },
				];
				contentArr.push( totals );

				console.log( contentArr[1].table.body );

				return contentArr;
			};

			var DietAndMedical = function( oP ) {

				var oParticipant = $this.roomingNameFormat(oP);

				var contentArr = [
					{ text: oParticipant, style: 'headerOne' },
					{ text: "Medical Information", margin: [0,0,0,10] },
				];

				function addGroupItems(itemsArr) {
					var LineItem = function() {
						return {
							columns : [
								{ text: "" },
								{ text: "" },
								{ text: "" },
							],
							margin : [ 0,0,0,10]
						};
					}

					var count = 0;
					var lineItem;

					angular.forEach( itemsArr, function( v, k ) {
						if( count % 3 === 0 ){
							if(lineItem){
								contentArr.push(lineItem);
							}
							lineItem = new LineItem();
						}
						var prefix = (itemsArr[k] === true )?" X ":"___";
						lineItem.columns[ count % 3 ] = { text: prefix + "   " + k };
						count++;
					});

					if(lineItem) {
						contentArr.push(lineItem);
					}
				}

				var medicalItems = oP.medicalList;
				var dietaryItems = oP.dietaryList;
				var medicalOther = oP.medicalOther || "\n";
				var dietaryOther = oP.dietaryOther || "\n";

				addGroupItems( medicalItems );
				contentArr.push( { text: "Other: " + medicalOther, margin: [0,0,0,20] } );

				contentArr.push({ text: "Dietary Information", margin: [0,0,0,10] }),
				addGroupItems( dietaryItems );
				contentArr.push( { text: "Other: " + dietaryOther } );

				console.log( contentArr );

				return contentArr;
			};

			var DietAndMedicalFull = function() {
				var contentArr = [
					{ table: {
						headerRows: 1,
						widths: [ '*' ],
						body: [
							[ { text: 'Participants - Diet and Medical', alignment: 'center'} ],
						]
					} }
				];

				var participants = $filter('orderBy')( $this.formData.participants.list, 'name.last' );

				angular.forEach( participants, function( v, k ) {
					var value = JSON.parse(JSON.stringify( v )) || {};
					var text = $this.roomingNameFormat( value ) + "\n";

					var first = true;
					angular.forEach( value.medicalList, function( v, k ) {
						if( v === true ) {
							if( first ){
								first = false;
							} else {
								text += ", ";
							}
							text += k;
						}
					} );

					if( value.medicalOther ){
						text += "\nMedical Other: " + value.medicalOther;
					}

    				first = true;
					angular.forEach( value.dietaryList, function( v, k ) {
						if( v === true ) {
							if( first ){
								first = false;
							} else {
								text += ", ";
							}
							text += k;
						}
					});

					if( value.dietaryOther ){
						text += "\nDietary Other: " + value.dietaryOther;
					}

					contentArr[0].table.body.push( [ { text: text } ] );
				});

				var totalParticipants = participants.length;

				var totals = [
					{ text: ("Total Number of Participants: " +  totalParticipants), margin: [0,10], style: 'headerTwo' }
				];
				contentArr.push( totals );

				// console.log( contentArr[1].table.body );

				return contentArr;
			};

			var RoomingList = function() {
				var contentArr = [
					{ text: "Rooms", style: 'headerOne' },
					{ table: {
						headerRows: 1,
						widths: [ 30, 40, "*", "*", "*", "*", "*" ],
						body: [
							[ { text: '#', alignment: 'center'}, 'Type', 'Guest 1', 'Guest 2', "Guest 3", "Guest 4", "Cot"],
						]
					},
					margin: [0,0,0,10] }
				];


				var rooms = JSON.parse(JSON.stringify($this.formData.rooming.list));

				angular.forEach( rooms, function( value, k ) {
					var rmNumber = (k + 1).toString() || "n/a";
					var rmType = value.roomType || "n/a";

					if(rmType == "Male Room")
						rmType = "Male";
					if(rmType == "Female Room")
						rmType = "Female";

					var guest = [];
					var cot;

					angular.forEach( value.guests, function( id, guestNum ) {
						if( id === null ){
							guest[guestNum] = "No Guest";
							return;
						}

						guest[guestNum] = $this.getParticipantFormattedNameById(id);
					});

					if( value.isCot && value.cotId !== null ){
						cot = $this.getParticipantFormattedNameById( value.cotId );
					} else {
						cot = "n/a";
					}

					contentArr[1].table.body.push([ { text: rmNumber, alignment: 'center' }, rmType, guest[0], guest[1], guest[2], guest[3], cot ]);
				});

				var totalRooms = rooms.length;

				var totals = [
					{ text: ("Total Number of Rooms: " +  totalRooms ), style: 'headerTwo' },
				];

				contentArr.push( totals );

				console.log( contentArr[1].table.body );

				return contentArr;
			};

			var PaymentItems = function() {
				var costOfTrip = $this.formData.payment.costOfTrip;
				var payArr = [
					{ text: "Payment Schedule", style: 'headerOne' },
					{ table: {
						headerRows: 1,
						widths: [ 30, '*', '*', '*' ],
						body: [
								[ { text: '#', alignment: 'center' }, { text: 'Due Date', alignment: 'center' }, { text: 'Per Person', alignment: 'center' }, { text: 'Deposit Due', alignment: 'center' } ],
							]
						}, margin: [0,0,0,10] },
					{ text: "Payment Schedule", style: 'headerOne' },
					{ table: {
						headerRows: 1,
						widths: [ 70, '*' ],
						body: [
							[ 'Date', 'Message' ],
						]
					}, margin: [0,0,0,10] },
					{ text: "Participants Summary", style: 'headerOne' },
					{ text: "Number of Students: " + costOfTrip.numberOfStudents },
					{ text: "", margin: [0,0,0,10] },
					{ text: "Number of Adults: " + costOfTrip.numberOfAdults },
					{ text: "", margin: [0,0,0,10] },
					{ text: "Total Number of Participants: " + $this.getTotalParticipants(costOfTrip), margin: [0,0,0,10] },
					{ text: "Cost Summary", style: 'headerOne' },
					{ text: "Cost of Trip per Student: " + $filter('currency')( costOfTrip.costPerStudent, '$' ) + " (" + $this.formData.general.currency + ")" },
					{ text: "Cost of Trip per Adult: " + $filter('currency')( costOfTrip.costPerAdult, '$' ) + " (" + $this.formData.general.currency + ")" },
					{ text: "Subtotal for Students (" + $this.totalPaying( costOfTrip, 'student') + "): " + $filter('currency')( $this.getTripTotal( costOfTrip, 'student'), '$' ) },
					{ text: "Subtotal for Adults (" + $this.totalPaying( costOfTrip, 'adult') + "): " + $filter('currency')( $this.getTripTotal( costOfTrip, 'adult'), '$' ) },
					{ text: "", margin: [0,0,0,10]},
					{ text: "Total Cost of the Trip: " + $filter('currency')( $this.getTripTotal(costOfTrip), '$' ), style: 'headerOne' },
				];

				if(costOfTrip.numberFreeStudents){
					payArr[6].text = "Number of Free Students: " + costOfTrip.numberFreeStudents;
				} else {
					payArr[6].text = "";
				}

				if(costOfTrip.numberFreeAdults){
					payArr[8].text = "Number of Free Adults: " + costOfTrip.numberFreeAdults;
				} else {
					payArr[8].text = "";
				}

				if(costOfTrip.adjustments){
					payArr[15].text = "Adjustments: " + $filter('currency')( costOfTrip.adjustments, '$' ) + " (" + $this.formData.general.currency + ")";
				} else {
					payArr[15].text = "";
				}

				var paySch = $filter('orderBy')( $this.formData.payment.schedule, 'number' );

				angular.forEach( paySch, function( value ) {
					var number = value.number || "n/a";
					var dueDate = $filter('date')( value.dueDate, 'yyyy-MM-dd') || "n/a";
					var amtPerPerson;
					var amtDue;

					if(!value.amtPerPerson)
						amtPerPerson = "n/a";
					else
						amtPerPerson = $filter('currency')( value.amtPerPerson, '$' ) + " (" + $this.formData.general.currency + ")";

					if(!value.amtDue)
						amtDue = "n/a";
					else
						amtDue = $filter('currency')(value.amtDue, '$') + " (" + $this.formData.general.currency + ")";

					payArr[1].table.body.push([ { text: number.toString(), alignment: 'center' }, { text: dueDate, alignment: 'center' }, { text: amtPerPerson, alignment: 'center' }, { text: amtDue, alignment: 'center' } ]);
				});

				var cklist = $filter('orderBy')( $this.formData.payment.messages, 'date' );

				angular.forEach( cklist, function( value ) {
					var date = $filter('date')( value.date, 'yyyy/MM/dd') || "n/a";
					var text = value.text || "n/a";
					payArr[3].table.body.push([ date, text ]);
				});

				return payArr;
			};

			var startPage = function() {
				var doc = new Template();
				var tripDetails = new TripDetails();
				var checkList = new CheckList();

				doc.header.columns[1].text = "Checklist";
				doc.content.push( tripDetails );
				doc.content.push( checkList );

				console.log(doc);
				return doc;
			};

			var participantsPage = function() {
				var doc = new Template();
				var participantsList = new ParticipantsList();

				doc.pageOrientation = 'landscape';
				doc.header.columns[1].text = "Participants";
				doc.content.push( participantsList );

				console.log(doc);
				return doc;
			};

			var dietmedPage = function() {
				// if(!$this.selectedParticipant) {
				// 	$this.confirmMessage("You must select a participant before printing.");
				// 	return false;
				// }

				var doc = new Template();
				var dietAndMedical;

				if( personObj ){
					dietAndMedical = new DietAndMedical( personObj );
				} else {
					dietAndMedical = new DietAndMedicalFull();
				}

				doc.pageOrientation = 'landscape';
				doc.header.columns[1].text = "Diet and Medical";
				doc.content.push( dietAndMedical );

				console.log(doc);
				return doc;
			};

			var roomingPage = function() {
				var doc = new Template();
				var roomingList = new RoomingList();

				doc.pageOrientation = 'landscape';
				doc.header.columns[1].text = "Rooming";
				doc.content.push( roomingList );

				console.log(doc);
				return doc;
			};

			var payPage = function() {
				var doc = new Template();
				var paymentItems = new PaymentItems();

				// doc.pageOrientation = 'landscape';
				doc.header.columns[1].text = "Payment Schedule & Summary";
				doc.content.push( paymentItems );

				console.log(doc);
				return doc;
			};

			if(!$this.page.current)
				return false;

			switch($this.page.current) {
				case "start":
					docDefinition = startPage();
					break;
				case "participants":
					docDefinition = participantsPage();
					break;
				case "dietmed":
					docDefinition = dietmedPage();
					break;
				case "rooming":
					docDefinition = roomingPage();
					break;
				case "pay":
					docDefinition = payPage();
					break;
			}

			// console.log(docDefinition);
			if(docDefinition) {
				return pdfMake.createPdf(docDefinition).open();
				// for debugging
				// return pdfMake.createPdf(docDefinition).download();
			} else {
				return console.log("Print Error");
			}
		};

		this.getParticipantFormattedNameById = function( nId ){
			console.log(nId);
			var oParr = $filter('filter')( $this.formData.participants.list, { id: nId }, true );
			console.log(oParr[0]);
			return $this.roomingNameFormat(oParr[0]);
		};

		this.upperCaseString = function( string ){
			return string.charAt(0).toUpperCase() + string.substring(1);
		};

		this.displaySelectedParticipant = function( oParticipant ){
			if(!oParticipant) // data not loaded
				return;

			var oParticipant = oParticipant;

			oParticipant.name = oParticipant.name || {};
			oParticipant.name.first = oParticipant.name.first || "BLANK";
			oParticipant.name.last = oParticipant.name.last || "BLANK";
			oParticipant.gender = oParticipant.gender || "Unspecified Gender";

			var html = "<h3>" + oParticipant.name.first + " ";
			if(oParticipant.name.middle)
				html += oParticipant.name.middle.charAt(0) + ". ";
			html += oParticipant.name.last + "</h3>";
			html += "<div>";
			if(oParticipant.type == "Student"){
				html += oParticipant.gender + " - ";
			}
				html += oParticipant.type + "</div>";
			return html;
		};

		this.testFunction = function(){
			console.log("test function called");
		};

		this.addPaySchedule = function( oSchedule ) {
			var schedule = {
				number : oSchedule.number,
				dueDate : oSchedule.dueDate,
				amtPerPerson : oSchedule.amtPerPerson,
				amtDue : oSchedule.amtDue,
			};
			$this.formData.payment.schedule.push( schedule );
			$this.updateForm();
			$this.temp.addPaySchedule = {};
		};

		this.removePaySchedule = function( oSchedule ) {
			var iScheduleItem = $this.formData.payment.schedule.indexOf( oSchedule );
			if(iScheduleItem != -1 ){
				this.formData.payment.schedule.splice( iScheduleItem, 1 );
				$this.updateForm();
			}
		}

		this.addReminder = function(oReminder) {

			var data = {
				item:swpFormObj.tripPostId,
				rd : oReminder.reminderDate,
				red : oReminder.reminderEventDate,
				rt : oReminder.reminderTitle,
			};

			FormData.addreminder(data, function ( resp ) {
				console.log(resp);
				if(resp.success) {
					$this.confirmMessage("Reminder Added!");
				} else {
					$this.confirmMessage("Could not create Reminder.<br />Please try again later.");
				}
			});
		};

		this.removeReminder = function(oReminder) {
			var data = {
				item:swpFormObj.tripPostId,
				rd : oReminder.reminderDate,
				red : oReminder.reminderEventDate,
				rt : oReminder.reminderTitle,
			};

			FormData.removereminder(data, function ( resp ) {
				console.log(resp);
				if(resp.success) {
					$this.confirmMessage("Reminder removed!");
				} else {
					$this.confirmMessage("Could not remove associated reminder.");
				}
			});
		};

		this.processFormData = function( oData ){
			var participants = [];
			angular.forEach( oData.participants.list, function(value){
				if(value.dob){
					value.dob = new Date(value.dob);
				}
				this.push(value);
			}, participants);
			oData.participants.list = participants;
			return oData;
		};

		this.quickMessage = function( sMessage ) {
			$this.temp.quickMessage = sMessage;
		};

		// only for one type of message
		this.delayMessage = function( sMessage, nSeconds ){
			var nSeconds = nSeconds || 2;
			$this.temp.delayMessage = sMessage;
			$this.temp.delayTimeout = $timeout( function() {
				$this.temp.delayMessage = false;
			}, (nSeconds * 1000));
		};

		this.confirmMessage = function( sMessage, oButtons, nTimer ) {
			var oButtons = oButtons || {};

			if( $this.temp.btnOkAction ) {
				$this.btnOkAction();
			} else if ( $this.temp.btnCancelAction ){
				$this.btnCancelAction();
			}

			if( nTimer ) {
				$this.temp.timer = nTimer;
				var updateTimer = function() {
					if($this.temp.timer <= 0){
						$this.btnOkAction();
						$this.temp.timer = false;
					}

					if($this.temp.timer)
						$this.temp.timer = --$this.temp.timer;
				};
				$this.temp.stopTime = $interval( updateTimer, 1000 );
			}

			$this.temp.confirmMessage = sMessage || "Confirm";

			// set buttons / actions
			$this.temp.btnOkAction = oButtons.ok || true;
			$this.temp.btnCancelAction = oButtons.cancel || false;

			// display confirm
			$this.temp.displayConfirm = true;
		}

		this.btnCancelAction = function() {
			if(!$this.temp.btnCancelAction)
				return $this.btnOkAction();

			if($this.temp.stopTime){
				$interval.cancel($this.temp.stopTime);
				$this.temp.timer = false;
			}

			// clear in case new action calls them
			$this.temp.displayConfirm = false;
			$this.temp.confirmMessage = false;

			// parse cancel action and run
			if($this.temp.btnCancelAction === true){
				$this.temp.btnOkAction = false;
				return $this.temp.btnCancelAction = false;
			}

			var action = $parse($this.temp.btnCancelAction);
			action($this);
		}

		this.btnOkAction = function() {
			// clear in case new action calls them
			$this.temp.displayConfirm = false;
			$this.temp.confirmMessage = false;

			if($this.temp.stopTime) {
				$interval.cancel($this.temp.stopTime);
				$this.temp.timer = false
			}

			// parse ok action and run
			if($this.temp.btnOkAction === true) {
				$this.temp.btnCancelAction = false;
				$this.temp.btnOkAction = false;
				return true;
			}

			if($this.temp.btnOkAction) {
				var action = $parse($this.temp.btnOkAction);
				$this.temp.btnOkAction = false;
				$this.temp.btnCancelAction = false;
				action($this);
				return true;
			}
		}

		this.groupFilter = function( oParticipant ) {
			if( oParticipant.type == "Adult" )
				return "Adult";
			if( oParticipant.type == "Student" ){
				if( oParticipant.gender == "Female" )
					return "Student : Female";
				if( oParticipant.gender == "Male" )
					return "Student : Male";
			}

			return "Unspecified Type/Gender";
		};

		this.roomingNameFormat = function( oParticipant ) {
			if(!oParticipant) // data not loaded
				return;

			var oParticipant = oParticipant;

			oParticipant.name = oParticipant.name || {};
			oParticipant.name.first = oParticipant.name.first || "BLANK";
			oParticipant.name.last = oParticipant.name.last || "BLANK";

			var name = oParticipant.name.last + ", ";

			name += oParticipant.name.first;
			if( oParticipant.name.middle )
				name += " " + oParticipant.name.middle.charAt(0) + ".";
			return name;
		}

		this.lockForm = function( cb ) {

			if($this.temp.formLocked){
				if(cb)
					return cb(null, "Already Locked.");
				return true;
			}

			$this.quickMessage("Locking Form to Allow for Edits.<br/>Please wait.");

			var success = function() {
				$this.temp.formLocked = true;
				$this.timerFormEdit();
				$this.delayMessage( "Success.<br />Continue edits.");
				$this.quickMessage( false );
				return true;
			};

			var error = function( sMessage ) {
				var sMessage = sMessage || "File already locked or unavailable for edits.";
				$this.confirmMessage( sMessage );
				$this.quickMessage( false );
				return false;
			}

			return FormData.lock({item:swpFormObj.tripPostId}, function ( resp ) {
				// TODO: testing, remove
				console.log( resp );

				if( !resp.success ) {
					// handle error
					if( cb ){
						$this.quickMessage( false );
						return cb( { message : "Failed to Lock Form." } );
					} else {
						return error();
					}
				} else if ( resp.success ) {
					if(resp.lockedInfo) {
						if( resp.lockedInfo.locked_by_id === $this.temp.userId ) {
							if(cb) {
								$this.quickMessage( false );
								return cb(null, "Locked.");
							}

							return success();
						} else {
							// reload route
							if( resp.data )
								$this.formData = $this.processFormData(resp.data);

							$route.reload();
							// form is locked by someone else, display
							var message = "Form currently unavailable for edits.<br/>";
								message += "Locked by: " + resp.lockedInfo.f_initial + ". " + resp.lockedInfo.l_name + "<br />";
								message += "Locked on: " + (new Date(resp.lockedInfo.date_time * 1000)).toLocaleTimeString() + "<br />";
								message += "Last updated: " + ( new Date(resp.last_updated * 1000) ).toLocaleTimeString();

							$this.quickMessage( false );

							$this.confirmMessage( message );

							if( cb )
								return cb( { message : "Locked by another user." } );
						}
					} else {
						if( resp.data )
							$this.formData = $this.processFormData(resp.data);

						$route.reload();

						if( cb ){
							$this.quickMessage( false );
							return cb( { message : "Failed to Lock Form: No lock information received" } );
						}

						return error();
					}
				}
			});
		};

		this.unlockForm = function( err ) {
			if( err ) {
				console.log(err);
				return false;
			}

			console.log("unlock form called.");

			$this.quickMessage("Unlocking form.<br />Please wait.");

			var success = function() {
				if( $this.temp.lockTimer )
					$timeout.cancel( $this.temp.lockTimer );
				$this.temp.formLocked = false;
				$this.delayMessage( "Success.<br />Form unlocked.");
				$this.quickMessage( false );
				return true;
			};
			var error = function( sMessage ) {
				var sMessage = sMessage || "File could not be unlocked.";
				$this.confirmMessage( sMessage );
				$this.quickMessage( false );
				return false;
			}

			return FormData.unlock({item:swpFormObj.tripPostId}, function ( resp ) {
				// TODO: testing, remove
				console.log( resp );

				if( !resp.success ) {
					// handle error
					return error();
				} else if( resp.success ) {
					return success();
				}
			});
		};

		$scope.$watch('main.page.formDirty', function( dirty ){
			// if 'value change' but not to dirty OR form is already locked, return
			if(!dirty || $this.temp.formLocked)
				return;

			// try to lock the form on the server-end
				$this.lockForm();
	  	}, true);

		this.getFileType = function( sFileUrl ) {
			var fileType = "blank";
			var fileTypeString = sFileUrl.split('.').pop();
			var availableFileIcons = ['pdf', 'doc','zip','img','png','gif','xls','ppt','pps','txt'];

			angular.forEach(availableFileIcons, function(value,key){
				if(fileTypeString.indexOf(value) != -1) {
					return fileType = value;
				}
			});

			return fileType;
		}

		this.getCount = function( sTopic ){
			if(sTopic == 'rooms'){
				if(!$this.formData.rooming)
					return false;
				return $this.formData.rooming.list.length;
			}

			if(sTopic == 'participants'){
				if(!$this.formData.participants)
					return false;
				return $this.formData.participants.list.length;
			}

			return false;
		};

		this.updateCount = function( sTopic ){
			if(sTopic == 'rooms'){
				if(!$this.formData.rooming)
					return false;
				return ($this.temp.roomCount = $this.formData.rooming.list.length);
			}

			if(sTopic == 'participants'){
				if(!$this.formData.participants)
					return false;
				return ($this.temp.participantCount = $this.formData.participants.list.length);
			}

			return false;
		}

		this.add_participant = function() {
			$this.formData.participants.list.push({
				id: $this.formData.participants.id_increment++,
				cancelled: false,
				medicalList: $this.formConstants.medical,
				dietaryList: $this.formConstants.dietary,
			});
			$this.updateCount('participants');
		};

		this.remove_participant = function( iParticipant ) {
			$this.formData.participants.list.splice( iParticipant, 1 );
			$this.updateCount('participants');
			$this.updateForm();
		};

		this.add_room = function() {
			$this.formData.rooming.list.push({
				id: $this.formData.rooming.id_increment++,
				guests : [null,null,null,null],
			});
			$this.updateCount('rooms');
		}

		this.remove_room = function( iRoom ) {
			$this.formData.rooming.list.splice( iRoom, 1 );
			$this.updateCount('rooms');
			$this.updateForm();
		}

		this.addNewKit = function( kitObj ) {

			var kitObj = kitObj || {};

			if(!kitObj.url || !kitObj.name)
				confirmMessage("Missing Title or Name");

			$this.formData.kits.push(kitObj);

			$this.temp.kit = {};

			$this.updateForm();
		};

		this.deleteKit = function( oKit ) {
			var iKit = this.formData.kits.indexOf( oKit );
			if(iKit != -1 ){
				this.formData.kits.splice( iKit,1);
				$this.updateForm();
			}
		};

		this.addMedia = function( sType, sBtnId ) {
			var main = $this;

			wp.media.editor.send.attachment = function(props, attachment) {
				main.temp[sType].url = attachment.url;
				return $scope.$apply();
			};

			wp.media.editor.open( jQuery( '#' + sBtnId ) );
		};

		this.addPayMessage = function( oMessage ) {
			if(!oMessage)
				var oMessage = {};

			if(!oMessage.date || !oMessage.text)
				return $this.confirmMessage("Missing date or message.");

			var newMessage = {
				date : oMessage.date,
				text : oMessage.text,
				title : oMessage.title,
				url : oMessage.url,
			};

			$this.formData.payment.messages.push( newMessage );

			$this.updateForm();

			$this.temp.messageItem = {};
		};

		this.removePayMessage = function( oMessage ) {
			var iMessage = this.formData.payment.messages.indexOf( oKit );
			if( iMessage != -1) {
				this.formData.payment.messages.splice( iMessage, 1 );
				$this.updateForm();
			}
		};

		this.getTotalParticipants = function( oCosts ) {
			if(!oCosts) // data not yet loaded
				return;

			return Number( oCosts.numberOfStudents ) + Number( oCosts.numberOfAdults );
		};

		this.totalPaying = function( oCosts, sType ){
			if(!oCosts) // data not yet loaded
				return;

			if( sType == "student" ){
				return ( oCosts.numberOfStudents - ( oCosts.numberFreeStudents ? oCosts.numberFreeStudents : 0 ) );
			}
			if( sType == "adult" ){
				return ( oCosts.numberOfAdults - ( oCosts.numberFreeAdults ? oCosts.numberFreeAdults : 0 ) );
			}
		};

		this.getTripTotal = function( oCosts, sType ) {
			if(!oCosts) // data not yet loaded
				return;

			if( sType == "student" ){
				 return oCosts.costPerStudent * $this.totalPaying( oCosts, sType );
			}
			if( sType == "adult" ){
				 return oCosts.costPerAdult * $this.totalPaying( oCosts, sType );
			}

			var subtotal = ( oCosts.costPerStudent * ( oCosts.numberOfStudents - ( oCosts.numberFreeStudents ? oCosts.numberFreeStudents : 0 ) ) +
					oCosts.costPerAdult * ( oCosts.numberOfAdults - ( oCosts.numberFreeAdults ? oCosts.numberFreeAdults : 0 ) ) );

			return oCosts.adjustments ? eval( subtotal + oCosts.adjustments ) : subtotal;
		};

		this.addNewEvent = function( oEvent, sCategory ) {
			if(!oEvent)
				var oEvent = {};

			if(!oEvent.date || !oEvent.type || !oEvent.name)
				return $this.confirmMessage("Missing date, type or name.");

			oEvent.date 		= $filter('date')(oEvent.date, 'yyyy/MM/dd') || "";
			oEvent.isComplete 	= oEvent.isComplete || false;
			oEvent.cat 			= sCategory || "adminAdded"; // necessary for delete functionality

			if($this.temp.linkattachment == 'none'){
				oEvent.linkName = "";
				oEvent.url = "";
			}

			if(!$this.formData.events[sCategory])
				$this.formData.events[sCategory] = [];

			$this.formData.events[sCategory].push(oEvent);

			if(oEvent.isReminder){
				console.log("Processing reminder.")
				var reminderObj = {};
				reminderObj.reminderDate = $filter('date')(oEvent.reminderDate, 'yyyy/MM/dd') || oEvent.date;
				reminderObj.reminderEventDate = oEvent.date;
				reminderObj.reminderTitle = oEvent.name || "MPO Travel Event Reminder";
				$this.addReminder(reminderObj);
			}

			$this.updateForm();

			// reset the form elements
			$this.temp.event = {
				isReminder : false,
			};
			$this.temp.adminEvent = {
				isReminder : false,
			};
		};

		this.deleteEvent = function( oEvent, group ) {

			if(oEvent.isReminder){
				console.log("Processing reminder.")
				var reminderObj = {};
					reminderObj.reminderDate = oEvent.reminderDate || oEvent.date;
					reminderObj.reminderEventDate = oEvent.date;
					reminderObj.reminderTitle = oEvent.name || "MPO Travel Event Reminder";

				$this.removeReminder(reminderObj);
			}

			this.formData.events[group].splice(this.formData.events[group].indexOf( oEvent ),1);
			$this.updateForm();
		};

		this.getAllEvents = function() {
			if(!$this.formData.events)
				return;
			var groupedArr;
			groupArr = $this.formData.events.clientAdded.concat($this.formData.events.adminAdded);
			return groupArr;
		}

		this.clearCot = function( aRoom ){
			if( !aRoom.isCot )
				aRoom.cotId = null;
			return;
		};

		this.filterPastDates = function( formattedDate, isFilter ){
			if(isFilter){
				return ( formattedDate >= $filter('date')(new Date(), 'yyyy/MM/dd') );
			}
			return true;
		}

		this.filterByDate = function( formattedDate, sFilter ){
			// if( sFilter == 'All Items')
			// 	return true;

			if( sFilter == 'Past Items')
				return ( formattedDate < $filter('date')(new Date(), 'yyyy/MM/dd') );

			if( sFilter == 'Current Items')
				return ( formattedDate >= $filter('date')(new Date(), 'yyyy/MM/dd') );

			return true;
		}

		this.timerFormEdit = function() {
			console.log("Timer for form being set.");
			// pop up to save and continue or cancel/unlock
			if($this.temp.lockTimer){
				if($timeout.cancel($this.temp.lockTimer)){
					console.log("cancel timer success.");
				} else {
					console.log("cancel timer fail.");
				}
			}
			$this.temp.lockTimer = $timeout( function() {
				// if(!$this.temp.formLocked)
				// 	return false;

				var message = "You have not saved in over 5 minutes.  Other users cannot edit this form until you unlock it. <br />";
					message += "Clicking \"OK\" will save your changes and unlock.<br />";
					message += "Click \"Cancel\" to continue editing.<br />";

				var buttons = {
					ok : "updateAndUnlock()",
					cancel : "updateForm()"
				};

				console.log("Form Timer.");
				$this.confirmMessage( message, buttons, 60 );

			}, $this.temp.formTimeout );
		};

		this.updateAndUnlock = function() {
			$this.updateForm( 'ok', $this.unlockForm );
		};

		this.updateForm = function( sSource, cb ) {
			console.log("updateformcalled.");

			$this.quickMessage("Saving Form...");

			$this.lockForm( function( err, data ) {
				if(err){
					if (err.message){
						if( sSource == "button"){
							$this.confirmMessage( err.message );
							return $this.quickMessage( false );
						}
						$this.delayMessage( err.message );
					}
					if(cb) {
						$this.quickMessage( false );
						return cb( { message: "Update could not complete.<br/>Try saving again via the \"save\" button." } );
					}
					$this.quickMessage( false );
					return false;
				}

				var updateObj = {
					item : swpFormObj.tripPostId,
					formapi : true,
					_swpnonce : swpFormObj.security,
				};

				return FormData.update(updateObj, $this.formData, function( resp ) {
					console.log( resp );
					// TODO: handle returned errors

					if( resp.last_updated )
						$this.temp.lastUpdated = ( new Date(resp.last_updated * 1000) ).toLocaleTimeString();

					$this.quickMessage( false );

					if( resp.success ){
						$this.timerFormEdit();

						// $this.page.longMessage = false;

						if(sSource == "button")
							$this.confirmMessage( "Successfully Saved.");

						if( cb )
							return cb( null, resp );
					} else {
						$this.confirmMessage("File could not be saved at this time.");
						if( cb )
							return cb( { message: "Update could not complete.<br/>Try saving again via the \"save\" button." } );
					}
					return true;
				});

			});
		};

	  	this.refreshIdsInRooms = function () {
	  		if(!$this.formData.rooming)
	  			return;

	  		$this.haveRoomsArr = [];
			angular.forEach( $this.formData.rooming.list, function( value, key ) {
				// guests
				$this.haveRoomsArr = value.guests.concat($this.haveRoomsArr);
				// cots
				if(value.isCot)
					$this.haveRoomsArr.push(value.cotId);
			});

			// console.log($this.haveRoomsArr);
	  	};

	  	$scope.$watch('main.formData.rooming.list', function(){
	  		// data is stored on the main controller scope
	  		$this.refreshIdsInRooms();
	  	}, true);

	  	this.filterUnavailable = function( vGuest, aGuestIds ){
	  		return function( item ){
	  			if(item.id == vGuest)
	  				return true;

	  			return (aGuestIds.indexOf(item.id) === -1);
	  		};
	  	};

	  	this.displayHelp = function() {
	  		var message = "<h3>MPO Education Travel</h3>" +
	  			"<div>352 Main Street West, Suite 204</div>" +
	  			"<div>Hawkesbury, ON, Canada K6A 2H8</div><hr>" +
	  			"<div>Phone: <phone>1-888-MPO-EDUC</phone></div>" +
	  			"<div>Email: <email>info@mpoeduc.com</email></div>";
	  		$this.confirmMessage( message );
	  	};

	}])
	.controller('StartController', ['$scope', function( $scope ) {
	  	$scope.main.page.current = 'start';
		$scope.main.page.nextLocation = 'participants'; // string/false
		$scope.main.page.prevLocation = false; // string/false
		$scope.main.page.nextTitle = 'Participants'; // string
		$scope.main.page.prevTitle = false; // string
		// form watch
		$scope.$watch('formChecklist.$dirty', function(){ // must be the name of the 'controlleras'
			// console.log("formChecklist: " + $scope.formChecklist.$dirty.toString());
	  		$scope.main.page.formDirty = $scope.formChecklist.$dirty;
	  	}, true);
	}])
	.controller('ParticipantsController', ['$scope', function( $scope ) {
	  	$scope.main.page.current = 'participants';
		$scope.main.page.nextLocation = 'diet-med'; // string/false
		$scope.main.page.prevLocation = 'start'; // string/false
		$scope.main.page.nextTitle = 'Dietary / Medical'; // string
		$scope.main.page.prevTitle = 'Client Section'; // string
		// form watch
		$scope.$watch('formParticipants.$dirty', function(){ // must be the name of the 'controlleras'
			// console.log("formParticipants: " + $scope.formParticipants.$dirty.toString());
	  		$scope.main.page.formDirty = $scope.formParticipants.$dirty;
	  	}, true);
	}])
	.controller('DietmedController', ['$scope', function( $scope ) {
	  	$scope.main.page.current = 'dietmed';
		$scope.main.page.nextLocation = 'rooming'; // string/false
		$scope.main.page.prevLocation = 'participants'; // string/false
		$scope.main.page.nextTitle = 'Rooming'; // string
		$scope.main.page.prevTitle = 'Participants'; // string
		$scope.main.page.formName = 'formDietmed'; // string
		// form watch
		$scope.$watch('formDietmed.$dirty', function(){ // must be the name of the 'controlleras'
			// console.log("formDietmed: " + $scope.formDietmed.$dirty.toString());
	  		$scope.main.page.formDirty = $scope.formDietmed.$dirty;
	  	}, true);
	}])
	.controller('RoomingController', ['$scope', function( $scope ) {
	  	$scope.main.page.current = 'rooming';
		$scope.main.page.nextLocation = 'pay-schedule'; // string/false
		$scope.main.page.prevLocation = 'diet-med'; // string/false
		$scope.main.page.nextTitle = 'Payment Schedule'; // string
		$scope.main.page.prevTitle = 'Dietary / Medical'; // string
		// form watch
		$scope.$watch('formRooming.$dirty', function(){ // must be the name of the 'controlleras'
			// console.log("formRooming: " + $scope.formRooming.$dirty.toString());
	  		$scope.main.page.formDirty = $scope.formRooming.$dirty;
	  	}, true);
	}])
	.controller('PayController', ['$scope', function( $scope ) {
	  	$scope.main.page.current = 'pay';
		$scope.main.page.nextLocation = false; // string/false
		$scope.main.page.prevLocation = 'rooming'; // string/false
		$scope.main.page.nextTitle = false; // string
		$scope.main.page.prevTitle = 'Rooming'; // string
		// form watch
		$scope.$watch('formPayments.$dirty', function(){ // must be the name of the 'controlleras'
			// console.log("formPayments: " + $scope.formPayments.$dirty.toString());
	  		$scope.main.page.formDirty = $scope.formPayments.$dirty;
	  	}, true);
	}]);
})();

// services
( function() {
  var mpoServices = angular.module("mpoServices", [
	  'ngResource'
	])
	.factory('FormData', ['$resource', function( $resource ){
	  return $resource(swpFormObj.baseUrl, {
		  item : '@item',
		  formapi : true,
		  _swpnonce : swpFormObj.security,
		},
		{
		  'fetch' 	: { method : 'POST' },
		  'update' 	: { method : 'PUT' },
		  'lock' 	: { method : 'POST', params: { formaction: "lock" } },
		  'unlock' 	: { method : 'POST', params: { formaction: "unlock" } },
		  'addreminder' : { method : 'POST', params: { formaction: "addreminder", reminderDate: '@rd', reminderEventDate: '@red', reminderTitle: '@rt' } },
		  'removereminder' : { method : 'POST', params: { formaction: "removereminder", reminderDate: '@rd', reminderEventDate: '@red', reminderTitle: '@rt' } },
		});
	}]);
})();