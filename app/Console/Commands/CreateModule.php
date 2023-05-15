<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:module {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $module = $this->argument('module');
        $modulModels = ucfirst($module);
        (File::exists('modules/'.$module)) ? '1' : File::makeDirectory('modules/'.$module, 0755, true);
        (File::exists('modules/'.$module.'/view')) ? '1' : File::makeDirectory('modules/'.$module.'/view', 0755, true);

        //create app
        $appBladePhp = File::get('masterTpl/app.blade.php');
        File::put('modules/'.$module.'/app.blade.php', $appBladePhp);

        //create breadcrumbs
        $appBladePhp = File::get('masterTpl/breadcrumbs.blade.php');
        File::put('modules/'.$module.'/breadcrumbs.blade.php', $appBladePhp);

        //create _config.json
        $confFile = File::get('masterTpl/_config.json');
        $confFile = str_replace('$module', $module, $confFile);
        $confFile = str_replace('$Module', ucfirst($module), $confFile);
        File::put('modules/'.$module.'/_config.json', $confFile);

        //create home.blade.php
        $homeFile = File::get('masterTpl/home.blade.php');
        $homeFile = str_replace('$module', $module, $homeFile);
        $homeFile = str_replace('$modulModels', $modulModels, $homeFile);
        File::put('modules/'.$module.'/view/home.blade.php', $homeFile);

        //create add.blade.php
        $addFile = File::get('masterTpl/add.blade.php');
        $addFile = str_replace('$module', $module, $addFile);
        $addFile = str_replace('$modulModels', $modulModels, $addFile);
        File::put('modules/'.$module."/view/add$module.blade.php", $addFile);

        //create edit.blade.php
        $editFile = File::get('masterTpl/edit.blade.php');
        $editFile = str_replace('$module', $module, $editFile);
        $editFile = str_replace('$modulModels', $modulModels, $editFile);
        File::put('modules/'.$module."/view/edit$module.blade.php", $editFile);

        //create models.php
        $modelsFile = File::get('masterTpl/models.php');
        $modelsFile = str_replace('$module', $module, $modelsFile);
        $modelsFile = str_replace('$modulModels', $modulModels, $modelsFile);
        File::put("App/Models/$modulModels.php", $modelsFile);

        //create controller.php
        $controllerFile = File::get('masterTpl/_controller.php');
        $controllerFile = str_replace('$module', $module, $controllerFile);
        $controllerFile = str_replace('$modulModels', $modulModels, $controllerFile);
        File::put('modules/'.$module.'/_controller.php', $controllerFile);

        $this->info('Success!');
    }
}
