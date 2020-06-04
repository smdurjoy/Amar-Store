
<div class="form-group">
    <label>Select Category Label</label>
    <select name="parent_id" class="form-control select2" style="width: 100%;" id="parent_id">
        <option value="0">Main Category</option>
        @if(!empty($categoriesArray))
            @foreach($categoriesArray as $category)
                <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                @if(!empty($category['sub_categories']))
                    @foreach($category['sub_categories'] as $subcategory)
                        <option value="{{ $subcategory['id'] }}">&nbsp;&raquo;&nbsp;
                            {{ $subcategory['category_name'] }}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>
