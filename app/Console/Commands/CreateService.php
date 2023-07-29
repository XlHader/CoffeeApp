<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : The name of the service (singular) to create (e.g. CategoryService) (case-sensitive) (no spaces)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service in the Services folder';

    protected $type = 'Service';

    protected function getStub() {
        return base_path('stubs/service.stub');
    }

    protected function getServicePath($name) {
        return app_path('Services/' . $this->getClassName($name) . '.php');
    }

    protected function getServiceNamespace($name) {
        return 'App\Services';
    }

    protected function getClassName($name) {
        if (str_contains(strtolower($name), 'service')) {
            return $name;
        }

        return $name . 'Service';
    }

    /**
     * Execute the console command.
     *
     * This command will create a new service in the Services folder.
     */
    public function handle()
    {
        $servicePath = $this->getServicePath($this->argument('name'));

        if (File::exists($servicePath)) {
            $this->error('Service already exists!');
            return;
        }

        $stub = File::get($this->getStub());

        $stub = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$this->getServiceNamespace($this->argument('name')), $this->getClassName($this->argument('name'))],
            $stub
        );

        File::put($servicePath, $stub);

        $this->info('Service created successfully.');
    }
}
