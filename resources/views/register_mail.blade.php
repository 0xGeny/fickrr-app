<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(3165,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(3165,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        {{ Helper::translation(3166,$translate) }} {{$email}} , {{ Helper::translation(3167,$translate) }}
                        <br/>
                        <a href="{{url('/user-verify')}}/{{ $user_token }}">{{ Helper::translation(3168,$translate) }}</a>    
                    </div>
                </div>
            </div>
        </div>
     </section>
</body>
</html>