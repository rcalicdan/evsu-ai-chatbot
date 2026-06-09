<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'EVSU Chatbot Assistant' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        evsu: {
                            maroon: '#800000',     
                            maroonlight: '#991b1b',
                            gold: '#eab308',      
                            golddark: '#ca8a04'
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 3px;
        }
    </style>
</head>
<body class="h-full overflow-hidden text-slate-800" x-data="chatApp()" x-init="init()" x-cloak>

    <div class="flex h-full overflow-hidden">
        
        <!-- Mobile Sidebar Overlay Backdrop -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-sm lg:hidden"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <!-- Sidebar (Chat History / Utilities) -->
        <aside class="fixed inset-y-0 left-0 z-40 flex flex-col w-72 bg-slate-900 border-r border-slate-800 text-white transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-slate-800">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-lg bg-evsu-maroon flex items-center justify-center border border-evsu-gold/30">
                        <span class="text-xs font-bold text-evsu-gold">EVSU</span>
                    </div>
                    <span class="font-semibold tracking-wide text-sm">Enrollment Assistant</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- New Chat Button -->
            <div class="p-4">
                <button @click="resetChat()" class="flex items-center justify-center w-full px-4 py-2.5 space-x-2 text-sm font-medium text-slate-900 bg-evsu-gold hover:bg-evsu-golddark active:scale-[0.98] transition-all rounded-xl focus:outline-none shadow-lg shadow-evsu-gold/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    <span>Clear Conversation</span>
                </button>
            </div>

            <!-- Info Area -->
            <div class="flex-1 px-4 py-2 overflow-y-auto space-y-4">
                <div class="p-3 bg-slate-800/40 rounded-xl border border-slate-800 text-xs text-slate-400 leading-relaxed">
                    <span class="font-semibold text-slate-200 block mb-1">💡 Demo App Instructions</span>
                    This assistant responds to freshman guidelines, enrollment processes, and basic admission requirements. All chat sessions are saved locally on your device.
                </div>
                
                <div class="p-3 bg-slate-800/40 rounded-xl border border-slate-800 text-xs text-slate-400 leading-relaxed">
                    <span class="font-semibold text-slate-200 block mb-1">🏫 About EVSU</span>
                    Eastern Visayas State University is a premier state university headquartered in Tacloban City, Philippines, dedicated to science and technology education.
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-800 text-center text-xs text-slate-500">
                <span>EVSU Demo Project &copy; 2026</span>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col h-full bg-slate-50 overflow-hidden relative">
            
            <!-- Main Top Navbar -->
            <header class="flex items-center justify-between h-16 px-4 bg-white border-b border-slate-200 shadow-sm z-20">
                <div class="flex items-center space-x-3">
                    <!-- Toggle Menu Button (Mobile Only) -->
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    
                    <!-- Title info -->
                    <div class="flex items-center space-x-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                        <div>
                            <h1 class="text-sm font-semibold text-slate-900">EVSU Bot</h1>
                            <p class="text-[10px] text-slate-500 font-medium">Virtual Campus Guide</p>
                        </div>
                    </div>
                </div>

                <!-- EVSU Seal / Branding Mockup -->
                <div class="flex items-center space-x-2">
                    <span class="text-xs font-semibold text-evsu-maroon hidden md:inline">Eastern Visayas State University</span>
                    <div class="w-8 h-8 rounded-full bg-evsu-maroon border border-evsu-gold flex items-center justify-center text-white text-[10px] font-bold shadow-sm">
                        EVSU
                    </div>
                </div>
            </header>

            <!-- Messages Area -->
            <div class="flex-1 overflow-y-auto px-4 py-6 md:px-8 space-y-6" x-ref="messageContainer">
                
                <!-- Zero State Welcome View -->
                <template x-if="messages.length === 0">
                    <div class="flex flex-col items-center justify-center min-h-[70vh] text-center max-w-lg mx-auto py-8">
                        <div class="w-16 h-16 rounded-2xl bg-evsu-maroon flex items-center justify-center text-white text-xl font-bold shadow-xl border-2 border-evsu-gold mb-6">
                            E
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">EVSU Virtual Student Helper</h2>
                        <p class="mt-2 text-sm text-slate-600">
                            Welcome, future EVSU student! Ask me anything regarding enrollment requirements, processes, or general admission questions.
                        </p>

                        <!-- Quick Prompts Cards Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-8 w-full">
                            <button @click="sendQuickPrompt('What are the enrollment requirements for freshmen?')" 
                                    class="p-4 text-left bg-white border border-slate-200 rounded-xl hover:border-evsu-maroon/40 hover:shadow-md transition-all active:scale-[0.98] group">
                                <span class="block text-xs font-semibold text-slate-900 group-hover:text-evsu-maroon">Freshman Requirements</span>
                                <span class="block text-[11px] text-slate-500 mt-1">View list of mandatory documents for admissions.</span>
                            </button>
                            
                            <button @click="sendQuickPrompt('Explain the online enrollment process.')" 
                                    class="p-4 text-left bg-white border border-slate-200 rounded-xl hover:border-evsu-maroon/40 hover:shadow-md transition-all active:scale-[0.98] group">
                                <span class="block text-xs font-semibold text-slate-900 group-hover:text-evsu-maroon">Enrollment Steps</span>
                                <span class="block text-[11px] text-slate-500 mt-1 font-normal">Understand the step-by-step registration flow.</span>
                            </button>

                            <button @click="sendQuickPrompt('Where is the EVSU Main Campus located?')" 
                                    class="p-4 text-left bg-white border border-slate-200 rounded-xl hover:border-evsu-maroon/40 hover:shadow-md transition-all active:scale-[0.98] group">
                                <span class="block text-xs font-semibold text-slate-900 group-hover:text-evsu-maroon">Campus Location</span>
                                <span class="block text-[11px] text-slate-500 mt-1">Get coordinates and location of the university.</span>
                            </button>

                            <button @click="sendQuickPrompt('Who can I contact for admission inquiries?')" 
                                    class="p-4 text-left bg-white border border-slate-200 rounded-xl hover:border-evsu-maroon/40 hover:shadow-md transition-all active:scale-[0.98] group">
                                <span class="block text-xs font-semibold text-slate-900 group-hover:text-evsu-maroon">Contact Admission Office</span>
                                <span class="block text-[11px] text-slate-500 mt-1">Find email, phone numbers, and office schedule.</span>
                            </button>
                        </div>
                    </div>
                </template>

                <!-- Active Message List -->
                <div class="max-w-3xl mx-auto space-y-4">
                    <template x-for="(msg, index) in messages" :key="index">
                        <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                            
                            <!-- Bot Avatar -->
                            <template x-if="msg.role === 'model'">
                                <div class="w-8 h-8 rounded-lg bg-evsu-maroon flex items-center justify-center text-white text-[11px] font-bold border border-evsu-gold/30 mr-3 shrink-0 mt-0.5">
                                    E
                                </div>
                            </template>

                            <!-- Message Bubble -->
                            <div class="max-w-[85%] sm:max-w-[75%] rounded-2xl px-4 py-3 text-sm leading-relaxed"
                                 :class="msg.role === 'user' 
                                    ? 'bg-evsu-maroon text-white rounded-br-none shadow-sm' 
                                    : 'bg-white text-slate-800 border border-slate-200/80 rounded-bl-none shadow-sm'">
                                <div x-text="msg.content" class="whitespace-pre-wrap"></div>
                            </div>
                        </div>
                    </template>

                    <!-- Typing Indicator Bubble -->
                    <div x-show="isTyping" class="flex justify-start" x-transition>
                        <div class="w-8 h-8 rounded-lg bg-evsu-maroon flex items-center justify-center text-white text-[11px] font-bold border border-evsu-gold/30 mr-3 shrink-0 mt-0.5">
                            E
                        </div>
                        <div class="bg-white border border-slate-200/80 rounded-2xl rounded-bl-none px-4 py-4 flex items-center space-x-1 shadow-sm">
                            <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                            <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                            <div class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Chat Footer / Input area -->
            <footer class="bg-white border-t border-slate-200 p-4 md:px-8">
                <div class="max-w-3xl mx-auto">
                    <form @submit.prevent="sendMessage()" class="relative flex items-center">
                        <input type="text" 
                               x-model="userInput" 
                               placeholder="Type your question here (e.g. Freshman admission)..." 
                               class="w-full pl-4 pr-12 py-3 bg-slate-50 border border-slate-200 text-sm rounded-2xl focus:outline-none focus:border-evsu-maroon/60 focus:bg-white transition-all text-slate-800"
                               :disabled="isTyping">
                        
                        <!-- Send Button -->
                        <button type="submit" 
                                class="absolute right-2 p-2 rounded-xl text-white bg-evsu-maroon hover:bg-evsu-maroonlight focus:outline-none active:scale-95 transition-all disabled:opacity-40 disabled:scale-100"
                                :disabled="userInput.trim() === '' || isTyping">
                            <svg class="w-4 h-4 transform rotate-45" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        </button>
                    </form>
                    <p class="text-[10px] text-center text-slate-400 mt-2">
                        For demo testing only. Backed by Google Gemini LLM with local semantic search index.
                    </p>
                </div>
            </footer>
        </main>
    </div>

    <!-- Alpine.js Application Logic -->
    <script>
        function chatApp() {
            return {
                sidebarOpen: false,
                userInput: '',
                isTyping: false,
                messages: [],

                init() {
                    const saved = localStorage.getItem('evsu_chat_history');
                    if (saved) {
                        try {
                            this.messages = JSON.parse(saved);
                        } catch (e) {
                            localStorage.removeItem('evsu_chat_history');
                        }
                    }
                },

                sendQuickPrompt(text) {
                    this.userInput = text;
                    this.sendMessage();
                },

                // Core send action
                sendMessage() {
                    if (this.userInput.trim() === '') return;

                    const userText = this.userInput;
                    this.userInput = '';

                    // Append user's message
                    this.messages.push({
                        role: 'user',
                        content: userText
                    });

                    this.saveToStorage();
                    this.scrollToBottom();

                    // Start bot mock typing simulation
                    this.isTyping = true;
                    
                    setTimeout(() => {
                        this.getMockResponse(userText);
                    }, 1200);
                },

                // Simulated mockup responder (Will replace with streaming backend on subsequent steps)
                getMockResponse(query) {
                    let responseText = "I'm your EVSU Assistant. Once my backend is connected, I will search our university knowledge base and use AI to answer this question.";

                    const cleanQuery = query.toLowerCase();

                    if (cleanQuery.includes('requirement') || cleanQuery.includes('freshman')) {
                        responseText = "To enroll as an incoming freshman at Eastern Visayas State University (EVSU), you must submit the following core requirements:\n\n1. Original Form 138 (Senior High School Report Card)\n2. Certification of Good Moral Character\n3. Photocopy of PSA Birth Certificate\n4. Certificate of General Average (signed by principal)\n5. Two (2) identical 2x2 pictures with white background";
                    } else if (cleanQuery.includes('process') || cleanQuery.includes('steps')) {
                        responseText = "The general EVSU enrollment flow follows these steps:\n\nStep 1: Apply online through the EVSU Admission Portal.\nStep 2: Take the admission/placement exam.\nStep 3: Wait for qualifying lists from respective colleges.\nStep 4: Present requirements to the College Dean's office for evaluation.\nStep 5: Encode subjects in the registrar system and receive your Certificate of Registration (COR).";
                    } else if (cleanQuery.includes('location') || cleanQuery.includes('main')) {
                        responseText = "The Eastern Visayas State University (EVSU) Main Campus is located on Salazar Street, Tacloban City, Leyte, Philippines.";
                    } else if (cleanQuery.includes('contact') || cleanQuery.includes('admission')) {
                        responseText = "You can contact the EVSU Admission Office at admissions@evsu.edu.ph or visit the Student Services Building at the Tacloban Main Campus. The office is open Monday to Friday, 8:00 AM to 5:00 PM.";
                    }

                    this.messages.push({
                        role: 'model',
                        content: responseText
                    });

                    this.isTyping = false;
                    this.saveToStorage();
                    this.scrollToBottom();
                },

                resetChat() {
                    this.messages = [];
                    localStorage.removeItem('evsu_chat_history');
                },

                saveToStorage() {
                    localStorage.setItem('evsu_chat_history', JSON.stringify(this.messages));
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.messageContainer;
                        container.scrollTop = container.scrollHeight;
                    });
                }
            }
        }
    </script>
</body>
</html>