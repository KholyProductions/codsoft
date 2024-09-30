<!DOCTYPE html>
<html>
<head>


    <style type="text/css">

        
        @media only screen and (min-device-width: 1024px){

            #accordion_1_mainHolder{
                width: 100%; 
            }

            .cross:before,.cross:after {
                content: '';
                border-top: 2px solid #3E474F;
                width: 1vw;
                display: block;
                transition: 0.3s;
            }

        }


        @media only screen and (max-device-width: 1023px){

            #accordion_1_mainHolder{
                width: 100%; 
            }

            .questionHolders{
                height: auto !important;
                padding: 1vw;
            }

            .questions_txt{
                padding-right: 5vw !important;
            }

            .cross{
                margin-right: 3vw !important;
                width:4vw !important;
                font-size:4vw !important;
            }

            .cross:before,.cross:after {
                content: '';
                border-top: 2px solid #3E474F;
                width: 2vw;
                display: block;
                transition: 0.3s;
            }

        }

        .wrapper {
            width: 100%;
        }

        .acc_2_radios{
            display: none !important;
        }

        .border_black{
            border: 1px solid #3E474F;
        }

        label {
            display: flex;
            width: 100%;
            cursor: pointer;
            user-select: none;
        }

        label div:first-child {
            width: 100%;
        }

        .cross{
            margin-right:15px;
        }

        

        .cross:after {
            transform: rotate(90deg);
            margin-top: -2px;
        }

        .content {
            box-sizing: border-box;
            margin: 10px 10px;
            max-height: 0;
            overflow: hidden;
            transition: max-height, .5s;
            color: grey;
        }

        input:checked ~ .content {
            max-height: 400px;
            transition: max-height, 1s;
        }

        input:checked ~ label .cross:before {
            transform: rotate(180deg);
        }

        input:checked ~ label .cross:after {
            transform: rotate(0deg);
        }

        .questions{
            max-height: 0;
            overflow: hidden;
            transition: max-height, .5s;
        }

        .questions label{
            border:none;
            box-shadow: none;
            margin:0;
        }

        input:checked ~ .questions {
            max-height: 400px;
            border-bottom:2px solid #3E474F;
            transition: 1s;
        }

        /*----------tool-tip------------*/

        .tip {
            color: #f03768;
            cursor: help;
            position: relative;
            overflow: visible;
            font-family: monospace;
            font-size: 1.3em;
        }

        .tip:before,
        .tip:after {
            position: absolute;
            opacity: 0;
            z-index: -100;    
            transform: translateY(-30%);
            transition: .4s;
        }

        .tip:before {
            content: '';
            border-style: solid;
            border-width: 0.8em 0.5em 0 0.5em;
            border-color: #3E474F transparent transparent transparent;
            transform: translateY(-200%);
            bottom:90%;
            left:50%;
        }

        .tip:after {
            content: attr(data-tip);
            background: #3E474F;
            color: white;
            width: 150px;
            padding: 10px;
            bottom: 150%;
            left: -50%;
        }

        .tip:hover:before,
        .tip:hover:after {
            opacity: 1;
            z-index: 100;
            transform: scaleY(1);
        }

       .questionHolders{
            height:3vw;
       }

       .questions_txt{
            margin-left:1vw;
       }

    </style>


</head>

<body>


    <div  id="accordion_1_mainHolder">
       
        <div class="wrapper">

            <div class="wrap-1 mt_2">
                <input class="acc_2_radios" type="radio" id="tab-1" name="tabs">
                <label for="tab-1" >
                    <div class="border_black d-flex centerText_vertically questionHolders">

                        <div class=" questions_txt">What features are available in your free project management platform ?</div>
                        <div class="cross"></div>
                                                
                    </div>
                    
                </label>
                <div class="content">Our free project management platform offers essential features such as task management, team collaboration, file sharing, and basic reporting capabilities.</div>
            </div>

            <div class="wrap-2 mt_1">
                <input class="acc_2_radios" type="radio" id="tab-2" name="tabs">
                <label for="tab-2" >
                    <div class="border_black d-flex centerText_vertically questionHolders">

                        <div class=" questions_txt">Is there a limit on the number of users who can access the free platform ?</div>
                        <div class="cross"></div>
                                                
                    </div>
                    
                </label>
                <div class="content">No, there is no limit on the number of users who can access the free platform. You can invite and collaborate with as many team members or stakeholders as needed.</div>
            </div>

            
            <div class="wrap-4 mt_1">
                <input class="acc_2_radios" type="radio" id="tab-4" name="tabs">
                <label for="tab-4" >
                    <div class="border_black d-flex centerText_vertically questionHolders">

                        <div class=" questions_txt">What types of projects can be managed using your free platform?</div>
                        <div class="cross"></div>
                                                
                    </div>
                    
                </label>
                <div class="content">Our free platform can be used to manage a wide range of projects, including task-based projects, agile projects, marketing campaigns, events, and more.</div>
            </div>


            <div class="wrap-5 mt_1">
                <input class="acc_2_radios" type="radio" id="tab-5" name="tabs">
                <label for="tab-5" >
                    <div class="border_black d-flex centerText_vertically questionHolders">

                        <div class=" questions_txt">Are there any restrictions on the number of projects that can be created on the free platform ?</div>
                        <div class="cross"></div>
                                                
                    </div>
                    
                </label>
                <div class="content">There are no limitations on the number of projects that can be created on the free platform. You can create and manage multiple projects simultaneously.</div>
            </div>

            <div class="wrap-7 mt_1">
                <input class="acc_2_radios" type="radio" id="tab-7" name="tabs">
                <label for="tab-7" >
                    <div class="border_black d-flex centerText_vertically questionHolders">

                        <div class=" questions_txt">How secure is the data stored on the free project management platform?</div>
                        <div class="cross"></div>
                                                
                    </div>
                    
                </label>
                <div class="content">We prioritize the security of your data. Our free platform utilizes industry-standard security measures to safeguard your information, including data encryption, access controls, and regular backups.</div>
            </div>


            <div class="wrap-8 mt_1">
                <input class="acc_2_radios" type="radio" id="tab-8" name="tabs">
                <label for="tab-8" >
                    <div class="border_black d-flex centerText_vertically questionHolders">

                        <div class=" questions_txt">What support is available for users of the free project management platform ?</div>
                        <div class="cross"></div>
                                                
                    </div>
                    
                </label>
                <div class="content">Users of the free platform have access to our knowledge base, community forums, and email support. While the free tier does not include priority support, our team is dedicated to helping all users make the most of the platform.</div>
            </div>

            
            
        </div>
    </div>


</body>

</html>