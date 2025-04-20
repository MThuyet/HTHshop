@extends('layouts.admin.master')
@section('title', 'Tạo danh mục tin tức mới')
@section('nav-active', 'news')

@php 
    $breadCrump = [
        ['name' => 'Quản lý tin tức', 'href' => route('admin.news')],
        ['name' => 'Tạo tin tức mới', 'href' => route('admin.news.create')]
    ]; 
@endphp
    
    @section('content')
    <div class="bg-white p-2 border border-1 rounded-md">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data"
        class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        
            <div class="grid md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    {{-- Tiêu đề --}}
                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700">Tiêu đề</label>
                        <input type="text" name="title" id="title" maxlength="255" value="{{ old('title') }}"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nhập tiêu đề tin tức" required>
                    </div>
                
                    {{-- Trích đoạn (excerpt) --}}
                    <div class="mt-3">
                        <label for="excerpt" class="block text-sm font-bold text-gray-700">Tóm tắt</label>
                        <textarea name="excerpt" id="excerpt" rows="3" placeholder="Tóm tắt nội dung"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old    ('excerpt') }}</textarea>
                    </div>
                
                    {{-- Danh mục --}}
                    <div class="mt-3">
                        <label for="news_category_id" class="block text-sm font-bold text-gray-700">Danh mục</label>
                        <select name="news_category_id" id="news_category_id"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($newsCategory as $category)
                                <option value="{{ $category->id }}" {{ old('news_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                {{-- Ảnh thumbnail --}}
                <div>
                    <label for="thumbnail" class="block text-sm font-bold text-gray-700">Thumbnail</label>
                    <div class="mt-2">
                        <img id="thumbnail-preview" src="" alt="Xem trước ảnh" class="h-[220px] max-w-xs border mt-2">
                    </div>
                    <input type="hidden" name="thumbnail" id="thumbnail" value="">
                    <button type="button" onclick="selectThumbnail()" class="px-3 py-1 bg-gray-700 text-white rounded">Chọn ảnh</button>
                </div>
            </div>

            {{-- Nội dung --}}
            <div>
                <label for="content" class="block text-sm font-bold text-gray-700">Nội dung</label>
                <textarea name="content" id="content" rows="10"
                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old    ('content') }}</textarea>
            </div>
        
            {{-- Trạng thái --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" name="active" id="active" class="w-4 h-4" {{ old('active', true) ? 'checked' : '' }}>
                <label for="active" class="text-sm text-gray-700">Hiển thị</label>
            </div>
        
            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">
                    Tạo tin tức
                </button>
            </div>
        </form>
    </div>
    @endsection
@push('scripts')
<script src="https://cdn.tiny.cloud/1/bldt8xp0wjaathxzjmhglfvu37i4aie1q6ynzma1x7wf40pp/tinymce/7/tinymce.min.js"    referrerpolicy="origin"></script>
<script>
    var editor_config = {
        path_absolute: "/",
        selector: '#content',
        relative_urls: false,
        plugins: [
            "advlist", "autolink", "lists", "link", "image", "charmap", "preview", 
            "anchor", "pagebreak", "searchreplace", "wordcount", "visualblocks", 
            "visualchars", "code", "fullscreen", "insertdatetime", "media", "nonbreaking", 
            "save", "table", "directionality", "emoticons",
            "codesample"
        ],

        toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image code | table media | lineheight outdent indent | forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",


        file_picker_callback: function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                'body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document
                .getElementsByTagName('body')[0].clientHeight;


            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
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

            // Nếu là object
            if (typeof fileUrl === 'object' && fileUrl.url) {
                url = fileUrl.url;
            }

            // Nếu là mảng chứa object
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