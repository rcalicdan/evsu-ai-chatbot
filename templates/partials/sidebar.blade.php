<aside class="fixed inset-y-0 left-0 z-40 flex flex-col w-80 bg-slate-950 text-white border-r border-slate-900 transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    
    <!-- Sidebar Brand Header -->
    <div class="flex items-center justify-between h-20 px-6 border-b border-slate-900">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-evsu-maroon flex items-center justify-center border border-evsu-gold/30 shadow-md">
                <span class="text-sm font-black text-evsu-gold tracking-wider">EVSU</span>
            </div>
            <div>
                <span class="font-bold tracking-wide text-sm block">EVSU Companion</span>
                <span class="text-[10px] text-evsu-gold font-semibold uppercase tracking-wider">Virtual Assistant</span>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="lg:hidden p-2 text-slate-400 hover:text-white rounded-lg hover:bg-slate-900 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <!-- Clear/Reset Tool -->
    <div class="p-5">
        <button @click="resetChat()" class="flex items-center justify-center w-full px-4 py-3 space-x-2 text-xs font-bold uppercase tracking-wider text-slate-950 bg-gradient-to-r from-evsu-gold to-amber-400 hover:brightness-110 active:scale-[0.98] transition-all rounded-xl shadow-lg shadow-evsu-gold/10">
            <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.656 48.656 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3"/></svg>
            <span>Reset Conversation</span>
        </button>
    </div>

    <!-- Quick Info Panels -->
    <div class="flex-1 px-5 py-2 overflow-y-auto space-y-4">
        
        <!-- Quick Portal Links -->
        <div class="space-y-2">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block px-1">University Quick Links</span>
            <a href="https://portal.evsu.edu.ph" target="_blank" class="flex items-center justify-between p-3 bg-slate-900/60 hover:bg-slate-900 rounded-xl border border-slate-800/80 transition-colors group">
                <span class="text-xs text-slate-300 font-medium group-hover:text-evsu-gold">Student Portal</span>
                <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-evsu-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
            </a>
            <a href="https://evsu.edu.ph" target="_blank" class="flex items-center justify-between p-3 bg-slate-900/60 hover:bg-slate-900 rounded-xl border border-slate-800/80 transition-colors group">
                <span class="text-xs text-slate-300 font-medium group-hover:text-evsu-gold">Main Website</span>
                <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-evsu-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
            </a>
        </div>

        <!-- Guidance Note -->
        <div class="p-4 bg-slate-900/50 rounded-xl border border-slate-900 text-xs text-slate-400 leading-relaxed space-y-2">
            <span class="font-bold text-slate-200 block">💡 General Campus Guide</span>
            <p>I am designed to answer multi-disciplinary questions about Eastern Visayas State University, including academic courses, colleges, school schedules, location, portals, facilities, and requirements.</p>
        </div>
    </div>

    <!-- Sidebar Footer -->
    <div class="p-5 border-t border-slate-900 text-center text-[10px] text-slate-600 tracking-wider">
        <span>EVSU VIRTUAL COMPANION &copy; 2026</span>
    </div>
</aside>