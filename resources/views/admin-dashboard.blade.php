<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc - Administration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between hidden md:flex">
            <div>
                <div class="h-20 flex items-center px-8 border-b border-slate-800">
                    <svg class="w-8 h-8 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-white text-xl font-bold tracking-wider">Admin</span>
                </div>

                <nav class="mt-6 px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 bg-emerald-600 text-white rounded-lg shadow-md">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Statistiques
                    </a>

                    <div class="pt-4 mt-4 border-t border-slate-800">
                        <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-colors text-slate-400">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Retour app
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen">

            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10 border-b border-gray-200">
                <div class="flex items-center gap-6">
                    <h1 class="text-xl font-black text-slate-800 italic uppercase tracking-tight">Supervision Globale</h1>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-emerald-500 font-semibold">EN LIGNE</p>
                    </div>
                    <div class="h-10 w-10 bg-slate-800 rounded-full flex items-center justify-center text-white font-bold shadow-inner uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">

                @if(session('success'))
                    <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 flex flex-col justify-between">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Utilisateurs</p>
                        <p class="text-4xl font-black text-slate-800 mb-4">{{ $totalUsers }}</p>
                        <div><span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded">Total</span></div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 flex flex-col justify-between">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Colocations</p>
                        <p class="text-4xl font-black text-slate-800 mb-4">0</p>
                        <div><span class="bg-gray-100 text-gray-600 text-xs font-bold px-2.5 py-1 rounded">Actives</span></div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 flex flex-col justify-between">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Dépenses</p>
                        <p class="text-4xl font-black text-slate-800 mb-4">0</p>
                        <div><span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-1 rounded">Total cumulé</span></div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 flex flex-col justify-between">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Bannis</p>
                        <p class="text-4xl font-black text-red-600 mb-4">{{ $bannedUsers }}</p>
                        <div><span class="bg-red-100 text-red-700 text-xs font-bold px-2.5 py-1 rounded">À surveiller</span></div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                    <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <h2 class="text-xl font-bold text-slate-800">Gestion des Utilisateurs</h2>
                            <a href="{{ route('admin.dashboard', ['sort' => 'reputation']) }}" class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold px-3 py-1.5 rounded transition-colors">
                                Trier par Réputation
                            </a>
                        </div>
                        <div class="flex items-center">
                            <input type="text" placeholder="Rechercher un email..." class="border border-gray-300 rounded-l-lg px-4 py-2 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            <button class="bg-slate-900 text-white px-4 py-2 rounded-r-lg hover:bg-slate-800 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wider bg-gray-50/50">
                                    <th class="p-5 font-semibold">ID</th>
                                    <th class="p-5 font-semibold">Utilisateur</th>
                                    <th class="p-5 font-semibold">Email</th>
                                    <th class="p-5 font-semibold">Réputation</th>
                                    <th class="p-5 font-semibold">Statut</th>
                                    <th class="p-5 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach($users as $user)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors {{ $user->is_banned ? 'bg-red-50/30' : '' }}">
                                    <td class="p-5 text-gray-400">#{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="p-5 font-bold text-slate-800">{{ $user->name }}</td>
                                    <td class="p-5 text-gray-500 italic">{{ $user->email }}</td>
                                    <td class="p-5 font-bold {{ $user->reputation < 0 ? 'text-red-600' : 'text-emerald-600' }}">{{ $user->reputation }} pts</td>
                                    <td class="p-5">
                                        @if($user->is_banned)
                                            <span class="text-red-500 font-bold flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-red-500"></span> Banni</span>
                                        @else
                                            <span class="text-emerald-500 font-bold flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Actif</span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-right">
                                        @if($user->is_global_admin)
                                            <span class="inline-block bg-gray-100 text-gray-400 font-bold text-xs px-3 py-1.5 rounded cursor-not-allowed">PROTÉGÉ</span>
                                        @elseif($user->is_banned)
                                            <form action="{{ route('admin.users.unban', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="border border-emerald-500 text-emerald-500 hover:bg-emerald-500 hover:text-white font-bold text-xs px-3 py-1.5 rounded transition-colors">
                                                    DÉBANNIR
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-white font-bold text-xs px-3 py-1.5 rounded transition-colors">
                                                    BANNIR
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>
