document.addEventListener('DOMContentLoaded', function () {
    let chart;
    const favoriteProductCtx = document.getElementById('favoriteProductChart');
    const viewProductCtx = document.getElementById('viewProductChart');
    const newsCtx = document.getElementById('newsChart');

    const APIList = {
        favoriteProductsApi: '/api/top-favorite-products',
        viewProductsApi: '/api/top-view-products',
        watchNewsApi: '/api/top-watch-news',
    };

    const favoriteProductChart = createChart(favoriteProductCtx, 'Top sản phẩm được yêu thích', 'Lượt yêu thích');
    const viewProductChart = createChart(viewProductCtx, 'Top sản phẩm được xem nhiều nhất', 'Lượt xem');
    const newsChart = createChart(newsCtx, 'Top tin tức đọc nhiều nhất', 'Lượt đọc');

    fetchDataAndRenderChart(APIList.favoriteProductsApi, favoriteProductChart, 'favorite', 'Sản phẩm');
    fetchDataAndRenderChart(APIList.viewProductsApi, viewProductChart, 'view', 'Sản phẩm');
    fetchDataAndRenderChart(APIList.watchNewsApi, newsChart, 'watch', 'Tin tức');

    function createChart(ctx, title, yAxisLabel) {
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Đang tải dữ liệu...'],
                datasets: [{
                    label: yAxisLabel,
                    data: [0],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: title,
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: yAxisLabel
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Sản phẩm'
                        }
                    }
                }
            }
        });
    }

    function fetchDataAndRenderChart(apiUrl, chartInstance, valueKey, xAxisLabel) {
        fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'include'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(response => {
            if (response.status && response.data && response.data.length > 0) {
                const labels = response.data.map(item => item.name || item.title);
                const values = response.data.map(item => item[valueKey]);
                const backgroundColors = generateGradientColors(values.length, 0.7);
                const borderColors = generateGradientColors(values.length, 1);
    
                chartInstance.data.labels = labels;
                chartInstance.data.datasets[0].data = values;
                chartInstance.data.datasets[0].backgroundColor = backgroundColors;
                chartInstance.data.datasets[0].borderColor = borderColors;
    
                // 🛠️ Thay đổi label trục X
                chartInstance.options.scales.x.title.text = xAxisLabel;
    
                chartInstance.update();
            } else {
                chartInstance.data.labels = ['Không có dữ liệu'];
                chartInstance.data.datasets[0].data = [0];
                chartInstance.update();
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu từ:', apiUrl, error);
            chartInstance.data.labels = ['Lỗi khi tải dữ liệu'];
            chartInstance.data.datasets[0].data = [0];
            chartInstance.update();
        });
    }
    

    function generateGradientColors(count, opacity) {
        const baseColors = [
            `rgba(54, 162, 235, ${opacity})`,
            `rgba(255, 99, 132, ${opacity})`,
            `rgba(255, 206, 86, ${opacity})`,
            `rgba(75, 192, 192, ${opacity})`,
            `rgba(153, 102, 255, ${opacity})`,
            `rgba(255, 159, 64, ${opacity})`,
        ];

        return Array.from({ length: count }, (_, i) => baseColors[i % baseColors.length]);
    }

    function renderRevenueChart(data) {
        const labels = data.map(item => {
            const date = new Date(item.period);
            return `${date.getDate()}/${date.getMonth() + 1}`;
        });
    
        const values = data.map(item => item.revenue);
        const ctx = document.getElementById('revenueChart').getContext('2d');
    
        if (chart) chart.destroy();
    
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: values,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => new Intl.NumberFormat('vi-VN').format(value) + 'đ'
                        }
                    }
                }
            }
        });
    }
    
    function fetchRevenueData() {
        const from = document.getElementById('from').value;
        const to = document.getElementById('to').value;
    
        fetch(`/admin/revenue-chart?from=${from}&to=${to}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Không lấy được dữ liệu doanh thu');
            return res.json();
        })
        .then(data => {
            renderRevenueChart(data);
        })
        .catch(error => {
            console.error(error);
        });
    }

    document.getElementById('filter-button').addEventListener('click', fetchRevenueData);

    fetchRevenueData();

    const orderStatusCtx = document.getElementById('orderStatusChart');
    const orderStatusChart = createPieChart(orderStatusCtx, 'Số đơn hàng theo trạng thái');

    fetchOrderStatusData();

    function createPieChart(ctx, title) {
        return new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Đang tải dữ liệu...'],
                datasets: [{
                    label: 'Trạng thái đơn hàng',
                    data: [0],
                    backgroundColor: [], // Customize as needed
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: title,
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    function fetchOrderStatusData() {
        const statusViMapping = {
            'CONFIRMED': 'Đã xác nhận',
            'SHIPPING': 'Đang giao',
            'CANCELLED': 'Đã hủy',
            'DONE': 'Hoàn tất',
            'PENDING': 'Chờ xác nhận',
        };
    
        const colorMapping = {
            'Chờ xác nhận': '#6B7280',
            'Đã xác nhận': '#3B82F6',
            'Đang giao': '#F59E0B',
            'Hoàn tất': '#16A34A',      
            'Đã hủy': '#EF4444'     
        };
    
        fetch('/api/order-status', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'include'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status && data.data) {
                const labels = data.data.map(item => statusViMapping[item.status] ?? item.status);
                const values = data.data.map(item => item.order_count);
                const backgroundColors = labels.map(label => colorMapping[label] || '#CCCCCC');
    
                orderStatusChart.data.labels = labels;
                orderStatusChart.data.datasets[0].data = values;
                orderStatusChart.data.datasets[0].backgroundColor = backgroundColors;
                orderStatusChart.update();
            } else {
                orderStatusChart.data.labels = ['Không có dữ liệu'];
                orderStatusChart.data.datasets[0].data = [0];
                orderStatusChart.update();
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu trạng thái đơn hàng:', error);
            orderStatusChart.data.labels = ['Lỗi khi tải dữ liệu'];
            orderStatusChart.data.datasets[0].data = [0];
            orderStatusChart.update();
        });
    }

});
