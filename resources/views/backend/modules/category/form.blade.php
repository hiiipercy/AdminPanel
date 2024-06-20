{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control',
    'placeholder' => 'Enter category name',
]) !!}
{!! Form::label('slug', 'Slug', ['class' => 'mt-2']) !!}
{!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control', 'placeholder' => 'Enter slug name']) !!}
{!! Form::label('order_by', 'Category Serial', ['class' => 'mt-2']) !!}
{!! Form::number('order_by', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Serial name']) !!}
{!! Form::label('status', 'Category status', ['class' => 'mt-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-select',
    'placeholder' => 'Choose status',
]) !!}
