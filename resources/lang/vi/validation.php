<?php 
/**
 * This file defines custom error messages for form validation fields,
 * returning user-friendly reasons for each validation failure.
*/

return [
    'required' => ':attribute là trường bắt buộc.',
    'max' => ':attribute không được dài quá :max ký tự.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'unique' => ':attribute đã tồn tại.',
    'nullable' => ':attribute có thể để trống.',
    'in' => ':attribute phải là một trong các giá trị: :values.',
    'boolean' => ':attribute phải là kiểu boolean (true/false).',
    'min' => ':attribute phải có ít nhất :min ký tự.',
    
    'custom' => [
        // ========================== COMMON FIELDS IN FORM ========================== //
        'name' => [
            'required' => 'Tên danh mục không được để trống.',
            'max' => 'Tên danh mục không được vượt quá 100 ký tự.',
            'unique' => 'Tên danh mục đã tồn tại.',
        ],
        'content' => [
            'required' => 'Nội dung biểu mẫu là bắt buộc.',
            'string' => 'Nội dung biểu mẫu phải là một chuỗi ký tự.',
        ],
        'description' => [
            'string' => 'Mô tả phải là một chuỗi ký tự.',
            'max' => 'Mô tả không được vượt quá 255 ký tự.',
        ],
        'active' => [
            'boolean' => 'Trạng thái kích hoạt phải là true hoặc false.',
        ],
        'slug' => [
            'required' => 'Slug không được để trống.',
            'string' => 'Slug phải là một chuỗi ký tự.',
            'max' => 'Slug không được vượt quá 255 ký tự.',
            'unique' => 'Slug đã tồn tại.',
        ],
        'user_id_created' => [
            'required' => 'Không kiểm tra được thông tin người tạo.',
            'exists' => 'Người tạo không hợp lệ.',
        ],
        'user_id_updated' => [
            'required' => 'Không kiểm tra được thông tin người cập nhật.',
            'exists' => 'Người cập nhật không hợp lệ.',
        ],
        // ========================== NEWS FORM ========================== //
        'title' => [
            'required' => 'Tiêu đề không được để trống.',
            'string' => 'Tiêu đề phải là một chuỗi ký tự.',
            'max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'unique' => 'Tiêu đề đã tồn tại.',
        ],
        'excerpt' => [
            'required' => 'Tóm tắt không được để trống.',
            'string' => 'Tóm tắt phải là một chuỗi ký tự.',
            'max' => 'Tóm tắt không được vượt quá 255 ký tự.',
        ],
        'thumbnail' => [
            'required' => 'Thumbnail không được để trống.',
            'string' => 'Thumbnail phải là đường dẫn chuỗi.',
            'max' => 'Đường dẫn Thumbnail không được vượt quá 255 ký tự.',
        ],
        'news_category_id' => [
            'required' => 'Vui lòng chọn danh mục tin tức.',
            'exists' => 'Danh mục tin tức không hợp lệ.',
        ],
        // ========================== USERS FORM ========================== //
        'fullname' => [
            'required' => 'Họ tên là bắt buộc.',
            'max' => 'Họ tên không được dài quá 50 ký tự.',
        ],
        'email' => [
            'required' => 'Email là bắt buộc.',
            'email' => 'Email không hợp lệ.',
            'max' => 'Email không được dài quá 100 ký tự.',
            'unique' => 'Email đã tồn tại.',
        ],
        'phone' => [
            'max' => 'Số điện thoại không được dài quá 11 ký tự.',
        ],
        'role' => [
            'required' => 'Vai trò là bắt buộc.',
            'in' => 'Vai trò phải là ADMIN hoặc STAFF.',
        ],
        'password' => [
            'nullable' => 'Mật khẩu có thể để trống.',
            'min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ],
    ],
];
