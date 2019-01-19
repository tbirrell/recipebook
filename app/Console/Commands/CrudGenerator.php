<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator
        {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

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
        $name = $this->argument('name');

        $this->controller($name);
        $this->model($name);
        $this->request($name);
        $this->view($name);

        File::append(base_path('routes/web.php'), 'Route::resource(\'' . str_plural(strtolower($name)) . "', '{$name}Controller');");
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($name)
    {
        if(file_exists(app_path("/Models/{$name}.php"))) return;
        
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
    }

    protected function controller($name)
    {
        if(file_exists(app_path("/Http/Controllers/{$name}Controller.php"))) return;

        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(str_plural($name)),
                strtolower($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function request($name)
    {
        if(file_exists(app_path("/Http/Requests/{$name}Request.php"))) return;

        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }

    protected function view($name)
    {
        $modelNameSingularLowerCase = strtolower($name);
        $viewTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('View')
        );

        if(!file_exists($path = resource_path("/views/{$modelNameSingularLowerCase}"))) 
            mkdir($path, 0777, true);

        if(!file_exists($index  = "{$path}/index.blade.php"))   file_put_contents($index, $viewTemplate);
        if(!file_exists($create = "{$path}/create.blade.php"))  file_put_contents($create, $viewTemplate);
        if(!file_exists($show   = "{$path}/show.blade.php"))    file_put_contents($show, $viewTemplate);
        if(!file_exists($edit   = "{$path}/edit.blade.php"))    file_put_contents($edit, $viewTemplate);
    }
}
