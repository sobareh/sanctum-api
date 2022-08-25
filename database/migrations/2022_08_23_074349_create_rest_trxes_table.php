<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestTrxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_trx', function (Blueprint $table) {
            $table->id();
            $table->string('npwp', 20);
            $table->string('nama_wp');
            $table->string('no_spt_lb')->nullable();
            $table->date('tgl_spt_lb')->nullable();
            $table->string('no_tindaklanjut_awal');
            $table->date('tgl_tindaklanjut_awal');
            $table->boolean('is_completed')->default(false);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('rest_trx');
    }
}
