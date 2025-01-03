<?php

namespace App\Services;

use App\Models\Category;
use App\Models\ParentCategory;

class CategoryService
{
    // Thêm phương thức và logic cho service ở đây
    public function getAllCategoriesData()
    {
        $parentCategories = ParentCategory::with('categories')->get();
        $categories = Category::whereIn('category_id', [1, 2, 3])->get();
        $categories_kimcuong  = Category::whereIn('category_id', [55, 56])->get();

        return compact('parentCategories', 'categories', 'categories_kimcuong');
    }
}
