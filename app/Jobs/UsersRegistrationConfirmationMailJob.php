<?php

namespace App\Jobs;

use App\Mail\UsersRegistrationConfirmationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UsersRegistrationConfirmationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $username, $password;
//    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $password)
    {
//        $this->user = $user;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('Job Test: ' . $this->username);
        Mail::to("razibeee2012@gmail.com")->send( new UsersRegistrationConfirmationMail($this->username, $this->password));
    }
}
