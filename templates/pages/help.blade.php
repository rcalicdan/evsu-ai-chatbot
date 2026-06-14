@extends('layouts.public')
@section('content')
    <div class="max-w-3xl mx-auto px-4 py-16 sm:py-24">
        <h1 class="text-4xl font-extrabold text-slate-900 mb-8 border-b-4 border-evsu-gold inline-block pb-2">System Help
        </h1>

        <div class="space-y-6">
            <div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-200">
                <h3 class="text-lg font-bold text-evsu-maroon mb-2">How do I start a conversation?</h3>
                <p class="text-slate-600">Simply click the "Start Chatting" button on the navigation bar, and type your
                    question into the chatbox at the bottom of the screen.</p>
            </div>

            <div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-200">
                <h3 class="text-lg font-bold text-evsu-maroon mb-2">My chat history is stuck or broken. What do I do?</h3>
                <p class="text-slate-600">You can clear your local cache by opening the sidebar menu on the Chat page and
                    clicking "Reset Conversation".</p>
            </div>

            <div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-200">
                <h3 class="text-lg font-bold text-evsu-maroon mb-2">What kind of questions can I ask?</h3>
                <p class="text-slate-600 mb-2">The bot excels at answering questions related to:</p>
                <ul class="list-disc list-inside text-slate-600 space-y-1">
                    <li>Enrollment steps and Registrar documents</li>
                    <li>Available undergraduate and graduate programs</li>
                    <li>Campus locations and specific facilities</li>
                    <li>NSTP guidelines and uniform opt-outs</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
