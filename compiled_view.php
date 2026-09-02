<?php $__env->startSection('title', ($article->meta_title ?? $article->title_bn) . ' - ' . config('app.name')); ?>
<?php $__env->startSection('meta_description', $article->meta_description ?? strip_tags(Str::limit($article->excerpt_bn ?? $article->body_bn, 160))); ?>

<?php
    $comments = $article->comments()->whereNull('parent_id')->with(['user', 'replies.user'])->latest()->get();
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($article->title_bn);
?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        
        <aside class="hidden lg:block lg:col-span-1">
            <div class="sticky top-24 flex flex-col items-center gap-3 glass p-2 rounded-full border border-[#e0e0e0] dark:border-[#333] shadow-sm pb-4">
                <span class="text-[9px] font-bold uppercase tracking-widest text-[#999] dark:text-[#777] [writing-mode:vertical-lr] mb-2">শেয়ার</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($shareUrl); ?>" target="_blank" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="ফেসবুকে শেয়ার" aria-label="Share on Facebook">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.35 3.24 9.35 5.47v1.99H7v3.52h2.35V23h5.15V11.01h3.49l.78-3.55z"/></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text=<?php echo e($shareTitle); ?>&url=<?php echo e($shareUrl); ?>" target="_blank" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="টুইটারে শেয়ার" aria-label="Share on Twitter">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.38.1-.77.16-1.18.16-.3 0-.58-.03-.86-.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.47c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
                </a>
                <a href="https://wa.me/?text=<?php echo e($shareUrl); ?>" target="_blank" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="হোয়াটসঅ্যাপে শেয়ার" aria-label="Share on WhatsApp">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 .9-3.4-.2-.4c-.8-1.3-1.3-2.9-1.3-4.5 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5-.1-.1-.7-1.7-1-2.3-.3-.6-.6-.5-.8-.6-.2-.1-.4-.1-.6-.1s-.5.1-.8.4c-.3.3-1 1-1 2.4s1 2.8 1.1 2.9c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                </a>
                <button onclick="navigator.clipboard.writeText(window.location.href);alert('লিংক কপি হয়েছে!')" class="w-9 h-9 bg-[#0d0d0d] dark:bg-[#333] text-white hover:bg-[#E02020] dark:hover:bg-[#E02020] flex items-center justify-center transition-colors rounded-full" title="লিংক কপি" aria-label="Copy Link">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </button>
            </div>
        </aside>

        
        <article class="lg:col-span-8 xl:col-span-7">
            
            <nav class="text-xs text-[#999] dark:text-[#777] mb-4 flex items-center gap-2" aria-label="Breadcrumb">
                <a href="/" class="hover:text-[#0d0d0d] dark:hover:text-white transition">হোম</a>
                <span>/</span>
                <?php if($article->category): ?>
                <a href="<?php echo e(route('article.category', $article->category->slug)); ?>" class="hover:text-[#0d0d0d] dark:hover:text-white transition"><?php echo e($article->category->name_bn); ?></a>
                <?php endif; ?>
            </nav>

            
            <?php if($article->category): ?>
            <span class="text-[9px] font-bold uppercase tracking-widest text-[#E02020]"><?php echo e($article->category->name_bn); ?></span>
            <?php endif; ?>

            
            <h1 class="font-serif text-3xl lg:text-4xl font-bold leading-tight mt-2 mb-3"><?php echo e($article->title_bn); ?></h1>

            
            <?php if($article->excerpt_bn): ?>
            <p class="text-lg text-[#666] dark:text-[#999] leading-relaxed mb-4"><?php echo e($article->excerpt_bn); ?></p>
            <?php endif; ?>

            
            <div class="flex flex-wrap items-center gap-3 text-sm text-[#999] dark:text-[#777] mb-6 pb-5 border-b border-[#e0e0e0] dark:border-[#333]">
                <?php if($article->staffs->isNotEmpty()): ?>
                <span class="font-semibold text-[#1a1a1a] dark:text-white">
                    <?php $__currentLoopData = $article->staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if($i>0): ?>, <?php endif; ?><a href="<?php echo e(route('staff.articles', $s)); ?>" class="hover:text-[#E02020] transition"><?php echo e($s->name_bn); ?></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
                <?php if($article->staffs->first()->designation_bn): ?>
                <span class="text-xs"><?php echo e($article->staffs->first()->designation_bn); ?></span>
                <?php endif; ?>
                <span aria-hidden="true">•</span>
                <?php elseif($article->author): ?>
                <span class="font-semibold text-[#1a1a1a] dark:text-white"><?php echo e($article->author->name); ?></span>
                <span aria-hidden="true">•</span>
                <?php endif; ?>
                <time datetime="<?php echo e($article->published_at?->toIso8601String()); ?>"><?php echo e($article->published_at?->format('d F Y, h:i A')); ?></time>
                <?php if($article->reading_time_minutes): ?>
                <span aria-hidden="true">•</span>
                <span><?php echo e($article->reading_time_minutes); ?> মিনিট পড়া</span>
                <?php endif; ?>
                <button type="button" id="focusModeToggle" class="ml-auto text-xs font-bold uppercase tracking-widest text-[#E02020] hover:text-[#0d0d0d] dark:hover:text-white transition flex items-center gap-1 no-print">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    ফোকাস মোড
                </button>
            </div>

            
            <?php if($article->has_video): ?>
            <figure class="mb-6">
                <div class="aspect-[16/9] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden">
                    <iframe src="<?php echo e($article->youTubeEmbed); ?>?autoplay=0&rel=0" title="<?php echo e($article->title_bn); ?>"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        class="w-full h-full"></iframe>
                </div>
                <?php if($article->featured_image_caption): ?>
                <figcaption class="text-xs text-[#999] dark:text-[#777] mt-2"><?php echo e($article->featured_image_caption); ?></figcaption>
                <?php endif; ?>
            </figure>
            <?php elseif($article->featured_image): ?>
            <figure class="mb-6">
                <div class="aspect-[16/9] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden">
                    <img src="<?php echo e($article->featured_image); ?>" alt="<?php echo e($article->title_bn); ?>" class="w-full h-full object-cover">
                </div>
                <?php if($article->featured_image_caption): ?>
                <figcaption class="text-xs text-[#999] dark:text-[#777] mt-2"><?php echo e($article->featured_image_caption); ?>

                    <?php if($article->photo_credit): ?>
                    <span class="italic">ছবি: <?php echo e($article->photo_credit); ?></span>
                    <?php endif; ?>
                </figcaption>
                <?php endif; ?>
            </figure>
            <?php endif; ?>

            <?php echo $__env->make('partials.ads.article-top', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <div class="article-body">
                <?php echo $article->body_bn; ?>

            </div>

            <?php echo $__env->make('partials.ads.article-bottom', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <?php if($article->tags->isNotEmpty()): ?>
            <div class="flex flex-wrap gap-2 mt-8 pt-5 border-t border-[#e0e0e0] dark:border-[#333]">
                <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="text-xs bg-[#f5f5f5] dark:bg-[#2a2a2a] text-[#666] dark:text-[#aaa] px-3 py-1.5 leading-none"><?php echo e($tag->tag); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            
            <div class="flex items-center gap-2 mt-8 pt-5 border-t border-[#e0e0e0] dark:border-[#333] lg:hidden no-print">
                <span class="text-[9px] font-bold uppercase tracking-widest text-[#999] dark:text-[#777] mr-1">শেয়ার</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($shareUrl); ?>" target="_blank" class="bg-[#0d0d0d] dark:bg-[#333] text-white px-3 py-2 text-xs font-medium hover:opacity-80 transition">ফেসবুক</a>
                <a href="https://wa.me/?text=<?php echo e($shareUrl); ?>" target="_blank" class="bg-[#0d0d0d] dark:bg-[#333] text-white px-3 py-2 text-xs font-medium hover:opacity-80 transition">হোয়াটসঅ্যাপ</a>
                <button onclick="navigator.clipboard.writeText(window.location.href);alert('লিংক কপি হয়েছে!')" class="bg-[#0d0d0d] dark:bg-[#333] text-white px-3 py-2 text-xs font-medium hover:opacity-80 transition">লিংক কপি</button>
                <button onclick="window.print()" class="text-xs text-[#666] dark:text-[#999] hover:text-[#0d0d0d] dark:hover:text-white transition ml-auto">প্রিন্ট</button>
            </div>
        </article>

        
        <aside class="hidden xl:block xl:col-span-1">
            <div id="toc-container" class="sticky top-24 hidden no-print transition-opacity duration-300">
                <p class="text-[10px] font-bold uppercase tracking-widest text-[#999] dark:text-[#777] mb-3 border-b border-[#e0e0e0] dark:border-[#333] pb-2">সূচিপত্র</p>
                <ul id="toc-list" class="space-y-2.5 text-sm text-[#666] dark:text-[#aaa]"></ul>
            </div>
        </aside>
    </div>
</div>


<section class="max-w-7xl mx-auto px-4 mt-12 no-print" id="comments">
    <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        <div class="lg:col-span-8 xl:col-span-7 lg:col-start-2">
            <div class="section-rule">
                <h2 class="section-label">মন্তব্য</h2>

                <?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('comments.store')); ?>" class="mb-8">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="article_id" value="<?php echo e($article->id); ?>">
                    <textarea name="body" rows="3" required placeholder="আপনার মন্তব্য লিখুন..."
                        class="w-full border border-[#e0e0e0] dark:border-[#444] dark:bg-[#2a2a2a] dark:text-[#e0e0e0] px-4 py-3 text-sm focus:outline-none focus:border-[#0d0d0d] dark:focus:border-[#888]"></textarea>
                    <button type="submit" class="mt-3 bg-[#0d0d0d] dark:bg-[#333] text-white px-6 py-2.5 text-sm font-medium hover:bg-black/80 dark:hover:bg-[#444] transition">
                        মন্তব্য করুন
                    </button>
                </form>
                <?php else: ?>
                <div class="bg-[#f5f5f5] dark:bg-[#1e1e1e] border border-[#e0e0e0] dark:border-[#333] p-5 text-center mb-8">
                    <p class="text-sm text-[#666] dark:text-[#999]">মন্তব্য করতে <a href="<?php echo e(route('login')); ?>" class="text-[#E02020] hover:underline font-medium">লগইন</a> করুন।</p>
                </div>
                <?php endif; ?>

                <div class="space-y-0">
                    <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="py-5 <?php echo e(!$loop->last ? 'border-b border-[#e0e0e0] dark:border-[#333]' : ''); ?>">
                        <div class="flex items-center gap-3 mb-1.5">
                            <div class="w-8 h-8 bg-[#0d0d0d] dark:bg-[#333] text-white text-xs font-bold flex items-center justify-center rounded-full shrink-0">
                                <?php echo e(strtoupper(substr($comment->user?->name ?? '?', 0, 1))); ?>

                            </div>
                            <div>
                                <span class="text-sm font-semibold"><?php echo e($comment->user?->name); ?></span>
                                <span class="text-xs text-[#999] dark:text-[#777] ml-2"><?php echo e($comment->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                        <p class="text-sm leading-relaxed text-[#333] dark:text-[#ccc] pl-11"><?php echo e($comment->body); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="py-12 text-center flex flex-col items-center justify-center">
                        <svg class="h-16 w-16 text-[#e0e0e0] dark:text-[#333] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p class="text-[15px] font-semibold text-[#666] dark:text-[#aaa]">এখনো কোনো মন্তব্য নেই</p>
                        <p class="text-xs text-[#999] dark:text-[#777] mt-1">প্রথম মন্তব্য করে আলোচনা শুরু করুন!</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php if($related->isNotEmpty()): ?>
<section class="max-w-7xl mx-auto px-4 mt-12 mb-8 section-rule no-print">
    <h2 class="section-label">সংশ্লিষ্ট সংবাদ</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('article.show', $story->slug)); ?>" class="group">
            <div class="aspect-[16/9] bg-[#0d0d0d] dark:bg-[#1a1a1a] overflow-hidden relative mb-3">
                <?php if($story->has_video): ?>
                <?php echo $__env->make('partials.youtube-embed', ['videoUrl' => $story->video_url, 'mode' => 'thumb'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php elseif($story->featured_image): ?>
                <img src="<?php echo e($story->featured_image); ?>" alt="" loading="lazy" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                <?php endif; ?>
            </div>
            <h3 class="font-serif text-lg font-bold leading-snug group-hover:text-[#E02020] transition-colors">
                <?php echo e($story->title_bn); ?>

            </h3>
            <p class="text-xs text-[#999] dark:text-[#777] mt-1"><?php echo e($story->published_at?->diffForHumans()); ?></p>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>

<script type="application/ld+json">
{
  "<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "<?php echo e($article->title_bn); ?>",
  "image": [
    "<?php echo e($article->featured_image ?? url('/')); ?>"
  ],
  "datePublished": "<?php echo e($article->published_at?->toIso8601String()); ?>",
  "dateModified": "<?php echo e($article->updated_at?->toIso8601String()); ?>",
  "author": [{
      "@type": "Person",
      "name": "<?php echo e($article->staffs->isNotEmpty() ? $article->staffs->first()->name_bn : ($article->author?->name ?? 'PEN News')); ?>"
  }]
}
</script>

<div id="reading-progress"></div>
<div id="lightbox" class="lightbox-overlay">
    <img id="lightbox-img" class="lightbox-img" src="" alt="Zoomed image">
</div>

<script>
    // Reading Progress
    window.addEventListener('scroll', function() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        var progressBar = document.getElementById('reading-progress');
        if (progressBar) {
            progressBar.style.width = scrolled + '%';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Dynamic Table of Contents
        const articleBody = document.querySelector('.article-body');
        const tocContainer = document.getElementById('toc-container');
        const tocList = document.getElementById('toc-list');
        
        if (articleBody && tocContainer && tocList) {
            const headings = articleBody.querySelectorAll('h2, h3');
            if (headings.length > 0) {
                tocContainer.classList.remove('hidden');
                headings.forEach((heading, index) => {
                    const id = 'heading-' + index;
                    heading.id = id;
                    const li = document.createElement('li');
                    li.className = heading.tagName === 'H3' ? 'ml-4 text-xs' : 'font-semibold text-[#1a1a1a] dark:text-white';
                    const a = document.createElement('a');
                    a.href = '#' + id;
                    a.className = 'hover:text-[#E02020] transition-colors';
                    a.innerText = heading.innerText;
                    li.appendChild(a);
                    tocList.appendChild(li);
                });
            }
        }

        // Focus Mode Toggle
        const focusToggle = document.getElementById('focusModeToggle');
        if (focusToggle) {
            focusToggle.addEventListener('click', function() {
                document.body.classList.toggle('focus-mode');
                if (document.body.classList.contains('focus-mode')) {
                    focusToggle.innerHTML = '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg> ফোকাস বন্ধ';
                } else {
                    focusToggle.innerHTML = '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> ফোকাস মোড';
                }
            });
        }

        // Image Lightbox
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        if (articleBody && lightbox && lightboxImg) {
            const images = articleBody.querySelectorAll('img');
            images.forEach(img => {
                img.addEventListener('click', function() {
                    lightboxImg.src = this.src;
                    lightbox.classList.add('active');
                    document.body.classList.add('lightbox-active');
                });
            });

            lightbox.addEventListener('click', function() {
                lightbox.classList.remove('active');
                document.body.classList.remove('lightbox-active');
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>