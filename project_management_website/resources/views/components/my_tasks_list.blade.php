@if(sizeof($my_tasks) > 0)
<table>

    <tr>
        <td><div class="cells heads">View</div></td>
        <td><div class="cells heads">Name</div></td>
        <td><div class="cells heads">Date Created</div></td>
        <td><div class="cells heads">Documents</div></td>
        <td><div class="cells heads">Assigned To</div></td>
        <td><div class="cells heads">Modifications</div></td>
    </tr>

    
    @foreach($my_tasks as $key=> $task)

        <tr>
            <td><div class="cells"><a onclick="openTask('{{$task->title}}', '{{ $task->description }}')" class=" btns_t  btns_r">Open</a></div></td>
            <td ><div class="cells">{{$task->short_title}}</div></td>
            <td><div class="cells">{{$task->created_at}}</div></td>
            @if($canAccess)
                <td><div class="cells"><a onclick="showTaskDocuments('{{$task->id}}')" class=" btns_t  btns_r">Download / Add</a></div></td>
            @else
                <td><div class="cells"><a  class=" btns_t  btns_r not_allowed">Download / Add</a></div></td>
            @endif
            <td><div class="cells"><a onclick="showSelectTaskTeamDialogue('{{$task->id}}')" class=" btns_t  btns_r">View / Add</a></div></td>
            @if($canAccess == true)
                <td><div class="cells"><a onclick="show_modifyTaskDialogue('{{$task->id}}', '{{$task->title}}', '{{ $task->description }}')" class=" btns_t  btns_r">Edit Task</a></div></td>
            @else
                <td><div class="cells"><a class=" btns_t  btns_r not_allowed">Edit Task</a></div></td>
            @endif
        </tr>

    @endforeach


</table>
@else

    <h4 class="text-center">No Tasks Available</h4>

@endif





<script>

    



</script>