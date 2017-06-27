@extends('layouts.main')
@section('title')
	itweetup :: Edit Profile
@endsection
@section('content')
	<div class="flex-item userdata-block">
		<div class="box userinfo-tile">
			<form id="upload-photo" data-modal="upload-photo">
				@if($data['user']['profileimage'])
					<a ><img src="../users/{{$data['user']['id']}}/profile.jpg" class="user-photo"></a>
					
				@else
					<a ><img src="../images/blank-profile.png" class="user-photo"></a>
				@endif
			</form>					
			<div class="pad">
				<div class="thick-text">{{$data['user']['name']}}</div>
				<div class="user-motto">{{$data['userprofiles']['motto'] ? $data['userprofiles']['motto'] : 'no motto' }}</div>
				<a href="#">Verify Profile</a>
			</div>
		</div>
		<div class="box pad nav-tile">
			<div class="thick-text">Links</div>
			<ul class="nav-links">
				<li class="nav nav-activity"><a href="#">Activity</a></li>
				<li class="nav nav-message"><a href="#">Message</a></li>
				<li class="nav nav-hangout"><a href="#">Hangout</a></li>
				<li class="nav nav-chat"><a href="#">Chat</a></li>
				<li class="nav nav-matches"><a href="#">Matches</a></li>
				<li class="nav nav-date-alert"><a href="#">Date Alert</a></li>
				<li class="nav nav-dining"><a href="#">Dining</a></li>
				<li class="nav nav-upload-photo"><a href="#">Photos</a></li>
				<li class="nav nav-upload-video"><a href="#">Videos</a></li>
			</ul>
		</div>
	</div>
	
	@yield('centerpane')
	@yield('rightpane')
	<div class="modal-glass hide">
		<div class="modal">
			<div class="modal-heading"></div>
			<div class="modal-body"></div>
			<div class="modal-close"></div>
		</div>
	</div>
	<div class="hide" data-modal-contents-wrap>
		<div data-modal-content="upload-photo">
			<div data-modal-heading>Profile Picture Upload</div>
			<div data-modal-body data-image-upload >
				<form method="POST" action="{{ url('/edit-profile-pic') }}" enctype="multipart/form-data">
					<input type="file" name="profileimage" id="profileimage" />
					<input type="submit" name="editpic" value="Submit"/>
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
@endsection
