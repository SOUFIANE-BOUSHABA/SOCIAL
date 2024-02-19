@foreach($users as $user)
<div class="nearby-user">
  <div class="row">
    <div class="col-md-2 col-sm-2">
      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user" class="profile-photo-lg">
    </div>
    <div class="col-md-7 col-sm-7">
      <h5> <a href="{{ route('profil' , $user->id ) }}" class="profile-link">{{ $user->name }}</a></h5>
      <p>Software Engineer</p>
      <p class="text-muted">500m away</p>
    </div>
    <div class="col-md-3 col-sm-3">
                        @if(auth()->user()->id !== $user->id)
                          @if(auth()->user()->followings()->where('users.id', $user->id)->exists())
                              <a href="{{ route('follow.user', $user->id) }}"><button class="btn btn-dark"> unfollow</button></a>
                          @else  
                              <a href="{{ route('follow.user', $user->id) }}"><button class="btn btn-primary"> + Follow</button></a>
                          @endif
                        @endif  
    </div>
  </div>
</div>
@endforeach