<?php // Payment Schedule ?>
<?php
if(isset($_GET["clientview"]))
	$swp_is_admin = FALSE;
?>
<h1 class="text-left">Payment Schedule & Summaries</h1>
<div id="payment-schedule" class="col-sm-12">
	<div class="row section-header">
		<p ng-bind-html="main.page.pay"></p>
		<!-- <p style="margin:0;font-size:10px;"><span class="required">*</span> Required field for the Plane, Train and Insurance Forms.</p> -->
	</div>
	<div class="row payment-schedule-wrapper" style="margin-top:20px;">
		<hr class="verticle-center hidden-xs hidden-sm" />
		<form name="formPayments">
		<!-- Lt Col -->
			<div class="col-md-6">
				<div id="pay-sch-left-wrap">
					<div id="deposit-schedule" class="pay-sch-section">
						<h4>Payment Schedule:</h4>
						<div class="row data-row hidden-xs mpo-bg-light-gray" style="white-space:nowrap; font-weight:bold;">
							<div class="col-sm-2 col-xs-6 data-data text-center">
								Deposit #
							</div>
							<div class="col-sm-4 col-xs-6 data-data text-center">
								Due Date
							</div>
							<div class="col-sm-3 col-xs-6 data-data text-right mpo-adjust-col-left-md">
								$ Per Person
							</div>
							<div class="col-sm-3 col-xs-6 data-data text-right mpo-adjust-col-left-md">
								Deposit Due
							</div>
						</div>
						<div ng-repeat="deposit in main.formData.payment.schedule | orderBy : 'number' track by $index">
							<div class="row data-row" ng-class="{ last : $last }" style="position:relative;">
								<?php if($swp_is_admin) : ?>
									<span class="delete-admin-item" ng-click="main.removePaySchedule(deposit)"><i class="fa fa-times-circle"></i></span>
								<?php endif; ?>
								<div class="col-sm-2 col-xs-4 data-data text-center">
									<label class="visible-xs mpo-labels-md text-center">Deposit #</label>
									{{ deposit.number }}
								</div>
								<div class="col-sm-4 col-xs-4 data-data text-center no-wrap">
									<label class="visible-xs mpo-labels-md text-center">Due Date</label>
									{{ deposit.dueDate | date:'yyyy/MM/dd' }}
								</div>
								<div class="col-sm-3 col-xs-4 data-data text-right no-wrap mpo-adjust-col-left-md">
									<label class="visible-xs mpo-labels-md text-center">$ Per Person</label>
									{{ deposit.amtPerPerson + " (" + main.formData.general.currency + ")" }}
								</div>
								<div class="col-sm-3 col-xs-12 data-data text-right no-wrap mpo-adjust-col-left-md xs-margin-top">
									<strong><span class="visible-xs inline">Deposit Due: </span>
									{{ deposit.amtDue + " (" + main.formData.general.currency + ")"}}</strong>
								</div>
							</div>
						</div>
							<?php // admin add deposits to pay schedule ?>
							<?php if($swp_is_admin) : ?>
								<div style="clear:both;"></div>
								<div style="margin-top:10px;">
										<div class="mpo-admin">
											<h3>Add Payment Schedule Item</h3>
											<div class="form-group">
												<label class="mpo-text-normal">Deposit #:<br/>
													<input class="form-control input-sm" style="width:100px" type="number" placeholder="#" ng-model="main.temp.paySchedule.number" />
												</label>
											</div>
											<div class="form-group">
												<label class="mpo-text-normal">Due Date:<br/>
													<input class="form-control input-sm" type="text" datepicker-popup="yyyy/MM/dd" placeholder="yyyy/mm/dd" ng-model="main.temp.paySchedule.dueDate" />
												</label>
											</div>
											<div class="form-group">
												<label class="mpo-text-normal">$ Per Person:<br/>
													<input class="form-control input-sm" style="width:200px" type="number" placeholder="$" step="any" ng-model="main.temp.paySchedule.amtPerPerson" />
												</label>
											</div>
											<div class="form-group">
												<label class="mpo-text-normal">Deposit Due:<br/>
													<input class="form-control input-sm" style="width:200px" type="number" placeholder="$" step="any" ng-model="main.temp.paySchedule.amtDue" />
												</label>
											</div>
											<div class="form-group" style="margin-top:20px;">
												<a class="btn-add-event pointer" ng-click="main.addPaySchedule(main.temp.paySchedule)">Add Payment Schedule Item</a>
											</div>
										</div>
								</div>
								<div style="clear:both;"></div>
							<?php endif; ?>
					</div>
					<div id="message-center" class="pay-sch-section">
						<h4>Message Centre:</h4>
						<div ng-repeat="message in main.formData.payment.messages track by $index">
							<div class="row data-row" ng-class="{ last : $last }" style="position:relative;">
								<?php if($swp_is_admin) : ?>
									<span class="delete-admin-item" ng-click="main.removePayMessage( message )"><i class="fa fa-times-circle"></i></span>
								<?php endif; ?>
								<div class="col-sm-3 col-xs-4 text-center date-field data-data">
									{{ message.date | date:'yyyy/MM/dd' }}
								</div>
								<div class="col-sm-6 col-xs-8mpo-adjust-col-left-md data-data">
									{{ message.text }}
								</div>
								<div class="col-sm-3 col-xs-12 text-center data-data">
									<a ng-if="messsage.title != ''" target="_new" ng-href="{{ message.url }}">{{ message.title }}</a>
								</div>
							</div>
						</div>
							<?php // admin add messages ?>
							<?php if($swp_is_admin) : ?>
								<div style="clear:both;"></div>
								<div style="margin-top:10px;">
										<div class="mpo-admin">
											<h3>Add Message Item</h3>
											<div class="form-group">
												<label class="mpo-text-normal">Date:<br/>
													<input class="form-control input-sm" type="text" datepicker-popup="yyyy/MM/dd" placeholder="yyyy/mm/dd" ng-model="main.temp.messageItem.date" />
												</label>
											</div>
											<div class="form-group">
												<label class="mpo-text-normal">Message:</label><br/>
												<textarea class="form-control" placeholder="Message..." ng-model="main.temp.messageItem.text"></textarea>
											</div>
											<div class="form-group">
												<label>File Title:</label>
											  	<input class="form-control input-sm" type="text" ng-model="main.temp.messageItem.title" />
											</div>
											<div class="uploader form-group">
												<label>File Url:</label>
												<button class="btn mpo-btn img-button" id="btnMessagesMedia" ng-click="main.addMedia('messageItem', 'btnMessagesMedia')">Select/Upload</button>
											</div>
											<div class="uploader form-group">
												<input class="form-control input-sm" type="text" ng-model="main.temp.messageItem.url" />
											</div>
											<div class="form-group" style="margin-top:20px;">
												<a class="btn-add-event pointer" ng-click="main.addPayMessage(main.temp.messageItem)">Add Message Item</a>
											</div>
										</div>
								</div>
								<div style="clear:both;"></div>
							<?php endif; ?>
					</div>
				</div>
			</div>
		<!-- Rt Col -->
			<div class="col-md-6">
				<div id="pay-sch-right-wrap">
					<div id="pay-sch-student-sum" class="pay-sch-section">
						<h4>Participants Summary:</h4>
						<div class="row data-row">
							<div class="col-md-8 col-xs-8 col-xxs data-data text-right">
								Number of Students:
							</div>
							<div class="col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.formData.payment.costOfTrip.numberOfStudents }}
							</div>
						</div>
						<div class="row data-row">
							<div class="col-md-8 col-xs-8 col-xxs data-data text-right">
								Number of Adults:
							</div>
							<div class="col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.formData.payment.costOfTrip.numberOfAdults }}
							</div>
						</div>
						<div ng-if="main.formData.payment.costOfTrip.numberFreeStudents || main.formData.payment.costOfTrip.numberFreeAdults" class="row data-row">
							<div class="col-xs-12">
								<div class="col-xs-12 col-xxs data-data text-left">
									Number of Free Students: {{ main.formData.payment.costOfTrip.numberFreeStudents}}
									<br>
									Number of Free Adults: {{ main.formData.payment.costOfTrip.numberFreeAdults }}
								</div>
							</div>
						</div>
						<div class="row data-row data-total last mpo-bg-light-gray">
							<div class="col-lg-6 col-md-8 col-xs-8 col-xxs data-data text-right">
								<strong>Total Number of Participants:</strong>
							</div>
							<div class="col-lg-6 col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.getTotalParticipants(main.formData.payment.costOfTrip) }}
							</div>
						</div>
					</div>
					<!-- SEPERATION -->
					<div id="pay-sch-comp-totals" class="pay-sch-section">
						<h4>Trip Cost Summary:</h4>
						<div class="row data-row">
							<div class="col-md-8 col-xs-8 col-xxs data-data text-right">
								Cost of Trip per Student:
							</div>
							<div class="col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.formData.payment.costOfTrip.costPerStudent | currency : "$" }}{{" (" + main.formData.general.currency + ")" }}
							</div>
						</div>
						<div class="row data-row">
							<div class="col-md-8 col-xs-8 col-xxs data-data text-right">
								Cost of Trip per Adult:
							</div>
							<div class="col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.formData.payment.costOfTrip.costPerAdult | currency : "$" }}{{" (" + main.formData.general.currency + ")" }}
							</div>
						</div>
						<div class="row data-row">
							<div class="col-md-8 col-xs-8 col-xxs data-data text-right">
								Subtotal for Students ({{ main.totalPaying( main.formData.payment.costOfTrip, 'student') }}):
							</div>
							<div class="col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.getTripTotal(main.formData.payment.costOfTrip, 'student') | currency : "$" }}{{" (" + main.formData.general.currency + ")" }}
							</div>
						</div>
						<div class="row data-row">
							<div class="col-md-8 col-xs-8 col-xxs data-data text-right">
								Subtotal for Adults ({{ main.totalPaying( main.formData.payment.costOfTrip, 'adult') }}):
							</div>
							<div class="col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.getTripTotal(main.formData.payment.costOfTrip, 'adult') | currency : "$" }}{{" (" + main.formData.general.currency + ")" }}
							</div>
						</div>
						<div class="row data-row" ng-if="main.formData.payment.costOfTrip.adjustments">
							<div class="col-md-8 col-xs-8 col-xxs data-data text-right">
								Adjustments:
							</div>
							<div class="col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.formData.payment.costOfTrip.adjustments | currency : "$" }}{{ " (" + main.formData.general.currency + ")" }}
							</div>
						</div>
						<div class="row data-row data-total last mpo-bg-light-gray">
							<div class="col-lg-6 col-md-8 col-xs-8 col-xxs data-data text-right">
								<strong>TOTAL COST OF THE TRIP:</strong>
							</div>
							<div class="col-lg-6 col-md-4 col-xs-4 col-xxs data-data text-right">
								{{ main.getTripTotal(main.formData.payment.costOfTrip) | currency : "$" }}{{ " (" + main.formData.general.currency + ")" }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

</div>