<?php

use App\Http\Controllers\pages\expense;
use App\Http\Controllers\pages\homepage;
use App\Http\Controllers\pages\membership;
use Illuminate\Support\Facades\Route;

Route::get('/', [homepage::class, 'getIndex']);
Route::get('/pages', [homepage::class, 'getIndex']);
Route::get('/membership', [membership::class, 'getIndex']);
Route::get('/expense', [expense::class, 'getIndex']);

Route::prefix('pages')->controller(homepage::class)->group(function (): void {
    Route::get('/index', 'getIndex');
    Route::get('/lang/{lang?}', 'getLang');
    Route::get('/contacts', 'getContacts');
    Route::get('/privacy', 'getPrivacy');
    Route::get('/imgcaptcha', 'getImgcaptcha');
});

Route::prefix('membership')->controller(membership::class)->group(function (): void {
    Route::get('/index', 'getIndex');
    Route::get('/signup/{msg?}', 'getSignup');
    Route::post('/signup', 'postSignup');
    Route::get('/profile/{msg?}', 'getProfile');
    Route::get('/changepass/{msg?}', 'getChangepass');
    Route::post('/changepass', 'postChangepass');
    Route::get('/forgetpass/{msg?}', 'getForgetpass');
    Route::get('/login/{msg?}', 'getLogin');
    Route::post('/signin', 'postSignin');
    Route::get('/logout', 'getLogout');
    Route::get('/imgcaptcha', 'getImgcaptcha');
});

Route::prefix('expense')->controller(expense::class)->group(function (): void {
    Route::get('/index', 'getIndex');
    Route::get('/lang/{lang?}', 'getLang');
    Route::get('/budget', 'getBudget');
    Route::get('/report', 'getReport');
    Route::get('/transactions/{rec?}', 'getTransactions');
    Route::get('/edittransactions/{id}/{msg?}', 'getEdittransactions');
    Route::get('/categories/{name?}/{rec?}', 'getCategories');
    Route::get('/editcategories/{id}/{msg?}', 'getEditcategories');
    Route::get('/delcategory/{id}', 'getDelcategory');
    Route::post('/editcategories', 'postEditcategories');
    Route::post('/edittansactions', 'postEdittansactions');
    Route::get('/deltransactions/{id}', 'getDeltransactions');
});
