<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc - Nouvelle Colocation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between hidden md:flex">
            <div>
                <div class="h-20 flex items-center px-8 border-b border-slate-800">
                    <svg class="w-8 h-8 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-white text-xl font-bold tracking-wider">EasyColoc</span>
                </div>

                <nav class="mt-6 px-4 space-y-2">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('colocations.index') }}" class="flex items-center px-4 py-3 bg-emerald-600/10 text-emerald-500 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Colocations
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Admin
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profile
                    </a>
                </nav>
            </div>


            <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-slate-800">
                <div class="p-6">
                    <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Votre Réputation</p>
                        <p class="text-2xl font-bold text-emerald-400">+0 pts</p>
                    </div>
                </div>

                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-slate-400 hover:bg-red-500/10 hover:text-red-500 rounded-lg transition-colors text-left">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </aside>

        <div class="flex-1 flex flex-col h-screen">

            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10">
                <div class="flex items-center gap-6">
                    <h1 class="text-2xl font-black text-slate-800 italic uppercase tracking-tight">Nouvelle Colocation</h1>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-bold text-slate-800">ADMIN</p>
                        <p class="text-xs text-emerald-500 font-semibold">EN LIGNE</p>
                    </div>
                    <div class="h-10 w-10 bg-slate-800 rounded-full flex items-center justify-center text-white font-bold shadow-inner">
                        A
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8 flex items-start justify-center pt-20">

                <div class="w-full max-w-2xl bg-white rounded-3xl border border-gray-100 shadow-sm p-10">

                    <form action="#" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nom de la colocation</label>
                            <input type="text" id="name" name="name"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors"
                                placeholder="ex: Résidence Les Lilas" required>
                        </div>

                        <div class="mb-8">
                            <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Description (optionnel)</label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors resize-none"
                                placeholder="Décrivez brièvement votre colocation..."></textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg font-semibold shadow-sm transition-colors">
                                Créer la colocation
                            </button>
                            <a href="{{ route('colocations.index') }}" class="text-slate-500 hover:text-slate-800 font-medium px-4 py-3 transition-colors">
                                Annuler
                            </a>
                        </div>
                    </form>

                </div>

            </main>
        </div>
    </div>

</body>
</html>
