@if (Session::has('message'))
    <!-- Container for demo purpose -->
    <div class="container absolute right-0 top-0 max-w-sm z-30">
        <!-- Section: Design Block -->
        <section e-data="{open: true}" x-show="open">
            <div
                class="alert alert-dismissible fade show items-center justify-between rounded-lg bg-[#C83B1A] py-4 px-6 text-center text-white md:flex md:text-left">
                <div class="mb-4 flex flex-wrap items-center justify-center md:mb-0 md:justify-start">
                <span class="mr-2 [&>svg]:h-5 [&>svg]:w-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                    </svg>
                </span>

                {{ Session::get('message') }}

                </div>
                <div class="flex items-center justify-center">
                <a @click="open = false" href="" class="text-white" data-te-alert-dismiss aria-label="Close">
                    <span class="[&>svg]:h-6 [&>svg]:w-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </span>
                </a>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->
    </div>
    <!-- Container for demo purpose -->
@endif