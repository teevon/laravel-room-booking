<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;

class AddCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new company';

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
        $company = Company::create([
            'name' => 'Test Company',
            'phone' => '123-123-1234',
        ]);
        $this->info('Added: ' . $company->name);
        // $this->warn('This is some warning');
        // $this->error('This is some err');
    }
}
