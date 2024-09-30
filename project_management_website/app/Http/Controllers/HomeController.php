<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Illuminate\Http\Request;


use App\Models\Account;
use App\Models\Project;
use App\Models\Task;

use Session;

class HomeController extends FunctionsController
{
    public function home_get(){

        $loggedIn = Session::get('loggedIn') ?? 'false';

        return view('home',[
            'loggedIn' => $loggedIn,
        ]);
    }


    public function login_get(){

        $loggedIn = Session::get('loggedIn') ?? 'false';

        return view('login',[
            'loggedIn' => $loggedIn,
        ]);
    }

    public function register_get(){

        $loggedIn = Session::get('loggedIn') ?? 'false';

        return view('register',[
            'loggedIn' => $loggedIn,
        ]);
    }

    public function about(){

        $loggedIn = Session::get('loggedIn') ?? 'false';

        return view('about',[
            'loggedIn' => $loggedIn,
        ]);
    }

    public function contact(){

        $loggedIn = Session::get('loggedIn') ?? 'false';

        return view('contact',[
            'loggedIn' => $loggedIn,
        ]);
    }


    public function account_get(){

        $loggedIn = Session::get('loggedIn') ?? 'false';
        $admin_id = Session::get('admin_id') ?? null;

        if($admin_id == null){
            return view('login',[
                'loggedIn' => $loggedIn,
            ]);
        }

        $admin_team_arr = $this->getAdminTeam($admin_id);

        $all_projects = Project::get();
        $wantedProjects = array();
        $account = $this->getAccountById($admin_id);

        
        $all_accounts = Account::get();
        $wantedUsers = array();
        $wantedUsers_projects = array();

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            $team_ids = $all_accounts[$i]->team_ids;
            $team_ids = explode(",,,", $team_ids);
            for ($k=0; $k < sizeof($team_ids); $k++) { 
                if($team_ids[$k] == $admin_id){
                    if(in_array($all_accounts[$i], $wantedUsers) == false){
                        array_push($wantedUsers, $all_accounts[$i]);
                    }
                    
                }
            }
        }

        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->admin_id == $admin_id){
                array_push($wantedProjects, $all_projects[$i]);
            }
        }

        for ($i=0; $i < sizeof($wantedUsers); $i++) { 
            for ($k=0; $k < sizeof($all_projects); $k++) { 
                
                if($all_projects[$k]->admin_id == $wantedUsers[$i]->id){
                    if(in_array($all_projects[$k], $wantedProjects) == false){
                        array_push($wantedProjects, $all_projects[$k]);
                    }
                }
                
            }
        }

        


        for ($i=0; $i < sizeof($wantedProjects); $i++) { 
            if(strlen($wantedProjects[$i]->title) >= 25){
                $wantedProjects[$i]->short_title = substr($wantedProjects[$i]->title, 0, 25) . '...';
            }
            else{
                $wantedProjects[$i]->short_title = $wantedProjects[$i]->title;
            }

            if(strlen($wantedProjects[$i]->description) >= 25){
                $wantedProjects[$i]->short_description = substr($wantedProjects[$i]->description, 0, 25) . '...';
            }
            else{
                $wantedProjects[$i]->short_description = $wantedProjects[$i]->description;
            }
        }

        /*
        if(sizeof($wantedProjects) == 0){
            
            Project::create([
                'title' => 'Project 1',
                'description' => 'Set tasks, manage deadlines, collect reports, track progress, upload documents, message other users, and run projects from wherever you are.',
                'admin_id' => $admin_id,
                'privacy' => 'Private',
                'performance' => 0,
                'task_ids' => '',
                'team_ids' => '',
            ]);

            $all_projects = Project::get();

            $lastProject = $all_projects[sizeof($all_projects)-1];

            array_push($wantedProjects, $lastProject);
        }
        */

        $canAccess = false;

        for ($i=0; $i < sizeof($wantedProjects); $i++) { 
            if($wantedProjects[$i]->admin_id == $admin_id){
                $wantedProjects[$i]->canAccess = true;
            }
            else{
                $wantedProjects[$i]->canAccess = false;
            }
        }

        return view('account',[
            'loggedIn' => $loggedIn,
            'wantedProjects' => $wantedProjects,
            'account' => $account,
            'admin_team_arr' => $admin_team_arr,
            'wantedProject' => null,
            'section' => 'projects',
        ]);

    }



    public function project_open(Request $request){


        //Session::put('files', '');

        $id = $request->id;
        $all_projects = Project::get();
        $all_accounts = Account::get();
        $admin_id = Session::get('admin_id') ?? null;
        $wantedAdmin = null;
        $admin_team_members = array();
        $project_team_members = array();
        $loggedIn = Session::get('loggedIn') ?? 'false';

        $wantedProject = null;
        for ($i=0; $i < sizeof($all_projects); $i++) { 
            if($all_projects[$i]->id == $id){
                $wantedProject = $all_projects[$i];
            }
        }

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->id == $admin_id){
                $wantedAdmin = $all_accounts[$i];
            }
        }

        if($wantedAdmin !== null){
            $admin_team = $wantedAdmin->team_ids;
            $admin_team_arr = explode(",,,", $admin_team);
            for ($i=0; $i < sizeof($admin_team_arr); $i++) { 
                foreach ($all_accounts as $key => $account) {
                    if($account->id == $admin_team_arr[$i]){
                        array_push($admin_team_members, $account);
                    }
                }
            }
        }

        

        if($wantedProject !== null){

            $project_team = $wantedProject->team_ids;
            $project_team_arr = explode(",,,", $project_team);
            for ($i=0; $i < sizeof($project_team_arr); $i++) { 
                foreach ($all_accounts as $key => $account) {
                    if($account->id == $project_team_arr[$i]){
                        array_push($project_team_members, $account);
                    }
                }
            }
            

            $usersWithAccess = $wantedProject->admin_id;
            $project_ids = explode(",,,", $wantedProject->team_ids);
            for ($i=0; $i < sizeof($project_ids); $i++) { 
                $usersWithAccess .= ",,," . $project_ids[$i];
            }
            $canAccess = $this->getCanAccessTask($admin_id, $usersWithAccess);

            $all_tasks = Task::get();
            $wantedTasks = array();
            for ($i=0; $i < sizeof($all_tasks); $i++) { 
                if($all_tasks[$i]->project_id == $wantedProject->id){
                    array_push($wantedTasks, $all_tasks[$i]);
                }
            }

            $my_tasks = array();
            if($wantedAdmin !== null){
                for ($i=0; $i < sizeof($wantedTasks); $i++) { 
                    $assigned_to_arr = explode(",,,", $wantedTasks[$i]->assigned_to);
                    foreach ($assigned_to_arr as $key => $assigned_to_id) {
                        if($assigned_to_id == $wantedAdmin->id){
                            array_push($my_tasks, $wantedTasks[$i]);
                        }
                    }
                }
            }
            
            

            for ($i=0; $i < sizeof($wantedTasks); $i++) { 
                if(strlen($wantedTasks[$i]->title) >= 25){
                    $wantedTasks[$i]->short_title = substr($wantedTasks[$i]->title, 0, 25) . '...';
                }
                else{
                    $wantedTasks[$i]->short_title = $wantedTasks[$i]->title;
                }

                $wantedTasks[$i]->description = nl2br($wantedTasks[$i]->description);
                $wantedTasks[$i]->description = preg_replace('/[\n\r]/','',trim($wantedTasks[$i]->description));
                
            }

            if($wantedProject->privacy == 'Public'){
                if($wantedAdmin == null){
                    $account = new Account;
                    $account->name = "Guest"; 
                    $account->email = "N/A";
                    $wantedAdmin = $account;
                }
                return view('account',[
                    'loggedIn' => $loggedIn,
                    'wantedAdmin' => $wantedAdmin,
                    'wantedProject' => $wantedProject,
                    'wantedTasks' => $wantedTasks,
                    'my_tasks' => $my_tasks,
                    'project_id' => $id,
                    'canAccess' => $canAccess,
                    'admin_team_members' => $admin_team_members,
                    'project_team_members' => $project_team_members,
                    'section' => 'tasks',
                ]);
            }
            else{

                if($wantedAdmin == null){
                    $account = new Account;
                    $account->name = "Guest"; 
                    $account->email = "N/A";
                    $wantedAdmin = $account;
                }
                $team_ids = explode(",,,", $wantedProject->team_ids);
                if((in_array($admin_id, $team_ids) || $wantedProject->admin_id == $admin_id) && $admin_id !== null){
                    return view('account',[
                        'loggedIn' => $loggedIn,
                        'wantedProject' => $wantedProject,
                        'wantedAdmin' => $wantedAdmin,
                        'wantedTasks' => $wantedTasks,
                        'my_tasks' => $my_tasks,
                        'project_id' => $id,
                        'canAccess' => $canAccess,
                        'admin_team_members' => $admin_team_members,
                        'project_team_members' => $project_team_members,
                        'section' => 'tasks',
                    ]);
                }
                else{
                    abort(404);
                }
            }


        }



    }


    function getCanAccessTask($admin_id, $usersWithAccess){

        $usersWithAccess = explode(",,,", $usersWithAccess);
        for ($i=0; $i < sizeof($usersWithAccess); $i++) { 
            if($usersWithAccess[$i] == $admin_id && $admin_id !== null){
                return true;
            }
        }

        return false;
    }


    function getProjectUsers($project_ids){

        $all_accounts = Account::get();
        $project_users = array();
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            for ($k=0; $k < sizeof($project_ids); $k++) { 
                if($project_ids[$k] == $all_accounts[$i]->id){
                    array_push($project_users, $all_accounts[$i]);
                }
            }
        }

        return $project_users;

    }
    

}
