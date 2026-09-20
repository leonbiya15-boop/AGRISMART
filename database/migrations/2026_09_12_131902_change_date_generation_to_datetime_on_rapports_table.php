<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE rapports CHANGE date_generation date_generation DATETIME NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE rapports CHANGE date_generation date_generation DATE NOT NULL');
    }
};