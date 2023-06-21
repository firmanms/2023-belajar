<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     Hallo, {{ Auth::user()->name }}
                     <!-- Three columns -->
                     <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 bg-gray-500">
                            <div class="w-1/3 bg-gray-400 h-12">
                                <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                                    <div class="p-6">
                                      <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                        Member
                                      </h5>
                                      <h1 class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                                        100
                                      </h1>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 bg-gray-500">
                            <div class="w-1/3 bg-gray-400 h-12">
                                <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                                    <div class="p-6">
                                      <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                        Artikel
                                      </h5>
                                      <h1 class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                                        100
                                      </h1>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 bg-gray-500">
                            <div class="w-1/3 bg-gray-400 h-12">
                                <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                                    <div class="p-6">
                                      <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                        Komentar
                                      </h5>
                                      <h1 class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                                        100
                                      </h1>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        
                      </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    
</x-app-layout>
