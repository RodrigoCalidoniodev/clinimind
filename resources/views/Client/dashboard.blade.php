<x-app-layout>

    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Panel de administración de citas') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between gap-4">

                <div class="bg-white dark:bg-[#172325] overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h2 class="text-xl mb-4 text-center text-gray-700 dark:text-lime-400">
                        {{ __('Agendar nueva cita') }}
                    </h2>

                    <p class="text-gray-300 text-sm mb-4 text-center">{{ __('Select a service and a date to schedule your appointment.') }}</p>

                    <livewire:updated-date />
                </div>

                <div class="bg-white dark:bg-[#172325] overflow-hidden shadow-sm sm:rounded-lg p-4 h-44">

                    <h2 class="text-xl mb-4 text-center text-gray-700 dark:text-lime-400">
                        {{ __('Información del cliente') }}
                    </h2>

                    <p class="font-bold mb-2 dark:text-gray-200">
                        {{ __('Nombre:') }} <span class="font-normal text-lime-400">{{ auth()->user()->name }}</span>
                    </p>

                    <p class="font-bold mb-2 dark:text-gray-200">
                        {{ __('Correo electrónico:') }} <span class="font-normal dark:text-gray-300">{{ auth()->user()->email }}</span>
                    </p>

                    <livewire:active-appointments />
                </div>
            </div>

            <div class="bg-red-200 dark:bg-red-500 overflow-hidden shadow-sm sm:rounded-lg">
                
            </div>
        </div>
    </div>
</x-app-layout>