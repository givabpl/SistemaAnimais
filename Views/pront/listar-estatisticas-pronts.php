<?php require_once ROOT_PATH . '/Views/cabecalho.php'; ?>

<div class="content">
    <div class="container-fluid container-fluido">

        <h1 class="text-center">Estatísticas de Atendimentos</h1>
        <br>

        <div class="d-flex flex-wrap justify-content-center p-4">
            <!-- N° DE PRONTUÁRIOS/ATENDIMENTOS NO DIA DE HOJE -->
            <div class="p-2 g-6 ">
                <div id="card-pront-dia" class="card card-estatisticas">
                    <div class="card-body p-4">
                        <h5 class="card-title">N° de Atendimentos Hoje</h5>
                        <h4>
                            <?= $numero_pronts_hoje ?>
                        </h4>
                    </div>
                </div>
            </div>

            <!-- MÉDIA DE PRONTUÁRIOS/ATENDIMENTOS POR DIA (COM BASE NOS ÚLTIMOS 30 DIAS) -->
            <div class="p-2 g-6 ">
                <div id="card-pront-media" class="card card-estatisticas">
                    <div class="card-body p-4">
                        <h5 class="card-title">Média de Atendimentos por Dia</h5>
                        <h4>
                            <?= $media_pronts_dia ?>
                        </h4>
                    </div>
                </div>
                *Com base nos últimos 30 dias
            </div>

            <!-- GRÁFICO/MAPA DE ATENDIMENTOS POR DIA E MESES -->
            <div class="p-2 g-6 chart-container">
                <div class="chart" id="heatmap"></div>
            </div>

            <!-- GRÁFICO DE SITUAÇÃO DOS ANIMAIS ATENDIDOS (ABRIGADOS OU EM SITUAÇÃO DE RUA) -->
            <div class="p-2 g-6">
                <div class="chart" id="pie-chart"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            chart: {
                height: 350,
                type: 'heatmap',
                width: '100%'
            },

            series: generateSeriesData(),
            dataLabels: {
                enabled: false
            },
            colors: ["#008FFB"],
            title: {
                text: 'N° de Atendimentos Por Dia'
            },
            resonsive: [{
                brekpoint: 1000,
                options: {
                    chart: {
                        width: '100%'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#heatmap"), options);
        chart.render();

        function generateSeriesData() {
            var data = <?= json_encode($dados_por_dia) ?>;
            var months = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
            var series = months.map((month, index) => {
                var daysInMonth = new Date(2024, index + 1, 0).getDate(); // Ajuste o ano conforme necessário
                return {
                    name: month,
                    data: Array.from({ length: daysInMonth }, (_, day) => {
                        var date = new Date(2024, index, day + 1); // Ajuste o ano conforme necessário
                        var dateString = date.toISOString().split('T')[0];
                        var total = data.find(d => d.dia === dateString)?.total || 0;
                        return { x: (day + 1).toString(), y: total };
                    })
                };
            });
            return series;
        }
    });


</script>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
