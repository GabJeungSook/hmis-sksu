<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @charset="utf-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @filamentStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js "></script>
        <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.1/dist/echarts.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    </head>
    <body class="font-sans antialiased">
        <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div  x-cloak x-data="{ open: false }">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
        <!--
          Off-canvas menu backdrop, show/hide based on off-canvas menu state.

          Entering: "transition-opacity ease-linear duration-300"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "transition-opacity ease-linear duration-300"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80" aria-hidden="true"></div>

        <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-0 flex">
          <!--
            Off-canvas menu, show/hide based on off-canvas menu state.

            Entering: "transition ease-in-out duration-300 transform"
              From: "-translate-x-full"
              To: "translate-x-0"
            Leaving: "transition ease-in-out duration-300 transform"
              From: "translate-x-0"
              To: "-translate-x-full"
          -->
          <div class="relative mr-16 flex w-full max-w-xs flex-1">
            <!--
              Close button, show/hide based on off-canvas menu state.

              Entering: "ease-in-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in-out duration-300"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
              <button @click="open = false" type="button" class="-m-2.5 p-2.5">
                <span class="sr-only">Close sidebar</span>
                <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
              </button>
            </div>

            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-green-600 px-6 pb-2">
              <div class="flex h-16 shrink-0 items-center font-extrabold text-white text-2xl tracking-wider">
                    CAMPUS CLINIC SYSTEM
                {{-- <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=white" alt="Your Company"> --}}
              </div>
              <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                  @if(Auth::user()->role == 'admin')
                  <li>
                    <ul role="list" class="-mx-2 space-y-1">
                      {{-- <li>
                        <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                          </svg>
                          Dashboard
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                          </svg>
                          Users
                        </a>
                      </li>
                      <li>
                          <a href="{{ route('admin.vehicle-type') }}" class="{{ request()->routeIs('admin.vehicle-type') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                              Vehicle Types
                          </a>
                        </li>
                      <li>
                          <a href="{{ route('admin.calendar') }}" class="{{ request()->routeIs('admin.calendar') || request()->routeIs('admin.create-schedule') || request()->routeIs('admin.view-schedule') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                              </svg>
                              Manage Schedules
                          </a>
                        </li>
                        <li>
                          <a wire:navigate href="{{ route('admin.applications') }}" class="{{ request()->routeIs('admin.applications') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                            <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            Applications
                          </a>
                        </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.transactions') }}" class="{{ request()->routeIs('admin.transactions') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                          </svg>
                          Transactions
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.scan-qr') }}" class="{{ request()->routeIs('admin.scan-qr') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                          </svg>
                          Scan QR Code
                        </a>
                      </li>
                      <li>
                          <a wire:navigate href="{{ route('admin.results') }}" class="{{ request()->routeIs('admin.results') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                            <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                            </svg>

                            Result
                          </a>
                        </li> --}}
                    </ul>
                  </li>
                  <li>
                    <div class="text-xs/6 font-semibold text-green-200">Reports</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                      {{-- <li>
                        <a wire:navigate href="{{ route('admin.user-report') }}" class="{{ request()->routeIs('admin.user-report') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">U</span>
                          <span class="truncate">User Report</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.transaction-report') }}" class="{{ request()->routeIs('admin.transaction-report') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                          <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">T</span>
                          <span class="truncate">Transaction Report</span>
                        </a>
                      </li> --}}
                    </ul>
                  </li>


                    <li class="-mx-1 mt-auto" wire:ignore>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-blue-600 w-full">
                                <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                    @else
                    <li>
                      <ul role="list" class="-mx-2 space-y-1">
                          {{-- <li>
                              <a wire:navigate href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                                <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                My Profile
                              </a>
                            </li>
                            <li>
                              <a wire:navigate href="{{ route('user.applications') }}" class="{{ request()->routeIs('user.applications') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                    </svg>
                                  Applications
                              </a>
                            </li>
                            <li>
                              <a wire:navigate href="{{ route('user.view-schedules') }}" class="{{ request()->routeIs('user.view-schedules') || request()->routeIs('admin.create-schedule') || request()->routeIs('admin.view-schedule') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                  </svg>
                                  Schedules
                              </a>
                            </li>
                            <li>
                              <a wire:navigate href="{{ route('user.view-transaction') }}" class="{{ request()->routeIs('user.view-transaction') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                                <svg class="size-6 shrink-0 text-green-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                </svg>
                                Transactions
                              </a>
                            </li> --}}
                      </ul>
                    </li>
                    <li>
                    {{-- <div class="text-xs/6 font-semibold text-green-200">Reports</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                      <li>
                          <a wire:navigate href="{{ route('user.my-transactions') }}" class="{{ request()->routeIs('user.my-transactions') ? 'group flex gap-x-3 rounded-md bg-green-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-green-200 hover:bg-green-700 hover:text-white' }}">
                            <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-green-400 bg-green-500 text-[0.625rem] font-medium text-white">M</span>
                            <span class="truncate">My Transactions</span>
                          </a>
                        </li>
                    </ul> --}}
                  </li>
                    <li class="-mx-1 mt-auto" wire:ignore>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-blue-600 w-full">
                                <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                    @endif
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-20 lg:flex lg:w-72 lg:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
        <div class="flex h-16 shrink-0 items-center bg-blue-600 px-4 mt-4 rounded-lg text-white ">
          {{-- <img class="h-12 w-auto" src="{{asset('images/sksu_logo.png')}}" alt="HMIS"> --}}
          <p class="poppins-medium text-sm px-1 tracking-wider">CAMPUS CLINIC SYSTEM</p>
        </div>
        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                @if(auth()->user()->role_id === 1)
                <li>
                  <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                  <a wire:navigate href="{{route('admin.dashboard')}}" class="{{request()->routeIs('admin.dashboard') ? 'text-blue-600 bg-gray-100 poppins-medium hover:text-blue-600 hover:bg-gray-50 group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold' : 'poppins-medium hover:text-blue-600 hover:bg-gray-50 group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold'}}">
                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                      </svg>
                    Dashboard
                  </a>
                </li>
                @endif
                @if(auth()->user()->role_id === 1)
                <li>
                    <div x-cloak x-data="{ open_ipd: true }" class="relative inline-block text-left mt-4">
                        <div>
                            <span  class="inline-flex justify-left w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-400  ">
                                Management
                                <!-- Heroicon name: chevron-down -->
                                {{-- <svg :class="{ 'transform rotate-180': open, 'hidden': !open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                                </svg> --}}
                                {{-- <svg :class="{ 'transform rotate-360': open_ipd, 'hidden': !open_ipd }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                  </svg>
                                <svg :class="{ 'transform rotate-360': !open_ipd, 'hidden': open_ipd }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                  </svg> --}}
                                </span>
                        </div>
                    {{-- <div class="text-xs font-semibold leading-6 text-gray-400">Manage</div> --}}
                    <ul x-show="open_ipd" @click.away="open_ipd = true" role="list" class="-mx-2 mt-2 space-y-1">
                        <li>
                          <a wire:navigate href="{{ route('admin.patients') }}" class="{{ request()->routeIs('admin.patients') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                              <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                                  fill="{{ request()->routeIs('admin.patients') ? '#2563EB' : '#5B5B5B'}}"/>
                              </svg>
                            <span class="truncate">Patient Information</span>
                          </a>
                        </li>
                        <li>
                          <a wire:navigate href="{{ route('doctor.vitals') }}" class="{{ request()->routeIs('doctor.vitals') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 23 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 2.2V8.8C0 10.0134 1.03141 11 2.3 11H5.75V0H2.3C1.03141 0 0 0.986563 0 2.2ZM20.7 0H17.25V11H20.7C21.9686 11 23 10.0134 23 8.8V2.2C23 0.986563 21.9686 0 20.7 0ZM6.9 11H16.1V0H6.9V11ZM13.225 3.025C13.703 3.025 14.0875 3.39281 14.0875 3.85C14.0875 4.30719 13.703 4.675 13.225 4.675C12.747 4.675 12.3625 4.30719 12.3625 3.85C12.3625 3.39281 12.747 3.025 13.225 3.025ZM13.225 6.325C13.703 6.325 14.0875 6.69281 14.0875 7.15C14.0875 7.60719 13.703 7.975 13.225 7.975C12.747 7.975 12.3625 7.60719 12.3625 7.15C12.3625 6.69281 12.747 6.325 13.225 6.325ZM9.775 3.025C10.253 3.025 10.6375 3.39281 10.6375 3.85C10.6375 4.30719 10.253 4.675 9.775 4.675C9.29703 4.675 8.9125 4.30719 8.9125 3.85C8.9125 3.39281 9.29703 3.025 9.775 3.025ZM9.775 6.325C10.253 6.325 10.6375 6.69281 10.6375 7.15C10.6375 7.60719 10.253 7.975 9.775 7.975C9.29703 7.975 8.9125 7.60719 8.9125 7.15C8.9125 6.69281 9.29703 6.325 9.775 6.325Z"
                                fill="{{ request()->routeIs('doctor.vitals') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                          <span class="truncate">Patient Examination</span>
                        </a>
                          </li>

                          <li>
                            <a wire:navigate href="{{ route('admin.health_records') }}" class="{{ request()->routeIs('admin.health_records') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                              <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.doctors') ? 'text-blue-600' : 'text-gray-500' }}" viewBox="0 0 17 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                <path d="M8.5 10C11.1828 10 13.3571 7.76172 13.3571 5C13.3571 2.23828 11.1828 0 8.5 0C5.81719 0 3.64286 2.23828 3.64286 5C3.64286 7.76172 5.81719 10 8.5 10ZM3.94643 16.5625C3.94643 17.082 4.35246 17.5 4.85714 17.5C5.36183 17.5 5.76786 17.082 5.76786 16.5625C5.76786 16.043 5.36183 15.625 4.85714 15.625C4.35246 15.625 3.94643 16.043 3.94643 16.5625ZM12.1429 11.2734V13.1875C13.5279 13.4766 14.5714 14.7422 14.5714 16.25V17.8789C14.5714 18.1758 14.3665 18.4336 14.0819 18.4922L12.86 18.7422C12.6969 18.7773 12.5375 18.668 12.5033 18.4961L12.3857 17.8828C12.3516 17.7148 12.4578 17.5469 12.6248 17.5156L13.3571 17.3633V16.25C13.3571 13.7969 9.71429 13.707 9.71429 16.3242V17.3672L10.4467 17.5195C10.6098 17.5547 10.7161 17.7188 10.6857 17.8867L10.5681 18.5C10.5339 18.668 10.3746 18.7773 10.2114 18.7461L9.02746 18.582C8.72768 18.5391 8.50379 18.2773 8.50379 17.9609V16.25C8.50379 14.7422 9.54732 13.4805 10.9324 13.1875V11.4219C10.8489 11.4492 10.7654 11.4648 10.6819 11.4961C9.99888 11.7422 9.26652 11.8789 8.50379 11.8789C7.74107 11.8789 7.00871 11.7422 6.32567 11.4961C6.04487 11.3945 5.76027 11.332 5.46808 11.293V14.4805C6.34464 14.75 6.98594 15.5781 6.98594 16.5664C6.98594 17.7734 6.03348 18.7539 4.86094 18.7539C3.68839 18.7539 2.73594 17.7734 2.73594 16.5664C2.73594 15.5781 3.37723 14.75 4.25379 14.4805V11.3398C1.8404 11.7578 0 13.8984 0 16.5V18.25C0 19.2148 0.762723 20 1.7 20H15.3C16.2373 20 17 19.2148 17 18.25V16.5C17 13.6875 14.8446 11.4102 12.1429 11.2734Z"
                                fill="{{ request()->routeIs('admin.health_records') ? '#2563EB' : '#5B5B5B'}}"/>
                            </svg>
                            <span class="truncate">Health Records</span>
                          </a>
                            </li>
                      {{-- <li>
                        <a wire:navigate href="{{ route('admin.patients') }}" class="{{ request()->routeIs('admin.patients') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                                fill="{{ request()->routeIs('admin.patients') ? '#2563EB' : '#5B5B5B'}}"/>
                            </svg>
                           <span class="truncate">Patients</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.rooms-and-beds') }}" class="{{ request()->routeIs('admin.rooms-and-beds') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.775 6C7.22236 6 8.4 4.87844 8.4 3.5C8.4 2.12156 7.22236 1 5.775 1C4.32764 1 3.15 2.12156 3.15 3.5C3.15 4.87844 4.32764 6 5.775 6ZM17.325 2H9.975C9.68494 2 9.45 2.22375 9.45 2.5V7H2.1V0.5C2.1 0.22375 1.86506 0 1.575 0H0.525C0.234937 0 0 0.22375 0 0.5V11.5C0 11.7762 0.234937 12 0.525 12H1.575C1.86506 12 2.1 11.7762 2.1 11.5V10H18.9V11.5C18.9 11.7762 19.1349 12 19.425 12H20.475C20.7651 12 21 11.7762 21 11.5V5.5C21 3.56687 19.3548 2 17.325 2Z"
                                fill="{{ request()->routeIs('admin.rooms-and-beds') ? '#2563EB' : '#5B5B5B'}}"/>
                            </svg>
                            <span class="truncate">Rooms and Beds</span>
                        </a>
                      </li> --}}
                      <li>
                        <a wire:navigate href="{{ route('admin.referrals') }}" class="{{ request()->routeIs('admin.referrals') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.referrals') ? 'text-blue-600' : 'text-gray-500' }}" viewBox="0 0 17 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                <path d="M8.5 10C11.1828 10 13.3571 7.76172 13.3571 5C13.3571 2.23828 11.1828 0 8.5 0C5.81719 0 3.64286 2.23828 3.64286 5C3.64286 7.76172 5.81719 10 8.5 10ZM3.94643 16.5625C3.94643 17.082 4.35246 17.5 4.85714 17.5C5.36183 17.5 5.76786 17.082 5.76786 16.5625C5.76786 16.043 5.36183 15.625 4.85714 15.625C4.35246 15.625 3.94643 16.043 3.94643 16.5625ZM12.1429 11.2734V13.1875C13.5279 13.4766 14.5714 14.7422 14.5714 16.25V17.8789C14.5714 18.1758 14.3665 18.4336 14.0819 18.4922L12.86 18.7422C12.6969 18.7773 12.5375 18.668 12.5033 18.4961L12.3857 17.8828C12.3516 17.7148 12.4578 17.5469 12.6248 17.5156L13.3571 17.3633V16.25C13.3571 13.7969 9.71429 13.707 9.71429 16.3242V17.3672L10.4467 17.5195C10.6098 17.5547 10.7161 17.7188 10.6857 17.8867L10.5681 18.5C10.5339 18.668 10.3746 18.7773 10.2114 18.7461L9.02746 18.582C8.72768 18.5391 8.50379 18.2773 8.50379 17.9609V16.25C8.50379 14.7422 9.54732 13.4805 10.9324 13.1875V11.4219C10.8489 11.4492 10.7654 11.4648 10.6819 11.4961C9.99888 11.7422 9.26652 11.8789 8.50379 11.8789C7.74107 11.8789 7.00871 11.7422 6.32567 11.4961C6.04487 11.3945 5.76027 11.332 5.46808 11.293V14.4805C6.34464 14.75 6.98594 15.5781 6.98594 16.5664C6.98594 17.7734 6.03348 18.7539 4.86094 18.7539C3.68839 18.7539 2.73594 17.7734 2.73594 16.5664C2.73594 15.5781 3.37723 14.75 4.25379 14.4805V11.3398C1.8404 11.7578 0 13.8984 0 16.5V18.25C0 19.2148 0.762723 20 1.7 20H15.3C16.2373 20 17 19.2148 17 18.25V16.5C17 13.6875 14.8446 11.4102 12.1429 11.2734Z"
                                fill="{{ request()->routeIs('admin.referrals') ? '#2563EB' : '#5B5B5B'}}"/>
                            </svg>
                            <span class="truncate">Referrals</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.inventory.category') }}" class="{{ request()->routeIs('admin.inventory.category') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-4 w-4 shrink-0 text-blue-600" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_239_371)">
                                <path d="M14.3438 10.625H13.2812C13.1404 10.625 13.0052 10.681 12.9056 10.7806C12.806 10.8802 12.75 11.0154 12.75 11.1562V14.875H2.125V4.25H6.90625C7.04715 4.25 7.18227 4.19403 7.2819 4.0944C7.38153 3.99477 7.4375 3.85965 7.4375 3.71875V2.65625C7.4375 2.51535 7.38153 2.38023 7.2819 2.2806C7.18227 2.18097 7.04715 2.125 6.90625 2.125H1.59375C1.17106 2.125 0.765685 2.29291 0.466799 2.5918C0.167912 2.89068 0 3.29606 0 3.71875L0 15.4062C0 15.8289 0.167912 16.2343 0.466799 16.5332C0.765685 16.8321 1.17106 17 1.59375 17H13.2812C13.7039 17 14.1093 16.8321 14.4082 16.5332C14.7071 16.2343 14.875 15.8289 14.875 15.4062V11.1562C14.875 11.0154 14.819 10.8802 14.7194 10.7806C14.6198 10.681 14.4846 10.625 14.3438 10.625ZM16.2031 0H11.9531C11.2436 0 10.889 0.860293 11.3887 1.36133L12.575 2.54768L4.48242 10.6373C4.40813 10.7113 4.34919 10.7993 4.30897 10.8961C4.26875 10.993 4.24804 11.0969 4.24804 11.2017C4.24804 11.3066 4.26875 11.4105 4.30897 11.5073C4.34919 11.6042 4.40813 11.6922 4.48242 11.7662L5.23514 12.5176C5.30917 12.5919 5.39714 12.6508 5.494 12.691C5.59086 12.7313 5.69471 12.752 5.79959 12.752C5.90447 12.752 6.00832 12.7313 6.10518 12.691C6.20204 12.6508 6.29001 12.5919 6.36404 12.5176L14.4527 4.42664L15.6387 5.61133C16.1367 6.10938 17 5.76074 17 5.04688V0.796875C17 0.585531 16.916 0.382842 16.7666 0.233399C16.6172 0.0839562 16.4145 0 16.2031 0V0Z"
                                fill="{{ request()->routeIs('admin.inventory.category') ? '#2563EB' : '#5B5B5B'}}"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_239_371">
                                <rect width="17" height="17" fill="white"/>
                                </clipPath>
                                </defs>
                                </svg>

                            <span class="truncate">Categories</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.inventory.medicine') }}" class="{{ request()->routeIs('admin.inventory.medicine') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-4 w-4 shrink-0 text-blue-600" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.8125 14H12.1875V3H11.25V1.5C11.25 0.671562 10.6204 0 9.84375 0H5.15625C4.37959 0 3.75 0.671562 3.75 1.5V3H2.8125V14ZM5.625 2H9.375V3H5.625V2ZM15 4.5V12.5C15 13.3284 14.3704 14 13.5938 14H13.125V3H13.5938C14.3704 3 15 3.67156 15 4.5ZM1.875 14H1.40625C0.62959 14 0 13.3284 0 12.5V4.5C0 3.67156 0.62959 3 1.40625 3H1.875V14ZM10.3125 7.5V8.5C10.3125 8.77616 10.1026 9 9.84375 9H8.4375V10.5C8.4375 10.7762 8.22765 11 7.96875 11H7.03125C6.77235 11 6.5625 10.7762 6.5625 10.5V9H5.15625C4.89735 9 4.6875 8.77616 4.6875 8.5V7.5C4.6875 7.22384 4.89735 7 5.15625 7H6.5625V5.5C6.5625 5.22384 6.77235 5 7.03125 5H7.96875C8.22765 5 8.4375 5.22384 8.4375 5.5V7H9.84375C10.1026 7 10.3125 7.22384 10.3125 7.5Z"
                                fill="{{ request()->routeIs('admin.inventory.medicine') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                            <span class="truncate">Supplies</span>
                        </a>
                      </li>
                      <li>
                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                        <a wire:navigate href="{{ route('pharmacy.inventory') }}" class="{{ request()->routeIs('pharmacy.inventory') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">I</span>
                          <span class="truncate">Inventory</span>
                        </a>
                      </li>
                      <li>
                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                        <a wire:navigate href="{{ route('admin.cases') }}" class="{{ request()->routeIs('admin.cases') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">H</span>
                          <span class="truncate">Health Cases</span>
                        </a>
                      </li>
                    </ul>
                </div>
                  </li>
                  @endif
                  @if(auth()->user()->role_id === 6)
                  <li>
                    <div x-cloak x-data="{ open_lab: false }" class="relative inline-block text-left mt-4">
                        <div>
                            <button @click="open_lab = !open_lab" class="inline-flex justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-400 hover:bg-gray-50 focus:outline-none ">
                                Laboratory Transactions

                                <svg :class="{ 'transform rotate-360': open_lab, 'hidden': !open_lab }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                  </svg>
                                <svg :class="{ 'transform rotate-360': !open_lab, 'hidden': open_lab }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                  </svg>
                            </button>
                        </div>
                    {{-- <div class="text-xs font-semibold leading-6 text-gray-400">Cashier Transactions</div> --}}
                    <ul x-show="open_lab" @click.away="open_lab = false" role="list" class="-mx-2 mt-2 space-y-1">
                        <li>
                            <a wire:navigate href="{{ route('doctor.laboratories') }}" class="{{ request()->routeIs('doctor.laboratories') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5625 13.125H7.05469V13.7812C7.05469 14.1438 7.34836 14.4375 7.71094 14.4375H9.35156C9.71414 14.4375 10.0078 14.1438 10.0078 13.7812V13.125H10.5C11.2247 13.125 11.8125 12.5372 11.8125 11.8125V2.625C11.8125 1.90025 11.2247 1.3125 10.5 1.3125V0.65625C10.5 0.293672 10.2063 0 9.84375 0H7.21875C6.85617 0 6.5625 0.293672 6.5625 0.65625V1.3125C5.83775 1.3125 5.25 1.90025 5.25 2.625V11.8125C5.25 12.5372 5.83775 13.125 6.5625 13.125ZM19.0312 18.375H18.9783C20.2305 16.9801 21 15.143 21 13.125C21 8.78227 17.4677 5.25 13.125 5.25V7.875C16.0199 7.875 18.375 10.2301 18.375 13.125C18.375 16.0199 16.0199 18.375 13.125 18.375H1.96875C0.881426 18.375 0 19.2564 0 20.3438C0 20.7063 0.293672 21 0.65625 21H20.3438C20.7063 21 21 20.7063 21 20.3438C21 19.2564 20.1186 18.375 19.0312 18.375ZM4.26562 17.0625H12.7969C12.9782 17.0625 13.125 16.9157 13.125 16.7344V16.0781C13.125 15.8968 12.9782 15.75 12.7969 15.75H4.26562C4.08434 15.75 3.9375 15.8968 3.9375 16.0781V16.7344C3.9375 16.9157 4.08434 17.0625 4.26562 17.0625Z"
                                    fill="{{ request()->routeIs('doctor.laboratories') ? '#2563EB' : '#5B5B5B'}}"/>
                                    </svg>
                              <span class="truncate">Laboratories</span>
                            </a>
                          </li>
                    </ul>
                    </div>
                  </li>
                  @endif
                  @if(auth()->user()->role_id === 5)
                  <li>
                      <div x-cloak x-data="{ open: false }" class="relative inline-block text-left mt-4">
                          <div>
                              <button @click="open = !open" class="inline-flex justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-400 hover:bg-gray-50 focus:outline-none ">
                                  IPD / OPD Transactions
                                  <!-- Heroicon name: chevron-down -->
                                  {{-- <svg :class="{ 'transform rotate-180': open, 'hidden': !open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                                  </svg> --}}
                                  <svg :class="{ 'transform rotate-360': open, 'hidden': !open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                  <svg :class="{ 'transform rotate-360': !open, 'hidden': open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                              </button>
                          </div>
                      {{-- <div class="text-xs font-semibold leading-6 text-gray-400">Manage</div> --}}
                      <ul x-show="open" @click.away="open = false" role="list" class="-mx-2 mt-2 space-y-1">
                        <li>
                          <a wire:navigate href="{{ route('admin.patients') }}" class="{{ request()->routeIs('admin.patients') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                              <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                                  fill="{{ request()->routeIs('admin.patients') ? '#2563EB' : '#5B5B5B'}}"/>
                              </svg>
                             <span class="truncate">Patients</span>
                          </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('ipd.assign-doctor') }}" class="{{ request()->routeIs('ipd.assign-doctor') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                                    fill="{{ request()->routeIs('ipd.assign-doctor') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                               <span class="truncate">Assign Doctor</span>
                            </a>
                          </li>
                          <li>
                            <a wire:navigate href="{{ route('ipd.assign-bed') }}" class="{{ request()->routeIs('ipd.assign-bed') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                                    fill="{{ request()->routeIs('ipd.assign-bed') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                               <span class="truncate">Assign Bed</span>
                            </a>
                          </li>
                        <li>
                            <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                            <a wire:navigate href="{{ route('doctor.vitals') }}" class="{{ request()->routeIs('doctor.vitals') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 23 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 2.2V8.8C0 10.0134 1.03141 11 2.3 11H5.75V0H2.3C1.03141 0 0 0.986563 0 2.2ZM20.7 0H17.25V11H20.7C21.9686 11 23 10.0134 23 8.8V2.2C23 0.986563 21.9686 0 20.7 0ZM6.9 11H16.1V0H6.9V11ZM13.225 3.025C13.703 3.025 14.0875 3.39281 14.0875 3.85C14.0875 4.30719 13.703 4.675 13.225 4.675C12.747 4.675 12.3625 4.30719 12.3625 3.85C12.3625 3.39281 12.747 3.025 13.225 3.025ZM13.225 6.325C13.703 6.325 14.0875 6.69281 14.0875 7.15C14.0875 7.60719 13.703 7.975 13.225 7.975C12.747 7.975 12.3625 7.60719 12.3625 7.15C12.3625 6.69281 12.747 6.325 13.225 6.325ZM9.775 3.025C10.253 3.025 10.6375 3.39281 10.6375 3.85C10.6375 4.30719 10.253 4.675 9.775 4.675C9.29703 4.675 8.9125 4.30719 8.9125 3.85C8.9125 3.39281 9.29703 3.025 9.775 3.025ZM9.775 6.325C10.253 6.325 10.6375 6.69281 10.6375 7.15C10.6375 7.60719 10.253 7.975 9.775 7.975C9.29703 7.975 8.9125 7.60719 8.9125 7.15C8.9125 6.69281 9.29703 6.325 9.775 6.325Z"
                                    fill="{{ request()->routeIs('doctor.vitals') ? '#2563EB' : '#5B5B5B'}}"/>
                                    </svg>
                              <span class="truncate">Vitals</span>
                            </a>
                          </li>
                          <li>
                            <a wire:navigate href="{{ route('ipd.initial-diagnosis') }}" class="{{ request()->routeIs('ipd.initial-diagnosis') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.doctors') ? 'text-blue-600' : 'text-gray-500' }}" viewBox="0 0 17 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                    <path d="M8.5 10C11.1828 10 13.3571 7.76172 13.3571 5C13.3571 2.23828 11.1828 0 8.5 0C5.81719 0 3.64286 2.23828 3.64286 5C3.64286 7.76172 5.81719 10 8.5 10ZM3.94643 16.5625C3.94643 17.082 4.35246 17.5 4.85714 17.5C5.36183 17.5 5.76786 17.082 5.76786 16.5625C5.76786 16.043 5.36183 15.625 4.85714 15.625C4.35246 15.625 3.94643 16.043 3.94643 16.5625ZM12.1429 11.2734V13.1875C13.5279 13.4766 14.5714 14.7422 14.5714 16.25V17.8789C14.5714 18.1758 14.3665 18.4336 14.0819 18.4922L12.86 18.7422C12.6969 18.7773 12.5375 18.668 12.5033 18.4961L12.3857 17.8828C12.3516 17.7148 12.4578 17.5469 12.6248 17.5156L13.3571 17.3633V16.25C13.3571 13.7969 9.71429 13.707 9.71429 16.3242V17.3672L10.4467 17.5195C10.6098 17.5547 10.7161 17.7188 10.6857 17.8867L10.5681 18.5C10.5339 18.668 10.3746 18.7773 10.2114 18.7461L9.02746 18.582C8.72768 18.5391 8.50379 18.2773 8.50379 17.9609V16.25C8.50379 14.7422 9.54732 13.4805 10.9324 13.1875V11.4219C10.8489 11.4492 10.7654 11.4648 10.6819 11.4961C9.99888 11.7422 9.26652 11.8789 8.50379 11.8789C7.74107 11.8789 7.00871 11.7422 6.32567 11.4961C6.04487 11.3945 5.76027 11.332 5.46808 11.293V14.4805C6.34464 14.75 6.98594 15.5781 6.98594 16.5664C6.98594 17.7734 6.03348 18.7539 4.86094 18.7539C3.68839 18.7539 2.73594 17.7734 2.73594 16.5664C2.73594 15.5781 3.37723 14.75 4.25379 14.4805V11.3398C1.8404 11.7578 0 13.8984 0 16.5V18.25C0 19.2148 0.762723 20 1.7 20H15.3C16.2373 20 17 19.2148 17 18.25V16.5C17 13.6875 14.8446 11.4102 12.1429 11.2734Z"
                                    fill="{{ request()->routeIs('ipd.initial-diagnosis') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                              <span class="truncate">Initial Diagnosis</span>
                            </a>
                          </li>

                        {{-- <li>
                          <a wire:navigate href="{{ route('admin.inventory.category') }}" class="{{ request()->routeIs('admin.inventory.category') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                              <svg class="h-4 w-4 shrink-0 text-blue-600" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <g clip-path="url(#clip0_239_371)">
                                  <path d="M14.3438 10.625H13.2812C13.1404 10.625 13.0052 10.681 12.9056 10.7806C12.806 10.8802 12.75 11.0154 12.75 11.1562V14.875H2.125V4.25H6.90625C7.04715 4.25 7.18227 4.19403 7.2819 4.0944C7.38153 3.99477 7.4375 3.85965 7.4375 3.71875V2.65625C7.4375 2.51535 7.38153 2.38023 7.2819 2.2806C7.18227 2.18097 7.04715 2.125 6.90625 2.125H1.59375C1.17106 2.125 0.765685 2.29291 0.466799 2.5918C0.167912 2.89068 0 3.29606 0 3.71875L0 15.4062C0 15.8289 0.167912 16.2343 0.466799 16.5332C0.765685 16.8321 1.17106 17 1.59375 17H13.2812C13.7039 17 14.1093 16.8321 14.4082 16.5332C14.7071 16.2343 14.875 15.8289 14.875 15.4062V11.1562C14.875 11.0154 14.819 10.8802 14.7194 10.7806C14.6198 10.681 14.4846 10.625 14.3438 10.625ZM16.2031 0H11.9531C11.2436 0 10.889 0.860293 11.3887 1.36133L12.575 2.54768L4.48242 10.6373C4.40813 10.7113 4.34919 10.7993 4.30897 10.8961C4.26875 10.993 4.24804 11.0969 4.24804 11.2017C4.24804 11.3066 4.26875 11.4105 4.30897 11.5073C4.34919 11.6042 4.40813 11.6922 4.48242 11.7662L5.23514 12.5176C5.30917 12.5919 5.39714 12.6508 5.494 12.691C5.59086 12.7313 5.69471 12.752 5.79959 12.752C5.90447 12.752 6.00832 12.7313 6.10518 12.691C6.20204 12.6508 6.29001 12.5919 6.36404 12.5176L14.4527 4.42664L15.6387 5.61133C16.1367 6.10938 17 5.76074 17 5.04688V0.796875C17 0.585531 16.916 0.382842 16.7666 0.233399C16.6172 0.0839562 16.4145 0 16.2031 0V0Z"
                                  fill="{{ request()->routeIs('admin.inventory.category') ? '#2563EB' : '#5B5B5B'}}"/>
                                  </g>
                                  <defs>
                                  <clipPath id="clip0_239_371">
                                  <rect width="17" height="17" fill="white"/>
                                  </clipPath>
                                  </defs>
                                  </svg>

                              <span class="truncate">Categories</span>
                          </a>
                        </li>
                        <li>
                          <a wire:navigate href="{{ route('admin.inventory.medicine') }}" class="{{ request()->routeIs('admin.inventory.medicine') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                              <svg class="h-4 w-4 shrink-0 text-blue-600" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.8125 14H12.1875V3H11.25V1.5C11.25 0.671562 10.6204 0 9.84375 0H5.15625C4.37959 0 3.75 0.671562 3.75 1.5V3H2.8125V14ZM5.625 2H9.375V3H5.625V2ZM15 4.5V12.5C15 13.3284 14.3704 14 13.5938 14H13.125V3H13.5938C14.3704 3 15 3.67156 15 4.5ZM1.875 14H1.40625C0.62959 14 0 13.3284 0 12.5V4.5C0 3.67156 0.62959 3 1.40625 3H1.875V14ZM10.3125 7.5V8.5C10.3125 8.77616 10.1026 9 9.84375 9H8.4375V10.5C8.4375 10.7762 8.22765 11 7.96875 11H7.03125C6.77235 11 6.5625 10.7762 6.5625 10.5V9H5.15625C4.89735 9 4.6875 8.77616 4.6875 8.5V7.5C4.6875 7.22384 4.89735 7 5.15625 7H6.5625V5.5C6.5625 5.22384 6.77235 5 7.03125 5H7.96875C8.22765 5 8.4375 5.22384 8.4375 5.5V7H9.84375C10.1026 7 10.3125 7.22384 10.3125 7.5Z"
                                  fill="{{ request()->routeIs('admin.inventory.medicine') ? '#2563EB' : '#5B5B5B'}}"/>
                                  </svg>
                              <span class="truncate">Medicines</span>
                          </a>
                        </li> --}}
                      </ul>
                  </div>
                    </li>
                    @endif
                  @if(auth()->user()->role_id === 7)
                  <li>
                    <div x-cloak x-data="{ open_doctor: false }" class="relative inline-block text-left mt-4">
                        <div>
                            <button @click="open_doctor = !open_doctor" class="inline-flex justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-400 hover:bg-gray-50 focus:outline-none ">
                                Doctor Transactions
                                <!-- Heroicon name: chevron-down -->
                                {{-- <svg :class="{ 'transform rotate-180': open, 'hidden': !open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                                </svg> --}}
                                <svg :class="{ 'transform rotate-360': open_doctor, 'hidden': !open_doctor }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                  </svg>
                                <svg :class="{ 'transform rotate-360': !open_doctor, 'hidden': open_doctor }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                  </svg>
                            </button>
                        </div>
                    {{-- <div class="text-xs font-semibold leading-6 text-gray-400">Doctor Transactions</div> --}}
                    <ul x-show="open_doctor" @click.away="open_doctor = false" role="list" class="-mx-2 mt-2 space-y-1">
                      {{-- <li>
                        <a wire:navigate href="{{ route('doctor.emergency-room') }}" class="{{ request()->routeIs('doctor.emergency-room') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.9823 0C17.2718 0 22 4.88347 22 11C22 17.5246 16.744 22 10.9823 22C5.03871 22 0 17.1431 0 11C0 5.10524 4.64395 0 10.9823 0ZM11.0177 1.98266C5.775 1.98266 1.98266 6.325 1.98266 11C1.98266 15.8702 6.02782 19.9952 11.0177 19.9952C15.5952 19.9952 20.0129 16.398 20.0129 11C20.0173 5.95242 16.0121 1.98266 11.0177 1.98266ZM15.7637 11.102C15.5552 11.102 15.3645 11.2262 15.2891 11.4214L15.1117 11.8427L14.6238 7.72661C14.5484 7.11008 13.648 7.13226 13.5992 7.74435L13.4085 10.0242L13.1778 6.97258C13.129 6.33831 12.1976 6.34274 12.1488 6.97258L11.9935 8.96411L11.7319 4.78145C11.6919 4.13831 10.7427 4.14274 10.7028 4.78145L10.4766 8.49395L10.2859 5.55323C10.246 4.91452 9.30121 4.91452 9.25685 5.55323L9.02177 9.11048L8.83992 6.58226C8.79113 5.94798 7.86411 5.94798 7.81089 6.57339L7.46935 10.5565L7.38952 10.0153C7.31411 9.50968 6.63105 9.4121 6.41371 9.86895L5.82823 11.0976H3.88105V12.1266H6.15645C6.35161 12.1266 6.52903 12.0157 6.61774 11.8427L7.09234 15.0851C7.18105 15.6839 8.06371 15.6617 8.11693 15.054L8.28548 13.1202L8.53831 16.5931C8.5871 17.2319 9.52742 17.223 9.56734 16.5887L9.77137 13.4661L9.98427 16.7173C10.0242 17.356 10.9734 17.356 11.0133 16.7129L11.2306 13.1423L11.4302 16.327C11.4702 16.9613 12.4105 16.9702 12.4593 16.3359L12.6633 13.7367L12.8806 16.5931C12.9294 17.2274 13.8565 17.223 13.9052 16.5976L14.2069 12.9161L14.3266 13.9052C14.3887 14.4286 15.1117 14.5306 15.3157 14.0427L16.1141 12.1177H18.354V11.0887L15.7637 11.102ZM12.304 11.3327H11.3327V12.304C11.3327 12.4859 11.1863 12.6367 11 12.6367C10.8181 12.6367 10.6673 12.4903 10.6673 12.304V11.3327H9.69597C9.51411 11.3327 9.36331 11.1863 9.36331 11C9.36331 10.8181 9.51411 10.6673 9.69597 10.6673H10.6673V9.69597C10.6673 9.51411 10.8181 9.36331 11 9.36331C11.1819 9.36331 11.3327 9.50968 11.3327 9.69597V10.6673H12.304C12.4859 10.6673 12.6367 10.8137 12.6367 11C12.6367 11.1819 12.4859 11.3327 12.304 11.3327Z"
                                fill="{{ request()->routeIs('doctor.emergency-room') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                          <span class="truncate">Emergency Room</span>
                        </a>
                      </li> --}}
                      {{-- <li>
                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                        <a wire:navigate href="{{ route('doctor.vitals') }}" class="{{ request()->routeIs('doctor.vitals') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 23 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 2.2V8.8C0 10.0134 1.03141 11 2.3 11H5.75V0H2.3C1.03141 0 0 0.986563 0 2.2ZM20.7 0H17.25V11H20.7C21.9686 11 23 10.0134 23 8.8V2.2C23 0.986563 21.9686 0 20.7 0ZM6.9 11H16.1V0H6.9V11ZM13.225 3.025C13.703 3.025 14.0875 3.39281 14.0875 3.85C14.0875 4.30719 13.703 4.675 13.225 4.675C12.747 4.675 12.3625 4.30719 12.3625 3.85C12.3625 3.39281 12.747 3.025 13.225 3.025ZM13.225 6.325C13.703 6.325 14.0875 6.69281 14.0875 7.15C14.0875 7.60719 13.703 7.975 13.225 7.975C12.747 7.975 12.3625 7.60719 12.3625 7.15C12.3625 6.69281 12.747 6.325 13.225 6.325ZM9.775 3.025C10.253 3.025 10.6375 3.39281 10.6375 3.85C10.6375 4.30719 10.253 4.675 9.775 4.675C9.29703 4.675 8.9125 4.30719 8.9125 3.85C8.9125 3.39281 9.29703 3.025 9.775 3.025ZM9.775 6.325C10.253 6.325 10.6375 6.69281 10.6375 7.15C10.6375 7.60719 10.253 7.975 9.775 7.975C9.29703 7.975 8.9125 7.60719 8.9125 7.15C8.9125 6.69281 9.29703 6.325 9.775 6.325Z"
                                fill="{{ request()->routeIs('doctor.vitals') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                          <span class="truncate">Vitals</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('doctor.laboratories') }}" class="{{ request()->routeIs('doctor.laboratories') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.5625 13.125H7.05469V13.7812C7.05469 14.1438 7.34836 14.4375 7.71094 14.4375H9.35156C9.71414 14.4375 10.0078 14.1438 10.0078 13.7812V13.125H10.5C11.2247 13.125 11.8125 12.5372 11.8125 11.8125V2.625C11.8125 1.90025 11.2247 1.3125 10.5 1.3125V0.65625C10.5 0.293672 10.2063 0 9.84375 0H7.21875C6.85617 0 6.5625 0.293672 6.5625 0.65625V1.3125C5.83775 1.3125 5.25 1.90025 5.25 2.625V11.8125C5.25 12.5372 5.83775 13.125 6.5625 13.125ZM19.0312 18.375H18.9783C20.2305 16.9801 21 15.143 21 13.125C21 8.78227 17.4677 5.25 13.125 5.25V7.875C16.0199 7.875 18.375 10.2301 18.375 13.125C18.375 16.0199 16.0199 18.375 13.125 18.375H1.96875C0.881426 18.375 0 19.2564 0 20.3438C0 20.7063 0.293672 21 0.65625 21H20.3438C20.7063 21 21 20.7063 21 20.3438C21 19.2564 20.1186 18.375 19.0312 18.375ZM4.26562 17.0625H12.7969C12.9782 17.0625 13.125 16.9157 13.125 16.7344V16.0781C13.125 15.8968 12.9782 15.75 12.7969 15.75H4.26562C4.08434 15.75 3.9375 15.8968 3.9375 16.0781V16.7344C3.9375 16.9157 4.08434 17.0625 4.26562 17.0625Z"
                                fill="{{ request()->routeIs('doctor.laboratories') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                          <span class="truncate">Laboratories</span>
                        </a>
                      </li> --}}
                      <li>
                        <a wire:navigate href="{{ route('doctor.medical-records') }}" class="{{ request()->routeIs('doctor.medical-records') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5179 6.5625H0.482143C0.215879 6.5625 0 6.34212 0 6.07031V4.59375C0 3.50643 0.863437 2.625 1.92857 2.625H3.85714V0.492188C3.85714 0.220377 4.07302 0 4.33929 0H5.94643C6.21269 0 6.42857 0.220377 6.42857 0.492188V2.625H11.5714V0.492188C11.5714 0.220377 11.7873 0 12.0536 0H13.6607C13.927 0 14.1429 0.220377 14.1429 0.492188V2.625H16.0714C17.1366 2.625 18 3.50643 18 4.59375V6.07031C18 6.34212 17.7841 6.5625 17.5179 6.5625ZM0.482143 7.875H17.5179C17.7841 7.875 18 8.09538 18 8.36719V19.0312C18 20.1186 17.1366 21 16.0714 21H1.92857C0.863437 21 0 20.1186 0 19.0312V8.36719C0 8.09538 0.215879 7.875 0.482143 7.875ZM13.8735 11.8103L12.7417 10.6456C12.5542 10.4526 12.2489 10.4513 12.0599 10.6428L7.79946 14.957L5.95205 13.0558C5.76454 12.8628 5.45922 12.8616 5.27018 13.053L4.12923 14.2084C3.94019 14.3998 3.93895 14.7115 4.1265 14.9045L7.44529 18.3198C7.6328 18.5128 7.93808 18.514 8.12712 18.3226L13.8708 12.5064C14.0598 12.3149 14.0611 12.0033 13.8735 11.8103Z"
                                    fill="{{ request()->routeIs('doctor.medical-records') ? '#2563EB' : '#5B5B5B'}}"/>
                                    </svg>
                          <span class="truncate">Patient Records</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('doctor.prescription') }}" class="{{ request()->routeIs('doctor.prescription') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('doctor.prescription') ? 'text-blue-600' : 'text-gray-500' }}" viewBox="0 0 17 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                <path d="M9 8H3V10H9V8ZM11.7812 3.28125L8.72188 0.21875C8.58125 0.078125 8.39062 0 8.19063 0H8V4H12V3.80938C12 3.6125 11.9219 3.42188 11.7812 3.28125ZM7 4.25V0H0.75C0.334375 0 0 0.334375 0 0.75V15.25C0 15.6656 0.334375 16 0.75 16H11.25C11.6656 16 12 15.6656 12 15.25V5H7.75C7.3375 5 7 4.6625 7 4.25ZM2 2.25C2 2.11188 2.11188 2 2.25 2H4.75C4.88812 2 5 2.11188 5 2.25V2.75C5 2.88812 4.88812 3 4.75 3H2.25C2.11188 3 2 2.88812 2 2.75V2.25ZM2 4.25C2 4.11188 2.11188 4 2.25 4H4.75C4.88812 4 5 4.11188 5 4.25V4.75C5 4.88812 4.88812 5 4.75 5H2.25C2.11188 5 2 4.88812 2 4.75V4.25ZM10 13.75C10 13.8881 9.88813 14 9.75 14H7.25C7.11188 14 7 13.8881 7 13.75V13.25C7 13.1119 7.11188 13 7.25 13H9.75C9.88813 13 10 13.1119 10 13.25V13.75ZM10 7.5V10.5C10 10.7762 9.77625 11 9.5 11H2.5C2.22375 11 2 10.7762 2 10.5V7.5C2 7.22375 2.22375 7 2.5 7H9.5C9.77625 7 10 7.22375 10 7.5Z"
                                fill="{{ request()->routeIs('doctor.prescription') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                          <span class="truncate">Prescription</span>
                        </a>
                      </li>
                    </ul>
                </div>
                  </li>
                  @endif
                  @if(auth()->user()->role_id === 3)
                  <li>
                    <div x-cloak x-data="{ open_pharmacy: false }" class="relative inline-block text-left mt-4">
                        <div>
                            <button @click="open_pharmacy = !open_pharmacy" class="inline-flex justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-400 hover:bg-gray-50 focus:outline-none ">
                                Pharmacy Transactions
                                <!-- Heroicon name: chevron-down -->
                                {{-- <svg :class="{ 'transform rotate-180': open, 'hidden': !open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                                </svg> --}}
                                <svg :class="{ 'transform rotate-360': open_pharmacy, 'hidden': !open_pharmacy }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                  </svg>
                                <svg :class="{ 'transform rotate-360': !open_pharmacy, 'hidden': open_pharmacy }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                  </svg>
                            </button>
                        </div>
                    {{-- <div class="text-xs font-semibold leading-6 text-gray-400">Pharmacy</div> --}}
                    <ul x-show="open_pharmacy" @click.away="open_pharmacy = false" role="list" class="-mx-2 mt-2 space-y-1">
                      <li>
                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                        <a wire:navigate href="{{ route('pharmacy.inventory') }}" class="{{ request()->routeIs('pharmacy.inventory') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">I</span>
                          <span class="truncate">Inventory</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('pharmacy.pos') }}" class="{{ request()->routeIs('pharmacy.pos') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">P</span>
                          <span class="truncate">Point of Sale</span>
                        </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('pharmacy.transaction') }}" class="{{ request()->routeIs('pharmacy.transaction') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">T</span>
                          <span class="truncate">Transactions</span>
                        </a>
                      </li>
                    </ul>
                    </div>
                  </li>
                  @endif
                  @if(auth()->user()->role_id === 4)
                  <li>
                    <div x-cloak x-data="{ open_cashier: false }" class="relative inline-block text-left mt-4">
                        <div>
                            <button @click="open_cashier = !open_cashier" class="inline-flex justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-400 hover:bg-gray-50 focus:outline-none ">
                                Cashier Transactions
                                <!-- Heroicon name: chevron-down -->
                                {{-- <svg :class="{ 'transform rotate-180': open, 'hidden': !open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                                </svg> --}}
                                <svg :class="{ 'transform rotate-360': open_cashier, 'hidden': !open_cashier }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                  </svg>
                                <svg :class="{ 'transform rotate-360': !open_cashier, 'hidden': open_cashier }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                  </svg>
                            </button>
                        </div>
                    {{-- <div class="text-xs font-semibold leading-6 text-gray-400">Cashier Transactions</div> --}}
                    <ul x-show="open_cashier" @click.away="open_cashier = false" role="list" class="-mx-2 mt-2 space-y-1">
                        <li>
                            <a wire:navigate href="{{ route('cashier.billing') }}" class="{{ request()->routeIs('cashier.billing') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cashier.billing') ? 'text-blue-600' : 'text-gray-500' }}" viewBox="0 0 17 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                        <path d="M9 8H3V10H9V8ZM11.7812 3.28125L8.72188 0.21875C8.58125 0.078125 8.39062 0 8.19063 0H8V4H12V3.80938C12 3.6125 11.9219 3.42188 11.7812 3.28125ZM7 4.25V0H0.75C0.334375 0 0 0.334375 0 0.75V15.25C0 15.6656 0.334375 16 0.75 16H11.25C11.6656 16 12 15.6656 12 15.25V5H7.75C7.3375 5 7 4.6625 7 4.25ZM2 2.25C2 2.11188 2.11188 2 2.25 2H4.75C4.88812 2 5 2.11188 5 2.25V2.75C5 2.88812 4.88812 3 4.75 3H2.25C2.11188 3 2 2.88812 2 2.75V2.25ZM2 4.25C2 4.11188 2.11188 4 2.25 4H4.75C4.88812 4 5 4.11188 5 4.25V4.75C5 4.88812 4.88812 5 4.75 5H2.25C2.11188 5 2 4.88812 2 4.75V4.25ZM10 13.75C10 13.8881 9.88813 14 9.75 14H7.25C7.11188 14 7 13.8881 7 13.75V13.25C7 13.1119 7.11188 13 7.25 13H9.75C9.88813 13 10 13.1119 10 13.25V13.75ZM10 7.5V10.5C10 10.7762 9.77625 11 9.5 11H2.5C2.22375 11 2 10.7762 2 10.5V7.5C2 7.22375 2.22375 7 2.5 7H9.5C9.77625 7 10 7.22375 10 7.5Z"
                                        fill="{{ request()->routeIs('cashier.billing') ? '#2563EB' : '#5B5B5B'}}"/>
                                        </svg>
                                <span class="truncate">Billing</span>
                            </a>
                        </li>
                    </ul>
                    </div>
                  </li>
                  @endif
              </ul>
            </li>
            @if(auth()->user()->role_id === 1)
            <li>
              <div x-cloak x-data="{ open_report: true }" class="relative inline-block text-left">
                <div>
                    <span  class="inline-flex justify-start w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-400">
                        Reports
                        <!-- Heroicon name: chevron-down -->
                        {{-- <svg :class="{ 'transform rotate-180': open, 'hidden': !open }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 12a1 1 0 01-.707-.293l-4-4a1 1 0 111.414-1.414L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4A1 1 0 0110 12z" clip-rule="evenodd" />
                        </svg> --}}
                        {{-- <svg :class="{ 'transform rotate-360': open_report, 'hidden': !open_report }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                          </svg>
                        <svg :class="{ 'transform rotate-360': !open_report, 'hidden': open_report }" class="-mr-1 ml-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                          </svg> --}}
                        </span>
                </div>
              {{-- <div class="text-xs font-semibold leading-6 text-gray-400">Reports</div> --}}
              <ul x-show="open_report" @click.away="open_report = true" role="list" class="mt-2 space-y-1">
                {{-- <li>
                    <a wire:navigate href="{{ route('admin.reports.patient-list') }}" class="{{ request()->routeIs('admin.reports.patient-list') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                      <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                        fill="{{ request()->routeIs('admin.reports.patient-list') ? '#2563EB' : '#5B5B5B'}}"/>
                      </svg>
                      Patient List
                    </a>
                  </li> --}}
                  <li>
                    <a wire:navigate href="{{ route('admin.reports.patient-admission') }}" class="{{ request()->routeIs('admin.reports.patient-admission') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                      <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                        fill="{{ request()->routeIs('admin.reports.patient-admission') ? '#2563EB' : '#5B5B5B'}}"/>
                      </svg>
                      Patient Cases
                    </a>
                  </li>
                  {{-- <li>
                    <a wire:navigate href="{{ route('admin.reports.patient-billing') }}" class="{{ request()->routeIs('admin.reports.patient-billing') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                      <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                        fill="{{ request()->routeIs('admin.reports.patient-billing') ? '#2563EB' : '#5B5B5B'}}"/>
                      </svg>
                      Patient Billing
                    </a>
                  </li> --}}
                  <li>
                    <a wire:navigate href="{{ route('admin.reports.medicine-list') }}" class="{{ request()->routeIs('admin.reports.medicine-list') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                      <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                        fill="{{ request()->routeIs('admin.reports.medicine-list') ? '#2563EB' : '#5B5B5B'}}"/>
                      </svg>
                      Medicine List
                    </a>
                  </li>
                  {{-- <li>
                    <a wire:navigate href="{{ route('admin.reports.lab-results') }}" class="{{ request()->routeIs('admin.reports.lab-results') ? 'text-blue-600 bg-gray-100 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                      <svg class="h-5 w-5 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z"
                        fill="{{ request()->routeIs('admin.reports.lab-results') ? '#2563EB' : '#5B5B5B'}}"/>
                      </svg>
                      Lab Results
                    </a>
                  </li> --}}
                </ul>
              </div>
            </li>
            @endif
          </ul>
        </div>
      </li>

        <li class="-mx-1 mt-auto" wire:ignore>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-blue-600 w-full">
                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    Logout
                </button>
            </form>
        </li>
        </nav>
      </div>

      <div @click="open = true" class="sticky top-0 z-40 flex items-center gap-x-6 bg-gray-600 px-4 py-4 shadow-sm sm:px-6 lg:hidden">
        <button type="button" class="-m-2.5 p-2.5 text-green-200 lg:hidden">
          <span class="sr-only">Open sidebar</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
        <div class="flex-1 text-sm/6 font-semibold text-white">Dashboard</div>
        <a href="#">
          <span class="sr-only">Your profile</span>
          {{-- <img class="size-8 rounded-full bg-green-700" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""> --}}
        </a>
      </div>
    </div>



    <main class="lg:pl-72">
      <div>
        <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
            <div class="px-4 mt-12 text-4xl font-semibold text-gray-700 poppins-regular">
                @yield('title')
            </div>
            <div class="p-4 mt-5">
                {{$slot}}
                @livewire('notifications')
            </div>
        </div>
      </div>
    </main>
  </div>
        @filamentScripts
        @livewireScripts
    </body>
</html>
