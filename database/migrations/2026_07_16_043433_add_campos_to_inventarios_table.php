<?php
// Colocar en: database/migrations/2026_07_15_XXXXXX_add_campos_to_inventarios_table.php
// Genera el archivo con: php artisan make:migration add_campos_to_inventarios_table --table=inventarios
// y luego pega este contenido dentro (o reemplaza el que se genere).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('marca')->nullable();
            $table->integer('cantidad')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'marca', 'cantidad']);
        });
    }
};
