<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Admin;
use App\Http\Traits\SendEmail;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    use DataFormController;

    public function index() {
        return view('admin.dashboard.branches_prev');
    }

    public function addIndex() {
        return view('admin.dashboard.branches_add');
    }

    public function get() {
        $branches = Branch::orderby('id', 'desc')->paginate(10);
        return $this->jsonData(true, '', [], $branches);
    }

    public function delete() {
        
    }

}
