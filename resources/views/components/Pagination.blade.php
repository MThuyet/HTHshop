<div class="flex flex-wrap justify-center gap-5 items-center mt-3 px-2">
    <span class="text-sm text-gray-500">
        Hiển thị {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}/{{ $paginator->total() }} dòng
    </span>
    <div class="flex items-center gap-1">
        @if ($paginator->lastPage() > 1)
            {{
                $paginator->appends(request()->query())
                ->links('vendor.pagination.tailwind')
            }}
        @else
            <span class="text-gray-400 text-sm">Chỉ có 1 trang</span>
        @endif
    </div>
</div>
