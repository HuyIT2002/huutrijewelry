@foreach ($categories as $child)
<option value="{{ $child->category_id }}">
    {{ str_repeat('— ', $level) . $child->category_name }}
</option>
@if ($child->children && $child->children->count())
@include('admin.partials.category-options', ['categories' => $child->children, 'level' => $level + 1])
@endif
@endforeach