<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-zinc-50 dark:bg-[#1C2B2D] h-24 p-4 w-full md:flex md:justify-items-center md:items-center border-b md:border-none border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16 md:flex-col md:items-center md:justify-between z-10">

            <!-- Logo -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block fill-current md:w-32 md:h-32 text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
            </div>
            
            <!-- Links and Options -->
            <div class="flex justify-between">

                <!-- Navigation Links -->
                <div class="hidden items-center sm:-my-px sm:ms-10 md:ms-0 md:m-0 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="route('how-it-works')" :active="request()->routeIs('how-it-works')" wire:navigate>
                        {{ __('How does CliniMind web work?') }}
                    </x-nav-link>

                     <x-nav-link :href="route('about')" :active="request()->routeIs('about')" wire:navigate>
                        {{ __('About us') }}
                    </x-nav-link>


                    <x-nav-link :href="route('testimonials')" :active="request()->routeIs('testimonials')" wire:navigate>
                        {{ __('Testimonials') }}
                    </x-nav-link>

                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" wire:navigate>
                        {{ __('Contact') }}
                    </x-nav-link>

                    @auth
                        @if(auth()->user()->hasVerifiedEmail())
                            <a class="bg-lime-400 text-[#024333] font-bold rounded-md p-3 ml-4 flex justify-center items-center hover:bg-[#024333] hover:text-lime-400 dark:hover:bg-lime-300 dark:hover:text-[#024333] transition ease-in-out" href="{{ route('client.index') }}" wire:navigate>
                            {{ __('Appointments') }}
                            </a> 
                        @endif
                    @endauth
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6 md:ms-4 md:m-0">
                    @auth
                        <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-lime-500 dark:border-lime-400 text-sm leading-4 font-medium rounded-md text-lime-500 hover:text-lime-400 dark:text-lime-400 bg-zinc-50 dark:bg-[#1C2B2D] dark:hover:text-lime-500 transition ease-in-out duration-150">

                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                    @endauth

                    @guest
                        <a class="bg-lime-400 text-[#024333] font-bold rounded-md p-3 ml-4 flex justify-center items-center hover:bg-[#024333] hover:text-lime-400 dark:hover:bg-lime-300 dark:hover:text-[#024333] transition ease-in-out" href="{{ route('login') }}" wire:navigate>
                        {{ __('Login') }}
                        </a>

                        <a class="bg-[#172325] text-lime-400 font-bold rounded-md p-3 ml-4 flex justify-center items-center hover:bg-[#024333] hover:text-lime-400 dark:hover:bg-[#024333] transition ease-in-out" href="{{ route('register') }}" wire:navigate>
                        {{ __('Register') }}
                        </a>
                    @endguest
                </div>
            </div>
                
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-lime-400 hover:text-gray-500 dark:hover:text-lime-500 hover:bg-gray-100 dark:hover:bg-[#172325] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden absolute top-0 left-0 w-full bg-zinc-50 dark:bg-[#1C2B2D] shadow-md min-h-screen mt-32">
        
        @auth
            <div class="py-4 border-y border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>
        @endauth
        
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                        {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('how-it-works')" :active="request()->routeIs('how-it-works')" wire:navigate>
                {{ __('How does CliniMind web work?') }}
            </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" wire:navigate>
                {{ __('About us') }}
            </x-responsive-nav-link>


            <x-responsive-nav-link :href="route('testimonials')" :active="request()->routeIs('testimonials')" wire:navigate>
                {{ __('Testimonials') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" wire:navigate>
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="mt-3 space-y-1">    
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>    

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            @endauth

            @guest
                <div class="mt-3 space-y-1">    
                    <x-responsive-nav-link :href="route('login')" wire:navigate>
                        {{ __('Login') }}
                    </x-responsive-nav-link>    

                    <x-responsive-nav-link :href="route('register')" wire:navigate>
                        {{ __('Register') }}
                    </x-responsive-nav-link>  
                </div>
            @endguest
        </div>
    </div>
</nav>
