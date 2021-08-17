@foreach ($categories as $category)
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
    <label class="mt-auto mb-auto">
        {{ str_repeat('-', $count). ' ' .$category->title }}
    </label>
    <div>
        <!-- detail -->
        @can('category_detail')
            <a href="{{ route('categories.show',['category' => $category]) }}" class="btn btn-sm btn-primary" role="button">
                <i class="fas fa-eye"></i>
            </a>
        @endcan
        <!-- edit -->
        @can('category_update')
            <a href="{{ route('categories.edit', ['category' => $category]) }}" class="btn btn-sm btn-info" role="button">
                <i class="fas fa-edit"></i>
            </a>
        @endcan
        <!-- delete -->
        @can('category_delete')
            <form class="d-inline" action="{{ route('categories.destroy', ['category' => $category]) }}" role="alert" method="POST" 
                alert-title="{{ trans('categories.alert.delete.title') }}" 
                alert-text="{{ trans('categories.alert.delete.message.confirm',['title' => $category->title]) }}" 
                alert-btn-cancel="{{ trans('categories.button.cancel.value') }}" 
                alert-btn-yes="{{ trans('categories.button.delete.value') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        @endcan
    </div>
    @if ($category->descendants)
        @include('categories._category-list', ['categories' => $category->descendants, 'count' => $count + 1])
    @endif
    </li>
@endforeach