<?php

use App\Laravel\Models\{BlogComment,Blog};
use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();


        foreach(range(1,10) as $index => $value){
            $blog = new Blog;
            $blog->title = $faker->sentence(mt_rand(5,9),true);
            $blog->content = $faker->paragraph(3,true);
            $blog->save();

            foreach(range(1,5) as $i => $row){
            	$blog_comment = new BlogComment;
            	$blog_comment->blog_Id = $blog->id;
            	$blog_comment->comment = $faker->sentence(mt_rand(5,9),true);
            	$blog_comment->save();
            }

        }
            echo "Successfully seeded 10 Blogs with comment.";

    }
}
