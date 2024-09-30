@extends('main')

@section('metas')

@endsection

@section('content')


	<div id="contactMainImage_holder">
		<img id="contactMainImage" src="{{asset('all_images/about-2.jpg')}}" />
	</div>

	<div class="mt_4 extra_margins">
		<h1 class="text-center">Contact Us</h1>
		<p class="text-center mt_1">If you have any questions regarding our services, send us a message and we will reply as soon as possible</p>

		<form method="get" class="w-100 mt_2" action="{{route('contact')}}">
            @csrf

            <label class="mt_2">Name:</label>
            <input type="text" name="name_input" placeholder="Enter your name" class="inputs w-100" />

            <label class="mt_1">Email:</label>
            <input type="email" name="email_input"  placeholder="Enter your email" class="inputs w-100" />

            <label class="mt_1">Phone:</label>
            <input type="phone" name="phone_input"  placeholder="Enter your phone" class="inputs w-100" />
            
            <label class="mt_1">Message:</label>
            <textarea type="text" name="message_input"  id="message_input" placeholder="Type your message" class="inputs w-100"></textarea>

            <input type="submit" id="sendMsg_btn" value="Send Message" class="mt_2 btns btns_t centerRelative"style="border: 1px solid grey !important;" />
        </form>
	</div>


@endsection