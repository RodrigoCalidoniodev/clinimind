<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Hour;
use App\Models\Service;
use App\Models\Status;
use Livewire\Component;

class UpdatedDate extends Component
{

    public $services = [];
    public $hours = [];
    public $availableHours  = [];
    public $unavailableHours  = [];
    public $updateDate = null;
    public $selectedHourId;
    public $selectedHourName;
    public $selectedServiceId = null;
    public $selectedServiceName;

    protected $listeners = ['confirmAppointment' => 'confirmAppointment'];


    public function mount()
    {
        $this->services = Service::all(['id', 'name_es', 'name_en']);
    }

    public function updatedUpdateDate()
    {
        $hoursTaken = Appointment::where('date', $this->updateDate)->pluck('hour_id');

        $this->hours = Hour::all(['id','hour'])
            ->map(function ($hour) use ($hoursTaken) {
                return [
                    'id' => $hour->id,
                    'hour' => $hour->hour,
                    'status' => $hoursTaken->contains($hour->id) ? 'unavailable' : 'available'
                ];
            })
            ->toArray();
    }

    public function confirmAppointment()
    {
        $this->validate([
            'updateDate' => 'required|date',
            'selectedHourId' => 'required|exists:hours,id',
            'selectedServiceId' => 'required|exists:services,id',
        ]);

        if($this->validateAppointment()) {
            $this->dispatch('showAlert', ['type' => 'error', 'title' => __('Error'), 'message' => __('Failed to schedule appointment')]);
            return;
        }

        $this->createAppointment();
    }

    public function validateAppointment()
    {
        $existingAppointment = Appointment::where('date', $this->updateDate)
            ->where('hour_id', $this->selectedHourId)
            ->exists();

        return $existingAppointment;
    }

    public function createAppointment()
    {
        Appointment::create([
            'date' => $this->updateDate,
            'user_id' => auth()->user()->id,
            'service_id' => $this->selectedServiceId,
            'hour_id' => $this->selectedHourId
        ]);

        $this->reset(['updateDate', 'selectedHourId', 'selectedServiceId', 'selectedHourName', 'selectedServiceName']);

        $this->dispatch('clearFormInputs');
        $this->dispatch('appointmentCreated');

        $this->dispatch('showAlert', ['type' => 'success', 'title' => __('Success'), 'message' => __('Appointment scheduled successfully')]);
    }

    public function selectedService($service)
    {
        $selectedService = Service::find($service);

        if($selectedService)
        {
            $this->selectedServiceId = $selectedService['id'];
            $this->selectedServiceName = $selectedService->getTranslatedName();
        }
    }
    
    public function selectHour($hour)
    {
        $selectedHour = Hour::find($hour);

        if ($selectedHour) {
            $this->selectedHourId = $selectedHour['id'];
            $this->selectedHourName = $selectedHour['hour'];
        }
    }

    public function render()
    {
        return view('livewire.updated-date');
    }
}
