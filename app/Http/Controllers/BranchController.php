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

    public function getBranchesIndex() {
        $branches = Branch::paginate(20);
        return view('site.branches')->with(compact(['branches']));

    }

    public function index() {
        return view('admin.dashboard.branches_prev');
    }

    public function addIndex() {
        return view('admin.dashboard.branches_add');
    }

    public function editIndex($id) {
        $branch = Branch::find($id);
        return view('admin.dashboard.branches_edit')->with(compact('branch'));
    }

    public function search(Request $request) {
        $locations = Branch::where('location', 'like', '%' . $request->search_words . '%')
                                ->paginate(15);

        $addresses = Branch::where('address', 'like', '%' . $request->search_words . '%')
                                ->paginate(15);

        return $this->jsonData(true, '', [], !$locations->isEmpty() ? $locations : $addresses);

    }

    public function get() {
        $branches = Branch::paginate(15);
        return $this->jsonData(true, '', [], $branches);
    }

    public function getAll() {
        $branches = Branch::all();
        return $this->jsonData(true, '', [], $branches);
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'location' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
        ], [
            'location.required' => 'الموقع مطلوب',
            'address.required' => 'العنوان التفصيلي مطلوب',
            'phone.required' => 'رقم الفرع مطلوب',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل الاضافة', [$validator->errors()->first()], []);
        }

        $branch = Branch::create([
            'location' => $request->location,
            'address' => $request->address,
            'phone' => $request->phone,
            'iframe' => $request->iframe,
        ]);

        if ($branch)
            return $this->jsonData(true, 'تم اضافة الفرع بنجاح', [], []);

    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'location' => ['required'],
            'address' => ['required'],
        ], [
            'location.required' => 'الموقع مطلوب',
            'address.required' => 'العنوان التفصيلي مطلوب',
            'phone.required' => 'رقم الفرع مطلوب',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل التعديل', [$validator->errors()->first()], []);
        }

        $branch = Branch::find($request->id);

        $branch->location = $request->location;
        $branch->address = $request->address;

        $branch->save();

        if ($branch)
            return $this->jsonData(true, 'تم تعديل الفرع بنجاح', [], []);

    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Edit failed', [$validator->errors()->first()], []);
        }

        $branch = Branch::find($request->branch_id);
        $branch->delete();

        if ($branch)
            return $this->jsonData(true, ' تم حذف الفرع بنجاح', [], []);

    }

}
