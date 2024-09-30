<div id="create_project_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    <h3 class="text-center" id="projectDialogue_heading">Create New Project</h3>
    <p class="text-center mt_1">Please fill all required fields</p>

    <div class="mt_2">
        <input type="text" placeholder="Project Title" id="project_title_input" class="inputs w-100" />
        <textarea placeholder="Project Description" id="project_description_input" class="inputs w-100 mt_1"></textarea>
        <select class="inputs w-100 mt_1" id="privacy_input">
            <option value="">Select Privacy</option>
            <option value="Private">Private</option>
            <option value="Public">Public</option>
        </select>
    </div>

    <div id="createProjectError" style="display:none;">
        <p style="color:red;" class="text-center mt_2">Please fill all required fields</p>
    </div>
    <div class="mt_2 centerRelative" style="width:fit-content;">
        <div onclick="modifyProject()" id="modifyProject_btn" class="  btns btns_black">Modify Project</div>
        <div onclick="createProject()" id="createProject_btn" class="  btns btns_black">Create Project</div>
    </div>
    <div id="deleteProjectHolder" style="display:none;">
        <a onclick="deleteProject()" class="centerRelative text-center mt_2" style="cursor:pointer; text-decoration:underline;">Delete Project</a>
    </div>
    
</div>





<script>

    

    function createProject(){
        let title = project_title_input.value || '';
        let description = project_description_input.value || '';
        let privacy = privacy_input.value || '';


        if(title.length > 0 && privacy.length > 0){
            createProjectError.style.display = "none";
            createAJAX_create_project("{{route('ajax.create.new.project')}}", title, description, privacy, '');
        }
        else{
            createProjectError.style.display = "initial";
        }
    }

    function modifyProject(){
        let title = project_title_input.value || '';
        let description = project_description_input.value || '';
        let privacy = privacy_input.value || '';
        

        if(title.length > 0 && privacy.length > 0){
            createProjectError.style.display = "none";
            createAJAX_create_project("{{route('ajax.modify.project')}}", title, description, privacy, manage_project_id);
        }
        else{
            createProjectError.style.display = "initial";
        }
    }


    function createAJAX_create_project(my_url, title, description, privacy, project_id){

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
                privacy: privacy,
                project_id: project_id,
            },success: function (response) {
                
                window.location = "{{route('account')}}";         
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }




</script>