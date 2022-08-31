@extends('layouts.app')
<title>ACCOUNT : Start New Campaign</title>
@section('content')
<div class="content">
  <div class="box_body" >
    <div class="row w100 mt-15">
      <div class="col-md-6 my_center">
        <div class="selection_box">
          <form action="{{route('campaign.store')}}" method="post">
            @csrf
            <svg viewBox="0 0 50 50" width="80" height="80" class=""><g fill-rule="nonzero" fill="none"><path fill="#FFD9D4" d="M9.45 12.681H44.79v28.986H9.45z"></path><path fill="#044A75" d="M5.208 8.333H40.55V37.32H5.208z"></path><path fill="#0092FF" d="M5.208 8.333h35.343L22.91 24.275z"></path></g></svg>
            <h3>Create an email campaign</h3>
            <p class="no_underline">Keep subscribers engaged by sharing your latest news, promoting your bestselling products, or announcing an upcoming event.</p>
            <div class="row">
              <div class="col-md-10 al-left my_center">
                <legend>Campaign Name:</legend>
                <input class="my_input w100" name="name"/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 my_center">
                  <button type="submit" class="my_but mt-15 mb-20">Create New Campaign</button>
              </div>
            </div>
          </form>   
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
