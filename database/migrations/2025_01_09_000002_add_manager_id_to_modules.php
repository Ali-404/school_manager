<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove unique constraint on code first
        Schema::table('modules', function (Blueprint $table) {
            $table->dropUnique(['code']);
        });
        
        // Add manager_id column (nullable initially to handle existing data)
        Schema::table('modules', function (Blueprint $table) {
            $table->foreignId('manager_id')->nullable()->after('id');
        });
        
        // Assign existing modules to the first manager (if any exist)
        $firstManager = \App\Models\User::where('role', 'manager')->first();
        if ($firstManager) {
            \DB::table('modules')->whereNull('manager_id')->update(['manager_id' => $firstManager->id]);
        }
        
        // Add foreign key constraint (nullable is fine for SaaS - we'll enforce in application)
        Schema::table('modules', function (Blueprint $table) {
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        // Add composite unique constraint: code must be unique per manager
        Schema::table('modules', function (Blueprint $table) {
            $table->unique(['manager_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropUnique(['manager_id', 'code']);
            $table->dropForeign(['manager_id']);
            $table->dropColumn('manager_id');
            // Restore unique constraint on code
            $table->unique('code');
        });
    }
};

