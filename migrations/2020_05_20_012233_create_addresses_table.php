<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    private $table;

    public function __construct()
    {
        $this->table = config('addresses.table', 'addresses');
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->nullableMorphs('model');

            $table->string('door_number')->nullable()->index();
            $table->string('street')->nullable()->index();
            $table->string('state')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->string('county')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('zip')->nullable()->index();
            $table->string('country')->nullable()->index();
            $table->string('building_floor')->nullable();
            $table->string('building_number')->nullable();
            $table->boolean('is_primary')->default(false)->index();
            $table->boolean('is_invoice')->default(false)->index();
            $table->boolean('is_shipping')->default(false)->index();
            $table->boolean('is_private')->default(false)->index();
            $table->string('cord_lat', 15)->nullable();
            $table->string('cord_lng', 15)->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
