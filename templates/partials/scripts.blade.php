<script type="module">
    import { fetchEventSource } from 'https://esm.sh/@microsoft/fetch-event-source@2.0.1';
    window.fetchEventSource = fetchEventSource;
</script>

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
                    marked.setOptions({ breaks: true, gfm: true });
                    return marked.parse(content);
                }
                return content;
            },

            sendQuickPrompt(text) {
                this.userInput = text;
                this.sendMessage();
            },

            async sendMessage() {
                if (this.userInput.trim() === '') return;

                const userText = this.userInput;
                this.userInput = '';
                const historyToSubmit = this.messages.slice(-20);
                this.messages.push({ role: 'user', content: userText });
                const modelMessageIndex = this.messages.length;
                this.messages.push({ role: 'model', content: '' });
                this.saveToStorage();
                this.scrollToBottom();
                this.isTyping = true;
                const self = this;

                try {
                    await window.fetchEventSource('/api/chat-stream', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'text/event-stream'
                        },
                        body: JSON.stringify({
                            message: userText,
                            history: historyToSubmit
                        }),
                        
                        onmessage(event) {
                            self.isTyping = false;
                            
                            if (event.data) {
                                try {
                                    const parsedData = JSON.parse(event.data);
                                    if (parsedData.content) {
                                        self.messages[modelMessageIndex].content += parsedData.content;
                                        self.scrollToBottom();
                                    }
                                } catch (e) {
                                    console.error("Failed to parse JSON stream chunk", e);
                                }
                            }
                        },

                        onclose() {
                            self.saveToStorage();
                            self.scrollToBottom();
                        },

                        onerror(err) {
                            console.error("EventSource connection error:", err);
                            self.isTyping = false;
                            if (self.messages[modelMessageIndex].content === '') {
                                self.messages[modelMessageIndex].content = "⚠️ Sorry, I had trouble connecting. Please check your internet connection.";
                            }
                            self.saveToStorage();
                            self.scrollToBottom();
                            
                            throw err; 
                        }
                    });

                } catch (error) {
                    // Handled inside onerror block
                }
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
                    const container = document.getElementById('message-container');
                    if (container) {
                        container.scrollTop = container.scrollHeight;
                    }
                });
            }
        }
    }
</script>