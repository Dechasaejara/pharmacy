<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Prescription;
use App\Models\Quotation;
use App\Models\QuotationVw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException; // For database-specific errors
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log; // For logging errors
use Exception; // Catch generic exceptions

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $profile = Auth::user()->profile;
            if (!$profile) {
                Log::warning('User authenticated but profile not found.', ['user_id' => Auth::id()]);
                return redirect()->back()->with('error', 'User profile not found. Please contact support.');
            }

            $query = QuotationVw::query();
            if ($profile->role === 'User') {
                $query->where('profile_id', $profile->id);
            }

            $quotations = $query->latest('created_at')->paginate(7);

            return view('quotations.index', compact('quotations'));

        } catch (QueryException $e) {
            Log::error('Database error fetching quotations: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'sql_error_code' => $e->errorInfo[1] ?? null, // Get SQLSTATE error code if available
                // 'sql' => $e->getSql(), // Be cautious with logging full SQL in production if it contains sensitive data
                // 'bindings' => $e->getBindings(), // Be cautious with logging bindings
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'A database error occurred while trying to retrieve quotations. Please try again later or contact support.');
        } catch (Exception $e) {
            Log::error('Error fetching quotations: ' . $e->getMessage(), ['user_id' => Auth::id(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Could not retrieve quotations at this time. Please try again later.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $prescriptions = Prescription::with('profile')->get();
            $pharmacies = Pharmacy::get();

            // Optional: Inform user if there are no prescriptions/pharmacies
            // if ($prescriptions->isEmpty() || $pharmacies->isEmpty()) {
            //     return redirect()->back()->with('info', 'Cannot create a quotation as required prescription or pharmacy data is missing.');
            // }

            return view('quotations.create', compact('prescriptions', 'pharmacies'));

        } catch (QueryException $e) {
            Log::error('Database error loading data for create quotation form: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'sql_error_code' => $e->errorInfo[1] ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'A database error occurred while loading necessary data. Please try again later.');
        } catch (Exception $e) {
            Log::error('Error loading create quotation form: ' . $e->getMessage(), ['user_id' => Auth::id(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Could not load the quotation creation form. Please try again later.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'prescription_id' => 'required|exists:prescriptions,id',
                'total_amount' => 'required|numeric|min:0',
                'status' => 'required|string|max:255',
                'notes' => 'nullable|string',
            ]);

            $profile = Auth::user()->profile;
            if (!$profile) {
                Log::warning('User authenticated but profile not found during quotation store.', ['user_id' => Auth::id()]);
                return redirect()->back()->withInput()->with('error', 'User profile not found. Could not create quotation.');
            }

            Quotation::create(['profile_id' => $profile->id, ...$validated]);

            return redirect()->route('quotations.index')->with('success', 'Quotation added successfully.');

        } catch (ValidationException $e) {
            Log::warning('Quotation creation validation failed: ' . $e->getMessage(), ['user_id' => Auth::id(), 'errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Please correct the form errors.');
        } catch (QueryException $e) {
            Log::error('Database error storing quotation: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'data' => $request->except(['_token', 'password', 'password_confirmation']), // Avoid logging sensitive data
                'sql_error_code' => $e->errorInfo[1] ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withInput()->with('error', 'A database error occurred while saving the quotation. Please try again or contact support.');
        } catch (Exception $e) {
            Log::error('Error storing quotation: ' . $e->getMessage(), ['user_id' => Auth::id(), 'data' => $request->except(['_token', 'password', 'password_confirmation']), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Could not create the quotation. Please try again later.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        // Route model binding handles ModelNotFoundException by default (404).
        // If $quotation is found, the main risk here is if the view itself triggers a complex query that fails.
        try {
            // Authorization check (example)
            // if (Auth::user()->cannot('view', $quotation)) {
            //     abort(403, 'You are not authorized to view this quotation.');
            // }
            return view('quotations.edit', ['quotation' => $quotation]);
        } catch (Exception $e) { // Catching a generic exception in case something unexpected happens during view rendering
            Log::error('Error loading edit quotation form: ' . $e->getMessage(), ['user_id' => Auth::id(), 'quotation_id' => $quotation->id ?? null, 'trace' => $e->getTraceAsString()]);
            return redirect()->route('quotations.index')->with('error', 'Could not load the quotation for editing. Please try again later.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        try {
            // Route model binding already found $quotation. If not, Laravel throws ModelNotFoundException (404).

            // Authorization check (example)
            // if (Auth::user()->cannot('update', $quotation)) {
            //     return redirect()->route('quotations.index')->with('error', 'You are not authorized to update this quotation.');
            // }

            $validated = $request->validate([
                'prescription_id' => 'required|exists:prescriptions,id',
                'total_amount' => 'required|numeric|min:0',
                'status' => 'required|string|max:255',
                'notes' => 'nullable|string',
            ]);

            $quotation->update($validated);

            return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully.');

        } catch (ValidationException $e) {
            Log::warning('Quotation update validation failed: ' . $e->getMessage(), ['user_id' => Auth::id(), 'quotation_id' => $quotation->id, 'errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Please correct the form errors.');
        } catch (ModelNotFoundException $e) {
             // This catch block might be redundant if route model binding is strictly used and fails to a 404 page.
             // However, it can be useful if the $quotation object could become invalid between resolving and updating, or for custom handling.
            Log::warning('Quotation not found during update.', ['user_id' => Auth::id(), 'quotation_id_attempted' => $request->route('quotation'), 'trace' => $e->getTraceAsString()]);
            return redirect()->route('quotations.index')->with('error', 'The quotation you are trying to update was not found.');
        } catch (QueryException $e) {
            Log::error('Database error updating quotation: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'quotation_id' => $quotation->id,
                'data' => $request->except(['_token', 'password', 'password_confirmation']),
                'sql_error_code' => $e->errorInfo[1] ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withInput()->with('error', 'A database error occurred while updating the quotation. Please try again or contact support.');
        } catch (Exception $e) {
            Log::error('Error updating quotation: ' . $e->getMessage(), ['user_id' => Auth::id(), 'quotation_id' => $quotation->id, 'data' => $request->except(['_token', 'password', 'password_confirmation']), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Could not update the quotation. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        try {
            // Route model binding already found $quotation.

            // Authorization check (example)
            // if (Auth::user()->cannot('delete', $quotation)) {
            //     return redirect()->route('quotations.index')->with('error', 'You are not authorized to delete this quotation.');
            // }

            $quotation->delete();

            return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');

        } catch (ModelNotFoundException $e) {
            // Similar to update, this might be redundant but can be kept for explicit handling.
            Log::warning('Quotation not found during delete.', ['user_id' => Auth::id(), 'quotation_id_attempted' => $quotation->id ?? 'unknown', 'trace' => $e->getTraceAsString()]);
            return redirect()->route('quotations.index')->with('error', 'The quotation you are trying to delete was not found.');
        } catch (QueryException $e) {
            $userMessage = 'A database error occurred while deleting the quotation. Please try again or contact support.';
            // Check for foreign key constraint violation (MySQL: 1451, PostgreSQL: 23503)
            if (isset($e->errorInfo[1]) && ($e->errorInfo[1] == 1451 || $e->errorInfo[1] == 23503)) {
                $userMessage = 'Could not delete the quotation because it is referenced by other records. Please remove those references first.';
            }
            Log::error('Database error deleting quotation: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'quotation_id' => $quotation->id,
                'sql_error_code' => $e->errorInfo[1] ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('quotations.index')->with('error', $userMessage);
        } catch (Exception $e) {
            Log::error('Error deleting quotation: ' . $e->getMessage(), ['user_id' => Auth::id(), 'quotation_id' => $quotation->id, 'trace' => $e->getTraceAsString()]);
            return redirect()->route('quotations.index')->with('error', 'Could not delete the quotation. An unexpected error occurred.');
        }
    }
}