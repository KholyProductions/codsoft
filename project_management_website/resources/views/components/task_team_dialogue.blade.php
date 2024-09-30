<div id="team_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    @if($canAccess)
    <h3 class="text-center">Invite User</h3>
    <input type="name" id="name_input" class="inputs mt_2 w-100" placeholder="Type user name" />
    <input type="email" id="email_input" class="inputs mt_1 w-100" placeholder="Type user email" />
    <div style="display:none;" id="errorHolder">
        <p class="text-center mt_1" style="color:red;">Please enter valid name and email</p>
    </div>
    <div class="btns btns_black mt_2 centerRelative" onclick="inviteUser_project_fc()">Invite User</div>
    <div id="refreshButtonContainer" style="display:none;">
        <div onclick="reloadPage()" class="mt_2 btns btns_t centerRelative">Refresh List</div>
    </div>
        
    @endif
    <div class="mt_2">
        <h3 class="text-center">Current Users</h3>
        @if(sizeof($project_team_members) == 0)
            <p class="mt_2 text-center">No users to show</p>
        @else
            <div id="teamMembersHolder" class="mt_2">
                <table>
                    @foreach($project_team_members as $key => $teamMember)
                        <tr class="table_rows">
                            <td>
                                <div class="members_cells ">
                                    <div class="names_cells">
                                        <img class="icons_small " src="{{asset('all_images/account.png')}}" />
                                        <p class="centerText_vertically ml_1">{{$teamMember->name}}</p>
                                    </div>
                                    
                                    <div class="email_cells">
                                        <img class="icons_small ml_3" src="{{asset('all_images/mail-icon.png')}}" />
                                        <p class="centerText_vertically ml_1">{{$teamMember->email}}</p>
                                    </div>

                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif

        <div class="mt_2 centerRelative btns btns_black" onclick="closeTeamDialogue()">Close</div>
        
    </div>
</div>





<script>

    var table_rows = document.querySelectorAll(".table_rows");

    function deleteTeamMember(key, id){
        createAJAX_deleteProjectMember("{{route('ajax.remove.project.member')}}", id);
        table_rows[key].style.display = "none";
    }

    function inviteUser_project_fc(){
        let name = name_input.value || '';
        let email = email_input.value || '';

        if(name.length > 0 && validateEmail(email)){
            errorHolder.style.display = "none";
            createAJAX_addUser("{{route('ajax.project.invite.user')}}", name, email);
            
            return;
        }

        errorHolder.style.display = "initial";
    }

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }


    function reloadPage(){
        if(location.href.includes("team-dialogue")){
            window.location = location.href;
            return;
        }
        window.location = location.href + "?elem=team-dialogue";
    }


    function createAJAX_addUser(my_url, name, email){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                name: name,
                email: email,
                project_id: project_id,
            },success: function (response) {
                if(response.includes('user already exists')){
                    showSmallAlertRight("User already exists");
                }
                else{
                    window.location = "{{route('account')}}/project/" + project_id + "?elem=team-dialogue";
                }
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }


    function createAJAX_deleteProjectMember(my_url, id){


        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                id: id,
                project_id: project_id,
            },success: function (response) {
                
                showSmallAlertRight("User has been removed");
                    
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }

    


</script>