		

	@auth
	<div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                @include('auth.login')
            </div>
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="profile-tab">
                @include('auth.register')
            </div>
        </div>
    @endauth