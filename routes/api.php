<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// HomeController routes
Route::get('get-home-page-content', [HomeController::class,'getHomePageContent']);
Route::post('create-home-page-content', [HomeController::class,'createHomePageContent']);
Route::delete('delete-home-page-content/{id}', [HomeController::class,'deleteHomePageContent']);

// ClientController routes
Route::get('get-client-page-content', [ClientController::class,'getClientPageContent']);
Route::post('create-client-page-content', [ClientController::class,'createClientPageContent']);
Route::delete('delete-client-page-content/{id}', [ClientController::class,'deleteClientPageContent']);
Route::post('contact_us', [ClientController::class,'contactUs']);

// DistributorController routes 
Route::get('get-distributor-page-content', [DistributorController::class,'getDistributorPageContent']);
Route::post('create-distributor-page-content', [DistributorController::class,'createDistributorPageContent']);
Route::delete('delete-distributor-page-content/{id}', [DistributorController::class,'deleteDistributorPageContent']);

// BlogController routes 
Route::get('get-blog-page-content', [BlogController::class,'getBlogPageContent']);
Route::post('create-blog-page-content', [BlogController::class,'createBlogPageContent']);
Route::delete('delete-blog-page-content/{id}', [BlogController::class,'deleteBlogPageContent']);

// EventController routes 
Route::get('get-latest_event', [EventController::class,'getLatestEvent']);
Route::post('create-latest_event', [EventController::class,'createLatestEvent']);
Route::delete('delete-latest_event/{id}', [EventController::class,'deleteLatestEvent']);
Route::get('get-upcoming-event', [EventController::class,'getUpcomingEvent']);
Route::post('create-upcoming-event', [EventController::class,'createUpcomingEvent']);
Route::delete('delete-upcoming-event/{id}', [EventController::class,'deleteUpcomingEvent']);

// OfferController routes 
Route::get('get-offer-page-content', [OfferController::class,'getOfferPageContent']);
Route::post('create-offer-page-content', [OfferController::class,'createOfferPageContent']);
Route::delete('delete-offer-page-content/{id}', [OfferController::class,'deleteOfferPageContent']);

// BannerController routes
Route::get('get-banner-content', [BannerController::class,'getBannerContent']);
Route::post('create-banner-content', [BannerController::class,'createBannerContent']);
Route::delete('delete-banner-content/{id}', [BannerController::class,'deleteBannerContent']);

// TestimonialController routes
Route::get('get-testimonial', [TestimonialController::class,'getTestimonial']);
Route::post('create-testimonial', [TestimonialController::class,'createTestimonial']);
Route::delete('delete-testimonial/{id}', [TestimonialController::class,'deleteTestimonial']);

// CategoryController routes
Route::get('get-category', [CategoryController::class,'getCategory']);
Route::post('create-category', [CategoryController::class,'createCategory']);
Route::delete('delete-category/{id}', [CategoryController::class,'deleteCategory']);