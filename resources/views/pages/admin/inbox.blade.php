@extends('layouts.admin')

@section('title', $view === 'chat' ? 'Chat' : 'Inbox')

@section('content')
    @if ($view === 'inbox')
        <!-- Inbox Content -->
        <div class="flex-1 p-6 bg-white">
            <h1 class="text-xl font-bold mb-6">Inbox</h1>
            
            <!-- Search Bar -->
            <div class="mb-4 relative flex justify-between">
                <div class="relative flex-1">
                    <input type="text" placeholder="Search mail" class="w-full pl-10 pr-4 py-2 bg-gray-100 rounded-lg">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="flex space-x-2 ml-2">
                    <button class="p-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-print"></i>
                    </button>
                    <button class="p-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            
            <!-- Email List -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                @foreach($emails as $email)
                <a href="{{ route('inbox', ['contact_id' => $email['id']]) }}" class="flex items-center px-4 py-3 border-b border-gray-200 hover:bg-gray-50 cursor-pointer block">
                    <div class="w-48">
                        <p class="font-medium text-gray-800">{{ $email['sender'] }}</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800">{{ $email['subject'] }}</p>
                    </div>
                    <div class="w-24 text-right">
                        <p class="text-gray-600 text-sm">{{ $email['time'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    @elseif ($view === 'chat' && $contact)
        <!-- Chat Content -->
        <div class="flex-1 bg-white p-6">
            <h1 class="text-xl font-bold mb-6">Inbox</h1>

            <!-- Chat Container -->
            <div class="border border-gray-200 rounded-lg bg-white overflow-hidden flex flex-col h-5/6">
                <!-- Chat Header -->
                <div class="border-b border-gray-200 p-4 flex items-center justify-between bg-white">
                    <div class="flex items-center">
                        <a href="{{ route('inbox') }}" class="text-gray-600 mr-4">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div class="flex items-center">
                            <h2 class="font-medium text-gray-800">{{ $contact['name'] }}</h2>
                            @if(!empty($contact['label']))
                            <span class="ml-2 px-2 py-1 bg-pink-100 text-pink-500 text-xs rounded-md">{{ $contact['label'] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- Messages Area -->
                <div class="flex-1 p-4 overflow-y-auto bg-gray-50" id="messagesContainer">
                    @foreach($messages as $message)
                        @if($message['sender'] == 'contact')
                            <!-- Contact Message -->
                            <div class="flex mb-4">
                                {{-- Avatar dihapus --}}
                                <div class="ml-3 max-w-3xl">
                                    <div class="bg-white p-3 rounded-lg shadow-sm">
                                        <p class="text-gray-800">{{ $message['content'] }}</p>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1 flex items-center justify-between">
                                        <span>{{ $message['time'] }}</span>
                                        <button class="text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- My Message -->
                            <div class="flex mb-4 justify-end">
                                <div class="mr-3 max-w-3xl">
                                    <div class="bg-blue-500 p-3 rounded-lg shadow-sm">
                                        <p class="text-white">{{ $message['content'] }}</p>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1 flex items-center justify-between">
                                        <span>{{ $message['time'] }}</span>
                                        <button class="text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Message Input -->
                <div class="p-4 border-t border-gray-200 bg-white">
                    <div class="flex items-center">
                        {{-- Mic icon dihapus --}}
                        <input type="text" placeholder="Write message..." class="flex-1 py-2 px-3 rounded-lg bg-gray-100 border-none focus:ring-2 focus:ring-blue-500 focus:outline-none" id="messageInput">
                        <div class="flex ml-2">
                            {{-- File & image icon dihapus --}}
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2 flex items-center" id="sendButton">
                                Send
                                <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Fallback if contact not found -->
        <div class="flex-1 p-6 bg-white">
            <h1 class="text-xl font-bold mb-6">Contact not found</h1>
            <p>The contact you are looking for does not exist. <a href="{{ route('inbox') }}" class="text-blue-500 hover:underline">Return to inbox</a>.</p>
        </div>
    @endif
@endsection

@push('scripts')
@if ($view === 'chat' && $contact)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messagesContainer = document.getElementById('messagesContainer');
        if(messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');

        if(messageInput && sendButton && messagesContainer) {
            sendButton.addEventListener('click', function() {
                const messageText = messageInput.value.trim();
                if(messageText) {
                    const now = new Date();
                    const timeString = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();

                    const messageHTML = `
                        <div class="flex mb-4 justify-end">
                            <div class="mr-3 max-w-3xl">
                                <div class="bg-blue-500 p-3 rounded-lg shadow-sm">
                                    <p class="text-white">${messageText}</p>
                                </div>
                                <div class="text-xs text-gray-500 mt-1 flex items-center justify-between">
                                    <span>${timeString}</span>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

                    messagesContainer.insertAdjacentHTML('beforeend', messageHTML);

                    fetch('{{ route("inbox.send-message") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            contact_id: {{ $contactId }},
                            message: messageText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Optional: handle server response
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                    messageInput.value = '';
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            });

            messageInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    sendButton.click();
                }
            });
        }
    });
</script>
@endif
@endpush
