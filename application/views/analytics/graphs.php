<!DOCTYPE html>
<html>
<head>
    <title>Analytics Graphs</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .chart-card {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            min-height: 360px;
        }

        .chart-card canvas {
            max-height: 280px;
        }

        .gap-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .gap-critical {
            background: #fde2e2;
            color: #9b1c1c;
        }

        .gap-significant {
            background: #fff4d6;
            color: #8a5a00;
        }

        .gap-emerging {
            background: #e6f2ff;
            color: #064f8f;
        }

        .gap-none {
            background: #eeeeee;
            color: #555555;
        }

        @media (max-width: 900px) {
            .chart-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1>Analytics Graphs</h1>
        <p>Charts generated from alumni profile, employment, certification, and course data.</p>
    </div>

    <div class="navbar">
        <a href="<?php echo site_url('analytics/dashboard'); ?>">Dashboard</a>
        <a href="<?php echo site_url('analytics/alumni'); ?>">View Alumni</a>
        <a href="<?php echo site_url('analytics/graphs'); ?>">Graphs</a>
        <a href="<?php echo site_url('auth/dashboard'); ?>">Main Dashboard</a>
        <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
    </div>

    <div class="section">
        These charts are generated from alumni profile, employment, certification, and course data stored in the database. The skills gap insight uses certification and short-course keywords to highlight emerging, significant, and critical curriculum signals.
    </div>

    <div class="chart-grid">
        <div class="chart-card">
            <h3>Alumni by Graduation Year</h3>
            <canvas id="graduationYearChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Alumni Growth Trend</h3>
            <canvas id="alumniGrowthLineChart"></canvas>
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

        <div class="chart-card">
            <h3>Curriculum Skills Gap Radar</h3>
            <canvas id="skillsGapRadarChart"></canvas>
        </div>
    </div>

    <div class="section" style="margin-top: 20px;">
        <h2>Curriculum Skills Gap Insights</h2>
        <p>The table below groups certification and short-course signals into skill areas. Higher counts indicate stronger industry demand and can guide curriculum review.</p>

        <table>
            <thead>
                <tr>
                    <th>Skill Area</th>
                    <th>Certification Signals</th>
                    <th>Course Signals</th>
                    <th>Total Signals</th>
                    <th>Gap Level</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($skills_gap)): ?>
                    <?php foreach ($skills_gap as $gap): ?>
                        <?php
                            $level = strtolower(str_replace(' ', '-', $gap->gap_level));
                            $class = 'gap-none';

                            if ($level === 'critical') {
                                $class = 'gap-critical';
                            } elseif ($level === 'significant') {
                                $class = 'gap-significant';
                            } elseif ($level === 'emerging') {
                                $class = 'gap-emerging';
                            }
                        ?>
                        <tr>
                            <td><?php echo html_escape($gap->label); ?></td>
                            <td><?php echo (int) $gap->certification_count; ?></td>
                            <td><?php echo (int) $gap->course_count; ?></td>
                            <td><?php echo (int) $gap->total; ?></td>
                            <td><span class="gap-badge <?php echo $class; ?>"><?php echo html_escape($gap->gap_level); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No skills gap data available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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
const alumniGrowthTrend = <?php echo json_encode($alumni_growth_trend); ?>;
const skillsGap = <?php echo json_encode($skills_gap); ?>;

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
            legend: { display: true },
            tooltip: { enabled: true }
        },
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Number of Alumni' } },
            x: { title: { display: true, text: 'Graduation Year' } }
        }
    }
});

new Chart(document.getElementById('alumniGrowthLineChart'), {
    type: 'line',
    data: {
        labels: labelsFrom(alumniGrowthTrend),
        datasets: [{
            label: 'Cumulative Alumni Count',
            data: totalsFrom(alumniGrowthTrend),
            tension: 0.35,
            fill: false
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true },
            tooltip: { enabled: true }
        },
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Cumulative Alumni' } },
            x: { title: { display: true, text: 'Graduation Year' } }
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
        responsive: true,
        plugins: { legend: { display: true }, tooltip: { enabled: true } }
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
        responsive: true,
        plugins: { legend: { display: true }, tooltip: { enabled: true } },
        scales: {
            x: { beginAtZero: true, title: { display: true, text: 'Number of Alumni' } },
            y: { title: { display: true, text: 'Employer' } }
        }
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
        responsive: true,
        plugins: { legend: { display: true }, tooltip: { enabled: true } },
        scales: {
            x: { beginAtZero: true, title: { display: true, text: 'Number of Alumni' } },
            y: { title: { display: true, text: 'Job Title' } }
        }
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
        responsive: true,
        plugins: { legend: { display: true }, tooltip: { enabled: true } }
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
        responsive: true,
        plugins: { legend: { display: true }, tooltip: { enabled: true } },
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Number of Certifications' } },
            x: { title: { display: true, text: 'Certification' } }
        }
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
        responsive: true,
        plugins: { legend: { display: true }, tooltip: { enabled: true } },
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Number of Courses' } },
            x: { title: { display: true, text: 'Course' } }
        }
    }
});

new Chart(document.getElementById('skillsGapRadarChart'), {
    type: 'radar',
    data: {
        labels: labelsFrom(skillsGap),
        datasets: [{
            label: 'Skill Demand Signals',
            data: totalsFrom(skillsGap)
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true },
            tooltip: { enabled: true }
        },
        scales: {
            r: { beginAtZero: true, ticks: { precision: 0 } }
        }
    }
});
</script>

</body>
</html>
