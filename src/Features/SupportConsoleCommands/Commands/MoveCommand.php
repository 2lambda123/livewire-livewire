<?php

namespace Livewire\Features\SupportConsoleCommands\Commands;

use Illuminate\Support\Facades\File;

class MoveCommand extends FileManipulationCommand
{
    protected $signature = 'livewire:move {name} {new-name} {--force} {--inline}';

    protected $description = 'Move a Livewire component';

    protected $newParser;

    public function handle()
    {
        $this->parser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('name')
        );

        $this->newParser = new ComponentParserFromExistingComponent(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('new-name'),
            $this->parser
        );

        $inline = $this->option('inline');

        $class = $this->renameClass();
        if (! $inline) $view = $this->renameView();

        $test = $this->renameTest();

        if ($class) $this->components->info("COMPONENT MOVED 🤙");
        $class && $this->components->info("CLASS: {$this->parser->relativeClassPath()} => {$this->newParser->relativeClassPath()}");
        if (! $inline) $view && $this->components->info("VIEW: {$this->parser->relativeViewPath()} => {$this->newParser->relativeViewPath()}");
        $test && $this->components->info("Test: {$this->parser->relativeTestPath()} => {$this->newParser->relativeTestPath()}");
    }

    protected function renameClass()
    {
        if (File::exists($this->newParser->classPath())) {
            $this->components->error("WHOOPS-IE-TOOTLES 😳");
            $this->components->error("Class already exists: {$this->newParser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($this->newParser->classPath());

        File::put($this->newParser->classPath(), $this->newParser->classContents());

        return File::delete($this->parser->classPath());
    }

    protected function renameView()
    {
        $newViewPath = $this->newParser->viewPath();

        if (File::exists($newViewPath)) {
            $this->components->error("View already exists: {$this->newParser->relativeViewPath()}");

            return false;
        }

        $this->ensureDirectoryExists($newViewPath);

        File::move($this->parser->viewPath(), $newViewPath);

        return $newViewPath;
    }

    protected function renameTest()
    {
        $oldTestPath = $this->parser->testPath();
        $newTestPath = $this->newParser->testPath();

        if (!File::exists($oldTestPath) || File::exists($newTestPath)) {
            return false;
        }

        $this->ensureDirectoryExists($newTestPath);
        File::move($oldTestPath, $newTestPath);
        return $newTestPath;
    }
}
