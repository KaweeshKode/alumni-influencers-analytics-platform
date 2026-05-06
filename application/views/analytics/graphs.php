<!DOCTYPE html>
<html>
<head>
    <title>Analytics Graphs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f6fa;
        }

        h1 {
            color: #222;
        }

        .nav {
            margin-bottom: 20px;
        }

        .nav a {
            margin-right: 15px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .chart-card {
            background: #fff;
            padding: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            min-height: 360px;
        }

        canvas {
            max-height: 280px;
        }

        .note {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>Analytics Graphs</h1>

<div class="nav">
    <a href="<?php echo site_url('analytics/dashboard'); ?>">Dashboard</a>
    <a href="<?php echo site_url('analytics/alumni'); ?>">View Alumni</a>
    <a href="<?php echo site_url('analytics/graphs'); ?>">Graphs</a>
    <a href="<?php echo site_url('auth/dashboard'); ?>">Main Dashboard</a>
    <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
</div>

<div class="note">
    These charts are generated from alumni profile, employment, certification, and course data stored in the database.
</div>

<div class="grid">
    <div class="chart-card">
        <h3>Alumni by Graduation Year</h3>
        <canvas id="graduationYearChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Employment by Industry Sector</h3>
        <canvas id="industryChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Top Employers</h3>
        <canvas id="employerChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Most Common Job Titles</h3>
        <canvas id="jobTitleChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Geographic Distribution</h3>
        <canvas id="geoChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Certification Trends</h3>
        <canvas id="certificationChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Professional Course Trends</h3>
        <canvas id="courseChart"></canvas>
    </div>
</div>

<script>
function labelsFrom(data) {
    return data.map(item => item.label || 'Unknown');
}

function totalsFrom(data) {
    return data.map(item => Number(item.total));
}

const graduationYears = <?php echo json_encode($graduation_years); ?>;
const industrySectors = <?php echo json_encode($industry_sectors); ?>;
const topEmployers = <?php echo json_encode($top_employers); ?>;
const jobTitles = <?php echo json_encode($job_titles); ?>;
const geographicDistribution = <?php echo json_encode($geographic_distribution); ?>;
const certificationTrends = <?php echo json_encode($certification_trends); ?>;
const courseTrends = <?php echo json_encode($course_trends); ?>;

new Chart(document.getElementById('graduationYearChart'), {
    type: 'bar',
    data: {
        labels: labelsFrom(graduationYears),
        datasets: [{
            label: 'Alumni Count',
            data: totalsFrom(graduationYears)
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true }
        }
    }
});

new Chart(document.getElementById('industryChart'), {
    type: 'doughnut',
    data: {
        labels: labelsFrom(industrySectors),
        datasets: [{
            label: 'Industry Sector',
            data: totalsFrom(industrySectors)
        }]
    },
    options: {
        responsive: true
    }
});

new Chart(document.getElementById('employerChart'), {
    type: 'bar',
    data: {
        labels: labelsFrom(topEmployers),
        datasets: [{
            label: 'Alumni Count',
            data: totalsFrom(topEmployers)
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true
    }
});

new Chart(document.getElementById('jobTitleChart'), {
    type: 'bar',
    data: {
        labels: labelsFrom(jobTitles),
        datasets: [{
            label: 'Alumni Count',
            data: totalsFrom(jobTitles)
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true
    }
});

new Chart(document.getElementById('geoChart'), {
    type: 'pie',
    data: {
        labels: labelsFrom(geographicDistribution),
        datasets: [{
            label: 'Country',
            data: totalsFrom(geographicDistribution)
        }]
    },
    options: {
        responsive: true
    }
});

new Chart(document.getElementById('certificationChart'), {
    type: 'bar',
    data: {
        labels: labelsFrom(certificationTrends),
        datasets: [{
            label: 'Certification Count',
            data: totalsFrom(certificationTrends)
        }]
    },
    options: {
        responsive: true
    }
});

new Chart(document.getElementById('courseChart'), {
    type: 'bar',
    data: {
        labels: labelsFrom(courseTrends),
        datasets: [{
            label: 'Course Count',
            data: totalsFrom(courseTrends)
        }]
    },
    options: {
        responsive: true
    }
});
</script>

</body>
</html>
