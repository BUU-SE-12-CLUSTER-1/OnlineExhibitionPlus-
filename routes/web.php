<?php

use App\Http\Controllers\MajorController;
use Illuminate\Support\Facades\Route;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Models\MajorModel;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Models\RoleModel;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MyAuth;
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

Route::get('/', function (){
    return view('home');
});

Route::get('/home', function (){
    return view('home');
});

Route::get('/h', function(){
    return view('layouts.layout');
});

Route::get('/test', function(){
    return view('success');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('/login',[MyAuth::class, 'login_process']);
Route::get('/insert-user',[UserController::class, 'insertUserPage']);
Route::post('/insert-user',[UserController::class, 'insertUser']);
Route::get('/user-list',[UserController::class, 'showUserList']);
Route::get('/delete-user/{user_id}',[UserController::class, 'deleteUser']);
Route::get('/edit-user/{user_id}',[UserController::class, 'editUser']);
Route::post('/edit-user',[UserController::class, 'updateUser']);
Route::post('/search-user',[UserController::class, 'searchUser']);
Route::get('/search-user',[UserController::class, 'searchUser']);
Route::get('/import-excel',[UserController::class, 'importExcel']);
Route::post('/import-excel',[UserController::class, 'saveImportedExcel']);
Route::get('/user-profile/{user_id}',[UserController::class, 'ShowUserProfile']);
Route::get('get-user-image{user_id}',[UserModel::class, 'getUserImage']);
Route::post('update-user-detail/{user_id}/{detail_name}',[UserController::class,'updateUserDetail']);
Route::post('update-user-detail/{user_id}',[UserController::class,'updateUserDetail']);
Route::get('upload-user-image/{user_id}',[UserController::class,'uploadImage']);
Route::post('upload-user-image/{user_id}',[UserController::class,'uploadImageProcess']);
Route::get('/toggle-user/{user_id}',[UserController::class, 'toggleVisible']);
Route::post('change-password/{user_id}',[UserController::class, 'changePassword']);

Route::get('/insert-advisor' , function(){
    return view('insert_advisor');
});
Route::post('/insert-advisor', [AdvisorController::class, 'insertAdvisor']);

Route::get('/insert-tag', function(){
    return view('insert_tag');
});
Route::post('/insert-tag', [TagController::class, 'insertTag']);

Route::get('/insert-major', function(){
    return view('insert_major');
});

Route::get('/advanced-search-project' , function(){
    return view('advanced_search_project');
});

Route::post('/insert-major',[MajorController::class, 'insertMajor']);
Route::get('/major-list',[MajorController::class, 'showMajorList']);

Route::get('/insert-company', function(){
    return view('insert_company');
});

Route::post('/insert-company',[CompanyController::class, 'insertCompany']);
Route::post('/company-dropdown-list',[CompanyController::class, 'showCompanyDropdownList']);
Route::get('/insert-project',[ProjectController::class, 'insertProject']);

Route::get('/advisor-list',[AdvisorController::class, 'showAdvisorList']);
Route::get('/delete-advisor/{advisor_id}',[AdvisorController::class, 'deleteAdvisor']);
Route::get('/edit-advisor/{advisor_id}',[AdvisorController::class, 'editAdvisor']);

Route::post('update-advisor/{advisor_id}',[AdvisorController::class, 'updateAdvisor']);

Route::get('/company-list',[CompanyController::class, 'showCompanyList']);
Route::get('/delete-company/{company_id}',[CompanyController::class, 'deleteCompany']);
Route::get('/edit-company/{company_id}',[CompanyController::class, 'editCompany']);

Route::post('update-company/{companyr_id}',[CompanyController::class, 'updateCompany']);

Route::get('/homePage', function (){
    return view('home');
});
Route::get('/403forbidden', function (){
    return view('forbidden');
});
Route::get('/detail', function(){
    return view('detail_main');
});
Route::get('/select-template1', function(){
    return view('template1');
});

Route::get('/tag-list',[TagController::class, 'showTagList']);
Route::get('/delete-tag/{tag_id}',[TagController::class, 'deleteTag']);
Route::get('/edit-tag/{tag_id}',[TagController::class, 'editTag']);
Route::post('update-tag/{tag_id}',[TagController::class, 'updateTag']);

Route::get('/project-list',[ProjectController::class, 'showProjectList']);
Route::get('/delete-project/{proj_id}',[ProjectController::class, 'deleteProject']);
Route::get('/toggle-project/{proj_id}',[ProjectController::class, 'toggleVisible']);
Route::get('/toggle-liked/{proj_id}/{user_id}',[ProjectController::class, 'toggleLikedProject']);
Route::get('/edit-project/{proj_id}',[ProjectController::class, 'editProject']);
Route::post('update-project/{proj_id}',[ProjectController::class, 'updateProject']);
Route::get('/fav-project',[ProjectController::class, 'favProjectList']);
Route::get('/tag-search/{tag_id}',[ProjectController::class, 'tagSearch']);
Route::get('/project-detail/{proj_id}',[ProjectController::class, 'projectDetail']);

Route::get('/select-template2', function(){
    return view('template2');
});
Route::get('/search-project',[ProjectController::class,'searchProject'])->name('projects.search');




Route::get('/input-template1', function(){
    return view('template1_form');
});

Route::get('/template3_form', function (){
    return view('template3_form');
});

Route::get('/template4_form', function (){
    return view('template4_form');
});

Route::get('/login', function(){
    return view('login');
});


Route::get('/ImageSlide', function (){
    return view('proj_image_slider');
});
Route::get('/tag-list',[TagController::class, 'showTagList']);

Route::get('/template1_show', function (){
    return view('template1_show');
});

Route::get('/template2_show', function (){
    return view('template2_show');
});

Route::get('/template3_show', function (){
    return view('template3_show');
});

Route::get('/template4_show', function (){
    return view('template4_show');
});



// คลิกรูปโปรเจคแล้วเปลี่ยนหน้า
Route::get('/testPJ01', function (){
    return view('test_pj01');
});

Route::get('/testPJ02', function (){
    return view('test_pj02');
});
Route::get('/testPJ03', function (){
    return view('test_pj03');
});
Route::get('/testPJ04', function (){
    return view('test_pj04');
});


// คลิก TAG แล้วเปลี่ยนหน้า
Route::get('/testTag01', function (){
    return view('test_tag01');
});
Route::get('/testTag02', function (){
    return view('test_tag02');
});

Route::get('/testmas', function (){
    return view('testmas');
});

Route::post('/insert-comment/{proj_id}/{user_id}',[CommentController::class, 'insertComment']);
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/cluster1/livewire/update', $handle);
});
