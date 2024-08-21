<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'year',
        'sales',
        'cost_of_goods_sold',
        'current_assets',
        'plant_property_equipment',
        'sga_expenses',
        'total_assets',
        'depreciation',
        'account_receivables',
        'long_term_debt',
        'current_liabilities',
        'working_capital',
        'cash',
        'current_taxes_payables',
        'depreciation_amortization',
    ];

    /**
     * Get the company that owns the financial data.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Scope a query to only include financial data for a specific year.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Scope a query to only include financial data for a specific company.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $companyId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    /**
     * Calculate the net income based on financial data.
     *
     * @return int
     */
    public function calculateNetIncome()
    {
        return $this->sales - $this->cost_of_goods_sold - $this->sga_expenses - $this->depreciation;
    }

    /**
     * Calculate the working capital.
     *
     * @return int
     */
    public function calculateWorkingCapital()
    {
        return $this->current_assets - $this->current_liabilities;
    }

    /**
     * Calculate the total debt.
     *
     * @return int
     */
    public function calculateTotalDebt()
    {
        return $this->long_term_debt + $this->current_liabilities;
    }
}
