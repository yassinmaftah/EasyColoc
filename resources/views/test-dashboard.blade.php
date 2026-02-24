<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc - Dashboard</title>
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
                    <a href="#" class="flex items-center px-4 py-3 bg-emerald-600/10 text-emerald-500 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('colocations.index') }}" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
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

            <div class="p-6">
                <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                    <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Votre Réputation</p>
                    <p class="text-2xl font-bold text-emerald-400">+0 pts</p>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen">

            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10">
                <div class="flex items-center gap-6">
                    <h1 class="text-2xl font-black text-slate-800 italic uppercase tracking-tight">Tableau de bord</h1>
                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-sm transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Nouvelle colocation
                    </button>
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

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between h-40">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Mon score réputation</p>
                            <p class="text-4xl font-black text-slate-800 mt-1">0</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between h-40">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Dépenses Globales (Feb)</p>
                            <p class="text-4xl font-black text-slate-800 mt-1">0,00 €</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2">
                        <div class="flex items-center justify-between mb-4 px-1">
                            <h2 class="text-xl font-bold text-slate-800">Dépenses récentes</h2>
                            <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">Voir tout</a>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden min-h-[300px] flex flex-col">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wider">
                                        <th class="p-5 font-semibold">Titre / Catégorie</th>
                                        <th class="p-5 font-semibold">Payeur</th>
                                        <th class="p-5 font-semibold">Montant</th>
                                        <th class="p-5 font-semibold">Coloc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="p-10 text-center text-gray-400">
                                            Aucune dépense récente.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="lg:col-span-1 mt-10 lg:mt-0">
                        <div class="bg-slate-800 rounded-2xl shadow-lg border border-slate-700 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-white">Membres de la coloc</h3>
                                <span class="bg-slate-700 text-slate-300 text-xs font-bold px-2.5 py-1 rounded">VIDE</span>
                            </div>
                            <div class="text-slate-400 text-sm">
                                Aucune colocation active.
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

</body>
</html>
