<!DOCTYPE html>
<html>

<body>

    <h2></h2>
    <ul>
        @foreach ($user as $user)
        <li> 
        	<a href = "/users/{{ $user->username}}">
        		{{ $user->username }}
        		{{ $user->password }}
        		{{ $user->name }}
        		{{ $user->name }}
			</a>
        	</li>
        @endforeach
    </ul>
</body>
</html>