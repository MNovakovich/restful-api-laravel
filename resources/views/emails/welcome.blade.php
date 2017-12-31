Hello {{$user->name}}

Thank you for create an acount. Pleas verify your email using this link: {{route('verify', $user->verification_token)}} 