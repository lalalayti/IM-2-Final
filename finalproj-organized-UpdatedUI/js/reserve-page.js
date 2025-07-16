document.querySelectorAll('.del-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.stopPropagation();
        const card = btn.closest('.book-card');

        const rid = card.dataset.rid;
        const bid = card.dataset.bid;

        if (!rid || !bid) {
            alert('Missing IDs on card – check data-rid / data-bid.');
            return;
        }

        if (!confirm('Cancel this reservation?')) return;

        fetch('book-deletion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ reservation_id: rid, book_id: bid })
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