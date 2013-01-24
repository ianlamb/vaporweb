@layout('master')

@section('content')
	<div id="login-div" class="span4 well">
		<?=Form::open('user/login', 'POST')?>
			<fieldset>
				<legend>Login</legend>
				
				<?=Form::label('email', 'Email')?>
				<?=Form::text('email')?>
				@if ($errors->has('email'))
					@foreach ($errors->get('email', '<p class="alert alert-error">:message</p>') as $email_error)
						{{ $email_error }}
					@endforeach
				@endif
				
				<?=Form::label('password', 'Password')?>
				<?=Form::password('password')?>
				@if ($errors->has('password'))
					@foreach ($errors->get('password', '<p class="alert alert-error">:message</p>') as $password_error)
						{{ $password_error }}
					@endforeach
				@endif
				
				<br />
				<?=Form::submit('Authenticate', array('class' => 'btn btn-primary'))?>
			</fieldset>
		<?=Form::close()?>
		
		<a href="register">Register</a>
	</div>
@endsection