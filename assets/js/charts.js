// male, women, 30-70 cardio, cancer, diabetes etc. SWEDEN
let diseaseOne = {
  chart: {
    type: "line",
  },
  series: [
    {
      name: "Sweden",
      data: [13.2, 11.8, 10.4, 9.3, 9.1],
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

var chart1 = new ApexCharts(document.querySelector("#chart1"), diseaseOne);
chart1.render();
