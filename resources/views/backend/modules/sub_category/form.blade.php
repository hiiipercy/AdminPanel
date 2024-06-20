{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control',
    'placeholder' => 'Enter Sub category name',
]) !!}
{!! Form::label('slug', 'Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control', 'placeholder' => 'Enter slug name']) !!}
{!! Form::label('category_id', 'Select category', ['class' => 'mt-2']) !!}
{!! Form::select('category_id', $category, null,['class' => 'form-select', 'placeholder' => 'Select category'] ) !!}
{!! Form::label('order_by', 'Sub category Serial', ['class' => 'mt-2']) !!}
{!! Form::number('order_by', null, ['class' => 'form-control', 'placeholder' => 'Enter Sub category Serial name']) !!}
{!! Form::label('status', 'Sub category status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-select',
    'placeholder' => 'Choose status',
]) !!}
