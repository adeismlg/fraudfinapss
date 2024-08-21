<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorizontalAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'year',
        'previous_year',
        'sales_difference',
        'cost_of_goods_sold_difference',
        'current_assets_difference',
        'plant_property_equipment_difference',
        'sga_expenses_difference',
        'total_assets_difference',
        'depreciation_difference',
        'account_receivables_difference',
        'long_term_debt_difference',
        'current_liabilities_difference',
        'working_capital_difference',
        'cash_difference',
        'current_taxes_payables_difference',
        'depreciation_amortization_difference',
    ];

    // Accessor untuk format Rupiah
    public function getSalesDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getCostOfGoodsSoldDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getCurrentAssetsDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getPlantPropertyEquipmentDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getSgaExpensesDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getTotalAssetsDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getDepreciationDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getAccountReceivablesDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getLongTermDebtDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getCurrentLiabilitiesDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getWorkingCapitalDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getCashDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getCurrentTaxesPayablesDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    public function getDepreciationAmortizationDifferenceAttribute($value)
    {
        return $this->formatRupiah($value);
    }

    // Method untuk memformat angka menjadi format Rupiah
    private function formatRupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
    

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

