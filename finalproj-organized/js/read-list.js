document.querySelectorAll('.del-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.stopPropagation();
        const card = btn.closest('.book-card');
        const rlid = card.dataset.rlid;
        const bid  = card.dataset.bid;

        if (!rlid || !bid) {
            alert('Missing IDs – check data-rlid/data-bid.');
            return;
        }
        if (!confirm('Remove this book from your Read List?')) return;

        fetch('read-deletion.php', {
            method : 'POST',
            headers: { 'Content-Type':'application/x-www-form-urlencoded' },
            body   : new URLSearchParams({ read_id: rlid, book_id: bid })
        })
        .then(r => r.json())
        .then(d => {
            if (d.ok) {
                card.remove();
            } else {
                alert(d.msg || 'Could not delete.');
            }
        })
        .catch(() => alert('Server error.'));
    });
});