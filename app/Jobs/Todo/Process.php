<?php

namespace App\Jobs\Todo;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Todo;


class Process implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $todo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Todo $todo)
    {
        //
        $this->todo = $todo;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
       // dd($this->todo);
        $todos= $this->todo;
        $todos->status = 1;
        $todos->save();

    }
}
