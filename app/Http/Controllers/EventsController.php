<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    use DataFormController;

    public function index() {
        return view('admin.dashboard.event_prev');
    }

    public function eventIndex(Events $event) {

        return view('site.event', compact('event'));
    }

    public function getEvents() {
        $events = Events::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->paginate(10);
        return $this->jsonData(true, '', [], $events);
    }

    public function search(Request $request) {
        $byTitles = Events::where('title', 'like', '%' . $request->search_words . '%')->paginate(10);
        $contents = Events::where('content', 'like', '%' . $request->search_words . '%')->paginate(10);

        return $this->jsonData(true, '', [], !$byTitles->isEmpty() ? $byTitles : $contents);
    }

    public function addIndex() {
        return view('admin.dashboard.event_add');
    }

    public function put(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
            'intro' => ['required'],
            'thumbnail_path' => ['required'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date', 'after_or_equal:date_from'],
        ], [
            'title.required' => 'عنوان الحدث مطلوب',
            'content.required' => 'المحتوى مطلوب',
            'intro.required' => 'المقدمة مطلوب',
            'thumbnail_path.required' => 'قم باختيار صورة مصغرة',
            'date_from.required' => 'تاريخ البدء مطلوب',
            'date_to.required' => 'تاريخ الانتهاء مطلوب',
            'created_at.required' => 'قم باختيار تاريخ نشر الحدث',
            'date_to.after_or_equal' => 'يجب أن يكون تاريخ الانتهاء بعد أو يساوي تاريخ البدء',
        ]);

        if ($validator->fails()) {
            return $this->jsonData(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $createEvent = Events::create([
            'author_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'intro' => $request->intro,
            'thumbnail_path' => $request->thumbnail_path,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
        ]);

        if ($createEvent)
            return $this->jsonData(true, 'تم اضافة الحدث بنجاح', [], []);
    }

    public function edit($id) {
        $event = Events::find($id);
        return view('admin.dashboard.event_edit')->with(compact('event'));
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'event_id' => ['required'],
            'title' => ['required'],
            'intro' => ['required'],
            'content' => ['required'],
            'thumbnail_path' => ['required'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date', 'after_or_equal:date_from'],
        ], [
            'event_id.required' => 'رقم التعريف للحدث مفقود',
            'title.required' => 'عنوان الحدث مطلوب',
            'intro.required' => 'المقدمة مطلوب',
            'content.required' => 'المحتوى مطلوب',
            'thumbnail_path.required' => 'قم باختيار صورة مصغرة',
            'date_from.required' => 'تاريخ البدء مطلوب',
            'date_to.required' => 'تاريخ الانتهاء مطلوب',
            'created_at.required' => 'قم باختيار تاريخ نشر الحدث',
            'date_to.after_or_equal' => 'يجب أن يكون تاريخ الانتهاء بعد أو يساوي تاريخ البدء',
        ]);

        if ($validator->fails()) {
            return $this->jsonData(false, 'Update failed', [$validator->errors()->first()], []);
        }

        $event = Events::find($request->event_id);
        $event->title = $request->title;
        $event->content = $request->content;
        $event->thumbnail_path = $request->thumbnail_path;
        $event->date_from = $request->date_from;
        $event->date_to = $request->date_to;
        $event->intro = $request->intro;

        $event->save();

        if ($event)
            return $this->jsonData(true, 'تم تعديل الحدث بنجاح', [], []);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsonData(false, 'Delete failed', [$validator->errors()->first()], []);
        }

        $event = Events::find($request->event_id);
        $event->delete();

        if ($event)
            return $this->jsonData(true, 'تم حذف الحدث بنجاح', [], []);
    }

    public function getEventsByMonth(Request $request)
    {
        // Get the current month and year, or use specified month and year
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $day = $request->input('day', null); // Optional day filter

        // Calculate the start and end dates of the month
        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // Get events that overlap with the specified month
        $eventsQuery = Events::where(function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('date_from', [$startOfMonth, $endOfMonth])
                  ->orWhereBetween('date_to', [$startOfMonth, $endOfMonth])
                  ->orWhere(function ($subQuery) use ($startOfMonth, $endOfMonth) {
                      $subQuery->where('date_from', '<', $startOfMonth)
                               ->where('date_to', '>', $endOfMonth);
                  });
        });

        // If a specific day is provided, filter events that include that day
        if ($day) {
            $specificDay = Carbon::createFromDate($year, $month, $day);
            $eventsQuery->where(function ($query) use ($specificDay) {
                $query->where('date_from', '<=', $specificDay)
                      ->where('date_to', '>=', $specificDay);
            });
        }

        // Paginate the results, setting the number of items per page if needed
        $events = $eventsQuery->orderBy('date_from')->paginate(10);

        return view('site.events', compact('events', 'month', 'year'));
    }

    public function searchEventsIndex(Request $request)
    {
        // Get search term and date from the request
        $search = $request->get('search', '');
        $date = $request->get('date');

        // Build the events query
        $eventsQuery = Events::query();

        // Apply date filter if a date is provided
        if (!empty($date)) {
            $eventsQuery->whereDate('date_from', '<=', $date)
                        ->whereDate('date_to', '>=', $date);
        }

        // Apply search filter if a search term is provided
        if (!empty($search)) {
            $eventsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $events = $eventsQuery->orderBy('date_from')->paginate(10)->appends(request()->query());

        // Pass the events to the view
        return view('site.events-search', compact('events', 'search', 'date'));
    }

    public function eventsCalendar() {
        $events = Events::all();
        return view('site.events-calendar', compact('events'));
    }
}
