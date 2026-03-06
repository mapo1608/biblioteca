<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $table = 'books';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'isbn',
        'publish_year',
        'number_pages',
        'language',
        'fk_category',
        'fk_publisher'
    ];

    /**
     * relazione book-author (many to many)
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book', 'fk_book', 'fk_author');
    }


    /**
     * relazione book-category (one to many)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_category');
    }


    /**
     * relazione book-category (one to many)
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'fk_publisher');
    }


    /**
     * relazione book-copies (one to many)
     */
    public function copies()
    {
        return $this->hasMany(Copy::class, 'fk_book');
    }





    /** ________________________________________________________________*/


    /**
     * relazione book-users has many through
     */
    public function users()
    {
        return $this->hasManyThrough(
            User::class,      // Modello finale che vogliamo raggiungere
            Loan::class,    // Modello intermedio (pivot)
            'fk_book',         // Chiave esterna nel Modello Intermedio (Prestito) che collega a Libro
            'id',               // Chiave sul Modello Finale (Utente) che collega al Modello Intermedio
            'id',               // Chiave locale del Libro
            'fk_user'         // Chiave nel Modello Intermedio (Prestito) che collega a Utente
        );
    }
}
