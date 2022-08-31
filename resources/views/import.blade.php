@extends('layouts.app')
<title>ACCOUNT : Import Contacts</title>
@section('content')
<div class="content">
    <div class="my_box" style="min-height:850px">

    <div class="box_head row">

    <div class="col-md-6">
        <h1>Import Contacts</h1>

    </div>







    <div class="col-md-6 right pdt-5">
        <a href="contacts.php">
    <button class="my_but2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" ><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M77.25 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C175.6 444.9 183.8 448 192 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L77.25 256zM269.3 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C367.6 444.9 375.8 448 384 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L269.3 256z"/></svg></svg><span class="spacer-left-xxs">Go Back</span>
    </button>
    </a>

    </div>
    </div>

    <div class="box_body" >



    <div class="my_head">
    All plans include <strong>unlimited</strong> contacts for <strong>free</strong>. Add contacts in bulk by uploading a file or manually copy/pasting them from a file. 
    Do you want to <a href="#">blacklist contacts</a>?
    </div>


    <div class="row w100 mt-15">
    <div class="col-md-6">

    <div class="selection_box">
    <svg width="36px" height="48px" viewBox="0 0 36 48">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    <g transform="translate(-286.000000, -296.000000)" fill-rule="nonzero">
    <g transform="translate(148.000000, 200.000000)">
    <g id="Group" transform="translate(0.000000, 80.000000)">
    <g id="Icon-Upload" transform="translate(138.000000, 16.000000)">
    <path d="M21,12.75 C21,13.9875 22.0125,15 23.25,15 L36,15 L36,45.75 C36,46.996875 34.996875,48 33.75,48 L2.25,48 C1.003125,48 0,46.996875 0,45.75 L0,2.25 C0,1.003125 1.003125,0 2.25,0 L21,0 L21,12.75 Z M27.110625,33.0009375 C28.449375,33.0009375 29.116875,31.38 28.1653125,30.4359375 L19.1259375,21.4640625 C18.5025,20.844375 17.495625,20.844375 16.8721875,21.4640625 L7.8328125,30.4359375 C6.8821875,31.38 7.550625,33.0009375 8.889375,33.0009375 L15,33.0009375 L15,40.5009375 C15,41.3296875 15.67125,42.0009375 16.5,42.0009375 L19.5,42.0009375 C20.32875,42.0009375 21,41.3296875 21,40.5009375 L21,33.0009375 L27.110625,33.0009375 Z" id="Combined-Shape" fill="#3A75AA"></path>
    <path d="M35.34375,9.84375 L26.165625,0.65625 C25.74375,0.234375 25.171875,0 24.571875,0 L24,0 L24,12 L36,12 L36,11.428125 C36,10.8375 35.765625,10.265625 35.34375,9.84375 Z" id="Path" fill="#0092FF"></path>
    </g>
    </g>
    </g>
    </g>
    </g>
    </svg>
    <br />
    <h4 class="no_underline">Upload a File</h4>
    <p class="no_underline">Select a .csv, .xlsx or .txt file from your computer</p>
    </div>

    </div>


    <div class="col-md-6">
    <div class="selection_box">

    <svg width="42px" height="48px" viewBox="0 0 42 48" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    <g transform="translate(-619.000000, -296.000000)" fill-rule="nonzero">
    <g transform="translate(148.000000, 200.000000)">
    <g id="group" transform="translate(336.000000, 80.000000)">
    <g id="icon-copy" transform="translate(135.000000, 16.000000)">
    <path d="M30,42 L30,45.75 C30,46.9926562 28.9926562,48 27.75,48 L2.25,48 C1.00734375,48 0,46.9926562 0,45.75 L0,11.25 C0,10.0073438 1.00734375,9 2.25,9 L9,9 L9,36.75 C9,39.6449063 11.3550937,42 14.25,42 L30,42 Z" id="copy" fill="#3A75AA"></path>
    <path d="M30,9.75 L30,0 L14.25,0 C13.0073438,0 12,1.00734375 12,2.25 L12,36.75 C12,37.9926562 13.0073438,39 14.25,39 L39.75,39 C40.9926562,39 42,37.9926562 42,36.75 L42,12 L32.25,12 C31.0125,12 30,10.9875 30,9.75 Z" id="Path" fill="#0092ff"></path>
    <path d="M41.3410313,6.84103125 L35.1589687,0.65896875 C34.7370181,0.237039858 34.1647442,3.11996372e-06 33.5680313,0 L33,0 L33,9 L42,9 L42,8.43196875 C41.9999969,7.83525581 41.7629601,7.26298189 41.3410313,6.84103125 Z" id="Path" fill="#0092ff"></path>
    </g>
    </g>
    </g>
    </g>
    </g>
    </svg>
    <br />
    <h4 class="no_underline">Copy / Paste</h4>
    <p class="no_underline">Copy and paste contacts from your .xls file</p>

    </div>
    </div>
    </div>




    </div>










    </div>
</div>
@endsection
