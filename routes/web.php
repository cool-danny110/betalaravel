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
Route::post('/campaign/usetemplate', [CampaignController::class, 'usetemplate'])->name('campaign.usetemplate');
Route::post('campaign/delete', [CampaignController::class, 'delete'])->name('campaign.delete');
Route::post('campaign/duplicate', [CampaignController::class, 'duplicate'])->name('campaign.duplicate');
Route::post('campaign/sendtest', [CampaignController::class, 'sendtest'])->name('campaign.sendtest');
Route::post('campaign/sendcampaign', [CampaignController::class, 'sendcampaign'])->name('campaign.sendcampaign');


Route::get('/report', [ReportController::class, 'index']);
Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
Route::post('/template/select', [TemplateController::class, 'select'])->name('template.select');
Route::post('/template/remove', [TemplateController::class, 'remove'])->name('template.remove');
Route::post('/template/uploadAsset', [TemplateController::class, 'uploadAsset'])->name('template.uploadAsset');
Route::post('/template/savethumbnail', [TemplateController::class, 'savethumbnail'])->name('template.savethumbnail');
Route::post('/template/testEmailSending', [TemplateController::class, 'testEmailSending'])->name('template.testEmailSending');
Route::post('/template/storeTemplateDB', [TemplateController::class, 'storeTemplateDB'])->name('template.storeTemplateDB');

Route::get('/design', [TemplateController::class, 'design']);
Route::post('/design/save', [TemplateController::class, 'save']);
Route::get('/design/save_name', [TemplateController::class, 'save_name'])->name('design.save_name');

Route::get('/form', [FormController::class, 'index'])->name('form.index');
Route::get('/form/create', [FormController::class, 'create'])->name('form.create');
Route::post('/form/save', [FormController::class, 'save'])->name('form.save');
Route::get('/form/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
Route::post('/form/update', [FormController::class, 'update'])->name('form.update');

// Form submit api for create forms by customers.
Route::post('/form/submit', [FormController::class, 'submit'])->name('form.submit');

Route::post('/form/delete', [FormController::class, 'delete'])->name('form.delete');

Route::get('/group', [ContactController::class, 'groupindex'])->name('group.index');
Route::get('/group/create', [ContactController::class, 'groupcreate'])->name('group.create');
Route::post('/group/store', [ContactController::class, 'groupstore'])->name('group.store');
Route::get('/group/edit/{id}', [ContactController::class, 'groupedit'])->name('group.edit');
Route::post('/group/update', [ContactController::class, 'groupupdate'])->name('group.update');
Route::post('/group/delete', [ContactController::class, 'groupdelete'])->name('group.delete');

Route::get('/contact/{groupId}', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contact/{groupId}/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/contact/update', [ContactController::class, 'update'])->name('contact.update');
Route::post('contact/delete', [ContactController::class, 'delete'])->name('contact.delete');
Route::post('contact/deleteSelected', [ContactController::class, 'deleteSelected'])->name('contact.deleteSelected');


Route::get('/contact/{groupId}/import', [ContactController::class, 'import'])->name('contact.import');
Route::post('/contact/{groupId}/fileimport', [ContactController::class, 'fileimport'])->name('contact.fileimport');
Route::post('/contact/{groupId}/upload', [ContactController::class, 'upload'])->name('contact.upload');

Route::get('/setting', [SettingController::class, 'index']);
Route::get('/setting/default', [SettingController::class, 'default']);
Route::post('/setting/default/save', [SettingController::class, 'default_save'])->name('default.save');
