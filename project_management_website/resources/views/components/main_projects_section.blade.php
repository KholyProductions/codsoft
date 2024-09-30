
<div id="account_mainContainer">

    <div class="whiteContainers d-flex justify-content-between">
        <div class="d-flex centerText_vertically">
            <h3>Projects</h3>
            <div class="ml_2 btns btns_black" onclick="show_createNewProjectDialogue()">Create</div>
        </div>
        <h3 class="centerText_vertically">{{$account->name}}</h3>
        <div class="btns btns_t" onclick="showTeamDialogue()">Team Members</div>
    </div>

    <div class="whiteContainers mt_4">

        <table>

            <tr>
                <td><div class="cells heads">View</div></td>
                <td><div class="cells heads">Name</div></td>
                <td><div class="cells heads">Date Created</div></td>
                <td><div class="cells heads">Description</div></td>
                <td><div class="cells heads">Members</div></td>
                <td><div class="cells heads">Privacy</div></td>
                <td><div class="cells heads">Modifications</div></td>
            </tr>

            @foreach($wantedProjects as $project)

                <tr>
                    <td><div class="cells"><a onclick="openProject({{$project->id}})" class=" btns_t  btns_r">Open</a></div></td>
                    <td ><div class="cells">{{$project->short_title}}</div></td>
                    <td><div class="cells">{{$project->created_at}}</div></td>
                    @if(strlen($project->description) == 0)
                        <td><div class="cells">N/A</div></td>
                    @else
                        <td><div class="cells">{{$project->short_description}}</div></td>
                    @endif
                    
                    @if($project->canAccess == true)
                        <td><div class="cells"><a onclick="showProjectsTeamDialogue({{$project->id}})" class=" btns_t  btns_r">View / Add</a></div></td>
                        <td><div class="cells">{{$project->privacy}}</div></td>
                        <td><div class="cells"><a onclick="show_modifyProjectDialogue('{{$project->id}}', '{{$project->title}}', '{{$project->description}}', '{{$project->privacy}}')" class=" btns_t  btns_r">Edit Project</a></div></td>
                    @else
                        <td><div class="cells"><a class=" btns_t  btns_r not_allowed">View / Add</a></div></td>
                        <td><div class="cells">{{$project->privacy}}</div></td>
                        <td><div class="cells"><a  class=" btns_t  btns_r not_allowed">Edit Project</a></div></td>
                    @endif
                </tr>

            @endforeach

        </table>

    </div>


</div>


    @include('components.team_dialogue')
    @include('components.projects_team_dialogue')
    @include('components.create_project_dialogue')



    <script>

        var selectedProject = null;
        var projects_team_cb = document.querySelectorAll(".projects_team_cb");
        var manage_project_id = null;

        setTimeout(() => {
            if(location.href.includes("team-dialogue")){
                showTeamDialogue();
            }
        }, 500);


        function closeTeamDialogue(){
            team_dialogue.style.opacity = 0;
            team_blackDiv.style.opacity = 0;
            projects_team_dialogue.style.opacity = 0;
            create_project_dialogue.style.opacity = 0;

            for (let i = 0; i < projects_team_cb.length; i++) {
                projects_team_cb[i].checked = false;
            }

            setTimeout(() => {
                team_dialogue.style.display = "none";
                team_blackDiv.style.display = "none";
                projects_team_dialogue.style.display = "none";
                create_project_dialogue.style.display = "none";

                project_title_input.value = '';
                project_description_input.value = '';
                privacy_input.value = '';
            }, 1000);
        }

        function openProject(id){
            window.location = "{{route('account')}}/project/" + id;
        }


        function show_createNewProjectDialogue(){
            create_project_dialogue.style.display = "initial";
            team_blackDiv.style.display = "initial";
            projectDialogue_heading.innerHTML = "Create New Project";
            modifyProject_btn.style.display = "none";
            createProject_btn.style.display = "initial";

            deleteProjectHolder.style.display = "none";

            setTimeout(() => {
                create_project_dialogue.style.opacity = 1;
                team_blackDiv.style.opacity = 0.7;
            }, 200);
        }

        function show_modifyProjectDialogue(project_id, title, description, privacy){
            create_project_dialogue.style.display = "initial";
            team_blackDiv.style.display = "initial";
            projectDialogue_heading.innerHTML = "Modify Project";
            modifyProject_btn.style.display = "initial";
            createProject_btn.style.display = "none";

            deleteProjectHolder.style.display = "initial";

            manage_project_id = project_id;

            project_title_input.value = title;
            project_description_input.value = description;
            privacy_input.value = privacy;

            setTimeout(() => {
                create_project_dialogue.style.opacity = 1;
                team_blackDiv.style.opacity = 0.7;
            }, 200);
        }


        function deleteProject(){

            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.delete.project')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    project_id: manage_project_id,
                },success: function (response) {
                    
                    window.location = "{{route('account')}}";
                        
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
        }

        function showTeamDialogue(){
            team_dialogue.style.display = "initial";
            team_blackDiv.style.display = "initial";

            setTimeout(() => {
                team_dialogue.style.opacity = 1;
                team_blackDiv.style.opacity = 0.7;
            }, 200);
        }

        function showProjectsTeamDialogue(project_id){
            projects_team_dialogue.style.display = "initial";
            team_blackDiv.style.display = "initial";

            selectedProject = project_id;
            
            setTimeout(() => {
                projects_team_dialogue.style.opacity = 1;
                team_blackDiv.style.opacity = 0.7;
            }, 200);

            createAJAX_selectMembers_for_project_cb("{{route('ajax.select.members.for.project.cb')}}", project_id);
        }


        function saveProjectsTeamDialogue(){
            projects_team_dialogue.style.display = "initial";
            team_blackDiv.style.display = "initial";

            
            setTimeout(() => {
                projects_team_dialogue.style.opacity = 1;
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

            createAJAX_saveMembers_for_project("{{route('ajax.save.members.for.project')}}", selectedIds_str);
        }



        


        function createAJAX_selectMembers_for_project_cb(my_url, project_id){

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



        function createAJAX_saveMembers_for_project(my_url, selectedIds_str){

            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: my_url,
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    project_id: selectedProject,
                    selectedIds_str: selectedIds_str,
                },success: function (response) {
                    showSmallAlertRight("Changes Saved Successfully");
                    closeTeamDialogue();
                    window.location = "{{route('account')}}";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });

        }


    </script>

