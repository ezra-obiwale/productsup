<?php

namespace App\Console\Commands\Data;

use Illuminate\Console\Command;
use App\Entities\Data;
use App\Console\Commands\Traits\Common;

class Update extends Command
{
    use Common;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:update
                { id : The id of the resource to update }
                { --payload=* : Key:value payload information }
            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a data resource';

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
        $id = $this->argument('id');

        $data = Data::find($id);
        if (!$data) {
            return $this->error('Data resource not found');
        }

        if (!count($payload)) {
            return $this->error('The payload cannot be empty');
        }

        $parsedPayload = $this->parseKeyValue($payload);

        $validation = Data::validate($parsedPayload, $id);
        if ($validation->fails()) {
            $this->error('Validation failed');
            return $this->validationTable($validation);
        }

        if (!count($parsedPayload)) {
            return $this->error('The payload cannot be empty');
        }

        if (!$data->update($parsedPayload)) {
            return $this->error('Something went wrong');
        }

        $this->info('Update Successful');
        return $this->modelTable($data);
    }
}
