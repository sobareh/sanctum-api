<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('doc_type');
            $table->string('doc_no',20);
            $table->string('nama',50);
            $table->text('keterangan');
            $table->integer('page_count');
            $table->string('box_id',50);
            $table->string('loc_id',50);
            $table->string('nip_rekam',20);
            $table->date('tanggal_rekam');
            $table->string('doc_file');
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
        Schema::dropIfExists('dokumens');
    }
}
