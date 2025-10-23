<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plant_updates', function (Blueprint $table) {
            if (! Schema::hasColumn('plant_updates', 'title')) {
                $table->string('title')->nullable()->after('user_id');
            }
            if (! Schema::hasColumn('plant_updates', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (! Schema::hasColumn('plant_updates', 'height')) {
                $table->string('height')->nullable()->after('description');
            }
            if (! Schema::hasColumn('plant_updates', 'pests')) {
                $table->string('pests')->nullable()->after('height');
            }
            if (! Schema::hasColumn('plant_updates', 'diseases')) {
                $table->string('diseases')->nullable()->after('pests');
            }
        });
    }

    public function down(): void
    {
        Schema::table('plant_updates', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'height', 'pests', 'diseases']);
        });
    }
};
