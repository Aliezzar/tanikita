const diagram = document.getElementById('diagram').getContext('2d');
const myChart = new Chart(diagram, {
    type: 'doughnut',
    data: {
        labels: ['Sangat Aman', 'Aman', 'Cukup Aman', 'Agak Rawan', 'Rawan', 'Sangat Rawan'],
        datasets: [{
            label: 'Presentase dari Ketahanan pangan Indonesia',
            data: [26, 50, 18, 3, 0, 3],
            backgroundColor: [
                'rgba(0, 0, 225, 0.2)',
                'rgba(225, 165, 0, 0.2)',
                'rgba(128, 128, 128, 0.2)',
                'rgba(255, 255, 0, 0.2)',
                'rgba(255, 0, 0, 0.2)',
                'rgba(0, 255, 0, 0.2)',

            ],
            borderColor: [
                'rgba(0, 0, 225, 1)',
                'rgba(225, 165, 0, 1)',
                'rgba(128, 128, 128, 1)',
                'rgba(255, 255, 0, 1)',
                'rgba(255, 0, 0, 1)',
                'rgba(0, 255, 0, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});