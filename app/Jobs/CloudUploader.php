<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use JD\Cloudder\Facades\Cloudder;
use App\Habitant;

class CloudUploader implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $publicId;
    protected $folder;
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath,$publicId,$folder,$userId)
    {
        $this->filePath = $filePath;
        $this->publicId = $publicId;
        $this->folder = $folder;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Cloudder::upload($this->filePath,$this->publicId,array("folder"=>$this->folder,"use_filename"=>TRUE ,"unique_filename"=>FALSE))->getResult();
        if($response) {

            // Object Creation
            $habit = new Habitant();

            // Return Cloudinary Image Url
            $path = $response['secure_url'];

            // Update Profile Pic Cloudinary Path
            $habit->updateHabitantPic($this->userId,$path);

            return true;
        }
    }
}
