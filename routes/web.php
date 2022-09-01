<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WPAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SettingController;

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

Route::get('/login', [WPAuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/create', [CampaignController::class, 'create']);
Route::post('/campaign/store', [CampaignController::class, 'store'])->name('campaign.store');
Route::get('/campaign/edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
Route::post('/campaign/update', [CampaignController::class, 'update'])->name('campaign.update');
Route::post('campaign/delete', [CampaignController::class, 'delete'])->name('campaign.delete');

Route::get('/report', [ReportController::class, 'index']);
Route::get('/template', [TemplateController::class, 'index']);
Route::get('/template/select', [TemplateController::class, 'select'])->name('template.select');
Route::post('/template/remove', [TemplateController::class, 'remove'])->name('template.remove');
Route::post('/template/uploadAsset', [TemplateController::class, 'uploadAsset'])->name('template.uploadAsset');

Route::get('/design', [TemplateController::class, 'design']);
Route::post('/design/save', [TemplateController::class, 'save']);

Route::get('/form', [FormController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contact/create', [ContactController::class, 'create']);
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/contact/update', [ContactController::class, 'update'])->name('contact.update');
Route::post('contact/delete', [ContactController::class, 'delete'])->name('contact.delete');

Route::get('/contact/import', [ContactController::class, 'import'])->name('contact.import');
Route::post('/contact/fileimport', [ContactController::class, 'fileimport'])->name('contact.fileimport');
Route::post('/contact/upload', [ContactController::class, 'upload'])->name('contact.upload');

Route::get('/setting', [SettingController::class, 'index']);
Route::get('/setting/default', [SettingController::class, 'default']);
Route::post('/setting/default/save', [SettingController::class, 'default_save'])->name('default.save');
