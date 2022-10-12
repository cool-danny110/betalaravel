@extends('layouts.app')
<title>ACCOUNT : Dashboard</title>
@section('content')
<div class="content">
    <div class="my_box">

        <div class="box_head">
            <div class="item">
                <h1>Dashboard</h1>
            </div>
            <div class="item">
                <div class="top_link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#db0505" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                    <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
                    </svg> &nbsp;<a href="{{url('campaign/create')}}">Start Your New Campaign Now</a>
                </div>
            </div>
        </div>

        <div class="box_body">
            <div class="item">
                <div class="dash_icon"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#db0505;" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                    </svg></div>
                <div class="dash_nb" style="color:#db0505">{{$campaignNum}}</div>
                <div class="dash_info">Campaigns</div>
                <div class="dash_value">10%</div>
            </div>

            <div class="item">
                <div class="dash_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#222" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg>
                </div>
                <div class="dash_nb" style="color:#222">{{$contactsNum}}</div>
                <div class="dash_info">Contacts</div>
                <div class="dash_value">0%</div>
            </div>

            <div class="item">
                <div class="dash_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#666" class="bi bi-window-split" viewBox="0 0 16 16">
                        <path d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z"/>
                        <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2Zm12 1a1 1 0 0 1 1 1v2H1V3a1 1 0 0 1 1-1h12ZM1 13V6h6.5v8H2a1 1 0 0 1-1-1Zm7.5 1V6H15v7a1 1 0 0 1-1 1H8.5Z"/>
                        </svg>
                </div>
                <div class="dash_nb" style="color:#666">{{$templatesNum}}</div>
                <div class="dash_info">Templates</div>
                <div class="dash_value">0%</div>
            </div>

            <div class="item">
                <div class="dash_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#0092ff" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                </div>
                <div class="dash_nb" style="color:#0092ff">80</div>
                <div class="dash_info">Opened</div>
                <div class="dash_value">10%</div>
            </div>

            <div class="item">
                <div class="dash_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#1ab394" class="bi bi-hand-index-thumb" viewBox="0 0 16 16">
                        <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 0 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 1 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.118a.5.5 0 0 1-.447-.276l-1.232-2.465-2.512-4.185a.517.517 0 0 1 .809-.631l2.41 2.41A.5.5 0 0 0 6 9.5V1.75A.75.75 0 0 1 6.75 1zM8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v6.543L3.443 6.736A1.517 1.517 0 0 0 1.07 8.588l2.491 4.153 1.215 2.43A1.5 1.5 0 0 0 6.118 16h6.302a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046l-.048.002zm2.094 2.025z"/>
                    </svg>
                </div>
                <div class="dash_nb" style="color:#1ab394">20</div>
                <div class="dash_info">Clicked</div>
                <div class="dash_value">10%</div>
            </div>

            <div class="item">
                <div class="dash_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#f37e46" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                </div>
                <div class="dash_nb" style="color:#f37e46">0</div>
                <div class="dash_info">Blacklisted</div>
                <div class="dash_value">0%</div>
            </div>
            </div>

            <div class="box_body2">

                <div class="inbox_head">
                <div class="item">
                    <h2>Get started with email campaigns</h2>
                    <h4>Follow these first steps tosend your first email campaign</h4>
                </div>
                <div class="item"><a href="#">Skip this step</a></div>
                </div>

                <div class="inbox_body">
                <div class="item my_progress">         
                    <div class="progress blue"> 
                        <span class="progress-left"> <span class="progress-bar"></span> </span> <span class="progress-right"> <span class="progress-bar"></span> </span>
                        <div class="progress-value">100%</div>
                    </div>
                    <br>
                    <h5>Your e-mail campaigns setup</h5>
                </div>

                <div class="item my_info">
                
                    <div class="row">
                        <div class="col-md-2"><img src="{{URL::asset('public/assets/img/icon1.jpg')}}" /></div>
                        <div class="col-md-10">
                        <h4>Complete your profile form</h4>
                        <h5>Fill out your profile form to complete your registration</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><img src="{{URL::asset('public/assets/img/icon2.jpg')}}" /></div>
                        <div class="col-md-10">
                        <h4>Complete your profile form</h4>
                        <h5>Fill out your profile form to complete your registration</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"><img src="{{URL::asset('public/assets/img/icon3.jpg')}}" /></div>
                        <div class="col-md-10">
                        <h4>Complete your profile form</h4>
                        <h5>Fill out your profile form to complete your registration</h5>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
