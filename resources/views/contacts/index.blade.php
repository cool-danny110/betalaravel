@extends('layouts.app')
<title>ACCOUNT : Contacts</title>
@section('content')
<div class="content">
    <div class="sub-header">
        Contacts
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{url('contact/import')}}">
            <button class="btn-form-primary me-4">
                Import Contact
            </button>
        </a>
        <a href="{{url('contact/create')}}">
            <button class="btn-form-danger text-white">
                + Add Contact
            </button>
        </a>
    </div>
    @if ( session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="contact-content mt-2">
        <table id="contactTable" class="table table-bordered" width='100%' border="1" style='border-collapse: collapse;'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>E-mail</th>
                    <th>LAST NAME</th>
                    <th>FIRST NAME</th>
                    <th>SMS</th>
                    <th>WHATSAPP</th>
                    <th>DOUBLE_OPT-IN</th>
                    <th>OPT_IN</th>
                    <th>Last changed</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data) && $data->count())
                    <?php $index = 1; ?>
                    @foreach($data as $key => $value)
                        <tr>
                            <td>{{ ((isset($_GET['page']) ? $_GET['page'] : 1)  - 1) * env('itemsperpage') + $index }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->lastname }}</td>
                            <td>{{ $value->firstname }}</td>
                            <td>{{ $value->sms }}</td>
                            <td>{{ $value->whatsapp }}</td>
                            <td>{{ $value->double_opt_in }}</td>
                            <td>{{ $value->opt_in }}</td>
                            <td>{{ $value->updated_at }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{url('contact/edit/'. $value->id)}}"><button class="btn-form-classic me-2">Edit</button></a>
                                    <button class="btn-form-classic" onclick="show(this)">Delete</button>
                                </div>
                                <form method="post" action="{{route('contact.delete')}}">
                                    @csrf
                                    <input name="id" value="{{$value->id}}" hidden/>
                                    <div class="confirm-delete mt-2" style="display:none">
                                        <button type="submit" class="btn-form-danger text-white me-2">Yes</button>
                                        <button type="button" class="btn-form-primary" onclick="cancel(this)">Cancel</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php $index++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    
    $(document).ready(function(){

        // DataTable
        $('#contactTable').DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            columns: [
                { orderable: true },
                { orderable: false },
                { orderable: false },
                { orderable: false },
                { orderable: false },
                { orderable: false },
                { orderable: false },
                { orderable: false },
                { orderable: true },
                { orderable: true },
                { orderable: false },
            ]
        });

    });

    function cancel(obj) {
        $(obj).parent().css('display', 'none');
    }

    function show(obj) {
        $('.confirm-delete').css('display', 'none');
        console.log($(obj).parent().parent().find('.confirm-delete')[0].style.display);
        $(obj).parent().parent().find('.confirm-delete')[0].style.display = "flex";
    }
</script>
@endsection
