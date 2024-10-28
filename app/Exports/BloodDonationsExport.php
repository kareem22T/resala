<?php

namespace App\Exports;

use App\Models\BloodDonate;
use App\Models\Volunteer;
use Maatwebsite\Excel\Concerns\FromCollection;

class BloodDonationsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $volunteers = BloodDonate::all();
        // Create a collection with the header row
        $data = collect([(object) [
            'name' => 'الاسم',
            'age' => 'العمر',
            'blood_type' => 'فصيلة الدم',
            'address' => 'العنوان',
            'created_at' => 'تاريخ التطوع',
        ]]);

        // Add the volunteers to the collection
        $data = $data->merge($volunteers);

        // Transform the data if needed
        $data = $data->map(function($item) {
            // Use 'toArray' or 'jsonSerialize' if 'only' method is not available
            return collect($item)->only([
                'name',
                'age',
                'blood_type',
                'city',
                'address',
                'created_at',
            ]);
        });

        return $data;

    }
}
