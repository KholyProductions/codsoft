@extends('main')


@section('content')

    
    <div class="delete_mobile">
        @include('components.home_pc')
    </div>

    <div class="delete_pc">
        @include('components.home_mobile')
    </div>


    <div class="extras"></div>



    <script>

        var delete_pc = document.querySelectorAll(".delete_pc");
        var delete_mobile = document.querySelectorAll(".delete_mobile");

        if(is_pc){
            for (var i = 0; i < delete_pc.length; i++) {
                delete_pc[i].innerHTML = "";
            }
        }
        else{
            for (var i = 0; i < delete_mobile.length; i++) {
                delete_mobile[i].innerHTML = "";
            }
        }
   
        var featuresHolders = document.querySelectorAll(".featuresHolders");
        
        var leftDivs = document.querySelectorAll(".leftDivs");
        var rightDivs = document.querySelectorAll(".rightDivs");
        var featuresVisible = false;
        var divsVisible = false;

        setTimeout(() => {
            animate_section_1();
            if(!is_pc){
                showFeatures(0);
            }
        }, 500);

        contactUs_faq.onclick = function(){
            window.location = "{{route('contact')}}";
        }

        function animate_section_1(){
            section_1_leftDiv.style.opacity = 1;
            section_1_leftDiv.style.left = 0;
            
            section_1_rightDiv.style.opacity = 1;
            section_1_rightDiv.style.right = 0;
        }

        

        function showFeatures(pos){

            featuresHolders[pos].style.top = 0;
            featuresHolders[pos].style.opacity = 1;
        
            pos++;
            if(pos < featuresHolders.length){
                setTimeout(() => {
                    showFeatures(pos);
                }, 250);
            }
        }




        var testimonials = document.querySelectorAll(".testimonials");
        var testimonials_turn = 0;

        testimonials[testimonials_turn].style.opacity = 1;

        test_rightArrow.onclick = function(){
            testimonials[testimonials_turn].style.opacity = 0;
            testimonials_turn++;
            if(testimonials_turn == testimonials.length){
                testimonials_turn = 0;
            }
            setTimeout(() => {
                testimonials[testimonials_turn].style.opacity = 1;
            }, 500);
        }

        test_leftArrow.onclick = function(){
            testimonials[testimonials_turn].style.opacity = 0;
            testimonials_turn--;
            if(testimonials_turn == -1){
                testimonials_turn = testimonials.length-1;
            }
            setTimeout(() => {
                testimonials[testimonials_turn].style.opacity = 1;
            }, 500);
        }


        window.onscroll = function(){
            if(is_pc){
                if((this.scrollY + (window.innerHeight * 0.4)) > section_2.offsetTop && !featuresVisible){
                    featuresVisible = true;
                    showFeatures(0);
                }
            }
                

            for (let i = 0; i < leftDivs.length; i++) {
                if((this.scrollY + (window.innerHeight * 0.7)) > leftDivs[i].offsetTop){
                    leftDivs[i].style.rotate = "0deg";
                    leftDivs[i].style.opacity = 1;
                    leftDivs[i].style.left = 0;

                    rightDivs[i].style.rotate = "0deg";
                    rightDivs[i].style.opacity = 1;
                    rightDivs[i].style.right = 0;

                }
            }
            
        }


    </script>







@endsection