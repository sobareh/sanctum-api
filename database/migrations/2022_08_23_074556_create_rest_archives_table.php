<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_archives', function (Blueprint $table) {
            $table->id();
            $table->string('no_dokumen');
            $table->date('tgl_dokumen');
            $table->string('url_path');
            $table->string('document_name');
            $table->float('nominal');
            $table->text('description');
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
        Schema::dropIfExists('rest_archives');
    }
}
