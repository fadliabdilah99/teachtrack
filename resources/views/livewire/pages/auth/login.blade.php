<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $user = Auth::user();

        if (Auth::user()->role == 'admin') {
            $this->redirect(route('admin'), navigate: true);
        } elseif (Auth::user()->role === 'siswa' || Auth::user()->role === 'KM' || Auth::user()->role === 'sekertaris') {
            $this->redirect(route('siswa'), navigate: true);
        } elseif (Auth::user()->role === 'guru' || Auth::user()->role == 'konseling') {
            $this->redirect(route('guru'), navigate: true);
        } elseif (Auth::user()->role === 'penjual') {
            $this->redirect(route('seller'), navigate: true);
        } else {
            // $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>
<div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 light:bg-opacity-80">
    <div class="w-full max-w-md p-6 mx-auto bg-white rounded-lg shadow-lg light:bg-gray-800">
        <div class="flex items-center justify-center">
            <img class="h-20 w-100" src="{{ asset('assets/images/logos/TEACHTRACK.png') }}" >
        </div>

        <p class=" text-xl text-center text-gray-600 light:text-gray-200">
            Welcome back!
        </p>

        <form wire:submit="login">
            <!-- Email -->
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-600 light:text-gray-200"
                    for="LoggingEmailAddress">Email Address</label>
                <input wire:model="form.email" id="LoggingEmailAddress"
                    class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg light:bg-gray-800 light:text-gray-300 light:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 light:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300"
                    type="email" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <div class="flex justify-between">
                    <label class="block mb-2 text-sm font-medium text-gray-600 light:text-gray-200"
                        for="loggingPassword">Password</label>
                    <a href="{{ route('password.request') }}"
                        class="text-xs text-gray-500 light:text-gray-300 hover:underline">Forgot Password?</a>
                </div>
                <input wire:model="form.password" id="loggingPassword"
                    class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg light:bg-gray-800 light:text-gray-300 light:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 light:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300"
                    type="password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2 text-sm text-gray-600 light:text-gray-400">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button
                    class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>
