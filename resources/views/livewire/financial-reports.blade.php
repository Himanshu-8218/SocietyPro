<div>
    <div class="row" style="margin-left: 8rem">
        <div class="card col-md-5 mb-4 me-2"><div id="monthly_chart" style="height: 400px;"></div></div>
        <div class="card col-md-5 mb-4"><div id="quarterly_chart" style="height: 400px;"></div></div>
        <div class="card col-md-5 mb-4 me-2"><div id="yearly_chart" style="height: 400px;"></div></div>
        <div class="card col-md-5 mb-4"><div id="source_chart" style="height: 400px;"></div></div>
    </div>
</div>

<script src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    const monthlyData = @json($monthly);
    const quarterlyData = @json($quarterly);
    const yearlyData = @json($yearly);
    const sourceData = @json($bySource);

    document.addEventListener("DOMContentLoaded", () => {

        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(() => {
            console.log("📊 Google Charts Ready");
            drawAllCharts();
        });
    });

    function drawAllCharts() {
        drawMonthlyChart();
        drawQuarterlyChart();
        drawYearlyChart();
        drawSourceChart();
    }

    function drawMonthlyChart() {
        const data = google.visualization.arrayToDataTable([
            ['Month-Year', 'Amount'],
            ...monthlyData.map(item => [`${item.month}-${item.year}`, parseFloat(item.total)])
        ]);
        const chart = new google.visualization.LineChart(document.getElementById('monthly_chart'));
        chart.draw(data, { title: 'Monthly Income', legend: { position: 'none' } });
    }

    function drawQuarterlyChart() {
        const data = google.visualization.arrayToDataTable([
            ['Quarter-Year', 'Amount'],
            ...quarterlyData.map(item => [`Q${item.quarter}-${item.year}`, parseFloat(item.total)])
        ]);
        const chart = new google.visualization.ColumnChart(document.getElementById('quarterly_chart'));
        chart.draw(data, { title: 'Quarterly Income', legend: { position: 'none' } });
    }

    function drawYearlyChart() {
        const data = google.visualization.arrayToDataTable([
            ['Year', 'Amount'],
            ...yearlyData.map(item => [String(item.year), parseFloat(item.total)])
        ]);
        const chart = new google.visualization.PieChart(document.getElementById('yearly_chart'));
        chart.draw(data, { title: 'Yearly Income' });
    }

    function drawSourceChart() {
        const data = google.visualization.arrayToDataTable([
            ['Source', 'Amount'],
            ...sourceData.map(item => [item.source, parseFloat(item.total)])
        ]);
        const chart = new google.visualization.SteppedAreaChart(document.getElementById('source_chart'));
        chart.draw(data, { title: 'Income by Source' });
    }
</script>
