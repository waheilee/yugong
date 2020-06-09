<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    //题库管理
    $router->resource('question', 'QuestionController');
    //视频课件管理
    $router->resource('video', 'VideoController');
    //分类管理
    $router->resource('exam_category', 'CategoryController');
    //保单管理
    $router->resource('policy', 'PolicyController');
    //课程管理
    $router->resource('lesson','LessonController');
    //章节管理
    $router->resource('section','SectionController');
    //考场管理
    $router->resource('exam_room','ExamRoomController');
});
