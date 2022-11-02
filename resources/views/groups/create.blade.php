@extends('layouts.app')
<title>ACCOUNT : CREATE GROUP</title>
@section('content')
<div class="content-box contact-form">
    <div class="sub-header">
        Create Group
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{url('group')}}">
            <button class="btn-form-danger text-white">
                <i class="fa fa-arrow-left"></i>Back To Group List
            </button>
        </a>
    </div>
    <form method="POST" action="{{route('group.store')}}">
    @csrf
    <div class="row m-0" style="padding-top:20px;">
        <div class="col-12 col-md-6">
          <input type="text" placeholder="Group Name*" name="name" class="span2 my_input w200" required>
        </div>
        <div class="col-12 col-md-6">
          <label class="mt-3 ms-2 text-danger">Required*</label>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-12">
          <textarea placeholder="Description" name="description" class="m-0 mt-2"></textarea>
        </div>
    </div>
    <div class="mt-4">
      <button type="submit" class="btn-form-primary float-end">
          Add Group
      </button>
    </div>
  </form>
</div>
@endsection