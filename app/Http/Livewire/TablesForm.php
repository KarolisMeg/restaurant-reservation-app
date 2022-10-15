<?php

namespace App\Http\Livewire;

use App\Models\Table;
use Livewire\Component;

class TablesForm extends Component
{
    public $restaurant;

    public $seats;

    protected $rules = [
        'seats' => 'required',
    ];

    public function addTable()
    {
        $this->validate();
        $table = new Table();
        $table->seats = $this->seats;
        $this->restaurant->tables()->save($table);

        redirect()->route('restaurant', ['id' => $this->restaurant->id]);
    }

    public function deleteTable($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        redirect()->route('restaurant', ['id' => $this->restaurant->id]);
    }

    public function render()
    {
        return view('livewire.tables-form');
    }
}
