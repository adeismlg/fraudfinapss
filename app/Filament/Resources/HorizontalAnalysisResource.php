<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HorizontalAnalysisResource\Pages;
use App\Models\HorizontalAnalysis;
use App\Models\Company;
use App\Models\FinancialData;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class HorizontalAnalysisResource extends Resource
{
    protected static ?string $model = HorizontalAnalysis::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('company_id')
                    ->label('Select Company')
                    ->options(Company::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => self::getAvailableYears($state, $set)),
                Select::make('year')
                    ->label('Select Year')
                    ->options(fn(callable $get) => self::getAvailableYears($get('company_id')))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set, callable $get) => self::loadFinancialData($get('company_id'), $state, $get('previous_year'), $set)),
                Select::make('previous_year')
                    ->label('Select Previous Year')
                    ->options(fn(callable $get) => self::getAvailableYears($get('company_id')))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set, callable $get) => self::loadFinancialData($get('company_id'), $get('year'), $state, $set)),

                // Semua field perbedaan, diformat dengan closure
                TextInput::make('sales_difference')
                    ->label('Sales Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('cost_of_goods_sold_difference')
                    ->label('COGS Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('current_assets_difference')
                    ->label('Current Assets Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('plant_property_equipment_difference')
                    ->label('Plant, Property & Equipment Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('sga_expenses_difference')
                    ->label('SGA Expenses Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('total_assets_difference')
                    ->label('Total Assets Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('depreciation_difference')
                    ->label('Depreciation Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('account_receivables_difference')
                    ->label('Account Receivables Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('long_term_debt_difference')
                    ->label('Long Term Debt Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('current_liabilities_difference')
                    ->label('Current Liabilities Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('working_capital_difference')
                    ->label('Working Capital Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('cash_difference')
                    ->label('Cash Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('current_taxes_payables_difference')
                    ->label('Current Taxes Payables Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextInput::make('depreciation_amortization_difference')
                    ->label('Depreciation & Amortization Difference')
                    ->disabled()
                    ->afterStateHydrated(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')->label('Company'),
                Tables\Columns\TextColumn::make('year')->label('Year'),
                Tables\Columns\TextColumn::make('previous_year')->label('Previous Year'),
                Tables\Columns\TextColumn::make('sales_difference')->label('Sales Difference'),
                Tables\Columns\TextColumn::make('cost_of_goods_sold_difference')->label('COGS Difference'),
                Tables\Columns\TextColumn::make('current_assets_difference')->label('Current Assets Difference'),
                Tables\Columns\TextColumn::make('plant_property_equipment_difference')->label('Plant, Property & Equipment Difference'),
                Tables\Columns\TextColumn::make('sga_expenses_difference')->label('SGA Expenses Difference'),
                Tables\Columns\TextColumn::make('total_assets_difference')->label('Total Assets Difference'),
                Tables\Columns\TextColumn::make('depreciation_difference')->label('Depreciation Difference'),
                Tables\Columns\TextColumn::make('account_receivables_difference')->label('Account Receivables Difference'),
                Tables\Columns\TextColumn::make('long_term_debt_difference')->label('Long Term Debt Difference'),
                Tables\Columns\TextColumn::make('current_liabilities_difference')->label('Current Liabilities Difference'),
                Tables\Columns\TextColumn::make('working_capital_difference')->label('Working Capital Difference'),
                Tables\Columns\TextColumn::make('cash_difference')->label('Cash Difference'),
                Tables\Columns\TextColumn::make('current_taxes_payables_difference')->label('Current Taxes Payables Difference'),
                Tables\Columns\TextColumn::make('depreciation_amortization_difference')->label('Depreciation & Amortization Difference'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('company')
                    ->label('Company')
                    ->relationship('company', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHorizontalAnalyses::route('/'),
            'create' => Pages\CreateHorizontalAnalysis::route('/create'),
            'edit' => Pages\EditHorizontalAnalysis::route('/{record}/edit'),
        ];
    }

    private static function getAvailableYears($companyId)
    {
        if (!$companyId) {
            return [];
        }

        return FinancialData::where('company_id', $companyId)
            ->orderBy('year', 'desc')
            ->pluck('year', 'year')
            ->toArray();
    }

    private static function loadFinancialData($companyId, $year, $previousYear, callable $set)
    {
        if ($companyId && $year && $previousYear) {
            $currentYearData = FinancialData::where('company_id', $companyId)
                ->where('year', $year)
                ->first();

            $previousYearData = FinancialData::where('company_id', $companyId)
                ->where('year', $previousYear)
                ->first();

            if ($currentYearData && $previousYearData) {
                $set('sales_difference', $currentYearData->sales - $previousYearData->sales);
                $set('cost_of_goods_sold_difference', $currentYearData->cost_of_goods_sold - $previousYearData->cost_of_goods_sold);
                $set('current_assets_difference', $currentYearData->current_assets - $previousYearData->current_assets);
                $set('plant_property_equipment_difference', $currentYearData->plant_property_equipment - $previousYearData->plant_property_equipment);
                $set('sga_expenses_difference', $currentYearData->sga_expenses - $previousYearData->sga_expenses);
                $set('total_assets_difference', $currentYearData->total_assets - $previousYearData->total_assets);
                $set('depreciation_difference', $currentYearData->depreciation - $previousYearData->depreciation);
                $set('account_receivables_difference', $currentYearData->account_receivables - $previousYearData->account_receivables);
                $set('long_term_debt_difference', $currentYearData->long_term_debt - $previousYearData->long_term_debt);
                $set('current_liabilities_difference', $currentYearData->current_liabilities - $previousYearData->current_liabilities);
                $set('working_capital_difference', $currentYearData->working_capital - $previousYearData->working_capital);
                $set('cash_difference', $currentYearData->cash - $previousYearData->cash);
                $set('current_taxes_payables_difference', $currentYearData->current_taxes_payables - $previousYearData->current_taxes_payables);
                $set('depreciation_amortization_difference', $currentYearData->depreciation_amortization - $previousYearData->depreciation_amortization);
            }
        }
    }
}
