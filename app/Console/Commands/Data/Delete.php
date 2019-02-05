<?php

namespace App\Console\Commands\Data;

use Illuminate\Console\Command;
use App\Entities\Data;
use App\Console\Commands\Traits\Common;

class Delete extends Command
{
    use Common;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:delete
            { id : The id of the resource to update }
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a data resource';

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
        $id = $this->argument('id');

        $data = Data::find($id);
        if (!$data) {
            return $this->error('Data resource not found');
        }

        if(!$data->delete()) {
            return $this->error('Something went wrong');
        }

        $this->info('Delete Successful');
        return $this->modelTable($data);
    }
}
