<?php // Rooming Lists ?>
<?php
if(isset($_GET["clientview"]))
	$swp_is_admin = FALSE;
?>
<div id="rooming-list" class="col-sm-12">
	<div class="row section-header">
		<p ng-bind-html="main.page.rooming"></p>
		<!-- <p style="margin:0;font-size:10px;"><span class="required">*</span> Required field for the Plane, Train and Insurance Forms.</p> -->
	</div>
	<div ng-if="main.formData.rooming.isLocked" class="row section-header">
		<?php if(!$swp_is_admin){ ?>
			<p class="error text-center">The period to edit the form on this page has ended; it can no longer be edited.</p>
		<?php } else { ?>
			<p class="error text-center">This form page is locked to clients.</p>
		<?php } ?>
	</div>
	<div id="rooms-wrapper">
		<div class="row row-labels visible-lg" style="margin-top:20px;">
			<div class="col-lg-1">
				<div class="mpo-table">
					<p>Room #</p>
				</div>
			</div>
			<div class="col-lg-1">
				<div class="mpo-table">
					<p>Room Type</p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Guest 1</p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Guest 2</p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Guest 3</p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Guest 4</p>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="mpo-table">
					<p>Plus One Cot</p>
				</div>
			</div>
		</div>
		<div class="">
			<hr class="mpo-horizontal visible-lg"/>
		</div>
		<form name="formRooming">
		<fieldset <?php if(!$swp_is_admin){ ?>ng-disabled="main.formData.rooming.isLocked"<?php } ?>>
			<div ng-form class="row row-table-parent" ng-repeat="room in main.formData.rooming.list track by $index">
				<div class="mpo-table-item">
					<span <?php if(!$swp_is_admin){ ?>ng-if="!main.formData.rooming.isLocked"<?php } ?> class="mpo-unit-delete"><a class="pointer" ng-click="main.remove_room($index)"><i class="fa fa-times-circle"></i></a></span>
					<div class="col-lg-1 col-md-2 col-xs-3 col-xxs-6">
						<label class="hidden-lg mpo-labels-md">Room #</label>
						<input class="form-control input-sm" style="text-align:center" disabled="true" ng-value="$index + 1">
					</div>
					<div class="col-lg-1 col-md-2 col-xs-3 col-xxs-6">
						<label class="hidden-lg mpo-labels-md">Room Type</label>
						<select class="form-control input-sm" ng-options="roomT for roomT in main.formConstants.roomTypes" ng-model="room.roomType">
						<option value="">Select Type</option></select>
					</div>


				<!-- Repeating Rooms -->
					<div ng-form class="col-lg-2 col-md-4 col-xs-6 col-xxs" ng-repeat="guest in room.guests track by $index">
						<label class="hidden-lg mpo-labels-md">Guest {{ $index + 1 }}</label><!-- group by getGroupName(v) for v in docs_versions -->
						<select class="form-control input-sm" ng-options="availPart.id as main.roomingNameFormat(availPart) group by main.groupFilter( availPart ) for availPart in main.formData.participants.list | filter: main.filterUnavailable( guest, main.haveRoomsArr)" ng-model="room.guests[$index]">
						<option value="">No Guest</option></select>
					</div>
				<!-- End Repeating Rooms -->


					<div class="col-lg-2 col-md-4 col-xs-6 col-xxs">
						<label class="hidden-lg mpo-labels-md">Plus One Cot</label>
						<div style="clear:both;"></div>
						<div style="width:20%;float:left;">
							<input class="form-control input-sm" type="checkbox" ng-model="room.isCot" ng-checked="room.isCot" ng-click="main.clearCot(room)" />
						</div>
						<div ng-if="room.isCot" style="width:80%;float:left;">
							<select class="form-control input-sm" ng-options="availPart.id as main.roomingNameFormat(availPart) group by main.groupFilter( availPart ) for availPart in main.formData.participants.list | filter: main.filterUnavailable( room.cotId, main.haveRoomsArr)" ng-model="room.cotId">
							<option value="">No Guest</option></select>
						</div>
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
			<div <?php if(!$swp_is_admin){ ?>ng-if="!main.formData.rooming.isLocked"<?php } ?> class="xxs pull-left">
				<a class="btn-add-event pointer" ng-click="main.add_room()">Add New Room</a>
			</div>
			<div <?php if(!$swp_is_admin){ ?>ng-if="!main.formData.rooming.isLocked"<?php } ?> class="pull-left hidden-xxs" style="margin:0 20px;">
				<span>|</span>
			</div>
			<div class="col-xs-12 visible-xxs">
				<hr class="mpo-horizontal" />
			</div>
			<div class="xxs pull-left">
				Total rooms: <span>{{ main.getCount('rooms') }}</span>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>