<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_examination_fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('field_type', ['Date', 'Text', 'Checkbox']);
            $table->foreignId('department_examination_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('department_examination_fields');
    }
};
