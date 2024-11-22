<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;
use App\Models\Home_slider;
use App\Models\Home_events;
use App\Models\Page;
use App\Models\Volunteering_destination;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    use DataFormController;

    public function welcome() {
        return view('admin.dashboard.welcome');
    }
    public function getIndex() {
        $slider_slides = Home_slider::all();
        return view('admin.dashboard.home')->with(compact('slider_slides'));
    }

    public function getSliderImages() {
        $slider_slides = Home_slider::orderby('sort', 'asc')->get();
        return $this->jsondata(true, 'Success', [], $slider_slides);
    }

    public function addImageToSlider (Request $request) {
        $validator = Validator::make($request->all(), [
            'slide_path' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $create_slide = Home_slider::create([
            "slide_path" => $request->slide_path,
            "sort" => Home_slider::orderBy('sort', 'desc')->first() ? Home_slider::orderBy('sort', 'desc')->first()->sort + 1 : 1
        ]);
        if ($create_slide)
            return $this->jsondata(true, 'Success', [], []);
    }

    public function deleteImgFromSlider (Request $request) {
        $validator = Validator::make($request->all(), [
            'slide_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $slide = Home_slider::find($request->slide_id);
        $slide->delete();
        if ($slide)
            return $this->jsondata(true, 'Success', [], []);
    }

    public function changeSlideSort (Request $request) {
        $validator = Validator::make($request->all(), [
            'slide_id' => ['required'],
            'dir' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $slide = Home_slider::find($request->slide_id);
        $prevSlide = Home_slider::where('sort', '<', $slide->sort)
                    ->orderBy('sort', 'desc')
                    ->first();
        $nextSlide = Home_slider::where('sort', '>', $slide->sort)
                    ->orderBy('sort', 'desc')
                    ->first();

        if ($request->dir == "prev" && $prevSlide):
            $sort = $prevSlide->sort;
            $prevSlide->sort = $slide->sort;
            $prevSlide->save();
            $slide->sort = $sort;
            $slide->save();
        elseif ($request->dir == "next" && $nextSlide):
            $sort = $nextSlide->sort;
            $nextSlide->sort = $slide->sort;
            $nextSlide->save();
            $slide->sort = $sort;
            $slide->save();
        endif;

        if ($slide)
            return $this->jsondata(true, 'Success', [], []);
    }

    public function getEventsImages() {
        $latest_events_imgs = Home_events::orderby('sort', 'asc')->get();
        return $this->jsondata(true, 'Success', [], $latest_events_imgs);
    }

    public function addImageToEvents (Request $request) {
        $validator = Validator::make($request->all(), [
            'slide_path' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $create_slide = Home_events::create([
            "slide_path" => $request->slide_path,
            "sort" => Home_events::orderBy('sort', 'desc')->first() ? Home_events::orderBy('sort', 'desc')->first()->sort + 1 : 1
        ]);
        if ($create_slide)
            return $this->jsondata(true, 'Success', [], []);
    }

    public function deleteImgFromEvents (Request $request) {
        $validator = Validator::make($request->all(), [
            'slide_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $slide = Home_events::find($request->slide_id);
        $slide->delete();
        if ($slide)
            return $this->jsondata(true, 'Success', [], []);
    }

    public function changeEventsSort (Request $request) {
        $validator = Validator::make($request->all(), [
            'slide_id' => ['required'],
            'dir' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $slide = Home_events::find($request->slide_id);
        $prevSlide = Home_events::where('sort', '<', $slide->sort)
                    ->orderBy('sort', 'desc')
                    ->first();
        $nextSlide = Home_events::where('sort', '>', $slide->sort)
                    ->orderBy('sort', 'desc')
                    ->first();

        if ($request->dir == "prev" && $prevSlide):
            $sort = $prevSlide->sort;
            $prevSlide->sort = $slide->sort;
            $prevSlide->save();
            $slide->sort = $sort;
            $slide->save();
        elseif ($request->dir == "next" && $nextSlide):
            $sort = $nextSlide->sort;
            $nextSlide->sort = $slide->sort;
            $nextSlide->save();
            $slide->sort = $sort;
            $slide->save();
        endif;

        if ($slide)
            return $this->jsondata(true, 'Success', [], []);
    }
}
