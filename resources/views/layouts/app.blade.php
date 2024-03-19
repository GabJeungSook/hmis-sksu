<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    </head>
    <body class="font-sans antialiased">
        <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div>
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
      <div class="fixed inset-0 bg-gray-900/80"></div>

      <div class="fixed inset-0 flex">
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
            <button type="button" class="-m-2.5 p-2.5">
              <span class="sr-only">Close sidebar</span>
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Sidebar component, swap this element with another sidebar if you like -->
          <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-2">
            <div class="flex h-16 shrink-0 items-center">
              <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            </div>
            <nav class="flex flex-1 flex-col">
              <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                  <ul role="list" class="-mx-2 space-y-1">
                    <li>
                      <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                      <a href="#" class="bg-gray-50 text-indigo-600 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="h-6 w-6 shrink-0 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        Team
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                        </svg>
                        Projects
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Calendar
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                        </svg>
                        Documents
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                        </svg>
                        Reports
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <div class="text-xs font-semibold leading-6 text-gray-400">Your teams</div>
                  <ul role="list" class="-mx-2 mt-2 space-y-1">
                    <li>
                      <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">H</span>
                        <span class="truncate">Heroicons</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">T</span>
                        <span class="truncate">Tailwind Labs</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">W</span>
                        <span class="truncate">Workcation</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
        <div class="flex h-16 shrink-0 items-center bg-blue-600 px-4 mt-4 rounded-lg text-white ">
          <img class="h-12 w-auto" src="{{asset('images/his-logo.png')}}" alt="HMIS">
          <p class="poppins-medium text-xs px-2 tracking-wider">Hospital Information System</p>
        </div>
        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                <li>
                  <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                  <a wire:navigate href="{{route('admin.dashboard')}}" class="{{request()->routeIs('admin.dashboard') ? 'text-blue-600 bg-gray-100 mb-5 poppins-medium hover:text-blue-600 hover:bg-gray-50 group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold' : 'mb-5  poppins-medium hover:text-blue-600 hover:bg-gray-50 group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold'}}">
                    <svg class="h-6 w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                      </svg>
                    Dashboard
                  </a>
                </li>
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400">Manage</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                        <li>
                            <a wire:navigate href="{{ route('admin.doctors') }}" class="{{ request()->routeIs('admin.doctors') ? 'text-blue-600 bg-gray-100 mb-5 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' : 'mb-5 poppins-medium group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold hover:text-blue-600 hover:bg-gray-50' }}">
                                <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('admin.doctors') ? 'text-blue-600' : 'text-gray-500' }}" viewBox="0 0 17 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                                    <path d="M8.5 10C11.1828 10 13.3571 7.76172 13.3571 5C13.3571 2.23828 11.1828 0 8.5 0C5.81719 0 3.64286 2.23828 3.64286 5C3.64286 7.76172 5.81719 10 8.5 10ZM3.94643 16.5625C3.94643 17.082 4.35246 17.5 4.85714 17.5C5.36183 17.5 5.76786 17.082 5.76786 16.5625C5.76786 16.043 5.36183 15.625 4.85714 15.625C4.35246 15.625 3.94643 16.043 3.94643 16.5625ZM12.1429 11.2734V13.1875C13.5279 13.4766 14.5714 14.7422 14.5714 16.25V17.8789C14.5714 18.1758 14.3665 18.4336 14.0819 18.4922L12.86 18.7422C12.6969 18.7773 12.5375 18.668 12.5033 18.4961L12.3857 17.8828C12.3516 17.7148 12.4578 17.5469 12.6248 17.5156L13.3571 17.3633V16.25C13.3571 13.7969 9.71429 13.707 9.71429 16.3242V17.3672L10.4467 17.5195C10.6098 17.5547 10.7161 17.7188 10.6857 17.8867L10.5681 18.5C10.5339 18.668 10.3746 18.7773 10.2114 18.7461L9.02746 18.582C8.72768 18.5391 8.50379 18.2773 8.50379 17.9609V16.25C8.50379 14.7422 9.54732 13.4805 10.9324 13.1875V11.4219C10.8489 11.4492 10.7654 11.4648 10.6819 11.4961C9.99888 11.7422 9.26652 11.8789 8.50379 11.8789C7.74107 11.8789 7.00871 11.7422 6.32567 11.4961C6.04487 11.3945 5.76027 11.332 5.46808 11.293V14.4805C6.34464 14.75 6.98594 15.5781 6.98594 16.5664C6.98594 17.7734 6.03348 18.7539 4.86094 18.7539C3.68839 18.7539 2.73594 17.7734 2.73594 16.5664C2.73594 15.5781 3.37723 14.75 4.25379 14.4805V11.3398C1.8404 11.7578 0 13.8984 0 16.5V18.25C0 19.2148 0.762723 20 1.7 20H15.3C16.2373 20 17 19.2148 17 18.25V16.5C17 13.6875 14.8446 11.4102 12.1429 11.2734Z" fill="{{ request()->routeIs('admin.doctors') ? '#2563EB' : '#5B5B5B'}}"/>
                                </svg>
                                <span class="truncate">Doctors</span>
                            </a>
                        </li>
                      <li>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="h-6 w-6 shrink-0 text-blue-600" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.3826 0.538164C11.6554 0.200801 10.8531 0 10 0C7.60313 0 5.55804 1.48826 4.70937 3.59375H8.33393L12.3826 0.538164ZM15.2906 3.59375C14.9379 2.71912 14.3679 1.96758 13.6616 1.36922L10.7138 3.59375H15.2906ZM10 11.5C13.1558 11.5 15.7143 8.92553 15.7143 5.75C15.7143 5.50383 15.6719 5.26934 15.6424 5.03125H4.35759C4.32768 5.26934 4.28571 5.50383 4.28571 5.75C4.28571 8.92553 6.8442 11.5 10 11.5ZM3.57143 13.4631V23H9.29732L4.90223 13.0489C4.444 13.1339 3.99732 13.2729 3.57143 13.4631ZM0 20.8438C0 22.0346 0.959375 23 2.14286 23V14.3858C0.842857 15.4931 0 17.1269 0 18.975V20.8438ZM11.4286 18.6875H8.95625L10.8612 23H11.4286C12.6103 23 13.5714 22.0328 13.5714 20.8438C13.5714 19.6547 12.6103 18.6875 11.4286 18.6875ZM14 12.9375H13.254C12.2612 13.3948 11.1612 13.6562 10 13.6562C8.83884 13.6562 7.73884 13.3948 6.74598 12.9375H6.41696L8.32188 17.25H11.4286C13.3978 17.25 15 18.8622 15 20.8438C15 21.6559 14.7205 22.3976 14.2674 23H17.8571C19.0406 23 20 22.0346 20 20.8438V18.975C20 15.6404 17.3138 12.9375 14 12.9375Z" fill="#5B5B5B"/>
                            </svg>
                           <span class="truncate">Patients</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="h-6 w-6 shrink-0 text-blue-600" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.775 6C7.22236 6 8.4 4.87844 8.4 3.5C8.4 2.12156 7.22236 1 5.775 1C4.32764 1 3.15 2.12156 3.15 3.5C3.15 4.87844 4.32764 6 5.775 6ZM17.325 2H9.975C9.68494 2 9.45 2.22375 9.45 2.5V7H2.1V0.5C2.1 0.22375 1.86506 0 1.575 0H0.525C0.234937 0 0 0.22375 0 0.5V11.5C0 11.7762 0.234937 12 0.525 12H1.575C1.86506 12 2.1 11.7762 2.1 11.5V10H18.9V11.5C18.9 11.7762 19.1349 12 19.425 12H20.475C20.7651 12 21 11.7762 21 11.5V5.5C21 3.56687 19.3548 2 17.325 2Z" fill="#5B5B5B"/>
                            </svg>
                            <span class="truncate">Rooms and Beds</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400">Transactions</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                      <li>
                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">H</span>
                          <span class="truncate">Heroicons</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">T</span>
                          <span class="truncate">Tailwind Labs</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                          <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">W</span>
                          <span class="truncate">Workcation</span>
                        </a>
                      </li>
                    </ul>
                  </li>
              </ul>
            </li>
            <li>
              <div class="text-xs font-semibold leading-6 text-gray-400">Reports</div>
              <ul role="list" class="-mx-2 mt-2 space-y-1">
                <li>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                      <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                      </svg>
                      Reports
                    </a>
                  </li>
                </ul>
            </li>
            <li class="-mx-1 mt-auto">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-blue-600 w-full">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                          </svg>
                        Logout
                    </button>
                </form>
              </li>
        </nav>
      </div>
    </div>

    <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden">
      <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
      <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
      <a href="#">
        <span class="sr-only">Your profile</span>
        <img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
      </a>
    </div>

    <main class="lg:pl-72">
      <div class="xl:pr-96">
        <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">
            <div class="px-4 mt-12 text-4xl font-semibold text-gray-700 poppins-regular">
                @yield('title')
            </div>
            <div class="p-4">
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
