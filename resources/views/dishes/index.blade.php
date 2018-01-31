<ul>
@foreach ($dishes as $dish)
    <li>
        <a href="{{ url('/dishes/' . $dish->id) }}">
            {{ $dish->name }}
        </a>
    </li>
@endforeach
</ul>
