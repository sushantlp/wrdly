<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class NotionBook extends Model
{
    protected $table = 'notion_books';
    protected $primaryKey='book_id';
    protected $fillable = ['thought_id','habitant_id','chapter','status'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Get Wrdly Notion Book
    public function getNotionBook($thoughtId) {
        try {
            $book = DB::table('notion_books')
                    ->select('thought_id as Thought_Id'
                        ,'chapter as Book_Paragraph'
                    )
                    ->where('status',1)
                    ->get();
            return $book;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Get Wrdly Notion Book",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
