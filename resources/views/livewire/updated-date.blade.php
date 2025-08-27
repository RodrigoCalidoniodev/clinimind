<div>
    <div>
        <x-input-label for="service" :value="__('Service')" />
        <select id="service" wire:change="selectedService($event.target.value)" class="w-64 mb-4 dark:bg-[#1C2B2D] dark:text-gray-200">
            <option value="" selected disabled>{{ __('-- Select a service --') }}</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}">{{ $service->getTranslatedName() }}</option>
            @endforeach
        </select>
    </div>

    <div wire:ignore class="mb-4">
        <x-input-label for="updateDate" :value="__('Date of appointment')" />

        <input 
            id="updateDate" 
            type="text" 
            class="datepicker dark:bg-[#1C2B2D] dark:text-gray-200 dark:placeholder-gray-200 w-64" 
            placeholder="Selecciona una fecha"
        >
    </div>

    @if(!empty($selectedServiceId) && !empty($updateDate))
        <div class="grid grid-cols-4 gap-2">
            @foreach ($hours as $hour)
                <div {{ $hour['status'] === 'available' ? 'wire:click=selectHour('.$hour['id'].')' : '' }} class="p-3 cursor-pointer rounded-lg {{ $hour['status'] === 'unavailable' ? 'bg-gray-900 text-white cursor-not-allowed' : ($selectedHourId === $hour['id'] ? 'bg-[#024333] text-lime-400' : 'bg-lime-400 text-[#024333] hover:bg-lime-500 transition-colors') }}">
                    <p>{{ \Carbon\Carbon::createFromFormat('H:i:s', $hour['hour'])->format('h:i A') }}</p>
                </div>
            @endforeach
        </div>

        @if(isset($selectedHourId))
            <div class="mt-4">
                <button onclick="AppointmentInfo()" class="p-3 bg-blue-500 hover:bg-blue-800 text-white rounded-lg transition-colors">
                    {{ __('Save') }}
                </button>
            </div>
        @endif
    @endif

    @push('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.initializeAppointmentFlatpickr('updateDate', @this);
        });

        document.addEventListener('livewire:navigated', function() {
            window.initializeAppointmentFlatpickr('updateDate', @this);
        });

        document.addEventListener('livewire:update', function() {
            window.initializeAppointmentFlatpickr('updateDate', @this);
        });

        function AppointmentInfo() {
            const servicio = @this.get('selectedServiceName') ?? '';
            const fechaRaw = @this.get('updateDate') ?? '';
            const horaRaw = @this.get('selectedHourName') ?? '';

            const translations = {
                confirmTitle: '{{ __("Confirm Appointment") }}',
                service: '{{ __("Service") }}',
                date: '{{ __("Date of appointment") }}',
                hour: '{{ __("Hour") }}',
                confirm: '{{ __("Yes, confirm") }}',
                cancel: '{{ __("Cancel") }}'
            };

            window.showAppointmentConfirmation(servicio, fechaRaw, horaRaw, translations)
                .then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('confirmAppointment');
                    }
                });
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('showAlert', (data) => {
                const alertData = Array.isArray(data) ? data[0] : data;

                window.showAlert(alertData.type, alertData.title, alertData.message);
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('clearFormInputs', () => {
                const serviceSelect = document.getElementById('service');
                if(serviceSelect) {
                    serviceSelect.value = '';
                }

                const dateInput = document.getElementById('updateDate');
                if(dateInput && dateInput._flatpickr) {
                    dateInput._flatpickr.clear();
                }
            });
        });
    </script>
    @endpush
</div>