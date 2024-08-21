<?php

namespace App\Services;

use App\Models\FinancialData;

class FinancialDataService
{
    public function calculateDifferences(int $companyId)
    {
        // Implementasikan logika untuk menghitung perbedaan atau operasi lainnya
        $data = FinancialData::where('company_id', $companyId)->get();

        // Contoh sederhana: hitung total sales dan perbedaannya
        $totalSales = $data->sum('sales');
        $difference = $totalSales - $data->first()->sales;

        // Lakukan sesuatu dengan hasilnya...
    }
}
