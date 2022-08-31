@extends('layouts.app')
<title>ACCOUNT : Settings</title>
@section('content')
<div class="content">
    <div class="sub-header">
        Setting
    </div>
    <div class="row m-0">
        <div class="col-12 col-md-6">
            <div class="setting-box">
                <center>
                <!-- FA Icon here -->
                <span class="fa-stack fa-2x text-muted spacer-bottom-xs">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-cog fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="mt-3 mb-3 setting-box-title">Default Settings</h4>
                <div class="setting-box-content">
                    <p class="mb-4 font-size-14">Adjust your account preferences and the default contact information displayed in your campaigns.</p>
                    <a href="{{url('/setting/default')}}"><button class="setting-btn mt-2">
                        Configure
                    </button></a>
                </div>
                </center>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="setting-box">
                <center>
                <span class="fa-stack fa-2x text-success spacer-bottom-xs">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="mt-3 mb-3 setting-box-title">Test List</h4>
                <div class="setting-box-content">
                    <p class="mb-4 font-size-14">Set up a list of contacts to receive a test version of your campaigns before they are sent to your full contact list.</p>
                    <button class="setting-btn mt-2">
                        Set up
                    </button>
                </div>
                </center>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="setting-box">
                <center>
                <span class="fa-stack fa-2x text-primary spacer-bottom-xs">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="mt-3 mb-3 setting-box-title">Your Sender & Domains</h4>
                <div class="setting-box-content">
                    <p class="mb-4 font-size-14">Create as many senders as you need and sign them with your domains (SPF, DKIM).</p>
                    <button class="setting-btn mt-2">
                        Configure
                    </button>
                </div>
                </center>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="setting-box">
                <center>
                <span class="fa-stack fa-2x text-warning spacer-bottom-xs">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="mt-3 mb-3 setting-box-title">Get Dedicated IP</h4>
                <div class="setting-box-content">
                    <p class="mb-4 font-size-14">Manage your dedicated IP(s), and monitor your reputation and deliverability.</p>
                    <button class="setting-btn mt-2">
                        Buy
                    </button>
                </div>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection