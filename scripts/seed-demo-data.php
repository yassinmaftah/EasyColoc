<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\Category;
use App\Models\Expense;
use App\Models\ExpenseDetail;
use App\Models\Invitation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

echo "Seeding EasyColoc demo dataset...\n";

// 1. Create Users
$admin = User::firstOrCreate(
    ['email' => 'admin@easycoloc.test'],
    [
        'name' => 'Alex Admin',
        'password' => Hash::make('password123'),
        'reputation' => 5,
        'is_global_admin' => true,
        'is_banned' => false,
    ]
);

$sarah = User::firstOrCreate(
    ['email' => 'sarah@easycoloc.test'],
    [
        'name' => 'Sarah Connor',
        'password' => Hash::make('password123'),
        'reputation' => 3,
        'is_global_admin' => false,
        'is_banned' => false,
    ]
);

$john = User::firstOrCreate(
    ['email' => 'john@easycoloc.test'],
    [
        'name' => 'John Doe',
        'password' => Hash::make('password123'),
        'reputation' => 2,
        'is_global_admin' => false,
        'is_banned' => false,
    ]
);

$emma = User::firstOrCreate(
    ['email' => 'emma@easycoloc.test'],
    [
        'name' => 'Emma Watson',
        'password' => Hash::make('password123'),
        'reputation' => 1,
        'is_global_admin' => false,
        'is_banned' => false,
    ]
);

$dave = User::firstOrCreate(
    ['email' => 'badboy@easycoloc.test'],
    [
        'name' => 'Dave Delinquent',
        'password' => Hash::make('password123'),
        'reputation' => -3,
        'is_global_admin' => false,
        'is_banned' => true,
    ]
);

echo "Users seeded.\n";

// 2. Create Colocation
$colocation = Colocation::firstOrCreate(
    ['name' => 'Sunflower Haven'],
    [
        'status' => 'active',
        'created_by' => $sarah->id,
    ]
);

echo "Colocation seeded: {$colocation->name}\n";

// 3. Create Memberships
Membership::firstOrCreate(
    ['user_id' => $sarah->id, 'colocation_id' => $colocation->id],
    [
        'role' => 'owner',
        'joined_at' => Carbon::now()->subMonths(2),
    ]
);

Membership::firstOrCreate(
    ['user_id' => $john->id, 'colocation_id' => $colocation->id],
    [
        'role' => 'member',
        'joined_at' => Carbon::now()->subMonth(),
    ]
);

Membership::firstOrCreate(
    ['user_id' => $emma->id, 'colocation_id' => $colocation->id],
    [
        'role' => 'member',
        'joined_at' => Carbon::now()->subDays(15),
    ]
);

echo "Memberships seeded.\n";

// 4. Create Categories
$catInternet = Category::firstOrCreate(['name' => 'Internet & Streaming', 'colocation_id' => $colocation->id]);
$catGroceries = Category::firstOrCreate(['name' => 'Groceries & Food', 'colocation_id' => $colocation->id]);
$catUtilities = Category::firstOrCreate(['name' => 'Electricity & Water', 'colocation_id' => $colocation->id]);
$catSupplies = Category::firstOrCreate(['name' => 'Cleaning Supplies', 'colocation_id' => $colocation->id]);

echo "Categories seeded.\n";

// 5. Create Expenses & Details
if (Expense::where('colocation_id', $colocation->id)->count() === 0) {
    // Expense 1: Internet
    $exp1 = Expense::create([
        'colocation_id' => $colocation->id,
        'payer_id' => $sarah->id,
        'category_id' => $catInternet->id,
        'title' => 'High-Speed Fiber Internet',
        'amount' => 60.00,
        'expense_date' => Carbon::now()->subDays(12)->toDateString(),
    ]);
    ExpenseDetail::create(['expense_id' => $exp1->id, 'debtor_id' => $sarah->id, 'amount' => 20.00, 'status' => 'paid']);
    ExpenseDetail::create(['expense_id' => $exp1->id, 'debtor_id' => $john->id, 'amount' => 20.00, 'status' => 'paid']);
    ExpenseDetail::create(['expense_id' => $exp1->id, 'debtor_id' => $emma->id, 'amount' => 20.00, 'status' => 'unpaid']);

    // Expense 2: Groceries
    $exp2 = Expense::create([
        'colocation_id' => $colocation->id,
        'payer_id' => $john->id,
        'category_id' => $catGroceries->id,
        'title' => 'Weekly Market Groceries',
        'amount' => 120.00,
        'expense_date' => Carbon::now()->subDays(8)->toDateString(),
    ]);
    ExpenseDetail::create(['expense_id' => $exp2->id, 'debtor_id' => $john->id, 'amount' => 40.00, 'status' => 'paid']);
    ExpenseDetail::create(['expense_id' => $exp2->id, 'debtor_id' => $sarah->id, 'amount' => 40.00, 'status' => 'unpaid']);
    ExpenseDetail::create(['expense_id' => $exp2->id, 'debtor_id' => $emma->id, 'amount' => 40.00, 'status' => 'paid']);

    // Expense 3: Electricity
    $exp3 = Expense::create([
        'colocation_id' => $colocation->id,
        'payer_id' => $sarah->id,
        'category_id' => $catUtilities->id,
        'title' => 'Winter Heating & Power',
        'amount' => 150.00,
        'expense_date' => Carbon::now()->subDays(4)->toDateString(),
    ]);
    ExpenseDetail::create(['expense_id' => $exp3->id, 'debtor_id' => $sarah->id, 'amount' => 50.00, 'status' => 'paid']);
    ExpenseDetail::create(['expense_id' => $exp3->id, 'debtor_id' => $john->id, 'amount' => 50.00, 'status' => 'unpaid']);
    ExpenseDetail::create(['expense_id' => $exp3->id, 'debtor_id' => $emma->id, 'amount' => 50.00, 'status' => 'unpaid']);

    // Expense 4: Cleaning
    $exp4 = Expense::create([
        'colocation_id' => $colocation->id,
        'payer_id' => $emma->id,
        'category_id' => $catSupplies->id,
        'title' => 'Eco Laundry & Cleaning Supplies',
        'amount' => 30.00,
        'expense_date' => Carbon::now()->subDays(2)->toDateString(),
    ]);
    ExpenseDetail::create(['expense_id' => $exp4->id, 'debtor_id' => $emma->id, 'amount' => 10.00, 'status' => 'paid']);
    ExpenseDetail::create(['expense_id' => $exp4->id, 'debtor_id' => $sarah->id, 'amount' => 10.00, 'status' => 'paid']);
    ExpenseDetail::create(['expense_id' => $exp4->id, 'debtor_id' => $john->id, 'amount' => 10.00, 'status' => 'paid']);

    echo "Expenses & details seeded.\n";
}

// 6. Create Invitation
Invitation::firstOrCreate(
    ['email' => 'lucas@easycoloc.test'],
    [
        'colocation_id' => $colocation->id,
        'token' => 'sample_demo_invitation_token_123',
        'status' => 'pending',
    ]
);

echo "Invitations seeded.\n";
echo "Demo database seeding completed successfully!\n";
