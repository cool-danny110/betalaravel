@extends('layouts.app')
<title>ACCOUNT : Save Template</title>
@section('content')
<div class="content-box contact-form">
    <div class="sub-header">
      Save Template
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{url('design?id='. $template_id. '&type=user')}}">
            <button class="btn-form-danger text-white">
                <i class="fa fa-arrow-left"></i>Back To Design
            </button>
        </a>
    </div>
    @if( session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{route('template.storeTemplateDB')}}">
    @csrf
    <div class="row m-0" style="padding-top:20px;">
        <input name="action_type" value="{{$action_type}}" hidden/>
        <input name="template_id" value="{{$template_id}}" hidden/>
        <div class="col-12 col-md-6">
          <input id="name" type="text" placeholder="Input Template Name" name="name" class="span2 my_input w200" value="{{$org_name}}">
        </div>
        <div class="col-12 col-md-6">
          <label class="mt-3 ms-2 text-danger">Required*</label>
        </div>
    </div>
    
    <div class="mt-4">
      <button type="submit" name="action" value="save" class="btn-form-primary ms-2">
          {{$action_type == "new" ? "Save Template" : "Update Template"}}
      </button>
      <?php if($action_type == "new"){?>
      <button type="submit" name="action" value="close" class="btn-form-danger ms-2">
          Don't Save
      </button>
      <?php }?>
    </div>
  </form>
</div>
@endsection
@section('script')
  <script>
    $("#name").focus();
  </script>
@endsection