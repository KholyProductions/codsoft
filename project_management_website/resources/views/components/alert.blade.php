<div id="smallAlert_right">

    <div class="centerText_vertically d-flex">
        <p class=" " id="smallAlert_right_text"></p>
    </div>

</div>

<div id="topAlert">
    <h2 id="topAlert_title" class="text-center"></h2>
    <p class="text-center mt_1" id="topAlert_msg"></p>
    <div class="btns btns_t centerRelative mt_1" onclick="closeTopAlert()">Close</div>
</div>

<div id="blackDiv"></div>

<script>

    function showSmallAlertRight(text){
        smallAlert_right_text.innerHTML = text;
        smallAlert_right.style.right = 0 + "px";
        setTimeout(() => {
            smallAlert_right.style.right = "-55vw";
        }, 3500);
    }

    function showTopAlert(title, msg){
        topAlert_title.innerHTML = title;
        topAlert_msg.innerHTML = msg;
        blackDiv.style.display = "initial";
        setTimeout(() => {
            topAlert.style.top = 0;
            blackDiv.style.opacity = 0.7;
        }, 300);
    }

    function closeTopAlert(){
        topAlert.style.top = "-55vw";
        blackDiv.style.opacity = 0;
        setTimeout(() => {
            blackDiv.style.display = "none";
        }, 700);
    }

    


    


</script>