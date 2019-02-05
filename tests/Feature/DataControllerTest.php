<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\Data;
use Illuminate\Foundation\Testing\TestResponse;
use Storage;

class DataControllerTest extends TestCase
{
    use WithFaker;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        shell_exec('php artisan migrate:fresh');
    }

    public static function tearDownAfterClass()
    {
        shell_exec('php artisan migrate:rollback');
        parent::tearDownAfterClass();
    }

    private function request($method, $url, array $data = [])
    {
        $args = func_get_args();
        $args[] = [
            'token' => config('productsup.token')
        ];
        array_shift($args);
        return call_user_func_array([$this, $method], $args);
    }

    private function documentResponse(TestResponse $response, $path)
    {
        // document the response by creating a log file and streaming details to it.
        if (ends_with($path, '.json')) {
            $path = str_before($path, '.json');
        }
        $path = str_replace('.', '/', $path);
        Storage::put("docs/{$path}.json", json_encode($response->json(), JSON_PRETTY_PRINT));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTokenRequirement()
    {
        $this->get('/api/data')
            ->assertJson([
                'status' => 'error'
            ])
            ->isOK();
    }

    public function testStore()
    {
        $response = $this->request(
            'post',
            '/api/data',
            [
                'title' => $this->faker->realText(10),
                'description' => $this->faker->realText(30),
                'short_description' => $this->faker->realText(15),
                'category' => 'new',
                'price' => $this->faker->randomFloat(2),
                'image_link' => $this->faker->imageUrl()
            ]
        );

        $response->assertJson([
            'status' => 'success',
            'data' => []
        ])
        ->isOk();

        $this->documentResponse($response, 'store');
    }

    public function testIndex()
    {
        $response = $this->request('get', '/api/data');
        $response->assertJson([
            'status' => 'success',
            'data' => [],
            'meta' => []
        ])
        ->isOK();

        $this->documentResponse($response, 'index');
    }

    /**
     * @depends testStore
     *
     * @return void
     */
    public function testShow()
    {
        $data = Data::take(1)->get()->first();
        $response = $this->request('get', '/api/data/' . $data->id);
        $response->assertJson([
            'status' => 'success',
            'data' => []
        ])
        ->isOk();

        $this->documentResponse($response, 'show');
    }

    /**
     * @depends testStore
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = Data::take(1)->get()->first();
        $response = $this->request(
            'put',
            '/api/data/' . $data->id,
            [
                'title' => $this->faker->unique()->realText(10),
                'description' => $this->faker->realText(30),
                'short_description' => $this->faker->realText(15),
                'category' => 'new',
                'price' => $this->faker->unique()->randomFloat(2),
                'image_link' => $this->faker->imageUrl()
            ]
        );
        $response->assertJson([
            'status' => 'success',
            'data' => []
        ])
        ->isOk();

        $this->documentResponse($response, 'update');
    }

    /**
     * @depends testStore
     *
     * @return void
     */
    public function testDestroy()
    {
        $data = Data::take(1)->get()->first();
        $response = $this->request(
            'delete',
            '/api/data/' . $data->id
        );
        $response->assertJson([
            'status' => 'success',
            'data' => []
        ])
        ->isOk();

        $this->documentResponse($response, 'destroy');
    }
}
