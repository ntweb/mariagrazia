<?php

use Illuminate\Database\Seeder;

class EcommerceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App::setLocale('it');

        // Shipment
        $s = new \App\Shipment;
        $s->title = "Spedizione standard";
        $s->price = 10.00;
        $s->tax = 22;
        $s->type = 'standard';
        $s->id_created_by = 1;
        $s->active = '1';
        $s->save();

        $s = new \App\Shipment;
        $s->title = "Corriere espresso";
        $s->price = 15.00;
        $s->tax = 22;
        $s->type = 'standard';
        $s->id_created_by = 1;
        $s->active = '1';
        $s->save();

        // Payment
        $s = new \App\Payment;
        $s->title = "Contrassegno";
        $s->consumer_message = "Say something";
        $s->amount = 10.00;
        $s->amount_type = 'value';
        $s->tax = 22;
        $s->type = 'standard';
        $s->id_created_by = 1;
        $s->active = '1';
        $s->save();

        $s = new \App\Payment;
        $s->title = "Bonifico bancario";
        $s->consumer_message = "Say something: IBAN: ITXXX-XXXX-XXXX-XXXX";
        $s->amount = 10.00;
        $s->amount_type = 'value';
        $s->tax = 22;
        $s->type = 'standard';
        $s->id_created_by = 1;
        $s->active = '1';
        $s->save();

        $s = new \App\Payment;
        $s->title = "Carta di credito";
        $s->consumer_message = "Say something";
        $s->amount = 4;
        $s->amount_type = 'percent';
        $s->tax = 22;
        $s->type = 'paypal';
        $s->id_created_by = 1;
        $s->active = '1';
        $s->save();

    }
}
