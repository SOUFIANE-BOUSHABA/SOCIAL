@extends('layouts.app')

@section('content')
<div class="container">
    <input type="search" onkeyup="search()" name="search" id="search" class="form-control mb-4"  placeholder="search">
    <div class="row border d-flex justify-content-center mt-4">
        <div class="col-md-8" id="userssss">
            <div class="people-nearby">
              
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Sophia Page</a></h5>
                    <p>Software Engineer</p>
                    <p class="text-muted">500m away</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Follow +</button>
                  </div>
                </div>
              </div>
             
            </div>
    	</div>
	</div>
</div>


<script>
    function search(){
       
        var valueInput = document.getElementById('search').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("userssss").innerHTML = xhttp.responseText;
            }
        };
        if(valueInput=='') var url = '/SearchUsers/AllUsersSearch';
        else var url = '/SearchUsers/'+valueInput;
        xhttp.open("GET", url, true);
        xhttp.send();  
    }
</script>


@endsection