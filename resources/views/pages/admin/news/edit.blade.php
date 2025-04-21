@extends('layouts.admin.master')
@section('title', 'Chỉnh sửa tin tức')
@section('nav-active', 'news')

@php 
    $breadCrump = [
        ['name' => 'Quản lý tin tức', 'href' => route('dashboard.news')],
        ['name' => 'Chỉnh sửa tin tức', 'href' => Request::url()]
    ]; 
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <form action="{{ route('dashboard.news.update', $news->id) }}" method="POST" enctype="multipart/form-data"
        class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                {{-- Title --}}
                <div>
                    <label class="block font-bold">Tiêu đề
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" class="w-full border rounded px-3 py-2">
                </div>

                {{-- News Category Id --}}
                <div class="mt-3">
                    <label class="block font-bold">Danh mục
                        <span class="text-red-500">*</span>
                    </label>
                    <select name="news_category_id" class="w-full border rounded px-3 py-2">
                        @foreach ($newsCategory as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $news->news_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Excerpt --}}
                <div class="mt-3">
                    <label class="block font-bold">Tóm tắt
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea name="excerpt" id="excerpt" rows="3" placeholder="Tóm tắt nội dung" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $news->excerpt) }}</textarea>
                </div>
            </div>

            <div>
                {{-- Thumbnail --}}
                <label class="block mb-1 font-bold">Thumbnail
                    <span class="text-red-500">*</span>
                </label>
                <div class="mt-2">
                    <img id="thumbnail-preview" src="{{ asset('storage/' . $news->thumbnail) }}" alt="Xem trước ảnh" class="h-[220px] max-w-xs border mt-2 {{ $news->thumbnail ? '' : 'hidden' }}">
                </div>
                <input type="hidden" name="thumbnail" id="thumbnail" value="{{ $news->thumbnail }}">
                <button type="button" onclick="selectThumbnail()" class="px-3 py-1 bg-gray-700 text-white rounded">Chọn ảnh</button>
            </div>
        </div>

        {{-- Content --}}
        <div>
            <label class="block font-bold">Nội dung
                <span class="text-red-500">*</span>
            </label>
            <textarea id="content" name="content" class="w-full border rounded px-3 py-2">{{ old('content', $news->content) }}</textarea>
        </div>

        {{-- Active --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="active" value="1" {{ old('active', $news->active) ? 'checked' : '' }} class="w-4 h-4">
            <label>Hoạt động</label>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">
                Cập nhật tin tức
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/bldt8xp0wjaathxzjmhglfvu37i4aie1q6ynzma1x7wf40pp/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    var editor_config = {
        path_absolute: "/",
        selector: '#content',
        relative_urls: false,
        plugins: [
            "advlist", "autolink", "lists", "link", "image", "charmap", "preview", 
            "anchor", "pagebreak", "searchreplace", "wordcount", "visualblocks", 
            "visualchars", "code", "fullscreen", "insertdatetime", "media", "nonbreaking", 
            "save", "table", "directionality", "emoticons", "codesample"
        ],
        toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image code | table media | lineheight outdent indent | forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
        file_picker_callback: function(callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            let y = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

            let cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL += "&type=Images";
            } else {
                cmsURL += "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    };

    tinymce.init(editor_config);
    
    function selectThumbnail() {
        const cmsURL = '/laravel-filemanager?type=Images';

        window.open(cmsURL, 'FileManager', 'width=900,height=600');

        window.SetUrl = function (fileUrl) {
            let url = fileUrl;

            if (typeof fileUrl === 'object' && fileUrl.url) {
                url = fileUrl.url;
            }

            if (Array.isArray(fileUrl) && fileUrl.length > 0 && fileUrl[0].url) {
                url = fileUrl[0].url;
            }

            const input = document.getElementById('thumbnail');
            const preview = document.getElementById('thumbnail-preview');

            input.value = url;
            preview.src = url.startsWith('http') ? url : '/' + url;
            preview.classList.remove('hidden');
        };
    }
</script>
@endpush
