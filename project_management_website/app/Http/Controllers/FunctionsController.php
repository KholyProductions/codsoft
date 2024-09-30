<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\Project;
use App\Models\Task;

use Session;

class FunctionsController extends Controller
{
    
    public function ajax_login(Request $request){

        $all_accounts = Account::get();

        $email = $request->email ?? '';
        $password = $request->password ?? '';
        
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->email == $email && $all_accounts[$i]->password == $password){
                
                Session::put('name', $all_accounts[$i]->name);
                Session::put('email', $all_accounts[$i]->email);
                Session::put('password', $all_accounts[$i]->password);
                Session::put('admin_id', $all_accounts[$i]->id);
                Session::put('loggedIn', 'true');
                echo 'login_success';
                return;
            }
        }

        echo 'invalid';

    }

    public function ajax_register(Request $request){

        $name = $request->name ?? '';
        $email = $request->email ?? '';
        $password = $request->password ?? '';

        $all_accounts = Account::get();

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->email == $email){
                echo 'already_exists';
                return;
            }
        }


        if(strlen($name) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) > 5 ){

            
            
            Account::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'team_ids' => '',
            ]);

            $all_accounts = Account::get();

            $id = sizeof($all_accounts);

            Session::put('name', $name);
            Session::put('email', $email);
            Session::put('password', $password);
            Session::put('admin_id', $id);
            Session::put('loggedIn', 'true');

            echo 'login_success';
            return;
        }
        else{
            echo 'missing_information';
        }

    }


    public function getAccountById($admin_id){

        $all_accounts = Account::get();

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->id == $admin_id){
                return $all_accounts[$i];
            }
        }

        return null;
    }


    public function getAdminTeam($admin_id){
        $all_accounts = Account::get();
        $wantedAccount = null;
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->id == $admin_id){
                $wantedAccount = $all_accounts[$i];
            }
        }

        $wantedTeam = array();
        
        $team_ids = explode(",,,", $wantedAccount->team_ids);

        for ($i=0; $i < sizeof($team_ids); $i++) { 
            for ($k=0; $k < sizeof($all_accounts); $k++) { 
                if($team_ids[$i] == $all_accounts[$k]->id){
                    array_push($wantedTeam, $all_accounts[$k]);
                }
            }
        }

        return $wantedTeam;
    }


    public function ajax_invite_user(Request $request){

        $name = $request->name;
        $email = $request->email;

        $all_accounts = Account::get();
        $wantedUser = null;

        $admin_id = Session::get('admin_id') ?? null;
        $wantedAdmin = null;
        
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->id == $admin_id){
                $wantedAdmin = $all_accounts[$i];
            }
        }

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->email == $email){
                $wantedUser = $all_accounts[$i];
            }
        }

        if($wantedUser == null){

            $password = $this->generateRandomPassword(6);
            Account::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'team_ids' => '',
            ]);

            $all_accounts = Account::get();

            $lastUser_index = sizeof($all_accounts)-1;
            $wantedUser = $all_accounts[$lastUser_index];

            //mail function

            
        }


        
        $wantedTeamIds_admin_arr = explode(",,,", $wantedAdmin->team_ids);

        for ($i=0; $i < sizeof($wantedTeamIds_admin_arr); $i++) { 
            if($wantedUser->id == $wantedTeamIds_admin_arr[$i]){
                echo 'user already exists';
                return;
            }
        }

        $wantedTeamIds_admin = $wantedAdmin->team_ids;
        if(strlen($wantedTeamIds_admin) == 0){
            $wantedTeamIds_admin = $wantedUser->id;
        }
        else{
            $wantedTeamIds_admin .= ",,," . $wantedUser->id;
        }


        $wantedTeamIds_user = $wantedUser->team_ids;
        if(strlen($wantedTeamIds_user) == 0){
            $wantedTeamIds_user = $wantedAdmin->id;
        }
        else{
            $wantedTeamIds_user .= ",,," . $wantedAdmin->id;
        }



        Account::where('id', $admin_id)
            ->update([
                'team_ids' => $wantedTeamIds_admin,
            ]);

        Account::where('id', $wantedUser->id)
            ->update([
                'team_ids' => $wantedTeamIds_user,
            ]);
        
    }

    public function generateRandomPassword($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }


    public function ajax_remove_team_member(Request $request){

        $id = $request->id;
        $admin_id = Session::get('admin_id') ?? null;
        $wantedAdmin = $this->getAccountById($admin_id);
        $deleted_user = $this->getAccountById($id);
        $all_accounts = Account::get();

        $team_ids_arr = explode(",,,", $wantedAdmin->team_ids);
        $team_ids_str_final = '';

        for ($i=0; $i < sizeof($team_ids_arr); $i++) { 
            if($team_ids_arr[$i] !== $id){
                if(strlen($team_ids_str_final) == 0){
                    $team_ids_str_final = $team_ids_arr[$i];
                }
                else{
                    $team_ids_str_final .= ",,," . $team_ids_arr[$i];
                }
            }
        }

        Account::where('id', $admin_id)
            ->update([
                'team_ids' => $team_ids_str_final,
            ]);


        $deleted_user_team_arr = explode(",,,", $deleted_user->team_ids);
        $deleted_user_team_str = "";
        for ($i=0; $i < sizeof($deleted_user_team_arr); $i++) { 
            if($deleted_user_team_arr[$i] !== (string)$admin_id){
                if(strlen($deleted_user_team_str) == 0){
                    $deleted_user_team_str = $deleted_user_team_arr[$i];
                }
                else{
                    $deleted_user_team_str .= ",,," . $deleted_user_team_arr[$i];
                }
            }
        }

        Account::where('id', $id)
            ->update([
                'team_ids' => $deleted_user_team_str,
            ]);



        $all_projects = Project::get();

        for ($i=0; $i < sizeof($all_projects); $i++) { 
            $project_team_ids = $all_projects[$i]->team_ids;
            $project_team_ids_arr = explode(",,,", $project_team_ids);
            if(in_array($id, $project_team_ids_arr)){
                $team_ids_each_str = "";
                for ($k=0; $k < sizeof($project_team_ids_arr); $k++) { 
                    if($project_team_ids_arr[$k] !== $id){
                        if(strlen($team_ids_each_str) == 0){
                            $team_ids_each_str = $project_team_ids_arr[$k];
                        }
                        else{
                            $team_ids_each_str .= ",,," . $project_team_ids_arr[$k];
                        }
                    }
                }

                Project::where('id', $i+1)
                    ->update([
                        'team_ids' => $team_ids_each_str,
                    ]);
            }
        }

        


    }



    public function ajax_select_members_for_project_cb(Request $request){

        $project_id = $request->project_id;
        $admin_id = Session::get('admin_id') ?? null;
        $wantedAdmin = $this->getAccountById($admin_id);
        $wantedProject = null;

        $admin_team = explode(",,,", $wantedAdmin->team_ids);
        $all_projects = Project::get();

        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == (int)$project_id){
                $wantedProject = $all_projects[$i];
            }
        }

        $project_team = explode(",,,", $wantedProject->team_ids);
        $selectedUsers = array();
        $selectedUsers_str = "";

        for ($i=0; $i < sizeof($admin_team); $i++) { 
            for ($k=0; $k < sizeof($project_team); $k++) { 
                if($admin_team[$i] == $project_team[$k]){
                    array_push($selectedUsers, $i);
                }
            }
        }


        for ($i=0; $i < sizeof($selectedUsers); $i++) { 
            if(strlen($selectedUsers_str) == 0){
                $selectedUsers_str = $selectedUsers[$i];
            }
            else{
                $selectedUsers_str .= ",,," . $selectedUsers[$i];
            }
            
        }

        echo $selectedUsers_str;


    }


    public function ajax_save_members_for_project(Request $request){

        $project_id = $request->project_id;
        $selectedIds_str = $request->selectedIds_str;
        $selectedIds_arr = explode(",,,", $selectedIds_str);
        $admin_id = Session::get('admin_id') ?? null;
        $wantedAdmin = $this->getAccountById($admin_id);
        $wantedProject = null;

        $admin_team = explode(",,,", $wantedAdmin->team_ids);
        $all_projects = Project::get();

        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == (int)$project_id){
                $wantedProject = $all_projects[$i];
            }
        }

        $wantedIds = array();

        for ($i=0; $i < sizeof($admin_team); $i++) { 
            for ($k=0; $k < sizeof($selectedIds_arr); $k++) { 
                if($i == $selectedIds_arr[$k]){
                    array_push($wantedIds, $admin_team[$i]);
                }
            }
            
        }

        $wantedIds_str = '';
        for ($i=0; $i < sizeof($wantedIds); $i++) { 
            if(strlen($wantedIds_str) == 0){
                $wantedIds_str = $wantedIds[$i];
            }
            else{
                $wantedIds_str .= ",,," . $wantedIds[$i];
            }
        }

        Project::where('id', $project_id)
            ->update([
                'team_ids' => $wantedIds_str,
            ]);


    }


    public function ajax_create_new_project(Request $request){

        $title = $request->title;
        $description = $request->description ?? '';
        $privacy = $request->privacy;
        $admin_id = Session::get('admin_id') ?? null;

        Project::create([
            'title' => $title,
            'description' => $description,
            'privacy' => $privacy,
            'admin_id' => $admin_id,
            'performance' => 0,
            'task_ids' => '',
            'team_ids' => '',
        ]);

    }

    public function ajax_modify_project(Request $request){

        $project_id = $request->project_id;
        $project_id = (int)$project_id;
        $title = $request->title;
        $description = $request->description ?? '';
        $privacy = $request->privacy;

        Project::where('id', $project_id)
            ->update([
                'title' => $title,
                'description' => $description,
                'privacy' => $privacy,
            ]);

        echo 'modified successfully';
    }


    public function ajax_delete_project(Request $request){

        $id = $request->project_id;

        Project::where('id', $id)->delete();

    }


    public function ajax_delete_task(Request $request){

        $id = $request->task_id;

        Task::where('id', $id)->delete();

    }
















    public function ajax_create_new_task(Request $request){

        $title = $request->title;
        $description = $request->description ?? '';
        $task_id = $request->task_id;
        $project_id = $request->project_id;
        $admin_id = Session::get('admin_id') ?? null;

        Task::create([
            'title' => $title,
            'description' => $description,
            'project_id' => $project_id,
            'admin_id' => $admin_id,
            'assigned_to' => '',
            'done' => 'false',
            'docs' => '',
        ]);

    }


    public function ajax_modify_task(Request $request){

        $project_id = $request->project_id;
        $project_id = (int)$project_id;
        $title = $request->title;
        $description = $request->description ?? '';
        $task_id = $request->task_id;

        Task::where('id', $task_id)
            ->update([
                'title' => $title,
                'description' => $description,
            ]);

        echo 'modified successfully';
    }


    public function ajax_remove_project_member(Request $request){

        $id = $request->id;
        $project_id = $request->project_id;
        $admin_id = Session::get('admin_id') ?? null;
        $wantedProject = $this->getProjectById($project_id);

        $team_ids_arr = explode(",,,", $wantedProject->team_ids);
        $team_ids_str_final = '';

        for ($i=0; $i < sizeof($team_ids_arr); $i++) { 
            if($team_ids_arr[$i] !== $id){
                if(strlen($team_ids_str_final) == 0){
                    $team_ids_str_final = $team_ids_arr[$i];
                }
                else{
                    $team_ids_str_final .= ",,," . $team_ids_arr[$i];
                }
            }
        }

        Project::where('id', $project_id)
            ->update([
                'team_ids' => $team_ids_str_final,
            ]);

            

    }


    public function getProjectById($id){
        $all_projects = Project::get();
        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == $id){
                return $all_projects[$i];
            }
        }
        return null;
    }



    public function ajax_project_invite_user(Request $request){

        
        
        $name = $request->name;
        $email = $request->email;
        $project_id = $request->project_id;
        $wantedProject = null;

        $all_projects = Project::get();
        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == $project_id){
                $wantedProject = $all_projects[$i];
            }
        }

        $all_accounts = Account::get();
        $wantedUser = null;

        $admin_id = Session::get('admin_id') ?? null;
        $wantedAdmin = null;
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->id == $admin_id){
                $wantedAdmin = $all_accounts[$i];
            }
        }
        

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->email == $email){
                $wantedUser = $all_accounts[$i];
            }
        }

        if($wantedUser == null){

            $password = $this->generateRandomPassword(6);
            Account::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'team_ids' => '',
            ]);

            $all_accounts = Account::get();

            $lastUser_index = sizeof($all_accounts)-1;
            $wantedUser = $all_accounts[$lastUser_index];

            $admin_team_ids = $wantedAdmin->team_ids;
            if(strlen($admin_team_ids) == 0){
                $admin_team_ids = $wantedUser->id;
            }else {
                $admin_team_ids .= ",,," . $wantedUser->id;
            }
            Account::where('id', $admin_id)
            ->update([
                'team_ids' => $admin_team_ids,
            ]);

            //mail function
        }

        $project_team_ids = $wantedProject->team_ids;
        $project_team_ids_arr = explode(",,,", $project_team_ids);

        $wantedEmails = array();
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            for ($k=0; $k < sizeof($project_team_ids_arr); $k++) { 
                if($all_accounts[$i]->id == $project_team_ids_arr[$k]){
                    array_push($wantedEmails, $all_accounts[$i]->email);
                }
            }
        }
        
        for ($i=0; $i < sizeof($wantedEmails); $i++) { 
            if($wantedEmails[$i]== $email){
                echo 'user already exists';
                return;
            }
        }
        

        if(strlen($project_team_ids) == 0){
            $project_team_ids = $wantedUser->id;
        }
        else{
            $project_team_ids .= ",,," . $wantedUser->id;
        }

        Project::where('id', $project_id)
            ->update([
                'team_ids' => $project_team_ids,
            ]);

    }


    public function ajax_select_members_for_task_cb(Request $request){

        $task_id = $request->task_id;
        $project_id = $request->project_id;
        $admin_id = Session::get('admin_id') ?? null;
        $wantedAdmin = $this->getAccountById($admin_id);
        $wantedProject = null;
        $wantedTask = null;

        $all_projects = Project::get();
        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == $project_id){
                $wantedProject = $all_projects[$i];
            }
        }

        $project_team = explode(",,,", $wantedProject->team_ids);
        $all_tasks = Task::get();

        for ($i=0; $i < sizeof($all_tasks); $i++) { 
            if($all_tasks[$i]->id == (int)$task_id){
                $wantedTask = $all_tasks[$i];
            }
        }

        $task_team = explode(",,,", $wantedTask->assigned_to);
        $selectedUsers = array();
        $selectedUsers_str = "";

        for ($i=0; $i < sizeof($project_team); $i++) { 
            for ($k=0; $k < sizeof($task_team); $k++) { 
                if($project_team[$i] == $task_team[$k]){
                    array_push($selectedUsers, $i);
                }
            }
        }


        for ($i=0; $i < sizeof($selectedUsers); $i++) { 
            if(strlen($selectedUsers_str) == 0){
                $selectedUsers_str = $selectedUsers[$i];
            }
            else{
                $selectedUsers_str .= ",,," . $selectedUsers[$i];
            }
            
        }

        echo $selectedUsers_str;


    }





    public function getProjectTeam($project_id){
        $all_projects = Project::get();
        $wantedProject = null;
        $all_accounts = Account::get();
        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == $project_id){
                $wantedProject = $all_projects[$i];
            }
        }

        $wantedTeam = array();
        
        $team_ids = explode(",,,", $wantedProject->team_ids);

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            for ($k=0; $k < sizeof($team_ids); $k++) { 
                if($all_accounts[$i] == $team_ids[$k]){
                    array_push($wantedTeam, $all_accounts[$i]);
                }
            }
        }

        return $wantedTeam;
    }




    public function ajax_save_members_for_project_in_tasks(Request $request){

        $project_id = $request->project_id;
        $selectedIds_str = $request->selectedIds_str;
        $selectedIds_arr = explode(",,,", $selectedIds_str);
        $admin_id = Session::get('admin_id') ?? null;
        $wantedProject = null;
        $wantedAdmin = null;
        $all_projects = Project::get();
        $all_accounts = Account::get();


        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == $project_id){
                $wantedProject = $all_projects[$i];
            }
        }
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->id == $admin_id){
                $wantedAdmin = $all_accounts[$i];
            }
        }
        
        $project_team = explode(",,,", $wantedProject->team_ids);

        $wantedIds = array();

        for ($i=0; $i < sizeof($project_team); $i++) { 
            for ($k=0; $k < sizeof($selectedIds_arr); $k++) { 
                if($i == $selectedIds_arr[$k]){
                    array_push($wantedIds, $project_team[$i]);
                }
            }
            
                
        }

        $wantedIds_str = '';
        for ($i=0; $i < sizeof($wantedIds); $i++) { 
            if(strlen($wantedIds_str) == 0){
                $wantedIds_str = $wantedIds[$i];
            }
            else{
                $wantedIds_str .= ",,," . $wantedIds[$i];
            }
        }

        Project::where('id', $project_id)
            ->update([
                'team_ids' => $wantedIds_str,
            ]);


    }



    public function ajax_save_members_for_task_in_tasks(Request $request){

        $project_id = $request->project_id;
        $task_id = $request->task_id;
        $admin_id = Session::get('admin_id') ?? null;
        $selectedIds_str = $request->selectedIds_str;
        $selectedIds_arr = explode(",,,", $selectedIds_str);
        $wantedProject = null;
        $wantedAdmin = null;
        $wantedTask = null;
        $all_projects = Project::get();
        $all_accounts = Account::get();
        $all_tasks = Task::get();


        for ($i=0; $i < sizeof($all_tasks); $i++) { 
            if($all_tasks[$i]->id == $task_id){
                $wantedTask = $all_tasks[$i];
            }
        }
        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == $project_id){
                $wantedProject = $all_projects[$i];
            }
        }
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->id == $admin_id){
                $wantedAdmin = $all_accounts[$i];
            }
        }
        
        $project_team = explode(",,,", $wantedProject->team_ids);

        $wantedIds = array();

        for ($i=0; $i < sizeof($project_team); $i++) { 
            for ($k=0; $k < sizeof($selectedIds_arr); $k++) { 
                if($i == $selectedIds_arr[$k]){
                    array_push($wantedIds, $project_team[$i]);
                }
            }
            
                
        }

        $wantedIds_str = '';
        for ($i=0; $i < sizeof($wantedIds); $i++) { 
            if(strlen($wantedIds_str) == 0){
                $wantedIds_str = $wantedIds[$i];
            }
            else{
                $wantedIds_str .= ",,," . $wantedIds[$i];
            }
        }

        Task::where('id', $task_id)
            ->update([
                'assigned_to' => $wantedIds_str,
            ]);
        
    }


    public function ajax_add_task_docs(Request $request){
        $file = $request->file('file');
        $fileName = $this->generateRandomPassword(5) . "_" . $file->getClientOriginalName();

        $file->move("uploads/tasks", $fileName);

        $files = Session::get('files') ?? '';
        if(strlen($files) > 0){
            $files .= ",,," . $fileName;
        }
        else{
            $files = $fileName;
        }

        Session::put('files', $files);
    }


    public function ajax_save_task_docs(Request $request){

        $files = Session::get('files') ?? '';
        $task_id = $request->task_id;
        $all_tasks = Task::get();
        $wantedTask = null;

        for ($i=0; $i < sizeof($all_tasks); $i++) { 
            if($all_tasks[$i]->id == $task_id){
                $wantedTask = $all_tasks[$i];
            }
        }

        $docs = $wantedTask->docs;

        if(strlen($files) > 0){
            if(strlen($docs) == 0){
                $docs = $files;
            }
            else{
                $docs .= $docs . ",,," . $files;
            }
        }
        
        Session::put('files', '');

        Task::where('id', $task_id)
            ->update([
                'docs' => $docs,
            ]);


    }


    public function ajax_get_task_docs(Request $request){
        $files = Session::get('files') ?? '';
        $task_id = $request->task_id;
        $all_tasks = Task::get();
        $wantedTask = null;

        for ($i=0; $i < sizeof($all_tasks); $i++) { 
            if($all_tasks[$i]->id == $task_id){
                $wantedTask = $all_tasks[$i];
            }
        }

        $docs = $wantedTask->docs;
        echo $docs;
    }


    public function ajax_remove_task_docs(Request $request){

        $task_id = $request->task_id;
        $file_name = $request->file_name;
        $wantedTask = null;
        $all_tasks = Task::get();

        for ($i=0; $i < sizeof($all_tasks); $i++) { 
            if($all_tasks[$i]->id == $task_id){
                $wantedTask = $all_tasks[$i];
            }
        }

        $docs_arr = explode(",,,", $wantedTask->docs);
        $docs_str = "";
        for ($i=0; $i < sizeof($docs_arr); $i++) { 
            if($docs_arr[$i] !== $file_name){
                if(strlen($docs_str) == 0){
                    $docs_str = $docs_arr[$i];
                }
                else{
                    $docs_str .= ",,," . $docs_arr[$i];
                }
            }
        }


        Task::where('id', $task_id)
            ->update([
                'docs' => $docs_str,
            ]);


    }


    public function ajax_save_profile(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        Account::where('email', $email)
            ->update([
                'name' => $name,
                'password' => $password,
            ]);
    }


    public function ajax_logout(){
        Session::flush();
        Session::put('admin_id', '');
    }


}
