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
                    @if(Auth::user()->is_global_admin)
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Admin
                        </a>
                    @endif
                    <a href="{{route('profile.edit')}}" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profile
                    </a>
                </nav>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-slate-800">
                <div class="mt-auto p-4 bg-[#1e293b] rounded-lg mx-4 mb-4 border border-slate-700">
                    <div class="text-xs text-slate-400 font-bold mb-1 uppercase tracking-wider">Votre Réputation</div>

                    @php
                        $reputation = Auth::user()->reputation;
                        $colorClass = $reputation < 0 ? 'text-red-500' : 'text-emerald-500';
                        $sign = $reputation > 0 ? '+' : '';
                    @endphp

                    <div class="font-bold text-2xl {{ $colorClass }}">
                        {{ $sign }}{{ $reputation }} pts
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
                    <h1 class="text-2xl font-black text-slate-800 italic uppercase tracking-tight">Tableau de bord</h1>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-emerald-500 font-semibold">EN LIGNE</p>
                    </div>
                    <div class="h-10 w-10 bg-slate-800 rounded-full flex items-center justify-center text-white font-bold shadow-inner">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">

    @if (session('success'))
        <div class="mb-4 bg-emerald-500/10 border border-emerald-500 text-emerald-500 px-4 py-3 rounded-lg flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-lg flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="block sm:inline font-medium">{{ session('error') }}</span>
        </div>
    @endif

    @if($activeColocation)

        <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-4">
            <h2 class="text-2xl font-black text-slate-800 italic uppercase">{{ $activeColocation->name }}</h2>

            <form action="{{ route('colocation.leave') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir quitter cette colocation ?');">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Quitter la colocation
                </button>
            </form>
        </div>

        <div class="flex flex-col xl:flex-row gap-8">
            <div class="flex-1">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-slate-800">Dépenses récentes</h3>
                    <button onclick="document.getElementById('expenseModal').classList.remove('hidden')" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-lg shadow-sm transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Ajouter
                    </button>
                </div>
                @if($activeColocation->expenses->count() > 0)
                    <div class="space-y-3 mt-4">
                        @foreach($activeColocation->expenses as $expense)
                            <div class="flex justify-between items-center p-4 border border-gray-100 rounded-lg bg-gray-50 shadow-sm">
                                <div>
                                    <p class="font-bold text-slate-800">{{ $expense->title }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Payé par <span class="font-semibold text-slate-700">{{ $expense->payer->name }}</span>
                                        le {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                                        @if($expense->category)
                                            <span class="ml-1 px-2 py-0.5 bg-gray-200 rounded-full text-[10px]">{{ $expense->category->name }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="font-black text-slate-800 text-lg">
                                    {{ number_format($expense->amount, 2) }} <span class="text-sm">DH</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-4">
                        <p class="text-center text-gray-400 py-8">Aucune dépense pour le moment.</p>
                    </div>
                @endif

                @if($activeMembership && $activeMembership->role === 'owner')
                    <h3 class="font-bold text-slate-800 mb-4 mt-8 text-lg">Toutes les dettes (Owner)</h3>
                    @if($allPendingDetails->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm border border-orange-100 p-4">
                            <ul class="space-y-3">
                                @foreach($allPendingDetails as $detail)
                                    <li class="flex justify-between items-center p-3 border border-orange-50 bg-orange-50/50 rounded-lg">
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $detail->debtor->name }}</p>
                                            <p class="text-xs text-orange-600 mt-0.5">
                                                Doit à <span class="font-bold">{{ $detail->expense->payer->name }}</span>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-black text-orange-600 mb-1">
                                                {{ number_format($detail->amount, 2) }} <span class="text-xs">DH</span>
                                            </div>
                                            <form action="{{ route('expenses.pay', $detail->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-1 rounded hover:bg-emerald-200 font-bold transition-colors">
                                                    Mark as paid
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Aucune dette en attente dans la colocation.</p>
                    @endif
                @endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Ce que je dois
        </h3>

        <div class="space-y-4">
            @forelse($myPendingDetails as $detail)
                <div class="bg-orange-50 border border-orange-100 p-4 rounded-xl flex justify-between items-center">
                    <div>
                        <div class="text-xs font-bold text-orange-700 uppercase tracking-wider mb-1">
                            {{ $detail->expense->title }} ({{ \Carbon\Carbon::parse($detail->expense->expense_date)->format('d/m') }})
                        </div>
                        <div class="font-bold text-slate-800">Moi</div>
                        <div class="text-sm text-orange-600 font-medium italic">Doit à {{ $detail->expense->payer->name }}</div>
                    </div>
                    <div class="text-right flex flex-col items-end gap-2">
                        <div class="font-bold text-orange-600 text-lg">{{ number_format($detail->amount, 2) }} DH</div>

                        <form action="{{ route('expenses.pay', $detail->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-orange-200 text-orange-800 px-3 py-1 rounded text-[10px] font-black hover:bg-orange-300 transition uppercase shadow-sm">
                                Mark as paid
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center p-4 bg-slate-50 rounded-xl border border-slate-100 text-slate-500 text-sm italic">
                    Vous n'avez aucune dette en cours. Bravo !
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Ce qu'on me doit
        </h3>

        <div class="space-y-4">
            @forelse($owedToMeDetails as $detail)
                <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex justify-between items-center">
                    <div>
                        <div class="text-xs font-bold text-emerald-700 uppercase tracking-wider mb-1">
                            {{ $detail->expense->title }} ({{ \Carbon\Carbon::parse($detail->expense->expense_date)->format('d/m') }})
                        </div>
                        <div class="font-bold text-slate-800 capitalize">{{ $detail->debtor->name }}</div>
                        <div class="text-sm text-emerald-600 font-medium italic">Me doit</div>
                    </div>
                    <div class="text-right flex flex-col items-end gap-2">
                        <div class="font-bold text-emerald-600 text-lg">{{ number_format($detail->amount, 2) }} DH</div>

                        <form action="{{ route('expenses.pay', $detail->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-emerald-200 text-emerald-800 px-3 py-1 rounded text-[10px] font-black hover:bg-emerald-300 transition uppercase shadow-sm">
                                Mark as paid
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center p-4 bg-slate-50 rounded-xl border border-slate-100 text-slate-500 text-sm italic">
                    Personne ne vous doit d'argent pour le moment.
                </div>
            @endforelse
        </div>
    </div>

</div>

            </div> <div class="w-full xl:w-80 space-y-6">

                <div class="bg-slate-900 rounded-xl shadow-sm p-6 text-white">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold">Membres de la coloc</h3>
                        <span class="bg-slate-800 text-xs px-2 py-1 rounded text-slate-300">ACTIFS</span>
                    </div>

                    <div class="space-y-3 mb-6">
                        @foreach($activeColocation->memberships as $member)
                            <div class="flex justify-between items-center p-3 bg-slate-800/50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded bg-slate-700 flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($member->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm">{{ $member->user->name }}</p>

                                        <div class="flex items-center gap-2">
                                            @if($member->role === 'owner')
                                                <p class="text-xs text-amber-500 font-bold"> OWNER</p>
                                            @endif

                                            @if($member->user->is_banned)
                                                <p class="text-[10px] text-red-400 font-bold bg-red-500/10 px-1.5 py-0.5 rounded uppercase tracking-wider"> BANNED</p>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($activeMembership && $activeMembership->role === 'owner')
                        <div class="mt-4">
                            <button onclick="document.getElementById('invite-form').classList.toggle('hidden')"
                                    class="w-full bg-[#1e293b] text-white py-3 rounded-lg flex justify-center items-center hover:bg-slate-700 transition font-bold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                Inviter un membre
                            </button>

                            <form id="invite-form" action="{{ route('invitations.store') }}" method="POST" class="hidden mt-3 bg-[#1e293b] p-4 rounded-lg border border-slate-700">
                                @csrf
                                <label class="block text-sm font-medium text-slate-300 mb-2">Adresse email du futur colocataire</label>
                                <div class="flex gap-2">
                                    <input type="email" name="email" required
                                        class="w-full bg-slate-800 border-slate-600 text-white rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                                        placeholder="exemple@email.com">
                                    <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 font-bold transition">
                                        Envoyer
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

                @if($activeMembership && $activeMembership->role === 'owner')
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-6">
                    <h3 class="font-bold text-slate-800 mb-4">Gérer les catégories</h3>

                    @if($activeColocation->categories->count() > 0)
                        <ul class="space-y-2 mb-6">
                            @foreach($activeColocation->categories as $category)
                                <li class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    <span class="text-sm font-bold text-slate-700">{{ $category->name }}</span>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold transition-colors">
                                            Supprimer
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-xs text-gray-400 mb-4 text-center italic">Aucune catégorie pour le moment.</p>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="colocation_id" value="{{ $activeColocation->id }}">
                        <input type="text" name="name" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                            Add
                        </button>
                    </form>
                </div>
                @endif

            </div> </div>

    @else

        <div class="flex flex-col items-center justify-center h-full max-w-lg mx-auto text-center mt-20">
            <h2 class="text-2xl font-black text-slate-800 mb-4">Bienvenue sur votre Dashboard</h2>
            <p class="text-slate-500 mb-8">Vous devez créer ou rejoindre une colocation pour voir vos dépenses et vos colocataires ici.</p>

            <a href="{{ route('colocations.create') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-md transition-all">
                Créer une colocation
            </a>
        </div>

    @endif

@if($activeColocation)
    <div id="expenseModal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-black text-slate-800">Ajouter une dépense</h3>
                <button onclick="document.getElementById('expenseModal').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('expenses.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="colocation_id" value="{{ $activeColocation->id }}">

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Titre de la dépense</label>
                    <input type="text" name="title" required placeholder="Ex: Courses Carrefour" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-1">Montant (DH)</label>
                        <input type="number" step="0.01" name="amount" required placeholder="0.00" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-1">Date</label>
                        <input type="date" name="expense_date" required value="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Catégorie</label>
                    <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="">-- Sans catégorie --</option>
                        @foreach($activeColocation->categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Payé par</label>
                    @if($activeMembership && $activeMembership->role === 'owner')
                        <select name="payer_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-slate-900 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            @foreach($activeColocation->memberships as $member)
                                <option value="{{ $member->user->id }}" {{ Auth::id() == $member->user->id ? 'selected' : '' }}>
                                    {{ $member->user->name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <input type="hidden" name="payer_id" value="{{ Auth::id() }}">
                        <input type="text" disabled value="{{ Auth::user()->name }}" class="w-full border border-gray-200 bg-gray-50 rounded-lg px-3 py-2 text-slate-500 cursor-not-allowed">
                    @endif
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('expenseModal').classList.add('hidden')" class="flex-1 px-4 py-2 border border-gray-300 text-slate-700 rounded-lg font-bold hover:bg-gray-50 transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-slate-900 text-white rounded-lg font-bold hover:bg-slate-800 transition-colors">
                        Ajouter la dépense
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
</main>

        </div>
    </div>

</body>
</html>
