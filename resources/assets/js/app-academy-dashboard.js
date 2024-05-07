/**
 * Academy Dashboard charts and datatable
 */

'use strict';

function updateClock() {
  var now = new Date();
  var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  var months = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  ];

  var day = days[now.getDay()];
  var date = now.getDate();
  var month = months[now.getMonth()];
  var year = now.getFullYear();

  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();

  hours = hours < 10 ? '0' + hours : hours;
  minutes = minutes < 10 ? '0' + minutes : minutes;
  seconds = seconds < 10 ? '0' + seconds : seconds;

  var timeString = hours + ':' + minutes + ':' + seconds;
  var dateString = day + ', ' + date + ' ' + month + ' ' + year;

  document.getElementById('currentTime').innerText = timeString;
  document.getElementById('currentDate').innerText = dateString;
}

// Update the clock every second
setInterval(updateClock, 1000);

// Initial call to display clock immediately
updateClock();

// Hour pie chart

(function () {
  let labelColor, headingColor, borderColor;

  if (isDarkStyle) {
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;
  }

  // Donut Chart Colors
  const chartColors = {
    donut: {
      series1: '#22A95E',
      series2: '#24B364',
      series3: config.colors.success,
      series4: '#53D28C',
      series5: '#7EDDA9',
      series6: '#A9E9C5'
    }
  };

  const leadsReportChartEl = document.querySelector('#leadsReportChart'),
    leadsReportChartConfig = {
      chart: {
        height: 157,
        width: 130,
        parentHeightOffset: 0,
        type: 'donut'
      },
      labels: ['36h', '56h', '16h', '32h', '56h', '16h'],
      series: [23, 35, 10, 20, 35, 23],
      colors: [
        chartColors.donut.series1,
        chartColors.donut.series2,
        chartColors.donut.series3,
        chartColors.donut.series4,
        chartColors.donut.series5,
        chartColors.donut.series6
      ],
      stroke: {
        width: 0
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + '%';
        }
      },
      legend: {
        show: false
      },
      tooltip: {
        theme: false
      },
      grid: {
        padding: {
          top: 0
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                fontWeight: 500,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '.7rem',
                label: 'Total',
                color: labelColor,
                formatter: function (w) {
                  return '231h';
                }
              }
            }
          }
        }
      }
    };
  if (typeof leadsReportChartEl !== undefined && leadsReportChartEl !== null) {
    const leadsReportChart = new ApexCharts(leadsReportChartEl, leadsReportChartConfig);
    leadsReportChart.render();
  }

  // datatbale bar chart

  const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
    horizontalBarChartConfig = {
      chart: {
        height: 270,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: true,
          barHeight: '70%',
          distributed: true,
          startingShape: 'rounded',
          borderRadius: 7
        }
      },
      grid: {
        strokeDashArray: 10,
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        },
        yaxis: {
          lines: {
            show: false
          }
        },
        padding: {
          top: -35,
          bottom: -12
        }
      },

      colors: [
        config.colors.primary,
        config.colors.info,
        config.colors.success,
        config.colors.secondary,
        config.colors.danger,
        config.colors.warning
      ],
      dataLabels: {
        enabled: true,
        style: {
          colors: ['#fff'],
          fontWeight: 200,
          fontSize: '13px',
          fontFamily: 'Public Sans'
        },
        formatter: function (val, opts) {
          return horizontalBarChartConfig.labels[opts.dataPointIndex];
        },
        offsetX: 0,
        dropShadow: {
          enabled: false
        }
      },
      labels: ['UI Design', 'UX Design', 'Music', 'Animation', 'React', 'SEO'],
      series: [
        {
          data: [35, 20, 14, 12, 10, 9]
        }
      ],

      xaxis: {
        categories: ['6', '5', '4', '3', '2', '1'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          },
          formatter: function (val) {
            return `${val}%`;
          }
        }
      },
      yaxis: {
        max: 35,
        labels: {
          style: {
            colors: [labelColor],
            fontFamily: 'Public Sans',
            fontSize: '13px'
          }
        }
      },
      tooltip: {
        enabled: true,
        style: {
          fontSize: '12px'
        },
        onDatasetHover: {
          highlightDataSeries: false
        },
        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
          return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '%</span>' + '</div>';
        }
      },
      legend: {
        show: false
      }
    };
  if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
    const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
    horizontalBarChart.render();
  }

  // Earning Reports Bar Chart
  // --------------------------------------------------------------------
  const weeklyEarningReportsEl = document.querySelector('#weeklyEarningReports'),
    weeklyEarningReportsConfig = {
      chart: {
        height: 202,
        parentHeightOffset: 0,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          barHeight: '60%',
          columnWidth: '38%',
          startingShape: 'rounded',
          endingShape: 'rounded',
          borderRadius: 4,
          distributed: true
        }
      },
      grid: {
        show: false,
        padding: {
          top: -30,
          bottom: 0,
          left: -10,
          right: -10
        }
      },
      colors: [
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors.primary,
        config.colors_label.primary,
        config.colors_label.primary
      ],
      dataLabels: {
        enabled: false
      },
      series: [
        {
          data: [40, 65, 50, 45, 90, 55, 70]
        }
      ],
      legend: {
        show: false
      },
      xaxis: {
        categories: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px',
            fontFamily: 'Public Sans'
          }
        }
      },
      yaxis: {
        labels: {
          show: false
        }
      },
      tooltip: {
        enabled: false
      },
      responsive: [
        {
          breakpoint: 1025,
          options: {
            chart: {
              height: 199
            }
          }
        }
      ]
    };
  if (typeof weeklyEarningReportsEl !== undefined && weeklyEarningReportsEl !== null) {
    const weeklyEarningReports = new ApexCharts(weeklyEarningReportsEl, weeklyEarningReportsConfig);
    weeklyEarningReports.render();
  }

  const lineChartEl = document.querySelector('#lineChart');

  // Konfigurasi awal untuk chart
  const lineChartConfig = {
    chart: {
      height: 400,
      type: 'line',
      parentHeightOffset: 0,
      zoom: {
        enabled: false
      },
      toolbar: {
        show: false
      }
    },
    series: [
      {
        data: []
      }
    ],
    markers: {
      strokeWidth: 7,
      strokeOpacity: 1,
      strokeColors: ['#ffffff'],
      colors: ['#f39c12']
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'straight'
    },
    colors: ['#f39c12'],
    grid: {
      borderColor: '#e0e6ed',
      xaxis: {
        lines: {
          show: true
        }
      },
      padding: {
        top: -20
      }
    },
    tooltip: {
      custom: function ({ series, seriesIndex, dataPointIndex, w }) {
        return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '</span>' + '</div>';
      }
    },
    xaxis: {
      categories: [],
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      labels: {
        style: {
          colors: '#6e767f',
          fontSize: '13px'
        }
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: '#6e767f',
          fontSize: '13px'
        }
      }
    }
  };

  // Fungsi untuk mengambil data dari endpoint API dan memperbarui chart
  async function fetchDataAndUpdateChart() {
    try {
      const response = await fetch('/si-dandang/dashboard/data-pengaduan-per-hari');
      const data = await response.json();

      // Update data series dan kategori x-axis
      lineChartConfig.series[0].data = data.data;
      lineChartConfig.xaxis.categories = data.labels;

      // Render ulang chart dengan data baru
      const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
      lineChart.render();
    } catch (error) {
      console.error('Error fetching data and updating chart:', error);
    }
  }

  // Panggil fungsi fetchDataAndUpdateChart() saat halaman dimuat
  document.addEventListener('DOMContentLoaded', function () {
    fetchDataAndUpdateChart();
  });
  ////------------------------------------------------------------------------------ Batas antar chart
})();
