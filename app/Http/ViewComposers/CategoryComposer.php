<?php
namespace App\Http\ViewComposers;

use App\CategoryModel;
use Illuminate\Contracts\View\View;

class CategoryComposer
{
	public function  __construct()
	{
		
	}	
	
	public function compose(View $view)
	{
		$category=CategoryModel::all();
		
		$view->with('category',$category);
	}
}