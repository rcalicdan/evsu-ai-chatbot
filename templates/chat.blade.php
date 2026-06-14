@extends('layouts.app')

@section('title', $title ?? 'EVSU Virtual Campus Companion')

@section('content')
    <!-- Messages Area Container (Added id="message-container") -->
    <div id="message-container" class="flex-1 overflow-y-auto px-6 py-8 md:px-12 space-y-6">

        <!-- Expanded General-Purpose Welcome View (Shown when message history is empty) -->
        <template x-if="messages.length === 0">
            <div class="flex flex-col items-center justify-center min-h-[75vh] text-center max-w-2xl mx-auto py-8">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-evsu-maroon to-evsu-maroonlight flex items-center justify-center text-white text-3xl font-black shadow-xl border-2 border-evsu-gold mb-8 shadow-evsu-maroon/20">
                    E
                </div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">How can I assist you on campus today?</h2>
                <p class="mt-3 text-sm text-slate-600 max-w-md mx-auto leading-relaxed">
                    I am your comprehensive EVSU guide. Ask me about enrollment, offered academic programs, portals, facilities, calendar schedules, and more!
                </p>

                <!-- Categorized Prompts Layout -->
                <div class="w-full mt-10 space-y-6 text-left">
                    <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block border-b border-slate-200 pb-2">Select a topic to start</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Group 1: Enrollment & Academics -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2 text-evsu-maroon font-bold text-xs uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.62 48.62 0 0112 20.9c4.956-1.936 8.285-4.41 8.285-4.41a60.188 60.188 0 00-.49-6.347m-16.1 0a48.314 48.314 0 0016.1 0m-16.1 0L12 14.25l8.05-4.103m-16.1 0a48.536 48.536 0 0116.1 0M12 3v11.25" /></svg>
                                <span>Enrollment & Academics</span>
                            </div>
                            <div class="space-y-2">
                                <button @click="sendQuickPrompt('What are the enrollment requirements for freshmen?')"
                                    class="w-full p-3.5 text-left bg-white border border-slate-200 hover:border-evsu-maroon/40 hover:shadow-md transition-all rounded-xl text-xs flex items-center justify-between group">
                                    <span class="font-semibold text-slate-800 group-hover:text-evsu-maroon">View freshman admission checklist</span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-evsu-maroon shrink-0 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                                </button>
                                <button @click="sendQuickPrompt('Explain the step-by-step enrollment process.')"
                                    class="w-full p-3.5 text-left bg-white border border-slate-200 hover:border-evsu-maroon/40 hover:shadow-md transition-all rounded-xl text-xs flex items-center justify-between group">
                                    <span class="font-semibold text-slate-800 group-hover:text-evsu-maroon">Explore registration procedure</span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-evsu-maroon shrink-0 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Group 2: Campuses & General Info -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2 text-evsu-maroon font-bold text-xs uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9m0 0a9.004 9.004 0 018.716 2.253M12 3a9.004 9.004 0 00-8.716 2.253M12 12h.008v.008H12V12z" /></svg>
                                <span>Campuses & Facilities</span>
                            </div>
                            <div class="space-y-2">
                                <button @click="sendQuickPrompt('Where are EVSU\'s branch campuses located?')"
                                    class="w-full p-3.5 text-left bg-white border border-slate-200 hover:border-evsu-maroon/40 hover:shadow-md transition-all rounded-xl text-xs flex items-center justify-between group">
                                    <span class="font-semibold text-slate-800 group-hover:text-evsu-maroon">Find branch campuses & addresses</span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-evsu-maroon shrink-0 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                                </button>
                                <button @click="sendQuickPrompt('Are undergraduate programs free at EVSU?')"
                                    class="w-full p-3.5 text-left bg-white border border-slate-200 hover:border-evsu-maroon/40 hover:shadow-md transition-all rounded-xl text-xs flex items-center justify-between group">
                                    <span class="font-semibold text-slate-800 group-hover:text-evsu-maroon">Check free tuition eligibility details</span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-evsu-maroon shrink-0 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </template>

        <!-- Active Message Dialogue Block -->
        <div class="max-w-3xl mx-auto space-y-6">
            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">

                    <!-- Bot Branding Avatar Icon -->
                    <template x-if="msg.role === 'model'">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-evsu-maroon to-evsu-maroonlight flex items-center justify-center text-white text-[11px] font-black border border-evsu-gold/30 mr-4 shrink-0 mt-0.5 shadow-md shadow-evsu-maroon/10">
                            E
                        </div>
                    </template>

                    <!-- Message Bubble Style -->
                    <div class="max-w-[85%] sm:max-w-[80%] rounded-2xl px-5 py-4 text-sm leading-relaxed shadow-sm transition-all"
                        :class="msg.role === 'user' ?
                            'bg-gradient-to-br from-evsu-maroon to-evsu-maroonlight text-white rounded-br-none' :
                            'bg-white text-slate-800 border border-slate-200/90 rounded-bl-none'">

                        <!-- 1. USER Bubble -->
                        <template x-if="msg.role === 'user'">
                            <div x-text="msg.content" class="whitespace-pre-wrap select-text selection:bg-evsu-gold selection:text-slate-900"></div>
                        </template>

                        <!-- 2. BOT Bubble -->
                        <template x-if="msg.role === 'model'">
                            <div>
                                <div class="flex items-center space-x-1.5 text-[9px] font-bold text-slate-400 tracking-wider uppercase mb-1.5">
                                    <span>EVSU COMPANION</span>
                                    <span class="text-slate-300">&bull;</span>
                                    <span class="text-evsu-golddark">OFFICIAL ASSISTANT</span>
                                </div>
                                <div x-html="renderMarkdown(msg.content)" class="markdown-content select-text selection:bg-evsu-gold selection:text-slate-900"></div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            <!-- Enhanced Typing Indicator -->
            <div x-show="isTyping" class="flex justify-start" x-transition>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-evsu-maroon to-evsu-maroonlight flex items-center justify-center text-white text-[11px] font-black border border-evsu-gold/30 mr-4 shrink-0 mt-0.5 shadow-md">
                    E
                </div>
                <div class="bg-white border border-slate-200/90 rounded-2xl rounded-bl-none px-6 py-4 flex items-center space-x-1.5 shadow-sm">
                    <div class="w-2.5 h-2.5 bg-evsu-maroon/80 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                    <div class="w-2.5 h-2.5 bg-evsu-maroon/80 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                    <div class="w-2.5 h-2.5 bg-evsu-maroon/80 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Unified Floating Chat Input Area -->
    <footer class="bg-white border-t border-slate-200/80 p-4 md:p-6 shadow-md z-10">
        <div class="max-w-3xl mx-auto">
            <form @submit.prevent="sendMessage()" class="relative flex items-center">
                <input type="text" x-model="userInput" placeholder="Type any campus or admission question here..."
                    class="w-full pl-5 pr-14 py-4 bg-slate-50 border border-slate-200/80 text-sm rounded-2xl focus:outline-none focus:border-evsu-maroon/60 focus:bg-white transition-all text-slate-800 shadow-inner"
                    :disabled="isTyping">

                <!-- Premium Action Button with Gold Highlights -->
                <button type="submit"
                    class="absolute right-3 p-2.5 rounded-xl text-slate-950 bg-gradient-to-r from-evsu-gold to-amber-400 hover:brightness-110 active:scale-95 transition-all disabled:opacity-30 disabled:scale-100 disabled:brightness-100 shadow-md"
                    :disabled="userInput.trim() === '' || isTyping">
                    <svg class="w-4 h-4 text-slate-900 transform rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </button>
            </form>
            <p class="text-[10px] text-center text-slate-400 mt-2.5 tracking-wide">
                Powered by Google Gemini LLM &bull; Structured with Semantic Search indexing of EVSU Campus Regulations
            </p>
        </div>
    </footer>
@endsection