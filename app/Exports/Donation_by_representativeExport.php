<?php

namespace App\Exports;

use App\Models\Donation_by_representative;
use Maatwebsite\Excel\Concerns\FromCollection;

class Donation_by_representativeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $donations = Donation_by_representative::select('name', 'type', 'phone', 'address', "created_at")->get();

        $donations->each(function ($don) {
            $don->type = $don->type == 1 ? "تبرع عيني" : "تبرع مالي";
        });
        $data = collect([(object) [
            'name'=>  'الاسم',
            'type'=>  'نوع التبرع',
            'phone'=>  'رقم الهاتف',
            'address'=>  'العنوان',
            'created_at'=>  'تاريخ التبرع',
        ]]);

        $data->push($donations);

        return $data;
    }

    public function headings(): array
    {
        // Specify the headers for the first row
        return [
            'الاسم',
            'نوع التبرع',
            'رقم الهاتف',
            'العنوان',
            'تاريخ التبرع',
        ];
    }
}
