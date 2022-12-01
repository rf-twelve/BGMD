<?php

namespace App\Http\Livewire\DataTable;

trait WithBulkActions
{
    public $selectPage = false;
    public $selectAll = false;
    public $selected = [];

    // public function initializeWithBulkActions()
    // {
    //     $this->beforeRender(function () {
    //         if ($this->selectAll) $this->selectPageRows();
    //     });
    // }

    public function updatedSelected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        if ($value) return $this->selectPageRows();

        $this->selectAll = false;
        $this->selected = [];
    }

    public function selectPageRows()
    {
        $this->selected = $this->rows->pluck('id')->map(fn($id) => (string) $id);
    }

    public function selectAll()
    {
        // $this->selectAll = true;
        // dd($this->selectAll);
        $this->selected = $this->rowsQuery->pluck('id')->map(fn($id) => (string) $id);

    }

    public function getSelectedRowsQueryProperty()
    {
        return (clone $this->rowsQuery)
            ->unless($this->selectAll, fn($query) => $query->whereKey($this->selected));
    }
}
