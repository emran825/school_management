@component('mail::message')
# Hello, {{ $username }}
<p> Successfully Create Your Account </p>
Provide Your UserName and Password is.... <br><br>
<b>Username:</b> {{ $username }} <br>
<b>Password:</b> {{ $password }}<br><br>
you have click the below link and use your username and password and update your username and password first...<br><br>

@component('mail::button', ['url' => ''])
Login
@endcomponent

Thanks,<br>
Ace Learning
@endcomponent
