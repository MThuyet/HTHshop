<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('pages.client.ContactPage');
    }

    public function submitForm(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'fullname' => 'required|string|max:50',
                    'email' => 'required|email|string|max:100',
                    'message' => 'required|string|min:10|max:500'
                ],
                [
                    'fullname.required' => 'Vui lòng nhập họ và tên.',
                    'fullname.max' => 'Họ tên không được vượt quá 50 ký tự.',
                    'email.required' => 'Vui lòng nhập email.',
                    'email.email' => 'Email không hợp lệ.',
                    'email.max' => 'Email không được dài quá 255 ký tự.',
                    'message.required' => 'Vui lòng nhập nội dung tin nhắn.',
                    'message.min' => 'Nội dung phải từ 10 ký tự trở lên.',
                    'message.max' => 'Nội dung không vượt quá 500 ký tự.',
                ]
            );

            if($this->checkBadWord($validated['fullname'], $validated['email'], $validated['message']) === false)
            return redirect()->back()->with('toast', [
                'title' => 'Cảnh báo',
                'text' => 'Tin nhắn không hợp lệ, vui lòng không sử dụng từ ngữ không phù hợp',
                'icon' => 'warning'
            ]); 

            Mail::send('emails.contact', [
                'fullname' => $validated['fullname'],
                'email' => $validated['email'],
                'userMessage' => $validated['message'],
            ] , function ($message) use ($validated) {
                $message->to($validated['email'])
                        ->subject('Liên hệ mới từ website');
            });
            
            return redirect()->back()->with('toast', [
                'title' => 'Thành công',
                'text' => 'Gửi thông tin liên hệ thành công',
                'icon' => 'success' 
            ]);

        } catch(ValidationException $e) {
            $firstField = array_key_first($e->errors()); 
            $firstError = $e->errors()[$firstField][0];  
    
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi gửi email',
                'text' => $firstError,
                'icon' => 'error'
            ]);

        } catch(\Exception $e) {
            return redirect()->back()->with('toast', [
                'title' => 'Thất bại',
                'text' => 'Có lỗi khi gửi email ' . $e->getMessage(),
                'icon' => 'error' 
            ]);
        }
    }

    public function checkBadWord($fullname, $email, $message) 
    {   
        $blacklist_words = [
            // Tục tĩu, khiếm nhã
            'bitch', 'asshole', 'fuck', 'shit', 'damn', 'cunt', 'dick', 'slut', 'whore', 
            'bastard', 'idiot', 'prick',
        
            // Từ ngữ xúc phạm, phân biệt chủng tộc hoặc giới tính
            'nigger', 'spic', 'chink', 'fag', 'dyke', 'kike', 'jap', 
        
            // Từ ngữ xúc phạm về tình dục
            'rape', 'gangbang', 'porn', 'paedophile', 'sex slave', 'incest',
        
            // Từ ngữ xúc phạm đến tôn giáo hoặc tín ngưỡng
            'blasphemy', 'goddamn', 'hell', 'devil', 'satanic',
        
            // Lời lẽ mang tính kích động bạo lực hoặc phá hoại
            'kill', 'murder', 'suicide', 'bomb', 'terrorist', 'massacre', 'shooting',
        
            // Các từ liên quan đến chất cấm, ma túy, hay hoạt động bất hợp pháp
            'heroin', 'cocaine', 'meth', 'crack', 'marijuana', 'illegal',
        
            // Các từ lăng mạ, xúc phạm xã hội
            'loser', 'retarded', 'stupid', 'dumb', 'crazy', 'freak',
        
            // Các từ không mong muốn liên quan đến các hoạt động sai trái
            'hack', 'cheat', 'scam', 'fraud',
        ];

        foreach ($blacklist_words as $bad_word) {
            if (
                stripos($fullname, $bad_word) !== false || 
                stripos($email, $bad_word) !== false ||
                stripos($message, $bad_word) !== false
            )
            return false;
        }

        return true;
    }
}
