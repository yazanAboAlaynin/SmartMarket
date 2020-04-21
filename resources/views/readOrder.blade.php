@foreach($notis as $n)
<li style="padding: 20px;">
    <a href="">
        <h4>
           New Order
            <small><i class="fa fa-clock-o"></i>{{ $n->created_at->diffForHumans() }}</small>
            <br>
        </h4>
        <p>
            show order from <b>Sa</b>
            <small><button class="btn btn-info btn-xs pull-right btn-read" value="{{ $n->user_id }}">Read</button></small>
        </p>
    </a>
</li>

@endforeach
