<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role='client';
    public string $phone;
    public string $cnic;
    public string $registration='';
    public string $area='Criminal Lawyer';
    public string $city='Islamabad';
    public string $password_confirmation = '';
    public string $error='';
    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {       
       //dd($this->registration);
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' =>['required'],
            'phone' =>['required'],
            'cnic' =>['required'],
            'city' =>['required'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()]
        ]);
        $validated['registration']=$this->registration;
        $validated['area']=$this->area;
       
        if($this->role=="lawyer" && $this->registration=="")
        {            
         $error="Please provide valid Registrtion Number";   
        }
        else if($this->role=="lawyer" && $this->area=="")
        {
            $error="Please select Area of Specilization"; 
        }else{
            
            $validated['password'] = Hash::make($validated['password']);
            event(new Registered($user = User::create($validated)));            
            Auth::login($user);
            $this->redirect(route('login'));
            //$this->redirect(route('dashboard', absolute: false), navigate: false);
        }
        
        
    }
}; ?>

<div>
@error('firstname')
    <div class="error">{{ $message }}</div>
@enderror
    <form wire:submit="register">
        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" />
            <select wire:model.live="role" style="width: 100%;">
                <option value="client">Client</option>
                <option value="lawyer">Lawyer</option>
            </select>
            <!-- <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-200 p-4"><input type="radio" wire:model="role" value="lawyer" name="role"> &nbsp;Lawyer</div>
                <div class="bg-gray-200 p-4"><input type="radio" wire:model="role" value="client" checked="checked" name="role"> &nbsp;Client</div>
            </div> -->
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

         <!-- Registration -->
         @if($role=="lawyer")
         <div class="mt-4">
            <x-input-label for="registration" :value="__('Registration Number')"/>
            <x-text-input wire:model="registration" id="registration" class="block mt-1 w-full"/>
            <x-input-error :messages="$errors->get('registration')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-input-label for="area" :value="__('Area of Practice')" />
            <select wire:model="area" style="width: 100%;">
                <option value="Criminal">Criminal</option>
                <option value="Corporate">Corporate</option>
                <option value="Immigration">Immigration</option>
                <option value="Family">Family</option>
                <option value="Bankruptcy">Bankruptcy</option>
                <option value="Durg Norcotics">Durg Norcotics</option>
                <option value="Tax Lawyer">Tax Lawyer</option>
                <option value="Real estate">Real estate</option>
            </select>           
            <x-input-error :messages="$errors->get('area')" class="mt-2" />
        </div>
        @endif
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
            
         <!-- Phone -->
         <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" required autocomplete="username" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
         <!-- CNIC -->
         <div class="mt-4">
            <x-input-label for="cnic" :value="__('CNIC')" />
            <x-text-input wire:model="cnic" id="cnic" class="block mt-1 w-full" type="text" required autocomplete="username" />
            <x-input-error :messages="$errors->get('cnic')" class="mt-2" />
        </div>

         <!-- City -->
         <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <select wire:model="city" style="width: 100%;">
                <option value="Islamabad">Islamabad</option>
                <option value="Rawalpindi">Rawalpindi</option>
                <option value="Lahore">Lahore</option>
                <option value="Peshawar">Peshawar</option>
                <option value="Peshawar">Peshawar</option>
                <option value="Quetta">Quetta</option>
            </select>
            <!-- <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-200 p-4"><input type="radio" wire:model="role" value="lawyer" name="role"> &nbsp;Lawyer</div>
                <div class="bg-gray-200 p-4"><input type="radio" wire:model="role" value="client" checked="checked" name="role"> &nbsp;Client</div>
            </div> -->
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

         <!-- Email Address -->
         <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>  

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
