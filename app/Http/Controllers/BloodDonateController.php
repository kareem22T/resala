<?php

namespace App\Http\Controllers;

use App\Exports\BloodDonationsExport;
use App\Http\Traits\DataFormController;
use App\Http\Traits\SendEmail;
use App\Models\Admin;
use App\Models\BloodDonate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class BloodDonateController extends Controller
{
    use SendEmail;
    use DataFormController;

    public function index() {
        return view('site.blood-donations');
    }

    public function send (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'age' => ['required'],
            'blood_type' => ['required'],
            'address' => ['required'],
        ], [
            'name.required' => 'الاسم مطلوب',
            'age.required' => 'العمر مطلوب',
            'blood_type.required' => 'فصيلة الدم مطلوبة',
            'address.required' => 'العنوان مطلوب',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل الارسال', [$validator->errors()->first()], []);
        }

        $donation = BloodDonate::create([
            'name' => $request->name,
            'age' => $request->age,
            'blood_type' => $request->blood_type,
            'address' => $request->address,
        ]);

        if ($donation) {
            $admins = Admin::where('blood_access', true)->get();
            if ($admins->count() > 0)
            foreach ($admins as $admin) {
                $this->sendEmail(
                    $admin->email,
                    "Blood Donation Request",
                    "<b>اسم المتطوع :</b>" . $donation->name . "<br>" .
                    "<b>عمر المتطوع :</b>" . $donation->age . "<br>" .
                    "<b>عنوان المتطوع :</b>" . $donation->address . "<br>"
                );
            }
            return $this->jsonData(true, 'تم ارسال طلبك بنجاح, سوف نتواصل معك في اقرب وقت!', [], []);
        }
    }

    //dashboard
    public function dashboardIndex() {
        return view('admin.dashboard.blood-donations');
    }

    public function get() {
        $volunteers = BloodDonate::orderby('id', 'desc')->paginate(10);
        return $this->jsonData(true, '', [], $volunteers);
    }
    public function getUnseen() {
        $donations = BloodDonate::where('seen_by_an_admin', false)->orderby('id', 'desc')->paginate(10);
        return $this->jsonData(true, '', [], $donations);
    }

    public function see() {
        $donations = BloodDonate::where('seen_by_an_admin', false)->orderby('id', 'desc')->paginate(10);
        foreach ($donations as $donation) {
            $donation->seen_by_an_admin = true;
            $donation->save();
        }
    }

    public function search(Request $request) {
        $names = BloodDonate::where('name', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);

        $addresses = BloodDonate::where('address', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);

        $phones = BloodDonate::where('blood_type', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);


        return $this->jsonData(true, '', [], !$names->isEmpty() ? $names : (!$addresses->isEmpty() ? $addresses : $phones));

    }

    public function export() {

        return Excel::download(new BloodDonationsExport, 'blood-donations.xlsx');
    }


    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'volunteer_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Edit failed', [$validator->errors()->first()], []);
        }

        $volunteer = BloodDonate::find($request->volunteer_id);
        $volunteer->delete();

        if ($volunteer)
            return $this->jsonData(true, ' تم حذف الطلب بنجاح', [], []);
    }
}
