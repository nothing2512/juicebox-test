<?php

namespace App\Console\Commands;

use App\Jobs\MailSender;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User();
        $user->name = $this->argument("name");
        $user->email = $this->argument("email");

        Mail::to($user->email)->send(new WelcomeEmail($user));
    }
}
