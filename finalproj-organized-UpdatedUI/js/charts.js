document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('bookStatsChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Books', 'Reserved Books', 'Borrowed Books'],
            datasets: [{
                label: 'Count',
                data: [totalBooks, reservedBooks, borrowedBooks],
                backgroundColor: ['#7B3F00', '#f7b267', '#57c7d4'],
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Books Overview'
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
});

function flagUser(userId) {
    alert('User with ID ' + userId + ' has been flagged.');
}
