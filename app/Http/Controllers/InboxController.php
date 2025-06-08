<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InboxController extends Controller
{

    public function index(Request $request)
    {
        $view = $request->has('contact_id') ? 'chat' : 'inbox';
        $contactId = $request->input('contact_id');

        $emails = [
            [
                'id' => 1,
                'sender' => 'Ais',
                'subject' => 'Hallo, namaste',
                'time' => '8:38 AM'
            ],
            [
                'id' => 2,
                'sender' => 'Naylah',
                'subject' => 'Hallo, hidup itu beban',
                'time' => '8:38 AM'
            ],
        ];

        $contact = null;
        $messages = [];
        if ($view === 'chat' && $contactId) {
            foreach ($emails as $email) {
                if ($email['id'] == $contactId) {
                    $contact = [
                        'id' => $email['id'],
                        'name' => $email['sender'],
                        'label' => isset($email['label']) ? $email['label'] : '',
                        'avatar' => 'image/ais.png'
                    ];
                    break;
                }
            }

            if ($contact && $contact['name'] === 'Minerva Barrett') {
                $messages = [
                    [
                        'sender' => 'contact',
                        'content' => 'namaste',
                        'time' => '5:30 pm'
                    ],
                    [
                        'sender' => 'me',
                        'content' => 'hallo',
                        'time' => '5:34 pm'
                    ],
                ];
            } else {
                $messages = [
                    [
                        'sender' => 'contact',
                        'content' => 'Hello!',
                        'time' => '10:30 am'
                    ],
                    [
                        'sender' => 'me',
                        'content' => 'pie kabare',
                        'time' => '10:35 am'
                    ],
                    [
                        'sender' => 'contact',
                        'content' => 'sehat',
                        'time' => '10:38 am'
                    ],
                ];
            }
        }

        return view('pages.admin.inbox', compact('view', 'emails', 'contact', 'messages', 'contactId'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|integer',
            'message' => 'required|string',
        ]);
    
        // Simulasi: Tambahkan ke session atau simpan ke database sesuai struktur kamu
        $contactId = $request->input('contact_id');
        $message = $request->input('message');
    
        // Contoh jika kamu simpan ke session (simulasi saja)
        $messages = session()->get("messages.$contactId", []);
        $messages[] = [
            'sender' => 'me',
            'content' => $message,
            'time' => now()->format('H:i')
        ];
        session()->put("messages.$contactId", $messages);
    
        return response()->json(['success' => true]);
    }
    
}