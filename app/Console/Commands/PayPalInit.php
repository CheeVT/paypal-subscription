<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\PayPal\Product as PayPalProduct;

class PayPalInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paypal:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $product = new PayPalProduct('Name 1 test', 'desc');
        dd($product->create());
    }
}
