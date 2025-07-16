  const modal      = document.getElementById('bookModal');
        const closeBtn   = modal.querySelector('.modal-close');
        const imgEl      = modal.querySelector('.modal-img');
        const titleEl    = modal.querySelector('#modalTitle');
        const authorsEl  = modal.querySelector('.modal-authors');
        const descEl     = modal.querySelector('.modal-desc');
        const availText  = modal.querySelector('.avail-text');
        const availInd   = modal.querySelector('.avail-indicator');
        const reserveBtn = document.getElementById('btnReserve');
        const readBtn  = document.getElementById('btnReadList');


        let   currentBookId = null;

        document.querySelectorAll('.open-modal').forEach(card => {
            card.addEventListener('click', () => {
                currentBookId = card.dataset.bookid;
                titleEl.textContent   = card.dataset.title;
                authorsEl.textContent = card.dataset.authors;
                descEl.textContent    = card.dataset.desc || 'No description available.';
                imgEl.src             = card.dataset.img;
                imgEl.alt             = card.dataset.title;

                const available = card.dataset.avail === '1';
                availText.textContent = available ? 'Available' : 'Currently Unavailable';
                availInd.textContent  = available ? '✔️' : '❌';
                reserveBtn.disabled   = !available;

                readBtn.disabled = false;
                readBtn.textContent = 'Add to Read List';

                modal.classList.add('active');
            });
        });

        closeBtn.addEventListener('click', () => modal.classList.remove('active'));
        modal.addEventListener('click', e => { if (e.target === modal) modal.classList.remove('active'); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.remove('active'); });

        reserveBtn.addEventListener('click', () => {
            if (!currentBookId) return;
            reserveBtn.disabled = true;

            fetch('reserve-book.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ book_id: currentBookId })
            })
            .then(r => r.json())
            .then(data => {
                if (data.ok) {
                    availText.textContent = 'Currently Unavailable';
                    availInd.textContent  = '❌';

                    const card = document.querySelector(`.open-modal[data-bookid="${currentBookId}"]`);
                    if (card) card.dataset.avail = '0';

                    alert('Book reserved successfully.');
                } else {
                    alert(data.msg || 'Could not reserve.');
                    reserveBtn.disabled = false;
                }
            })
            .catch(() => {
                alert('Server error.');
                reserveBtn.disabled = false;
            });
        });

        readBtn.addEventListener('click', () => {
    if (!currentBookId) return;
    readBtn.disabled = true;

    fetch('add-readlist.php', {
        method : 'POST',
        headers: { 'Content-Type':'application/x-www-form-urlencoded' },
        body   : new URLSearchParams({ book_id: currentBookId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.ok) {
            readBtn.textContent = 'Added!';
        } else {
            alert(data.msg || 'Could not add.');
            readBtn.disabled = false;
        }
    })
    .catch(() => {
        alert('Server error.');
        readBtn.disabled = false;
    });
});