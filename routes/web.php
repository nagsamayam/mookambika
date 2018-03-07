<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::redirect('/home', '/secure', 301);

// Admin routes
Route::prefix('secure')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('tags', 'TagsController', ['names' => [
            'index'   => 'tags',
            'destroy' => 'tags.delete',
        ]]);
        Route::resource('sections', 'SectionsController', ['names' => [
            'index'   => 'sections',
            'destroy' => 'sections.delete',
        ]]);
        Route::resource('news', 'NewsController', ['names' => [
            'index'   => 'news',
            'destroy' => 'news.delete',
        ]]);
        Route::resource('faqs', 'FaqsController', ['names' => [
            'index'   => 'faqs',
            'destroy' => 'faqs.delete',
        ]]);
        Route::resource('reviews', 'ReviewsController', ['names' => [
            'index'   => 'reviews',
            'destroy' => 'reviews.delete',
        ]]);
        Route::resource('footers', 'FootersController', ['names' => [
            'index'   => 'footers',
            'destroy' => 'footers.delete',
        ]]);
        Route::resource('events', 'EventsController');
        Route::resource('pages', 'pagesController');
        Route::post('/tags/bulk-actions', 'TagsController@bulkAction')->name('tags.actions');
        Route::post('/sections/bulk-actions', 'SectionsController@bulkAction')->name('sections.actions');
        Route::post('/news/bulk-actions', 'NewsController@bulkAction')->name('news.actions');
        Route::post('/faqs/bulk-actions', 'FaqsController@bulkAction')->name('faqs.actions');
        Route::post('/reviews/bulk-actions', 'ReviewsController@bulkAction')->name('reviews.actions');
        Route::post('/footers/bulk-actions', 'FootersController@bulkAction')->name('footers.actions');
    });
