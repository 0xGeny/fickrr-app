<?php


Route::group(['middleware' => ['XSS']], function () {


Route::get('/', 'CommonController@view_index');
Route::get('/index', 'CommonController@view_index');
Route::post('/index', ['as' => 'index','uses'=>'CommonController@update_video']);
/* language */

Route::get('/translate/{translate}', 'CommonController@cookie_translate');

/* language */

Auth::routes();


Route::get('/logout', 'Admin\CommonController@logout');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
/* profile settings */

Route::get('/profile-settings', 'ProfileController@view_profile_settings');
Route::post('/profile-settings', ['as' => 'profile-settings','uses'=>'ProfileController@update_profile']);

/* profile settings */


/* sitemap */
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap.xml/items', 'SitemapController@items');
Route::get('/sitemap.xml/category', 'SitemapController@category');
Route::get('/sitemap.xml/subcategory', 'SitemapController@subcategory');
Route::get('/sitemap.xml/pages', 'SitemapController@pages');
Route::get('/sitemap.xml/blog', 'SitemapController@blog');
Route::get('/sitemap.xml/users', 'SitemapController@users');
/* sitemap */


/* user */

Route::get('/user/{slug}', 'CommonController@view_user');
Route::get('/user-reviews/{slug}', 'CommonController@view_user_reviews');
Route::get('/user-followers/{slug}', 'CommonController@view_user_followers');
Route::get('/user-following/{slug}', 'CommonController@view_user_following');

Route::post('/user', ['as' => 'user','uses'=>'CommonController@send_message']);
Route::get('/user/{myid}/{followid}', 'CommonController@view_follow');
Route::get('/user/{unfollow}/{myid}/{followid}', 'CommonController@view_unfollow');
/* user */


/* top authors */
Route::get('/top-authors', 'CommonController@view_top_authors');
/* top authors */

Route::get('/start-selling', 'CommonController@view_start_selling');

/* email verification */

Route::get('/user-verify/{user_token}', 'CommonController@user_verify');

/* email verification */


/* item */

Route::get('/upload-item/{itemtype}', 'ItemController@upload_item');
Route::post('/upload-item', ['as' => 'upload-item','uses'=>'ItemController@save_items']);

Route::get('/manage-item', 'ItemController@manage_item');
Route::get('/manage-item/{token}', 'ItemController@delete_item_request');
Route::get('/edit-item/{token}', 'ItemController@edit_item');
Route::get('/edit-item/{dropimg}/{token}', 'ItemController@drop_image_item');
Route::post('/edit-item', ['as' => 'edit-item','uses'=>'ItemController@update_items']);

Route::get('/item/{slug}/{id}', 'CommonController@view_single_item');
Route::get('/item/{id}/{favorite}/{liked}', 'ItemController@view_favorite_item');
Route::get('/item/{token}', 'CommonController@view_free_item');

Route::post('/post-comment', ['as' => 'post-comment','uses'=>'ItemController@add_post_comment']);
Route::post('/reply-post-comment', ['as' => 'reply-post-comment','uses'=>'ItemController@reply_post_comment']);

/* item */


/* preview */
Route::get('/preview/{slug}/{id}', 'CommonController@view_preview');
/* preview */


/* favourites */
Route::get('/favourites', 'ItemController@favourites_item');
Route::get('/favourites/{fav_id}/{item_id}', 'ItemController@remove_favourites_item');
/* favourites */



/* forgot */

Route::get('/forgot', 'CommonController@view_forgot');
Route::post('/forgot', ['as' => 'forgot','uses'=>'CommonController@update_forgot']);
Route::get('/reset/{user_token}', 'CommonController@view_reset');
Route::post('/reset', ['as' => 'reset','uses'=>'CommonController@update_reset']);

/* forgot */


/* pages */
Route::get('/404', 'CommonController@not_found');
Route::get('/page/{page_id}/{page_slug}', 'PageController@view_page');

/* pages */


/* flash sale */

Route::get('/flash-sale', 'CommonController@view_flash_items');
Route::get('/free-items', 'CommonController@view_free_items');
/* flash sale */


/* coupon */
Route::get('/coupon', 'CouponController@view_coupon');
Route::get('/add-coupon', 'CouponController@add_coupon')->name('add-coupon');
Route::post('/add-coupon', 'CouponController@save_coupon');
Route::get('/coupon/{coupon_id}', 'CouponController@delete_coupon');
Route::get('/edit-coupon/{coupon_id}', 'CouponController@edit_coupon')->name('edit-coupon');
Route::post('/edit-coupon', ['as' => 'edit-coupon','uses'=>'CouponController@update_coupon']);
/* coupon */


/* blog */

Route::get('/blog', 'BlogController@view_blog');
Route::get('/single/{slug}', 'BlogController@view_single');
Route::get('/blog/{category}/{id}/{slug}', 'BlogController@view_category_blog');
Route::post('/single', ['as' => 'single','uses'=>'BlogController@insert_comment']);
Route::get('/tag/{blog}/{slug}', 'BlogController@view_tags');
/* blog */


/* shop */

Route::get('/shop', 'CommonController@view_all_items');
Route::get('/shop/{filter}', 'CommonController@view_filter_items');
Route::get('/shop/{item_type}/{slug}', 'CommonController@view_item_type');
Route::get('/shop/{type}/{id}/{slug}', 'CommonController@view_category_items');
Route::post('/shop', ['as' => 'shop','uses'=>'CommonController@view_shop_items']);
Route::get('/shop-list', 'CommonController@view_all_list_items');

/* shop */



/* comment */



/* comment */


/* contact support */

Route::post('/support', ['as' => 'support','uses'=>'ItemController@contact_support']);

/* contact support */


/* cart */
Route::get('/cart', 'ItemController@show_cart');
Route::get('/cart/{ord_id}', 'ItemController@remove_cart_item');
Route::post('/cart', ['as' => 'cart','uses'=>'ItemController@view_cart']);
Route::post('/coupon', ['as' => 'coupon','uses'=>'ItemController@view_coupon']);
Route::get('/cart/{remove}/{coupon}', 'ItemController@remove_coupon');
/* cart */


/* checkout */
Route::get('/checkout', 'ItemController@show_checkout');
Route::post('/checkout', ['as' => 'checkout','uses'=>'ItemController@view_checkout']);
Route::post('/2checkout', ['as' => '2checkout','uses'=>'ItemController@confirm_2checkout']);
Route::post('/paystack', ['as' => 'paystack','uses'=>'ItemController@redirectToGateway']);
Route::get('/paystack', 'ItemController@handleGatewayCallback');
/* checkout */


/* success */
Route::get('/success/{ord_token}', 'ItemController@paypal_success');
Route::get('/cancel', 'CommonController@payment_cancel');
Route::get('/success', 'ItemController@view_success');
/* success */


/* purchases */

Route::get('/purchases', 'ItemController@view_purchases');
Route::get('/purchases/{token}', 'ItemController@purchases_download');
Route::post('/purchases', ['as' => 'purchases','uses'=>'ItemController@rating_purchases']);
Route::get('/invoice/{product_token}/{order_id}', 'ItemController@invoice_download');
/* purchases */

/* sales */

Route::get('/sales', 'ItemController@view_sales');
Route::get('/sales/{token}', 'ItemController@view_order_details');
Route::post('/refund', ['as' => 'refund','uses'=>'ItemController@refund_request']);

/* sales */


/* withdrawal */

Route::get('/withdrawal', 'ItemController@view_withdrawal');
Route::post('/withdrawal', ['as' => 'withdrawal','uses'=>'ItemController@withdrawal_request']);

/* withdrawal */



/* contact */

Route::get('/contact', 'CommonController@view_contact');
Route::post('/contact', ['as' => 'contact','uses'=>'CommonController@update_contact']);
/* contact */


/* newsletter */
	Route::post('/newsletter', ['as' => 'newsletter','uses'=>'CommonController@update_newsletter']);
	Route::get('/newsletter/{token}', 'CommonController@activate_newsletter');
	Route::get('/newsletter', 'CommonController@view_newsletter');
	/* newsletter */



});

/* admin panel */


Route::group(['middleware' => ['is_admin', 'XSS']], function () {
    Route::get('/admin', 'Admin\AdminController@admin');
	
	/* customer */
	Route::get('/admin/customer', 'Admin\MembersController@customer');
	Route::get('/admin/add-customer', 'Admin\MembersController@add_customer')->name('admin.add-customer');
	Route::post('/admin/add-customer', 'Admin\MembersController@save_customer');
	Route::get('/admin/customer/{token}', 'Admin\MembersController@delete_customer');
	Route::get('/admin/edit-customer/{token}', 'Admin\MembersController@edit_customer')->name('admin.edit-customer');
	Route::post('/admin/edit-customer', ['as' => 'admin.edit-customer','uses'=>'Admin\MembersController@update_customer']);
	/* customer */
	
	
	/* vendor */
	Route::get('/admin/vendor', 'Admin\MembersController@vendor');
	Route::get('/admin/add-vendor', 'Admin\MembersController@add_vendor')->name('admin.add-vendor');
	Route::post('/admin/add-vendor', 'Admin\MembersController@save_customer');
	Route::get('/admin/vendor/{token}', 'Admin\MembersController@delete_customer');
	Route::get('/admin/edit-vendor/{token}', 'Admin\MembersController@edit_vendor')->name('admin.edit_vendor');
	Route::post('/admin/edit-vendor', ['as' => 'admin.edit-vendor','uses'=>'Admin\MembersController@update_customer']);
	/* vendor */
	
	/* media settings */
	
	Route::get('/admin/media-settings', 'Admin\SettingsController@media_settings');
	Route::post('/admin/media-settings', ['as' => 'admin.media-settings','uses'=>'Admin\SettingsController@update_media_settings']);
		
	/* media settings */
	
	/* edit profile */
	
	Route::get('/admin/edit-profile', 'Admin\MembersController@edit_profile');
	Route::post('/admin/edit-profile', ['as' => 'admin.edit-profile','uses'=>'Admin\MembersController@update_profile']);
	/* edit profile */
	
	
	/* settings */
	
	Route::get('/admin/general-settings', 'Admin\SettingsController@general_settings');
	Route::post('/admin/general-settings', ['as' => 'admin.general-settings','uses'=>'Admin\SettingsController@update_general_settings']);
	
	
	Route::get('/admin/currency-settings', 'Admin\SettingsController@currency_settings');
	Route::get('/admin/add-currency', 'Admin\SettingsController@add_currency')->name('admin.add-currency');
	Route::post('/admin/add-currency', 'Admin\SettingsController@save_currency');
	Route::get('/admin/currency-settings/{cid}', 'Admin\SettingsController@delete_currency');
	Route::get('/admin/edit-currency/{cid}', 'Admin\SettingsController@edit_currency')->name('admin.edit-currency');
	Route::post('/admin/edit-currency', ['as' => 'admin.edit-currency','uses'=>'Admin\SettingsController@update_currency']);
	Route::get('/admin/email-settings', 'Admin\SettingsController@email_settings');
	Route::post('/admin/email-settings', ['as' => 'admin.email-settings','uses'=>'Admin\SettingsController@update_email_settings']);
	Route::get('/admin/country-settings', 'Admin\SettingsController@country_settings');
	Route::get('/admin/add-country', 'Admin\SettingsController@add_country')->name('admin.add-country');
	Route::post('/admin/add-country', 'Admin\SettingsController@save_country');
	Route::get('/admin/country-settings/{cid}', 'Admin\SettingsController@delete_country');
	Route::get('/admin/edit-country/{cid}', 'Admin\SettingsController@edit_country')->name('admin.edit-country');
	Route::post('/admin/edit-country', ['as' => 'admin.edit-country','uses'=>'Admin\SettingsController@update_country']);
	Route::get('/admin/payment-settings', 'Admin\SettingsController@payment_settings');
	Route::post('/admin/payment-settings', ['as' => 'admin.payment-settings','uses'=>'Admin\SettingsController@update_payment_settings']);
	Route::get('/admin/social-settings', 'Admin\SettingsController@social_settings');
	Route::post('/admin/social-settings', ['as' => 'admin.social-settings','uses'=>'Admin\SettingsController@update_social_settings']);
	Route::get('/admin/highlights', 'Admin\SettingsController@highlights');
	Route::post('/admin/highlights', ['as' => 'admin.highlights','uses'=>'Admin\SettingsController@update_highlights']);
	
	Route::get('/admin/badges-settings', 'Admin\SettingsController@badges_settings');
	Route::post('/admin/badges-settings', ['as' => 'admin.badges-settings','uses'=>'Admin\SettingsController@update_badges_settings']);
	
	Route::get('/admin/start-selling', 'Admin\SettingsController@start_selling');
	Route::post('/admin/start-selling', ['as' => 'admin.start-selling','uses'=>'Admin\SettingsController@update_start_selling']);
	/* settings */
	
	/* demo mode */
	Route::post('/admin/demo-mode', ['as' => 'admin.demo-mode','uses'=>'Admin\SettingsController@update_demo_mode']);
	Route::get('/admin/demo-mode', 'Admin\SettingsController@demo_mode');
	/* demo mode */
	
	
	/* pages */
	
	Route::get('/admin/pages', 'Admin\PagesController@pages');
	Route::get('/admin/add-page', 'Admin\PagesController@add_page')->name('admin.add-page');
	Route::post('/admin/add-page', 'Admin\PagesController@save_page');
	Route::get('/admin/pages/{page_id}', 'Admin\PagesController@delete_pages');
	Route::get('/admin/edit-page/{page_id}', 'Admin\PagesController@edit_page')->name('admin.edit-page');
	Route::post('/admin/edit-page', ['as' => 'admin.edit-page','uses'=>'Admin\PagesController@update_page']);
	
	/* pages */
	
	
	
	
	/* category */
	
	Route::get('/admin/category', 'Admin\CategoryController@category');
	Route::get('/admin/add-category', 'Admin\CategoryController@add_category')->name('admin.add-category');
	Route::post('/admin/add-category', 'Admin\CategoryController@save_category');
	Route::get('/admin/category/{cat_id}', 'Admin\CategoryController@delete_category');
	Route::get('/admin/edit-category/{cat_id}', 'Admin\CategoryController@edit_category')->name('admin.edit-category');
	Route::post('/admin/edit-category', ['as' => 'admin.edit-category','uses'=>'Admin\CategoryController@update_category']);
	/* category */
	
	
	/* subcategory */
	
	Route::get('/admin/sub-category', 'Admin\CategoryController@subcategory');
	Route::get('/admin/add-subcategory', 'Admin\CategoryController@add_subcategory')->name('admin.add-subcategory');
	Route::post('/admin/add-subcategory', 'Admin\CategoryController@save_subcategory');
	Route::get('/admin/sub-category/{subcat_id}', 'Admin\CategoryController@delete_subcategory');
	Route::get('/admin/edit-subcategory/{cat_id}', 'Admin\CategoryController@edit_subcategory')->name('admin.edit-subcategory');
	Route::post('/admin/edit-subcategory', ['as' => 'admin.edit-subcategory','uses'=>'Admin\CategoryController@update_subcategory']);
	/* subcategory */
	
	
	
	/* blog */
	
	Route::get('/admin/blog-category', 'Admin\BlogController@blog_category');
	Route::get('/admin/add-blog-category', 'Admin\BlogController@add_blog_category')->name('admin.add-blog-category');
	Route::post('/admin/add-blog-category', 'Admin\BlogController@save_blog_category');
	Route::get('/admin/blog-category/{blog_cat_id}', 'Admin\BlogController@delete_blog_category');
	Route::get('/admin/edit-blog-category/{blog_cat_id}', 'Admin\BlogController@edit_blog_category')->name('admin.edit-blog-category');
	Route::post('/admin/edit-blog-category', ['as' => 'admin.edit-blog-category','uses'=>'Admin\BlogController@update_blog_category']);
	
	/* blog */
	
	
	
	/* post */
	
	Route::get('/admin/post', 'Admin\BlogController@posts');
	Route::get('/admin/add-post', 'Admin\BlogController@add_post')->name('admin.add-post');
	Route::post('/admin/add-post', 'Admin\BlogController@save_post');
	Route::get('/admin/post/{post_id}', 'Admin\BlogController@delete_post');
	Route::get('/admin/edit-post/{post_id}', 'Admin\BlogController@edit_post')->name('admin.edit-post');
	Route::post('/admin/edit-post', ['as' => 'admin.edit-post','uses'=>'Admin\BlogController@update_post']);
	
	/* post */
	
	
	
	/* items */
	
	Route::get('/admin/items', 'Admin\ItemController@view_items');
	Route::get('/admin/upload-item/{itemtype}', 'Admin\ItemController@upload_item');
	Route::post('/admin/upload-item', ['as' => 'admin.upload-item','uses'=>'Admin\ItemController@save_items']);
	Route::get('/admin/edit-item/{token}', 'Admin\ItemController@edit_item');
    Route::get('/admin/edit-item/{dropimg}/{token}', 'Admin\ItemController@drop_image_item');
    Route::post('/admin/edit-item', ['as' => 'admin.edit-item','uses'=>'Admin\ItemController@update_items']);
	Route::get('/admin/items/{token}', 'Admin\ItemController@delete_item_request');
	Route::get('/admin/items/{featured}/{token}', 'Admin\ItemController@featured_item_request');
	/* items */
	
	
	
	/* orders */
	
	Route::get('/admin/orders', 'Admin\ItemController@view_orders');
	Route::get('/admin/order-details/{token}', 'Admin\ItemController@view_order_single');
	Route::get('/admin/order-details/{ord_id}/{user_type}', 'Admin\ItemController@view_payment_approval');
	Route::get('/admin/more-info/{token}', 'Admin\ItemController@view_more_info');
	Route::get('/admin/orders/{ord_id}', 'Admin\ItemController@complete_orders');
	/* orders */
	
	
	/* refund request */
	
	Route::get('/admin/refund', 'Admin\ItemController@view_refund');
	Route::get('/admin/refund/{ord_id}/{refund_id}/{user_type}', 'Admin\ItemController@view_payment_refund');
	/* refund request */
	
	
	/* rating */
	
	Route::get('/admin/rating', 'Admin\ItemController@view_rating');
	Route::get('/admin/rating/{rating_id}', 'Admin\ItemController@rating_delete');
	/* rating */
	
	
	/* item type */
	Route::get('/admin/item-type', 'Admin\ItemController@view_item_type');
	Route::get('/admin/item-type/{id}/{status}', 'Admin\ItemController@view_item_type_status');
	Route::get('/admin/add-item-type', 'Admin\ItemController@view_add_item_type');
	Route::post('/admin/add-item-type', ['as' => 'admin.add-item-type','uses'=>'Admin\ItemController@save_add_item_type']);
	Route::get('/admin/item-type/{id}', 'Admin\ItemController@view_item_type_delete');
	Route::get('/admin/edit-item-type/{id}', 'Admin\ItemController@edit_item_type');
	Route::post('/admin/edit-item-type', ['as' => 'admin.edit-item-type','uses'=>'Admin\ItemController@update_edit_item_type']);
	/* item type */
	
	
	/* attributes */
	/*Route::get('/admin/attributes/{type_id}', 'Admin\ItemController@view_attribute');
	Route::post('/admin/attributes', ['as' => 'admin.attributes','uses'=>'Admin\ItemController@update_attribute']);*/
	
	/* attributes */
	
	/* attributes */
  Route::get('/admin/attributes', 'Admin\AttributeController@attribute');
  Route::get('/admin/add-attribute', 'Admin\AttributeController@add_attribute')->name('admin.add-attribute');
  Route::post('/admin/add-attribute', 'Admin\AttributeController@save_attribute');
  Route::get('/admin/attributes/{attr_id}', 'Admin\AttributeController@delete_attribute');
  Route::get('/admin/edit-attribute/{attr_id}', 'Admin\AttributeController@edit_attribute')->name('admin.edit-attribute');
  Route::post('/admin/edit-attribute', ['as' => 'admin.edit-attribute','uses'=>'Admin\AttributeController@update_attribute']);
  /* attributes */
	
	
	/* withdrawal */
	
	Route::get('/admin/withdrawal', 'Admin\ItemController@view_withdrawal');
	Route::get('/admin/withdrawal/{wd_id}/{wd_user_id}', 'Admin\ItemController@view_withdrawal_update');
	/* withdrawal */
	
	
	/* contact */
	Route::get('/admin/contact', 'Admin\CommonController@view_contact');
	Route::get('/admin/contact/{id}', 'Admin\CommonController@view_contact_delete');
	/* contact */
	
	/* newsletter */
	Route::get('/admin/newsletter', 'Admin\CommonController@view_newsletter');
	Route::get('/admin/newsletter/{id}', 'Admin\CommonController@view_newsletter_delete');
	Route::get('/admin/send-updates', 'Admin\CommonController@view_send_updates');
	Route::post('/admin/send-updates', ['as' => 'admin.send-updates','uses'=>'Admin\CommonController@send_updates']);
	/* newsletter */
	
	/* languages */
	Route::get('/admin/languages', 'Admin\LanguageController@view_languages');
	Route::get('/admin/add-language', 'Admin\LanguageController@add_language')->name('admin.add-language');
	Route::post('/admin/add-language', 'Admin\LanguageController@save_language');
	Route::get('/admin/languages/{token}/{code}', 'Admin\LanguageController@delete_languages');
	Route::get('/admin/edit-language/{language_id}', 'Admin\LanguageController@edit_language')->name('admin.edit-language');
	Route::post('/admin/edit-language', ['as' => 'admin.edit-language','uses'=>'Admin\LanguageController@update_language']);
	/* languages */
	
	
	/* edit keywords */
	Route::get('/admin/add-keywords', 'Admin\LanguageController@add_keywords');
	Route::post('/admin/add-keywords', ['as' => 'admin.add-keywords','uses'=>'Admin\LanguageController@insert_keywords']);
	Route::get('/admin/edit-keywords/{code}', 'Admin\LanguageController@edit_keywords');
	Route::post('/admin/edit-keywords', ['as' => 'admin.edit-keywords','uses'=>'Admin\LanguageController@save_keywords']);
	/* edit keywords */
	
	
	
});


/* admin panel */