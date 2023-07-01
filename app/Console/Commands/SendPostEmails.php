<?php

namespace App\Console\Commands;

use App\Mail\PostNotification;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to subscribers for new posts';


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


        $posts = Post::with('website')->where('sent_email', false)->get();

        foreach ($posts as $post) {
            $subscribers = Subscription::all();

            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new PostNotification($post));
            }

            $post->update(['sent_email' => true]);
        }

        $this->info('Emails sent successfully');

//        // Retrieve all posts that haven't been sent as emails yet
//        $posts = Post::where('sent', false)->get();
//
//        foreach ($posts as $post) {
//            // Retrieve the subscribers for the post's website
//            $subscribers = Subscription::where('website_id', $post->website_id)->get();
//
//            foreach ($subscribers as $subscriber) {
//                // Send the email to the subscriber
//                Mail::to($subscriber->email)->send(new PostNotification($post));
//
//                // Update the post as sent
//                $post->update(['sent' => true]);
//            }
//        }
//
//        $this->info('Emails sent successfully!');

//        $websites = Website::with('subscribers')->get();
//
//        foreach ($websites as $website) {
//            $newPosts = Post::where('website_id', $website->id)
//                ->whereDoesntHave('emails')
//                ->get();
//
//            foreach ($newPosts as $post) {
//                foreach ($website->subscribers as $subscriber) {
//                    Mail::to($subscriber->email)->send(new PostNotification($post));
//                    $post->emails()->create(['user_id' => $subscriber->id]);
//                }
//            }
//        }
//
//        $this->info('Emails sent successfully!');
    }
}
