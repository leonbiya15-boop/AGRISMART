
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE stocks CHANGE date_mise_a_jour date_mise_a_jour DATETIME NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE stocks CHANGE date_mise_a_jour date_mise_a_jour DATE NOT NULL');
    }
};