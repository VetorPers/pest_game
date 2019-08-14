<?php

namespace App\Admin\Controllers;


use App\Grade;
use App\Http\Controllers\Controller;
use App\Record;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

class ChartController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('首页')
            ->body($this->grid());
    }

    protected function grid()
    {
        $record = Record::all();
        $total = $record->count();
        $today = Record::whereDate('created_at', now()->toDateString())->count();
        $grades = Grade::all();

        $all = json_encode([
            $record->where('score', '<', 60)->count(),
            $record->where('score', '>=', 60)->where('score', '<', 70)->count(),
            $record->where('score', '>=', 70)->where('score', '<', 80)->count(),
            $record->where('score', '>=', 80)->count(),
        ]);

        return view('admin.chart', compact('total', 'today', 'grades', 'all'));
    }
}
