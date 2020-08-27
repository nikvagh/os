
@if($type =='valid_err')     
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul>
          <li>{{$message}}</li>
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div> 
@else
    <div class="alert alert-{{$type}} alert-dismissible fade show" role="alert">
      <ul>
          <li>{{$message}}</li>
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>   
@endif

