<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;


Route::get('/', [HomeController::class, 'index_get'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'product_show'])->name('product.show');
Route::get('/products', [HomeController::class, 'products_all'])->name('products.all');
Route::get('/products/top-selling', [HomeController::class, 'products_top'])->name('products.top');
Route::get('/products/new-arrivals', [HomeController::class, 'products_new'])->name('products.new');
Route::get('/products/{category}', [HomeController::class, 'products_category'])->name('products.category');
Route::get('/products/search/{search}', [HomeController::class, 'products_search'])->name('products.search');
Route::get('/checkout', [AccountController::class, 'checkout_get'])->name('checkout');
Route::get('/payment', [AccountController::class, 'payment_get'])->name('payment');
Route::get('/thank-you', [AccountController::class, 'thankyou'])->name('thankyou');
Route::get('/contact-us', [HomeController::class, 'contact_get'])->name('contact.get');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::get('/account', [AccountController::class, 'account'])->name('account');

Route::post('/contact-us', [HomeController::class, 'contact_post'])->name('contact.post');


Route::get('/admin', [AdminController::class, 'admin_get'])->name('admin.get');
Route::post('/admin', [AdminController::class, 'admin_post'])->name('admin.post');
Route::post('/admin/delete/product', [AdminController::class, 'admin_delete_product'])->name('admin.delete.product');
Route::post('/admin/product/{id}', [AdminController::class, 'admin_open_product'])->name('admin.open.product');

Route::get('/admin/manage/products', [AdminController::class, 'admin_get'])->name('admin.manage.products');
Route::get('/admin/add/product', [AdminController::class, 'admin_add_product_get'])->name('admin.add.product');
Route::get('/admin/open/product/{id}', [AdminController::class, 'admin_open_product'])->name('admin.open.product');
Route::get('/admin/manage/orders', [AdminController::class, 'admin_orders_get'])->name('admin.orders.get');
Route::get('/admin/open/order/{id}', [AdminController::class, 'admin_open_order'])->name('admin.open.order');

Route::post('/ajax/add/product/image', [AdminController::class, 'ajax_add_product_image'])->name('ajax.add.product.image');
Route::post('/ajax/add/product', [AdminController::class, 'ajax_add_product'])->name('ajax.add.product');
Route::post('/ajax/modify/product', [AdminController::class, 'ajax_modify_product'])->name('ajax.modify.product');
Route::post('/ajax/delete/product', [AdminController::class, 'ajax_delete_product'])->name('ajax.delete.product');
Route::post('/ajax/delete/image', [AdminController::class, 'ajax_delete_image'])->name('ajax.delete.image');
Route::post('/ajax/update/order/status', [AdminController::class, 'ajax_update_order_statues'])->name('ajax.update.order.status');

Route::post('/ajax/add/cart', [AccountController::class, 'ajax_add_cart'])->name('ajax.add.cart');
Route::post('/ajax/remove/cart', [AccountController::class, 'remove_cart_item'])->name('ajax.remove.cart.item');
Route::post('/ajax/submit/order', [AccountController::class, 'submit_order'])->name('ajax.submit.order');
Route::post('/ajax/update/phone_payment', [AccountController::class, 'ajax_update_phone_payment'])->name('ajax.update.phone_payment');
Route::post('/ajax/track/shipment', [AccountController::class, 'ajax_track_shipment'])->name('ajax.track.shipment');
Route::post('/ajax/update/personal_information', [AccountController::class, 'ajax_update_personal_information'])->name('ajax.update.personal_information');
Route::post('/ajax/signout', [AccountController::class, 'ajax_signout'])->name('ajax.signout');


Route::post('/ajax/login', [AccountController::class, 'ajax_login'])->name('ajax.login');
Route::post('/ajax/register', [AccountController::class, 'ajax_register'])->name('ajax.register');