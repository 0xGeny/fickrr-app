@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
@if($check_if_item != 0)
<title>{{ $item['item']->item_name }} - {{ $allsettings->site_title }}</title>
@if($item_slug != '')
@if($item['item']->item_allow_seo == 1)
<meta name="Description" content="{{ $item['item']->item_seo_desc }}">
<meta name="Keywords" content="{{ $item['item']->item_seo_keyword }}">
@else
@include('meta')
@endif
@else
@include('meta')
@endif
@else
<title>{{ Helper::translation(2860,$translate) }} - {{ $allsettings->site_title }}</title>
@endif
@include('style')
</head>
<body>
@include('header')
@if($check_if_item != 0)
<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ $item['item']->name }}</li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ $item['item']->item_name }}</h1>
        </div>
      </div>
    </div>
<section class="container mb-3 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Content-->
          <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-lg-3">
            <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
              <!-- Product gallery-->
              <div class="cz-gallery">
              @if($item['item']->video_preview_type!='')
                      @if($item['item']->video_preview_type == 'youtube')
                      @if($item['item']->video_url != '')
                      @php
                      $link = $item['item']->video_url;
                      $video_id = explode("?v=", $link);
                      $video_id = $video_id[1];
                      @endphp
                      <iframe width="100%" height="430" src="https://www.youtube.com/embed/{{ $video_id }}?rel=0&version=3&loop=1&playlist={{ $video_id }}" frameborder="0" allow="autoplay" scrolling="no"></iframe>        
                      @else
                      <img src="{{ url('/') }}/resources/views/assets/no-video.png" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      @endif
                      @endif
                      @if($item['item']->video_preview_type == 'mp4')
                      @if($item['item']->video_file != '')
                      @if($allsettings->site_s3_storage == 1)
                      @php $videofileurl = Storage::disk('s3')->url($item['item']->video_file); @endphp
                      <video width="100%" height="430" controls loop><source src="{{ $videofileurl }}" type="video/mp4">{{ Helper::translation(5979,$translate) }}</video>
                      @else
                      <video width="100%" height="430" controls loop><source src="{{ url('/') }}/public/storage/items/{{ $item['item']->video_file }}" type="video/mp4">{{ Helper::translation(5979,$translate) }}</video>                @endif
                      @else
                      <img src="{{ url('/') }}/resources/views/assets/no-video.png" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      @endif
                      @endif
                  @else  
                      @if($item['item']->item_preview!='')
                      <a class="gallery-item rounded-lg mb-grid-gutter" href="{{ url('/') }}/public/storage/items/{{ $item['item']->item_preview }}" data-sub-html="{{ $item['item']->item_name }}">
                      <img src="{{ url('/') }}/public/storage/items/{{ $item['item']->item_preview }}" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      <span class="gallery-item-caption">{{ $item['item']->item_name }}</span>
                      </a>
                      @else
                      <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      @endif
                      @endif
              @if($getcount != 0)
                <div class="row">
                  @foreach($item_allimage as $image)
                  <div class="col-sm-2"><a class="gallery-item rounded-lg mb-grid-gutter thumber" href="{{ url('/') }}/public/storage/items/{{ $image->item_image }}" data-sub-html="{{ $item['item']->item_name }}"><img src="{{ url('/') }}/public/storage/items/{{ $image->item_image }}" alt="{{ $image->item_image }}"/><span class="gallery-item-caption">{{ $item['item']->item_name }}</span></a></div>
                  @endforeach 
                </div>
                @endif
              </div>
              <!-- Wishlist + Sharing-->
              <div class="d-flex flex-wrap justify-content-between align-items-center border-top pt-3">
                <div class="py-2 mr-2">
                  @if($item['item']->demo_url != '') 
                  <a class="btn btn-outline-accent btn-sm" href="{{ $item['item']->demo_url }}" target="_blank"><i class="dwg-eye font-size-sm mr-2"></i>{{ Helper::translation(3049,$translate) }}</a>
                  @endif
                  @if(Auth::guest())
                  <a class="btn btn-outline-accent btn-sm" href="{{ URL::to('/login') }}"><i class="dwg-heart font-size-lg mr-2"></i>{{ Helper::translation(3051,$translate) }}</a>
                  @endif
                  @if (Auth::check())
                  @if($item['item']->user_id != Auth::user()->id)
                  <a class="btn btn-outline-accent btn-sm" href="{{ url('/item') }}/{{ base64_encode($item['item']->item_id) }}/favorite/{{ base64_encode($item['item']->item_liked) }}"><i class="dwg-heart font-size-lg mr-2"></i>{{ Helper::translation(3051,$translate) }}</a>
                  @endif
                  @endif
                  </div>
                <div class="py-2"><i class="dwg-share-alt font-size-lg align-middle text-muted mr-2"></i>
                <a class="social-btn sb-outline sb-facebook sb-sm ml-2 share-button" data-share-url="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}" data-share-network="facebook" data-share-text="{{ $item['item']->item_shortdesc }}" data-share-title="{{ $item['item']->item_name }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/items/{{ $item['item']->item_thumbnail }}" href="javascript:void(0)"><i class="dwg-facebook"></i></a>
                <a class="social-btn sb-outline sb-twitter sb-sm ml-2 share-button" data-share-url="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}" data-share-network="twitter" data-share-text="{{ $item['item']->item_shortdesc }}" data-share-title="{{ $item['item']->item_name }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/items/{{ $item['item']->item_thumbnail }}" href="javascript:void(0)"><i class="dwg-twitter"></i></a>
                <a class="social-btn sb-outline sb-pinterest sb-sm ml-2 share-button" data-share-url="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}" data-share-network="googleplus" data-share-text="{{ $item['item']->item_shortdesc }}" data-share-title="{{ $item['item']->item_name }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/items/{{ $item['item']->item_thumbnail }}" href="javascript:void(0)"><i class="dwg-google"></i></a>
                <a class="social-btn sb-outline sb-linkedin sb-sm ml-2 share-button" data-share-url="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}" data-share-network="linkedin" data-share-text="{{ $item['item']->item_shortdesc }}" data-share-title="{{ $item['item']->item_name }}" data-share-via="{{ $allsettings->site_title }}" data-share-tags="" data-share-media="{{ url('/') }}/public/storage/items/{{ $item['item']->item_thumbnail }}" href="javascript:void(0)"><i class="dwg-linkedin"></i></a>
                </div>
              </div>
              <div class="mt-4 mb-4 mb-lg-5">
      <!-- Nav tabs-->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link p-4 active" href="#details" data-toggle="tab" role="tab">{{ Helper::translation(3053,$translate) }}</a></li>
      <!--  <li class="nav-item"><a class="nav-link p-4" href="#comments" data-toggle="tab" role="tab">{{ Helper::translation(3054,$translate) }} <span>({{ $comment_count }})</span></a></li>-->
        <li class="nav-item"><a class="nav-link p-4" href="#reviews" data-toggle="tab" role="tab">{{ Helper::translation(3043,$translate) }}<span>({{ $getreview }})</span></a></li>
        @if(Auth::guest())
       <!-- <li class="nav-item"><a class="nav-link p-4" href="#suppport" data-toggle="tab" role="tab">{{ Helper::translation(3055,$translate) }}</a></li>-->
        @endif
        @if (Auth::check())
        @if($item['item']->user_id != Auth::user()->id)
       <!-- <li class="nav-item"><a class="nav-link p-4" href="#suppport" data-toggle="tab" role="tab">{{ Helper::translation(3055,$translate) }}</a></li>-->
        @endif
        @endif
       
<!-- 	@if($item['item']->seller_refund_term != "")
        <li class="nav-item"><a class="nav-link p-4" href="#terms" data-toggle="tab" role="tab">{{ Helper::translation(6153,$translate) }}</a></li>
        @endif
-->
      </ul>
      <div class="tab-content pt-2">
        <div class="tab-pane fade" id="suppport" role="tabpanel">
           <div class="row">
            <div class="col-lg-12">
               <h4>{{ Helper::translation(3060,$translate) }}</h4>
               @if(Auth::guest())
                    <p>{{ Helper::translation(3061,$translate) }}
                    <a href="{{ URL::to('/login') }}" class="theme-color">{{ Helper::translation(3020,$translate) }}</a> {{ Helper::translation(3062,$translate) }}</p>
                    @endif
                    @if (Auth::check())
                    <form action="{{ route('support') }}" class="support_form media-body needs-validation" id="support_form" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                    <label for="subj">{{ Helper::translation(3063,$translate) }}</label>
                                                    <input type="text" id="support_subject" name="support_subject" class="form-control" placeholder="Enter your subject" data-bvalidator="required">                                            </div>
                                                <div class="form-group">
                                                    <label for="supmsg">{{ Helper::translation(2918,$translate) }} </label>
                                                    <textarea class="form-control" id="support_msg" name="support_msg" rows="5" placeholder="Enter your message" data-bvalidator="required"></textarea>                                            </div>
                                                <input type="hidden" name="to_address" value="{{ $item['item']->email }}">
                                                <input type="hidden" name="to_id" value="{{ $item['item']->id }}">
                                                <input type="hidden" name="to_name" value="{{ $item['item']->username }}">
                                                <input type="hidden" name="from_address" value="{{ Auth::user()->email }}">
                                                <input type="hidden" name="from_name" value="{{ Auth::user()->username }}">
                                                <input type="hidden" name="item_url" value="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}">
                              <button type="submit" class="btn btn-primary btn-sm">{{ Helper::translation(3064,$translate) }}</button>
                      </form>
                @endif
            </div>
           </div> 
        </div>
        <!-- Product details tab-->
        <div class="tab-pane fade" id="terms" role="tabpanel">
          <div class="row">
            <div class="col-lg-12 term_text">
              <p class="font-size-md mb-1">
              @if($item['item']->seller_money_back == 1)
              @if(!empty($item['item']->seller_money_back_days))
              <h1>{{ $item['item']->seller_money_back_days }} {{ Helper::translation(6231,$translate) }}</h1>
              @endif
              @else
              <h1>{{ Helper::translation(6234,$translate) }}</h1>
              @endif
              <br/>
              @php echo $item['item']->seller_refund_term; @endphp
              </p>
            </div>
          </div>
        </div>
        <div class="tab-pane fade show active" id="details" role="tabpanel">
          <div class="row">
            <div class="col-lg-12">
              <p class="font-size-md mb-1">@php echo html_entity_decode($item['item']->item_desc); @endphp</p>
            </div>
          </div>
        </div>
        <!-- Reviews tab-->
        <div class="tab-pane fade" id="reviews" role="tabpanel">
         @if($getreview != 0)
         <div class="row pb-4">
            <!-- Reviews list-->
            <div class="col-md-12">
              <!-- Review-->
              @foreach($getreviewdata['view'] as $rating)
              <div class="product-review pb-4 mb-4 border-bottom review-item">
                <div class="d-flex mb-3">
                  <div class="media media-ie-fix align-items-center mr-4 pr-2">
                  @if($rating->user_photo!='')
                  <img class="rounded-circle" width="50" src="{{ url('/') }}/public/storage/users/{{ $rating->user_photo }}" alt="{{ $rating->username }}"/>
                  @else
                  <img class="rounded-circle" width="50" src="{{ url('/') }}/public/img/no-user.png" alt="{{ $rating->username }}"/>
                  @endif
                    <div class="media-body pl-3">
                      <h6 class="font-size-sm mb-0">{{ $rating->username }}</h6><span class="font-size-ms text-muted">{{ date('d F Y H:i:s', strtotime($rating->rating_date)) }}</span></div>
                  </div>
                  <div>
                    <div class="star-rating">
                    @if($rating->rating == 0)
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($rating->rating == 1)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($rating->rating == 2)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($rating->rating == 3)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($rating->rating == 4)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($rating->rating == 5)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    @endif
                    </div>
                    <div class="review_tag">{{ $rating->rating_reason }}</div>
                  </div>
                </div>
                <p class="font-size-md mb-2">{{ $rating->rating_comment }}</p>
              </div>
              @endforeach
              <div class="float-right">
                 <div class="pagination-area">
                    <div class="turn-page" id="reviewpager"></div>
                    </div> 
              </div>
            </div>
            <!-- Leave review form-->
         </div>
         @endif
        </div>
        <!-- Comments tab-->
        <div class="tab-pane fade" id="comments" role="tabpanel">
          <div class="row thread">
            <div class="col-lg-12">
              <div class="media-list thread-list" id="listShow">
                                    @foreach ($comment['view'] as $parent)
                                        <div class="single-thread commli-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    @if($parent->user_photo!='')
                                                    <img  src="{{ url('/') }}/public/storage/users/{{ $parent->user_photo }}" alt="{{ $parent->username }}" class="rounded-circle" width="50">                                                    @else
                                                    <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $parent->username }}" class="rounded-circle" width="50">
                                                    @endif
                                                </div>
                                                <div class="media-body">
                                                    <div>
                                                        <div class="media-heading">
                                                            <h6 class="font-size-md mb-0">{{ $parent->username }}</h6>
                                                        </div>
                                                        @if($parent->id == $item['item']->user_id)
                                                        <span class="comment-tag buyer">{{ Helper::translation(3057,$translate) }}</span>
                                                        @endif
                                                        @if (Auth::check())
                                                        @if($item['item']->user_id == Auth::user()->id)
                                                        <a href="javascript:void(0);" class="nav-link-style font-size-sm font-weight-medium reply-link"><i class="dwg-reply mr-2">
                                                        </i>{{ Helper::translation(3056,$translate) }}</a>
                                                        @endif
                                                        @endif
                                                    </div>
                                                    <p class="font-size-md mb-1">{{ $parent->comm_text }}</p>
                                                    <span class="font-size-ms text-muted"><i class="dwg-time align-middle mr-2"></i>{{ date('d F Y, H:i:s', strtotime($parent->comm_date)) }}</span>
                                                </div>
                                            </div>
                                            <div class="children">
                                            @foreach ($parent->replycomment as $child)
                                                <div class="single-thread depth-2">
                                                    <div class="media">
                                                        <div class="media-left">
                                                    @if($child->user_photo!='')
                                                    <img  src="{{ url('/') }}/public/storage/users/{{ $child->user_photo }}" alt="{{ $child->username }}" class="rounded-circle" width="50">                                                    @else
                                                    <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $child->username }}" class="rounded-circle" width="50">
                                                    @endif
                                                    </div>
                                                        <div class="media-body">
                                                            <div class="media-heading">
                                                                <h6 class="font-size-md mb-0">{{ $child->username }}</h6>
                                                             </div>
                                                            @if($child->id == $item['item']->user_id)
                                                            <span class="comment-tag buyer">Author</span>
                                                            @endif
                                                            <p class="font-size-md mb-1">{{ $child->comm_text }}</p>
                                                            <span class="font-size-ms text-muted"><i class="dwg-time align-middle mr-2"></i>{{ date('d F Y, H:i:s', strtotime($child->comm_date)) }}</span>                                                        </div>
                                                    </div>
                                                  </div>
                                                @endforeach
                                            </div>
                                            <!-- comment reply -->
                                            @if (Auth::check())
                                            <div class="media depth-2 reply-comment">
                                                <div class="media-left">
                                                    @if(Auth::user()->user_photo!='')
                                           <img  src="{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}" alt="{{ Auth::user()->username }}" class="rounded-circle" width="50">                                                @else
                                           <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ Auth::user()->username }}" class="rounded-circle" width="50">
                                           @endif
                                            </div>
                                                <div class="media-body">
                                                    <form action="{{ route('reply-post-comment') }}" class="comment-reply-form media-body needs-validation" method="post" enctype="multipart/form-data">                                                    {{ csrf_field() }}
                                                    <textarea name="comm_text" class="form-control" placeholder="{{ Helper::translation(3059,$translate) }}" required></textarea>
                                                    <input type="hidden" name="comm_user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="comm_item_user_id" value="{{ $item['item']->user_id }}">
                                                    <input type="hidden" name="comm_item_id" value="{{ $item['item']->item_id }}">
                                                    <input type="hidden" name="comm_id" value="{{ $parent->comm_id }}">
                                                    <input type="hidden" name="comm_item_url" value="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}">
                                                   <button class="btn btn-primary btn-sm">{{ Helper::translation(3058,$translate) }}</button>
                                                </form>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- comment reply -->
                                        </div>
                                       @endforeach
                                    </div>
                                   @if($comment_count != 0)
                                   <div class="float-right">
                                        <div class="pagination-area">
                                                <div class="turn-page" id="commpager"></div>
                                        </div> 
                                   </div>
                                   @endif
                  <div class="clearfix"></div>
                  @if (Auth::check())
                  @if($item['item']->user_id != Auth::user()->id)
                   <div class="card border-0 box-shadow my-2">
                   <h4 class="mt-4 ml-4">{{ Helper::translation(6030,$translate) }}</h4>
                    <div class="card-body">
                      <div class="media">
                      @if(Auth::user()->user_photo != '')
                      <img class="rounded-circle" width="50" src="{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}" alt="{{ Auth::user()->name }}"/>
                      @else
                      <img class="rounded-circle" width="50" src="{{ url('/') }}/public/img/no-user.png" alt="{{ Auth::user()->name }}"/>
                      @endif
                      <form action="{{ route('post-comment') }}" class="comment-reply-form media-body needs-validation ml-3" id="item_form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <textarea class="form-control" rows="4" name="comm_text" placeholder="{{ Helper::translation(3059,$translate) }}" data-bvalidator="required"></textarea>
                            <input type="hidden" name="comm_user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="comm_item_user_id" value="{{ $item['item']->user_id }}">
                            <input type="hidden" name="comm_item_id" value="{{ $item['item']->item_id }}">
                            <input type="hidden" name="comm_item_url" value="{{ URL::to('/item') }}/{{ $item['item']->item_slug }}">
                            <div class="invalid-feedback">{{ Helper::translation(6033,$translate) }}</div>
                          </div>
                          <button class="btn btn-primary btn-sm" type="submit">{{ Helper::translation(3058,$translate) }}</button>
                        </form>
                  </div>
                </div>
              </div>
              @endif
              @endif
            </div>
          </div>
        </div>
         </div>
        </div>
            </div>
          </section>
          
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <hr class="d-lg-none">
            <form action="{{ route('cart') }}" class="setting_form" method="post" id="order_form" enctype="multipart/form-data">
            {{ csrf_field() }} 
            <div class="cz-sidebar-static h-100 ml-auto border-left">
               @if($item['item']->free_download == 1)
               <div class="bg-secondary rounded p-3 mb-4">
               <p>{{ Helper::translation(3065,$translate) }} <strong>{{ Helper::translation(3040,$translate) }}</strong>. {{ Helper::translation(3066,$translate) }}</p>
               @php if($item['item']->download_count == "") { $dcount = 0; } else { $dcount = $item['item']->download_count; } @endphp
               <div align="center">
                   @if (Auth::check())
                   @if($addition_settings->subscription_mode == 0)
                   <a href="{{ URL::to('/item') }}/download/{{ base64_encode($item['item']->item_token) }}" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> {{ Helper::translation(3067,$translate) }} ({{ $dcount }})</a>
                   @else
                   @if(Auth::user()->user_type == 'vendor')
                   @if(Auth::user()->user_subscr_date >= date('Y-m-d'))
                   <a href="{{ URL::to('/item') }}/download/{{ base64_encode($item['item']->item_token) }}" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> {{ Helper::translation(3067,$translate) }} ({{ $dcount }})</a>
                   @else
                   <a href="javascript:void(0)" class="btn btn-primary btn-sm" onClick="alert('Your subscription has been expired. Please renewal your subscription')"> <i class="fa fa-download"></i> {{ Helper::translation(3067,$translate) }} ({{ $dcount }})</a>
                   @endif
                   @endif
                   @endif
                   @endif
                   @if(Auth::guest())
                   <a href="{{ URL::to('/login') }}" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> {{ Helper::translation(3067,$translate) }} ({{ $dcount }})</a>
                   @endif
                </div>
               </div>
               @endif 
                @php if($item['item']->item_flash == 1)
                { 
                $item_price = round($item['item']->regular_price/2);
                $extend_item_price = round($item['item']->extended_price/2);
                } 
                else 
                { 
                $item_price = $item['item']->regular_price;
                $extend_item_price = $item['item']->extended_price; 
                } 
                @endphp
              <div class="accordion" id="licenses">
                <div class="card border-top-0 border-left-0 border-right-0">
                  <div class="card-header d-flex justify-content-between align-items-center py-3 border-0">
                    <div class="custom-control custom-radio">
                      <!---- <input class="custom-control-input" type="radio" name="item_price" value="{{ base64_encode($item_price) }}_regular" id="license-std" checked>
                      <label class="custom-control-label font-weight-medium text-dark" for="license-std" data-toggle="collapse" data-target="#standard-license">{{ Helper::translation(3072,$translate) }}</label>
                ---->   
		 </div>
                    <h5 class="mb-0 text-accent font-weight-normal">{{ $allsettings->site_currency_symbol }}{{ $item_price }}</h5>
                  </div>
                  <div class="collapse show" id="standard-license" data-parent="#licenses">
                    <div class="card-body py-0 pb-2">
                      <ul class="list-unstyled font-size-sm">
                        <li class="d-flex align-items-center"><i class="dwg-check-circle text-success mr-1"></i><span class="font-size-ms">{{ Helper::translation(3068,$translate) }} {{ $allsettings->site_title }}</span></li>
                        @if($item['item']->future_update == 1) 
                        <li class="d-flex align-items-center"><i class="dwg-check-circle text-success mr-1"></i><span class="font-size-ms">{{ Helper::translation(3069,$translate) }}</span></li>
                        @else
                        <li class="d-flex align-items-center"><i class="dwg-close-circle text-danger mr-1"></i><span class="font-size-ms">{{ Helper::translation(3069,$translate) }}</span></li>
                        @endif
                        @if($item['item']->item_support == 1)
                        <li class="d-flex align-items-center"><i class="dwg-check-circle text-success mr-1"></i><span class="font-size-ms">{{ Helper::translation(3070,$translate) }} {{ $item['item']->username }}</span></li>
                        @else
                        <li class="d-flex align-items-center"><i class="dwg-close-circle text-danger mr-1"></i><span class="font-size-ms">{{ Helper::translation(3070,$translate) }} {{ $item['item']->username }}</span></li>
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
                @if($item['item']->extended_price != 0)
                <div class="card border-bottom-0 border-left-0 border-right-0">
                  <div class="card-header d-flex justify-content-between align-items-center py-3 border-0">
                    

		    <div class="custom-control custom-radio" style="display:none;">
                      <input class="custom-control-input" type="radio" name="item_price" id="license-ext" value="{{ base64_encode($extend_item_price) }}_extended">
                      <label class="custom-control-label font-weight-medium text-dark" for="license-ext" data-toggle="collapse" data-target="#extended-license">{{ Helper::translation(3073,$translate) }}</label>
                    </div>


		    <div class="custom-control custom-radio">
		@if(Auth::guest())
                <a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ URL::to('/login') }}"><i class="dwg-cart font-size-lg mr-2"></i>BID</a>
                @endif
                @if (Auth::check())
                @if($item['item']->user_id == Auth::user()->id)
                <a href="{{ URL::to('/edit-item') }}/{{ $item['item']->item_token }}" class="btn btn-primary btn-shadow btn-block mt-4"><i class="dwg-cart font-size-lg mr-2"></i>{{ Helper::translation(2935,$translate) }}</a>
                @else
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="item_id" value="{{ $item['item']->item_id }}">
                <input type="hidden" name="item_name" value="{{ $item['item']->item_name }}">
                <input type="hidden" name="item_user_id" value="{{ $item['item']->user_id }}">
                <input type="hidden" name="item_token" value="{{ $item['item']->item_token }}">
                @if($checkif_purchased == 0)
                @if(Auth::user()->id != 1)
                <button type="submit" class="btn btn-primary btn-shadow btn-block mt-4"><i class="dwg-bid font-size-lg mr-2"></i>BID</button>
                @endif 
                @endif    
                @endif
                @endif

 

                    </div>

                    <h5 class="mb-0 text-accent font-weight-normal" style="display:none">{{ $allsettings->site_currency_symbol }}{{ $extend_item_price }}</h5>
                  </div>
                  <div class="collapse" id="extended-license" data-parent="#licenses">
                    <div class="card-body py-0 pb-2">
                      <ul class="list-unstyled font-size-sm">
                        <li class="d-flex align-items-center"><i class="dwg-check-circle text-success mr-1"></i><span class="font-size-ms">{{ Helper::translation(3068,$translate) }} {{ $allsettings->site_title }}</span></li>
                        @if($item['item']->future_update == 1) 
                        <li class="d-flex align-items-center"><i class="dwg-check-circle text-success mr-1"></i><span class="font-size-ms">{{ Helper::translation(3069,$translate) }}</span></li>
                        @else
                        <li class="d-flex align-items-center"><i class="dwg-close-circle text-danger mr-1"></i><span class="font-size-ms">{{ Helper::translation(3069,$translate) }}</span></li>
                        @endif
                        @if($item['item']->item_support == 1)
                        <li class="d-flex align-items-center"><i class="dwg-check-circle text-success mr-1"></i><span class="font-size-ms">{{ Helper::translation(4863,$translate) }} {{ $item['item']->username }}</span></li>
                        @else
                        <li class="d-flex align-items-center"><i class="dwg-close-circle text-danger mr-1"></i><span class="font-size-ms">{{ Helper::translation(4863,$translate) }} {{ $item['item']->username }}</span></li>
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
                @endif
              </div>
              <hr>
              @if($allsettings->item_support_link !='')
              <p class="mt-2 mb-3"><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="font-size-xs">{{ $page['view']->page_title }}</a></p>
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                         <div class="modal-header">
                          <h4 class="modal-title">{{ $page['view']->page_title }}</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                         @php echo html_entity_decode($page['view']->page_desc); @endphp
                        </div>
                       </div>
                    </div>
                  </div>
                @endif
                @if(Auth::guest())
                <a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ URL::to('/login') }}"><i class="dwg-cart font-size-lg mr-2"></i>{{ Helper::translation(3074,$translate) }}</a>
                @endif
                @if (Auth::check())
                @if($item['item']->user_id == Auth::user()->id)
                <a href="{{ URL::to('/edit-item') }}/{{ $item['item']->item_token }}" class="btn btn-primary btn-shadow btn-block mt-4"><i class="dwg-cart font-size-lg mr-2"></i>BID</a>
                @else
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="item_id" value="{{ $item['item']->item_id }}">
                <input type="hidden" name="item_name" value="{{ $item['item']->item_name }}">
                <input type="hidden" name="item_user_id" value="{{ $item['item']->user_id }}">
                <input type="hidden" name="item_token" value="{{ $item['item']->item_token }}">
                @if($checkif_purchased == 0)
                @if(Auth::user()->id != 1)
                <button type="submit" class="btn btn-primary btn-shadow btn-block mt-4"><i class="dwg-cart font-size-lg mr-2"></i>{{ Helper::translation(3074,$translate) }}</button>
                @endif 
                @endif    
                @endif
                @endif 




                @if($item['item']->item_featured == 'yes')
                <div class="bg-secondary rounded p-3 mt-4">
                <span class="d-inline-block font-size-sm mb-0 mr-1"><img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->featured_item_icon }}" border="0" class="single-badges" title="{{ Helper::translation(5466,$translate) }}"> {{ Helper::translation(3075,$translate) }} {{ $allsettings->site_title }}</span>
                </div>
                @endif
                @if($sold_amount >= $badges['setting']->author_sold_level_six)
                <div class="bg-secondary rounded p-3 mt-4">
                <span class="d-inline-block font-size-sm mb-0 mr-1"><img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->power_elite_author_icon }}" border="0" class="single-badges" title="{{ $badges['setting']->author_sold_level_six_label }} : {{ Helper::translation(5982,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_six }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}"> {{ $badges['setting']->author_sold_level_six_label }}</span>
                </div>
                @endif
                <div class="bg-secondary rounded p-3 mt-4 mb-2">
                <a class="media" href="{{ url('/user') }}/{{ $item['item']->username }}">
                @if($item['item']->user_photo != '')
                <img class="rounded-circle vertical-img" width="80" src="{{ url('/') }}/public/storage/users/{{ $item['item']->user_photo }}" alt="{{ $item['item']->name }}">
                @else
                <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $item['item']->name }}" width="80" class="vertical-img">
                @endif
                <div class="media-body pl-2 item-details">
                    <h6 class="font-size-sm mb-0">{{ $item['item']->username }}</h6>
                    <span class="font-size-ms text-muted">{{ Helper::translation(3077,$translate) }} {{ date("F Y", strtotime($item['item']->created_at)) }}</span>
                    <div class="mb-3">@if($addition_settings->subscription_mode == 1) @if($item['item']->user_document_verified == 1) <span class="badges-success"><i class="dwg-check-circle danger"></i> {{ Helper::translation(5202,$translate) }}</span> @endif @endif</div>
                    <ul>
                                        @if($item['item']->country_badge == 1)
                                        @if($country['view']->country_badges != "")
                                        <li>
                                          <img src="{{ url('/') }}/public/storage/flag/{{ $country['view']->country_badges }}" border="0" class="icon-badges" title="{{ Helper::translation(5985,$translate) }} {{ $country['view']->country_name }}">  
                                        </li>
                                        @endif
                                        @endif
                                        @if($item['item']->exclusive_author == 1)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->exclusive_author_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5988,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($trends != 0)
                                         <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->trends_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5991,$translate) }}">
                                        </li>
                                        @endif
                                        @if($item['item']->item_featured == 'yes')
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->featured_item_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5994,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($item['item']->free_download == 1)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->free_item_icon }}" border="0" class="other-badges" title="{{ Helper::translation(5997,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year == 1)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->one_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year == 2)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->two_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year == 3)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->three_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>

                                        @endif
                                        @if($year == 4)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->four_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year == 5)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->five_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif 
                                        @if($year == 6)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->six_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year == 7)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->seven_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year == 8)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->eight_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year == 9)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->nine_year_icon }}" border="0" class="other-badges" title="{{ $year }} {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} {{ $year }} {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($year >= 10)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->ten_year_icon }}" border="0" class="other-badges" title="@if($year >= 10) 10+ @else {{ $year }} @endif {{ Helper::translation(6000,$translate) }} {{ $allsettings->site_title }} {{ Helper::translation(6003,$translate) }} @if($year >= 10) 10+ @else {{ $year }} @endif {{ Helper::translation(6006,$translate) }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_one && $badges['setting']->author_sold_level_two > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_one_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 1: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_one }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_two &&  $badges['setting']->author_sold_level_three > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_two_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 2: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_two }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_three &&  $badges['setting']->author_sold_level_four > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->	author_sold_level_three_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 3: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_three }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_four &&  $badges['setting']->author_sold_level_five > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_four_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 4: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_four }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_five &&  $badges['setting']->author_sold_level_six > $sold_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_five_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 5: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_five }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_six) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_sold_level_six_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6009,$translate) }} 6: {{ Helper::translation(6012,$translate) }} {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_six }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($sold_amount >= $badges['setting']->author_sold_level_six)
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->power_elite_author_icon }}" border="0" class="other-badges" title="{{ $badges['setting']->author_sold_level_six_label }} : Sold more than {{ $allsettings->site_currency }} {{ $badges['setting']->author_sold_level_six }}+ {{ Helper::translation(5325,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_one && $badges['setting']->author_collect_level_two > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_one_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 1: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_one }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_two && $badges['setting']->author_collect_level_three > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_two_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 2: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_two }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_three && $badges['setting']->author_collect_level_four > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_three_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 3: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_three }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_four && $badges['setting']->author_collect_level_five > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_four_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 4: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_four }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_five && $badges['setting']->author_collect_level_six > $collect_amount) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_five_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 5: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_five }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($collect_amount >= $badges['setting']->author_collect_level_six) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_collect_level_six_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6015,$translate) }} 6: {{ Helper::translation(6018,$translate) }} {{ $badges['setting']->author_collect_level_six }}+ {{ Helper::translation(6021,$translate) }} {{ $allsettings->site_title }}">
                                        </li>
                                        @endif
                                        @if($referral_count >= $badges['setting']->author_referral_level_one && $badges['setting']->author_referral_level_two > $referral_count) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_one_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 1: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_one }}+ {{ Helper::translation(3002,$translate) }}">
                                        </li>
                                        @endif
                                        
                                        @if($referral_count >= $badges['setting']->author_referral_level_two && $badges['setting']->author_referral_level_three > $referral_count) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_two_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 2: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_two }}+ {{ Helper::translation(3002,$translate) }}">
                                        </li>
                                        @endif
                                        
                                        @if($referral_count >= $badges['setting']->author_referral_level_three && $badges['setting']->author_referral_level_four > $referral_count) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_three_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 3: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_three }}+ {{ Helper::translation(3002,$translate) }}">
                                        </li>
                                        @endif
                                        
                                        @if($referral_count >= $badges['setting']->author_referral_level_four && $badges['setting']->author_referral_level_five > $referral_count) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_four_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 4: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_four }}+ {{ Helper::translation(3002,$translate) }}">
                                        </li>
                                        @endif
                                        
                                        @if($referral_count >= $badges['setting']->author_referral_level_five && $badges['setting']->author_referral_level_six > $referral_count) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_five_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 5: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_five }}+ {{ Helper::translation(3002,$translate) }}">
                                        </li>
                                        @endif
                                        @if($referral_count >= $badges['setting']->author_referral_level_six) 
                                        <li>
                                        <img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->author_referral_level_six_icon }}" border="0" class="other-badges" title="{{ Helper::translation(6024,$translate) }} 6: {{ Helper::translation(6027,$translate) }} {{ $badges['setting']->author_referral_level_six }}+ {{ Helper::translation(3002,$translate) }}">
                                        </li>
                                        @endif
                                    </ul>
                </div></a>
                <a class="btn btn-outline-accent btn-sm btn-block" href="{{ url('/user') }}/{{ $item['item']->username }}"><i class="dwg-briefcase font-size-sm mr-2"></i>{{ Helper::translation(3078,$translate) }}</a>
                </div>
              <div class="bg-secondary rounded p-3 mt-2 mb-2"><i class="dwg-download h5 text-muted align-middle mb-0 mt-n1 mr-2"></i><span class="d-inline-block h6 mb-0 mr-1">{{ $item['item']->item_sold }}</span><span class="font-size-sm">{{ Helper::translation(2930,$translate) }}</span></div>
              <div class="bg-secondary rounded p-3 mb-2">
                <div class="star-rating">
                @if($getreview == 0)
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                @else
                @if($count_rating == 0)
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                @endif
                @if($count_rating == 1)
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                @endif
                @if($count_rating == 2)
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                @endif
                @if($count_rating == 3)
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star"></i>
                <i class="sr-star dwg-star"></i>
                @endif
                @if($count_rating == 4)
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star"></i>
                @endif
                @if($count_rating == 5)
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                <i class="sr-star dwg-star-filled active"></i>
                @endif
                @endif
                </div>
                <div class="font-size-ms text-muted">{{ $getreview }} {{ Helper::translation(3080,$translate) }}</div>
              </div>
              <div class="bg-secondary rounded p-3 mt-2 mb-2"><i class="dwg-heart h5 text-muted align-middle mb-0 mt-n1 mr-2"></i><span class="d-inline-block h6 mb-0 mr-1">{{ $item['item']->item_liked }}</span><span class="font-size-sm">{{ Helper::translation(2989,$translate) }}</span></div>
          
              <ul class="list-unstyled font-size-sm">
                <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark font-weight-medium">{{ Helper::translation(3082,$translate) }}</span><span class="text-muted">{{ date("d F Y", strtotime($item['item']->updated_item)) }}</span></li>
                <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark font-weight-medium">{{ Helper::translation(3083,$translate) }}</span><span class="text-muted">{{ date("d F Y", strtotime($item['item']->created_item)) }}</span></li>
                <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark font-weight-medium">{{ Helper::translation(3084,$translate) }}</span><span class="text-muted">{{ $category_name }}</span></li>
                <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark font-weight-medium">{{ Helper::translation(2937,$translate) }}</span><span class="text-muted">{{ str_replace('-',' ',$item['item']->item_type) }}</span></li>
                @if(count($viewattribute['details']) != 0)
                @foreach($viewattribute['details'] as $view_attribute)
                <li class="d-flex justify-content-between mb-3 pb-3 border-bottom"><span class="text-dark font-weight-medium">{{ $view_attribute->item_attribute_label }}</span><span class="text-muted">{{ $view_attribute->item_attribute_values }}</span></li>
                @endforeach
                @endif
                @if($item['item']->item_tags != '')
                 <li class="justify-content-between pb-3 border-bottom"><span class="text-dark font-weight-medium">{{ Helper::translation(2974,$translate) }}</span><br/>
                 @php $item_tags = explode(',',$item['item']->item_tags); @endphp
                 @foreach($item_tags as $tags)
                 <span class="text-right"><a href="{{ url('/tag') }}/item/{{ strtolower(str_replace(' ','-',$tags)) }}" class="link-color">{{ $tags.',' }}</a></span>
                 @endforeach
                 </li>
                 @endif
              </ul>
            </div>
            </form>
          </aside>
        </div>
      </div>
    </section>
    
    <section class="container mb-5 pb-lg-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-2">{{ Helper::translation(3087,$translate) }} {{ Helper::translation(3034,$translate) }} {{ $item['item']->username }}</h2>
      </div>
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        @php $no = 1; @endphp
        @foreach($related['items'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter prod-item">
          <!-- Product-->
          <div class="card product-card-alt">
            <div class="product-thumb">
              @if(Auth::guest()) 
              <a class="btn-wishlist btn-sm" href="{{ url('/') }}/login"><i class="dwg-heart"></i></a>
              @endif
              @if (Auth::check())
              @if($featured->user_id != Auth::user()->id)
              <a class="btn-wishlist btn-sm" href="{{ url('/item') }}/{{ base64_encode($featured->item_id) }}/favorite/{{ base64_encode($featured->item_liked) }}"><i class="dwg-heart"></i></a>
              @endif
              @endif
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"><i class="dwg-eye"></i></a>
                <a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"><i class="dwg-cart"></i></a>
              </div><a class="product-thumb-overlay" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"></a>
                            @if($featured->item_preview!='')
                            <img src="{{ url('/') }}/public/storage/items/{{ $featured->item_preview }}" alt="{{ $featured->item_name }}">
                            @else
                            <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $featured->item_name }}">
                            @endif
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted font-size-xs mr-1"><a class="product-meta font-weight-medium" href="{{ URL::to('/shop') }}/item-type/{{ $featured->item_type }}">{{ str_replace('-',' ',$featured->item_type) }}</a></div>
                <div class="star-rating">
                    @if($count_rating == 0)
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 1)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 2)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 3)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 4)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 5)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    @endif
                </div>
               </div>
              <h3 class="product-title font-size-sm mb-2"><a href="{{ URL::to('/item') }}/{{ $featured->item_slug }}">{{ substr($featured->item_name,0,20).'...' }}</a></h3>
              <div class="card-footer d-flex align-items-center font-size-xs">
              <a class="blog-entry-meta-link" href="{{ URL::to('/user') }}/{{ $featured->username }}">
                    <div class="blog-entry-author-ava">
                    @if($featured->user_photo!='')
                    <img src="{{ url('/') }}/public/storage/users/{{ $featured->user_photo }}" alt="{{ $featured->username }}">
                    @else
                    <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $featured->username }}">
                    @endif
                    </div>{{ $featured->username }} @if($addition_settings->subscription_mode == 1) @if($featured->user_document_verified == 1) <span class="badges-success"><i class="dwg-check-circle danger"></i> {{ Helper::translation(5202,$translate) }}</span>@endif @endif</a>
                  <div class="ml-auto text-nowrap"><i class="dwg-time"></i> {{ date('d M Y',strtotime($featured->updated_item)) }}</div>
                </div>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="font-size-sm mr-2"><i class="dwg-download text-muted mr-1"></i>{{ $featured->item_sold }}<span class="font-size-xs ml-1">{{ Helper::translation(2930,$translate) }}</span>
                </div>
                <div>@if($featured->item_flash == 1)<del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $featured->regular_price }}</del>@endif <span class="bg-faded-accent text-accent rounded-sm py-1 px-2">{{ $allsettings->site_currency_symbol }}{{ $price }}</span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        @php $no++; @endphp
	    @endforeach
       </div>
   </section>






    <section class="container mb-5 pb-lg-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-2">{{ Helper::translation(3087,$translate) }} {{ Helper::translation(3034,$translate) }} Category</h2>
      </div>
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        @php $no = 1; @endphp
        @foreach($relatedbycategory['items'] as $featured)
        @php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        @endphp
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter prod-item">
          <!-- Product-->
          <div class="card product-card-alt">
            <div class="product-thumb">
              @if(Auth::guest()) 
              <a class="btn-wishlist btn-sm" href="{{ url('/') }}/login"><i class="dwg-heart"></i></a>
              @endif
              @if (Auth::check())
              @if($featured->user_id != Auth::user()->id)
              <a class="btn-wishlist btn-sm" href="{{ url('/item') }}/{{ base64_encode($featured->item_id) }}/favorite/{{ base64_encode($featured->item_liked) }}"><i class="dwg-heart"></i></a>
              @endif
              @endif
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"><i class="dwg-eye"></i></a>
                <a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"><i class="dwg-cart"></i></a>
              </div><a class="product-thumb-overlay" href="{{ URL::to('/item') }}/{{ $featured->item_slug }}"></a>
                            @if($featured->item_preview!='')
                            <img src="{{ url('/') }}/public/storage/items/{{ $featured->item_preview }}" alt="{{ $featured->item_name }}">
                            @else
                            <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $featured->item_name }}">
                            @endif
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted font-size-xs mr-1"><a class="product-meta font-weight-medium" href="{{ URL::to('/shop') }}/item-type/{{ $featured->item_type }}">{{ str_replace('-',' ',$featured->item_type) }}</a></div>
                <div class="star-rating">
                    @if($count_rating == 0)
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 1)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 2)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 3)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 4)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star"></i>
                    @endif
                    @if($count_rating == 5)
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    <i class="sr-star dwg-star-filled active"></i>
                    @endif
                </div>
               </div>
              <h3 class="product-title font-size-sm mb-2"><a href="{{ URL::to('/item') }}/{{ $featured->item_slug }}">{{ substr($featured->item_name,0,20).'...' }}</a></h3>
              <div class="card-footer d-flex align-items-center font-size-xs">
              <a class="blog-entry-meta-link" href="{{ URL::to('/user') }}/{{ $featured->username }}">
                    <div class="blog-entry-author-ava">
                    @if($featured->user_photo!='')
                    <img src="{{ url('/') }}/public/storage/users/{{ $featured->user_photo }}" alt="{{ $featured->username }}">
                    @else
                    <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ $featured->username }}">
                    @endif
                    </div>{{ $featured->username }} @if($addition_settings->subscription_mode == 1) @if($featured->user_document_verified == 1) <span class="badges-success"><i class="dwg-check-circle danger"></i> {{ Helper::translation(5202,$translate) }}</span>@endif @endif</a>
                  <div class="ml-auto text-nowrap"><i class="dwg-time"></i> {{ date('d M Y',strtotime($featured->updated_item)) }}</div>
                </div>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="font-size-sm mr-2"><i class="dwg-download text-muted mr-1"></i>{{ $featured->item_sold }}<span class="font-size-xs ml-1">{{ Helper::translation(2930,$translate) }}</span>
                </div>
                <div>@if($featured->item_flash == 1)<del class="price-old">{{ $allsettings->site_currency_symbol }}{{ $featured->regular_price }}</del>@endif <span class="bg-faded-accent text-accent rounded-sm py-1 px-2">{{ $allsettings->site_currency_symbol }}{{ $price }}</span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product-->
        @php $no++; @endphp
	    @endforeach
       </div>
   </section>






   @else
   @include('not-found')
   @endif
@include('footer')
@include('script')
</body>
</html>
@else
@include('503')
@endif