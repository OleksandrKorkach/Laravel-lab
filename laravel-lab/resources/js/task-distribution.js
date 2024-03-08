import Chart from 'chart.js/auto';

const canvas = document.getElementById('taskDistribution');
const tasksDistribution = JSON.parse(canvas.getAttribute('data-tasks-distribution'));

const labels = Object.keys(tasksDistribution);
const values = Object.values(tasksDistribution);

const colors = {
    1: '#1AC',
    2: '#EE9A3A',
    3: '#1DE4BD',
    4: '#820401',
    5: '#C02323',
    6: '#DE542C',
    7: '#EF7E32',
    8: '#EE9A3A',
    9: '#EABD38',
    10: '#29066B',
    11: '#7D31C1',
    12: '#AF4BCE',
    13: '#DB4CB2',
    14: '#EB548C',
    15: '#EA7369',
    16: '#F0A58F',
    17: '#176BA0',
    18: '#19AADE',
    19: '#1AC9E6',
    20: '#1AC9E6',
};

const statusNames = {
    1: 'Зробити',
    2: 'У процесі',
    3: 'Виконано',
    4: 'Очікує перевірки',
    5: 'Заблоковано',
    6: 'Високий пріоритет',
    7: 'Низький пріоритет',
    8: 'Потребує уточнення',
    9: 'У перегляді',
    10: 'Готово до тестування',
    11: 'Очікує схвалення',
    12: 'На утриманні',
    13: 'У дискусії',
    14: 'Заплановано',
    15: 'Виправлення помилок',
    16: 'Розробка функцій',
    17: 'Документація',
    18: 'Дизайн інтерфейсу',
    19: 'Інтеграційне тестування',
    20: 'Розгортання',
};


const backgroundColors = labels.map(label => colors[label] || 'rgb(0, 0, 0)');
const labelNames = labels.map(label => statusNames[label] || 'Unknown');

const doughnutData = {
    labels: labelNames,
    datasets: [{
        backgroundColor: backgroundColors,
        borderWidth: 1.5,
        borderColor: 'white',
        data: Object.values(values),
    }]
};

const config = {
    type: 'doughnut',
    data: doughnutData,
    options: {
        plugins: {
            legend: {
                position: 'right',
                align: 'center',
                labels: {
                    boxHeight: 10,
                    boxWidth: 10,
                    usePointStyle: true,
                },
            },
        },
    }
};


new Chart(canvas, config);

