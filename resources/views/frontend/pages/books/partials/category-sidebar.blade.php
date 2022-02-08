<div class="list-group mt-3">
    @foreach(App\Models\Category::all() as $cat)
        <a href="{{ route('books.show', $cat->slug) }}" class="list-group-item list-group-item-action">
            {{ $cat->name }}
        </a>
    @endforeach
</div>