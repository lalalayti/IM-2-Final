document.querySelectorAll('.return-btn').forEach(btn=>{
    btn.addEventListener('click', e=>{
        e.stopPropagation();
        const card = btn.closest('.book-card');
        const borrowId = card.dataset.borrowid;
        const bookId   = card.dataset.bookid;

        if (!confirm('Return this book?')) return;

        fetch('return-book.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:new URLSearchParams({ borrow_id: borrowId, book_id: bookId })
        })
        .then(r=>r.json())
        .then(d=>{
            if (d.ok){
                card.remove();
            } else {
                alert(d.msg||'Could not return.');
            }
        })
        .catch(()=>alert('Server error'));
    });
});