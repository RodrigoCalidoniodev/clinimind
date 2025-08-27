<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ActiveAppointments extends Component
{

    public $amount;

    public function mount()
    {
        $this->amount = auth()->user()->appointments()->count();
    }

    #[On('appointmentCreated')]
    //#[On('appointmentDeleted')] // Para cuando implementes eliminar citas
    //#[On('appointmentUpdated')] // Para cuando implementes editar citas
    public function refreshAmount()
    {
        $this->amount = auth()->user()->appointments()->count();
    }

    public function render()
    {
        return view('livewire.active-appointments');
    }
}
