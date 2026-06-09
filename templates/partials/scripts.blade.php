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

            renderMarkdown(content) {
                if (typeof marked !== 'undefined') {
                    marked.setOptions({
                        breaks: true,
                        gfm: true
                    });
                    return marked.parse(content);
                }
                
                return content; 
            },

            sendQuickPrompt(text) {
                this.userInput = text;
                this.sendMessage();
            },

            sendMessage() {
                if (this.userInput.trim() === '') return;

                const userText = this.userInput;
                this.userInput = '';

                this.messages.push({
                    role: 'user',
                    content: userText
                });

                const modelMessageIndex = this.messages.length;
                this.messages.push({
                    role: 'model',
                    content: ''
                });

                this.saveToStorage();
                this.scrollToBottom();
                this.isTyping = true;

                const eventSource = new EventSource(`/api/chat-stream?message=${encodeURIComponent(userText)}`);

                eventSource.addEventListener('message', (event) => {
                    this.isTyping = false;
                    
                    try {
                        const data = JSON.parse(event.data);
                        if (data.content) {
                            this.messages[modelMessageIndex].content += data.content;
                            this.scrollToBottom();
                        }
                    } catch (e) {
                        console.error("Failed to parse stream chunk", e);
                    }
                });

                eventSource.addEventListener('done', () => {
                    eventSource.close();
                    this.saveToStorage();
                    this.scrollToBottom();
                });

                eventSource.onerror = (err) => {
                    console.error("EventSource encountered an error", err);
                    eventSource.close();
                    this.isTyping = false;
                    
                    if (this.messages[modelMessageIndex].content === '') {
                        this.messages[modelMessageIndex].content = "⚠️ Sorry, I had trouble connecting to the campus intelligence system. Please check your internet connection or verify your GEMINI_API_KEY inside the .env file.";
                    }
                    this.saveToStorage();
                    this.scrollToBottom();
                };
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