<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cocktails', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique;
            $table->string('category', 50);
            $table->string('alcholic', 30)->nullable();
            $table->string('glass', 50)->nullable();
            $table->text('instructions')->nullable();
            $table->string('thumb')->nullable();
            $table->json('ingredients')->nullable();
            $table->json('measures')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cocktails');
    }
};


/* # tabella

- id
- name
- category  
- alcholic 
- glass ? 
- instructions
- thumb
- ingredients
- measures


##### come popolare ingridients e measures ( da rivedere con la corretta sintassi )
cockatilIngredients = [];
for i = 0 ; i < 15 ; i++{
    if 'strIngridient{$i}'=! null{
        cocktailIngridients.push(strIngridient{$i}.value) ;
    }
} */
