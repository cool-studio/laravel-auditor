<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditorAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditor_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event')->index();
            $table->nullableMorphs('object');
            $table->nullableMorphs('user');
            $table->json('old')->default('{}');
            $table->json('new')->default('{}');
            $table->timestamp('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditor_audit');
    }
}
