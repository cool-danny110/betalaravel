@extends('layouts.app')
<title>ACCOUNT : IMPORT CONTACT</title>
@section('content')
<div class="content-box contact-form">
    <form method="post" action="{{ route('contact.upload', $groupId) }}">
        @csrf
        <div class="sub-header">
            Import Contact
        </div>
        <input name="type" value="{{$type}}" hidden/>
        <div class="content-tool mt-3 mb-4">
            <a href="{{ route('contact.import', $groupId) }}">
                <button type="button" class="btn-form-danger text-white me-4">
                    <i class="fa fa-arrow-left"></i>Back
                </button>
            </a>
            <button type="submit" class="btn-form-primary text-white">
                + Upload
            </button>
        </div>
        <input name="filename" value="{{ $filename }}" hidden />
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            Please confirm the contact list that you imported and upload it.
        </div>
        <div class="contact-content mt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>E-mail</th>
                        <th>LAST NAME</th>
                        <th>FIRST NAME</th>
                        <th>SMS</th>
                        <th>WHATSAPP</th>
                        <th>DOUBLE_OPT-IN</th>
                        <th>OPT_IN</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($data) && count($data)!= 0)
                        <?php $index = 1; ?>
                        @foreach($data as $key => $value)
                            @if($value[0] != '' && $type == 'hybrid')
                                <tr>
                                    <td>{{ $value[0] }}</td>
                                    <td>{{ isset($value[1]) ? $value[1] : '' }}
                                    </td>
                                    <td>{{ isset($value[2]) ? $value[2] : '' }}
                                    </td>
                                    <td>{{ isset($value[3]) ? $value[3] : '' }}
                                    </td>
                                    <td>{{ isset($value[4]) ? $value[4] : '' }}
                                    </td>
                                    <td>{{ isset($value[5]) ? $value[5] : '' }}
                                    </td>
                                    <td>{{ isset($value[6]) ? $value[6] : '' }}
                                    </td>
                                </tr>
                            @elseif($value[0] != '' && $type == 'google')
                            	<tr>
                                    <td>{{ isset($value[30]) ? $value[30] : '' }}</td>
                                    <td>{{ isset($value[1]) ? $value[1] : '' }}
                                    </td>
                                    <td>{{ isset($value[1]) ? $value[3] : '' }}
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            @endif
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
        <div class="content-tool mt-3 mb-4">
            <button type="submit" class="btn-form-primary text-white">
                + Upload
            </button>
        </div>
</div>
@endsection
