<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('parcelles', 'longetitude') && ! Schema::hasColumn('parcelles', 'longitude')) {
            Schema::table('parcelles', fn ($table) => $table->renameColumn('longetitude', 'longitude'));
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('parcelles', 'longitude') && ! Schema::hasColumn('parcelles', 'longetitude')) {
            Schema::table('parcelles', fn ($table) => $table->renameColumn('longitude', 'longetitude'));
        }
    }
};
