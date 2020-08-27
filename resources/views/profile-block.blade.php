<div class="profile-tab-cont">
    <h2>Profile</h2>
    <div class="profile-tab-desc profile-img-box">
        <div class="profile-img">
            @if($profile->image)
                <a href="#"><img src="{{ $profile->image }}" alt="profile" class="profile-img"></a>
            @else
                <a href="#"><img src="{{ asset('image/avtar.jpg') }}" alt="profile" class="profile-img"></a>
            @endif
        </div>
        <div class="profile-name">
            <h6>Name</h6>
            <span>{{ $profile->name }}</span>
        </div>
    </div>
    <div class="profile-detail">
        <ul>
            <li>
                <h6>Address</h6>
                <span>
                    <!-- @isset($all_address)
                        @foreach($all_address as $key=>$val)
                            {{ $val->address }} {{ $val->address2 }}
                            @break
                        @endforeach
                    @endisset -->
                </span>
            </li>
            <li>
                <div class="area-cont-detail">
                    <!-- <div class="area-cont">
                        <h6>area</h6>
                        <span></span>
                    </div> -->
                    <div class="area-cont">
                        <h6>Contact Number</h6>
                        <span>{{ $profile->mobile }}</span>
                    </div>
                </div>
            </li>
            <li>
                <h6>Email</h6>
                <span>{{ $profile->email }}</span>
            </li>
        </ul>
    </div>
</div>