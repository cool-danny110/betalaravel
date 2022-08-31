@extends('layouts.app')
<title>ACCOUNT : Contacts</title>
@section('content')
<div class="content">
<div class="my_box">

<div class="test_box">
  <div class="box1">
      <h1>Contacts</h1>
  </div>
  <div class="box2">


    <button class="my_but">
      <svg viewBox="0 0 640 512" class="svg-icon-contact-btn"><path fill="currentColor" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path></svg><span class="spacer-left-xxs">Import contacts</span>
    </button>

    <a href="{{url('contact/create')}}">
      <button class="my_but2">
        <svg viewBox="0 0 640 512" class="svg-icon-contact-btn"><path fill="currentColor" d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg><span class="spacer-left-xxs">Add a contact</span>
      </button>
    </a>

  </div>
</div>


<style>
.contact_box {
  margin: 50px 0 15px 0;
}

.contact_box2 {
  margin: 12px 0 15px 0;
}


.contact_nav_box {
  margin: 20px 0 20px 0;
}

.np {
  padding: 0 !important;
}

.btn {
  background: #eee;
  margin-top: -3px;
  line-height: 1.5;
  padding: 6px 25px;
  border-radius: 0;
  font-size: 14px;
}

.btn2 {
  background: #eee;
  margin: -3px 1px 0 1px;
  line-height: 1.5;
  padding: 6px 10px;
  border-radius: 0;
  font-size: 14px;
  font-weight: 600;
  border: none !important;
  }


.my_input {
  padding: 6px 12px;
  font-size: 13px;
  color: #000;
  box-shadow: none;
  border-radius: 0;
  border-width: 1px;
  border-style: solid;
  border-color: #999;
}

.w200 {
  width:200px;
}

.alr {
  text-align: right;
}

button i {
  padding: 0 5px;
}
</style>

<div class="contact_box row">
    <div class="col-md-6 np">
      <select class="my_select"  style="width:200px;"><option value="all">All Contacts</option></select>
    </div>
    <div class="col-md-6 np alr">
      <form class="navbar-form pull-left">
        <input type="text" placeholder="Search contacts" class="span2 my_input w200">
        <button type="submit"  class="btn">Search</button>
      </form>
    </div>
</div>


<div class="contact_box row">
    <div class="col-md-6 np">

        <button  class="btn2"><i class="fa-solid fa-sort"></i> My Filter</button>            

    </div>


    
    <div class="col-md-6 np alr">

        Show Rows:
        <select class="contact_table_showing_rows" style="height: 34px;border:1px solid #ccc; min-width: 50px;vertical-align: 0%;">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50" selected="">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
        </select>
        <span class="contact_table_showing_first">1</span>-<span class="contact_table_showing_last">1</span> of <span class="contact_table_showing_total">1</span>
        <div class="btn-group" role="button" style="margin-top: -2px;">
        <button  class="btn2"><</button>
        <button  class="btn2">></button>

    </div>
</div>

<div class="mt-15 np">

  <table class="contact_table">
    <thead>
      <tr class="row_header">
        <th><span class="checkbox"></span></th>
        <th>E-mail <i class="fa-solid fa-sort"></i></th>
        <th>LAST NAME <i class="fa-solid fa-sort"></th>
        <th>FIRST NAME <i class="fa-solid fa-sort"></th>
        <th>SMS <i class="fa-solid fa-sort"></th>
        <th>WHATSAPP <i class="fa-solid fa-sort"></th>
        <th>DOUBLE_OPT-IN <i class="fa-solid fa-sort"></th>
        <th>OPT_IN <i class="fa-solid fa-sort"></th>
        <th>Last changed <i class="fa-solid fa-sort"></th>
        <th>Data added <i class="fa-solid fa-sort"></th>
      </tr>
    </thead>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
  </table>

</div>
</div>

   <div class="contact_box2 row">
    <div class="col-md-6 np"> 
    Go to: <input type="text" class="contact_table_page_number" title="Page number" style="width: 50px; height: 34px;border: 1px solid #ccc; padding-left: 3px;"> of <span class="contact_table_showing_total_page">1</span> <button class="btn2">GO</button>          
    </div>


    <div class="col-md-6 np alr">

        Show Rows:
        <select class="contact_table_showing_rows" style="height: 34px;border:1px solid #ccc; min-width: 50px;vertical-align: 0%;">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50" selected="">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
        </select>
        <span class="contact_table_showing_first">1</span>-<span class="contact_table_showing_last">1</span> of <span class="contact_table_showing_total">1</span>
        <div class="btn-group" role="button" style="margin-top: -2px;">
        <button  class="btn2"><</button>
        <button  class="btn2">></button>

    </div>
</div>
  
<br><br><br><br>
<h2 class="np">My List</h2>

<div class="contact_box2 np">
<div class="table-responsive">                <table class="table table-hover table-middle">                    <thead>                        <tr>                            <th class="td-w-xs">id</th>                            <th class="td-w-xlg">name</th>                            <th class="td-w-xlg">number of contacts</th>                            <th></th>                            <th class="td-w-sm listsDetails-th1 alr">actions</th>                        </tr>                    </thead>                    <tbody><tr id="list-2">                               <td class="text-muted">#2</td>                               <td class="listRename">Your first list</td>                               <td><a href="#"><span>1</span> Contact</a></td>                               <td class="text-right text-muted"></td><td class="text-right alr">                                <div class="btn-group">                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Actions <span class="caret"></span></button>                                    <ul class="dropdown-menu dropdown-menu-right">                                        <li><a placement="left" class="list_action" ref="Subscriber Manager" href="https://my.sendinblue.com/users/list/id/2"><i class="fa fa-user fa-fw"></i> Subscriber Manager</a></li>                                        <li><a class="list_action" ref="List Settings" href="https://my.sendinblue.com/lists/settings/id/2"><i class="fa fa-wrench fa-fw"></i> List Settings</a></li>                                        <li><a placement="left" class="list_action replicate_class" ref="Replicate" id="replicate_list_2" href="#"><i class="fa fa-file fa-fw"></i> Duplicate</a></li>                                        <li class="save-and-add" data-toggle="modal" list_id="2" data-target1="#modal-add-contact"><a placement="left" class="list_action" ref="Add Subscriber" href="#"><i class="fa fa-plus fa-fw"></i> Add a subscriber</a></li>                                        <li class="save-and-add" list_id="2" data-target1="#modal-import-files"><a placement="left" class="list_action" ref="Import Subscriber" href="https://my.sendinblue.com/users/upload-user-contacts/id/2"><i class="fa fa-download fa-fw"></i> Import subscribers</a></li>                                        <li class="save-and-add" list_id="2" data-target1="#modal-copy-paste-contacts"><a placement="left" class="menu__control_locked_padding list_action" ref="Copy Paste Subscriber" href="https://my.sendinblue.com/users/copy-paste-contacts/id/2"><i class="fa fa-share fa-fw"></i> Copy / Paste subscribers</a></li>                                        <li list_id="2" class="rename"><a placement="left" class="list_action" ref="Rename" href="#"><i class="fa fa-pencil fa-fw"></i> Rename</a></li><li><a placement="left" class="list_action delete_list" ref="Delete" id="delete_list_2" href="#"><i class="fa fa-trash fa-fw"></i> Delete</a></li>                                    </ul>                                </div>                            </td>                        </tr></tbody></table></div>
</div>



<div class="box_body" style="min-height:400px">

   
<style>

.dropdown-menu {
position: absolute;
top: 100%;
left: 0;
z-index: 1000;
display: none;
float: left;
min-width: 160px;
padding: 5px 0;
margin: 2px 0 0;
font-size: 14px;
text-align: left;
list-style: none;
background-color: #fff;
-webkit-background-clip: padding-box;
background-clip: padding-box;
border: 1px solid #ccc;
border: 1px solid rgba(0,0,0,.15);
border-radius: 4px;
-webkit-box-shadow: 0 6px 12px rgb(0 0 0 / 18%);
box-shadow: 0 6px 12px rgb(0 0 0 / 18%);
}

.dropdown-menu-right {
right: 0;
left: auto;
}

.open>.dropdown-menu {
display: block;
}




.checkbox, .radio-button {
background: #fff;
border: 1px solid #687484;
cursor: pointer;
display: inline-block;
height: 1em;
vertical-align: -0.125em;
width: 1em;
position: relative;
}

.how_header {
font-size: 14px;
font-weight: 500;
}

.contact_table td,
.contact_table th {
padding: 8px;
border: 1px solid #ccc;
}

.contact_table {
  width: 100%;
  border: 1px solid #ccc;
  font-size: 12px;
}




thead {
  background: #f5f5f5;
}


.test_box {
  display: flex;
  width: 100%;
}

.box1 {
  justify-content: start;
  height: 25px;
  width: 50%;
  text-align: left;
}

.box2 {
  justify-content: end;
  height: 25px;
  width: 50%;
  text-align: right;
}



                .content__header:not(.header_standalone) {
                    box-shadow: inset 0 -1px 0 #c0ccda;
                    padding-bottom: 1.5rem;
                }

                .content__header .content__heading {
                  font-size: 1.51571657rem;
                  line-height: 2rem;
                  font-weight: 700;
              }

              .content__header .header__cta {
          margin-left: auto;
      }

              .spacer-left-xs {
          margin-left: 10px!important;
      }



      .svg-icon-contact-btn {
          position: relative;
          top: -2px;
          width: 1.4rem;
          margin-right: 6px;
      }

      svg:not(:root) {
          overflow: hidden;
      }

      .spacer-left-xxs {
          margin-left: 5px!important;
      }



   

   </style>










</div>









</div>
</div>
@endsection
