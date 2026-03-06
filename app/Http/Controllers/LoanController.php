<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmLoanMail;
use Illuminate\Http\Request;
use App\Models\Copy;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;


class LoanController extends Controller
{
    /**
     * metodo che presenta il form di avvio prestito
     */
    public function create_loan($id)
    {
        $copy = Copy::find($id);
        $users = User::all();

        session(['search_copy_id' => $id]);

        return view('loans.create_loans')
            ->with('copy',$copy)
            ->with('users',$users);
    }

    /**
     * metodo per avviare il nuovo prestito
     */
    public function store_loan(Request $request)
    {
        $copy = Copy::find($request->input('fk_copy'));
        $user = User::find($request->input('fk_user'));
        if($copy == null || $user == null){
            return back();
        }
        if($copy->status == 2){
            return back()->with('err','Errore: copia già in prestito.');
        }
        $loan = new Loan([
            'status' => true,
            'loan_start_date' => Carbon::now()->toDateString(),
            'loan_expiration_date' => Carbon::now()->addDays(30)->toDateString(),
            'loan_real_end_date' => null,
            'fk_copy' => $request->input('fk_copy'),
            'fk_user' => $request->input('fk_user'),
        ]);
        $loan->save();

        $copy->status = 2;
        $copy->save();

        /* Codice per invio di una mail di conferma */
        $book = $copy->book->title . " - " . $copy->book->isbn;
        $start_date = $loan->loan_start_date;
        $expiration_date = $loan->loan_expiration_date;
        $email = $user->email;

        //commentata perché funziona solo con account di mailtrap (modificare env con il vostro account se volete utilizzarla)
        //Mail::to($email)->send(new ConfirmLoanMail($book,$start_date,$expiration_date));

        session()->forget('search_copy_id');
        session()->forget('search_user_id');

        return redirect()->route('books.show',$copy->book->id);
    }

    /**
     * metodo per ottenere la lista dei prestiti
     */
    public function index_loan()
    {
        $loans = Loan::all();
        return view('loans.index_loans')
            ->with('loans',$loans);
    }

    /**
     * metodo per aprire il dettaglio di un prestito
     */
    public function show_loan($id)
    {
        $loan = Loan::find($id);
        return view('loans.show_loans')
            ->with('loan',$loan);
    }


    /**
     * metodo per terminare il prestito avviato
     */
    public function stop_loan($id)
    {
        $loan = Loan::find($id);
        $loan->update([
            'status' => false,
            'loan_expiration_date' => Carbon::now()->toDateString(),
            'loan_real_end_date' => Carbon::now()->toDateString(),
        ]);

        $copy = Copy::find($loan->fk_copy);
        $copy->status = 1;
        $copy->save();

        return redirect()->route('loans.index');
    }

    /**
     * metodo per terminare il prestito avviato
     */
    public function my_loans()
    {
        $user = Auth::user();
        $loans = Loan::where('fk_user','=',$user->id)->get();

        $late_loans = Loan::where('status',true)
            ->where('loan_expiration_date','<',date('Y-m-d'))
            ->get();

        $late = false;    
        if(count($late_loans)>0){
            $late = true;
        }

        /*
        //VERSIONE ALTERNATIVA
        // Lavora sulla Collection in memoria (NESSUNA NUOVA QUERY)
        $today = date('Y-m-d');
        $late_loans = $loans->filter(function ($loan) use ($today) {
            // FILTRA CON GLI STESSI CRITERI DELLA QUERY MA DIRETTAMENTE NELLA COLLECTION
            return $loan->status === true && $loan->loan_expiration_date < $today;
        });
        //Determinare se c'è almeno un prestito in ritardo
        $late = $late_loans->isNotEmpty();
        */

        return view('user_reader.my_loans')
            ->with('loans',$loans)
            ->with('late',$late);
    }


    /**
     * metodo per terminare il prestito avviato
     */
    public function extend_loan($id)
    {
        $loan = Loan::find($id);
        $loan->loan_expiration_date = Carbon::now()->addDays(30)->toDateString();
        $loan->save();

        return redirect()->route('loans.my_loans');
    }


    public function search_user(Request $request)
    {
        $users = User::where('email','LIKE', '%' . $request->input('search_user_name') . '%')
            ->orWhere('name','LIKE', '%' . $request->input('search_user_name') . '%')
            ->get();
        return view('loans.selected_user')
            ->with('users',$users);
    }


    public function selected_user($id)
    {
        session(['search_user_id' => $id]);

        $copy_id = session('search_copy_id');

        return redirect()->route('loans.create',$copy_id);
    }


}
