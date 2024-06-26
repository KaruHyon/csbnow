<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Sections;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Load your objects
        //$user = Article::byDepartment('Loans')->get();

        $subjects = Courses::all();
        $sections = Sections::all();
        

        // Make it available to all views by sharing it
        //view()->share('loans_articles', $loans_articles);
        view()->share(['subjects' => $subjects, 'sections' => $sections]);
        
    }
}
