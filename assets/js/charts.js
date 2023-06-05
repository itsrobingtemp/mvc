export default function setupCharts() {
  // Disease
  const swedenDiseaseChartOptions = {
    chart: {
      type: "line",
    },
    series: [
      {
        name: "Sweden",
        data: dataSwedenDisease,
      },
    ],
    xaxis: {
      categories: [2000, 2005, 2010, 2015, 2020],
    },
    yaxis: {
      min: 0,
      max: 15,
    },
  };

  const swedenDiseaseChart = new ApexCharts(
    document.querySelector("#chart1"),
    swedenDiseaseChartOptions
  );
  swedenDiseaseChart.render();

  var worldDiseaseChartOptions = {
    chart: {
      type: "line",
    },
    series: [
      {
        name: "World",
        data: dataWorldDisease,
      },
    ],
    xaxis: {
      categories: [2000, 2005, 2010, 2015, 2020],
    },
    yaxis: {
      min: 0,
      max: 30,
    },
  };

  const worldDiseaseChart = new ApexCharts(
    document.querySelector("#chart2"),
    worldDiseaseChartOptions
  );
  worldDiseaseChart.render();

  const bothDiseaseChartOptions = {
    chart: {
      type: "line",
    },
    series: [
      {
        name: "World",
        data: dataWorldDisease,
      },
      {
        name: "Sweden",
        data: dataSwedenDisease,
      },
    ],
    xaxis: {
      categories: [2000, 2005, 2010, 2015, 2020],
    },
    yaxis: {
      min: 0,
      max: 30,
    },
  };

  const bothDiseaseChart = new ApexCharts(
    document.querySelector("#chart3"),
    bothDiseaseChartOptions
  );
  bothDiseaseChart.render();

  // Infant
  var swedenInfantChartOptions = {
    chart: {
      type: "line",
    },
    series: [
      {
        name: "Sweden",
        data: dataSwedenInfant,
      },
    ],
    xaxis: {
      categories: [2000, 2005, 2010, 2015, 2018],
    },
    yaxis: {
      min: 0,
      max: 10,
    },
  };

  const swedenInfantChart = new ApexCharts(
    document.querySelector("#chart4"),
    swedenInfantChartOptions
  );
  swedenInfantChart.render();

  var worldInfantChartOptions = {
    chart: {
      type: "line",
    },
    series: [
      {
        name: "World",
        data: dataWorldInfant,
      },
    ],
    xaxis: {
      categories: [2000, 2005, 2010, 2015, 2018],
    },
    yaxis: {
      min: 0,
      max: 60,
    },
  };

  const worldInfantChart = new ApexCharts(
    document.querySelector("#chart5"),
    worldInfantChartOptions
  );
  worldInfantChart.render();

  var bothInfantChartOptions = {
    chart: {
      type: "line",
    },
    series: [
      {
        name: "World",
        data: dataWorldInfant,
      },
      {
        name: "Sweden",
        data: dataSwedenInfant,
      },
    ],
    xaxis: {
      categories: [2000, 2005, 2010, 2015, 2018],
    },
    yaxis: {
      min: 0,
      max: 60,
    },
  };

  const bothInfantChart = new ApexCharts(
    document.querySelector("#chart6"),
    bothInfantChartOptions
  );
  bothInfantChart.render();
}
