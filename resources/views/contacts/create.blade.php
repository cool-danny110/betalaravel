@extends('layouts.app')
<title>ACCOUNT : CREATE CONTACT</title>
@section('content')
<div class="content-box contact-form">
    <div class="sub-header">
        Create Contact
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{route('contact.index', $groupId)}}">
            <button class="btn-form-danger text-white">
                <i class="fa fa-arrow-left"></i>Back To Contact List
            </button>
        </a>
    </div>
    @if( session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if( session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{route('contact.store')}}">
    @csrf
    <input name="groupId" value="{{$groupId}}" hidden/>
    <div class="row m-0" style="padding-top:20px;">
        <div class="col-12 col-md-6">
          <input type="email" placeholder="Email Address*" name="email" class="span2 my_input w200" required>
        </div>
        <div class="col-12 col-md-6">
          <label class="mt-3 ms-2 text-danger">Required*</label>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-12 col-md-6">
          <input type="text" placeholder="Last Name" name="lastname" class="span2 my_input w200">
        </div>
        <div class="col-12 col-md-6">
          <input type="text" placeholder="First Name" name="firstname" class="span2 my_input w200">
        </div>
    </div>
    <div class="row m-0">
        <div class="col-12 col-md-6">
          <input type="text" placeholder="SMS" name="sms" class="span2 my_input w200">
        </div>
        <div class="col-12 col-md-6">
          <input type="text" placeholder="Whatsapp" name="whatsapp" class="span2 my_input w200">
        </div>
    </div>
    <div class="row m-0">
        <div class="col-12 col-md-6">
          <input type="text" placeholder="DOUBLE_OPT-IN" name="double_opt_in" class="span2 my_input w200">
        </div>
        <div class="col-12 col-md-6">
          <input type="text" placeholder="OPT_IN" name="opt_in" class="span2 my_input w200">
        </div>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn-form-primary float-end">
          Add Contact
      </button>
    </div>
  </form>
</div>
@endsection