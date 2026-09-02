<script>
window.mediaLibraryRoute = '{{ route("admin.media.index") }}';

function openMediaLibraryForEditor() {
    const grid = document.getElementById('mediaLibraryGrid');
    if (!grid) return;
    document.getElementById('mediaLibraryModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    loadMediaLibraryItems(true);
}

document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('mediaLibraryGrid');
    if (grid) {
        grid.addEventListener('scroll', function() {
            if (this.scrollTop + this.clientHeight >= this.scrollHeight - 200) {
                loadMediaLibraryItems(false);
            }
        });
    }
});

let mlPage = 1, mlLoading = false, mlHasMore = true;

function loadMediaLibraryItems(reset = false) {
    if (reset) { mlPage = 1; mlHasMore = true; }
    if (mlLoading || !mlHasMore) return;
    mlLoading = true;

    const grid = document.getElementById('mediaLibraryGrid');
    if (reset) grid.innerHTML = '<div class="text-center text-sm text-[#999] py-10">লোড হচ্ছে...</div>';

    fetch(window.mediaLibraryRoute + '?page=' + mlPage, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(data => {
            if (reset) grid.innerHTML = '';
            if (data.items.length) {
                let html = '';
                data.items.forEach(item => {
                    const safeUrl = item.url.replace(/'/g, "\\'");
                    const safeName = item.name.replace(/'/g, "\\'");
                    html += '<div class="admin-card cursor-pointer hover:ring-2 hover:ring-[#0d0d0d] dark:hover:ring-white transition" onclick="selectMediaItem(\'' + safeUrl + '\')">';
                    html += '<div class="aspect-square overflow-hidden bg-[#f5f5f5] dark:bg-[#2a2a2a]">';
                    html += '<img src="' + safeUrl + '" class="w-full h-full object-cover" loading="lazy">';
                    html += '</div><div class="p-1.5"><p class="text-[10px] truncate">' + safeName + '</p></div></div>';
                });
                grid.insertAdjacentHTML('beforeend', html);
                mlHasMore = data.has_more;
                mlPage = data.next_page;
            } else if (reset) {
                grid.innerHTML = '<div class="text-center text-sm text-[#999] py-10">কোনো ছবি নেই</div>';
            }
        })
        .catch(() => {
            if (reset) grid.innerHTML = '<div class="text-center text-sm text-red-500 py-10">লোড করতে ব্যর্থ</div>';
        })
        .finally(() => { mlLoading = false; });
}

function selectMediaItem(url) {
    if (typeof window.mediaEditorCallback === 'function') {
        window.mediaEditorCallback(url);
        window.mediaEditorCallback = null;
    }
    closeMediaLibraryModal();
}

function closeMediaLibraryModal() {
    const modal = document.getElementById('mediaLibraryModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
}
</script>
