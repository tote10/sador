@extends('layouts.main')

@section('title', 'About Our Legacy')
@section('meta_description', 'Founded by Eng. Tinsae Fikadu, Sador General Construction delivers reliable civil construction across Ethiopia. Meet our leadership and organizational structure.')

@section('content')
    <!-- Page Header -->
    <div class="bg-slate-950 text-white py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-40 contrast-[1.1] brightness-[0.5] z-0" 
         style="background-image: url('{{ asset('images/hero-building1.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-950/20 to-slate-950/90 z-10"></div>
    
    <div class="container mx-auto px-4 max-w-7xl relative z-20 text-center" data-aos="zoom-out">
        <span class="text-sador-orange font-extrabold tracking-widest uppercase text-[10px] mb-4 block">Corporate Heritage</span>
        <h1 class="text-4xl sm:text-6xl font-display font-extrabold mb-6 tracking-tight text-white">
            Our History & Leadership
        </h1>
        <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto font-light leading-relaxed">
            Building Ethiopia's future with uncompromising engineering standards since 2011.
        </p>
    </div>
</div>
    <!-- History Narrative & Asymmetric Section -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6" data-aos="fade-right">
                    <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs block">Legacy of Trust</span>
                    <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 leading-tight">Decades of Building Masterpieces</h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                    The company was established on 2012 E.C As the Owner of company (Eng, Tinsae Fikadu) for the purpose of providing small, medium & large scale General civil construction works. The company was established by an Ethiopian National with the objectives of the company to engage efficiently, responsibly and profitably in a reasonable Profit margin in the construction industry.

                    </p>

                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div class="border-l-4 border-sador-orange pl-4">
                            <div class="text-2xl font-bold text-slate-900 font-display">15+</div>
                            <div class="text-xs text-slate-400 font-semibold uppercase tracking-wide">Projects Completed</div>
                        </div>
                        <div class="border-l-4 border-sador-blue pl-4">
                            <div class="text-2xl font-bold text-slate-900 font-display">G+11</div>
                            <div class="text-xs text-slate-400 font-semibold uppercase tracking-wide">High-Rise Capacity</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left">
                    <div class="absolute -inset-2 bg-gradient-to-tr from-sador-blue to-sador-orange rounded-3xl opacity-10 blur-xl"></div>
                    <div class="relative bg-slate-100 rounded-3xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img src="{{ asset('images/hero-building2.jpg') }}" alt="Construction Work" class="w-full h-full object-cover" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Step-by-Step Vertical Timeline -->
    <section class="py-24 bg-slate-50 relative overflow-hidden border-y border-slate-100">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Corporate Timeline</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Our Path of Growth</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>

            <!-- Vertical Timeline UI -->
            <div class="relative max-w-3xl mx-auto">
                <!-- Center Line -->
                <div class="absolute left-4 sm:left-1/2 transform -translate-x-1/2 w-0.5 h-full bg-slate-200"></div>

                @php
                    $timeline = [
                        ['year' => '2011', 'title' => 'Founding of Sador', 'desc' => 'Started with a select team of dedicated civil contractors, executing residential complexes in Addis Ababa.'],
                        ['year' => '2023', 'title' => 'First Flagship Delivery', 'desc' => 'Completed the five-storey Industrial Shade (G+4, 750 sq.m) in just three months for the Addis Ababa City Design & Construction Bureau.'],
                        ['year' => '2025', 'title' => 'Major Government Contracts', 'desc' => 'Delivered the Fitawrari Habtegiorgis administration complex and the Low-Cost 55-Homes apartment project ahead of schedule.'],
                        ['year' => '2026', 'title' => 'The Innovation & Tech Era', 'desc' => 'Pioneering structural pre-fabrication, green-building certifications, and tech-driven resource scheduling.']
                    ];
                @endphp

                @foreach($timeline as $i => $item)
                <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between mb-16 sm:even:flex-row-reverse" data-aos="fade-up">
                    <!-- Left empty pane for alignment -->
                    <div class="hidden sm:block w-[45%] text-right sm:group-even:text-left"></div>
                    
                    <!-- Bullet Point dot -->
                    <div class="absolute left-4 sm:left-1/2 transform -translate-x-1/2 w-5 h-5 rounded-full bg-sador-orange border-4 border-white shadow-md z-10"></div>
                    
                    <!-- Content Card -->
                    <div class="w-full sm:w-[45%] pl-12 sm:pl-0">
                        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100/60 hover:shadow-2xl transition-all duration-300 relative group">
                            <!-- Absolute Year Badge -->
                            <span class="absolute -top-4 left-6 bg-sador-blue text-white text-xs font-bold px-4 py-1.5 rounded-xl shadow-md">
                                {{ $item['year'] }}
                            </span>
                            <h3 class="text-xl font-bold text-slate-900 mt-2 mb-3">{{ $item['title'] }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Vision, Mission, Values -->
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-4 max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100/80 hover:shadow-2xl hover:border-sador-blue/20 transition-all duration-500 group" data-aos="fade-up">
                <div class="w-12 h-12 rounded-2xl bg-sador-blue/5 text-sador-blue flex items-center justify-center mb-6 group-hover:bg-sador-blue group-hover:text-white transition-colors duration-300">
                    <i data-lucide="eye" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Our Vision</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                To become the most reliable construction partner in the construction industry by 2030, recognized for delivering high-quality services with scheduled time frame, while maintaining a safe Environment record
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100/80 hover:shadow-2xl hover:border-sador-blue/20 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 rounded-2xl bg-sador-blue/5 text-sador-blue flex items-center justify-center mb-6 group-hover:bg-sador-blue group-hover:text-white transition-colors duration-300">
                    <i data-lucide="target" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Our Mission</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                Our mission is to deliver high-quality Services through proper resources management and skilled craftsmanship. We commit to completing projects on time and within budget, reducing resource waste and client satisfaction.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-slate-50 p-10 rounded-3xl border border-slate-100/80 hover:shadow-2xl hover:border-sador-blue/20 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-2xl bg-sador-blue/5 text-sador-blue flex items-center justify-center mb-6 group-hover:bg-sador-blue group-hover:text-white transition-colors duration-300">
                    <i data-lucide="gem" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-sador-blue transition-colors">Core Values</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                S-Safety First
                <br>
                A-Accountability
                <br>
                D-Diligence
                <br>
                O-Operational Excellence
                <br>
                R-Reliability
                </p>
            </div>
        </div>
    </section>

    <!-- Organizational Hierarchy Section -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-sador-orange font-extrabold tracking-widest uppercase text-xs mb-3 block">Our People</span>
                <h2 class="text-3xl sm:text-5xl font-display font-extrabold text-slate-900 mb-6">Organizational Structure</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-sador-orange to-amber-500 mx-auto rounded-full"></div>
            </div>

            <div class="org-scroll" data-aos="fade-up">
                <div class="org-fit">
                <ul class="org-tree">
                    <li>
                        <div class="org-node gm">
                            <span class="org-avatar">TF</span>
                            <span class="org-name">Tinsae Fikadu</span>
                            <span class="org-role">General Manager</span>
                        </div>
                        <ul>
                            <li>
                                <div class="org-node deputy">
                                    <span class="org-avatar">MS</span>
                                    <span class="org-name">Mintesinot Seifu</span>
                                    <span class="org-role">Deputy General Manager</span>
                                </div>
                                <ul>
                                    {{-- Finance --}}
                                    <li>
                                        <div class="org-node finance">
                                            <span class="org-avatar">Y</span>
                                            <span class="org-name">Yisfa</span>
                                            <span class="org-role">Finance</span>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="org-node staff">
                                                    <span class="org-avatar">SM</span>
                                                    <span class="org-name">Slle Enat Mekonen</span>
                                                    <span class="org-role muted">Accountant</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    {{-- Engineering --}}
                                    <li>
                                        <div class="org-node engineering">
                                            <span class="org-avatar">AA</span>
                                            <span class="org-name">Adoniyas Abera</span>
                                            <span class="org-role">Engineering Department</span>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="org-node staff">
                                                    <span class="org-avatar"><i data-lucide="user"></i></span>
                                                    <span class="org-name">Office Engineer</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="org-node staff">
                                                    <span class="org-avatar"><i data-lucide="user"></i></span>
                                                    <span class="org-name">Office Engineer</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="org-node lead">
                                                    <span class="org-avatar"><i data-lucide="user"></i></span>
                                                    <span class="org-name">Project Manager</span>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <div class="org-node staff">
                                                            <span class="org-avatar"><i data-lucide="user"></i></span>
                                                            <span class="org-name">Site Engineer</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="org-node staff">
                                                            <span class="org-avatar"><i data-lucide="user"></i></span>
                                                            <span class="org-name">Forman</span>
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <div class="org-node staff">
                                                                    <span class="org-avatar"><i data-lucide="user"></i></span>
                                                                    <span class="org-name">Gang Leader</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    {{-- Human Resource --}}
                                    <li>
                                        <div class="org-node hr">
                                            <span class="org-avatar">L</span>
                                            <span class="org-name">Lamesgen</span>
                                            <span class="org-role">Human Resource</span>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="org-node staff">
                                                    <span class="org-avatar">H</span>
                                                    <span class="org-name">Hana</span>
                                                    <span class="org-role muted">Office HR</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    {{-- Procurement --}}
                                    <li>
                                        <div class="org-node procurement">
                                            <span class="org-avatar">G</span>
                                            <span class="org-name">Gemechis</span>
                                            <span class="org-role">Procurement &amp; Store</span>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="org-node staff">
                                                    <span class="org-avatar"><i data-lucide="user"></i></span>
                                                    <span class="org-name">Store</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Self-contained styling for the organizational chart (horizontal tree, auto-scaled to fit any screen) --}}
    <style>
        .org-scroll { overflow-x: auto; padding: 0.5rem 0 1rem; text-align: center; }
        .org-fit { display: inline-block; transform-origin: top center; }
        .org-tree { display: flex; justify-content: center; min-width: max-content; margin: 0 auto; }
        .org-tree ul { display: flex; justify-content: center; padding-top: 22px; position: relative; }
        .org-tree li { list-style: none; position: relative; padding: 22px 5px 0; display: flex; flex-direction: column; align-items: center; }
        .org-tree li::before, .org-tree li::after { content: ''; position: absolute; top: 0; right: 50%; border-top: 2px solid #cbd5e1; width: 50%; height: 22px; }
        .org-tree li::after { right: auto; left: 50%; border-left: 2px solid #cbd5e1; }
        .org-tree > li { padding-top: 0; }
        .org-tree > li::before, .org-tree > li::after { display: none; }
        .org-tree li:only-child::before, .org-tree li:only-child::after { display: none; }
        .org-tree li:first-child::before, .org-tree li:last-child::after { border: 0 none; }
        .org-tree li:last-child::before { border-right: 2px solid #cbd5e1; border-radius: 0 6px 0 0; }
        .org-tree li:first-child::after { border-radius: 6px 0 0 0; }
        .org-tree ul ul::before { content: ''; position: absolute; top: 0; left: 50%; border-left: 2px solid #cbd5e1; width: 0; height: 22px; }

        .org-node { width: 7.5rem; border-radius: .85rem; padding: .7rem .5rem; display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid transparent; box-shadow: 0 8px 18px -10px rgba(15, 23, 42, 0.3); transition: transform .2s ease, box-shadow .2s ease; }
        .org-node:hover { transform: translateY(-3px); box-shadow: 0 16px 28px -12px rgba(15, 23, 42, 0.4); }
        .org-avatar { width: 2.25rem; height: 2.25rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: .72rem; margin-bottom: .5rem; }
        .org-avatar svg { width: 1.1rem; height: 1.1rem; }
        .org-name { font-weight: 700; font-size: .76rem; line-height: 1.15; }
        .org-role { font-size: .64rem; margin-top: .25rem; opacity: .85; }
        .org-role.muted { color: #64748b; opacity: 1; }

        .org-node.gm { background: #1e293b; color: #fff; }
        .org-node.gm .org-avatar { background: rgba(255,255,255,.15); color: #fff; }
        .org-node.deputy { background: #2563eb; color: #fff; }
        .org-node.deputy .org-avatar { background: rgba(255,255,255,.22); color: #fff; }
        .org-node.finance { background: #dbeafe; border-color: #bfdbfe; color: #1e293b; }
        .org-node.finance .org-avatar { background: #3b82f6; color: #fff; }
        .org-node.engineering { background: #d1fae5; border-color: #a7f3d0; color: #1e293b; }
        .org-node.engineering .org-avatar { background: #10b981; color: #fff; }
        .org-node.hr { background: #ffedd5; border-color: #fed7aa; color: #1e293b; }
        .org-node.hr .org-avatar { background: #fb923c; color: #fff; }
        .org-node.procurement { background: #fef3c7; border-color: #fde68a; color: #1e293b; }
        .org-node.procurement .org-avatar { background: #f59e0b; color: #fff; }
        .org-node.lead { background: #eff6ff; border-color: #bfdbfe; color: #1e293b; }
        .org-node.lead .org-avatar { background: #60a5fa; color: #fff; }
        .org-node.staff { background: #fff; border-color: #e2e8f0; color: #334155; }
        .org-node.staff .org-avatar { background: #e2e8f0; color: #64748b; }
    </style>

    {{-- Auto-scale the org chart so it always fits the viewport (no awkward overflow on mobile) --}}
    <script>
        (function () {
            function fitOrgChart() {
                document.querySelectorAll('.org-scroll').forEach(function (box) {
                    var fit = box.querySelector('.org-fit');
                    if (!fit) return;
                    fit.style.transform = 'none';
                    fit.style.height = '';
                    var naturalW = fit.offsetWidth;
                    var naturalH = fit.offsetHeight;
                    var available = box.clientWidth;
                    var scale = naturalW > available ? available / naturalW : 1;
                    fit.style.transform = 'scale(' + scale + ')';
                    fit.style.height = (naturalH * scale) + 'px';
                });
            }
            window.addEventListener('load', fitOrgChart);
            window.addEventListener('resize', fitOrgChart);
            document.addEventListener('DOMContentLoaded', function () { setTimeout(fitOrgChart, 350); });
        })();
    </script>
@endsection