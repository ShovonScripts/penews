<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Category;
use App\Models\District;
use App\Models\Staff;
use App\Enums\ArticleStatus;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(private ArticleService $articleService) {}
    public function index(Request $request): View
    {
        $query = Article::with(['author', 'category', 'staff', 'staffs']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->latest()->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        $districts = District::orderBy('name_bn')->get();
        $staff = Staff::where('is_active', true)->orderBy('order')->get();
        return view('admin.articles.create', compact('categories', 'districts', 'staff'));
    }

    public function store(Request $request): RedirectResponse
    {
        $publishedAtRule = ['nullable', 'date'];
        if ($request->status === 'scheduled') {
            $publishedAtRule[] = function ($attribute, $value, $fail) {
                if ($value && \Carbon\Carbon::parse($value)->isPast()) {
                    $fail('নির্ধারিত পোস্টের জন্য সময় ভবিষ্যতের হতে হবে।');
                }
            };
        }

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body_bn' => 'required|string',
            'excerpt_bn' => 'nullable|string',
            'featured_image' => 'nullable|string|max:500',
            'video_url' => 'nullable|string|max:500',
            'status' => ['required', \Illuminate\Validation\Rule::enum(ArticleStatus::class)],
            'published_at' => $publishedAtRule,
            'is_breaking' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_editor_pick' => 'nullable|boolean',
            'district_id' => 'nullable|exists:districts,id',
            'staff_ids' => 'nullable|array',
            'staff_ids.*' => 'exists:staff,id',
            'tags' => 'nullable|string',
        ]);

        $validated['slug'] = $this->articleService->generateUniqueSlug($validated['title_bn']);
        $validated['author_id'] = Auth::id();
        $validated['reading_time_minutes'] = $this->articleService->calculateReadingTime($validated['body_bn']);

        if ($validated['status'] === ArticleStatus::PUBLISHED->value && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        } elseif ($validated['status'] === ArticleStatus::SCHEDULED->value) {
            $validated['published_at'] = $validated['published_at'] ?? now()->addHour();
        }

        $article = Article::create($validated);

        if (!empty($validated['staff_ids'])) {
            $article->staffs()->sync($validated['staff_ids']);
            $article->staff_id = $validated['staff_ids'][0];
            $article->save();
        }

        if (!empty($validated['tags'])) {
            $tags = explode(',', $validated['tags']);
            foreach ($tags as $tag) {
                ArticleTag::create([
                    'article_id' => $article->id,
                    'tag' => trim($tag),
                ]);
            }
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'আর্টিকেল তৈরি করা হয়েছে।');
    }

    public function edit(Article $article): View
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        $districts = District::orderBy('name_bn')->get();
        $staff = Staff::where('is_active', true)->orderBy('order')->get();
        return view('admin.articles.edit', compact('article', 'categories', 'districts', 'staff'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $publishedAtRule = ['nullable', 'date'];
        if ($request->status === 'scheduled') {
            $publishedAtRule[] = function ($attribute, $value, $fail) {
                if ($value && \Carbon\Carbon::parse($value)->isPast()) {
                    $fail('নির্ধারিত পোস্টের জন্য সময় ভবিষ্যতের হতে হবে।');
                }
            };
        }

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body_bn' => 'required|string',
            'excerpt_bn' => 'nullable|string',
            'featured_image' => 'nullable|string|max:500',
            'video_url' => 'nullable|string|max:500',
            'status' => ['required', \Illuminate\Validation\Rule::enum(ArticleStatus::class)],
            'published_at' => $publishedAtRule,
            'is_breaking' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_editor_pick' => 'nullable|boolean',
            'district_id' => 'nullable|exists:districts,id',
            'staff_ids' => 'nullable|array',
            'staff_ids.*' => 'exists:staff,id',
            'tags' => 'nullable|string',
        ]);

        if (empty($article->slug)) {
            $validated['slug'] = $this->articleService->generateUniqueSlug($validated['title_bn'] ?? $article->title_bn, $article->id);
        }

        $validated['reading_time_minutes'] = $this->articleService->calculateReadingTime($validated['body_bn']);

        if ($validated['status'] === ArticleStatus::PUBLISHED->value && !$article->published_at) {
            $validated['published_at'] = now();
        } elseif ($validated['status'] === ArticleStatus::SCHEDULED->value && empty($validated['published_at'])) {
            $validated['published_at'] = now()->addHour();
        }

        $article->update($validated);

        if (isset($validated['staff_ids'])) {
            $article->staffs()->sync($validated['staff_ids']);
            $article->staff_id = !empty($validated['staff_ids']) ? $validated['staff_ids'][0] : null;
            $article->save();
        }

        if (!empty($validated['tags'])) {
            $article->tags()->delete();
            $tags = explode(',', $validated['tags']);
            foreach ($tags as $tag) {
                ArticleTag::create([
                    'article_id' => $article->id,
                    'tag' => trim($tag),
                ]);
            }
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'আর্টিকেল আপডেট করা হয়েছে।');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'আর্টিকেল ডিলিট করা হয়েছে।');
    }
}
