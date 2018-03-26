@extends('layouts.profile')
@section('title')
	{{ $user->name }}'s Profile
@endsection
@section('content')
<div id="wrapper">
    @include('profiles.partials.sidebar')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="card-header">Dashboard</div>
				<div class="panel-body">
					<dl class="user-info">
						<dt>
							Profile
						</dt>
						<dd>
							{{ $user->name }}
						</dd>

						<dt>
							First Name
						</dt>
						<dd>
							{{ $user->first_name }}
						</dd>

						@if ($user->last_name)
							<dt>
								Last Name
							</dt>
							<dd>
								{{ $user->last_name }}
							</dd>
						@endif

						<dt>
							Email
						</dt>
						<dd>
							{{ $user->email }}
						</dd>

						@if ($user->profile)

							@if ($user->profile->theme_id)
								<dt>
									Theme
								</dt>
								<dd>
									{{ $currentTheme->name }}
								</dd>
							@endif

							@if ($user->profile->location)
								<dt>
									Location
								</dt>
								<dd>
									{{ $user->profile->location }} <br />
								</dd>
							@endif

							@if ($user->profile->bio)
								<dt>
									Bio
								</dt>
								<dd>
									{{ $user->profile->bio }}
								</dd>
							@endif

							@if ($user->profile->twitter_username)
								<dt>
									Twitter Username
								</dt>
								<dd>
									{!! HTML::link('https://twitter.com/'.$user->profile->twitter_username, $user->profile->twitter_username, array('class' => 'twitter-link', 'target' => '_blank')) !!}
								</dd>
							@endif

							@if ($user->profile->github_username)
								<dt>
									GitHub Username
								</dt>
								<dd>
									{!! HTML::link('https://github.com/'.$user->profile->github_username, $user->profile->github_username, array('class' => 'github-link', 'target' => '_blank')) !!}
								</dd>
							@endif
						@endif

					</dl>
			</div>
          <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
        </div>
    </div>
</div>
@endsection
