<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProcurementData;

class ProcurementDataTable extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.procurement-data-table', [
            'data' => ProcurementData::where('firm_name', 'like', '%'.$this->search.'%')
                ->orWhere('certificate_number', 'like', '%'.$this->search.'%')
                ->paginate(10)
        ]);
    }
}
