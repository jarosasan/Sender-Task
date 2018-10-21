<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('menu.create', $day = 0)}}">Monday</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('menu.create', $day = 1)}}">Tuesday</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('menu.create', $day = 2)}}">Wednesday</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{route('menu.create', $day = 3)}}">Thursday</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{route('menu.create', $day = 4)}}">Fridai</a>
        </li>
    </ul>
</div>
{{--<a class="nav-link" name="{{$city->name}}"  href="{{route("show", $city->name)}}" role="tab" aria-selected="">{{$city->name}}</a>--}}
