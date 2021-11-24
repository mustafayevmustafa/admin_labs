<?php

use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\BrowserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompatibleController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ReviewCategoryController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
// App\Http\Controllers\Auth\LoginController@showLoginForm
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth', 'isAdmin');
Route::get('/edit-profile/{username}', [UserController::class, 'edit_profile'])->name('edit_profile')->middleware('auth', 'isAdmin');
Route::get('/password-change', [UserController::class, 'password_change'])->name('password_change')->middleware('auth');

Route::post('/user-profile-edit', [UserController::class, 'edit_profile_update'])->name('edit_profile_update')->middleware('auth', 'isAdmin');
Route::post('/password_change', [UserController::class, 'password_update'])->name('password_update')->middleware('auth');

// Category
Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('auth', 'isAdmin');
// Category Post
Route::post('/add-edit-category', [CategoryController::class, 'add_edit_category'])->name('add_edit_category')->middleware('auth', 'isAdmin');
Route::post('/edit-category', [CategoryController::class, 'edit_category'])->name('edit_category')->middleware('auth', 'isAdmin');
Route::post('/delete-category', [CategoryController::class, 'delete_category'])->name('delete_category')->middleware('auth', 'isAdmin');


// Browser
Route::get('/browsers', [BrowserController::class, 'index'])->name('browsers')->middleware('auth', 'isAdmin');
// Browser Post
Route::post('/add-edit-browser', [BrowserController::class, 'add_edit_browser'])->name('add_edit_browser')->middleware('auth', 'isAdmin');
Route::post('/edit-browser', [BrowserController::class, 'edit_browser'])->name('edit_browser')->middleware('auth', 'isAdmin');
Route::post('/delete-browser', [BrowserController::class, 'delete_browser'])->name('delete_browser')->middleware('auth', 'isAdmin');

// Layouts
Route::get('/layouts', [LayoutController::class, 'index'])->name('layouts')->middleware('auth', 'isAdmin');
// Layouts Post
Route::post('/add-edit-layout', [LayoutController::class, 'add_edit_layout'])->name('add_edit_layout')->middleware('auth', 'isAdmin');
Route::post('/edit-layout', [LayoutController::class, 'edit_layout'])->name('edit_layout')->middleware('auth', 'isAdmin');
Route::post('/delete-layout', [LayoutController::class, 'delete_layout'])->name('delete_layout')->middleware('auth', 'isAdmin');
// Api key
Route::get('/apikeys', [ApiKeyController::class, 'index'])->name('apikeys')->middleware('auth', 'isAdmin');
// Layouts Post
Route::post('/add-edit-apikey', [ApiKeyController::class, 'add_edit_apikey'])->name('add_edit_apikey')->middleware('auth', 'isAdmin');
Route::post('/edit-apikey', [ApiKeyController::class, 'edit_apikey'])->name('edit_apikey')->middleware('auth', 'isAdmin');
Route::post('/delete-apikey', [ApiKeyController::class, 'delete_apikey'])->name('delete_apikey')->middleware('auth', 'isAdmin');

// Footer
Route::get('/footer', [FooterController::class, 'index'])->name('footer')->middleware('auth', 'isAdmin');
// Footer Post
Route::post('/add-edit-footer', [FooterController::class, 'add_edit_footer'])->name('add_edit_footer')->middleware('auth', 'isAdmin');
Route::post('/edit-footer', [FooterController::class, 'edit_footer'])->name('edit_footer')->middleware('auth', 'isAdmin');
Route::post('/delete-footer', [FooterController::class, 'delete_footer'])->name('delete_footer')->middleware('auth', 'isAdmin');

// Header
Route::get('/header', [HeaderController::class, 'index'])->name('header')->middleware('auth', 'isAdmin');
// Header Post
Route::post('/add-edit-header', [HeaderController::class, 'add_edit_header'])->name('add_edit_header')->middleware('auth', 'isAdmin');
Route::post('/edit-header', [HeaderController::class, 'edit_header'])->name('edit_header')->middleware('auth', 'isAdmin');
Route::post('/delete-header', [HeaderController::class, 'delete_header'])->name('delete_header')->middleware('auth', 'isAdmin');

// Socials
Route::get('/socials', [SocialController::class, 'index'])->name('socials')->middleware('auth', 'isAdmin');
// Socials Post
Route::post('/add-edit-social', [SocialController::class, 'add_edit_social'])->name('add_edit_social')->middleware('auth', 'isAdmin');
Route::post('/edit-social', [SocialController::class, 'edit_social'])->name('edit_social')->middleware('auth', 'isAdmin');
Route::post('/delete-social', [SocialController::class, 'delete_social'])->name('delete_social')->middleware('auth', 'isAdmin');


// Compatible
Route::get('/compatibles', [CompatibleController::class, 'index'])->name('compatibles')->middleware('auth', 'isAdmin');
// Compatible Post
Route::post('/add-edit-compatible', [CompatibleController::class, 'add_edit_compatible'])->name('add_edit_compatible')->middleware('auth', 'isAdmin');
Route::post('/edit-compatible', [CompatibleController::class, 'edit_compatible'])->name('edit_compatible')->middleware('auth', 'isAdmin');
Route::post('/delete-compatible', [CompatibleController::class, 'delete_compatible'])->name('delete_compatible')->middleware('auth', 'isAdmin');



//Videos
Route::get('/videos', [\App\Http\Controllers\VideoController::class, 'index'])->name('videos')->middleware('auth', 'isAdmin');

//Video Post

Route::post('/add-edit-video', [\App\Http\Controllers\VideoController::class, 'add_edit_video'])->name('add_edit_video')->middleware('auth', 'isAdmin');
Route::post('/edit-video', [\App\Http\Controllers\VideoController::class, 'edit_video'])->name('edit_video')->middleware('auth', 'isAdmin');
Route::post('/delete-video', [\App\Http\Controllers\VideoController::class, 'delete_video'])->name('delete_video')->middleware('auth', 'isAdmin');



// Review Categories
Route::get('/review-categories', [ReviewCategoryController::class, 'index'])->name('review_categories')->middleware('auth', 'isAdmin');
// Review Categories Post
Route::post('/add-edit-review-category', [ReviewCategoryController::class, 'add_edit_review_category'])->name('add_edit_review_category')->middleware('auth', 'isAdmin');
Route::post('/edit-review-category', [ReviewCategoryController::class, 'edit_review_category'])->name('edit_review_category')->middleware('auth', 'isAdmin');
Route::post('/delete-review-category', [ReviewCategoryController::class, 'delete_review_category'])->name('delete_review_category')->middleware('auth', 'isAdmin');


// Register User
Route::get('/register-users', [RegisterUserController::class, 'index'])->name('register_users')->middleware('auth', 'isAdmin');
// Register User Post
Route::post('/add-edit-review-category', [ReviewCategoryController::class, 'add_edit_review_category'])->name('add_edit_review_category')->middleware('auth', 'isAdmin');
Route::post('/edit-review-category', [ReviewCategoryController::class, 'edit_review_category'])->name('edit_review_category')->middleware('auth', 'isAdmin');
Route::post('/delete-user', [RegisterUserController::class, 'delete_user'])->name('delete_user')->middleware('auth', 'isAdmin');

// UserReport
Route::get('/user-reports', [UserReportController::class, 'index'])->name('user_reports')->middleware('auth', 'isAdmin');
// UserReport Post
Route::post('/view-user-report', [UserReportController::class, 'view_user_report'])->name('view_user_report')->middleware('auth', 'isAdmin');
Route::post('/delete-user-report', [UserReportController::class, 'delete_user_report'])->name('delete_user_report')->middleware('auth', 'isAdmin');
Route::post('/done-user-report', [UserReportController::class, 'done_user_report'])->name('done_user_report')->middleware('auth', 'isAdmin');



// Project
Route::get('/file_upload_test', [ProjectController::class, 'file_upload_test'])->name('file_upload_test')->middleware('auth', 'isAdmin');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects')->middleware('auth', 'isAdmin');
Route::get('/project-detail/{slug}', [ProjectController::class, 'project_detail'])->name('project_detail')->middleware('auth', 'isAdmin');
Route::get('/project-edit/{id}', [ProjectController::class, 'edit'])->name('project_edit')->middleware('auth', 'isAdmin');
Route::get('/project-upload', [ProjectController::class, 'upload'])->name('project_upload')->middleware('auth', 'isAdmin');
// Project User Post
Route::post('/store-upload', [ProjectController::class, 'store'])->name('store_upload')->middleware('auth', 'isAdmin');
Route::post('/file-upload', [ProjectController::class, 'file_upload'])->name('file_upload')->middleware('auth', 'isAdmin');
Route::post('/image-upload', [ProjectController::class, 'upload_image'])->name('upload_image')->middleware('auth');
Route::post('/upload-category', [ProjectController::class, 'file_category'])->name('file_category')->middleware('auth', 'isAdmin');
Route::post('/upload-file-select', [ProjectController::class, 'file_select'])->name('file_select')->middleware('auth', 'isAdmin');
Route::post('/upload-main-file-select', [ProjectController::class, 'main_file_select'])->name('main_file_select')->middleware('auth', 'isAdmin');
Route::post('/upload-preview-file-select', [ProjectController::class, 'preview_file_select'])->name('preview_file_select')->middleware('auth', 'isAdmin');
Route::post('/upload-file-delete', [ProjectController::class, 'file_delete'])->name('file_delete')->middleware('auth', 'isAdmin');
Route::post('/edit-feature-delete', [ProjectController::class, 'feature_delete'])->name('feature_delete')->middleware('auth', 'isAdmin');


Route::post('/upload-preview-image', [ProjectController::class, 'preview_image'])->name('preview_file_select')->middleware('auth', 'isAdmin');
Route::post('/upload-preview-file', [ProjectController::class, 'preview_file'])->name('preview_file_select')->middleware('auth', 'isAdmin');


Route::post('/project-action', [ProjectController::class, 'project_action'])->name('project_action')->middleware('auth', 'isAdmin');
Route::post('/preview-image-show', [ProjectController::class, 'preview_image_show'])->name('preview_image_show')->middleware('auth', 'isAdmin');
Route::post('/web-send-file', [ProjectController::class, 'send_file'])->name('send_file')->middleware('auth', 'isAdmin');
Route::get('/download/{id}', [ProjectController::class, 'download'])->name('download')->middleware('auth', 'isAdmin');

// Payment
Route::get('/payments', [PaymentController::class, 'index'])->name('payments')->middleware('auth', 'isAdmin');
Route::get('/orders', [OrderController::class, 'index'])->name('orders')->middleware('auth', 'isAdmin');


//Bank Account
Route::get('/bank_account', [\App\Http\Controllers\BankController::class, 'index'])->name('bank_account')->middleware('auth', 'isAdmin');
Route::post('/change-status', [\App\Http\Controllers\BankController::class, 'changeStatus'])->name('change-status')->middleware('auth', 'isAdmin');
Route::get('/show_bank_account/{id}', [\App\Http\Controllers\BankController::class, 'show_account'])->name('bank_show');


Route::post('/send-order', [OrderController::class, 'send_order'])->name('send_order')->middleware('auth', 'isAdmin');
