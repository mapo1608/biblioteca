<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Loan;
use Illuminate\Support\Carbon; 

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse{
            public function toResponse($request)
            {
                $user = Auth::user();

                $late_loans = Loan::where('status',true)
                    ->where('fk_user','=',$user->id)
                    ->where('loan_expiration_date','<',date('Y-m-d'))
                    ->get();

                // 1. Calcola la data tra 5 giorni
                $data_limite = Carbon::now()->addDays(5)->toDateString();
                // 2. Data odierna (per escludere quelli già scaduti)
                $data_oggi = Carbon::now()->toDateString();
                $near_expiration_loans = Loan::where('status', true)
                    ->where('fk_user', $user->id) 
                    // CONDIZIONE CHIAVE: La scadenza deve essere compresa tra OGGI e $data_limite (tra 5 giorni)
                    ->where('loan_expiration_date', '>', $data_oggi) // Scadenza futura
                    ->where('loan_expiration_date', '<=', $data_limite) // Scadenza entro 5 giorni
                    ->get();

                $messages = array();
                if(count($late_loans) > 0){
                    $request->session()->flash('trigger_modal',true);
                    $messages[] = 'Hai dei prestiti in ritardo!!!';
                }
                if(count($near_expiration_loans) > 0){
                    $request->session()->flash('trigger_modal',true);
                    $messages[] = 'Hai dei prestiti che scadono tra 5 giorni.';
                }
                if(count($messages)>0){
                    $request->session()->flash('messages',$messages);
                }

                return redirect('/home');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        //Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);
        
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        /*

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        */

        Fortify::loginView(function(){
            return view('authentication.login');
        });
        Fortify::registerView(function () {
            return view('authentication.register');
        });
        Fortify::requestPasswordResetLinkView(function () {
            return view('authentication.email');
        });
        Fortify::resetPasswordView(function (Request $request) {
            return view('authentication.reset', 
                ['request' => $request]);
        });

        
    }
}
