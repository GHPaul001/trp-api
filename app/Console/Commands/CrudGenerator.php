<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name : Class (singular) for example User or EmailAutomation} {--dir=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates CRUD operation';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->controller($name);
        $this->model($name);
        $this->request($name);
        $this->filter($name);
        $this->migration($name);

        // File::append(base_path('routes/api.php'), 'Route::resource(\'' . str_plural(strtolower($name)) . "', '{$name}Controller');");
    }

    protected function getStub($type)
    {
        return file_get_contents(base_path() . "/stubs/$type.stub");
    }

    protected function isDirEmpty()
    {
        return empty($this->option('dir'));
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{namespace}}'
            ],
            [
                $name,
                $this->isDirEmpty() ? "" : "\\{$this->option('dir')}"
            ],
            $this->getStub('Model')
        );

        if ($this->isDirEmpty()) {
            file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
            $this->info("\nCreated Model: " . app_path("/Models/{$name}.php"));
            return;
        }

        if (!file_exists($path = app_path("/Models/{$this->option('dir')}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Models/{$this->option('dir')}/{$name}.php"), $modelTemplate);
        $this->info("\nCreated Model: " . app_path("/Models/{$this->option('dir')}/{$name}.php"));
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNameSingularLowerCase}}',
                '{{namespace}}'
            ],
            [
                $name,
                $this->snakeCase($name),
                $this->isDirEmpty() ? "" : "\\{$this->option('dir')}"
            ],
            $this->getStub('Controller')
        );

        if ($this->isDirEmpty()) {
            file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
            $this->info("\nCreated Controller: " . app_path("/Http/Controllers/{$name}Controller.php"));
            return;
        }

        if (!file_exists($path = app_path("/Http/Controllers/{$this->option('dir')}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Controllers/{$this->option('dir')}/{$name}Controller.php"), $controllerTemplate);
        $this->info("\nCreated Controller: " . app_path("/Http/Controllers/{$this->option('dir')}/{$name}Controller.php"));
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{namespace}}'
            ],
            [
                $name,
                $this->isDirEmpty() ? "" : "\\{$this->option('dir')}"
            ],
            $this->getStub('Request')
        );

        if ($this->isDirEmpty()) {
            if (!file_exists($path = app_path("/Http/Requests")))
                mkdir($path, 0777, true);

            file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
            $this->info("\nCreated FormRequest: " . app_path("/Http/Requests/{$name}Request.php"));
            return;
        }

        if (!file_exists($path = app_path("/Http/Requests/{$this->option('dir')}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$this->option('dir')}/{$name}Request.php"), $requestTemplate);
        $this->info("\nCreated FormRequest: " . app_path("/Http/Requests/{$this->option('dir')}/{$name}Request.php"));
    }

    protected function filter($name)
    {
        $filterTemplate = str_replace(
            [
                '{{modelName}}',
                '{{namespace}}',
                '{{importbasefilter}}'
            ],
            [
                $name,
                $this->isDirEmpty() ? "" : "\\{$this->option('dir')}",
                $this->isDirEmpty() ? "" : "use App\\Http\\Filters\\BaseFilters;"
            ],
            $this->getStub('Filter')
        );

        if ($this->isDirEmpty()) {
            if (!file_exists($path = app_path("/Http/Filters")))
                mkdir($path, 0777, true);

            file_put_contents(app_path("/Http/Filters/{$name}Filters.php"), $filterTemplate);
            $this->info("\nCreated Filter: " . app_path("/Http/Filters/{$name}Filters.php"));
            return;
        }

        if (!file_exists($path = app_path("/Http/Filters/{$this->option('dir')}")))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Filters/{$this->option('dir')}/{$name}Filters.php"), $filterTemplate);
        $this->info("\nCreated Filter: " . app_path("/Http/Filters/{$this->option('dir')}/{$name}Filters.php"));
    }

    protected function migration($name)
    {
        $tableName = strtolower(Str::plural($this->snakeCase($name)));

        $migration = \Artisan::call('make:migration', [
            'name' => 'create_' . $tableName . '_table',
            '--create' => $tableName
        ]);
        $this->info(\Artisan::output());
    }

    protected function snakeCase($name)
    {
        return Str::snake($name);
    }
}
