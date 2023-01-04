@component('mail::message')
# Smart Jen Invitation
***
Hi __{{ $data['user_name'] }}__!

We are happy to invite you to join us as a {{ $data['user_role'] }} at our school __{{ $data['school_name'] }}__.

You can login to your account and start using it.
Your credentials are as follow:

Email:<br>
__{{ $data['user_email'] }}__

Password:<br>
__{{ $data['unhashed'] }}__

Click the button to login.
@component('mail::button', ['url' => $data['url'],'color' => 'success'])
Login
@endcomponent

Thanks,<br>
{{ $data['school_name'] }} Admin.
@endcomponent
