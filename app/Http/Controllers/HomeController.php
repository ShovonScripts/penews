<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Setting;
use App\Models\PageView;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(): View
    {
        $categoryIds = Category::where('is_active', true)->orderBy('order')->pluck('id');

        $latestPublished = Article::where('status', 'published')
            ->whereIn('category_id', $categoryIds)
            ->select('id', 'category_id', 'title_bn', 'slug', 'excerpt_bn', 'body_bn', 'featured_image', 'video_url', 'is_editor_pick', 'published_at')
            ->with('staffs:id,name_bn')
            ->latest('published_at')
            ->get()
            ->groupBy('category_id');

        $categories = Category::whereIn('id', $categoryIds)->orderBy('order')->get()->map(function ($cat) use ($latestPublished) {
            $cat->articles = $latestPublished->get($cat->id, collect())->take(4);
            return $cat;
        })->filter(fn($c) => $c->articles->isNotEmpty());

        $leadStory = Article::where('status', 'published')
            ->where('is_editor_pick', true)
            ->with(['author:id,name', 'category', 'district', 'staffs'])
            ->latest('published_at')
            ->first()
            ?? Article::where('status', 'published')
                ->with(['author:id,name', 'category', 'staffs'])
                ->latest('published_at')
                ->first();

        $featuredStories = Article::where('status', 'published')
            ->where('is_featured', true)
            ->where('id', '!=', $leadStory?->id)
            ->with(['category', 'staffs'])
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($featuredStories->isEmpty()) {
            $featuredStories = Article::where('status', 'published')
                ->where('id', '!=', $leadStory?->id)
                ->with(['category', 'staffs'])
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        $sliderArticles = Article::where('status', 'published')
            ->where('is_slider', true)
            ->with(['category', 'staffs'])
            ->orderBy('slider_order')
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        $breakingStories = Article::where('status', 'published')
            ->where('is_breaking', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        $mostRead = Article::where('status', 'published')
            ->with(['category', 'staffs'])
            ->withCount('pageViews')
            ->orderBy('page_views_count', 'desc')
            ->take(5)
            ->get();

        $editorPicks = Article::where('status', 'published')
            ->where('is_editor_pick', true)
            ->where('id', '!=', $leadStory?->id)
            ->with(['staffs'])
            ->latest('published_at')
            ->take(4)
            ->get();

        $facebookUrl = Setting::get('social_facebook', 'https://www.facebook.com/PENNewsBD');

        return view('home', compact(
            'categories', 'leadStory', 'featuredStories',
            'breakingStories', 'mostRead', 'editorPicks',
            'sliderArticles', 'facebookUrl'
        ));
    }
}
