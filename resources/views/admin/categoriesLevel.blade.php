
<div class="form-group">
    <label>Select Category Label</label>
    <select name="parent_id" class="form-control select2" style="width: 100%;" id="parent_id">
        <option value="0" @if(isset($categoryData['parent_id']) && $categoryData['parent_id'] ==0) selected @endif>Main Category</option>
        @if(!empty($getCategories))
            @foreach($getCategories as $category)
                <option value="{{ $category['id'] }}" @if(isset($categoryData['parent_id']) && $categoryData['parent_id'] == $category['id']) selected @endif>{{ $category['category_name'] }}</option>
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
