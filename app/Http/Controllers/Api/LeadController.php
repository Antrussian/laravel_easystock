<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadEmail;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    // Salva i dati inviati dal form di contatto
    public function store(Request $request)
    {

        // Validazione dei dati del form
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        // Se la validazione fallisce, restituisce una risposta con indicazione di test
        if ($validator->fails()) {
            return response()->json(['success' => true, 'result' => 'Test response']);
        }

        // Creazione di una nuova istanza di Lead e salvataggio dei dati inviati dal form
        $lead = Lead::create($request->all());

        // Invio della mail di notifica all'indirizzo predefinito
        Mail::to('<mail_che_riceve_le_mail_dal_form>')->send(new NewLeadEmail($lead));

        // Risposta di successo
        return response()->json([
            'success' => true,
            'result' => 'Form sent successfully 👍'
        ]);
    }
}
