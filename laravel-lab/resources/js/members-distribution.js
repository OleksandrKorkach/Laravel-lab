import Chart from 'chart.js/auto';

const canvas = document.getElementById('membersDistribution');
const membersDistribution = JSON.parse(canvas.getAttribute('data-members-distribution'));

const labels = Object.keys(membersDistribution);
const values = Object.values(membersDistribution);

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
    19: 'gray',
};

const roleNames = {
    1: 'Project Manager',
    2: 'Software Developer',
    3: 'Technical Architect',
    4: 'QA Tester',
    5: 'UI Designer',
    6: 'UX Designer',
    7: 'UI/UX Designer',
    8: 'Business Analyst',
    9: 'DevOps Engineer',
    10: 'Systems Analyst',
    11: 'System Administrator',
    12: 'Network Engineer',
    13: 'Database Administrator',
    14: 'Mobile Developer',
    15: 'Web Developer',
    16: 'Information Security Specialist',
    17: 'Data Analyst',
    18: 'Machine Learning Engineer',
    19: 'Undefined',
};


const backgroundColors = labels.map(label => colors[label] || 'rgb(0, 0, 0)');
const labelNames = labels.map(label => roleNames[label] || 'Unknown');

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
