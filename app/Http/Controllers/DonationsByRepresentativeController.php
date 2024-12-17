<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation_by_representative;
use App\Models\Admin;
use App\Http\Traits\SendEmail;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Donation_by_representativeExport;

class DonationsByRepresentativeController extends Controller
{
    use SendEmail;
    use DataFormController;

    public function index() {
        return view('site.donate.donate-by-representative');
    }

    public function export() {
        return Excel::download(new Donation_by_representativeExport, 'donations.xlsx');
    }

    public function send (Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => ['required'],
            'name' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
        ], [
            'type.required' => 'قم باختيار نوع التبرع',
            'name.required' => 'الاسم مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'address.required' => 'العنوان مطلوب',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل الارسال', [$validator->errors()->first()], []);
        }

        $donation = Donation_by_representative::create([
            'type' => $request->type,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($donation) {
            return $this->jsonData(true, 'تم ارسال طلبك بنجاح, سوف نتواصل معك في اقرب وقت!', [], []);
        }
    }

    //dashboard
    public function dashboardIndex() {
        return view('admin.dashboard.donate-by-representative');
    }

    public function get() {
        $donations = Donation_by_representative::orderby('id', 'desc')->paginate(10);
        return $this->jsonData(true, '', [], $donations);
    }

    public function getUnseen() {
        $donations = Donation_by_representative::where('seen_by_an_admin', false)->orderby('id', 'desc')->paginate(10);
        return $this->jsonData(true, '', [], $donations);
    }

    public function see() {
        $donations = Donation_by_representative::where('seen_by_an_admin', false)->orderby('id', 'desc')->paginate(10);
        foreach ($donations as $donation) {
            $donation->seen_by_an_admin = true;
            $donation->save();
        }
    }

    public function search(Request $request) {
        $names = Donation_by_representative::where('name', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);

        $addresses = Donation_by_representative::where('address', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);

        $phones = Donation_by_representative::where('phone', 'like', '%' . $request->search_words . '%')->orderby('id', 'desc')
                                ->paginate(10);


        return $this->jsonData(true, '', [], !$names->isEmpty() ? $names : (!$addresses->isEmpty() ? $addresses : $phones));

    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'donation_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Edit failed', [$validator->errors()->first()], []);
        }

        $donation = Donation_by_representative::find($request->donation_id);
        $donation->delete();

        if ($donation)
            return $this->jsonData(true, ' تم حذف الطلب بنجاح', [], []);
    }
}
