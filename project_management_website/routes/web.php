<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\FunctionsController;


Route::get('/', [HomeController::class, 'home_get'])->name('home');
Route::get('/login', [HomeController::class, 'login_get'])->name('login');
Route::get('/register', [HomeController::class, 'register_get'])->name('register');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/account', [HomeController::class, 'account_get'])->name('account');
Route::get('/account/project/{id}', [HomeController::class, 'project_open'])->name('project.open');

Route::post('/ajax/login', [FunctionsController::class, 'ajax_login'])->name('ajax.login');
Route::post('/ajax/register', [FunctionsController::class, 'ajax_register'])->name('ajax.register');
Route::post('/ajax/logout', [FunctionsController::class, 'ajax_logout'])->name('ajax.logout');

Route::post('/ajax/invite/user', [FunctionsController::class, 'ajax_invite_user'])->name('ajax.invite.user');
Route::post('/ajax/remove/team/member', [FunctionsController::class, 'ajax_remove_team_member'])->name('ajax.remove.team.member');
Route::post('/ajax/select/members/for/project/cb', [FunctionsController::class, 'ajax_select_members_for_project_cb'])->name('ajax.select.members.for.project.cb');
Route::post('/ajax/save/members/for/project', [FunctionsController::class, 'ajax_save_members_for_project'])->name('ajax.save.members.for.project');
Route::post('/ajax/create/new/project', [FunctionsController::class, 'ajax_create_new_project'])->name('ajax.create.new.project');
Route::post('/ajax/modify/project', [FunctionsController::class, 'ajax_modify_project'])->name('ajax.modify.project');
Route::post('/ajax/delete/project', [FunctionsController::class, 'ajax_delete_project'])->name('ajax.delete.project');

Route::post('/ajax/create/new/task', [FunctionsController::class, 'ajax_create_new_task'])->name('ajax.create.new.task');
Route::post('/ajax/modify/task', [FunctionsController::class, 'ajax_modify_task'])->name('ajax.modify.task');
Route::post('/ajax/remove/project/member', [FunctionsController::class, 'ajax_remove_project_member'])->name('ajax.remove.project.member');
Route::post('/ajax/project/invite/user', [FunctionsController::class, 'ajax_project_invite_user'])->name('ajax.project.invite.user');
Route::post('/ajax/select/members/for/task/cb', [FunctionsController::class, 'ajax_select_members_for_task_cb'])->name('ajax.select.members.for.task.cb');
Route::post('/ajax/save/members/for/project/in/tasks', [FunctionsController::class, 'ajax_save_members_for_project_in_tasks'])->name('ajax.save.members.for.project.in.tasks');
Route::post('/ajax/save/members/for/task/in/tasks', [FunctionsController::class, 'ajax_save_members_for_task_in_tasks'])->name('ajax.save.members.for.task.in.tasks');
Route::post('/ajax/add/task/docs', [FunctionsController::class, 'ajax_add_task_docs'])->name('ajax.add.task.docs');
Route::post('/ajax/save/task/docs', [FunctionsController::class, 'ajax_save_task_docs'])->name('ajax.save.task.docs');
Route::post('/ajax/get/task/docs', [FunctionsController::class, 'ajax_get_task_docs'])->name('ajax.get.task.docs');
Route::post('/ajax/remove/task/docs', [FunctionsController::class, 'ajax_remove_task_docs'])->name('ajax.remove.task.docs');
Route::post('/ajax/save/profile', [FunctionsController::class, 'ajax_save_profile'])->name('ajax.save.profile');
Route::post('/ajax/delete/task', [FunctionsController::class, 'ajax_delete_task'])->name('ajax.delete.task');


