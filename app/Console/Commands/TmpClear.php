<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TmpClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the storage/app/tmp directory';

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
		// Files to not delete
		$filesKeep = ['.gitignore'];

		$files = array_diff(\Storage::disk('tmp')->allFiles(), $filesKeep);
		
		\Storage::disk('tmp')->delete($files);
		$this->info('Files cleared successfully');
    }
}
