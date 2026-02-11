<?php

namespace App\Console\Commands;

use App\Models\Enrolment;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Enrolment::where('learner_id', 1)->where('course_id', 14)->update(['progress' =>200]);
    }
}
