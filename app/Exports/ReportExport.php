<?php

namespace App\Exports;

use App\Model\RedeemPoint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return RedeemPoint::all();
    }

    public function headings(): array{
        return [
            '#',
            'ชื่อสมาชิก',
            'พันธมิตร',
            'โปรโมชั่น',
            '',
            'วันที่รับสิทธิ์',
            'CODE',
        ];
    }
}
