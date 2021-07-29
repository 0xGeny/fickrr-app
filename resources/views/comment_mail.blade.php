<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ Helper::translation(2905,$translate) }}</title>
</head>
<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(2905,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p><strong> {{ Helper::translation(2906,$translate) }} : </strong> {{ $from_name }}</p>   
                        <p><strong> {{ Helper::translation(2907,$translate) }} : </strong> {{ $from_email }}</p>
                        <p><strong> {{ Helper::translation(2908,$translate) }} : </strong> <a href="{{ $item_url }}">{{ $item_url }}</a></p>
                        <p><strong> {{ Helper::translation(2909,$translate) }} : </strong> {{ $comm_text }}</p>   
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>