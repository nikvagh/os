@php
    $total_page = ceil($total_record/$per_page);
    $prev_page = $curr_page-1;
    $next_page = $curr_page+1;

    $loop_start = 1;
    if($curr_page > 5){
        $loop_start = $curr_page-2;
    }

    $loop_end = $total_page;
    //if($total_page-$curr_page > 2){
    //    $loop_end = $curr_page+2;
    //}

    $total_display = 5;
@endphp

@if($total_page > 1)
    <section class="section-wrap pagination-box">
        <div class="container">
            <div class="col pad-30-0 d-flex justify-content-end">
                <!-- <div class="section-padding"> -->

                    <nav class="">
                        <ul class="pagination">
                            @if($curr_page > 1)
                                <li class="page-item"><a class="page-link" href="{{ url($link_root.'1') }}" rel="next" aria-label="« Previous">‹‹</a></li>
                                <li class="page-item"><a class="page-link" href="{{ url($link_root.$prev_page) }}" rel="next" aria-label="« Previous">‹</a></li>
                            @else
                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous"><span class="page-link" aria-hidden="true">‹‹</span></li>
                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous"><span class="page-link" aria-hidden="true">‹</span></li>
                            @endif
                            
                            @for ($i = $loop_start; $i <= $loop_end; $i++)
                                <li class="page-item @if($i == $curr_page) active @endif"><a class="page-link" href="{{ url($link_root.$i) }}">{{$i}}</a></li>
                                @if($total_display == $i)
                                    @break
                                @endif
                            @endfor

                            @if($curr_page == $total_page)
                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous"><span class="page-link" aria-hidden="true">›</span></li>
                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous"><span class="page-link" aria-hidden="true">››</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ url($link_root.$next_page) }}" rel="next" aria-label="Next »">›</a></li>
                                <li class="page-item"><a class="page-link" href="{{ url($link_root.$total_page) }}" rel="next" aria-label="Next »">››</a></li>
                            @endif
                        </ul>
                    </nav>

                <!-- </div> -->
            </div>
        </div>
    </section>
@endif