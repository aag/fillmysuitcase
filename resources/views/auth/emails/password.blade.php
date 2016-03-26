<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h3>Fill My Suitcase Password Reset</h3>

		<div>
			A password reset has been requested for this email address on the Fill My Suitcase website.  If you did not request this email, it is safe to just ignore this message.  If you did request this email, reset your password by completing this form:
		</div>

        <div>
            <a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>
        </div>
	</body>
</html>
