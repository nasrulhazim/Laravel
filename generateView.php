<?php

namespace Art\Console\Commands;

use Illuminate\Console\Command;

define('DS',DIRECTORY_SEPARATOR);

class GenerateView extends Command
{

    /*
        
        title   : php artisan console generate view laravel 5.1
        version : 1.0
        author  : tajul asri rosli
        email   : <mtajulasri@gmail.com>

     */
    protected $directory;

    protected $default_resource_path = 'resources/views';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {page} {--path=default}  {--content=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate view for laravel.';

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
 
        $this->directory = $this->option('path');
        $this->directory = explode('.',$this->directory);
        $this->directory = implode('/',$this->directory);

        $action = $this->createViewfile($this->argument('page'));

        if($this->createViewfile($this->argument('page')))
        {
            return $this->info("view successfully created..");
        }

        return $this->error("view not successfully created..");
    }

    protected function createViewfile($file) 
    {

        $create_dir = $this->default_resource_path.DS.$this->directory;
        $full_path = $this->default_resource_path.DS.$this->directory.DS.$file;
        
        if($this->argument('page') !== strtolower('default')) 
        {
            if(!file_exists($full_path))
            {
                if(is_dir($create_dir)){

                    $handler = fopen($full_path,'a+');
                    return fwrite($handler,$this->setContent($this->option('content'))) ? true : false;
                    exit;
                }

                if(!is_dir($create_dir))
                {
                    if(mkdir($create_dir,0755,true))
                    {
                        $handler = fopen($full_path,'a+');
                        return fwrite($handler,$this->setContent($this->option('content'))) ? true : false;
                        exit;
                    }
                }
            }

              return $this->error("file are already exist {$full_path}");
        }

        elseif($this->argument('page') === strtolower('default'))
        {
            if(!file_exists($default_resource_path.DS.$file))
            {
               $handler = fopen($this->default_resource_path.DS.$file,'a+');
               return fwrite($handler,$this->setContent($this->option('content')))? true : false;
            }
        }

      
    }

    protected function setContent($filling)
    {
        if($this->option('content') !== strtolower('default')) 
        {
            $content = "@extends('layouts.master')\n";
            $content .= "\n";
            $content .= "@section('content')\n";
            $content .= "<h4>{$filling}</h4>";
            $content .= "\n";
            $content .= "@stop";

            return $content;
        }

         if($this->option('content') === strtolower('default')) 
        {
            $content = "@extends('layouts.master')\n";
            $content .= "\n";
            $content .= "@section('content')\n";
            $content .= "<h4>default generated</h4>";
            $content .= "\n";
            $content .= "@stop";

            return $content;
        }
    }
}

