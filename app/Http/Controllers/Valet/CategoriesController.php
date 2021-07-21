<?php

namespace App\Http\Controllers\Valet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Valet\Category\CreateCategoryRequest;
use App\Http\Requests\Valet\Category\DeleteCategoryRequest;
use App\Http\Requests\Valet\Category\UpdateCategoryRequest;
use App\Http\Requests\Valet\Category\ViewCategoryRequest;
use App\Models\Valet\Valet;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getCategoriesList(Valet $valet) {}

    public function getCategory(ViewCategoryRequest $request, Valet $valet) {}

    public function createCategory(CreateCategoryRequest $request, Valet $valet) {}

    public function updateCategory(UpdateCategoryRequest $request, Valet $valet) {}

    public function deleteCategory(DeleteCategoryRequest $request, Valet $valet) {}
}
