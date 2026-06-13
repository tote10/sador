<div class="fixed bottom-6 right-6 z-50 flex flex-col space-y-4 font-sans"
     x-data="{ showTop: false }"
     x-init="window.addEventListener('scroll', () => { showTop = window.scrollY > 400 })">
    
    <!-- Scroll To Top Button -->
    <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            x-show="showTop"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-10 scale-50"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-10 scale-50"
            class="w-12 h-12 bg-slate-900/90 hover:bg-sador-orange text-white rounded-xl flex items-center justify-center shadow-lg backdrop-blur-sm border border-white/10 hover:-translate-y-1 transition-all duration-300 group"
            style="display: none;"
            title="Scroll to Top">
        <i data-lucide="arrow-up" class="w-5 h-5 group-hover:animate-bounce"></i>
    </button>

    <!-- Phone Button -->
    <a href="tel:+251911708175" 
       class="w-12 h-12 bg-sador-blue text-white rounded-xl flex items-center justify-center shadow-lg hover:bg-slate-900 hover:-translate-y-1 transition-all duration-300 group"
       title="Call Us Now">
        <i data-lucide="phone-call" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
    </a>
</div>