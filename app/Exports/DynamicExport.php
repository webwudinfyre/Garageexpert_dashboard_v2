<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DynamicExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $headings;

    /**
     * Constructor to accept dynamic data and headings.
     *
     * @param array $data
     * @param array $headings
     */
    public function __construct(array $data, array $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    /**
     * Return the collection of data for the Excel file.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Set the headings for the Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return $this->headings;
    }
}
