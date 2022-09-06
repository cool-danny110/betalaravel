@extends('layouts.app')
<title>ACCOUNT : IMPORT CONTACT</title>
@section('content')
<div class="content contact-form">
    <div class="sub-header">
        Import Contact
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{ url('contact') }}">
            <button class="btn-form-danger text-white">
                <i class="fa fa-arrow-left"></i>Back To Contact List
            </button>
        </a>
    </div>
    <div class="row">
        <div class="contact-template col-4 ms-4 mt-3 mb-4">
            <div><a href="{{ asset('public/assets/templates/contact/samplecontact.csv') }}"
                    download><i class="fa fa-file-excel"></i><span class="ms-2">XLS contact template download</span></a>
            </div>
            <div><a href="{{ asset('public/assets/templates/contact/samplecontact.csv') }}"
                    download><i class="fa fa-file-csv"></i><span class="ms-2">CSV contact template download</span></a>
            </div>
            <div><a href="{{ asset('public/assets/templates/contact/samplecontact.txt') }}"
                    download><i class="fa fa-file-text"></i><span class="ms-2">TXT contact template download</span></a>
            </div>
        </div>
        <div class="contact-template col-4 ms-4 mt-3 mb-4">
            <div><a href="{{ asset('public/assets/templates/contact/samplegoogle.csv') }}"
                    download><i class="fa fa-file-csv"></i><span class="ms-2">Google csv template download</span></a>
            </div>
        </div>
    </div>
    @if( session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <form id="import_form" method="post" action="{{ route('contact.fileimport') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="mt-4 px-2">
            <label>Choose your template type:</label><br>
            <input type="radio" id="hybrid" name="type" value="hybrid" checked>
            <label for="hybrid">Hybrid Template</label>
            <input type="radio" id="google" name="type" value="google" class="ms-4">
            <label for="google">Google Template</label>
        </div>

        <div class="file-upload mt-4 px-2">
            <div class="file-upload-select">
                <div class="file-select-button">Choose File</div>
                <div class="file-select-name">No file chosen...</div>
                <input type="file" name="file" id="file-upload-input" accept=".csv, .txt">
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    let fileInput = document.getElementById("file-upload-input");
    let fileSelect = document.getElementsByClassName("file-upload-select")[0];
    fileSelect.onclick = function () {
        fileInput.click();
    }
    fileInput.onchange = function () {
        let filename = fileInput.files[0].name;
        let selectName = document.getElementsByClassName("file-select-name")[0];
        selectName.innerText = filename;
        $("#import_form").submit();
    }



    // fileInput.onchange = function() {
    //   $("#import_form").submit();
    //   // let filename = fileInput.files[0].name;
    //   // let selectName = document.getElementsByClassName("file-select-name")[0];
    //   // selectName.innerText = filename;
    // }


    // function importFile() {
    //   $("#import_form").submit();
    // }

</script>
@endsection('script')
