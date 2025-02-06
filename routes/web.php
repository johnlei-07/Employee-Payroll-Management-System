<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Contracts\View\View;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function (){
    //admin page
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin/dashboard');
    //employee table
    Route::get('admin/employees',[RegisteredUserController::class, 'index'])->name('auth.admin.employees');
    //create employee
    Route::get('admin/register', [RegisteredUserController::class, 'create'])->name('auth.register'); // To show the registration form
    //to save the created employee
    Route::post('admin/register', [RegisteredUserController::class, 'store'])->name('auth.register'); // To handle form submission
    //to view all
    Route::get('admin/view/{id}',[ViewController::class, 'view'])->name('auth.admin.view');
     //to edit
    Route::get('admin/update/{id}',[RegisteredUserController::class, 'edit'])->name('auth.admin.edit');
     //to update
     Route::put('admin/update/{id}', [RegisteredUserController::class, 'update'])->name('auth.admin.update');
     //to delete
     Route::delete('admin/delete/{id}', [RegisteredUserController::class, 'delete'])->name('auth.admin.delete');
     //account table

     //admin table 
     Route::get('admin/admins',[AdminController::class, 'index'])->name('auth.admin.admins');
     //create admin
     Route::get('admin/create_admin',[AdminController::class, 'create'])->name('auth.admin.create_admin');

    //to save the created admin
     Route::post('admin/create_admin',[AdminController::class, 'store'])->name('auth.admin.create_admin');
    //delete admin account
    Route::delete('admin/delete/{id}', [AdminController::class, 'delete'])->name('auth.admin.delete');
    //update admin  account
    Route::put('admin/update_admin/{id}', [AdminController::class, 'update'])->name('auth.admin.update_admin');

    //to edit
    Route::get('admin/update_admin/{id}', [AdminController::class, 'edit'])->name('auth.admin.edit');

    

});

require __DIR__.'/auth.php';
