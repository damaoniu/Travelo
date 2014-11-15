<?php // participants ?>
<?php
if(isset($_GET["clientview"]))
	$swp_is_admin = FALSE;
?>
<style>
</style>
<div id="participants-list" class="col-sm-12">
	<div class="row section-header">
		<p ng-bind-html="main.page.participants"></p>
		<p style="margin:0;font-size:10px;"><span class="required">*</span> Required field for the Plane, Train and Insurance Forms.</p>
	</div>
	<div ng-if="main.formData.participants.isLocked" class="row section-header">
		<?php if(!$swp_is_admin){ ?>
			<p class="error text-center">The period to edit the form on this page has ended; it can no longer be edited.</p>
		<?php } else { ?>
			<p class="error text-center">This form page is locked to clients.</p>
		<?php } ?>
	</div>
	<div id="participants-wrapper">
		<div class="row row-labels visible-lg">
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Given Name<span class="required">*</span></p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Middle Name</p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Last Name<span class="required">*</span></p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Date of Birth<span class="required">*</span></p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Nationality</p>
				</div>
			</div>
			<div class="col-lg-1 mpo-adjust-col-left">
				<div class="mpo-table">
					<p>Gender<span class="required">*</span></p>
				</div>
			</div>
			<div class="col-lg-1 mpo-adjust-col-left">
				<div class="mpo-table">
					<p>Adult or Student<span class="required">*</span></p>
				</div>
			</div>
		</div>
		<div class="">
			<hr class="mpo-horizontal visible-lg"/>
		</div>

			<form name="formParticipants" novalidate>
			<fieldset <?php if(!$swp_is_admin){ ?>ng-disabled="main.formData.participants.isLocked"<?php } ?>>
				<div ng-form class="row row-table-parent" ng-repeat="participant in main.formData.participants.list track by $index">
					<div class="mpo-table-item">
						<span class="mpo-unit-count"><strong>{{ $index + 1 }}</strong></span>
						<span <?php if(!$swp_is_admin){ ?>ng-if="!main.formData.participants.isLocked"<?php } ?> class="mpo-unit-delete"><a class="pointer" ng-click="main.remove_participant($index)" title="Delete Participant"><i class="fa fa-times-circle"></i></a></span>
						<div class="col-lg-2 col-xxs col-xs-4 mpo-adjust-col-right mpo-adjust-col-right-xxs">
							<label class="hidden-lg mpo-labels-md">Given Name<span class="required">*</span></label>
							<input class="form-control input-sm" type="text" placeholder="Given Name..." ng-model="participant.name.first" />
						</div>
						<div class="col-lg-2 col-xxs col-xs-4">
							<label class="hidden-lg mpo-labels-md">Middle Name</label>
							<input class="form-control input-sm" type="text" placeholder="Middle Name..." ng-model="participant.name.middle" />
						</div>
						<div class="col-lg-2 col-xxs col-xs-4 mpo-adjust-col-left mpo-adjust-col-left-xxs">
							<label class="hidden-lg mpo-labels-md">Last Name<span class="required">*</span></label>
							<input class="form-control input-sm" type="text" placeholder="Last Name..." ng-model="participant.name.last" />
						</div>
						<div class="col-lg-2 col-xxs col-xs-4 mpo-adjust-col-right-xxs">
							<label class="hidden-lg mpo-labels-md">Date of Birth<span class="required">*</span></label>
							<input class="form-control input-sm" type="text" datepicker-popup="yyyy/MM/dd" placeholder="yyyy/mm/dd" ng-model="participant.dob" />
						</div>
						<div class="col-lg-2 col-xxs col-xs-4">
							<label class="hidden-lg mpo-labels-md">Nationality</label>
							<input class="form-control input-sm" type="text" placeholder="Nationality..." ng-model="participant.nationality" />
						</div>
						<div class="col-lg-1 col-xxs col-xs-2 mpo-adjust-col-left mpo-adjust-col-left-xxs">
							<label class="hidden-lg mpo-labels-md">Gender<span class="required">*</span></label>
							<select class="form-control input-sm" ng-model="participant.gender" ng-options="gender for gender in ['Male', 'Female'] ">
								<option value="">Select...</option>
							</select>
						</div>
						<div class="col-lg-1 col-xxs col-xs-2 mpo-adjust-col-left mpo-adjust-col-left-xxs">
							<label class="hidden-lg mpo-labels-md label-student-adult">Adult&nbsp;/&nbsp;Student<span class="required">*</span></label>
							<select class="form-control input-sm" ng-model="participant.type" ng-options="type for type in ['Student', 'Adult'] ">
								<option value="">Select...</option>
							</select>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>
			</fieldset>
			</form>
		<div class="">
			<hr class="mpo-horizontal"/>
		</div>
		<div id="participants-list-footer" class="row">
			<div <?php if(!$swp_is_admin){ ?>ng-if="!main.formData.participants.isLocked"<?php } ?> class="xxs pull-left">
				<a class="btn-add-event pointer" ng-click="main.add_participant()">Add New Participant</a>
			</div>
			<div <?php if(!$swp_is_admin){ ?>ng-if="!main.formData.participants.isLocked"<?php } ?> class="pull-left hidden-xxs" style="margin:0 20px;">
				<span>|</span>
			</div>
			<div class="col-xs-12 visible-xxs">
				<hr class="mpo-horizontal" />
			</div>
			<div class="xxs pull-left">
				Total Participants: <span>{{ main.getCount('participants') }}</span>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>