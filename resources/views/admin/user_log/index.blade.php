@extends('layouts.backend')

@section('content')
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        User_log
                    </h4>
                    <div class="category">
                        {{--<a href="{{ url('/admin/user_log/create') }}" class="btn btn-success btn-sm"--}}
                           {{--title="Add New user_log">--}}
                            {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--</a>--}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/user_log', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input placeholder="请输入User Id" type="text" name="user_id" class="form-control" value="{{ request('user_id') }}">
                        </div>
                        <div class="form-group">
                            <select name="type" class="form-control">
                                <option value="">状态</option>
                                @foreach(\App\Models\UserLog::$types as $key=>$value)
                                    <option value="{{ $key }}" {{ Request::get('type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input placeholder="开始时间" type="text" name="date_from" class="form-control datetimepicker" value="{{ request('date_from') }}">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control datetimepicker" name="date_to" placeholder="结束时间"
                                   value="{{ request('date_to') }}">
                            <span class="input-group-btn">
                                                        <button class="btn btn-default" type="submit">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card-content">
                    <div class="toolbar">

                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Type</th>
                                <th>Desc</th>
                                <th>Browser Info</th>
                                <th>Ip</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_log as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('user.index', ['user_id'=>$item->user_id]) }}">{{ $item->user_id }}</a>
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->desc }}</td>
                                    <td>{{ $item->browser_info }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/user_log/' . $item->id) }}" title="View user_log">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/admin/user_log/' . $item->id . '/edit') }}"
                                           title="Edit user_log">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        {{--{!! Form::open([--}}
                                        {{--'method'=>'DELETE',--}}
                                        {{--'url' => ['/admin/user_log', $item->id],--}}
                                        {{--'style' => 'display:inline'--}}
                                        {{--]) !!}--}}
                                        {{--{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(--}}
                                        {{--'type' => 'submit',--}}
                                        {{--'class' => 'btn btn-danger btn-xs',--}}
                                        {{--'title' => 'Delete user_log',--}}
                                        {{--'onclick'=>'return confirm("Confirm delete?")'--}}
                                        {{--)) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        {!! $user_log->appends(['user_id' => Request::get('user_id'), 'type' => Request::get('type'), 'date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        $().ready(function () {
            // Init DatetimePicker
            app.initFormExtendedDatetimepickers();
        });
    </script>

@endsection