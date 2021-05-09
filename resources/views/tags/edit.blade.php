@extends('layouts.dashboard')

@section('title')
    {{ trans('tags.title.edit') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_tags', $tag) }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('tags.update', ['tag' =>$tag]) }}" method="POST">
                @csrf
                @method('PUT')

           <!-- title -->
                <div class="form-group">
                   <label for="input_tag_title" class="font-weight-bold">
                      {{ trans('tags.form_control.input.title.label')}}
                   </label>
                   <input id="input_tag_title" value="{{ old('title', $tag->title) }}" name="title" type="text"
                      class="form-control  @error('title') is-invalid @enderror"
                      placeholder="{{ trans('tags.form_control.input.title.placeholder')}}" />
                      @error('title')
                          <span class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                </div>
                <!-- slug -->
                <div class="form-group">
                   <label for="input_tag_slug" class="font-weight-bold">
                    {{ trans('tags.form_control.input.slug.label')}}
                   </label>
                   <input id="input_tag_slug" value="{{ old('slug',$tag->slug) }}" name="slug" type="text"
                      class="form-control @error('slug') is-invalid @enderror"
                      placeholder="{{ trans('tags.form_control.input.slug.placeholder')}}" readonly />
                      @error('slug')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                </div>
                <button type="submit" class="btn btn-primary float-right px-4">
                    {{ trans('tags.button.edit.value')}}
                </button>
             </form>
          </div>
       </div>
    </div>
</div>
@endsection

@push('javascript-internal')
    <script>
        $(document).ready(function() {
            const generateSlug = (value) => {
            return value.trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, '-')
                .replace(/-+/g, '-').replace(/^-|-$/g, "")
            }

            $("#input_tag_title").change(function(even){
                $('#input_tag_slug').val(generateSlug(even.target.value))
            });
        });
    </script>
@endpush