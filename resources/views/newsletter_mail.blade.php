<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(3005,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(3005,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p>{{ Helper::translation(3094,$translate) }}</p>
                        <p>{{ Helper::translation(3095,$translate) }} <a href="{{ $activate_url }}">{{ $activate_url }}</a> {{ Helper::translation(3096,$translate) }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>