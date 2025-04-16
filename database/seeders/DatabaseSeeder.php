<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\LineItem;
use App\Models\Pharmacy;
use App\Models\Prescription;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Quotation;
use App\Models\Transaction;
use App\Models\User;
use Faker\Factory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        // User::factory(1)->new()->testUser()->create();
        Profile::factory(1)->create();
        Product::factory(1)->create();
        Pharmacy::factory(1)->create();
        Inventory::factory(1)->create();
        Prescription::factory(1)->create();
        Quotation::factory(1)->create();
        Transaction::factory(1)->create();
        LineItem::factory(1)->create();
        // AuditLog_::factory(3)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
