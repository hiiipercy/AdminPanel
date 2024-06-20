{!! Form::label('title', 'Title') !!}
{!! Form::text('title', null, [
    'id' => 'title',
    'class' => 'form-control',
    'placeholder' => 'Enter title',
]) !!}

{!! Form::label('slug', 'Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control', 'placeholder' => 'Enter slug name']) !!}
<div class="row">
    <div class="col-md-6">
        {!! Form::label('category_id', 'Select category', ['class' => 'mt-2']) !!}
        {!! Form::select('category_id', $category, null, [
            'id' => 'category_id',
            'class' => 'form-select',
            'placeholder' => 'Select category',
        ]) !!}
    </div>
    <div class="col-md-6">
       {!! Form::label('sub_category_id', 'Select Sub category', ['class' => 'mt-2']) !!}
        <select name="sub_category_id" class="form-select" id="sub_category_id">
            <option selected="selected">Select sub-category</option>
        </select>
    </div>
</div>

{!! Form::label('status', 'Post status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-select',
    'placeholder' => 'Choose status',
]) !!}

{!! Form::label('description', 'Description', ['class' => 'mt-2']) !!}
{!! Form::textarea('description', null, [
    'id' => 'description',
    'class' => 'form-control',
    'placeholder' => 'Enter description',
]) !!}

{!! Form::label('tag_ids', 'Select Tag', ['class' => 'mt-2']) !!}
<br />
<div class="row">
    @foreach ($tag as $row)
        <div class="col-md-4">
            {!! Form::checkbox('tag_ids[]', $row->id, Route::currentRouteName() == 'post.edit' ? in_array($row->id, $select_tags) : false) !!} <span>{{ $row->name }}</span>
        </div>
    @endforeach
</div>

{!! Form::label('image', 'Choose image', ['class' => 'mt-2']) !!}
{!! Form::file('image', ['class' => 'form-control']) !!}
@if(Route::currentRouteName()=='post.edit')
<div class="my-3">
    <img data-src="{{ url('image/post/original/'.$post->image) }}" src="{{ url('image/post/thumb/'.$post->image) }}" alt="{{ $post->title }}"  style="height:70px;">
</div>
@endif





@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
        integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>

        const get_sub_categories = (category_id) => {
            let route_name = '{{ Route::currentRouteName() }}'


            let sub_category_element = $('#sub_category_id')
            sub_category_element.empty()
            let sub_category_select = ''
            if (route_name != 'post.edit'){
                sub_category_select = 'selected'
            }


            sub_category_element.append(`<option ${sub_category_select}>Select sub category</option>`)
            axios.get(window.location.origin + '/admin/get-subcategory/' + category_id).then(res => {


                let sub_categories = res.data
                sub_categories.map((sub_category, index) => {
                    let selected = ''
                    if (route_name == 'post.edit') {
                        let sub_category_id = '{{ $post->sub_category_id ?? null }}'
                        if (sub_category_id == sub_category.id) {
                            selected = 'selected'
                        }
                    }
                    return sub_category_element.append(`<option ${selected} value="${sub_category.id}">${sub_category.name}</option>`)
            })
            })
        }





















        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        $('#category_id').on('change', function() {
            let category_id = $('#category_id').val()
            get_sub_categories(category_id)
        })

        $('#title').on('input', function() {
            let name = $(this).val()
            let slug = name.replaceAll(' ', '-')
            $('#slug').val(slug.toLowerCase());
        })
</script>
    @if( Route::currentRouteName() == 'post.edit')
        <script>
            get_sub_categories('{{ $post->category_id }}')
        </script>  
    @endif
@endpush
