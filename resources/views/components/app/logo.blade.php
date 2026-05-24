@routeLinkStart ('home',
    [
        'class' => 'flex items-center md:absolute md:top-1/2 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2',
        'wire:navigate' => true
    ])
<img class="-ml-1 hidden w-8 md:inline" src="{{ asset('assets/images/logo.png') }}" alt="LaraGDPR" />
<span class="ml-1.5 align-middle text-2xl font-semibold transition-all duration-300"> {{ config('app.name') }} </span>
@routeLinkEnd
