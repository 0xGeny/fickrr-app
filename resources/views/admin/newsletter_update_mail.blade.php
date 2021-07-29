<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Helper::translation(5643,$translate) }}</title>
    
</head>

<body class="preload dashboard-upload">
<div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h2>{{ Helper::translation(5643,$translate) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <p>{{ Helper::translation(5646,$translate) }}</p>   
                        
                        <p><strong> {{ Helper::translation(3063,$translate) }} : </strong>{{ $news_heading }}</p> 
                        <p><strong> {{ Helper::translation(5649,$translate) }} : </strong>@php echo html_entity_decode($news_content) @endphp</p>  
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </section>

</body>

</html>