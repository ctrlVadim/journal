<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

// Student
Route::group(['as' => 'student.', 'controller' => StudentController::class], function(){
    Route::post('/student', 'show')->name('show');
    Route::get('/student/item/{id}', 'item')->name('item');
    Route::get('/student/view', 'view')->name('view');
    Route::post('/student/create', 'store')->name('store');
    Route::post('/student/{id}/update', 'update')->name('update');
    Route::post('/student/{id}/delete', 'delete')->name('delete');
});

// Speciality
Route::group(['as' => 'speciality.', 'controller' => SpecialityController::class], function(){
    Route::post('/speciality', 'show')->name('show');
    Route::get('/speciality/item/{id}', 'item')->name('item');
    Route::get('/speciality/view', 'view')->name('view');
    Route::post('/speciality/create', 'store')->name('store');
    Route::post('/speciality/{id}/update', 'update')->name('update');
    Route::post('/speciality/{id}/delete', 'delete')->name('delete');
});

// Grade
Route::group(['as' => 'grade.', 'controller' => GradeController::class], function(){
    Route::post('/grade', 'show')->name('show');
    Route::get('/grade/item/{id}', 'item')->name('item');
    Route::get('/grade/view', 'view')->name('view');
    Route::post('/grade/create', 'store')->name('store');
    Route::post('/grade/{id}/update', 'update')->name('update');
    Route::post('/grade/{id}/delete', 'delete')->name('delete');
});

// Subhect
Route::group(['as' => 'subject.', 'controller' => SubjectController::class], function(){
    Route::post('/subject', 'show')->name('show');
    Route::get('/subject/item/{id}', 'item')->name('item');
    Route::get('/subject/view', 'view')->name('view');
    Route::post('/subject/create', 'store')->name('store');
    Route::post('/subject/{id}/update', 'update')->name('update');
    Route::post('/subject/{id}/delete', 'delete')->name('delete');
});
