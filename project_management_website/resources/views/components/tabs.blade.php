<!-- 
  
  Radio version of tabs.

  Requirements:
  - not rely on specific IDs for CSS (the CSS shouldn't need to know specific IDs)
  - flexible for any number of unkown tabs [2-6]
  - accessible

  Caveats:
  - since these are checkboxes the tabs not tab-able, need to use arrow keys

  Also worth reading:
  http://simplyaccessible.com/article/danger-aria-tabs/
-->
  
<link rel="stylesheet" href="{{asset('css/v_1/tabs.css?v=1')}}">

<div class="tabset centerRelative" id="mainTabHolder">
  <!-- Tab 1 -->
  <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
  <label for="tab1">All Tasks</label>
  <!-- Tab 2 -->
  <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
  <label for="tab2">My Tasks</label>
  <!-- Tab 3 -->
  <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
  <label for="tab3">Profile</label>

  
  <div class="tab-panels">
    <section id="marzen" class="tab-panel">
        @include('components.tasks_list')
    </section>
    <section id="rauchbier" class="tab-panel">
        @include('components.my_tasks_list')
    </section>
    <section id="dunkles" class="tab-panel">
        @include('components.profile')
    </section>
    
  </div>
  
</div>

<script>



</script>