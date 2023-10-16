<?php

namespace App\Exports;

use App\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportMemberExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return Member::all();
    }

    public function headings(): array{
        return [
            '#',
            'รหัสสมาชิก',
            'หมายเลขบัตรประชาชน',
            'คำนำหน้า',
            'ชื่อ',
            'นามสกุล',
            'วัน/เดือน/ปีเกิด',
            'เบอร์โทรศัพท์',
            'วันที่สมัครสมาชิก',
            'สถานะ',
        ];
    }
}
