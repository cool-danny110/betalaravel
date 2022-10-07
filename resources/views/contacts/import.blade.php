@extends('layouts.app')
<title>ACCOUNT : IMPORT CONTACT</title>
@section('content')
<div class="content contact-form">
    <div class="sub-header">
        Import Contact
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{ route('contact.index', $groupId) }}">
            <button class="btn-form-danger text-white">
                <i class="fa fa-arrow-left"></i>Back To Contact List
            </button>
        </a>
    </div>
    <label class="mb-2">Choose one of your template type:</label><br>
    @if( session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <fieldset>
        <div class="row m-0">
            <legend style="font-size: 20px;">Hybridmail contact template:</legend>

            <div class="contact-template ms-4 mt-3 mb-4">
                <div><a href="{{ asset('public/assets/templates/contact/samplecontact.csv') }}"
                        download><i class="fa fa-file-excel"></i><span class="ms-2">XLS contact template
                            download</span></a>
                </div>
                <div><a href="{{ asset('public/assets/templates/contact/samplecontact.csv') }}"
                        download><i class="fa fa-file-csv"></i><span class="ms-2">CSV contact template
                            download</span></a>
                </div>
                <div><a href="{{ asset('public/assets/templates/contact/samplecontact.txt') }}"
                        download><i class="fa fa-file-text"></i><span class="ms-2">TXT contact template
                            download</span></a>
                </div>
            </div>
        </div>

        <form id="import_form_hybrid" method="post" action="{{ route('contact.fileimport', $groupId) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mt-4 px-4">
                <label>Upload your contact file:</label><br>
            </div>
            <input value="hybrid" name="type" hidden />

            <div class="file-upload mt-4 px-4">
                <div class="file-upload-select" id="file-upload-select-hybrid">
                    <div class="file-select-button">Choose File</div>
                    <div class="file-select-name" id="file-select-name-hybrid">No file chosen...</div>
                    <input type="file" name="file" id="file-upload-input-hybrid" accept=".csv, .txt">
                </div>
            </div>
        </form>
    </fieldset>

    <fieldset>
        <div class="row m-0">
            <legend style="font-size: 20px;">Google contact template:</legend>

            <div class="contact-template ms-4 mt-3 mb-4">
                <div><a href="{{ asset('public/assets/templates/contact/samplegoogle.csv') }}"
                        download><i class="fa fa-file-csv"></i><span class="ms-2">Google csv template
                            download</span></a>
                </div>
            </div>
        </div>

        <form id="import_form_google" method="post" action="{{ route('contact.fileimport', $groupId) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mt-4 px-4">
                <label>Upload your contact file:</label><br>
            </div>
            <input value="google" name="type" hidden />
            <div class="file-upload mt-4 px-4">
                <div class="file-upload-select" id="file-upload-select-google">
                    <div class="file-select-button">Choose File</div>
                    <div class="file-select-name" id="file-select-name-google">No file chosen...</div>
                    <input type="file" name="file" id="file-upload-input-google" accept=".csv">
                </div>
            </div>
        </form>
    </fieldset>
</div>
@endsection
@section('script')
<script>
    let fileInputGoogle = document.getElementById("file-upload-input-google");
    let fileSelectGoogle = document.getElementById("file-upload-select-google");
    fileSelectGoogle.onclick = function () {
        fileInputGoogle.click();
    }
    fileInputGoogle.onchange = function () {
        let filename = fileInputGoogle.files[0].name;
        let selectName = document.getElementById("file-select-name-google");
        selectName.innerText = filename;
        $("#import_form_google").submit();
    }

    let fileInputHybrid = document.getElementById("file-upload-input-hybrid");
    let fileSelectHybrid = document.getElementById("file-upload-select-hybrid");
    fileSelectHybrid.onclick = function () {
        fileInputHybrid.click();
    }
    fileInputHybrid.onchange = function () {
        let filename = fileInputHybrid.files[0].name;
        let selectName = document.getElementById("file-select-name-hybrid");
        selectName.innerText = filename;
        $("#import_form_hybrid").submit();
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
