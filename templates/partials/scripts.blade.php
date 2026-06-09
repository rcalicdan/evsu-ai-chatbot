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

            sendMessage() {
                if (this.userInput.trim() === '') return;

                const userText = this.userInput;
                this.userInput = '';

                this.messages.push({
                    role: 'user',
                    content: userText
                });

                this.saveToStorage();
                this.scrollToBottom();

                this.isTyping = true;
                
                setTimeout(() => {
                    this.getMockResponse(userText);
                }, 1200);
            },

            getMockResponse(query) {
                let responseText = "I'm your EVSU Assistant. Once my backend is connected, I will search our complete university database and use AI to answer this question.";

                const cleanQuery = query.toLowerCase();

                if (cleanQuery.includes('requirement') || cleanQuery.includes('freshman')) {
                    responseText = "To enroll as an incoming freshman at Eastern Visayas State University (EVSU), you must submit the following core requirements:\n\n1. Original Form 138 (Senior High School Report Card)\n2. Certification of Good Moral Character\n3. Photocopy of PSA Birth Certificate\n4. Certificate of General Average (signed by principal)\n5. Two (2) identical 2x2 pictures with white background";
                } else if (cleanQuery.includes('process') || cleanQuery.includes('steps')) {
                    responseText = "The general EVSU enrollment flow follows these steps:\n\nStep 1: Apply online through the EVSU Admission Portal.\nStep 2: Take the admission/placement exam.\nStep 3: Wait for qualifying lists from respective colleges.\nStep 4: Present requirements to the College Dean's office for evaluation.\nStep 5: Encode subjects in the registrar system and receive your Certificate of Registration (COR).";
                } else if (cleanQuery.includes('location') || cleanQuery.includes('main')) {
                    responseText = "The Eastern Visayas State University (EVSU) Main Campus is located on Salazar Street, Tacloban City, Leyte, Philippines.";
                } else if (cleanQuery.includes('branch') || cleanQuery.includes('campuses')) {
                    responseText = "Aside from the Main Campus in Tacloban City, EVSU operates several external campuses across region VIII to make tertiary education accessible:\n\n1. EVSU Ormoc Campus (Ormoc City)\n2. EVSU Carigara Campus (Carigara, Leyte)\n3. EVSU Tanauan Campus (Tanauan, Leyte)\n4. EVSU Dulag Campus (Dulag, Leyte)\n5. EVSU Burauen Campus (Burauen, Leyte)";
                } else if (cleanQuery.includes('free') || cleanQuery.includes('tuition') || cleanQuery.includes('eligibility')) {
                    responseText = "Yes, undergraduate tuition and general fees at Eastern Visayas State University (EVSU) are free for qualified Filipino students under the Universal Access to Quality Tertiary Education Act (Republic Act 10931). You simply need to pass the admission process and maintain compliance with academic retention rules.";
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