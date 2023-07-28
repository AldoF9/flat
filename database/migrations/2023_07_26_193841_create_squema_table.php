<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSquemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);
        });

        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->boolean('active')->default(true);
        });

        Schema::create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('provider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->string('name');
            $table->integer('stock');
            $table->string('img');
            $table->double('calif');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('fk_id_category');

            $table->foreign('fk_id_category')
                ->references('id')
                ->on('category');
            $table->timestamps();
        });

        Schema::create('income', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            $table->date('date');
            $table->integer('total');
            $table->double('monetario');
            $table->integer('cantidad');
            $table->double('total_unitario');
            $table->unsignedInteger('fk_id_product');
            $table->unsignedInteger('fk_id_provider');
            $table->unsignedInteger('fk_id_user');

            $table->foreign('fk_id_product')
                ->references('id')
                ->on('product');

            $table->foreign('fk_id_provider')
                ->references('id')
                ->on('provider');

            $table->foreign('fk_id_user')
                ->references('id')
                ->on('user');

            $table->timestamps();
        });

        Schema::create('sale', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            $table->date('date');
            $table->double('imuesto');
            $table->integer('total');
            $table->unsignedInteger('fk_id_state');
            $table->unsignedInteger('fk_id_product');
            $table->unsignedInteger('fk_id_client');

            $table->foreign('fk_id_state')
                ->references('id')
                ->on('state');

            $table->foreign('fk_id_product')
                ->references('id')
                ->on('product');

            $table->foreign('fk_id_client')
                ->references('id')
                ->on('client');

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
        Schema::dropIfExists('state');
        Schema::dropIfExists('category');
        Schema::dropIfExists('client');
        Schema::dropIfExists('user');
        Schema::dropIfExists('provider');
        Schema::dropIfExists('product');
        Schema::dropIfExists('income');
        Schema::dropIfExists('sale');
    }
}
