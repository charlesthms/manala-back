<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
  public function export(Request $request)
  {
    // Generate and secure the zip path
    $zipPath = Invoice::exportMonthFolder($request->selection);


    $parts = explode('/', $zipPath);
    $filename = $parts[count($parts) - 1];

    // Set the headers for file download
    $headers = [
      'Content-Type' => 'application/zip',
      'Content-Disposition' => 'attachment; filename="' . $filename . '"',
      'Access-Control-Expose-Headers' => 'Content-Disposition',
    ];

    // Create a StreamedResponse to serve the file as a download
    return response()->file($zipPath, $headers);

  }
}
