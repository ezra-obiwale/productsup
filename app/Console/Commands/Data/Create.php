<?php

namespace App\Console\Commands\Data;

use Illuminate\Console\Command;
use App\Entities\Data;
use App\Console\Commands\Traits\Common;

class Create extends Command
{
    use Common;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:create
                { --payload=* : Key:value payload information }
            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new data resource';

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
        $payload = $this->option('payload');
        if (!count($payload)) {
            return $this->error('The payload cannot be empty');
        }

        $parsedPayload = $this->parseKeyValue($payload);

        if (!count($parsedPayload)) {
            return $this->error('The payload cannot be empty');
        }

        $validation = Data::validate($parsedPayload);
        if ($validation->fails()) {
            $this->error('Validation failed');
            return $this->validationTable($validation);
        }

        if (!$data = Data::create($parsedPayload)) {
            return $this->error('Something went wrong');
        }

        $this->info('Create Successful');
        return $this->modelTable($data);
    }
}
