<?php

namespace Controllers\Products;

use Controllers\PublicController;
use Dao\Productos\Categories as CategoriesDao;
use Views\Renderer;

class CategoriesList extends PublicController
{
    public function run(): void
    {
        $viewData = [];
        $viewData["categories"] = CategoriesDao::getAllCategories();
        Renderer::render("productos/categorieslist", $viewData);
    }
}
