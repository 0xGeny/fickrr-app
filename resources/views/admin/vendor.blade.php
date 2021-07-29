<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    @include('admin.stylesheet')
</head>

<body>
    
    @include('admin.navigation')

    <!-- Right Panel -->
    @if(Auth::user()->id == 1)
    <div id="right-panel" class="right-panel">

        
                       @include('admin.header')
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ Helper::translation(5616,$translate) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <a href="{{ url('/admin/add-vendor') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ Helper::translation(5055,$translate) }}</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
         @if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">{{ Helper::translation(5616,$translate) }}</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ Helper::translation(2920,$translate) }}</th>
                                            <th>{{ Helper::translation(2917,$translate) }}</th>
                                            @if($addition_settings->subscription_mode == 0)
                                            <th>{{ Helper::translation(2915,$translate) }}</th>
                                            @endif
                                            <th>{{ Helper::translation(5061,$translate) }}</th>
                                            @if($addition_settings->subscription_mode == 1)
                                            <th>{{ Helper::translation(6156,$translate) }}</th>
                                            <th>{{ Helper::translation(6219,$translate) }}<br/><small>({{ Helper::translation(6222,$translate) }})</small></th>
                                            <th>{{ Helper::translation(5670,$translate) }}?<br/><small>({{ Helper::translation(6222,$translate) }})</small></th>
                                            <th>Account Verification</th>
                                            @endif
                                            <th>{{ Helper::translation(5199,$translate) }}</th>
                                            <th>{{ Helper::translation(4827,$translate) }}</th>
                                            <th>{{ Helper::translation(3106,$translate) }}</th>
                                            <th>{{ Helper::translation(2922,$translate) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @php $no = 1; @endphp
                                    @foreach($userData['data'] as $user)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $user->username }}</td>
                                            @if($addition_settings->subscription_mode == 0)
                                            <td>{{ $user->email }}</td>
                                            @endif
                                            <td>@if($user->user_photo != '') <img height="50" src="{{ url('/') }}/public/storage/users/{{ $user->user_photo }}" alt="{{ $user->name }}" class="userphoto"/>@else <img height="50" src="{{ url('/') }}/public/img/no-user.png" alt="{{ $user->name }}" class="userphoto"/>  @endif</td>
                                            @if($addition_settings->subscription_mode == 1)
                                            <td>{{ $user->user_subscr_type }} @if($user->user_subscr_date < date('Y-m-d'))<span class="badge badge-danger">{{ Helper::translation(6225,$translate) }}</span>@endif</td>
                                            <td>@if($user->user_purchase_token != '') {{ $user->user_purchase_token }} @else <span>---</span> @endif</td>
                                            <td>@if($user->user_purchase_token != '') <a href="{{ URL::to('/admin/customer') }}/{{ $user->user_token }}/{{ $user->user_subscr_id }}" class="btn btn-success btn-sm" onClick="return confirm('{{ Helper::translation(6228,$translate) }}?');"><i class="fa fa-money"></i>&nbsp; {{ Helper::translation(5475,$translate) }}</a> @else <span>---</span> @endif</td>
                                            <td>@if($user->user_document_verified == 1) <span class="badge badge-success">{{ Helper::translation(5202,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(5205,$translate) }}</span> @endif</td>
                                            @endif
                                            <td>@if($user->verified == 1) <span class="badge badge-success">{{ Helper::translation(5202,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(5205,$translate) }}</span> @endif</td>
                                            <td>@if($user->exclusive_author == 1) <span class="badge badge-success">{{ Helper::translation(5883,$translate) }}</span> @else <span class="badge badge-danger">{{ Helper::translation(5886,$translate) }}</span> @endif</td>
                                            
                                            <td>{{ $user->earnings }} {{ $allsettings->site_currency }}</td>
                                            <td><a href="edit-vendor/{{ $user->user_token }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp; {{ Helper::translation(2923,$translate) }}</a>
                                            @if($demo_mode == 'on') 
                                            <a href="demo-mode" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>
                                            @else 
                                            <a href="vendor/{{ $user->user_token }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ Helper::translation(5064,$translate) }}?');"><i class="fa fa-trash"></i>&nbsp;{{ Helper::translation(2924,$translate) }}</a>@endif</td>
                                        </tr>
                                        @php $no++; @endphp
                                   @endforeach     
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    @else
    @include('admin.denied')
    @endif 
    <!-- Right Panel -->


   @include('admin.javascript')


</body>

</html>
