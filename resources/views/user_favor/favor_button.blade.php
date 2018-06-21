@if (Auth::user()->is_favoring($micropost->id))
        {!! Form::open(['route' => ['user.unfavor', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavor', ['class' => "btn btn-danger btn-xs"]) !!}
        {!! Form::close() !!}
@else
        {!! Form::open(['route' => ['user.favor', $micropost->id]]) !!}
            {!! Form::submit('Favor', ['class' => "btn btn-primary btn-xs"]) !!}
        {!! Form::close() !!}
@endif
