<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(): View
    {
        $staffGroups = Staff::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('staff_type');

        $typeLabels = [
            'editor' => 'সম্পাদক',
            'reporter' => 'প্রতিবেদক',
            'columnist' => 'কলামিস্ট',
            'correspondent' => 'জেলা প্রতিবেদক',
            'advisor' => 'উপদেষ্টা',
            'management' => 'ব্যবস্থাপনা',
        ];

        return view('staff.index', compact('staffGroups', 'typeLabels'));
    }

    public function articles(Staff $staff): View
    {
        $articles = $staff->articles()
            ->where('status', 'published')
            ->with(['category', 'staffs'])
            ->latest('published_at')
            ->paginate(12);

        return view('staff.articles', compact('staff', 'articles'));
    }
}
