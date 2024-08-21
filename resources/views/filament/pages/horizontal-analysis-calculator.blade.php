<x-filament::page>
    <div>
        {{ $this->form }}

        @if($currentYearData && $previousYearData)
            <div class="mt-6">
                <h3 class="text-xl font-bold">Selected Year Data ({{ $year }})</h3>
                <p>Sales: {{ $currentYearData->sales }}</p>
                <p>Cost of Goods Sold: {{ $currentYearData->cost_of_goods_sold }}</p>
                <p>Net Income: {{ $currentYearData->calculateNetIncome() }}</p>

                <h3 class="text-xl font-bold mt-4">Previous Year Data ({{ $previous_year }})</h3>
                <p>Sales: {{ $previousYearData->sales }}</p>
                <p>Cost of Goods Sold: {{ $previousYearData->cost_of_goods_sold }}</p>
                <p>Net Income: {{ $previousYearData->calculateNetIncome() }}</p>

                @if($calculatedData)
                    <h3 class="text-xl font-bold mt-4">Horizontal Analysis Result</h3>
                    <p>Sales Difference: {{ $calculatedData['sales_difference'] }}</p>
                    <p>Sales % Change: {{ $calculatedData['sales_percentage_change'] }}%</p>
                    <p>COGS Difference: {{ $calculatedData['cost_of_goods_sold_difference'] }}</p>
                    <p>COGS % Change: {{ $calculatedData['cost_of_goods_sold_percentage_change'] }}%</p>
                    <p>Net Income Difference: {{ $calculatedData['net_income_difference'] }}</p>
                    <p>Net Income % Change: {{ $calculatedData['net_income_percentage_change'] }}%</p>
                @endif

                <x-filament::button wire:click="saveHorizontalAnalysis" color="success" class="mt-4">
                    Save Analysis
                </x-filament::button>
            </div>
        @endif
    </div>
</x-filament::page>
