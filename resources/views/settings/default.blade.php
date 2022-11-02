@extends('layouts.app')
<title>ACCOUNT : Default Settings</title>
@section('content')
<div class="content-box">
	<div class="my_box">
		@if ( session('success'))
			<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
				{{ session('success') }}
			</div>
		@endif
		<form action="{{route('default.save')}}" method="post">
		@csrf
		<div class="box_head row">
			<div class="col-md-6">
				<h1>Settings</h1> </div>
			<div class="col-md-6 right pdt-5">
				<a href="{{url('setting')}}" style="text-decoration:none">
				<button type="button" class="my_but white">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="currentColor">
						<!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
						<path d="M77.25 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C175.6 444.9 183.8 448 192 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L77.25 256zM269.3 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C367.6 444.9 375.8 448 384 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L269.3 256z" />
					</svg>
					</svg><span class="spacer-left-xxs">Go Back</span> </button>
				</a>
				<button type="submit" class="my_but2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
						<!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
						<path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z" />
					</svg><span class="spacer-left-xxs">Save</span> </button>
			</div>
		</div>
		<div class="box_body" style="min-height:680px">
			<div class="row">
				<div class="content_box col-md-6">
					<div class="pane pane-default box-border-all">
						<div class="pane-top">
							<h4>General</h4> </div>
						<div class="pane-content row">
							<div class="form-group col-md-8">
								<label>Time zone</label>
								<select name="timezone" id="timezone" class="form-control">
									@foreach($world_timezone as $timezone)
									<option value="{{$timezone['value']}}" {{$default_setting && ($default_setting->timezone ==  $timezone['value']) ? 'selected' : ''}}>{{$timezone['name']}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-8 mt-15">
								<label>Delay Time</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="The Delay Time setting is for experts who send several email campaigns per week.  <br><br>To ensure contacts <b>do not receive multiple emails from you during a certain timeframe</b>, define this timeframe in the Delay Time field. (Enter this value as a <b>number of hours.</b>)<br><br>Your campaigns will be automatically re-programmed (delayed by 4 hours) for contacts who have already received an email from you in your custom 'Delay Time' timeframe." data-html="true" class="fa fa-question-circle"></i></a>
								<input type="number" name="delay_time" class="form-control delaytime" id="delay-time"  value="{{$default_setting ? $default_setting->delay_time : 0}}"> </div>
							<div class="form-group col-md-12 mt-15">
								<label>Time Format</label>
								<div class="radio no-margin">
									<label class="radio-inline mr-15">
										<input type="radio" name="time_format" value="24hours" id="24hours" {{!$default_setting ? 'checked' : ($default_setting->time_format == '24hours' ? 'checked' : '')}}> 24 Hours </label>
									<label class="radio-inline">
										<input type="radio" name="time_format" value="12hours" id="12hours"  {{!$default_setting ? '' : ($default_setting->time_format == '12hours' ? 'checked' : '')}}> 12 Hours </label>
								</div>
							</div>
							<div class="form-group col-md-12 mt-15">
								<label>Date Format</label>
								<div class="radio no-margin">
									<label class="radio-inline mr-15">
										<input type="radio" name="date_format" value="dd-mm-yyyy" id="dmy" {{!$default_setting ? 'checked' : ($default_setting->date_format == 'dd-mm-yyyy' ? 'checked' : '')}}> DD-MM-YYYY </label>
									<label class="radio-inline">
										<input type="radio" name="date_format" value="mm-dd-yyyy" id="mdy" {{!$default_setting ? '' : ($default_setting->date_format == 'mm-dd-yyyy' ? 'checked' : '')}}> MM-DD-YYYY </label>
								</div>
							</div>
						</div>
					</div>
					<div class="pane pane-default box-border-all">
						<div class="pane-top">
							<h4>Tracking</h4> </div>
						<div class="pane-content row">
							<div class="form-group col-md-12">
								<label>Hide Images URL</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="Selecting this option will <b>replace your image links with links hosted by SendinBlue.</b><br><br>  In some cases, enabling this option may improve the deliverability of your campaigns." data-html="true" class="fa fa-question-circle"></i></a>
								<div class="radio no-margin">
									<label class="radio-inline mr-15">
										<input type="radio" name="image_url_hide" value="1" id="obfuscateurl" {{!$default_setting ? 'checked' : ($default_setting->image_url_hide == 1 ? 'checked' : '')}}> Yes </label>
									<label class="radio-inline">
										<input type="radio" name="image_url_hide" value="0" id="obfuscateurl" {{!$default_setting ? '' : ($default_setting->image_url_hide == 0 ? 'checked' : '')}}> No </label>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="pane pane-default box-border-all">
						<div class="pane-top">
							<h4>SMS Replies</h4> </div>
						<div class="pane-content row">
							<div class="form-group col-md-12">
								<label>Do you want to receive replies to your SMS campaigns by email?</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="If you send SMS messages to contacts in France, USA, UK, Canada, Sweden, Norway, French Polynesia, you may receive their replies via email. Enable this setting to receive them on your default login email address." data-html="true" class="fa fa-question-circle"></i></a>
								<div class="radio no-margin">
									<label class="radio-inline mr-15">
										<input type="radio" name="camp_sms_reply" value="1" id="camp_sms_reply"> Yes </label>
									<label class="radio-inline">
										<input type="radio" name="camp_sms_reply" value="0" id="camp_sms_reply" checked="checked"> No </label>
								</div>
							</div>
						</div>
					</div> -->
					<div class="pane pane-default box-border-all">
						<label>Do you want to disable SendinBlue activity notifications?</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="If you select 'yes', you will not receive email notifications based on activity in your SendinBlue account (such as importing/exporting contacts, deleting contact lists, campaigns sent, etc.)." data-html="true" class="fa fa-question-circle"></i></a>
						<div class="radio no-margin">
							<label class="radio-inline mr-15">
								<input type="radio" name="disable_notification" value="1" {{!$default_setting ? 'checked' : ($default_setting->disable_notification == 1 ? 'checked' : '')}}> Yes </label>
							<label class="radio-inline">
								<input type="radio" name="disable_notification" value="0" {{!$default_setting ? '' : ($default_setting->disable_notification == 0 ? 'checked' : '')}}> No </label>
						</div>
					</div>
				</div>
				<div class="content_box col-md-6">
					<div class="pane pane-default box-border-all" id="camp-setting">
						<div class="pane-top">
							<h4>Default campaign settings</h4> </div>
						<div class="pane-content">
							<div class="form-group">
								<label>[DEFAULT_FROM_NAME]</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="The <b>sender's name</b> appears in your recipient's inbox to identify the sender. <br><br>  Its purpose is to build trust with recipients and generate more openings. <br><br> The sender name may be modified for individual campaigns during Step 1 of the campaign creation process." data-html="true" class="fa fa-question-circle"></i></a>
								<input type="text" name="default_from_name" class="form-control defaultname" value="{{!$default_setting ? '' : $default_setting->default_from_name}}" id="default-from-name-input"> </div>
							<div class="form-group mt-15">
								<label>[DEFAULT_FROM_EMAIL]</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="The <b>sender's email address</b> is associated with your messages and allows recipients to recognize you. <br> <br> Do not use an ISP domain address (@Gmail.com, @Yahoo.com, @Hotmail, @Aol.com, @Comcast.com, etc.) as your sender email address to ensure optimal deliverability for your campaigns.  <br><br>This value may be modified for individual campaigns during Step 1 of the campaign creation process." data-html="true" class="fa fa-question-circle"></i></a>
								<input type="text" name="default_from_email" class="form-control emailfrom" value="{{!$default_setting ? '' : $default_setting->default_from_email}}" id="default-from-email-input"> </div>
							<div class="form-group mt-15">
								<label>[DEFAULT_HEADER]</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="<b>The email header</b> usually contains a 'mirror link'. This link allows recipients to read the email content on a web page. <br> <br> You may edit the header; text placed within braces will be the clickable link text. <i class='text-muted'>Ex: To read this newsletter in HTML format, click {here}.</i> <br> <br> This value may be modified for individual campaigns during Step 1 of the campaign creation process." data-html="true" class="fa fa-question-circle"></i></a>
								<textarea rows="" class="form-control headerarea" cols="" name="default_header">{{!$default_setting ? '' : $default_setting->default_header}}</textarea>
							</div>
							<div class="form-group mt-15">
								<label>[DEFAULT_FOOTER]</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="The <b>email footer</b> <u>must</u> contain an unsubscribe link. <br><br>This allows your contacts to unsubscribe from your mailing lists. <br><br>You may edit the footer; text placed within braces will be the clickable link text.  <i class='text-muted'>Ex: Please click {here} to unsubscribe from our emails.</i> <br><br>This value may be modified for individual campaigns during Step 1 of the campaign creation process." data-html="true" class="fa fa-question-circle"></i></a>
								<textarea rows="" class="form-control footerarea" cols="" name="default_footer">{{!$default_setting ? '' : $default_setting->default_footer}}</textarea>
							</div>
							<div class="form-group mt-15">
								<label>[DEFAULT_REPLY_TO]</label> <a class="text-muted" href="javascript:void(0);"><i title="" data-original-title="" data-container="body" data-toggle="popover" data-placement="right" data-trigger="click" data-content="This is the default email address your recipients will use when replying to your emails. <br><br>We suggest using an email address that you check regularly and avoid no-reply addresses. This creates a friendly, positive experience for your contacts. <br><br>This value may be modified for individual campaigns during Step 1 of the campaign creation process." data-html="true" class="fa fa-question-circle"></i></a>
								<input type="text" name="default_reply_to" class="form-control replyto" value="{{!$default_setting ? '' : $default_setting->default_reply_to}}" id="default-reply-to-input"> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
@endsection
