@extends('layouts.app')
<title>ACCOUNT : Reports</title>
@section('content')
<div class="content-box">
    <div class="my_box">

    <div class="box_head">
        <div class="item">
        <h1>Reports</h1>
        </div>
        <div class="item">
        <div class="top_link">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#db0505" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
            <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
            </svg> &nbsp;<a href="new_campaign.php">Start Your New Campaign Now</a>
        </div>
        </div>
    </div>

    <div class="box_body3" style="min-height:680px">


    <div class="row">
    <div class="content_box col-md-3">
        
        
    <!--<i class="bi bi-calendar-date input-group-text"></i>-->
    <input type="text" class="datepicker_input form-control" placeholder="Select From Date" required aria-label="">
                
                

    </div>
    <div class="content_box col-md-3">

    <!--<i class="bi bi-calendar-date input-group-text"></i>-->
    <input type="text" class="datepicker_input form-control" placeholder="Select Until Date" required aria-label="">
                


    </div>
    <div class="content_box col-md-3">           
    
    <button id="validate" class="btn btn-primary btn-bottom-space" type="submit">
    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="#ffffff" viewBox="0 0 512 512" style="margin:-4px 4px 0 0"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M32 32C49.67 32 64 46.33 64 64V400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32zM128 128C128 110.3 142.3 96 160 96H352C369.7 96 384 110.3 384 128C384 145.7 369.7 160 352 160H160C142.3 160 128 145.7 128 128zM288 192C305.7 192 320 206.3 320 224C320 241.7 305.7 256 288 256H160C142.3 256 128 241.7 128 224C128 206.3 142.3 192 160 192H288zM416 288C433.7 288 448 302.3 448 320C448 337.7 433.7 352 416 352H160C142.3 352 128 337.7 128 320C128 302.3 142.3 288 160 288H416z"/></svg> Show Statistics</button>

    </div>
    <div class="content_box col-md-3">
        <table class="table">
    <tbody>
    <tr class="tooltip-help" data-placement="auto" data-toggle="tooltip" data-original-title="Total Sent Campaigns" data-container="body">
    <td style="border-top:none"><span>Total Sent</span></td>
    <td class="text-right" style="border-top:none" id="total_sent">0</td>
    </tr>
    <tr class="tooltip-help" data-placement="auto" data-toggle="tooltip" data-original-title="Number of contacts the campaign was sent to" data-container="body">
    <td><span>Total Recipients</span></td>
    <td class="text-right" id="results">0</td>
    </tr>
    <tr class="tooltip-help text-info" data-placement="auto" data-toggle="tooltip" data-original-title="Number of recipients that opened a campaign any number of times" data-container="body">
    <td><span>Total Opened</span></td>
    <td class="text-right" id="total_views">0</td>
    </tr>
    <tr class="tooltip-help text-success" data-placement="auto" data-toggle="tooltip" data-original-title="Number of recipients that clicked any tracked link any number of times in a campaign" data-container="body">
    <td><span>Total Clicked</span></td>
    <td class="text-right" id="total_clicks">0</td>
    </tr>
    <tr class="tooltip-help text-warning" data-placement="auto" data-toggle="tooltip" data-original-title="Number of contacts that opted out of your list using the unsubscribe link in a campaign" data-container="body">
    <td><span>Total Unsubscribed</span></td>
    <td class="text-right" id="total_unsub">0</td>
    </tr>
    <tr class="tooltip-help text-replied" data-placement="auto" data-toggle="tooltip" data-original-title="Number of contacts that replied to your SMS campaigns" data-container="body">
    <td><span>Total Replied</span></td>
    <td class="text-right" id="total_replied">0</td>
    </tr>
    <tr class="tooltip-help text-danger" data-placement="auto" data-toggle="tooltip" data-original-title="Total of non-existent address or blocked email address" data-container="body">
    <td><span>Total Soft + Hard Bounces</span></td>
    <td class="text-right" id="total_bounces">0</td>
    </tr>
    </tbody>
    </table>

    </div>
    </div>


    <div class="row">
    <div class="content_box col-md-4">

        <div class="card">
    <h5 class="card-header center blue-bg">Open Rate</h5>
    <div class="card-body">
    <div class="card-blue">0</div>
    </div>
    </div>

    </div>




    <div class="content_box col-md-4">

        <div class="card">
    <h5 class="card-header center green-bg">Click Rate</h5>
    <div class="card-body">
    <div class="card-green">0</div>
    </div>
    </div>

    </div>




    <div class="content_box col-md-4">

        <div class="card">
    <h5 class="card-header center orange-bg">Unsubscription Rate</h5>
    <div class="card-body">
    <div class="card-orange">0</div>
    </div>
    </div>
    </div>


    </div>

    <br><br><br>

    <h3>Email Campaigns</h3>

    <br><br>
    <div class="row">

    <div class="pane-content table-responsive">
    <table class="table table-hover table-middle my-table">
    <thead>
    <tr>
    <th class="td-w-xs">ID</th>
    <th class="td-w-xlg">Name</th>
    <th class="td-w-sm">Recipients</th>
    <th>Opened</th>
    <th>Clicked</th>
    <th class="hidden-sm">Unsubscribed</th>
    <th class="td-w-sm">Complaints</th>
    <th class="td-w-sm">Bounces <a class="text-muted" href="javascript:void(0);"><i class="fa fa-question-circle" data-content="The total number of hard bounces and soft bounces. <br><br>The term <b>hard bounce</b> is used to describe an email that has bounced back to the sender, undelivered to the intended recipient due to a permanent problem (ex: non-existent address or blocked email address). <br><br>The term <b>soft bounce</b> is used to describe an email that has bounced back to the sender, undelivered to the intended recipient due to a temporary problem (ex: the recipient’s server is unavailable or his inbox is full)." title="" data-placement="top" data-trigger="click" data-toggle="popover" data-html="true" role="button" tabindex="0" href="javascript:void(0);" data-original-title=""></i></a>
    </th>
    <th class="td-w-md hidden-sm">Sent date</th>
    <th class="td-w-sm">Actions</th>
    </tr>
    </thead>
    <tbody id="campaignDiv" style="background: rgb(255, 255, 255); padding: 8px; text-align: center; margin-top: 5px;"><tr><td colspan="10" style="text-align:center;">No Stats Found</td></tr></tbody>
    </table>
    <div class="text-center">
    <a href="#" class="btn btn-default btn-view-more" id="viewmore" style="display:none">View More </a>
    </div>
    </div>

    </div>

    <br><br>

    </div>









    </div>
</div>
@endsection
