<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoriesExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    private $userId;
    private $isAdmin;

    public function __construct($userId, $isAdmin = false)
    {
        $this->userId = $userId;
        $this->isAdmin = $isAdmin;
    }

    public function query()
    {
        if ($this->isAdmin) {
            return Category::query()->with('user');
        }
        
        return Category::query()->where('user_id', $this->userId);
    }

    public function headings(): array
    {
        $headings = ['No', 'Nama Kategori', 'Deskripsi', 'Tanggal Dibuat', 'Tanggal Diperbarui'];
        
        if ($this->isAdmin) {
            array_splice($headings, 3, 0, 'Merchant');
        }
        
        return $headings;
    }

    public function map($category): array
    {
        static $count = 1;
        
        $row = [
            $count++,
            $category->name,
            $category->description ?? '-',
            $category->created_at->format('d-m-Y H:i'),
            $category->updated_at->format('d-m-Y H:i'),
        ];

        if ($this->isAdmin) {
            array_splice($row, 3, 0, $category->user->name ?? '-');
        }

        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '366092',
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}
