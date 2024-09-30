<div id="create_task_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    <h3 class="text-center" id="taskDialogue_heading">Create New Task</h3>
    <p class="text-center mt_1">Please fill all required fields</p>

    <div class="mt_2">
        <input type="text" placeholder="Task Title" id="task_title_input" class="inputs w-100" />
        <textarea placeholder="Task Description" id="task_description_input" class="inputs w-100 mt_1"></textarea>
        
    </div>

    <div id="createTaskError" style="display:none;">
        <p style="color:red;" class="text-center mt_2">Please fill all required fields</p>
    </div>
    <div class="mt_2 centerRelative" style="width:fit-content;">
        <div onclick="modifyTask()" id="modifyTask_btn" class="  btns btns_black">Modify Task</div>
        <div onclick="createTask()" id="createTask_btn" class="  btns btns_black">Create Task</div>
    </div>
    
    <div id="deleteTaskHolder" style="display:none;">
        <a onclick="deleteTask()" class="centerRelative text-center mt_2" style="cursor:pointer; text-decoration:underline;">Delete Task</a>
    </div>
    
</div>





<script>

    var project_id = "{{$project_id}}";

    function createTask(){
        let title = task_title_input.value || '';
        let description = task_description_input.value || '';

        if(title.length > 0){
            createTaskError.style.display = "none";
            createAJAX_create_task("{{route('ajax.create.new.task')}}", title, description, '');
        }
        else{
            createTaskError.style.display = "initial";
        }
    }

    function modifyTask(){
        let title = task_title_input.value || '';
        let description = task_description_input.value || '';

        if(title.length > 0){
            createTaskError.style.display = "none";
            createAJAX_create_task("{{route('ajax.modify.task')}}", title, description, chosenTask_id);
        }
        else{
            createTaskError.style.display = "initial";
        }
    }


    function createAJAX_create_task(my_url, title, description, task_id){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                title: title,
                description: description,
                task_id: task_id,
                project_id: project_id,
            },success: function (response) {
                
                window.location = "{{route('account')}}/project/" + project_id;         
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }




</script>