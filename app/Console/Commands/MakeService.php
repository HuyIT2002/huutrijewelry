<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */


    protected $type = 'Service';
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tạo một Service trong thư mục Services';

    /**
     * Execute the console command.
     *
     * @return int
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/service.stub';
    }

    // Đặt tên của file sẽ được tạo ra
    protected function getPath($name)
    {
        // Đảm bảo chỉ tạo trong app/Services
        return base_path('app/Services/' . str_replace('\\', '/', $name) . '.php');
    }
    public function handle()
    {
        if (!file_exists($path = base_path('/Services'))) {
            mkdir($path, 0777, true);
        }

        parent::handle();
    }
}
