<div id="account_mainContainer">

    <div class="whiteContainers">
        <div class=" d-flex justify-content-between">
            <div class="d-flex centerText_vertically">
                <h3>Tasks</h3>
                @if($canAccess == true)
                    <div class="ml_2 btns btns_black" onclick="show_createNewTaskDialogue()">Create</div>
                @endif
            </div>
            <h3 class="centerText_vertically horizontal_center">{{$wantedProject->title}}</h3>
            <div class="btns btns_t" onclick="showTeamDialogue_tasks()">Project Members</div>
        </div>
        @if(strlen($wantedProject->description) > 0)
            <p class="text-center mt_2">{{$wantedProject->description}}</p>
        @endif
    </div>
    

    

    <div class="whiteContainers  mt_4 ">
    
        @include('components.tabs')
    
    </div>

</div>


@include('components.create_task_dialogue')
@include('components.open_task_dialogue')
@include('components.task_team_dialogue')
@include('components.select_task_team_dialogue')
@include('components.open_task_documents_dialogue')


<script>

        setTimeout(() => {
            if(location.href.includes("team-dialogue")){
                showTeamDialogue_tasks();
            }
        }, 500);

    var chosenTask_id = null;
    var project_id = "{{$project_id}}";
    var projects_team_cb = document.querySelectorAll(".projects_team_cb");
    var tasks_team_cb = document.querySelectorAll(".tasks_team_cb");

    


    function closeTeamDialogue(){
        team_dialogue.style.opacity = 0;
        team_blackDiv.style.opacity = 0;
        select_task_team_dialogue.style.opacity = 0;
        create_task_dialogue.style.opacity = 0;
        open_task_dialogue.style.opacity = 0;
        open_task_documents_dialogue.style.opacity = 0;
        for (let i = 0; i < projects_team_cb.length; i++) {
            projects_team_cb[i].checked = false;
        }
        for (let i = 0; i < tasks_team_cb.length; i++) {
            tasks_team_cb[i].checked = false;
        }

        setTimeout(() => {
            team_dialogue.style.display = "none";
            team_blackDiv.style.display = "none";
            select_task_team_dialogue.style.display = "none";
            create_task_dialogue.style.display = "none";
            open_task_dialogue.style.display = "none";
            open_task_documents_dialogue.style.display = "none";

            task_title_input.value = '';
            task_description_input.value = '';
            
        }, 1000);
    }

    function show_createNewTaskDialogue(){

        create_task_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";
        taskDialogue_heading.innerHTML = "Create New Task";
        modifyTask_btn.style.display = "none";
        createTask_btn.style.display = "initial";

        deleteTaskHolder.style.display = "none";

        setTimeout(() => {
            create_task_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);

    }

    function show_modifyTaskDialogue(id, title, description){

        create_task_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";
        taskDialogue_heading.innerHTML = "Modify Task";
        modifyTask_btn.style.display = "initial";
        createTask_btn.style.display = "none";

        deleteTaskHolder.style.display = "initial";

        chosenTask_id = id;

        task_title_input.value = title;

        replaceAllLineBreaks(description);
        

        setTimeout(() => {
            create_task_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);

    }

    function deleteTask(){
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('ajax.delete.task')}}",
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                task_id: chosenTask_id,
            },success: function (response) {
                //showSmallAlertRight("Changes Saved Successfully");
                closeTeamDialogue();
                window.location = "{{route('project.open', $project_id)}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });
    }


    function replaceAllLineBreaks(description){
        let des = description.replace("<br />", '\r\n');
        if(des.includes("<br />")){
            replaceAllLineBreaks(des);
            return;
        }
        task_description_input.value = des;
    }


    function showTeamDialogue_tasks(){
        team_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";

        setTimeout(() => {
            team_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);
        
        createAJAX_selectMembers_for_project_cb("{{route('ajax.select.members.for.project.cb')}}");
    }

    function showSelectTaskTeamDialogue(task_id){
        select_task_team_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";

        chosenTask_id = task_id;

        setTimeout(() => {
            select_task_team_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);


        createAJAX_selectMembers_for_task_cb("{{route('ajax.select.members.for.task.cb')}}", chosenTask_id);
    }


    function createAJAX_selectMembers_for_task_cb(my_url, task_id){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                task_id: task_id,
                project_id: project_id,
            },success: function (response) {
                
                if(response.length > 0){
                    var cb_arr = response.split(",,,");
                    for (let i = 0; i < cb_arr.length; i++) {
                        tasks_team_cb[cb_arr[i]].checked = true;
                    }
                }
                
                    
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }



    function createAJAX_selectMembers_for_project_cb(my_url){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                project_id: project_id,
            },success: function (response) {
                
                if(response.length > 0){
                    var cb_arr = response.split(",,,");
                    for (let i = 0; i < cb_arr.length; i++) {
                        projects_team_cb[cb_arr[i]].checked = true;
                    }
                }
                
                    
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }



    function saveProjectsTeamDialogue(){
        team_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";

        
        setTimeout(() => {
            team_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);

        let selectedIds_arr = [];
        let selectedIds_str = '';
        for (let i = 0; i < projects_team_cb.length; i++) {
            if(projects_team_cb[i].checked){
                selectedIds_arr.push(i);
            }
        }

        for (let i = 0; i < selectedIds_arr.length; i++) {
            if(selectedIds_str.length == 0){
                selectedIds_str = selectedIds_arr[i];
            }
            else{
                selectedIds_str += ",,," + selectedIds_arr[i];
            }
        }

        createAJAX_saveMembers_for_project("{{route('ajax.save.members.for.project.in.tasks')}}", selectedIds_str);
    }



    function createAJAX_saveMembers_for_project(my_url, selectedIds_str){


        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                project_id: project_id,
                selectedIds_str: selectedIds_str,
            },success: function (response) {
                //showSmallAlertRight("Changes Saved Successfully");
                closeTeamDialogue();
                window.location = "{{route('project.open', $project_id)}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }


    function saveTaskTeamDialogue(){

        select_task_team_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";

        
        setTimeout(() => {
            select_task_team_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);

        let selectedIds_arr = [];
        let selectedIds_str = '';
        for (let i = 0; i < tasks_team_cb.length; i++) {
            if(tasks_team_cb[i].checked){
                selectedIds_arr.push(i);
            }
        }

        for (let i = 0; i < selectedIds_arr.length; i++) {
            if(selectedIds_str.length == 0){
                selectedIds_str = selectedIds_arr[i];
            }
            else{
                selectedIds_str += ",,," + selectedIds_arr[i];
            }
        }

        createAJAX_saveMembers_for_task("{{route('ajax.save.members.for.task.in.tasks')}}", selectedIds_str);
    }


    function createAJAX_saveMembers_for_task(my_url, selectedIds_str){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                project_id: project_id,
                selectedIds_str: selectedIds_str,
                task_id: chosenTask_id,

            },success: function (response) {
                //showSmallAlertRight("Changes Saved Successfully");
                closeTeamDialogue();
                window.location = "{{route('project.open', $project_id)}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }



</script>