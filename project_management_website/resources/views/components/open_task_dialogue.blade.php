<div id="open_task_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    

    <div class="">
        <h2 class="text-center" id="open_task_title"></h2>
        <p class="text-center mt_1" id="open_task_description"></p>
    </div>

    
    <div class="mt_2 centerRelative" style="width:fit-content;">
        <div onclick="closeTeamDialogue()"  class="  btns btns_black">Close</div>
    </div>
    
    
</div>




<script>

    function openTask(title, description){

        open_task_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";

        setTimeout(() => {
            open_task_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);

        open_task_title.innerHTML = title;
        open_task_description.innerHTML = description;


    }



</script>