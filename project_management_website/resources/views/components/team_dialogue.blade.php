<div id="team_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    <h3 class="text-center">Invite User</h3>
    <input type="name" id="name_input" class="inputs mt_2 w-100" placeholder="Type user name" />
    <input type="email" id="email_input" class="inputs mt_1 w-100" placeholder="Type user email" />
    <div style="display:none;" id="errorHolder">
        <p class="text-center mt_1" style="color:red;">Please enter valid name and email</p>
    </div>
    <div class="btns btns_black mt_2 centerRelative" onclick="inviteUser_fc()">Invite User</div>

    <div class="mt_2">
        <h3 class="text-center">Current Users</h3>
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

                                    <div class="xbtn_cells centerText_vertically" onclick="deleteTeamMember({{$key}}, {{$teamMember->id}})">
                                        <img class="icons_small ml_3" src="{{asset('all_images/x-btn-2.png')}}" />
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif

        <div id="refreshButtonContainer" style="display:none;">
            <div onclick="reloadPage()" class="mt_2 btns btns_t centerRelative">Refresh List</div>
        </div>
    </div>
</div>





<script>

    var table_rows = document.querySelectorAll(".table_rows");

    function deleteTeamMember(key, id){
        createAJAX_deleteTeamMember("{{route('ajax.remove.team.member')}}", id);
        table_rows[key].style.display = "none";
    }

    function inviteUser_fc(){
        let name = name_input.value || '';
        let email = email_input.value || '';

        if(name.length > 0 && validateEmail(email)){
            errorHolder.style.display = "none";
            createAJAX("{{route('ajax.invite.user')}}", name, email);
            
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


    function createAJAX(my_url, name, email){

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