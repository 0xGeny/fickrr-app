<style type="text/css">
.text-color
{
color:{{ $allsettings->site_theme_color }};
}
.text-color:hover
{
color:{{ $allsettings->site_button_hover }};
}
.btn-primary
{
color:#fff;background-color:{{ $allsettings->site_button_color }};border-color:{{ $allsettings->site_button_color }};box-shadow:none;
}
.term_text h1
{
color:{{ $allsettings->site_button_color }} !important;
text-align:center !important;
font-size:30px;
border:3px solid #E3E9EF;
padding:20px;
border-radius:5px;
}
.btn-primary:hover
{
color:#fff;background-color:{{ $allsettings->site_button_hover }};border-color:{{ $allsettings->site_button_hover }};
}
.btn-primary:focus,.btn-primary.focus
{
color:#fff;background-color:{{ $allsettings->site_button_hover }};border-color:{{ $allsettings->site_button_hover }};box-shadow:none,0 0 0 0 rgba(254,128,128,0.5);
}
.widget-list-link:hover,.jplist-selected
{
color:{{ $allsettings->site_button_color }} !important;
}
.ui-widget-header
{
background:{{ $allsettings->site_button_color }} !important;
}
.ui-widget-content
{
border:1px solid {{ $allsettings->site_button_color }} !important;
}
.link-color
{
color:{{ $allsettings->site_button_color }} !important;
}
.form-control:focus{color:#4b566b;background-color:#fff;border-color:{{ $allsettings->site_button_color }} !important;outline:0;}
.bg-primary{background-color:{{ $allsettings->site_button_color }} !important}a.bg-primary:hover,a.bg-primary:focus,button.bg-primary:hover,button.bg-primary:focus{background-color:{{ $allsettings->site_button_hover }} !important}
.btn-primary:not(:disabled):not(.disabled):active,.btn-primary:not(:disabled):not(.disabled).active,.show>.btn-primary.dropdown-toggle{color:#fff;background-color:{{ $allsettings->site_button_hover }};border-color:#fe2a2b}
.navbar-light .navbar-nav .show>.nav-link,.navbar-light .navbar-nav .active>.nav-link,.navbar-light .navbar-nav .nav-link.show,.navbar-light .navbar-nav .nav-link.active{color:{{ $allsettings->site_button_color }};}
.navbar-light .navbar-nav .nav-link:hover,.navbar-light .navbar-nav .nav-link:focus{color:{{ $allsettings->site_button_color }};}
a:hover{color:{{ $allsettings->site_button_color }};text-decoration:none}
.dropdown-item:hover,.dropdown-item:focus{color:{{ $allsettings->site_button_color }};text-decoration:none;background-color:rgba(0,0,0,0)}.dropdown-item.active,.dropdown-item:active{color:{{ $allsettings->site_button_color }};text-decoration:none;background-color:rgba(0,0,0,0)}
.text-primary{color:{{ $allsettings->site_button_color }} !important}
.dropdown-menu li:hover>.dropdown-item{color:{{ $allsettings->site_button_color }}}.dropdown-menu .active>.dropdown-item{color:{{ $allsettings->site_button_color }}}
.navbar-light .nav-item:hover .nav-link:not(.disabled),.navbar-light .nav-item:hover .nav-link:not(.disabled)>i{color:{{ $allsettings->site_button_color }};}.navbar-light .nav-item.active .nav-link:not(.disabled)>i,.navbar-light .nav-item.show .nav-link:not(.disabled)>i,.navbar-light .nav-item.dropdown .nav-link:focus:not(.disabled)>i{color:{{ $allsettings->site_button_color }};}
.bg-dark{background-color:{{ $allsettings->site_header_color }} !important}a.bg-dark:hover,a.bg-dark:focus,button.bg-dark:hover,button.bg-dark:focus{background-color:{{ $allsettings->site_header_color }} !important}
.topbar-dark .topbar-text>i,.topbar-dark .topbar-link>i{color:{{ $allsettings->site_button_color }}}
.navbar-tool .navbar-tool-label{position:absolute;top:-.3125rem;right:-.3125rem;width:1.25rem;height:1.25rem;border-radius:50%;background-color:{{ $allsettings->site_button_color }};color:#fff;font-size:.75rem;font-weight:500;text-align:center;line-height:1.25rem}
.btn-outline-accent{color:#ffffff; background:{{ $allsettings->site_button_color }}}
.btn-outline-accent:hover{color:#fff;background-color:{{ $allsettings->site_theme_color }};border-color:{{ $allsettings->site_theme_color }}}
.product-title>a:hover{color:{{ $allsettings->site_button_color }}}
.text-accent{color:{{ $allsettings->site_theme_color }} !important}
.bg-faded-accent{background-color:rgba(78,84,200,0.1) !important}
.price-old
{
color:#999999;
font-size:14px;
}
.turn-page .turn-ul li:hover, .turn-page .turn-ul li:active {
  background: {{ $allsettings->site_button_color }} !important;
  color: #fff;
}
.turn-page .turn-ul li.on {
  background: {{ $allsettings->site_button_color }} !important;
  color: #fff;
}
.btn-wishlist:hover{color:{{ $allsettings->site_button_color }}}
.flash-sale .price-badge { background:#DE2F2F; color:#FFFFFF; }
.widget-product-title:hover>a{color:{{ $allsettings->site_button_color }}}
.blog-entry-title>a:hover{color:{{ $allsettings->site_button_color }}}
.breadcrumb-item>a:hover{color:{{ $allsettings->site_button_color }};text-decoration:none}
.homeblog img
{
height:240px;
object-fit:cover;
width:100%;
}
.bg-darker{background-color:{{ $allsettings->site_footer_color }} !important}
a{color:{{ $allsettings->site_button_color }};text-decoration:none;background-color:transparent}
.display-404{color:#fff;font-size:10rem;text-shadow:-0.0625rem 0 {{ $allsettings->site_button_color }},0 0.0625rem {{ $allsettings->site_button_color }},0.0625rem 0 {{ $allsettings->site_button_color }},0 -0.0625rem {{ $allsettings->site_button_color }}}
.red
{
width: 100%;
margin-top: .25rem;
font-size: 80%;
color: #f34770;
}
.countdown-timer ul li
{
list-style:none;
display:inline-block;
background:{{ $allsettings->site_theme_color }};
color:#FFFFFF;
text-align:center;
min-width:70px;
opacity:0.6;
}
.range-price {
    border: 0;
    color: {{ $allsettings->site_button_color }} !important;
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 14px;
}
.lato{}.jplist-panel .jplist-pagination{cursor:pointer;float:right;line-height:30px}
.jplist-panel .jplist-pagination button{list-style: none;
    float: left;
    width: 38px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    border: 1px solid #54667a;
    margin-left: -1px;
    cursor: pointer;
    background: #fff;}
	.jplist-label { 
    cursor: pointer !important;
	line-height:55px;
    border-radius:0px !important;
	}
.jplist-panel button { border-radius:0px !important; box-shadow:0px !important; text-shadow:none !important; margin:10px 5px 0 0 !important; }	
.jplist-panel .jplist-pagination .jplist-current{color: #fff; background:{{ $allsettings->site_button_color }} !important;}
.jplist-panel .jplist-pagination .jplist-pagingprev,.jplist-panel .jplist-pagination .jplist-pagingmid,.jplist-panel .jplist-pagination .jplist-pagingnext{float:left}.jplist-panel .jplist-pagination .jplist-pagingprev button,.jplist-panel .jplist-pagination .jplist-pagingnext button{font-size:20px;}.jplist-one-page{display:none}.jplist-empty{display:none}
.customlable {
    float: right !important;
}
.btn-outline-accent:focus, .btn-outline-accent.focus
{
background-color:{{ $allsettings->site_button_color }} !important;
}
.nav-tabs .nav-link.active,.nav-tabs .nav-item.show .nav-link{color:{{ $allsettings->site_button_color }};background-color:rgba(0,0,0,0);border-color:{{ $allsettings->site_button_color }}}
.nav-tabs .nav-link.active::before{background-color:{{ $allsettings->site_button_color }}}
.nav-tabs .nav-link:hover{color:{{ $allsettings->site_button_color }}}
.custom-control-input:checked ~ .custom-control-label::before{color:#fff;border-color:{{ $allsettings->site_button_color }};background-color:{{ $allsettings->site_button_color }};box-shadow:none}
.btn-primary.btn-shadow{}
.review_tag {
  background: {{ $allsettings->site_button_color }};
  -webkit-border-radius: 200px;
          border-radius: 200px;
  line-height: 30px;
  padding: 0 12px;
  color: #fff;
  font-weight: 500;
  margin-left: 10px;
}
.custom_radio
{
color: #fff;
border-color: {{ $allsettings->site_button_color }};
background-color: {{ $allsettings->site_button_color }};
box-shadow: none;
}
.nav-link-style:hover{color:{{ $allsettings->site_button_color }};}
.cz-range-slider-ui .noUi-connect{background-color:{{ $allsettings->site_button_color }}}
.dropdown-content a:hover
{
color:{{ $allsettings->site_theme_color }};
}
.single-price-item:hover {
	border: 5px solid {{ $allsettings->site_button_color }};
}
.single-price-item p b {
	font-size: 35px;
	color: {{ $allsettings->site_theme_color }};
	margin-right: 10px;
}
.single-price-item h5:before {
	position: absolute;
	content: "";
	width: 54px;
	height: 2px;
	bottom: -10px;
	left: 0;
	right: 0;
	background: {{ $allsettings->site_theme_color }};
	margin: 0 auto;
}
.main-btn {
	display: inline-block;
	background: {{ $allsettings->site_button_color }};
	color: #ffffff;
	font-size: 16px;
	font-weight: 500;
	letter-spacing: 1px;
	text-transform: capitalize;
	padding: 14px 28px;
	text-align: center;
	vertical-align: middle;
	cursor: pointer;
	border-radius: 5px;
	-webkit-transition: .3s;
	transition: .3s;
}
.main-btn:hover {
	background-color: {{ $allsettings->site_button_hover }};
	color: #fff;
}
</style>