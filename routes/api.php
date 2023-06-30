<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\FansController;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ReviewPhotoController;
use App\Http\Controllers\Api\WishListController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ExcelCSVController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix("cart")->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'addItem']);
        Route::delete('/remove/{id}', [CartController::class, 'removeItem']);
        Route::post('/soft-delete/{id}', [CartController::class, 'softDelete']);
        Route::put('/update-quantity', [CartController::class, 'updateQuantity']);
    });

    Route::prefix("wishlist")->group(function () {
        Route::get('/', [WishListController::class, 'index']);
        Route::post('/add', [WishListController::class, 'addToWishList']);
        Route::post('/store', [WishListController::class, 'storeWishList']);
        Route::delete('/remove/{id}', [WishListController::class, 'removeItemFromWishList']);
        Route::post('/move-to-cart', [WishListController::class, 'moveToCart']);
    });

    Route::prefix('comment')->group(function () {
        Route::post('/make', [CommentController::class, 'storeComment']);
        Route::delete('/delete', [CommentController::class, 'deleteComment']);
        Route::put('/edit', [CommentController::class, 'updateComment']);
    });
    Route::post('report/receive-report', [ReportController::class, 'receiveReport']);
    Route::post('/checkout', [CheckoutController::class, 'checkout']);
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failure', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});
Route::get('report/all-report', [ReportController::class, 'index']);
Route::delete('report/delete/{id}', [ReportController::class, 'deleteReport']);
Route::post('/comment/get-all', [CommentController::class, 'index']);
Route::get('/download/{id}', [ExcelCSVController::class, 'exportPDF']);
Route::prefix('excel')->group(function () {
    Route::get('/excel-csv-file', [ExcelCSVController::class, 'index']);
    Route::post('/import-excel-csv-file', [ExcelCSVController::class, 'importExcelCSV']);
    Route::get('/export-excel-csv-file/{slug}', [ExcelCSVController::class, 'exportExcelCSV']);
});

Route::apiResource('products', ProductsController::class);
Route::prefix("product")->group(function () {
    Route::post('/create', [AdminProductController::class, 'createProduct']);
    Route::post('/insert', [AdminProductController::class, 'importProductImage']);
    Route::put('/update/{id}', [AdminProductController::class, 'updateProduct']);
    Route::get('/delete/{id}', [AdminProductController::class, 'delete']);
    Route::get('/restore/{id}', [AdminProductController::class, 'restore']);
    Route::get('/force-delete/{id}', [AdminProductController::class, 'forceDelete']);
    Route::get('/trash', [AdminProductController::class, 'trash']);
    Route::get('/storage-delete/{id}', [AdminProductController::class, 'deleteStorage']);
});
Route::prefix('article')->group(function () {
    Route::get('/article', [ArticleController::class, 'index']);
    Route::post('/store', [ArticleController::class, 'storeArticle']);
    Route::get('/ceiling', [ArticleController::class, 'articleCeilingFan']);
    Route::get('/table', [ArticleController::class, 'articleTableFan']);
    Route::get('/floor', [ArticleController::class, 'articleFloorFan']);
});
Route::get('/all-review-photos/{id}', [ReviewPhotoController::class, 'getAllPhotos']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password/{token}', [NewPasswordController::class, 'store']);
Route::get('/all-users', [AdminProductController::class, 'getAllUser']);

Route::prefix('fans')->group(function () {
    Route::get('/feature/{id}', [AdminProductController::class, 'featureProduct']);
    Route::get('/all', [FansController::class, 'allFans']);
    Route::get('/allList', [FansController::class, 'getAllFans']);
    Route::get('/searching', [FansController::class, 'getResultBySearch']);
    Route::post('/searching-specific-type', [FansController::class, 'getResultSearchBySpecificType']);
    Route::get('/detail/{id}', [FansController::class, 'getDetailById']);
    Route::get('/by-brand', [FansController::class, 'getFansByBrand']);
    Route::get('/by-type', [FansController::class, 'getSameFansByType']);
    Route::get('/recommend', [FansController::class, 'recommendForYou']);
    Route::get('/ceiling', [FansController::class, 'getCeilingFan']);
    Route::get('/floor', [FansController::class, 'getFloorFan']);
    Route::get('/box', [FansController::class, 'getBoxFan']);
    Route::get('/steam', [FansController::class, 'getSteamFan']);
    Route::get('/solar', [FansController::class, 'getSolarFan']);
    Route::get('/tower', [FansController::class, 'getTowerFan']);
    Route::get('/industry', [FansController::class, 'getIndustryFan']);
    Route::get('/table', [FansController::class, 'getTableFan']);
    Route::get('/island', [FansController::class, 'getIslandFan']);
    Route::get('/battery', [FansController::class, 'getBatteryChargeFan']);
    Route::get('/wall', [FansController::class, 'getWallFan']);
    Route::get('/brand', [FansController::class, 'getFansByBrand']);
    Route::get('/conditioner-fan', [FansController::class, 'getConditionerFan']);
    Route::get('/air-cooler', [FansController::class, 'getAirCooler']);
    Route::get('/air-conditioner', [FansController::class, 'getAirConditioner']);
    Route::get('/air-curtain', [FansController::class, 'getAirCurtain']);
    Route::get('/ventilator', [FansController::class, 'getVentilator']);
});







