<table class="table table-striped">
    <thead>
    <tr>
        <th >Id</th>
        <th >Title</th>
        <th >Category</th>
        <th >Price</th>

    </tr>
    </thead>
    <tbody>
    @foreach($meals as $meal)
        <tr>
            <th>{{$meal->id}}</th>
            <th>{{$meal->title}}</th>
            <th>{{$meal->category->title}}</th>
            <th>{{$meal->price}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
