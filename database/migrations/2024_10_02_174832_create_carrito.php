<?php

use App\Models\SchemaAudit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id(); 
            $table->integer('num_venta')->unsigned();
            $table->integer('cantidad');
            $table->foreignId('id_almacen')->constrained('almacen');
            $table->timestamps();
        });
        


        $schemaAudit = new SchemaAudit([
            'auditable_type' => 'carrito',
            'auditable_id' => 1,
            'new_values' => [
                'id_carrito' => 'id',
                'num_venta' => 'integer',
                'cantidad' => 'integer',
                'id_almacen' => 'foreignId',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
            ],
            'event' => 'created',
        ]);
        $schemaAudit->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $schemaAudit = new SchemaAudit([
            'auditable_type' => 'carrito',
            'auditable_id' => 1,
            'new_values' => [
                'id_carrito' => 'id',
                'num_venta' => 'integer',
                'cantidad' => 'integer',
                'id_almacen' => 'foreignId',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
            ],
            'event' => 'deleted',
        ]);
        $schemaAudit->save();
        Schema::dropIfExists('carrito');
    }
};
