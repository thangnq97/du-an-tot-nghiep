<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class RoomChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $room_active = DB::table('rooms')->where('status', '=', 1)->get();
        $room_not_active = DB::table('rooms')->where('status', '=', 0)->get();
        return $this->chart->pieChart()
            ->setTitle('Quản lý phòng')
            ->setSubtitle('Tình trạng phòng')
            ->addData([count($room_not_active), count($room_active)])
            ->setLabels(['Phòng trống', 'Đang thuê']);
    }
}
