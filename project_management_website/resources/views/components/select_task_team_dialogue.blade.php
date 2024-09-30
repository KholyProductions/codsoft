<div id="select_task_team_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    
    <div class="mt_2">
        <h3 class="text-center">Assign Users To Join This Task</h3>
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

                                    @if($canAccess)
                                        <div class="xbtn_cells centerText_vertically" >
                                            <input type="checkbox" class="tasks_team_cb" />
                                        </div>
                                    @else
                                        <div class="xbtn_cells centerText_vertically not_allowed" >
                                            <input type="checkbox" class="tasks_team_cb not_allowed" />
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            @if($canAccess)
                <div class="mt_2 centerRelative btns btns_black" onclick="saveTaskTeamDialogue()">Save Changes</div>
            @else
                <div class="mt_2 centerRelative btns btns_black" onclick="closeTeamDialogue()">Close</div>
            @endif
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
            },success: function (response) {
                if(response.includes('user already exists')){
                    showSmallAlertRight("User already exists");
                }
                else{
                    showSmallAlertRight("User has been added");
                    refreshButtonContainer.style.display = "initial";
                    
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
                
                showSmallAlertRight("User has been removed");
                    
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }


</script>