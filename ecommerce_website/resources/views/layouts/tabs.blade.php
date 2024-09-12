

<div class="tabset centerRelative" id="mainTabHolder">
  <!-- Tab 1 -->
  <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
  <label for="tab1">Personal Information</label>
  <!-- Tab 2 -->
  <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
  <label for="tab2">My Orders</label>
  <!-- Tab 3 -->
  <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
  <label for="tab3" onclick="signOut()">Sign Out</label>

  
  <div class="tab-panels">
    <section id="marzen" class="tab-panel">
      @include('layouts.edit_information')  
    </section>
    <section id="rauchbier" class="tab-panel">
        @include('layouts.orders')
    </section>
    <section  class="tab-panel">
      
      <h4>Signed Out</h4>
    </section>
    
  </div>
  
</div>

<script>

    if(!is_pc){
      setTimeout(() => {
        footer.style.position = "relative";
        footer.style.marginTop = "20vh";
      }, 100);
        
    }

    function signOut(){
      createAJAX("{{route('ajax.signout')}}");
    }



    function createAJAX(my_url){

        $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: my_url,
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
            },success: function (response) {
                
                window.location = "{{route('home')}}";
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });

    }

</script>