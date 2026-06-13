@php
    $navItems = [
        [
            'route' => 'admin.dashboard',
            'label' => 'Dashboard',
            'icon' => 'layout-dashboard',
            'active' => request()->routeIs('admin.dashboard')
        ],
        [
            'route' => 'admin.projects.index',
            'label' => 'Projects',
            'icon' => 'building-2',
            'active' => request()->routeIs('admin.projects.*')
        ],
        [
            'route' => 'admin.services.index',
            'label' => 'Services',
            'icon' => 'briefcase',
            'active' => request()->routeIs('admin.services.*')
        ],
        [
            'route' => 'admin.vacancies.index',
            'label' => 'Careers / Jobs',
            'icon' => 'hard-hat',
            'active' => request()->routeIs('admin.vacancies.*')
        ],
        [
            'route' => 'admin.testimonials.index',
            'label' => 'Testimonials',
            'icon' => 'message-square-quote',
            'active' => request()->routeIs('admin.testimonials.*')
        ],
        [
            'route' => 'admin.awards.index',
            'label' => 'Awards',
            'icon' => 'award',
            'active' => request()->routeIs('admin.awards.*')
        ],
        [
            'route' => 'admin.messages.index',
            'label' => 'Inbox Messages',
            'icon' => 'inbox',
            'active' => request()->routeIs('admin.messages.*'),
            'badge' => \App\Models\Message::where('is_read', false)->count()
        ],
        [
            'route' => 'admin.applicants.index',
            'label' => 'Applicants',
            'icon' => 'users-2',
            'active' => request()->routeIs('admin.applicants.*'),
            'badge' => \App\Models\Applicant::where('status', 'new')->count()
        ],
        [
            'route' => 'admin.settings.edit',
            'label' => 'Settings',
            'icon' => 'settings',
            'active' => request()->routeIs('admin.settings.*')
        ]
    ];
@endphp

@foreach ($navItems as $item)
    <a href="{{ route($item['route']) }}" 
       class="flex items-center justify-between px-4 py-3 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all duration-300 {{ $item['active'] ? 'bg-gradient-to-r from-sador-blue/40 to-sador-blue/20 border-l-4 border-sador-orange text-white' : 'text-slate-400 hover:bg-slate-800/50 hover:text-white' }}">
        <div class="flex items-center gap-3">
            <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4 {{ $item['active'] ? 'text-sador-orange' : 'opacity-60' }}"></i>
            <span>{{ $item['label'] }}</span>
        </div>
        @if (isset($item['badge']) && $item['badge'] > 0)
            <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-sador-orange text-white animate-pulse">
                {{ $item['badge'] }}
            </span>
        @endif
    </a>
@endforeach
