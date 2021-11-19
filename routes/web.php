<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\scoreboardController;
use App\Http\Controllers\tournamentController;

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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
	Route::get('/email/verify', function () {
		return view('auth.verify-email');
	})->name('verification.notice');
	
	Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
		$request->fulfill();
	
		return redirect()->route('home');
	})->middleware('signed')->name('verification.verify');
	
	Route::post('/email/verification-notification', function (Request $request) {
		$request->user()->sendEmailVerificationNotification();
	
		return back()->with('message', 'Verification link sent!');
	})->middleware('throttle:6,1')->name('verification.send');
});

Route::get('/', [indexController::class, 'index'])->name('home')->middleware('verified');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::get('/admin/login', [loginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [loginController::class, 'login']);

// admin routes
Route::group(['middleware' => ['auth', 'ifnotadmin']], function () {
	Route::get('/admin/users', [userController::class, 'index'])->name('admin.users');
	Route::get('/admin/users/add', [userController::class, 'add'])->name('admin.users.add');
	Route::post('/admin/users/add', [userController::class, 'store']);
	Route::get('/admin/users/delete/{id}', [userController::class, 'delete'])->name('admin.user.delete');
	Route::get('/admin/users/edit/{id}', [userController::class, 'edit'])->name('admin.user.edit');
	Route::patch('/admin/users/update/{id}', [userController::class, 'update'])->name('admin.users.update');
	
	Route::get('/admin/tournament', [tournamentController::class, 'index'])->name('admin.tournament');
	Route::get('/admin/tournament/add', [tournamentController::class, 'add'])->name('admin.tournament.add');
	Route::post('/admin/tournament/add', [tournamentController::class, 'store']);
	Route::get('/admin/tournament/edit/{id}', [tournamentController::class, 'edit'])->name('admin.tournament.edit');
	Route::patch('/admin/tournament/update/{id}', [tournamentController::class, 'update'])->name('admin.tournament.update');
	Route::get('/admin/tournament/delete/{id}', [tournamentController::class, 'delete'])->name('admin.tournament.delete');
	
	Route::get('admin/scoreboard', [scoreboardController::class, 'index'])->name('admin.scoreboard');
	Route::get('admin/scoreboard/add', [scoreboardController::class, 'add'])->name('admin.scoreboard.add');
	Route::get('admin/scoreboard/edit/{id}', [scoreboardController::class, 'edit'])->name('admin.scoreboard.edit');
	Route::post('admin/scoreboard/add', [scoreboardController::class, 'store']);
	Route::get('/admin/scoreboard/edit/{id}', [scoreboardController::class, 'edit'])->name('admin.scoreboard.edit');
	Route::patch('/admin/scoreboard/update/{id}', [scoreboardController::class, 'update'])->name('admin.scoreboard.update');
	Route::get('/admin/scoreboard/delete/{id}', [scoreboardController::class, 'delete'])->name('admin.scoreboard.delete');
	Route::get('admin/report', [ReportController::class, 'report'])->name('report');
	Route::get('admin/sales', [SalesController::class, 'sales'])->name('admin.sales');
	Route::get('admin/products', [ProductController::class, 'get_products'])->name('admin.products');
	Route::get('admin/products/verify/{id}', [ProductController::class, 'verify'])->name('admin.products.verify');
});

// users routes
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('post/{id}', [indexController::class, 'postComments'])->name('postComment');
Route::get('/tournaments', [indexController::class, 'tournaments'])->name('tournaments');
Route::get('/market/', [indexController::class, 'market'])->name('market');
Route::get('/map', [indexController::class, 'map'])->name('map');
Route::post('/tournaments/join_now', [indexController::class, 'join_tournament_now'])->name('join_tournament_now');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
	Route::post('/profile', [AuthController::class, 'updateprofile']);
	Route::post('/profile/avatar', [AuthController::class, 'updateavatar'])->name('change.avatar');

	Route::post('/addpost', [indexController::class, 'addpost'])->name('addpost');
	Route::post('/add-post-comment', [indexController::class, 'addPostcomment'])->name('addPostComment');
	
	Route::post('/add-post-like', [indexController::class, 'addPostlike'])->name('addPostLike');
	Route::post('/add-group-post-like', [indexController::class, 'addgroupPostlike'])->name('addGroupPostLike');

	Route::get('/dashboard', [indexController::class, 'dashboard'])->name('dashboard')->middleware('ifnotadmin');

	Route::get('/groups', [indexController::class, 'groups'])->name('groups');
	Route::post('/groups', [indexController::class, 'createGroup']);

	Route::get('/join-group/{id}', [indexController::class, 'joingroup'])->name('joingroup');
	Route::get('/verify-group/{id}', [indexController::class, 'verifygroup'])->name('verifygroup');
	Route::get('/view-group/{id}', [indexController::class, 'viewgroup'])->name('viewgroup');
	Route::post('/add-group-post', [indexController::class, 'addgrouppost'])->name('addgrouppost');
	Route::post('/add-group-comment', [indexController::class, 'addgroupcomment'])->name('addgroupcomment');

	Route::get('/group/{id}/comment/', [indexController::class, 'groupcomment'])->name('groupcomment');
	Route::get('/market/add-product', [indexController::class, 'add_product'])->name('market.add_product');
	Route::post('/market/add-product', [indexController::class, 'store_product']);
	Route::get('/market/sold-products', [indexController::class, 'sold_products'])->name('market.sold_product');
	Route::get('/market/bought-products', [indexController::class, 'bought_products'])->name('market.bought_product');
	Route::get('/market/my-products', [indexController::class, 'my_products'])->name('market.my_product');
	
	Route::get('/market/checkout/{id}', [indexController::class, 'checkout'])->name('market.checkout');
	Route::post('/market/checkout/store', [indexController::class, 'checkout_info'])->name('market.checkout.store');
	
	Route::get('/tournaments/view/{id}', [indexController::class, 'view_tournament'])->name('view_tournament');
	Route::get('/tournaments/join/{id}', [indexController::class, 'join_tournament'])->name('join_tournament');
	
	Route::get('/clients/logout', [indexController::class, 'logout'])->name('client.logout');
	Route::get('/like', [indexController::class, 'likes'])->name('like');
	Route::get('/rate', [indexController::class, 'rate'])->name('rate');
	Route::get('/messages', [indexController::class, 'messages'])->name('messages');
	Route::get('/messages/send/{id}', [indexController::class, 'sendMessage'])->name('sendMessage');
	Route::post('/messages/store', [indexController::class, 'storeMessage'])->name('storeMessage');
	Route::get('/messages/user/{id}', [indexController::class, 'getMessages'])->name('getmessages');
	Route::post('/messages/store2', [indexController::class, 'storeMessage2'])->name('storeMessage2');
});
