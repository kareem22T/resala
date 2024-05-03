<?php

namespace App\Exports;

use App\Models\Volunteer;
use Maatwebsite\Excel\Concerns\FromCollection;

class VolunteerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $volunteers = Volunteer::with('branch', 'destination')->get();

        $volunteers->each(function ($vol) {
            // Set the desired properties from the related models
            $vol->branch_location = $vol->branch->location;
            $vol->branch_address = $vol->branch->address;
            $vol->destination_title = $vol->destination->title; // Renamed to 'destination_title' for clarity

            // Unset the foreign key fields to hide them
            unset($vol->branch_id);
            unset($vol->donation_destination_id);
        });

        // Create a collection with the header row
        $data = collect([(object) [
            'name' => 'الاسم',
            'email' => 'البريد الالكتروني',
            'phone' => 'رقم الهاتف',
            'city' => 'المدينة',
            'address' => 'العنوان',
            'dob' => 'تاريخ الميلاد',
            'created_at' => 'تاريخ التطوع',
            'branch_location' => 'مكان فرع التطوع',
            'branch_address' => 'عنوان فرع التطوع',
            'destination_title' => 'وجهة التطوع', // Renamed to match the property set above
        ]]);

        // Add the volunteers to the collection
        $data = $data->merge($volunteers);

        // Transform the data if needed
        $data = $data->map(function($item) {
            // Use 'toArray' or 'jsonSerialize' if 'only' method is not available
            return collect($item)->only([
                'name',
                'email',
                'phone',
                'city',
                'address',
                'dob',
                'created_at',
                'branch_location',
                'branch_address',
                'destination_title', // Use the renamed property
            ]);
        });

        return $data;

    }
}
