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

Route::get('/email/verify', function () {
	return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();

	return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
	$request->user()->sendEmailVerificationNotification();

	return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [indexController::class, 'index'])->name('home')->middleware('verified');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::get('/admin/login', [loginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [loginController::class, 'login']);

Route::post('/admin/login', [loginController::class, 'login']);

Route::get('/admin/users', [userController::class, 'index'])->name('admin.users')->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/users/add', [userController::class, 'add'])->name('admin.users.add')->middleware(['auth', 'ifnotadmin']);
Route::post('/admin/users/add', [userController::class, 'store'])->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/users/delete/{id}', [userController::class, 'delete'])->name('admin.user.delete')->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/users/edit/{id}', [userController::class, 'edit'])->name('admin.user.edit')->middleware(['auth', 'ifnotadmin']);
Route::patch('/admin/users/update/{id}', [userController::class, 'update'])->name('admin.users.update')->middleware(['auth', 'ifnotadmin']);

Route::get('/admin/tournament', [tournamentController::class, 'index'])->name('admin.tournament')->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/tournament/add', [tournamentController::class, 'add'])->name('admin.tournament.add')->middleware(['auth', 'ifnotadmin']);
Route::post('/admin/tournament/add', [tournamentController::class, 'store'])->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/tournament/edit/{id}', [tournamentController::class, 'edit'])->name('admin.tournament.edit')->middleware(['auth', 'ifnotadmin']);
Route::patch('/admin/tournament/update/{id}', [tournamentController::class, 'update'])->name('admin.tournament.update')->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/tournament/delete/{id}', [tournamentController::class, 'delete'])->name('admin.tournament.delete')->middleware(['auth', 'ifnotadmin']);

Route::get('admin/scoreboard', [scoreboardController::class, 'index'])->name('admin.scoreboard')->middleware(['auth', 'ifnotadmin']);
Route::get('admin/scoreboard/add', [scoreboardController::class, 'add'])->name('admin.scoreboard.add')->middleware(['auth', 'ifnotadmin']);
Route::get('admin/scoreboard/edit/{id}', [scoreboardController::class, 'edit'])->name('admin.scoreboard.edit')->middleware(['auth', 'ifnotadmin']);
Route::post('admin/scoreboard/add', [scoreboardController::class, 'store'])->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/scoreboard/edit/{id}', [scoreboardController::class, 'edit'])->name('admin.scoreboard.edit')->middleware(['auth', 'ifnotadmin']);
Route::patch('/admin/scoreboard/update/{id}', [scoreboardController::class, 'update'])->name('admin.scoreboard.update')->middleware(['auth', 'ifnotadmin']);
Route::get('/admin/scoreboard/delete/{id}', [scoreboardController::class, 'delete'])->name('admin.scoreboard.delete')->middleware(['auth', 'ifnotadmin']);
Route::get('admin/report', [ReportController::class, 'report'])->name('report')->middleware(['auth', 'ifnotadmin']);
Route::get('admin/sales', [SalesController::class, 'sales'])->name('admin.sales')->middleware(['auth', 'ifnotadmin']);
Route::get('admin/products', [ProductController::class, 'get_products'])->name('admin.products')->middleware(['auth', 'ifnotadmin']);
Route::get('admin/products/verify/{id}', [ProductController::class, 'verify'])->name('admin.products.verify')->middleware(['auth', 'ifnotadmin']);

// users routes

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile', [AuthController::class, 'updateprofile'])->middleware('auth');
Route::post('/profile/avatar', [AuthController::class, 'updateavatar'])->name('change.avatar')->middleware('auth');

Route::post('/addpost', [indexController::class, 'addpost'])->name('addpost')->middleware('auth');
Route::post('/add-post-comment', [indexController::class, 'addPostcomment'])->name('addPostComment')->middleware('auth');
Route::get('post/{id}', [indexController::class, 'postComments'])->name('postComment');

Route::post('/add-post-like', [indexController::class, 'addPostlike'])->name('addPostLike')->middleware('auth');
Route::post('/add-group-post-like', [indexController::class, 'addgroupPostlike'])->name('addGroupPostLike')->middleware('auth');

Route::get('/dashboard', [indexController::class, 'dashboard'])->name('dashboard')->middleware(['auth', 'ifnotadmin']);

Route::get('/groups', [indexController::class, 'groups'])->name('groups')->middleware('auth');
Route::post('/groups', [indexController::class, 'createGroup'])->middleware('auth');

Route::get('/join-group/{id}', [indexController::class, 'joingroup'])->name('joingroup')->middleware('auth');
Route::get('/verify-group/{id}', [indexController::class, 'verifygroup'])->name('verifygroup')->middleware('auth');
Route::get('/view-group/{id}', [indexController::class, 'viewgroup'])->name('viewgroup')->middleware('auth');
Route::post('/add-group-post', [indexController::class, 'addgrouppost'])->name('addgrouppost')->middleware('auth');
Route::post('/add-group-comment', [indexController::class, 'addgroupcomment'])->name('addgroupcomment')->middleware('auth');

Route::get('/group/{id}/comment/', [indexController::class, 'groupcomment'])->name('groupcomment')->middleware('auth');
Route::get('/market/', [indexController::class, 'market'])->name('market');
Route::get('/market/add-product', [indexController::class, 'add_product'])->name('market.add_product')->middleware('auth');
Route::post('/market/add-product', [indexController::class, 'store_product'])->middleware('auth');
Route::get('/market/sold-products', [indexController::class, 'sold_products'])->name('market.sold_product')->middleware('auth');
Route::get('/market/bought-products', [indexController::class, 'bought_products'])->name('market.bought_product')->middleware('auth');
Route::get('/market/my-products', [indexController::class, 'my_products'])->name('market.my_product')->middleware('auth');

Route::get('/market/checkout/{id}', [indexController::class, 'checkout'])->name('market.checkout')->middleware('auth');
Route::post('/market/checkout/store', [indexController::class, 'checkout_info'])->name('market.checkout.store')->middleware('auth');

Route::get('/tournaments', [indexController::class, 'tournaments'])->name('tournaments');
Route::get('/tournaments/view/{id}', [indexController::class, 'view_tournament'])->name('view_tournament')->middleware('auth');
Route::get('/tournaments/join/{id}', [indexController::class, 'join_tournament'])->name('join_tournament')->middleware('auth');
Route::post('/tournaments/join_now', [indexController::class, 'join_tournament_now'])->name('join_tournament_now');
Route::get('/clients/logout', [indexController::class, 'logout'])->name('client.logout')->middleware('auth');
Route::get('/map', [indexController::class, 'map'])->name('map');
Route::get('/like', [indexController::class, 'likes'])->name('like')->middleware('auth');
Route::get('/rate', [indexController::class, 'rate'])->name('rate')->middleware('auth');
Route::get('/messages', [indexController::class, 'messages'])->name('messages')->middleware('auth');
Route::get('/messages/send/{id}', [indexController::class, 'sendMessage'])->name('sendMessage')->middleware('auth');
Route::post('/messages/store', [indexController::class, 'storeMessage'])->name('storeMessage')->middleware('auth');
Route::get('/messages/user/{id}', [indexController::class, 'getMessages'])->name('getmessages')->middleware('auth');
Route::post('/messages/store2', [indexController::class, 'storeMessage2'])->name('storeMessage2')->middleware('auth');
