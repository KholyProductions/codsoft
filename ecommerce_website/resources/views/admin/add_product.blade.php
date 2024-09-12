@extends('admin.admin_main')

@section('content')

    <h1 class="mt_3 text-center">Add Product</h1>

    <div class="margins mt_3">

        <h4>Product title</h4>
        <input type="text" class="inputs w-100" id="title_input" placeholder="Enter product title"/>

        
        <h4 class="mt_2">Category</h4>
        <select class=" inputs" id="category_select" onchange="showSubcategory()">
            <option value="">Choose Category</option>
            <option value="gym_equipment">Gym Equipment</option>
            <option value="cardio">Cardio</option>
            <option value="sports">Sports</option>
            <option value="accessories">Accessories</option>
        </select>

        <div id="subcategory_gym" style="display:none;">
            <select class=" inputs" id="subcategory_gym_select" >
                <option value="">Choose Subcategory</option>
                <option value="machines">Machines</option>
                <option value="equipment">Equipment</option>
            </select>
        </div>

        <div id="subcategory_sports" style="display:none;">
            <select class=" inputs" id="subcategory_sports_select" >
                <option value="">Choose Subcategory</option>
                <option value="outdoor">Outdoor</option>
                <option value="team_sports">Team Sports</option>
                <option value="martial_arts">Martial Arts</option>
                <option value="racket_sports">Racket Sports</option>
                <option value="water_sports">Water Sports</option>
            </select>
        </div>

    </div>

    <div class="mt_2 margins">
        <h4>Product Description</h4>
        <textarea class="inputs w-100 textareas" id="description_input" placeholder="Enter product description"></textarea>
    </div>

    

    <div class="mt_2 margins">
        <h4>Old Price (Optional)</h4>
        <input type="number" id="old_price_input"  class="inputs w-25" placeholder="Enter product price" />
    </div>

    <div class="mt_2 margins">
        <h4>Product Price</h4>
        <input type="number" id="price_input" class="inputs w-25" placeholder="Enter product price" />
    </div>

    <div class="mt_2 margins d-flex">
        <div>
            <h4>Top Selling</h4>
            <input type="checkbox" class="centerRelative mt_1" id="topSelling_cb" />
        </div>
        <div class="ml_3">
            <h4>New Arrivals</h4>
            <input type="checkbox" class="centerRelative mt_1" id="newArrivals_cb" />
        </div>
    </div>

    <div class="mt_2 margins">
        <h4 >Product Image:</h4>
        <form method="post" action="{{route('ajax.add.product.image')}}"  enctype="multipart/form-data" class="dropzone w-100  " id="dropzone" >
            @csrf
            
            <div id="dropzoneTitle" class="dz-message " data-dz-message><span >Click here, or drag file to upload</span></div>

        </form>
    </div>

    <div class="mt_2 margins">
        <h4>Product Video (Optional)</h4>
        <textarea class="inputs w-100 textareas" id="video_input" placeholder="Enter video embed url"></textarea>
    </div>
    
    <button class="btns btns_t mt_3 centerRelative" id="add_product_btn" onclick="addProduct()">Add Product</button>


    <div class="extras"></div>


    <script>
        

        function addProduct(){

            let title = title_input.value;
            let category = category_select.value;
            let sub_category = "";
            if(subcategory_gym.style.display == "initial" ){
                sub_category = subcategory_gym_select.value || "";
            }
            else if(subcategory_sports.style.display == "initial" ){
                sub_category = subcategory_sports_select.value || "";
            }
            
            let description = description_input.value;
            let price = price_input.value;
            let old_price = old_price_input.value || -1;
            let priority = "";
            let video = video_input.value || '';
            if(topSelling_cb.checked){
                priority += "top-picks,";
            }
            if(newArrivals_cb.checked){
                priority += "new";
            }


            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('ajax.add.product')}}",
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                title: title,
                category: category,
                sub_category: sub_category,
                description: description,
                price: price,
                priority:priority,
                old_price: old_price,
                video: video,
            },success: function (response) {
                window.location = "{{route('admin.manage.products')}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });


            //alert(sub_category);

            add_product_btn.disabled = true;

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

        function showSubcategory(){
            var val = category_select.value;
            if(val == "gym_equipment"){
                subcategory_gym.style.display = "initial";
                subcategory_sports.style.display = "none";
            }
            else if(val == "sports"){
                subcategory_sports.style.display = "initial";
                subcategory_gym.style.display = "none";
            }
            else{
                subcategory_gym.style.display = "none";
                subcategory_sports.style.display = "none";
            }
        }

    </script>


@endsection