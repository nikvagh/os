<div class="profile-tab-cont edit-profile-cont">
    <h2>Edit Profile</h2>
    <div class="profile-tab-desc">

        <!-- <div class="profile-img">
            <a href="#" class="edit-p-img">
                <div class="form-group">
                    <span class="edit-photo-title">
                        <i class="fas fa-pen"></i>
                        <span>edit photo</span>
                    </span>
                    <div class="img-picker"></div>
                </div>
            </a>
        </div> -->
        <style> 
            .img-label-round{
                @if($profile->image == "")
                    background: #026772; 
                @else  
                    background-image: url('{{ $profile->image }}');  
                    background-size: cover;
                @endif"
            }
        </style>

        <label class="text-center img-label-round" style="">
            <!-- <img id="blah" src="#" alt="" style="width: 100%;height: 100%;position: absolute;left:0;top:0"> -->
            <div class="inner-div">
                <i class="fas fa-pen"></i>
                <br/>
                <span>Edit Photo</span>
            </div>
            <input type="file" name="profile_pic" id="profile_pic"/>
        </label>

        <div class="profile-name">
            <h6>Name</h6>
            <input type="text" name="name" id="name" value="{{ $profile->name }}">
        </div>
    </div>
    <div class="profile-detail">
        <form>
            <ul>
                <li>
                    <h6>Address</h6>
                    <input type="text" name="address" id="address" value="">
                </li>
                <!-- <li>
                    <h6>area</h6>
                    <input type="text" name="area" id="area" value="">
                </li> -->
                <!-- <li>
                    <div class="cont-main-detail">
                        <h6>Contact Number</h6>
                        <div class="tel-cont">
                            <input class="tel-code" name="code" id="code" type="tel" value="+91">
                            <input class="tel-number" name="mobile" id="mobile" type="tel" value="{{ $profile->mobile }}">
                        </div>
                    </div>
                </li> -->
                <li>
                    <div class="cont-main-detail">
                        <h6>Contact Number</h6>
                        <!-- <div class="tel-cont"> -->
                            <input class="tel-number" name="mobile" id="mobile" type="tel" value="{{ $profile->mobile }}">
                        <!-- </div> -->
                    </div>
                </li>
                <li>
                    <h6>Email</h6>
                    <input type="email" name="email" id="email" value="{{ $profile->email }}">
                </li>
            </ul>
            <div class="edit-save">
                <button type="submit" class="btn btn-style" id="profile-save-btn">save</a>
            </div>
        </form>
    </div>
</div>