@extends('layouts.app')
<title>ACCOUNT : EDIT CAMPAIGN</title>
@section('content')
<div class="content contact-form">
    <div class="sub-header">
        Edit Campaign
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{url('campaign')}}">
            <button class="btn-form-danger text-white">
                <i class="fa fa-arrow-left"></i>Back To Campaign List
            </button>
        </a>
    </div>
    <form method="POST" action="{{route('campaign.update')}}">
    @csrf
    <input type="text" name="id" class="span2 my_input w200" value="{{$campaign->id}}" hidden>

    
    <div class="col-12">
      <label class="mt-3 ms-2">Campaign Name <span class=" text-danger">*</span></label>
    </div>
    <div class="col-12 mb-4">
      <input type="text" placeholder="Name*" name="name" class="span2 my_input w200" value="{{$campaign->name}}" required>
    </div>

    <!-- From Section Start -->
    <fieldset>
      <legend><i class="from-mark fa fa-check-circle me-2 {{($campaign->from_email == '' || $campaign->from_name == '') ? 'red-circle' : 'green-circle'}}"></i>From:</legend>
      <div class="row" style="padding: 20px;">
        <div class="col-6">
          <label for="from_email">Email Address: (*)</label>
          <input type="email" id="from_email" name="from_email" placeholder="[DEFAULT_FROM_EMAIL]" value="{{$campaign->from_email}}" onkeyup="markChange('from')" required>
        </div>
        <div class="col-6">
          <label for="from_name">Company name: (*)</label>
          <input type="text" id="from_name" name="from_name" placeholder="[DEFAULT_FROM_NAME]" value="{{$campaign->from_name}}" onkeyup="markChange('from')" required>
        </div>
        <div class="col-6">
          <label for="default_reply_to">Customize the Reply-To Email address:</label>
          <input type="email" id="default_reply_to" name="reply_to" placeholder="[DEFAULT_REPLY_TO]" value="{{$campaign->reply_to}}">
        </div>
        <div class="col-6">
          <label for="default_to">Customize the 'To' Field:</label>
          <input type="text" id="default_to" name="name_to" placeholder="[DEFAULT_TO]" value="{{$campaign->name_to}}">
        </div>
      </div>
    </fieldset>
    <!-- From Section End -->

    <!-- To Section Start -->
    <fieldset>
      <legend><i class="to-mark fa fa-check-circle me-2 {{($campaign->receiver_emails == '') ? 'red-circle' : 'green-circle'}}"></i>To: (*)</legend>
      <div class="row m-0" style="padding: 20px;">
        <label for="to_email_list">Send to:</label>
        <textarea type="email" id="to_email_list" name="receiver_emails" placeholder="Email receiver list separate by new line" rows="6" onkeyup="markChange('to')">{{$campaign->receiver_emails}}</textarea>
      </div>
    </fieldset>
    <!-- To Section End -->

    <!-- Subject Section Start -->
    <fieldset>
      <legend><i class="subject-mark fa fa-check-circle me-2 {{($campaign->subject_line == '' || $campaign->preview_text == '') ? 'red-circle' : 'green-circle'}}"></i>Subject:</legend>
      <div class="row" style="padding: 20px;">
        <div class="col-6">
          <label for="subject_line">Subject line: (*)</label>
          <input type="text" id="subject_line" name="subject_line" placeholder="[SUBJECT_LINE]" value="{{$campaign->subject_line}}" onkeyup="markChange('subject')" required>
        </div>
        <div class="col-6">
          <label for="preview_text">Preview text: (*)</label>
          <input type="text" id="preview_text" name="preview_text" placeholder="[PREVIEW_TEXT]"  value="{{$campaign->preview_text}}" onkeyup="markChange('subject')" required>
        </div>
      </div>
    </fieldset>
    <!-- Subject Section End -->

    <!-- Design Section Start -->
    <fieldset>
      <legend><i class="fa fa-check-circle me-2 {{($campaign->template_id == 0) ? 'red-circle' : 'green-circle'}}"></i>Design:</legend>
      <div class="row" style="padding: 20px;">
        
        <div class="offset-2 col-2">
          <img style="width: 100%;" src="{{asset('public/assets/img/template.png')}}"/>
        </div>
        <div class="offset-1 col-2 d-flex align-items-center">
          <button class="btn-form-transparent" type="submit" name="action" value="template">{{$campaign->template_id == 0 ? 'Select Design' : 'Change Design'}}</button>
        </div>
      </div>
    </fieldset>
    <!-- Design Section End -->

    <!-- Advanced settings Section Start -->
    <fieldset>
      <legend><i class="fa fa-check-circle me-2 green-circle"></i>Advanced settings:</legend>
      <div class="advanced_settings" style="padding: 20px;">
        <label class="setting" for="newsletter_settings">Newsletter settings:</label>
        <div class="row">
          <div class="col-6">
            <input type="checkbox" id="active_google_analystics" name="active_google_analytics" {{$campaign->active_google_analytics == 1 ? 'checked' : ''}}>
            <label class="setting-label" for="active_google_analystics"> Activate Google Analytics tracking </label>
          </div>
          <div class="col-6">
            <input type="checkbox" id="embed_images" name="embed_images" {{$campaign->embed_images == 1 ? 'checked' : ''}}>
            <label class="setting-label" for="embed_images"> Embed images in the email </label>
          </div>
          <div class="col-6">
            <input type="checkbox" id="add_a_tag" name="add_tag" {{$campaign->add_tag == 1 ? 'checked' : ''}}>
            <label class="setting-label" for="add_a_tag"> Add a tag </label>
          </div>
          <div class="col-6">
            <input type="checkbox" id="add_an_attachment" name="add_attachment" {{$campaign->add_attachment == 1 ? 'checked' : ''}}>
            <label class="setting-label" for="add_an_attachment"> Add an attachment </label>
          </div>
        </div>  
        <label class="setting" for="subscription_settings">Subscription settings:</label>
        <div class="row">
          <div class="col-6">
            <input type="checkbox" id="use_a_custom_unsubscribepage" name="custom_unsubscribe" {{$campaign->custom_unsubscribe == 1 ? 'checked' : ''}}>
            <label class="setting-label" for="use_a_custom_unsubscribepage"> Use a custom unsubscribe page </label>
          </div>
          <div class="col-6">
            <input type="checkbox" id="use_an_update_profile" name="update_profile_form" {{$campaign->update_profile_form == 1 ? 'checked' : ''}}>
            <label class="setting-label" for="use_an_update_profile"> Use an update profile form </label>
          </div>
        </div>  
        <label class="setting" for="design_settings">Design settings:</label>
        <div class="row">
          <div class="col-6">
            <input type="checkbox" id="enable_mirror_link" name="enable_mirror" {{$campaign->active_google_analytics == 1 ? 'checked' : ''}}>
            <label class="setting-label" for="enable_mirror_link"> Enable mirror link </label>
          </div>
        </div>  
      </div>
    </fieldset>
    <!-- Advanced settings Section End -->

    <div class="mt-4">
      <button type="submit" class="btn-form-primary float-end" name="action" value="campaign">
          Publish Campaign
      </button>
    </div>
  </form>
</div>
@endsection

@section('script')
<script>
function markChange(mode) {
  if(mode == 'from'){
    $(".from-mark").removeClass('red-circle');
    $(".from-mark").removeClass('green-circle');

    if($("#from_email").val() == '' || $("#from_name").val() == '')
      $(".from-mark").addClass('red-circle');
    else
      $(".from-mark").addClass('green-circle');
  } else if(mode == 'to'){
    $(".to-mark").removeClass('red-circle');
    $(".to-mark").removeClass('green-circle');

    if($("#to_email_list").val() == '')
      $(".to-mark").addClass('red-circle');
    else
      $(".to-mark").addClass('green-circle');
  } else if(mode == 'subject'){
    $(".subject-mark").removeClass('red-circle');
    $(".subject-mark").removeClass('green-circle');

    if($("#subject_line").val() == '' || $("#preview_text").val() == '')
      $(".subject-mark").addClass('red-circle');
    else
      $(".subject-mark").addClass('green-circle');
  }
}
</script>

@endsection