<?php // Dietary / Medical list ?>
<?php
if(isset($_GET["clientview"]))
	$swp_is_admin = FALSE;
?>
<div id="dietary-medical" class="col-sm-12">
	<div class="row section-header">
		<p ng-bind-html="main.page.dietary"></p>
		<p style="margin:0;">Select the participant and indicate their dietary and/or medical issues.  When completed, click Save button.</p>
	</div>
	<div class="row dm-list-wrapper" style="margin-top:20px;">

		<hr class="verticle-center hidden-xs" ng-if="main.selectedParticipant" />

	<!-- LEFT COLUMN -->
		<div class="col-sm-6 col-xxs" style="margin-bottom:20px;"
			 ng-class="{ 'col-sm-offset-0 col-xs-12 col-xs-offset-0' : main.selectedParticipant, 'col-sm-offset-3 col-xs-8 col-xs-offset-2' : !main.selectedParticipant }">
			<div class="row">
				<h2>List of Participants</h2>
				<div id="list-participant-container" ng-class="{ 'dualview' : main.selectedParticipant }">
					<div ng-repeat="activeP in main.formData.participants.list | filter: { cancelled: false } | orderBy: name.last track by $index">

						<div class="pointer participant-list-item" ng-class="{active: activeP == main.selectedParticipant, last : $last, first : $first }" ng-click="main.selectedParticipant = activeP">
							{{ activeP.name.last || 'BLANK'}}, {{ activeP.name.first || 'BLANK' }} {{ activeP.name.middle.charAt(0) }}
						</div>

					</div>
				</div>
			</div>
		</div>
		<div style="clear:both;" class="visible-xs"></div>

		<div class="col-xs-12 visible-xs" ng-if="main.selectedParticipant">
			<hr class="mpo-horizontal"/>
		</div>

	<!-- RIGHT COLUMN -->
		<div id="dietary-medical-details" class="col-sm-6" ng-show="main.selectedParticipant">

			<!-- START DETAILS -->
				<form name="formDietmed">
					<div>
						<div class="row">
							<strong>Edit Medical, Dietary and Allergy Information for:</strong>
							<div style="color:rgb(171, 89, 188);" ng-bind-html="main.displaySelectedParticipant(main.selectedParticipant)"></div>
						</div>
						<div class="row">
							<hr class="mpo-horizontal"/>
						</div>
						<div class="row">
							<p><strong>Medical Information:</strong></p>
							<ul>
								<li ng-form ng-repeat="(key, value) in main.selectedParticipant.medicalList">
									<label class="mpo-text-normal">
										<input type="checkbox" ng-model="main.selectedParticipant.medicalList[key]" ng-checked="value"/>{{ key }}
									</label>
								</li>
								<li>
									<label class="mpo-text-normal">
										Other:
									</label>
									<textarea class="form-control" ng-model="main.selectedParticipant.medicalOther"></textarea>
								</li>
							</ul>
						</div>
						<div class="row">
							<hr class="mpo-horizontal"/>
						</div>
						<div class="row">
							<p><strong>Dietary Restrictions / Allergies:</strong></p>
							<ul>
								<li ng-form ng-repeat="(key, value) in main.selectedParticipant.dietaryList">
									<label class="mpo-text-normal">
										<input type="checkbox" ng-model="main.selectedParticipant.dietaryList[key]" ng-checked="value"/>{{ key }}
									</label>
								</li>
								<li>
									<label class="mpo-text-normal">
										Other:
									</label>
									<textarea class="form-control" ng-model="main.selectedParticipant.dietaryOther"></textarea>
								</li>
							</ul>
						</div>
						<div class="row">
							<div class="col-xs-6 text-left">
								<a ng-click="main.openPdf(main.selectedParticipant)" class="btn btn-mpo btn-mpo-lg pointer" style="margin-top:20px;">Print</a>
							</div>
							<div class="col-xs-6 text-right">
								<a ng-click="main.updateForm()" class="btn btn-mpo btn-mpo-lg pointer" style="margin-top:20px;">Save</a>
							</div>
						</div>
					</div>
				</form>
			<!-- END DETAILS -->
			<div style="clear:both;"></div>
		</div>
	</div>
</div>
	<div style="clear:both;"></div>