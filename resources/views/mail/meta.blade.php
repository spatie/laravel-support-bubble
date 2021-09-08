<h3>Meta</h3>
<ul>
@if($name)
<li><strong>Name</strong>: {{ $name }}</li>
@endif
@if($email)
<li><strong>E-mail</strong>: {{ $email }}</li>
@endif
@if($subject)
<li><strong>Subject</strong>: {{ $subject }}</li>
@endif
@if($url)
<li><strong>URL</strong>: {{ $url }}</li>
@endif
@if($ip)
<li><strong>IP-address</strong>: {{ $ip }}</li>
@endif
@if($userAgent)
<li><strong>User-agent</strong>: {{ $userAgent }}</li>
@endif
</ul>
