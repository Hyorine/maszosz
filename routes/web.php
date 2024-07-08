<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[App\Http\Controllers\baseController::class,'index'])->name('/');


Route::get('login',[App\Http\Controllers\LoginController::class,'index'])->name('login')->middleware('checkNotLoggedIn');
Route::post('login',[App\Http\Controllers\LoginController::class,'show'])->middleware('checkNotLoggedIn');

Route::get('logout',[App\Http\Controllers\LoginController::class,'logout'])->name('logout');

Route::get('registration',[App\Http\Controllers\RegistrationController::class,'index'])->name('registration')->middleware('checkNotLoggedIn');
Route::post('registration',[App\Http\Controllers\RegistrationController::class,'show'])->middleware('checkNotLoggedIn');

Route::get('confirm-registration/{token}', [App\Http\Controllers\RegistrationController::class,'confirmRegistration'])->name('confirm.registration');

Route::get('admin',[App\Http\Controllers\AdminController::class,'index'])->name('admin')->middleware('checkLoggedIn','Admin');
Route::post('admin',[App\Http\Controllers\AdminController::class,'change'])->name('adminChange')->middleware('checkLoggedIn','Admin');

Route::post('/upload', [App\Http\Controllers\ImageController::class, 'upload'])->name('image.upload.post')->middleware('checkLoggedIn','Admin');
Route::post('/delete-image', [App\Http\Controllers\ImageController::class, 'delet'])->name('delete.image')->middleware('checkLoggedIn','Admin');

Route::get('view-gallery', [App\Http\Controllers\GalleryController::class, 'showGallery'])->name('galleryShow');

Route::post('monster', [App\Http\Controllers\MonsterController::class, 'saveMonster'])->name('save.monster')->middleware('checkLoggedIn','Admin');
Route::post('monsterDelet', [App\Http\Controllers\MonsterController::class, 'deleteMonster'])->name('deletMonster')->middleware('checkLoggedIn','Admin');

Route::get('monster_encyclopedia', [App\Http\Controllers\EncyclopediaController::class, 'showMonsters'])->name('encyclopedia.showMonsters')->middleware('checkLoggedIn');
Route::post('monster_encyclopedia', [App\Http\Controllers\EncyclopediaController::class, 'RefreshMonsters'])->middleware('checkLoggedIn');

Route::post('/save-news', [App\Http\Controllers\NewsController::class, 'save'])->name('save.news');

Route::get('events', [App\Http\Controllers\EventController::class, 'showEvent'])->name('eventsShow')->middleware('checkLoggedIn');
Route::post('event-Edit', [App\Http\Controllers\EventController::class, 'EditEvent'])->name('eventEdit')->middleware('checkLoggedIn','Admin');
Route::post('event-Delet', [App\Http\Controllers\EventController::class, 'deletEvent'])->name('eventDelet')->middleware('checkLoggedIn','Admin');

Route::get('Contacts', [App\Http\Controllers\ContactController::class, 'show'])->name('contacts');

Route::get('forum', [App\Http\Controllers\ForumController::class, 'showall'])->name('forum')->middleware('checkLoggedIn');
Route::post('forum', [App\Http\Controllers\ForumController::class, 'hendler'])->name('forumPost')->middleware('checkLoggedIn');

Route::get('/forumPost/{postId}/{createdAt}/{uniqueIdentifier}', [App\Http\Controllers\ForumPostController::class, 'show'])->name('postPage')->middleware('checkLoggedIn');
Route::post('/forumPost', [App\Http\Controllers\ForumPostController::class, 'postOperation'])->name('addMessage')->middleware('checkLoggedIn');

Route::get('profil', [App\Http\Controllers\ProfileController::class, 'show'])->name('profil')->middleware('checkLoggedIn');
Route::post('profil', [App\Http\Controllers\ProfileController::class, 'helper'])->name('profilPOST')->middleware('checkLoggedIn');

Route::get('profil/notification', [App\Http\Controllers\ProfileController::class, 'notification'])->name('profilNotification')->middleware('checkLoggedIn');
Route::post('profil/notification', [App\Http\Controllers\ProfileController::class, 'notification'])->name('profilNotification')->middleware('checkLoggedIn');