<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\Admin;
use App\Http\Traits\SendEmail;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;

class VolunteersController extends Controller
{
    use SendEmail;
    use DataFormController;

    public function index() {
        return view('site.volunteers.volunteers');
    }

    public function send (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'branch_id' => ['required'],
            'destination_id' => ['required'],
            'dob' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'branch_id.required' => 'برجاء اختيار الفرع المناسب لك',
            'destination_id.required' => 'برجاء اختيار النشاط المناسب لك',
            'city.required' => 'المحافظة مطلوبة',
            'dob.required' => 'تاريخ الميلاد مطلوب',
            'address.required' => 'العنوان مطلوب',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل الارسال', [$validator->errors()->first()], []);
        }

        $volunteer = Volunteer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'branch_id' => $request->branch_id,
            'donation_destination_id' => $request->destination_id,
            'city' => $request->city,
            'dob' => $request->dob,
            'address' => $request->address,
        ]);

        if ($volunteer) {
            $admins = Admin::where('volunteering_access', true)->get();
            if ($admins->count() > 0)
            foreach ($admins as $admin) {
                $this->sendEmail(
                    $admin->email,
                    "Volunteering Request",
                    "<b>اسم المتطوع :</b>" . $volunteer->name . "<br>" .
                    "<b>البريد الالكتروني للمتطوع :</b>" . $volunteer->email . "<br>" .
                    "<b>رقم هاتف المتطوع :</b>" . $volunteer->phone . "<br>" .
                    "<b>محافظة المتطوع :</b>" . $volunteer->city . "<br>" .
                    "<b>تاريخ ميلاد المتطوع :</b>" . $volunteer->dob . "<br>" .
                    "<b>عنوان المتطوع :</b>" . $volunteer->address . "<br>" .
                    "<b>فرع التطوع :</b>" . $volunteer->branch->location . "<br>" .
                    "<b>جهة التطوع :</b>" . $volunteer->destination->title . "<br>"
                );
            }
            return $this->jsonData(true, 'تم ارسال طلبك بنجاح, سوف نتواصل معك في اقرب وقت!', [], []);
        }
    }

    //dashboard
    public function dashboardIndex() {
        return view('admin.dashboard.volunteers');
    }

    public function get() {
        $volunteers = Volunteer::with('branch')->with('destination')->orderby('id', 'desc')->paginate(10);
        return $this->jsonData(true, '', [], $volunteers);
    }
    public function getUnseen() {
        $donations = Volunteer::with('branch')->with('destination')->where('seen_by_an_admin', false)->orderby('id', 'desc')->paginate(10);
        return $this->jsonData(true, '', [], $donations);
    }

    public function see() {
        $donations = Volunteer::with('branch')->with('destination')->where('seen_by_an_admin', false)->orderby('id', 'desc')->paginate(10);
        foreach ($donations as $donation) {
            $donation->seen_by_an_admin = true;
            $donation->save();
        }
    }

    public function search(Request $request) {
        $names = Volunteer::with('branch')->with('destination')->where('name', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);

        $addresses = Volunteer::with('branch')->with('destination')->where('address', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);

        $phones = Volunteer::with('branch')->with('destination')->where('phone', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);

        
        return $this->jsonData(true, '', [], !$names->isEmpty() ? $names : (!$addresses->isEmpty() ? $addresses : $phones));

    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'volunteer_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Edit failed', [$validator->errors()->first()], []);
        }

        $volunteer = Volunteer::find($request->volunteer_id);
        $volunteer->delete();

        if ($volunteer)
            return $this->jsonData(true, ' تم حذف الطلب بنجاح', [], []);
    }
}
