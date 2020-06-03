<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    /**
     * 题库管理
     */
    $router->resource('question', 'QuestionController');

    $router->resource('video', 'VideoController');

    $router->resource('exam_category', 'CategoryController');

    $router->resource('policy', 'PolicyController');

    $router->resource('lesson','LessonController');
    $router->resource('lesson/{id}/create','VideoController');
});
