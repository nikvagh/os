
    @forelse ($serch_data as $key=>$val)
    <ul>
        @foreach ($val->item_data as $key1=>$val1)
            @if ($val->item_type == "disease")
                <li>
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ url('disease_details/' . $val1->_id) }}" class="result_product_img"><img class="header-profile-img" src="{{$val1->dis_image}}" alt=""></a>
                        </div>
                        <div class="col-9">
                            <h6><a href="{{ url('disease_details/' . $val1->_id) }}">{{$val1->dis_name}}</a></h6>
                            @php $lastLetter = urldecode($val1->dis_desc); @endphp
                            <p>{{substr($lastLetter,0,30)}}...</p>
                            <!-- <span class="search_price"><sup>৳</sup>40.0</span> -->
                        </div>
                    </div>
                </li>
            @endif


            @if($val->item_type == "product")
                <li>
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ url('product_details/' . $val1->_id) }}" class="result_product_img"><img class="header-profile-img" src="{{$val1->images[0]->img}}" alt=""></a>
                        </div>
                        <div class="col-9">
                            <h6><a href="{{ url('product_details/' . $val1->_id) }}">{{$val1->prod_name}}</a></h6>
                            @php $lastLetter = urldecode($val1->prod_desc); @endphp
                            <p>{{substr($lastLetter,0,30)}}...</p>
                            <span class="search_price"><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>{{$val1->inventory[0]->price}}</span>
                        </div>
                    </div>
                </li>
            @endif

            @if($val->item_type == "medicine")
                <li>
                    <div class="row">
                        <div class="col-3">
                            @if(!empty($val1->images))
                                <a href="{{ url('medicine_details/' . $val1->_id) }}" class="result_product_img">
                                    <img class="header-profile-img" src="{{$val1->images[0]->img}}" alt="">
                                </a>
                            @endif
                        </div>
                        <div class="col-9">
                            <h6><a href="{{ url('medicine_details/' . $val1->_id) }}">{{$val1->brand_name}}</a></h6>
                            @php $lastLetter = urldecode($val1->description); @endphp
                            <p>{{substr($lastLetter,0,30)}}...</p>
                            <span class="search_price"><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>{{$val1->inventory[0]->price}}</span>
                        </div>
                    </div>
                </li>
            @endif

            
        @endforeach
  
        @empty
            @if(@needle != "")
                <!-- <ul>
                    <li> 
                        <div class="row">
                            <div class="col-12">
                                <i class="fa fa-exclamation-circle"></i> No search result found for <b>"{{$needle}}"</b>
                            </div>
                        </div>
                    </li>
                </ul> -->
            @endif
        @endforelse
    </ul>

