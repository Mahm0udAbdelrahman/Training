<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             $tasks = Task::all();
            $users = User::all();

            foreach ($tasks as $task) {
                foreach ($users as $user) {
                   Comment::create([
                        'body' => 'Sample comment for task ' . $task->id,
                        'commentable_id' => $task->id,
                        'commentable_type' => Task::class,
                        'user_id' => $user->id,
                    ]);
                }
            }


    }
}
