<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
Route::middleware(['auth'])->get('/storage/{episode}/{type}', App\Http\Controllers\StorageController::class)->name('storage');
Route::get('/storage/{episode}/{filename}', [StorageController::class, 'segment'])->where('filename', '.*');

Route::get('/',App\Http\Controllers\Site\Homes\Home::class)->name('home');
Route::get('/courses', \App\Http\Controllers\Site\Courses\IndexCourse::class)->name('courses');
Route::get('/courses/{slug?}',App\Http\Controllers\Site\Courses\SingleCourse::class)->name('course');
Route::get('/articles',App\Http\Controllers\Site\Articles\IndexArticle::class)->name('articles');
Route::get('/articles/{slug?}',App\Http\Controllers\Site\Articles\SingleArticle::class)->name('article');
Route::get('/contact-us',App\Http\Controllers\Site\Settings\Contact::class)->name('contact');
Route::get('/about-us',App\Http\Controllers\Site\Settings\About::class)->name('about');
Route::get('/faq',App\Http\Controllers\Site\Settings\Fag::class)->name('faq');
Route::get('/auth',App\Http\Controllers\Site\Auth\Auth::class)->name('auth');
Route::get('/teachers',App\Http\Controllers\Site\Teachers\IndexTeacher::class)->name('teachers');
Route::get('/teachers/{id}',App\Http\Controllers\Site\Teachers\SingleTeacher::class)->name('teacher');
Route::get('/codes/{code}',App\Http\Controllers\CodeController::class)->name('codes');
// v2-samples
Route::get('/sample-questions',App\Http\Controllers\Site\Samples\IndexSample::class)->name('samples');
Route::get('/sample-questions/{slug}',App\Http\Controllers\Site\Samples\SingleSample::class)->name('sample');
// v3-teachers
Route::middleware(['auth','no_teacher'])->get('/apply',App\Http\Controllers\Site\Settings\TeacherRequest::class)->name('teacher.apply');

Route::middleware(['auth'])->group(function (){
    Route::get('/cart',App\Http\Controllers\Site\Carts\Cart::class)->name('cart');

    Route::get('/checkout',App\Http\Controllers\Site\Carts\Checkout::class)->name('checkout');
    Route::get('/verify/{gateway?}',App\Http\Controllers\Site\Carts\Verify::class)->name('verify');
});

Route::middleware('guest')->get('auth',App\Http\Controllers\Site\Auth\NewAuth::class)->name('auth');

Route::get('/logout', function (){
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');
Route::get('optimize',function (){
    \Illuminate\Support\Facades\Artisan::call("optimize");
});
Route::get('link',function (){
    \Illuminate\Support\Facades\Artisan::call("storage:link");
});
Route::get('/exams', \App\Http\Controllers\Site\Exams\IndexExams::class)->name('exams');
Route::get('/exams/{slug?}', \App\Http\Controllers\Site\Exams\SingleExam::class)->name('exams');

Route::get('/advertises', \App\Http\Controllers\Site\Advertisement\IndexAdvertisement::class)->name('advertises');
Route::get('/advertise/{id}', \App\Http\Controllers\Site\Advertisement\SingleAdvertisement::class)->name('advertise');



Route::prefix('sale')->name('sale.')->middleware(['auth','role:sale','sale'])->group(function(){
    Route::get('/dashboard', \App\Http\Controllers\SalePerson\Dashboards\Dashboard::class)->name('dashboard');
    Route::get('/checkouts', App\Http\Controllers\SalePerson\Checkouts\IndexCheckout::class)->name('checkouts');
    Route::get('/checkouts/{action}/{id?}', App\Http\Controllers\SalePerson\Checkouts\StoreCheckout::class)->name('store.checkouts');
    Route::get('/bank-accounts', App\Http\Controllers\SalePerson\BankAccounts\IndexBankAccount::class)->name('bankAccounts');
    Route::get('/bank-accounts/{action}/{id?}', App\Http\Controllers\SalePerson\BankAccounts\StoreBankAccount::class)->name('store.bankAccounts');
});

Route::middleware(['guest'])->group(function (){
    Route::get('login-password',\App\Http\Controllers\Site\Auth\LoginPassword::class)->name('login-password');
   
});

Route::get('config',function(){
    Artisan::call('config:clear');
             Artisan::call('route:clear');

     })->name('config');

