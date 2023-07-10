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
        $query = ProcurementData::with('category', 'spendCategory')
            ->where('firm_name', 'like', '%'.$this->search.'%')
            ->orWhere('certificate_number', 'like', '%'.$this->search.'%')
            ->orWhere('agpo_cert_no', 'like', '%'.$this->search.'%')
            ->orWhere('postal_address', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('mobile_number', 'like', '%'.$this->search.'%')
            ->orWhereHas('category', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('spendCategory', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhere('procurement_number', 'like', '%'.$this->search.'%')
            ->orWhere('procurement_method', 'like', '%'.$this->search.'%');

        // Perform numeric comparison if the search term is numeric
        if (is_numeric($this->search)) {
            $query->orWhere('amount', $this->search);
        }

        return view('livewire.procurement-data-table', ['data' => $query->paginate(10)]);
    }

}
