@props(['items' => [], 'currentPage' => ''])

<nav class="bg-gray-50 ">
    <div class="responsive">
        <ol class="flex flex-wrap items-center gap-y-2">
            <li class="inline-flex items-center whitespace-nowrap">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-orangeColor">
                    <svg class="w-3 h-3 mr-2 text-orangeColor flex-shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    <span>Trang chủ</span>
                </a>
            </li>

            @foreach ($items as $index => $item)
                @if ($index < 2)
                    <li class="whitespace-nowrap">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1 flex-shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ $item['url'] }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-orangeColor md:ml-2">{{ $item['label'] }}</a>
                        </div>
                    </li>
                @else
                    <li class="w-full flex pl-5">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mr-1 flex-shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ $item['url'] }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-orangeColor md:ml-2">{{ $item['label'] }}</a>
                        </div>
                    </li>
                @endif
            @endforeach

            @if ($currentPage)
                @if (count($items) > 2)
                    <li class="w-full flex pl-5" aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mr-1 flex-shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-sm font-medium text-orangeColor md:ml-2">{{ $currentPage }}</span>
                        </div>
                    </li>
                @else
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1 flex-shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-sm font-medium text-orangeColor md:ml-2">{{ $currentPage }}</span>
                        </div>
                    </li>
                @endif
            @endif
        </ol>
    </div>
</nav>
