<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Books;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('DefValue');

        Model::reguard();
    }
}

class DefValue extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = new Books();
        
        $books->name = 'Том сойер';
        $books->author = 'Марк твен';
        $books->ISBN = '1333-56332-663324-3553';
        $books->publication = 2000;
        
        $books->save();
    }    
}
