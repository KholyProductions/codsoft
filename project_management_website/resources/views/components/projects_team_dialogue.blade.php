<div id="projects_team_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    
    <div class="mt_2">
        <h3 class="text-center">Select Users To Join This Project</h3>
        @if(sizeof($admin_team_arr) == 0)
            <p class="mt_2 text-center">No users to show</p>
        @else
            <div id="teamMembersHolder" class="mt_2">
                <table>
                    @foreach($admin_team_arr as $key => $teamMember)
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

                                    <div class="xbtn_cells centerText_vertically" >
                                        <input type="checkbox" class="projects_team_cb" />
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="mt_2 centerRelative btns btns_black" onclick="saveProjectsTeamDialogue()">Save Changes</div>
        @endif

    </div>
</div>





<script>

    

    function inviteUser_fc(){
        let name = name_input.value || '';
        let email = email_input.value || '';

        if(name.length > 0 && validateEmail(email)){
            errorHolder.style.display = "none";
            createAJAX_invite_user_for_project("{{route('ajax.invite.user')}}", name, email);
            
            return;
        }

        errorHolder.style.display = "initial";
    }



    function createAJAX_invite_user_for_project(my_url, name, email){

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
                project_id: selectedProject,
            },success: function (response) {
                if(response.includes('user already exists')){
                    showSmallAlertRight("User already exists");
                }
                else{
                    //showSmallAlertRight("User has been added");
                    //refreshButtonContainer.style.display = "initial";
                    window.location = "{{route('account')}}?elem=team-dialogue";
                }
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }


    function createAJAX_deleteTeamMember(my_url, id){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                id: id,
            },success: function (response) {
                
                window.location = "{{route('account')}}?elem=team-dialogue";
                    
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }


</script>