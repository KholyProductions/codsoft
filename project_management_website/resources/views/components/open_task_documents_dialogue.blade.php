<div id="open_task_documents_dialogue" class="horizontal_vertical_center_fixed team_dialogues">
    <div id="x_btn" onclick="closeTeamDialogue()"><img class="icons" src="{{asset('all_images/x_btn.png')}}" /></div>
    
    <div class="mt_2">
        @if($canAccess)
            <h3 class="text-center">Upload Documents</h3>

            <div class="mt_2 ">
                <form method="post" action="{{route('ajax.add.task.docs')}}"  enctype="multipart/form-data" class="dropzone w-100  " id="dropzone" >
                    @csrf
                    
                    <div id="dropzoneTitle" class="dz-message " data-dz-message><span >Click here, or drag file to upload</span></div>

                </form>
            </div>
        @else
            <h3 class="text-center">Documents</h3>
        @endif
        
        <div class="" id="document_text">
            <p class="text-center mt_2" >No documents to show</p>
        </div>
        
        <div class="mt_2" id="filesHolder">

        </div>

        @if($canAccess)
            <div class="mt_2 centerRelative btns btns_black" onclick="saveTaskDocuments()">Save Changes</div>
        @else
            <div class="mt_2 centerRelative btns btns_black" onclick="closeTeamDialogue()">Close</div>
        @endif

    </div>
</div>

<script src="{{asset('react/docs.js?v=2')}}" type="text/babel"></script>

<script type="text/babel">


    function showTaskDocuments(task_id){

        open_task_documents_dialogue.style.display = "initial";
        team_blackDiv.style.display = "initial";
        modifyTask_btn.style.display = "none";
        createTask_btn.style.display = "initial";

        chosenTask_id = task_id;

        filesHolder.innerHTML = "";

        getTaskDocuments();

        setTimeout(() => {
            open_task_documents_dialogue.style.opacity = 1;
            team_blackDiv.style.opacity = 0.7;
        }, 200);
            
    }

    function saveTaskDocuments(){
        
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('ajax.save.task.docs')}}",
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                task_id: chosenTask_id,

            },success: function (response) {
                //showSmallAlertRight("Changes Saved Successfully");
                closeTeamDialogue();
                window.location = "{{route('project.open', $project_id)}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });
    }



    function getTaskDocuments(){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('ajax.get.task.docs')}}",
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                task_id: chosenTask_id,

            },success: function (response) {
                if(response.length > 0){
                    var docs_arr = response.split(",,,");
                    //var docs_divs_arr = [];
                    for (let i = 0; i < docs_arr.length; i++) {
                        let newDiv = document.createElement('div');
                        newDiv.id = "doc_" + i;

                        filesHolder.appendChild(newDiv);
                        if("{{$canAccess}}" == true){
                            ReactDOM.createRoot(document.getElementById("doc_" + i)).render(<Doc style={'icons_small ml_1'} del_fc={() => del_fc(docs_arr[i], i)} img={"{{asset('all_images/x-btn-2.png')}}"} href_val={"{{asset('uploads/tasks')}}/" + docs_arr[i]} doc={docs_arr[i]} />);
                        }
                        else{
                            ReactDOM.createRoot(document.getElementById("doc_" + i)).render(<Doc img={null} style={'delete_pc delete_mobile not_allowed ml_1'} del_fc={null}  href_val={"{{asset('uploads/tasks')}}/" + docs_arr[i]} doc={docs_arr[i]} />);
                        }
                    }
                    document_text.style.display = "none";
                }
                else{
                    document_text.style.display = "initial";
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }


    function del_fc(file_name, i){
        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('ajax.remove.task.docs')}}",
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                task_id: chosenTask_id,
                file_name: file_name,

            },success: function (response) {
                showSmallAlertRight("Document has been removed");
                document.getElementById("doc_" + i).style.display = "none";
                //closeTeamDialogue();
                //window.location = "{{route('project.open', $project_id)}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });
    }

    
    Dropzone.options.dropzone =
    {
        maxFilesize: 12,
        maxFiles: 10,
        resizeQuality: 1.0,
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: false,
        timeout: 60000,
        maxfilesexceeded: function(file) {
            this.removeFile(file);
        },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                type: 'POST',
                url: "",
                data: {filename: name},
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function (file, response) {
            console.log('success');
        },
        error: function (file, response) {
            

        }
    };


</script>