<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

use App\Category;

class CategoryComposer
{
    protected $category;

    public function __construct(Category $category)
    {
        // Dependencies automatically resolved by service container...
        $this->category = $category;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->category->all(['name', 'slug']));
    }
}