@extends('layouts.admin')

@section('content')
<p class='text-center mt-3 mb-3 fs-4'>
    <span class='text-success'>
        {{ $user->fullname }}
    </span>
    <span>به پنل مدیریت خوش آمدید</span>
</p>
<div class='download-state'>
    <h4 class="mb-2 text-center fs-6 text-body-secondary">دانلود روزانه (۱۵ روز گذشته)</h4>
    <div style="height:250px">
        <canvas id="dailyMixedChart"></canvas>
    </div>
</div>

<script src="{{ asset('js/chart.js') }}"></script>
<script>
    function mixedChart(ctxId, labels, fileData, packageData) {
        const ctx = document.getElementById(ctxId).getContext('2d');
        const totalData = fileData.map((f,i)=>f + packageData[i]);

        new Chart(ctx, {
            data: {
                labels: labels,
                datasets: [
                    {
                        type: 'bar',
                        label: 'فایل‌ها',
                        data: fileData,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderRadius: 6
                    },
                    {
                        type: 'bar',
                        label: 'پکیج‌ها',
                        data: packageData,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderRadius: 6
                    },
                    {
                        type: 'line',
                        label: 'مجموع',
                        data: totalData,
                        borderColor: '#333',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: {
                    x: { stacked: false, title:{display:true,text:'تاریخ'} },
                    y: { beginAtZero:true, title:{display:true,text:'تعداد دانلود'} }
                }
            }
        });
    }

    mixedChart('dailyMixedChart', @json($dailyLabels), @json($dailyFileData), @json($dailyPackageData));
</script>

@endsection