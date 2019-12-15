<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('login', 'AuthController@index');

$app->post('register', 'RegisterController@index');

$app->post('remind_pass', 'RemindPassController@index');

$app->post('send_restore_code', 'SendRestoreCodeController@index');

$app->post('change_password', 'ChangePasswordController@index');

$app->post('confirm', 'ConfirmController@index');

$app->get('basket', 'BasketController@index');

$app->post('basket_add', 'BasketAddController@index');

$app->post('basket_remove_item', 'BasketRemoveItemController@index');

$app->post('basket_change_quantity', 'BasketChangeQuantityController@index');

$app->get('popular', 'PopularController@index');

$app->get('discounts', 'DiscountsController@index');

$app->get('new_items', 'NewItemsController@index');

$app->get('hits', 'HitsController@index');

$app->get('recent_viewed', 'RecentViewedController@index');

$app->get('same_items', 'SameItemsController@index');

$app->get('banners', 'BannersController@index');

$app->get('sub_categories', 'SubCategoriesController@index');

$app->get('catalog', 'CatalogController@index');

$app->get('filter_colors', 'FilterColorsController@index');

$app->get('filter_sizes', 'FilterSizesController@index');

$app->get('favorites', 'FavoritesController@index');

$app->get('search', 'SearchController@index');

$app->get('user_info', 'UserInfoController@index');

$app->post('update_user', 'UpdateUserController@index');

$app->get('orders', 'OrdersController@index');

$app->get('product', 'ProductController@index');

$app->get('reviews', 'ReviewsController@index');

$app->post('place_order', 'PlaceOrderController@index');

$app->get('payment_methods', 'PaymentMethodsController@index');

$app->get('shipment_methods', 'ShipmentMethodsController@index');

$app->get('size_table', 'SizeTableController@index');

$app->post('kassapaymenthook', 'KassaPaymentHookController@index');

$app->get('test', 'TestController@index');
