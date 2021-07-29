<script src="{{ asset('resources/views/theme/js/vendor.min.js') }}"></script>
<script src="{{ asset('resources/views/theme/js/theme.min.js') }}"></script>
@if ($message = Session::get('success'))
<script type="text/javascript">
$('#cart-toast-success').toast('show')
</script>
@endif
@if ($message = Session::get('error'))
<script type="text/javascript">
$('#cart-toast-error').toast('show')
</script>
@endif
<!-- print --->
<script src="{{ asset('resources/views/theme/print/jQuery.print.js') }}"></script>
<script type='text/javascript'>
$(function() {
'use strict';
$("#printable").find('.print').on('click', function() {
$.print("#printable");
});
});
function myFunction() {
  'use strict'; 
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  
}
function meFunction() {
  'use strict';
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  "use strict";
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
$(document).ready(function(){
    $('#seller_money_back').on('change', function() {
      if ( this.value == '1')
      {
        $("#back_money").show();
      }
      else
      {
        $("#back_money").hide();
      }
    });
	$('#file_type').on('change', function() {
      if ( this.value == 'file')
      {
        $("#main_file").show();
		$("#main_link").hide();
      }
      else
      {
        $("#main_file").hide();
		$("#main_link").show();
      }
    });
});
</script> 
<!-- print --->
<!-- pagination --->
<script src="{{ URL::to('resources/views/theme/pagination/pagination.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
	'use strict';
      $(this).cPager({
            pageSize: {{ $allsettings->site_post_per_page }}, 
            pageid: "post-pager", 
            itemClass: "li-item",
			pageIndex: 1
 
        });
	$(this).cPager({
            pageSize: {{ $allsettings->site_comment_per_page }}, 
            pageid: "commpager", 
            itemClass: "commli-item",
			pageIndex: 1
 
        });	
		
	$(this).cPager({
            pageSize: {{ $allsettings->site_review_per_page }}, 
            pageid: "reviewpager", 
            itemClass: "review-item",
			pageIndex: 1
 
        });	
		
	$(this).cPager({
            pageSize: {{ $allsettings->site_item_per_page }}, 
            pageid: "itempager", 
            itemClass: "prod-item",
			pageIndex: 1
 
        });	
});
</script>
<!--- pagination --->
<!-- share code -->
<script src="{{ asset('resources/views/theme/share/share.js') }}"></script> 
<script type="text/javascript">
$(document).ready(function(){
        'use strict';
		$('.share-button').simpleSocialShare();

	});
</script> 
<!-- share code -->
<!-- validation code -->
<script src="{{ URL::to('resources/views/theme/validate/jquery.bvalidator.min.js') }}"></script>
<script src="{{ URL::to('resources/views/theme/validate/themes/presenters/default.min.js') }}"></script>
<script src="{{ URL::to('resources/views/theme/validate/themes/red/red.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        'use strict';
		var options = {
		
		offset:              {x:5, y:-2},
		position:            {x:'left', y:'center'},
        themes: {
            'red': {
                 showClose: true
            },
		
        }
    };

    $('#login_form').bValidator(options);
	$('#contact_form').bValidator(options);
	$('#subscribe_form').bValidator(options);
	$('#footer_form').bValidator(options);
	$('#comment_form').bValidator(options);
	$('#reset_form').bValidator(options);
	$('#support_form').bValidator(options);
	$('#item_form').bValidator(options);
	$('#search_form').bValidator(options);
	$('#checkout_form').bValidator(options);
	$('#profile_form').bValidator(options);
	$('#withdrawal_form').bValidator(options);
    });
</script>
<!-- validation code -->
<!-- ckeditor -->
<script src="{{url('vendor/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('vendor/tinymce/tinymce.min.js')}}"></script>
<script>
  tinymce.init({
    
	selector: '#summary-ckeditor', 
    
		plugins : 'advlist anchor autolinkcharmap code colorpicker contextmenu fullscreen hr image insertdatetime link lists media pagebreak preview print searchreplace tabfocus table textcolor',
	toolbar: [
		'newdocument | print preview | searchreplace | undo redo | link unlink anchor image media | alignleft aligncenter alignright alignjustify | code',
		'formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor',
		'removeformat | hr pagebreak | charmap subscript superscript insertdatetime | bullist numlist | outdent indent blockquote | table'
	],
	menubar : false,
	browser_spellcheck : true,
	branding: false,
	width: '100%',
	height : "480"
    
 
  
  });
  
  tinymce.init({
    
	selector: '#summary-ckeditor2', 
    
		plugins : 'advlist anchor autolinkcharmap code colorpicker contextmenu fullscreen hr image insertdatetime link lists media pagebreak preview print searchreplace tabfocus table textcolor',
	toolbar: [
		'newdocument | print preview | searchreplace | undo redo | link unlink anchor image media | alignleft aligncenter alignright alignjustify | code',
		'formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor',
		'removeformat | hr pagebreak | charmap subscript superscript insertdatetime | bullist numlist | outdent indent blockquote | table'
	],
	menubar : false,
	browser_spellcheck : true,
	branding: false,
	width: '100%',
	height : "480"
    
 
  
  });
</script>
<!-- ckeditor -->
<script src="{{ asset('resources/views/admin/template/dragdrop/js/jquery.filer.min.js') }}" type="text/javascript"></script>
<?php /*?><script src="{{ asset('resources/views/admin/template/dragdrop/js/custom.js') }}" type="text/javascript"></script><?php */?>
<script type="text/javascript">
$(document).ready(function(){
    'use strict';
	$('#item_thumbnail').filer({
		showThumbs: true,
		addMore: false,
		allowDuplicates: false,
		limit: 1,
        maxSize: null,
        extensions: ["jpeg", "jpg", "png"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only jpeg, jpg, png images are allowed to be uploaded."
			}
		}

	});
	$('#item_preview').filer({
		showThumbs: true,
		addMore: false,
		allowDuplicates: false,
		limit: 1,
        maxSize: null,
        extensions: ["jpeg", "jpg", "png"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only jpeg, jpg, png images are allowed to be uploaded."
			}
		}

	});
	
	
	
	
	$('#item_screenshot').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
		limit: null,
        maxSize: null,
        extensions: ["jpeg", "jpg", "png"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only jpeg, jpg, png images are allowed to be uploaded."
			}
		}

	});
	

});
</script>
<!-- countdown -->
<script type="text/javascript" src="{{ asset('resources/views/theme/countdown/jquery.countdown.js?v=1.0.0.0') }}"></script>
<!-- countdown -->
<!--- video code --->
<script type="text/javascript" src="{{ URL::to('resources/views/theme/video/video.js') }}"></script>
<script type="text/javascript">
		jQuery(function(){
		'use strict';
			jQuery("a.popupvideo").YouTubePopUp( { autoplay: 0 } ); // Disable autoplay
		});
</script>
<!--  video code --->
<!--- auto search -->
<script src="{{ URL::to('resources/views/theme/autosearch/jquery-ui.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function() {
   'use strict';
   var src = "{{ route('searchajax') }}";
     $("#product_item").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                   
                }
            });
        },
        minLength: 1,
       
    });
});
</script>
<script type="text/javascript">
   $(document).ready(function() {
    'use strict';
    var src = "{{ route('searchajax') }}";
     $("#product_item_top").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                   
                }
            });
        },
        minLength: 1,
       
    });
});
</script>
<!--- auto search -->
<!--- common code -->
<script type="text/javascript">
$(document).ready(function() {
  'use strict';
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });

/* Reply comment area js goes here */
    var $replyForm = $('.reply-comment'),
        $replylink = $('.reply-link');

    $replyForm.hide();
    $replylink.on('click', function (e) {
        e.preventDefault();
        $(this).parents('.media').siblings('.reply-comment').toggle().find('textarea').focus();
    });

}); 


$(function () {
'use strict';
$("#ifstripe").hide();
$("#ifpaystack").hide();
$("#iflocalbank").hide();
        $("input[name='withdrawal']").click(function () {
		
            if ($("#withdrawal-paypal").is(":checked")) 
			{
			   $("#ifpaypal").show();
			   $("#ifstripe").hide();
			   $("#ifpaystack").hide();
			   $("#iflocalbank").hide();
			}
			else if ($("#withdrawal-stripe").is(":checked"))
			{
			  $("#ifpaypal").hide();
			  $("#ifstripe").show();
			  $("#ifpaystack").hide();
			  $("#iflocalbank").hide();
			}
			else if ($("#withdrawal-paystack").is(":checked"))
			{
			  $("#ifpaypal").hide();
			  $("#ifstripe").hide();
			  $("#ifpaystack").show();
			  $("#iflocalbank").hide();
			}
			else if ($("#withdrawal-localbank").is(":checked"))
			{
			   $("#ifpaypal").hide();
			   $("#ifstripe").hide();
			   $("#ifpaystack").hide();
			   $("#iflocalbank").show();
			}
			else
			{
			$("#ifpaypal").hide();
			$("#ifstripe").hide();
			$("#ifpaystack").hide();
			$("#iflocalbank").hide();
			}
		});
    });
</script>
<!--- common code -->
@if($view_name == 'checkout' or $view_name == 'confirm-subscription')
<!-- stripe code -->
<script src="https://js.stripe.com/v3/"></script>
<script>
$(function () {
'use strict';
$("#ifYes").hide();
        $("input[name='payment_method']").click(function () {
		
            if ($("#opt1-stripe").is(":checked")) {
                $("#ifYes").show();
				
				/* stripe code */
				
				var stripe = Stripe('{{ $stripe_publish_key }}');
   
				var elements = stripe.elements();
					
				var style = {
				base: {
					color: '#32325d',
					lineHeight: '18px',
					fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
					fontSmoothing: 'antialiased',
					fontSize: '14px',
					'::placeholder': {
					color: '#aab7c4'
					}
				},
				invalid: {
					color: '#fa755a',
					iconColor: '#fa755a'
				}
				};
			 
				
				var card = elements.create('card', {style: style, hidePostalCode: true});
			 
				
				card.mount('#card-element');
			 
			   
				card.addEventListener('change', function(event) {
					var displayError = document.getElementById('card-errors');
					if (event.error) {
						displayError.textContent = event.error.message;
					} else {
						displayError.textContent = '';
					}
				});
			 
				
				var form = document.getElementById('checkout_form');
				form.addEventListener('submit', function(event) {
					/*event.preventDefault();*/
			        if ($("#opt1-stripe").is(":checked")) { event.preventDefault(); }
					stripe.createToken(card).then(function(result) {
					
						if (result.error) {
						
						var errorElement = document.getElementById('card-errors');
						errorElement.textContent = result.error.message;
						
						
						} else {
							
							document.querySelector('.token').value = result.token.id;
							 
							document.getElementById('checkout_form').submit();
						}
						/*document.querySelector('.token').value = result.token.id;
							 
							document.getElementById('checkout_form').submit();*/
						
					});
				});
							
						
			/* stripe code */	
				
				
				
            } else {
                $("#ifYes").hide();
            }
        });
    });
	

</script>
<!-- stripe code -->
@endif
<!-- cookie -->
<script type="text/javascript" src="{{ asset('resources/views/theme/cookie/cookiealert.js') }}"></script>
<!-- cookie -->
<!-- loading gif code -->
@if($allsettings->site_loader_display == 1)
<script type='text/javascript' src="{{ URL::to('resources/views/theme/loader/jquery.LoadingBox.js') }}"></script>
<script>
    $(function(){
	'use strict';
        var lb = new $.LoadingBox({loadingImageSrc: "{{ url('/') }}/public/storage/settings/{{ $allsettings->site_loader_image }}",});

        setTimeout(function(){
            lb.close();
        }, 1000);
    });
</script>
@endif
<!-- loading gif code -->
<!-- animation code -->
<script src="{{ URL::to('resources/views/theme/animate/aos.js') }}"></script>
<script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
</script>
<!-- animation code -->
<script type="text/javascript" src="{{ URL::to('resources/views/admin/template/datepicker/picker.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
'use strict';
$("#coupon_start_date").datepicker({
     minDate: 0, dateFormat: 'yy-mm-dd',
    onSelect: function (selected) {
      var dt = new Date(selected);
      dt.setDate(dt.getDate() + 1);
 $("#coupon_end_date").datepicker("option", "minDate", dt);
}                                 
});
  $("#coupon_end_date").datepicker({
    minDate: 0, dateFormat: 'yy-mm-dd',
    onSelect: function (selected) {
      var dt1 = new Date(selected);
      dt1.setDate(dt1.getDate() - 1);
      $("#coupon_start_date").datepicker("option", "maxDate", dt1);
    }
  });
});
</script>