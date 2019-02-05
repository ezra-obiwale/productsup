<?php

namespace App\Console\Commands\Data;

use Illuminate\Console\Command;
use App\Entities\Data;
use App\Console\Commands\Traits\Common;

class Fetch extends Command
{
    use Common;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:fetch
                    { id? : The id of the resource to fetch }
                    { --page=1 : The page to fetch }
                    { --filter=* : Key:value filter  }
                ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch one or many data resources';

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
        if ($id = $this->argument('id')) {
            if ($data = Data::find($id)) {
                return $this->modelTable($data);
            }

            return $this->error('Data resource not found');
        }

        $page = $this->option('page');
        $filter = $this->option('filter');

        $parsedFilter = $this->parseFilters($filter);

        $skip = ($page - 1) * 10;

        $dataList = Data::limit(10)->skip($skip)->where($parsedFilter)->get();
        return $dataList->count()
            ? $this->collectionTable($dataList)
            : $this->info('No entries found');
    }

    private function parseFilters(array $filters)
    {
        $array = [];
        foreach ($filters as $keyValue) {
            list ($key, $value) = explode(':', $keyValue);
            $array[] = [$key, 'like', "%$value%"];
        }
        return $array;
    }
}
