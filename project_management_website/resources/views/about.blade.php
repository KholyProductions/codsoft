@extends('main')

@section('metas')

@endsection


@section('content')

    <div id="about_wallpaper_holder">
        <img src="{{asset('all_images/about.jpg')}}" />
        <div id="about_blackDiv"></div>
        <div id="about_contentHolder" class="horizontal_vertical_center_absolute">
            <h1 class="text-center" style="color:white;">About Us</h1>
            <p class="text-center mt_1" style="color:white;">Astra is a fast-growing software company that keeps culture and creativity at the heart of everything we do. Poletsa strives to create a culture that empowers a creative, and independent workforce. We are passionate about our small business customers and believe that collaboration and creativity are powerful tools to help them make their dreams a reality.</p>
        </div>
    </div>

    <div id="about_section_1" class="mt_5 margins">

        <div id="about_s1_leftDiv" class="centerText_vertically">
            <div>
                <h2>Vision & Mission</h2>
                <p class="mt_3">Our vision is to empower businesses of all sizes to achieve unparalleled success in project management by providing innovative, user-friendly, and cutting-edge software solutions. We envision a future where every organization can efficiently plan, execute, and deliver projects with precision and agility, leading to enhanced productivity, collaboration, and business growth.</p>
                <p class="mt_1">Our mission is to revolutionize the way businesses approach project management through our advanced software solutions. We are committed to developing intuitive and customizable tools that streamline project workflows, improve team collaboration, and drive outcomes. Our mission is to empower businesses to navigate complex projects with ease, optimize resources, meet deadlines, and exceed project goals. Through continuous innovation, exceptional customer service, and a commitment to excellence, we strive to be the go-to partner for businesses seeking to elevate their project management capabilities and achieve success in a rapidly evolving business landscape.</p>
            </div>
        </div>

        <div id="about_s1_rightDiv">
            <img src="{{asset('all_images/about-4.jpg')}}" />
        </div>

    </div>

    <div class=" extra_margins mt_5 delete_mobile">
        <h2 class="text-center">Why Us ?</h2>
        <p class="mt_3 text-center">Our software is designed to streamline your project workflow, enhance communication, and boost productivity. With features like task assignment, progress tracking, file sharing, and real-time updates, you can say goodbye to confusing spreadsheets and endless email threads.</p>
        <p class="mt_1 text-center">Whether you are a small business looking to stay organized or a large enterprise in need of robust project management tools, our software is customizable to fit your specific needs. From project planning to execution and monitoring, our software provides all the tools you need to successfully manage your projects from start to finish.</p>
        <p class="mt_1 text-center">But that's not all! Our software is user-friendly, intuitive, and scalable, making it easy for teams of all sizes to adopt and utilize. Plus, our dedicated customer support team is always available to assist you every step of the way.</p>
    </div>

    <div class=" margins mt_5 delete_pc">
        <h2 >Why Us ?</h2>
        <p class="mt_3 ">Our software is designed to streamline your project workflow, enhance communication, and boost productivity. With features like task assignment, progress tracking, file sharing, and real-time updates, you can say goodbye to confusing spreadsheets and endless email threads.</p>
        <p class="mt_1 ">Whether you are a small business looking to stay organized or a large enterprise in need of robust project management tools, our software is customizable to fit your specific needs. From project planning to execution and monitoring, our software provides all the tools you need to successfully manage your projects from start to finish.</p>
        <p class="mt_1 ">But that's not all! Our software is user-friendly, intuitive, and scalable, making it easy for teams of all sizes to adopt and utilize. Plus, our dedicated customer support team is always available to assist you every step of the way.</p>
    </div>

@endsection