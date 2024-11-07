<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogersController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

                    // --- Блогер --- \\

//<<< Вызовы страниц >>>\\
// Вызов страницы отдельно взятого блогера по ID
Route::get( '/bloger/{id}',  [BlogersController::class, 'showBlogerProfile'])
                                                     ->name('BlogerProfile');
// Вызов страницы рейтинга блогеров
Route::get( '/blogers', [BlogersController::class, 'showBlogers'])
                                            ->name('Blogers');


//<<< Работа с БД >>>\\
// Создание записи о блогере в DB
Route::post('/blogerCreate', [BlogersController::class, 'blogerCreate'])
	                                             ->name('BlogerCreate');
// Создание записи подписчиках в определенный день
Route::post('/blogerAddSub', [BlogersController::class, 'addSubscribers'])
	                                             ->name('AddSubscribers');
// Редактирование данных блогера
Route::post('/blogerRedact', [BlogersController::class, 'redactBloger'])
                                                 ->name('RedactBloger');




                    // --- Админ --- \\

//<<< Вызовы страниц >>>\\
// Вызов страницы входа
Route::get( '/admin', [AdminController::class, 'showLoginPage'])
                                       ->name('AdminLogin');
// Вызов основной страницы админа
Route::get('/adminMain', [AdminController::class, 'showMainPage'])
                                          ->name('AdminMain');
// Вызов страницы редактирования блогеров
Route::post('/adminRedact', [AdminController::class, 'showRedactBlogerPage'])
	                                              ->name('RedactBlogerPage');



//<<< Авторизация >>>\\
// Авторизация админа
Route::post('/admin', [AdminController::class, 'authorization'])
	                               ->name('AdminAuthorization');



