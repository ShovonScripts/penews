@extends('layouts.admin')
@section('title', 'মিডিয়া লাইব্রেরি')
@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-2">
        <svg class="h-6 w-6 text-[#999]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <h1 class="text-2xl font-bold">মিডিয়া লাইব্রেরি</h1>
    </div>
    <button type="button" onclick="document.getElementById('uploadModal').classList.remove('hidden'); document.body.classList.add('overflow-hidden')" class="btn-primary flex items-center gap-1.5">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
        আপলোড
    </button>
</div>

<div class="flex flex-wrap items-center gap-3 mb-6">
    <a href="{{ route('admin.media.index') }}" class="text-xs px-3 py-1.5 border border-[#e0e0e0] dark:border-[#444] @if(!request('folder')) bg-[#0d0d0d] text-white dark:bg-white dark:text-black @else text-[#666] hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] @endif transition">সবগুলো</a>
    @foreach($folders as $f)
    <a href="{{ route('admin.media.index', ['folder' => $f]) }}" class="text-xs px-3 py-1.5 border border-[#e0e0e0] dark:border-[#444] @if(request('folder') === $f) bg-[#0d0d0d] text-white dark:bg-white dark:text-black @else text-[#666] hover:bg-[#f5f5f5] dark:hover:bg-[#2a2a2a] @endif transition">{{ $f }}</a>
    @endforeach
    @if(request('folder'))
    <a href="{{ route('admin.media.index') }}" class="text-xs px-3 py-1.5 text-red-600 hover:text-red-700 transition">
        <svg class="h-3.5 w-3.5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </a>
    @endif
</div>

@if($media->isEmpty())
<div class="admin-card p-10 text-center">
    <svg class="h-12 w-12 mx-auto mb-3 text-[#ccc] dark:text-[#555]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    <p class="text-sm text-[#999]">কোনো ছবি নেই। প্রথম ছবি আপলোড করুন।</p>
</div>
@else
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
    @foreach($media as $item)
    <div class="admin-card group relative">
        <button type="button" onclick="openViewModal('{{ $item->url }}', '{{ addslashes($item->alt_text ?? $item->name) }}', '{{ $item->file_name }}', '{{ number_format($item->size / 1024, 1) }} KB', '{{ $item->folder }}', '{{ $item->mime_type }}', {{ $item->id }}, '{{ addslashes($item->alt_text) }}', '{{ addslashes($item->credit) }}')" class="block w-full aspect-square overflow-hidden bg-[#f5f5f5] dark:bg-[#2a2a2a] cursor-pointer">
            <img src="{{ $item->url }}" alt="{{ $item->alt_text ?? $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy">
        </button>
        <div class="p-2">
            <p class="text-[11px] truncate">{{ $item->name }}</p>
            <div class="flex items-center gap-1.5 mt-0.5">
                <span class="text-[10px] uppercase px-1 py-0.5 border border-[#e0e0e0] dark:border-[#444]">{{ strtoupper(pathinfo($item->file_name, PATHINFO_EXTENSION)) }}</span>
                <span class="text-[10px] text-[#999]">{{ number_format($item->size / 1024, 1) }} KB</span>
            </div>
        </div>
        <div class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition flex gap-1">
            <button type="button" onclick="event.stopPropagation(); openEditModal({{ $item->id }}, '{{ addslashes($item->alt_text) }}', '{{ addslashes($item->credit) }}')" class="bg-white/90 hover:bg-white dark:bg-[#333]/90 dark:hover:bg-[#444] text-[#0d0d0d] dark:text-[#eee] p-1.5 rounded shadow-sm" title="সম্পাদনা">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <form method="POST" action="{{ route('admin.media.destroy', $item) }}" onsubmit="return confirm('মুছে ফেলবেন?')" class="inline">
                @csrf @method('DELETE')
                <button type="button" onclick="event.stopPropagation(); if(confirm('মুছে ফেলবেন?')){ this.closest('form').submit() }" class="bg-white/90 hover:bg-white dark:bg-[#333]/90 dark:hover:bg-[#444] text-red-600 p-1.5 rounded shadow-sm" title="মুছে ফেলুন">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-6">{{ $media->links() }}</div>
@endif

<div id="uploadModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
    <div class="admin-card w-full max-w-lg mx-4 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold">ছবি আপলোড</h2>
            <button type="button" onclick="closeUploadModal()" class="text-[#999] hover:text-[#0d0d0d] dark:hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">ছবি নির্বাচন করুন</label>
                    <div id="dropZone" class="border-2 border-dashed border-[#e0e0e0] dark:border-[#444] rounded p-6 text-center cursor-pointer hover:border-[#999] dark:hover:border-[#666] transition">
                        <svg class="h-8 w-8 mx-auto mb-2 text-[#ccc] dark:text-[#555]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        <p class="text-sm text-[#999] mb-1">ছবি এনে ফেলুন বা ক্লিক করে নির্বাচন করুন</p>
                        <p class="text-[11px] text-[#bbb]">JPEG, PNG, GIF, WEBP (সর্বোচ্চ ১০ MB)</p>
                        <input type="file" name="file" accept="image/*" required class="hidden" id="fileInput">
                    </div>
                    <div id="filePreview" class="hidden mt-2 flex items-center gap-3 p-2 bg-[#f5f5f5] dark:bg-[#2a2a2a] rounded">
                        <img id="previewImage" class="h-12 w-12 object-cover rounded">
                        <div class="flex-1 min-w-0">
                            <p id="previewName" class="text-sm truncate"></p>
                            <p id="previewSize" class="text-[11px] text-[#999]"></p>
                        </div>
                        <button type="button" onclick="clearFileInput()" class="text-red-500 hover:text-red-700">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">ফোল্ডার</label>
                    <div class="flex gap-2">
                        <input type="text" name="folder" id="folderInput" placeholder="general" list="folderList" class="admin-input w-full">
                        <datalist id="folderList">
                            @foreach($folders as $f)
                            <option value="{{ $f }}">
                            @endforeach
                        </datalist>
                        <button type="button" onclick="document.getElementById('folderInput').value = ''" class="text-[#999] hover:text-[#0d0d0d] px-1" title="Clear">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">Alt Text</label>
                    <input type="text" name="alt_text" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">ক্রেডিট</label>
                    <input type="text" name="credit" class="admin-input w-full">
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeUploadModal()" class="btn-outline">বাতিল</button>
                <button type="submit" id="uploadSubmitBtn" class="btn-primary flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    <span id="uploadBtnText">আপলোড</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="viewModal" class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-[#1a1a1a] w-full max-w-3xl mx-4 rounded shadow-xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-4 border-b border-[#e0e0e0] dark:border-[#333]">
            <h2 class="font-bold truncate" id="viewFileName"></h2>
            <button type="button" onclick="closeViewModal()" class="text-[#999] hover:text-[#0d0d0d] dark:hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-4">
            <img id="viewImage" class="w-full max-h-96 object-contain mb-4 rounded" alt="">
            <div class="grid grid-cols-2 gap-3 text-sm mb-4">
                <div><span class="text-[#999]">ফাইল:</span> <span id="viewFileDetail" class="font-medium"></span></div>
                <div><span class="text-[#999]">সাইজ:</span> <span id="viewSize" class="font-medium"></span></div>
                <div><span class="text-[#999]">ফোল্ডার:</span> <span id="viewFolder" class="font-medium"></span></div>
                <div><span class="text-[#999]">টাইপ:</span> <span id="viewType" class="font-medium"></span></div>
            </div>
            <form method="POST" id="viewEditForm" class="border-t border-[#e0e0e0] dark:border-[#333] pt-4">
                @csrf @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">Alt Text</label>
                        <input type="text" name="alt_text" id="viewAlt" class="admin-input w-full">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">ক্রেডিট</label>
                        <input type="text" name="credit" id="viewCredit" class="admin-input w-full">
                    </div>
                </div>
                <div class="flex justify-between gap-3 mt-4">
                    <button type="button" onclick="if(confirm('মুছে ফেলবেন?')){ document.getElementById('viewDeleteForm').submit() }" class="btn-outline text-red-600 border-red-200 hover:bg-red-50 dark:border-red-800 dark:hover:bg-red-900/20 flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        মুছুন
                    </button>
                    <div class="flex gap-3">
                        <button type="button" onclick="closeViewModal()" class="btn-outline">বন্ধ</button>
                        <button type="submit" class="btn-primary">সংরক্ষণ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<form id="viewDeleteForm" method="POST" class="hidden">
    @csrf @method('DELETE')
</form>

<div id="editModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
    <div class="admin-card w-full max-w-lg mx-4 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold">ছবির তথ্য</h2>
            <button type="button" onclick="closeEditModal()" class="text-[#999] hover:text-[#0d0d0d] dark:hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="editForm">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">Alt Text</label>
                    <input type="text" name="alt_text" id="editAlt" class="admin-input w-full">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#666] dark:text-[#aaa] mb-1">ক্রেডিট</label>
                    <input type="text" name="credit" id="editCredit" class="admin-input w-full">
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeEditModal()" class="btn-outline">বাতিল</button>
                <button type="submit" class="btn-primary">সংরক্ষণ</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    clearFileInput();
}
function closeViewModal() {
    document.getElementById('viewModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}
function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function clearFileInput() {
    document.getElementById('fileInput').value = '';
    document.getElementById('filePreview').classList.add('hidden');
    document.getElementById('dropZone').classList.remove('hidden');
}

function openEditModal(id, alt, credit) {
    document.getElementById('editForm').action = '/admin/media/' + id;
    document.getElementById('editAlt').value = alt;
    document.getElementById('editCredit').value = credit;
    document.getElementById('editModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function openViewModal(url, alt, fileName, size, folder, mime, id, altText, credit) {
    document.getElementById('viewImage').src = url;
    document.getElementById('viewImage').alt = alt;
    document.getElementById('viewFileName').textContent = fileName;
    document.getElementById('viewFileDetail').textContent = fileName;
    document.getElementById('viewSize').textContent = size;
    document.getElementById('viewFolder').textContent = folder;
    document.getElementById('viewType').textContent = mime;
    document.getElementById('viewAlt').value = altText;
    document.getElementById('viewCredit').value = credit;
    document.getElementById('viewEditForm').action = '/admin/media/' + id;
    document.getElementById('viewDeleteForm').action = '/admin/media/' + id;
    document.getElementById('viewModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

// Drag and drop
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');

dropZone.addEventListener('click', () => fileInput.click());

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-[#0d0d0d]', 'dark:border-white');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('border-[#0d0d0d]', 'dark:border-white');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-[#0d0d0d]', 'dark:border-white');
    if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        showPreview(e.dataTransfer.files[0]);
    }
});

fileInput.addEventListener('change', function() {
    if (this.files.length) {
        showPreview(this.files[0]);
    }
});

function showPreview(file) {
    if (!file.type.startsWith('image/')) return;
    document.getElementById('previewName').textContent = file.name;
    document.getElementById('previewSize').textContent = (file.size / 1024).toFixed(1) + ' KB';
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
    };
    reader.readAsDataURL(file);
    document.getElementById('dropZone').classList.add('hidden');
    document.getElementById('filePreview').classList.remove('hidden');
}

// Loading state on upload
document.getElementById('uploadForm').addEventListener('submit', function() {
    const btn = document.getElementById('uploadSubmitBtn');
    btn.disabled = true;
    document.getElementById('uploadBtnText').textContent = 'আপলোড হচ্ছে...';
    btn.innerHTML = '<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> <span>আপলোড হচ্ছে...</span>';
});
</script>
@endpush
@endsection
