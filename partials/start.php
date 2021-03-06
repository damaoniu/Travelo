<?php // start page for form ?>
<?php
if(isset($_GET["clientview"]))
	$swp_is_admin = FALSE;
?>
<?php if($swp_is_admin): ?>
<?php endif; ?>
<div class="col-sm-8 <?php if($swp_is_admin){ echo 'admin-page'; } ?>">
	<?php // Intro Section ?>
		<div class="row">
			<h1>Welcome to MPO Client Section!</h1>
			<div class="col-xs-12" style="margin-bottom:30px;">
				<p ng-bind-html="main.page.intro"></p>
			</div>
			<div class="col-xs-6 col-xxs trip-details-area">
				<div><strong>School:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.school"></p>
				<div><strong>Trip Contact:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.tripContact.name"></p>
				<div><strong>Phone Number:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.tripContact.phone"></p>
				<div><strong>E-mail:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.tripContact.email"></p>
			</div>
			<div class="col-xs-6 col-xxs trip-details-area">
				<div><strong>Trip Title:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.tripTitle"></p>
				<div><strong>Trip Number:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.tripNumber"></p>
				<div><strong>Start Date:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.startDate | date : 'yyyy/MM/dd'"></p>
				<div><strong>End Date:</strong></div>
				<p ng-bind="main.formConstants.tripDetails.endDate | date : 'yyyy/MM/dd'"></p>
			</div>
			<!-- <a ng-href="#/participants" class="btn btn-mpo btn-mpo-lg" style="margin:20px 0;">
				START NOW <i class="fa fa-angle-double-right"></i>
			</a> -->
		</div>
		<div style="clear:both;"></div>


		<form id="form_checklist" name="formChecklist" novalidate>

			<?php // checklists ?>
				<div class="row check-list">
					<div class="row">
						<div class="col-xs-6 col-xxs">
							<h3>
								Checklist:
							</h3>
						</div>
						<div class="col-xs-6 col-xxs text-right" ng-init="main.temp.listFilter = 'All Items'">
							<div style="margin-top:20px;">
								<div style="width: 50px;max-width:29%;float:left;line-height:30px;">
									<strong>Show: </strong>
								</div>
								<div style="width: calc( 100% - 50px );max-width:70%;float:right;">
									<select class="form-control input-sm" ng-options="listFilter for listFilter in ['All Items', 'Past Items', 'Current Items']" ng-model="main.temp.listFilter"></select>
								</div>
							</div>
						</div>
					</div>

					<div class="">
						<div ng-repeat="event in main.getAllEvents() | orderBy : 'date'">
							<div ng-show="main.filterByDate( event.date, main.temp.listFilter )" ng-class="{ 'mpo-bg-light-gray' : !main.filterPastDates(event.date, true), 'last' : $last }" class="row data-row">
								<div class="shift-section" style="position:relative;">
											<?php if($swp_is_admin) : ?>
												<span ng-if="event.cat == 'adminAdded'" class="delete-admin-item" ng-click="main.deleteEvent(event, 'adminAdded')"><i class="fa fa-times-circle"></i></span>
											<?php endif; ?>
									<div class="row">
										<div style="padding:0 10px;">
											<div class="col-xs-2 col-xxs mpo-date data-data text-left">
												{{ (event.date  | date:'yyyy/MM/dd') || "Unspecified"}}
											</div>
											<div class="col-xs-6 col-xxs data-data text-left">
												<input class="form-control input-sm pull-left" type="checkbox" ng-model="event.isComplete" ng-checked="event.isComplete" />
												<span ng-class="{ done : event.isComplete }" class="{{event.type}} mpo-event-title">{{ event.name }}</span>
											</div>
											<div class="col-xs-4 col-xxs mpo-event-link data-data text-right">
												<a ng-href="{{event.url}}">{{event.linkName}}</a>
												<span ng-if="event.cat == 'clientAdded'" class="btn-delete-event"><a class="pointer" ng-click="main.deleteEvent(event, 'clientAdded')">delete</a></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						<?php // admin add to check list ?>
						<?php if($swp_is_admin) : ?>
							<div style="clear:both;"></div>
							<div style="margin-top:10px;">
									<div class="mpo-admin">
										<h3>Add Checklist Item</h3>

										<div class="form-group">
											<label class="mpo-text-normal">Date<br/>
												<input class="form-control input-sm" type="text" datepicker-popup="yyyy/MM/dd" placeholder="yyyy/mm/dd" ng-model="main.temp.adminEvent.date" ng-required="true" />
											</label>
										</div>
										<div class="form-group">
												<label class="mpo-text-normal">Type<br/>
													<select class="form-control input-sm" style="width:200px" ng-options="type as main.upperCaseString(type) for type in main.formConstants.types" ng-model="main.temp.adminEvent.type">
														<option value="">Select Type...</option>
													</select>
												</label>
										</div>
										<div class="form-group">
												<label class="mpo-text-normal">Title<br/>
													<input class="from-control input-sm" style="width:300px;" type="text" placeholder="My Event Title..." ng-model="main.temp.adminEvent.name"/>
												</label>
										</div>
										<div class="form-group" ng-init="main.temp.linkattachment = 'none'">
												<label>Link / Attachment</label><br/>
												<div style="width:33%;float:left;">
													<label class="mpo-text-normal pointer">
														<input type="radio" name="link_attachment" ng-model="main.temp.linkattachment" ng-value="'none'" /> None
													</label>
												</div>
												<div style="width:33%;float:left;">
													<label class="mpo-text-normal pointer">
														<input type="radio" name="link_attachment" ng-model="main.temp.linkattachment" ng-value="'file'" /> File
													</label>
												</div>
												<div style="width:33%;float:left;">
													<label class="mpo-text-normal pointer">
														<input type="radio" name="link_attachment" ng-model="main.temp.linkattachment" ng-value="'link'" /> Link
													</label>
												</div>
												<div style="clear:both;"></div>
										</div>
										<div ng-if="main.temp.linkattachment !='none'">
											<div class="form-group">
												<label class="mpo-text-normal"><span ng-if="main.temp.linkattachment =='file'">File</span><span ng-if="main.temp.linkattachment == 'link'">Link</span> Title:</label>
											  	<input class="form-control input-sm" type="text" ng-model="main.temp.adminEvent.linkName" />
											</div>
											<div class="uploader form-group">
												<label class="mpo-text-normal"><span ng-if="main.temp.linkattachment =='file'">File</span><span ng-if="main.temp.linkattachment == 'link'">Link</span>:</label>
												<button class="btn mpo-btn event-img-button" ng-if="main.temp.linkattachment =='file'" id="btnEventMedia" ng-click="main.addMedia('adminEvent', 'btnEventMedia')">Select/Upload</button>
												<select class="form-control input-sm" style="width:114px;display:inline-block;" ng-if="main.temp.linkattachment =='link'" ng-options="pl.url as pl.name for pl in main.formConstants.pageLinks" ng-model="main.temp.adminEvent.url">
													<option value="">Form Link...</option>
												</select>
											</div>
											<div class="uploader form-group">
												<input class="form-control input-sm" id="file_url_event" type="text" ng-model="main.temp.adminEvent.url" />
											</div>
										</div>
										<div class="form-group">
												<label class="mpo-text-normal pointer">Email Reminder?<br/>
													<input type="radio" name="email-adminAdded-reminder" ng-model="main.temp.adminEvent.isReminder" ng-value="true" /> Yes
												</label>
												<label class="mpo-text-normal pointer">
													<input type="radio" name="email-adminAdded-reminder" ng-model="main.temp.adminEvent.isReminder" ng-value="false" /> No
												</label>
										</div>
										<div ng-if="main.temp.adminEvent.isReminder" class="row">
											<div class="col-md-6 col-sm-12">
												<label class="mpo-text-normal">Reminder will be sent to:<br/>
													<input class="form-control input-sm disabled" disabled=true style="width:200px" type="email" value="{{ main.formConstants.tripDetails.tripContact.email }}" />
												</label>
											</div>
											<div class="col-md-6 col-sm-12">
												<label class="mpo-text-normal">Reminder Date:<br/>
													<input class="form-control input-sm" style="width:200px" type="text" datepicker-popup="yyyy/MM/dd" placeholder="yyyy/mm/dd" ng-model="main.temp.adminEvent.reminderDate" />
												</label>
											</div>
										</div>
										<div class="form-group" style="margin-top:20px;">
											<a class="btn-add-event pointer" ng-click="main.addNewEvent(main.temp.adminEvent, 'adminAdded')">Add Event Checklist Item</a>
										</div>
									</div>
							</div>
						<?php endif; ?>
				</div>
			<?php // client add to checklist ?>
			<?php if(!$swp_is_admin) : ?>
				<div id="add-event" class="row">
					<div class="client-box" style="background-color:rgb(215,215,215);">
						<div class="col-xs-12">
						<p style="font-size:12px">
							<strong>Add a Checklist item:</strong>
						</p>
							<hr class="mpo-horizontal"/>
						</div>
						<div id="add-events" class="col-xs-12">
							<div class="row">
								<div class="col-md-4 col-sm-6">
									<label class="mpo-text-normal">Date<br/>
										<input class="form-control input-sm" type="text" datepicker-popup="yyyy/MM/dd" placeholder="yyyy/mm/dd" ng-model="main.temp.event.date" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-6">
									<label class="mpo-text-normal">Type<br/>
										<select class="form-control input-sm" style="width:200px" ng-options="type for type in main.formConstants.types" ng-model="main.temp.event.type">
											<option value="">Select Type...</option>
										</select>
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<label class="mpo-text-normal">Event Title<br/>
										<input class="from-control input-sm" style="width:300px;" type="text" placeholder="My Event Title..." ng-model="main.temp.event.name"/>
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<label class="mpo-text-normal pointer">Email Reminder?<br/>
										<input type="radio" name="email-reminder" ng-model="main.temp.event.isReminder" ng-value="true" /> Yes
									</label>
									<label class="mpo-text-normal pointer">
										<input type="radio" name="email-reminder" ng-model="main.temp.event.isReminder" ng-value="false" /> No
									</label>
								</div>
							</div>
							<div ng-if="main.temp.event.isReminder" class="row">
								<div class="col-md-6 col-sm-12">
									<label class="mpo-text-normal">Reminder will be sent to:<br/>
										<input class="form-control input-sm disabled" disabled=true style="width:200px" type="email" value="{{ main.formConstants.tripDetails.tripContact.email }}" />
									</label>
								</div>
								<div class="col-md-6 col-sm-12">
									<label class="mpo-text-normal">Reminder Date:<br/>
										<input class="form-control input-sm" type="text" datepicker-popup="yyyy/MM/dd" placeholder="yyyy/mm/dd" ng-model="main.temp.event.reminderDate" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12" style="margin-top:20px;">
									<a class="btn-add-event pointer" ng-click="main.addNewEvent(main.temp.event, 'clientAdded')">Add this to my Checklist</a>
								</div>
							</div>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>
			<?php endif; ?>

		</form>
		<div style="clear:both;"></div>
</div>
<?php // side: teacher's kit ?>
<div id="teachers-kit" class="col-sm-4 <?php if($swp_is_admin){ echo 'admin-page'; } ?>">
	<h3>Teacher's Kit</h3>
	<div ng-repeat="kit in main.formData.kits" class="teachers-kit-item">
		<div class="shift-section" style="position:relative;">
			<?php if($swp_is_admin) : ?>
				<span class="delete-admin-item" ng-click="main.deleteKit(kit)"><i class="fa fa-times-circle"></i></span>
			<?php endif; ?>
			<a ng-href="{{kit.url}}" target="_blank" ng-class="main.getFileType(kit.url)">{{ kit.name }}</a>
		</div>
	</div>
	<?php if($swp_is_admin) : ?>
		<div class="mpo-admin">
			<h3>Add Kit Item</h3>
			<div class="form-group">
				<label>Kit Title:</label>
			  	<input class="form-control input-sm" type="text" ng-model="main.temp.kit.name" />
			</div>
			<div class="uploader form-group">
				<label>File Url:</label>
				<button class="btn mpo-btn img-button" id="btnKitMedia" ng-click="main.addMedia('kit', 'btnKitMedia')">Select/Upload</button>
			</div>
			<div class="uploader form-group">
				<input class="form-control input-sm" type="text" ng-model="main.temp.kit.url" />
			</div>
			<div class="form-group" style="margin-top:20px;">
				<a class="btn-add-event pointer" ng-click="main.addNewKit(main.temp.kit)">Add Kit Item</a>
			</div>
		</div>
	<?php endif; ?>
</div>

<div style="clear:both;"></div>