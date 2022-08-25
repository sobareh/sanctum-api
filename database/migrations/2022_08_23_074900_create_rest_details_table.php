<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rest_trx_id')
                ->constrained('rest_trx')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('rest_archives_id')
                ->constrained('rest_archives')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('rest_stages_id')
                ->constrained('rest_stages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->boolean('overmacht')->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rest_details');
    }
}
