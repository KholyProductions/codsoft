@extends('main')



@section('content')

@if($section == 'projects')
<div id="main_projects_section">
    @include('components.main_projects_section')
</div>
@endif

@if($section == 'tasks')
<div id="main_tasks_section" >
    @include('components.main_tasks_section')
</div>
@endif


<div onclick="closeTeamDialogue()" id="team_blackDiv"></div>

<script>
    

</script>


@endsection