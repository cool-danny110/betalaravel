@extends('layouts.app')
<title>ACCOUNT : Contacts</title>
@section('content')
<div class="content">
    <div class="sub-header">
        Contact Groups
    </div>
    <div class="content-tool mt-3 mb-4">
        <a href="{{ url('group/create') }}">
            <button class="btn-form-danger text-white">
                + Add Group
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
    <div class="group-content mt-2">
        <table id="groupTable" class="display" width='100%' style='border-collapse: collapse;'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Group Name</th>
                    <th>Description</th>
                    <th>Number of contacts</th>
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
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->count }}</td>
                            <td>{{ date_format($value->created_at, 'd-m-Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ url('contact/'. $value->id) }}"><button
                                            class="btn-form-classic me-2">Add Contact</button></a>
                                    <a href="{{ url('group/edit/'. $value->id) }}"><button
                                            class="btn-form-classic me-2">Edit Group</button></a>
                                    <!-- <button class="btn-form-classic" onclick="show(this)">Delete</button> -->
                                </div>
                                <!-- <form method="post" action="{{ route('group.delete') }}">
                                    @csrf
                                    <input name="id" value="{{ $value->id }}" hidden />
                                    <div class="confirm-delete mt-2" style="display:none">
                                        <button type="submit" class="btn-form-danger text-white me-2">Yes</button>
                                        <button type="button" class="btn-form-primary"
                                            onclick="cancel(this)">Cancel</button>
                                    </div>
                                </form> -->
                            </td>
                        </tr>
                        <?php $index++; ?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">There is no group.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {

        // DataTable
        var table = $('#groupTable').DataTable({
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            columns: [{
                    orderable: true
                },
                {
                    orderable: true
                },
                {
                    orderable: false
                },
                {
                    orderable: true
                },
                {
                    orderable: true
                },
                {
                    orderable: false
                },
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
