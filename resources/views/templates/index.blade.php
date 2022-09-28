@extends('layouts.app')
<title>ACCOUNT : TEMPLATES</title>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .item-desc a {
        color: #555;
    }

    .coming_soon {
        font-size: 33px;
        font-weight: 100;
        color: #999;
        margin: 45px auto;
        padding: 20px;
    }

    .card img {
        -webkit-transition: opacity 0.5s ease-in-out;
        -moz-transition: opacity 0.5s ease-in-out;
        -ms-transition: opacity 0.5s ease-in-out;
        -o-transition: opacity 0.5s ease-in-out;
        transition: opacity 0.5s ease-in-out;
    }

    .btn-primary {
        color: #fff;
        background-color: #cf0b0b !important;
        border-color: #cf0b0b !important;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #000 !important;
        border-color: #000 !important;
    }

    .footer {
        font-size: 12px;
    }

    .btn-primary:not(:disabled):not(.disabled).active,
    .btn-primary:not(:disabled):not(.disabled):active,
    .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #ff7d28;
        border-color: #ff7d28;
    }

    .btn-primary.focus,
    .btn-primary:focus {
        color: #fff;
        background-color: #ff7d28;
        border-color: #ff7d28;
        box-shadow: 0 0 0 0.2rem rgba(255, 166, 38, 0.5);
    }

    .card img:hover {
        opacity: 0.8;
    }

    .shadow-sm {
        box-shadow: 0 .125rem .5rem rgba(0, 0, 0, .2) !important;
    }

</style>
@section('content')
<div class="content contact-form">
    <div class="sub-header">
        Templates
    </div>
    <!-- <div class="content-tool mt-3 mb-4">
        <a href="">
            <button class="btn-form-danger text-white">
                <i class="fa fa-plus"></i>Create Template
            </button>
        </a>
    </div> -->

    <!-- Customized User Template Start -->
    <?php if(count($mylist) != 0) {?>
    <div class="album py-5 bg-light" id="mytemplates">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-normal font-size-40">My Templates</h2>
                <p class="text-muted">
                    Here are templates that you made yourself from basic and featured templates. Enjoy now!
                </p>
            </div>
            <div class="row">
                <?php
        foreach ($mylist as $template) {
            $template_id = $template->template_id;
            $name = $template->name;
            $user = $template->user;
            if ($template_id != '0_3_form_builder') {
                $path = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/user/" . $template_id;
                if(file_exists($path . "/index.html")){
                    $files = glob($path . "/index.html");
                    $content = file_get_contents($files[0]);
                    $preg_matchs = preg_match_all('/(<title\>([^<]*)\<\/title\>)/i', $content, $m);
                    $title = $m[2][0];

                    $id = $template_id; 
                }
                ?>
                <?php if(file_exists($path . "/index.html")){ ?>
                <div class="col-md-3" id="template_card_{{ $id }}">
                    <div class="card mb-4 shadow-sm"
                        style="{{ session('badge') == $id ? 'border: solid 3px red' : '' }}">
                        <div style="height: 400px; width: 100%; background-size: 100% auto; background-image:url('{{asset('public/templates/user/'. $template_id. '/thumb.png')}}')">

                        </div>
                        <div class="card-body">
                            <h5><?php echo $name ?></h5>
                            <div class="JHf2a mb-4 small text-muted item-desc">
                                {{ date_format($template->created_at, 'H:i d-m-Y') }}
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ url('/design?id='. $id. '&type=user') }}"
                                        class="btn btn-sm btn-primary">Select</a>
                                </div>
                                <a style="cursor:pointer;"><small class=" text-danger fw-bold"
                                        onClick="removeTemplate('{{ $id }}')">Remove</small></a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <form action="{{route('template.testEmailSending')}}" method="post" >
                                    @csrf
                                    <input name="templateId" value="{{$template_id}}" hidden>
                                    <input class="w-100" name="address" placeholder="Receiver Address" required>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-form-primary">
                                            Test Email Sending
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <?php
            }
        } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Customized User Template End -->
    
    <!-- Featured Template Start -->
    @if ( session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="album py-5 bg-light" id="example">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-normal font-size-40">Featured Templates</h2>
                <p class="text-muted">
                    Start your design by choosing one of available featured templates that come with our HybridMail
                    application.
                </p>
            </div>
            <div class="row">
                <?php
        $dir = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/featured/";
        $templateUrl = array_diff(scandir($dir), array('..', '.'));
        foreach ($templateUrl as $name) {
            if ($name != '0_3_form_builder') {
                $path = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/featured/" . $name;
                $files = glob($path . "/index.html");
                $content = file_get_contents($files[0]);
                $preg_matchs = preg_match_all('/(<title\>([^<]*)\<\/title\>)/i', $content, $m);
                $title = $m[2][0];

                $id = $name; ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <a>
                            <img width="100%" height="100%" class="_1xvs1"
                                src="{{ asset('public/templates/featured/'. $name . '/thumb.png') }}"
                                title="<?php echo $title ?>" alt="<?php echo $title ?>">
                        </a>
                        <div class="card-body">
                            <h5><?php echo $title ?></h5>
                            <div class="JHf2a mb-4 small text-muted item-desc"><i> by </i><a class="R8zaM"
                                    href="javascript:;">HybridMail</a><span> at </span><a class="R8zaM"
                                    href="javascript:;">KrenkyStudio</a></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <form method="post" action="{{ url('/template/select') }}">
                                        @csrf
                                        <input name="id" value="{{ $id }}" hidden />
                                        <input name="type" value="featured" hidden />
                                        <button type="submit" class="btn btn-sm btn-primary">Select</button>
                                    </form>
                                </div>
                                <!-- <a href="#"><small class="text-muted">Preview</small></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } ?>
            </div>
        </div>
    </div>
    <!-- Featured Template End -->

    <!-- Default Template Start -->
    <div class="album py-5 bg-light" id="example">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="font-weight-normal font-size-40">Basic Templates</h2>
                <p class="text-muted">
                    Start your design by choosing one of available free layout templates that come with our
                    HybridMail application.
                </p>
            </div>
            <div class="row">
                <?php
        $dir = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/default/";
        $templateUrl = array_diff(scandir($dir), array('..', '.'));
        foreach ($templateUrl as $name) {
            if ($name != '0_3_form_builder') {
                $path = __DIR__ . DIRECTORY_SEPARATOR . "../../../public/templates/default/" . $name;
                $files = glob($path . "/index.html");
                $content = file_get_contents($files[0]);
                $preg_matchs = preg_match_all('/(<title\>([^<]*)\<\/title\>)/i', $content, $m);
                $title = $m[2][0];

                $id = $name; ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <a>
                            <img width="100%" height="100%" class="_1xvs1"
                                src="{{ asset('public/templates/default/'. $name. '/thumb.png') }}"
                                title="<?php echo $title ?>" alt="<?php echo $title ?>">
                        </a>
                        <div class="card-body">
                            <h5><?php echo $title ?></h5>
                            <div class="JHf2a mb-4 small text-muted item-desc"><i> by </i><a class="R8zaM"
                                    href="javascript:;">HybridMail</a><span> at </span><a class="R8zaM"
                                    href="javascript:;">KrenkyStudio</a></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <form method="post" action="{{ url('/template/select') }}">
                                        @csrf
                                        <input name="id" value="{{ $id }}" hidden />
                                        <input name="type" value="default" hidden />
                                        <button type="submit" class="btn btn-sm btn-primary">Select</button>
                                    </form>
                                </div>
                                <!-- <a href="#"><small class="text-muted">Preview</small></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } ?>
            </div>
        </div>
    </div>
    <!-- Default Template End -->
</div>
@endsection

@section('script')
<script>
    function removeTemplate(id) {
        swal({
                title: "Confirm",
                text: "Do you want to remove this template?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('template.remove') }}",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        method: "post",
                        data: {
                            template_id: id
                        }
                    }).then(() => {
                        $("#template_card_" + id).remove();
                    })
                }
            });

    }

</script>
@endsection
